<?php

require_once('./../../../user/classes/class.conexao.php');
$page = $_POST["page"];

if($page == 'backup'){

	
	$conexao = new Conexao();

	$consulta = $conexao->backup_bd();
	$conexao = null;
	
	echo "<script language=\"JavaScript\">alert(\"Backup Realizado com Sucesso !\");location=(\"../home.php?page=$page\");</script>";
}
else
	echo "<script language=\"JavaScript\">alert(\"Erro !\");location=(\"../home.php?page=$page\");</script>";
?>

