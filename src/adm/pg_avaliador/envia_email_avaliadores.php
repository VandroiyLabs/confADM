<div id="content">
<div class="post">
<div class='content'>


	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "		<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
	?>

	<h2>Envio de email para avaliadores </h2>

	<table>
		<tr> 
			<td height='12' colspan='2'></td> 
		</tr> 
	</table>
	
	<table border='0' width='100%' > 
		<tr>
			<td align='left' >
				<form method="POST" name="formulario" action="action/envio_email_avaliadores_action.php" >
					<input type="submit" value=" Enviar emails " class="button">
				</form>
			</td> 
		</tr>
	</table>
</div>
</div>
</div>
