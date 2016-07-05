<div id="content">
<div class="post">
	<div class='content'>
	<div id='menu' >
		<ul><li class='incluir'><a href='#' title=''><center>Incluir Capítulo</center></a></li></ul>
	</div>
	<table>
		<tr> 
			<td height='12' colspan='2'></td> 
		</tr> 
	</table>

	<form method="POST" name="formulario" action="action/evento_action.php" onsubmit="return valid_form()">
	<?php
		$evento = new Evento();
		include("form/evento_form.php"); 
	?>
	<table border='0' width='100%' > 
		<tr> 
			<td align='right' width="90%">
				<input type="reset" value=" Limpar " class="button" >			
			</td> 
			<td align='right' >
				<input type="submit" value=" Incluir " class="button">
			</td> 
		</tr>
	</table>

	<input type='hidden' name='page' value='insert'/>
	</form>

	</div>
</div>

</div>
