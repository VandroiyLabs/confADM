<?php
$home = "/home/" . get_current_user() . "/";

include($home . 'public_html/sifsc/adm/error_handler.php');
require_once('../../../user/classes/class.administrador.php');
require_once('../../../user/classes/class.inscricao.php');
require_once('../../../user/classes/class.evento.php');
require_once('../../../user/classes/class.pessoa.php');
require_once('../../../user/classes/class.resumo.php');
require_once('../../../user/classes/class.deferimento.php');
require_once('../../../user/classes/class.log.php');
session_start();

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

require_once($home . 'public_html/sifsc/adm/secao.php');
include($hom . "public_html/sifsc/adm/restricted.php");


if(isset($_POST['action']) && isset($_POST['tipo']) && isset($_POST['codigo_pessoa']) && isset($_POST['codigo_evento']) && isset($_POST['pagina_atual']))
{
	$pessoa = new Pessoa();
	$evento = new Evento();
	$inscricao = new Inscricao();

	$pessoa->find_by_codigo($_POST["codigo_pessoa"]);
	$evento->find_evento_aberto();
	$inscricao->find_by_pessoa_evento($pessoa->get_codigo_pessoa(), $evento->get_codigo_evento());

	//deferir arte - comissão
	if($_POST['action']=='deferir' && $_POST['tipo']== 'arte')
	{
		$assunto = $evento->get_tag_email() . " Situação arte"	;
		$nome = explode(" ", $pessoa->get_nome());
		$nome = $nome[0];
		$mensagem = "Caro(a) " . $nome . ",\n\n";
		$mensagem = $mensagem."sua obra/apresentação artística foi deferida pela organização.\n\n";
		$mensagem = $mensagem . $evento->get_assinatura_email();

		$inscricao->set_situacao_arte(4);
		$inscricao->seta_modalidade(4,4);

		$log = new Log();
		$log->set_adm_usuario( $adm->get_usuario() );
		$log->set_codigo_evento( $_POST["codigo_evento"] );
		$log->set_operacao( 'Deferir arte' );
		$log->set_detalhes( 'codigo_arte = ' . $inscricao->get_codigo_arte() . ' :: codigo_pessoa = ' . $_POST["codigo_pessoa"] . '' );

		if($inscricao->update_no_form() and $log->insert() )
		{
			$_SESSION["msg"] = "Obra/apresentação artística deferida com sucesso.";
			$pessoa->manda_email($assunto, $mensagem);
			echo "<script language=\"javascript\">location = \"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp=".$_POST['codigo_pessoa']."\";</script>";
		}


	}//indeferir arte - comissão
	elseif($_POST['action']=='indeferir' && $_POST['tipo']== 'arte')
	{


		$inscricao->set_situacao_arte(3);
		$inscricao->seta_modalidade(3,4);
		$assunto = $evento->get_tag_email() . " Situação arte"	;
		$nome = explode(" ", $pessoa->get_nome());
		$nome = $nome[0];
		$mensagem = "Caro(a) " . $nome . ",\n\n";
		$mensagem .= "sua obra/apresentação artística foi indeferida pela organização.\n\n";
		$mensagem .= "Comentário da organização:\n ------------------------- \n";
		$mensagem .= $_POST["comentario_direto"] . "\n ------------------------- \n\n";
		$mensagem .= "Para entrar em contato com a organização, você pode usar o sistema web.\n\n";
		$mensagem .=  $evento->get_assinatura_email();

		$deferimento = new Deferimento();

		$deferimento->set_codigo_evento($_POST["codigo_evento"]);
		$deferimento->set_codigo_pessoa($_POST["codigo_pessoa"]);
		$deferimento->set_codigo_resumo(0);
		$deferimento->set_codigo_arte($inscricao->get_codigo_arte());
		$deferimento->set_comentario($_POST["comentario_direto"]);
		$deferimento->set_adm_usuario($adm->get_usuario());
		$deferimento->set_adm_tipo($adm->get_tipo());
		$deferimento->set_desconta_ponto(0);

		$log = new Log();
		$log->set_adm_usuario( $adm->get_usuario() );
		$log->set_codigo_evento( $_POST["codigo_evento"] );
		$log->set_operacao( 'Indeferir arte' );
		$log->set_detalhes( 'codigo_arte = ' . $inscricao->get_codigo_arte() . ' :: codigo_pessoa = ' . $_POST["codigo_pessoa"] . '' );

		if($inscricao->update_no_form() and $deferimento->insert() and $log->insert() )
		{
			$_SESSION["msg"] = "Obra/apresentação artística indeferida com sucesso.";
			$pessoa->manda_email($assunto, $mensagem);
			echo "<script language=\"javascript\">location = \"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp=".$_POST['codigo_pessoa']."\";</script>";
		}

	}//deferir resumo - ambos & editar/enviar resumo para comissão
	elseif( ( $_POST['action']=='deferir' && $_POST['tipo']== 'resumo' )  OR  ( $adm->get_tipo() == '2' && $_POST['action'] == 'indeferir' && $_POST['tipo'] == 'resumo' && $_POST['direto'] == '0' && $_POST["desconta_ponto"] == '0' )  )
	{
		if($adm->get_tipo() == '2')
		{
			$log = new Log();
			$log->set_adm_usuario( $adm->get_usuario() );
			$log->set_codigo_evento( $_POST["codigo_evento"] );
			$log->set_operacao( 'Deferir resumo' );

			$corregido = 'com correcao';
			if ( $_POST['action'] == 'deferir' )
			{
				$corregido = '';
			}

			$log->set_detalhes( 'Deferido ' . $corregido . ' pela Biblioteca = ' . $adm->get_usuario() . ' :: codigo_resumo = ' . $inscricao->get_codigo_resumo() . ' :: codigo_pessoa = ' . $_POST["codigo_pessoa"] . '' );

			$inscricao->set_situacao_deferimento(1);

			if ( $inscricao->update_no_form() and $log->insert() )
			{
				$_SESSION["msg"] = "Resumo deferido com sucesso.";
				echo "<script language=\"javascript\">location = \"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp=".$_POST['codigo_pessoa']."\";</script>";
			}

		}
		else
		{
			$inscricao->set_situacao_deferimento(2);
			$inscricao->set_situacao_resumo(5);
			$inscricao->seta_modalidade(5,1);
			if($inscricao->get_codigo_resumo_ingles() != 0)
			{
				$inscricao->seta_modalidade(5,2);
			}


			$assunto = $evento->get_tag_email() . " Situação resumo"	;
			$nome = explode(" ", $pessoa->get_nome());
			$nome = $nome[0];
			$mensagem = "Caro(a) " . $nome . ",\n\n";
			$mensagem .= "seu resumo foi deferido pela organização.\n\n";
			$mensagem .= $evento->get_assinatura_email();

			$log = new Log();
			$log->set_adm_usuario( $adm->get_usuario() );
			$log->set_codigo_evento( $_POST["codigo_evento"] );
			$log->set_operacao( 'Deferir resumo' );
			$log->set_detalhes( 'Deferido pela organizacao = ' . $adm->get_usuario() . ' codigo_resumo = ' . $inscricao->get_codigo_resumo() . ' :: codigo_pessoa = ' . $_POST["codigo_pessoa"] . '' );

			if ( $inscricao->update_no_form() and $log->insert() )
			{
				$_SESSION["msg"] = "Resumo deferido com sucesso.";
				$pessoa->manda_email($assunto, $mensagem);
				echo "<script language=\"javascript\">location = \"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp=".$_POST['codigo_pessoa']."\";</script>";
			}

		}

	}//Para correção do usuário - ambos
	elseif($_POST['action']=='indeferir' && $_POST['tipo']== 'resumo' && $_POST['direto']== '0' && ( ( $_POST["desconta_ponto"] == '1' && $adm->get_tipo() == 2) || ( $adm->get_tipo() != 2 ) ) )
	{
		$assunto = $evento->get_tag_email() . " Situação do seu resumo"	;
		$nome = explode(" ", $pessoa->get_nome());
		$nome = $nome[0];
		$mensagem = "Caro(a) " . $nome . ",\n\n";
		$mensagem .= "existem alterações a serem feitas em seu resumo. Veja o comentário a seguir:\n\n";
		$mensagem .= "Comentário da organização:\n ------------------------- \n";
		$mensagem .= $_POST["comentario_temp"] . "\n ------------------------- \n\n";
		$mensagem .= "Por favor, entre em sua área de usuário, corrija seu resumo e submeta-o novamente: sifsc.ifsc.usp.br\n\n";
		$mensagem .= $evento->get_assinatura_email();

		$deferimento = new Deferimento();

		$deferimento->set_codigo_evento($_POST["codigo_evento"]);
		$deferimento->set_codigo_pessoa($_POST["codigo_pessoa"]);
		$deferimento->set_codigo_arte(0);
		$deferimento->set_codigo_resumo($inscricao->get_codigo_resumo());
		$deferimento->set_comentario($_POST["comentario_temp"]);
		$deferimento->set_adm_usuario($adm->get_usuario());
		$deferimento->set_adm_tipo($adm->get_tipo());

		if($adm->get_tipo()=='2') 	$deferimento->set_desconta_ponto($_POST["desconta_ponto"]);
		else						$deferimento->set_desconta_ponto(0);

		$log = new Log();
		$log->set_adm_usuario( $adm->get_usuario() );
		$log->set_codigo_evento( $_POST["codigo_evento"] );
		$log->set_operacao( 'Indeferir resumo' );
		$log->set_detalhes( 'Correção permitida :: codigo_resumo = ' . $inscricao->get_codigo_resumo() . ' :: codigo_pessoa = ' . $_POST["codigo_pessoa"] . '' );

		$inscricao->set_situacao_deferimento(0);
		$inscricao->seta_modalidade(3,1);
		$inscricao->set_situacao_resumo(3);

		if ( $inscricao->get_codigo_resumo_ingles() != 0 )
		{
			$inscricao->seta_modalidade(3,2);
		}

		if ( $inscricao->update_no_form() and $deferimento->insert() and $log->insert() )
		{
			$_SESSION["msg"] = "Resumo indeferido com sucesso.";
			$pessoa->manda_email($assunto, $mensagem);
			echo "<script language=\"javascript\">location = \"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp=".$_POST['codigo_pessoa']."\";</script>";
		}


	}//indeferir permanentemente pela comissão
	elseif($_POST['action']=='indeferir' && $_POST['tipo']== 'resumo' && $_POST['direto']== '1' && $adm->get_tipo() != 2 )
	{

		// Escrevendo a mensagem para enviar por e-mail

		$assunto = $evento->get_tag_email() . " Seu resumo foi indeferido";
		$nome = explode(" ", $pessoa->get_nome());
		$nome = $nome[0];
		$mensagem = "Caro(a) " . $nome . ",\n\n";
		$mensagem .= "a organização da SIFSC indeferiu seu resumo. Veja o comentário a seguir:\n\n";
		$mensagem .= "Comentário da organização:\n ------------------------- \n";
		$mensagem .= $_POST["comentario_temp"] . "\n ------------------------- \n\n";
		$mensagem .= "Caso queira entrar em contato, você pode acessar sua área de usuário no site sifsc.ifsc.usp.br e usar a seção Fale Conosco.\n\n";
		$mensagem .= $evento->get_assinatura_email();


		// Atualizando dados no banco

		$deferimento = new Deferimento();

		$deferimento->set_codigo_evento($_POST["codigo_evento"]);
		$deferimento->set_codigo_pessoa($_POST["codigo_pessoa"]);
		$deferimento->set_codigo_arte(0);
		$deferimento->set_codigo_resumo($inscricao->get_codigo_resumo());
		$deferimento->set_comentario($_POST["comentario_direto"]);
		$deferimento->set_adm_usuario($adm->get_usuario());
		$deferimento->set_adm_tipo($adm->get_tipo());
		$deferimento->set_desconta_ponto(0);


		$inscricao->set_situacao_deferimento(2);

		$inscricao->set_situacao_resumo(4);
		$inscricao->seta_modalidade(4,1);

		if($inscricao->get_codigo_resumo_ingles() != 0)
		{
			$inscricao->seta_modalidade(4,2);
		}

		$log = new Log();
		$log->set_adm_usuario( $adm->get_usuario() );
		$log->set_codigo_evento( $_POST["codigo_evento"] );
		$log->set_operacao( 'Indeferir resumo' );
		$log->set_detalhes( 'Indeferido permanentemente :: codigo_resumo = ' . $inscricao->get_codigo_resumo() . ' :: codigo_pessoa = ' . $_POST["codigo_pessoa"] . '' );

		if ( $inscricao->update_no_form() and $deferimento->insert() and $log->insert() )
		{
			$_SESSION["msg"] = "Resumo indeferido com sucesso.";
			$pessoa->manda_email($assunto, $mensagem);
			echo "<script language=\"javascript\">location = \"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php#topo?p1=showpessoa&cp=".$_POST['codigo_pessoa']."\";</script>";
		}

	}

}
else
{
	echo "<script language=\"javascript\">history.back();</script>";
}
?>
