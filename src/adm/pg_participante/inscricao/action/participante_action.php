<?php

require_once('../../../classes/class.pessoa.php');
require_once('../../../classes/class.evento.php');
require_once('../../../classes/class.inscricao.php');
session_start();


$page = $_POST["page"];

if($page == 'insert_inscricao'){

	$pessoa = $_SESSION["pessoa"];
	$evento = $_SESSION["evento"];


	$inscricao = new Inscricao();
		
	$inscricao->set_codigo_pessoa($pessoa->get_codigo_pessoa());
	$inscricao->set_codigo_evento($evento->get_codigo_evento());

	$inscricao->set_instituicao($_POST["instituicao"]);
	$inscricao->set_nivel($_POST["nivel"]);
	$inscricao->set_curso($_POST["curso"]);
	$inscricao->set_grupo($_POST["grupo"]);
	$inscricao->set_orientador($_POST["orientador"]);
	$inscricao->set_token($_POST["token"]);
	$inscricao->set_codigo_barra($_POST["codigo_barra"]);
	$inscricao->set_modalidade($_POST["modalidade"]);
	$inscricao->set_premio($_POST["premio"]);
	$inscricao->set_dia_avaliacao($_POST["dia_avaliacao"]);
	
	if($inscricao->insert()){
		$_SESSION["inscricao"] = $inscricao;
		echo "<script language=\"javascript\">window.alert(\"Inscricao Inserida com Sucesso !\");location=(\"../../home.php?p1=detalhes&p2=inscricao&p3=update_inscricao\");</script>";	
	}
	else{
		echo "<script language=\"javascript\">window.alert(\"Erro ao inserir Inscricao !\");location=(\"../../home.php?p1=alterar&step=1\");</script>";	
	}
	
}

if($page == 'update_inscricao'){

	$inscricao = $_SESSION["inscricao"];

	$inscricao->set_instituicao($_POST["instituicao"]);
	$inscricao->set_nivel($_POST["nivel"]);
	$inscricao->set_curso($_POST["curso"]);
	$inscricao->set_grupo($_POST["grupo"]);
	$inscricao->set_orientador($_POST["orientador"]);
	$inscricao->set_token($_POST["token"]);
	$inscricao->set_codigo_barra($_POST["codigo_barra"]);
	$inscricao->set_modalidade($_POST["modalidade"]);
	$inscricao->set_premio($_POST["premio"]);
	$inscricao->set_dia_avaliacao($_POST["dia_avaliacao"]);


	if($inscricao->update()){
		//unset($_SESSION["inscricao"]);
		echo "<script language=\"javascript\">window.alert(\"Inscricao Atualizada com Sucesso !\");location=(\"../../home.php?p1=detalhes&p2=inscricao&p3=update_inscricao\");</script>";		
	}
	else{
		echo "<script language=\"javascript\">window.alert(\"Erro ao Atualizar Inscricao !\");location=(\"../../home.php?p1=alterar&step=1\");</script>";	
	}
	
}


if($page == 'remove_inscricao'){

	
	$inscricao = $_SESSION["inscricao"];

	
	if($inscricao->remove()){
		unset($_SESSION["inscricao"]);
		echo "<script language=\"javascript\">window.alert(\"Inscrição removida com sucesso!\");location=(\"../../home.php?codigo_pessoa=1&p1=detalhes&p2=eventos\");</script>";
	}
	else
		echo "<script language=\"JavaScript\">window.alert(\"Erro ao remover inscrição!\");location=(\"../../home.php?codigo_pessoa=1&p1=detalhes&p2=eventos\");</script>";

	
}
?>

