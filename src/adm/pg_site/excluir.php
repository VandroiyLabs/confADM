<div id="content">
<div class="post">
	<div class='content'>
	<div id='menu' >
			<ul><li class='excluir'><a href='#' title=''><center>Excluir Capítulo</center></a></li></ul>
	</div>

	<table>
		<tr> 
			<td height='10' colspan='2'></td> 
		</tr> 
	</table>

	<form method="POST" name="formulario" action="action/evento_action.php">
	<?php
		$evento = new Evento();
		$evento->find_by_codigo($_GET["codigo_evento"]);
		$_SESSION["evento"] = $evento;
		
		include("form/evento_form.php"); 
	?>
	<table border='0' width='100%' > 
	<tr> 
		<td align='right' colspan='2'>
			<input type="submit" value=" Excluir " class="button_excluir">
		</td> 
	</tr>
	</table>

	<input type='hidden' name='page' value='remove'/>
	</form>

	</div>
</div>

</div><!--Content-->
