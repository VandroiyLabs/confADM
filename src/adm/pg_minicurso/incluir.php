<div id="content">
<div class="post">
	<div class='content'>
	
	<h2>Novo minicurso</h2>

	<form method="POST" name="formulario" action="action/action.php" onsubmit="return valid_form()">
	<?php
		$minicurso = new Minicurso();
		include("form/form.php"); 
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
