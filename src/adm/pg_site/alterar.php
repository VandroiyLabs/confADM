<div id="content">
<div class="post">
	<div class='content'>

	<?php
		$classe = 'listar';
		$message = 'Alterar Dados';
		include("../includes/message.php");
	?>
	</table>

	<form method="POST" name="formulario" action="action/evento_action.php" onsubmit="return valid_form()">
	<?php
		$evento = new Evento();
		$evento->find_by_codigo($_GET["codigo_evento"]);
		$_SESSION["evento"] = $evento;
		
		include("form/evento_form.php"); 
	?>
	<table border='0' width='100%' > 
	<tr> 
		<td align='right' >
			<input type="submit" value=" Atualizar " class="button">
		</td> 
	</tr>
	</table>

	<input type='hidden' name='page' value='update'/>
	</form>

	</div>
</div>

</div><!--Content-->
