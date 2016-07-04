<?php 
	require_once("../user_edition_variables.php");
	require_once($head_file);
?>

	<h1>Área do usuário - Recupere sua senha</h1>
	
	<div id="texto">
		
		<p>Já tem uma conta e esqueceu sua senha? Forneça seu e-mail e lhe enviaremos uma senha nova.</p>
		<br />
	
		<div id="login_">
			
	      	<form name="mail_form" action="reset_password_action.php" method="post" class="boxed">
					
			<fieldset>		
				<table>
					
					<tr>
						<td width="50px">E-mail</td>
						<td width="150px"><input type="text" name="email" id="input_email" value="" class="textfield" size="30"/></td>
					</tr>
					<tr>
						<td colspan = 2 align="right">
							<br />
							<span class="button" onClick="document.mail_form.submit();" style='cursor: pointer;'>Enviar senha</span>
						</td>
					</tr>
				</table>
			</fieldset>
			</form>
		</div>
		
	</div>

<?php require_once($foot_file);?>	
