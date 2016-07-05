<div id="content">
<div class="post">
	<div class='content'>

	<h2>Incluindo novo administrador</h2>
	
	<form method="POST" name="formulario" action="action/adm_action.php" onsubmit="return valid_form()">
	<?php
		$adm_novo = new Administrador();
		include("form/adm_form.php"); 
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
	
	<input type='hidden' name='action' value='insert'/>
	</form>

	</div>
</div>

</div>
