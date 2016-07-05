<?php
	unset($_SESSION["pessoa"]);
	if(!isset($_REQUEST["codigo_evento"])){
		$evento = new Evento();
		$evento->find_evento_aberto();
		
		$_REQUEST["codigo_evento"] = $evento->get_codigo_evento();
		unset($evento);
	}

?>

<div id="content">
<div class="post">
	<div class="content">

	<?php
		$classe = 'listar';
		$message = 'Relatório de Participantes';
		include("../includes/message.php");

	?>

	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<?php		
			include("listar/por_evento.php");
		?>
	</tr>
	<tr>

	<?php
		include("listar/indice.php");
	?>

	</tr>
	</table>
	
</div>
</div>
</div>
