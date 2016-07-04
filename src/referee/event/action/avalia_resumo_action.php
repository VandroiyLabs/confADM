<?php
require_once("~/public_html/sifsc/user/classes/class.avaliador.php");
require_once("~/public_html/sifsc/user/classes/class.evento.php");
require_once("~/public_html/sifsc/user/classes/class.nota_resumo.php");
session_start();

require_once("~/public_html/sifsc/referee/event/secao.php");
require_once("~/public_html/sifsc/referee/restricted.php");


if(isset( $_POST["codigo"]) and  $_POST["codigo"] != 0)
{	
	$nota_resumo = new NotaResumo();
	$nota_resumo->find_by_codigo($avaliador->get_codigo_avaliador(),$_POST["codigo"],$evento->get_codigo_evento());

	if($nota_resumo->get_situacao() == 0 or $nota_resumo->get_situacao()==1 )
	{
		$Q1i = str_replace(" ", "",$_POST["Q1i"]);
		$Q1d = str_replace(" ", "",$_POST["Q1d"]);

		$Q2i = str_replace(" ", "",$_POST["Q2i"]);
		$Q2d = str_replace(" ", "",$_POST["Q2d"]);

		$Q3i = str_replace(" ", "",$_POST["Q3i"]);
		$Q3d = str_replace(" ", "",$_POST["Q3d"]);


		$nota_resumo->set_Q1($Q1i.".".$Q1d);
		$nota_resumo->set_Q2($Q2i.".".$Q2d);
		$nota_resumo->set_Q3($Q3i.".".$Q3d);
		$nota_resumo->set_Q4('0.0');
		$nota_resumo->set_Q5('0.0');
		
		$nota_resumo->set_situacao(1);
	
		if($nota_resumo->update())
		{

			$_SESSION['msg'] = "Resumo avaliado com sucesso!";
			echo "<script language=\"javascript\">location=(\"../avalia_resumo.php?codigo=".$_POST['codigo']."\");</script>";

		}
	}
}
else
{
	$_SESSION['msg'] = "Ocorreu um erro inesperado, desculpe!";
	echo "<script language=\"javascript\">location=(\"../avalia_resumo_home.php\");</script>";
}
?>
