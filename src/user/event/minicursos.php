<?php

require_once("~/public_html/sifsc/user/classes/class.pessoa.php");
require_once("~/public_html/sifsc/user/classes/class.evento.php");
require_once("~/public_html/sifsc/user/classes/class.inscricao.php");
require_once("~/public_html/sifsc/user/classes/class.minicurso.php");
require_once("~/public_html/sifsc/user/classes/class.participa_minicurso.php");
session_start();
require_once("./../user_edition_variables.php");
require_once($head_file);

require_once("~/public_html/sifsc/user/restricted.php");
require_once("~/public_html/sifsc/user/event/secao.php");


$participacao = new ParticipaMinicurso();
$minicurso = new Minicurso();

if ( $participacao->find_by_codigo($pessoa->get_codigo_pessoa(),$evento->get_codigo_evento()) )
{
	$minicurso_checked='checked'; $minicurso_nochecked='';
}
else
{
	$minicurso_checked=''; $minicurso_nochecked='checked';
}
$_SESSION["participacao"] = $participacao;

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

?>

<?php include('index.php'); ?>

<div id="user_system">


	<script type="text/javascript" language="javascript" src="http://sifsc.ifsc.usp.br/user/event/script/minicurso_script.js" ></script>


	<div id="titulo_form_secao">
		Minicurso
	</div>

	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "		<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}

		$situacao = $inscricao->get_modalidade();

		if ( strcmp($situacao[3], '0') == 0 && $evento->get_minicurso_aberto() == 1)
		{
	?>

	<p class="textocorrido">Minicursos têm vagas limitadas. Caso queira participar de um, basta selecionar abaixo sua opção e clicar em salvar (sua escolha não poderá ser modificada depois disso). Isso não precisa ser feito agora, você pode escolher o minicurso quando quiser, limitando-se apenas ao número de vagas.</p>

	<form accept-charset="ISO-8859-1" method="POST" name="formulario" action="http://sifsc.ifsc.usp.br/user/event/action/minicurso_action.php" >

		<?php 	include("~/public_html/sifsc/user/event/form/minicurso_form.php"); ?>

		<input type='hidden' name='page' value=''/>
		<input type='hidden' name='total' value="<?=$total?>"/>
	<table cellspacing="15" cellpadding="1" border="0">
		<tr>

			<td class="button"  align='right'>
				<span class="button" onClick='valid_form();' style='cursor: pointer;'>Salvar</span>
			</td>
		</tr>
	</table>
	</form>

		<?php

		}
		elseif ( strcmp($situacao[3], '0') == 0 && $evento->get_minicurso_aberto() == 0 )
		{
		?>
			<p>Inscrições nos minicursos não disponíveis.</p><br /><br />
			<p>Aos participantes interessados em nossos minicursos, pedimos que aguardem mais alguns dias para realizarem suas inscrições. Compensaremos o atraso na abertura desta opção no sistema estendendo as inscrições de minicursos em mais alguns dias além de 30 de agosto. Informamos que o prazo extra de inscrição é exclusivo para inscrições no evento e nos minicursos; a submissão de resumos será fechada impreterivelmente dia 30 de agosto.</p>
		<?php
		}
		elseif ( strcmp($situacao[3], '1') == 0 )
		{
			echo "<p>Inscrição com sucesso no seguinte minicurso:</p>";

			$participacao->find_by_codigo($pessoa->get_codigo_pessoa(),$evento->get_codigo_evento());
			$minicurso->find_by_codigo($participacao->get_codigo_minicurso());

			echo "<table cellspacing=\"15\" cellpadding=\"1\" border=\"0\" >";
			echo "			<tr>\n				" .
			"<td class='mc_titulo'><b>".$minicurso->get_titulo()."</b> </td>\n".
			"			</tr>".
			"			<tr>\n				" .
			"<td class='mc_autor2'>" . $minicurso->get_responsavel() . "</td>\n".
			"			</tr>".
			"			<tr>\n				" .
			"<td class='mc_descricao2'><b>Resumo:</b> " . $minicurso->get_descricao() . "</td>\n".
			"			</tr><tr><td></td></tr>";
			echo "</table>";
		}
		?>

</div>

<?php  require_once($foot_file);?>
