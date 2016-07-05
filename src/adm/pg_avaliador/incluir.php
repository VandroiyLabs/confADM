<div id="content">
<div class="post">
	<div class='content'>
	<div id='menu' >
		<ul><li class='incluir'><a href='#' title=''><center>Incluir Avaliador</center></a></li></ul>
	</div>
	<table>
		<tr> 
			<td height='12' colspan='2'></td> 
		</tr> 
	</table>

	<form method="POST" name="formulario" action="action/avaliador_action.php" onsubmit="return valid_form()">
	<?php
		$avaliador = new Avaliador();
		include("form/avaliador_form.php"); 
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
	
	<input type='hidden' name='page' value='incluir'/>
	</form>

	</div>
</div>

</div>
