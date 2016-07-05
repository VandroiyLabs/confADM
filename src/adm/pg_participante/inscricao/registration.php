<?php
	
?>

	<div id='menu' >
		<ul><li class='incluir'><a href='#' title=''><center>Dados Pessoais</center></a></li></ul>
	</div>
	<script type="text/javascript" language="javascript" src="./../../user/event/script/registration_script.js" ></script>

<form method="POST" name="formulario" action="http://sifsc.ifsc.usp.br/user/event/action/registration_action.php">


	<?php
			
		include("./../../user/event/form/registration_form.php");
	?>

		<table cellspacing="15" cellpadding="1" border="0"  width="100%">
		<tr> 
			<td colspan='2' align='right'>
				<input type="button" class="button_azul" onClick='valid_form();' value=" Salvar "/>
			</td>
		</tr>
		</table>
		<input type='hidden' name='page' value=''/>
		<script language="JavaScript">valid_fields();</script>
	</form>
