<div id="content">
<div class="post">
	<div class="content">

	<h2>Alterar dados de administrador</h2>
	 
	<table>
		<tr> 
			<td height="12" colspan="2"></td> 
		</tr> 
	</table>

	<?php
		if ( strcmp($p1, "alterar") != 0 )
		{
			echo '<form method="POST" name="formulario" action="action/adm_action.php" onsubmit="return valid_form()">';
		}
		else
		{
			echo '<form method="POST" name="formulario" action="action/adm_action.php" onsubmit="return valid_form_semsenha()">';
		}
		$adm_novo = new Administrador();
		$adm_novo->find_by_usuario($_REQUEST["usuario"]);
		$_SESSION["adm_novo"] = $adm_novo;
		
		include("form/adm_form.php"); 
	?>
	<table border='0' width='100%' > 
	<tr> 
		<td align='right' colspan='2'>
			<input type="submit" value=" Atualizar " class="button">
		</td> 
	</tr>
	</table>

	<input type='hidden' name='action' value='update'/>
	</form>

	</div>
</div>

</div>
