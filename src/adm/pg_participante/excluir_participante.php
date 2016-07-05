<?php
	$pessoa->find_by_codigo($_GET["codigo_pessoa"]);
	$_SESSION["pessoa"] = $pessoa;
?>

<div id='content'>
<div class='post'>
	<div class='content'>
	<div id='menu' >
			<ul><li class='excluir'><a href='#' title=''><center>Excluir Participante</center></a></li></ul>
	</div>

	<table>
		<tr> 
			<td height='10' colspan='2'></td> 
		</tr> 
	</table>
	
	<form method='POST' name='formulario' action='action/participante_action.php'>
	<?php
		include("form/participante_form.php");
	?>	
	<input type='hidden' name='page' value='remove_pessoa'/>


	<table border="0" width="100%" > 
		<tr> 
			<td align="right" colspan="2">
				<input type="submit" value=" Excluir " class="button_excluir">
			</td> 
		</tr>
	</table>
	</form>

	</div>
</div>

</div>
