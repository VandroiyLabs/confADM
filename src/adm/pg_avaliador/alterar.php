<div id="content">
<div class="post">
	<div class="content">
	<div id='menu' >
		<ul><li class='alterar'><a href='#' title=''><center>Alterar Dados</center></a></li></ul>
	</div>
	<table>
		<tr> 
			<td height="12" colspan="2"></td> 
		</tr> 
	</table>

	<form method="POST" name="formulario" action="action/avaliador_action.php" onsubmit="return valid_form()">
	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "		<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
		if(isset($_GET["codigo"])) $_POST["codigo"]=$_GET["codigo"];

		$avaliador = new Avaliador();
		$avaliador->find_by_codigo_avaliador($_POST["codigo"]);

		
		include("form/avaliador_form.php"); 

	?>
	<table border='0' width='100%' > 
	<tr> 
		<td align='right' colspan='2'>
			<input type="submit" value=" Atualizar " class="button">
		</td> 
	</tr>
	</table>
	<input type='hidden' name='codigo' value="<?php echo$_POST['codigo'];?>"/>
	<input type='hidden' name='page' value='alterar'/>
	</form>

	</div>
</div>

</div>
