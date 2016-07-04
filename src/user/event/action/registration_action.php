<?php

require_once('~/public_html/sifsc/user/classes/class.pessoa.php');
require_once('~/public_html/sifsc/user/classes/class.inscricao.php');
require_once('~/public_html/sifsc/user/classes/class.evento.php');



include("~/public_html/sifsc/user/error_handler.php");

session_start();
require_once("~/public_html/sifsc/user/event/secao.php");


if ( $evento->get_aberto() == '1' )
{

	$pessoa->set_nome($_POST["nome"]);
	$pessoa->set_nusp($_POST["nusp"]);
	$pessoa->set_cpf($_POST["icpf"]);

	$orientador = $inscricao->get_orientador();
	$inscricao->set_orientador($orientador);

	$grupo = $inscricao->get_grupo();
	$inscricao->set_grupo($grupo);

	if($_POST["instituicao"] == 'IFSC-USP')
	{
		$inscricao->set_instituicao($_POST["instituicao"]);
	}
	else
	{
		$inscricao->set_instituicao($_POST["outrainstituicao"]);
		$inscricao->set_premio('0');
	}

	if($_POST["nivel"] == 'Outro')
	{
		$inscricao->set_nivel($_POST["outronivel"]);
	}
	else
	{
		$inscricao->set_nivel($_POST["nivel"]);
	}

	if($_POST["curso"] == 'Outro')
	{
		$inscricao->set_curso("==" . $_POST["outrocurso"]);
	}
	else
	{
		$inscricao->set_curso($_POST["curso"]);
	}

	$inscricao->seta_modalidade(1,0);

	if($pessoa->update() && $inscricao->update())
	{

		$_SESSION["pessoa"] = $pessoa;
		$_SESSION["inscricao"] = $inscricao;

		$_SESSION['msg'] = 'Feito! Seus dados já foram atualizados.';

		if ( !isset( $_SESSION['adm_usuario'] ) )
		{
			echo "<script language=\"javascript\">location=(\"http://sifsc.ifsc.usp.br/user/event/registration.php\");</script>";
		}
		else
		{
			echo "<script language=\"JavaScript\">history.back();</script>";
		}

	}

}
else
{
	$_SESSION['msg'] = 'Período de inscrições encerrado!';
	echo "<script language=\"JavaScript\">history.back();</script>";
}
?>
