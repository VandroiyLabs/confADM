<div id="content">
<div class="post">
	<div class='content'>

	<h2>Realmente deseja excluir este avaliador?</h2>
	
	<form method="POST" name="formulario" action="action/avaliador_action.php">
	<?php
		$avaliador = new Avaliador();
		$avaliador->find_by_codigo_avaliador($_REQUEST["codigo"]);

		
		include("form/avaliador_form.php"); 
	?>
	<table border='0' width='100%' > 
	<tr> 
		<td align='right' colspan='2'>
			<input type="submit" value=" Excluir " class="button_vermelho">
		</td> 
	</tr>
	</table>
	<input type='hidden' name='codigo' value="<?php echo$_POST['codigo'];?>"/>
	<input type='hidden' name='page' value='excluir'/>
	</form>

	</div>
</div>

</div>
