<div id="content">
<div class="post">
	<div class='content'>
	
	<h2>Tem certeza que quer deletar este administrador?</h2>

	<form method="POST" name="formulario" action="action/adm_action.php">
	<?php
		$adm_novo = new Administrador();
		$adm_novo->find_by_usuario($_REQUEST["usuario"]);
		$_SESSION["adm_novo"] = $adm_novo;
		
		include("form/adm_form.php"); 
	?>
	<table border='0' width='100%' > 
	<tr> 
		<td align='right' colspan='2'>
			<input type="submit" value=" Excluir " class="button_excluir">
		</td> 
	</tr>
	</table>

	<input type='hidden' name='action' value='remove'/>
	</form>

	</div>
</div>

</div>
