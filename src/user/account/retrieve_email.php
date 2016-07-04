<?php 
	require_once("../user_edition_variables.php");
	require_once($head_file);
?>

	<h1>Área do usuário - Recupere seu e-mail</h1>
	
	<div id="texto">
		
		<p>Já tem uma conta e esqueceu seu e-mail? Nós podemos buscar em nosso sistema pelo seu CPF.</p>
		<br />
	
		<div id="login_">
			
	      	<form name="mail_form" action="retrieve_email_action.php" method="post" class="boxed">
					
			<fieldset>		
				<table>
					
					<tr>
						<td width="140px">CPF (só números):</td>
						<td width="150px"><input type="text" name="cpf" id="input_email" value="" class="textfield" size="30"/></td>
					</tr>
					<tr>
						<td colspan = 2 align="right">
							<br />
							<span class="button" onClick="document.mail_form.submit();" style='cursor: pointer;'>Buscar e-mail</span>
						</td>
					</tr>
				</table>
			</fieldset>
			</form>
		</div>
		
	</div>

<?php require_once($foot_file);?>	
