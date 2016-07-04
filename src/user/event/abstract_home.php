<?php
$home = "/home/" . get_current_user() . "/";

	require_once($home . "public_html/sifsc/user/classes/class.pessoa.php");
	require_once($home . "public_html/sifsc/user/classes/class.evento.php");
	require_once($home . "public_html/sifsc/user/classes/class.inscricao.php");
	require_once($home . "public_html/sifsc/user/classes/class.resumo.php");
	require_once($home . "public_html/sifsc/user/classes/class.autor.php");
	session_start();
	require_once("./../user_edition_variables.php");
	require_once($head_file);

	include($home . "public_html/sifsc/user/restricted.php");
	include($home . "public_html/sifsc/user/event/secao.php");


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


	include('index.php');

	$resumo = new Resumo();
	$resumo->find_by_codigo( $inscricao->get_codigo_resumo() );
	$_SESSION['resumo'] = $resumo;
	unset( $_SESSION['abstract_question'] );
?>




<div id="user_system">


	<div id="titulo_form_secao">
		Resumo
	</div>

	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
	?>

	<p class="textocorrido">Todos os participantes que desejam participar do Workshop estão convidados a submeter um resumo, <i>preferencialmente</i> em língua inglesa. Alunos de pós-graduação do IFSC devem <b>obrigatoriamente</b> participar do Workshop, utilizando essa página para submeter o resumo do seu trabalho.</p>

	<p>Abaixo você poderá ver um preview de seu último resumo salvo.</p>


	<?php
	if (($evento->get_submissao_aberta()==1 and ($inscricao->get_situacao_resumo() == 0 or $inscricao->get_situacao_resumo() == 1)) or ( $inscricao->get_situacao_resumo() == 3 and $evento->get_resubmissao_aberta()==1))
	{
	?>
	<ul>
		<li><a class="resumo" href="http://sifsc.ifsc.usp.br/user/event/abstract.php">Escrever/editar resumo</a></li>
		<?php /* <li><a href="http://sifsc.ifsc.usp.br/user/event/abstract.php?lng=1" <?php if($inscricao->get_codigo_resumo() == 0) { echo "class='closed'";}else{echo "class='resumo'";} ?>>Escrever/editar resumo em inglês (apenas depois de salvar uma versão em português)</a></li>  */ ?>

		<?php
			if ( $inscricao->get_codigo_resumo_ingles() != 0 )
			{
				echo "<li><a href=\"http://sifsc.ifsc.usp.br/user/event/abstract_dropenglishversion.php\" class='resumo'>Remover versão inglês do resumo</a></li>";
			}
		?>
 	</ul>
	<p class="textocorrido">Caso tenha dúvidas sobre a elaboração de seu resumo (e.g., referências, citação, etc), veja <a href="http://sifsc.ifsc.usp.br/downloads/Orientações_sobre_elaboração_resumos_referencias_citação.pdf" target="_blacnk">aqui um guia geral desenvolvido pelo Serviço de Biblioteca e Informação do IFSC</a>. Se precisar de fórmulas matemáticas, você pode usar LaTeX (veja um guia rápido <a href="http://sifsc.ifsc.usp.br/user/event/abstract_latex.php">aqui</a>).</p>
	<?php
	}
	?>

	<a name="submissaoresumo">
	<div id="submissao">
		<div id="titulo_secao">
			Situação do resumo
		</div>
	<?php

	if ( $inscricao->get_situacao_resumo() == 0 and $evento->get_submissao_aberta()== 1)
	{
		echo "\t\t<p>Você ainda não escreveu nenhum resumo. Sempre que salvar versões novas de seu resumo, você poderá ver como ele está ficando nesta seção.</p>";
	}
	elseif ( $inscricao->get_situacao_resumo() == 0 and $evento->get_submissao_aberta()== 0)
	{
		echo "\t\t<p>Inscrições não disponíveis.</p>";
	}

	if ( ($inscricao->get_situacao_resumo() == 1 and $evento->get_submissao_aberta()== 1 ) or ( $inscricao->get_situacao_resumo() == 3 and $evento->get_resubmissao_aberta()== 1) )
	{
		echo "<p>Após revisar bem seu resumo, você pode submetê-lo para revisão pela organização:</p>";
		echo "<p class=\"submit\"><a href=\"http://sifsc.ifsc.usp.br/user/event/action/abstract_submit_question.php\">Submeter para revisão</a></p>";

		if ( isset($_SESSION['problemas']) )
		{
			echo "<h3>Encontramos os seguintes problemas no seu resumo:</h3>";
			echo $_SESSION['problemas'];
			unset($_SESSION['problemas']);
		}

		require_once($home . "public_html/sifsc/user/classes/class.deferimento.php");
		$def = new Deferimento();
		if ( $def->find_by_evento_pessoa_resumo($evento->get_codigo_evento(), $pessoa->get_codigo_pessoa(), $inscricao->get_codigo_resumo() ) )
		{
			echo "\t\t<p>A organização sugeriu correções em seu resumo, veja: </p>\n";
			echo "<hr class=\"notadeferimentou\" /><p class=\"notadeferimento\">" . nl2br( $def->get_comentario() ) . "</p><hr class=\"notadeferimentod\" /><br />";

			if ( strcmp( $inscricao->get_nivel(), 'Graduacao') == 0 )
			{
				$codigoresumo = "IC" . $pessoa->get_codigo_pessoa();
			}
			elseif ( strcmp( $inscricao->get_nivel(), 'Doutorado') == 0 )
			{
				$codigoresumo = "PG" . $pessoa->get_codigo_pessoa();
			}
			else
			{
				$codigoresumo = "OT" . $pessoa->get_codigo_pessoa();
			}

			echo "<p>Em caso de dúvidas nas correções, entre em contato com a <a href=\"http://www.biblioteca.ifsc.usp.br/\" target=\"_blank\">Biblioteca do IFSC</a> e <b>informe a identificação de seu resumo: " . $codigoresumo . "</b>. Caso queira entrar em contato com a organização, você pode usar <a href=\"./faleconosco.php\">o nosso sistema para agilizar a comunicação</a>.</p>";
		}

	}elseif( ($inscricao->get_situacao_resumo() == 1 and $evento->get_submissao_aberta()== 0 ) or ( $inscricao->get_situacao_resumo() == 3 and $evento->get_resubmissao_aberta()== 0) )
	{
		echo "\t\t<p>Inscrições não disponíveis.</p>";
	}

	if ( $inscricao->get_situacao_resumo() == 2 )
	{
		echo "\t\t<p>Seu resumo está sendo avaliado pela comissão organizadora. Aguarde.</p>\n";
	}

	if ( $inscricao->get_situacao_resumo() == 4 )
	{
		echo "\t\t<p>Seu resumo foi indeferido pela organização. Veja o motivo:</p>\n";

		require_once($home . "public_html/sifsc/user/classes/class.deferimento.php");
		$def = new Deferimento();
		$def->find_by_evento_pessoa_resumo($evento->get_codigo_evento(), $pessoa->get_codigo_pessoa(), $inscricao->get_codigo_resumo() );

		echo "<hr class=\"notadeferimentou\" /><p class=\"notadeferimento\">" . nl2br( $def->get_comentario() ) ."</p><hr class=\"notadeferimentod\" /><br />";
	}

	if ( $inscricao->get_situacao_resumo() == 5 )
	{
		echo "\t\t<p>Seu resumo foi aceito pela comissão organizadora.</p>\n";
	}

	include('show_abstracts.php');

	?>
	</div>

</div>

<?php
 require_once($foot_file);
?>
