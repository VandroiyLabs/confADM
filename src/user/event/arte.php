<?php
$home = "/home/" . get_current_user() . "/";

 	require_once($home . "public_html/sifsc/user/classes/class.pessoa.php");
	require_once($home . "public_html/sifsc/user/classes/class.evento.php");
	require_once($home . "public_html/sifsc/user/classes/class.inscricao.php");
	require_once($home . "public_html/sifsc/user/classes/class.arte.php");

	session_start();
	require_once("./../user_edition_variables.php");
	require_once($head_file);
	require_once($home . "public_html/sifsc/user/restricted.php");
	require_once($home . "public_html/sifsc/user/event/secao.php");

	//Verificando se o participante está inscrito na edição atual
	if(isset($_SESSION["SemInscricao"]) AND $_SESSION["SemInscricao"] == 1)
	{
		$_SESSION['msg'] = 'Faça sua inscrição antes de prosseguir.';
		echo "<script language=\"JavaScript\">location=(\"http://sifsc.ifsc.usp.br/user/event/status.php\")</script>";
		exit();
	}
	else
	{
		//Verificando de participante já preencheu dados pessoais
		$status_insc = $inscricao->get_modalidade();
		if ( !isset($status_insc[0]) or $status_insc[0] == '0')
		{
			$_SESSION['msg'] = 'Preencha seus dados pessoais antes de prosseguir.';
			echo "<script language=\"JavaScript\">location=(\"http://sifsc.ifsc.usp.br/user/event/registration.php\")</script>";
			exit();
		}
	}

	$arte = new Arte();
	if($arte->find_by_codigo($inscricao->get_codigo_arte()))
	{
		$arte_checked='checked'; $arte_nochecked='';

	}
	else{
		$arte_checked=''; $arte_nochecked='checked';
	}
	$_SESSION["arte"] = $arte;



?>

<?php include('index.php'); ?>

<div id="user_system">


	<script type="text/javascript" language="javascript" src="http://sifsc.ifsc.usp.br/user/event/script/arte_script.js" ></script>

	<div id="titulo_form_secao">
		Show de Talentos/Obra Artística
	</div>



	<?php

		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}

		$modalidade = $inscricao->get_modalidade();

		if ( ($modalidade[4] == 0 or $modalidade[4] == 1) and $evento->get_inscricao_aberta()== 1)
		{

/*<p class="textocorrido">A exposição artística será feita no Salão de Eventos no dia 09 de Outubro, quinta-feira, e as obras devem ser entregues no dia anterior (período da tarde) no mesmo local. As apresentações artísticas vinculadas ao Show de Talentos serão realizadas no dia 08 de Outubro, quarta feira, a partir das 19hrs no Auditório Prof. Sérgio Mascarenhas. Para a participação em qualquer uma das duas categorias culturais, exposição ou Show de Talentos, é preciso enviar uma descrição detalhada. Clique <a href='http://sifsc.ifsc.usp.br/2014/obraarte.php' > aqui</a> para saber mais.</p>*/
	?>


	<form method="POST" name="formulario" action="http://sifsc.ifsc.usp.br/user/event/action/arte_action.php" >



		<?php 	include($home . "public_html/sifsc/user/event/form/arte_form.php"); ?>

		<input type='hidden' name='page' value=''/>
		<input type='hidden' name='submissao' value='0'/>
		<table cellspacing="15" cellpadding="1" border="0"  width="100%">
		<tr>
			<td class="button" colspan='2' align='right'>
				<span class="button" onClick='valid_form_submete();' style='cursor: pointer;'>Submeter</span> <span class="button" onClick='valid_form();' style='cursor: pointer;'>Salvar</span>
			</td>
		</tr>
		</table>


		<?php if($evento->get_inscricao_aberta()== 0)
		{?>
				<script language="JavaScript">desabilita();</script>
		<?php }
		elseif($modalidade[4] == 0 )
		{ ?>
				<script language="JavaScript">desabilita_arte();</script>
		<?php }?>

	</form>

	<?php

		}
		elseif ( ($modalidade[4] == 0 or $modalidade[4] == 1) and $evento->get_inscricao_aberta()== 0)
		{
		?>
			<p>Inscrições não disponíveis.</p>
		<?php
		}
		elseif( $modalidade[4] == 2 )
		{
			// Arte já submetida e esperando avaliação pela organização
			echo "<h2 class=\"deferimento\">Sua obra de arte está sob avaliação.</h2>";

			echo "<p>Sua obra de arte:</p>";
			include('show_arte.php');
		}
		elseif( $modalidade[4] == 3 )
		{
			// Arte foi indeferida
			echo "<h2 class=\"deferimento\">Sua obra de arte foi indeferida.</h2>";
			echo "<p>Segue o motivo pelo indeferimento:</p>";

		 	require_once($home . "public_html/sifsc/user/classes/class.deferimento.php");
			$def = new Deferimento();
			$def->find_by_evento_pessoa_arte($evento->get_codigo_evento(), $pessoa->get_codigo_pessoa(), $inscricao->get_codigo_arte());
			echo "<hr class=\"notadeferimentou\" /><p class=\"notadeferimento\">" . nl2br( $def->get_comentario() ) . "</p><hr class=\"notadeferimentod\" /><br /><br />";

			echo "<p>Sua obra de arte:</p>";
			include('show_arte.php');
		}
		elseif( $modalidade[4] == 4 )
		{
			// Arte deferida
			echo "<h2 class=\"deferimento\">Sua obra de arte foi deferida, parabéns!! <br /> Entre em contato com a comissão para maiores detalhes.</h2>";

			echo "<p>Sua obra de arte:</p>";
			include('show_arte.php');
		}

	?>
</div>

<?php  require_once($foot_file);?>
