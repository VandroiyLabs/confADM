<?php

	$limite = 100;

	$PartMinic = new ParticipaMinicurso();
	$pessoa = new Pessoa();
	$inscricao = new Inscricao();
	
	if (!isset($_GET["pagina_atual"])) 
	{
		$contador_pagina = 1; 
	}
	else
	{
		$contador_pagina = $_GET["pagina_atual"]; 
	}
	
	//$consulta = $pessoa->find_by_evento($_REQUEST["codigo_evento"]); 
	$consulta = $PartMinic->find_by_minicurso_evento($_GET["codigo"], $_REQUEST["codigo_evento"]);
	
		
	while ($row = mysql_fetch_object($consulta))
	{
		$pessoa->find_by_codigo($row->codigo);
		$inscricao->find_by_pessoa_evento($row->codigo, $_REQUEST["codigo_evento"]);
		
		echo $pessoa->get_nome() . "<br />";
	}
	
	
?>
