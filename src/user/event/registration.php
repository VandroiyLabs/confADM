<?php

	require_once("~/public_html/sifsc/user/classes/class.pessoa.php");
	require_once("~/public_html/sifsc/user/classes/class.evento.php");
	require_once("~/public_html/sifsc/user/classes/class.inscricao.php");
	session_start();
	require_once("./../user_edition_variables.php");
	require_once($head_file);

	require_once("~/public_html/sifsc/user/restricted.php");
	require_once("~/public_html/sifsc/user/event/secao.php");

	$outro='checked';


?>

<?php include('index.php'); ?>

<div id="user_system">

	<script type="text/javascript" language="javascript" src="./script/registration_script.js" ></script>

	<div id="titulo_form_secao">
		Dados Pessoais
	</div>

	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "		<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
	?>


	<form method="POST" name="formulario" action="http://sifsc.ifsc.usp.br/user/event/action/registration_action.php">
		<table cellspacing="15" cellpadding="1" border="0" width="100%">
		<tr>
				<td align='center' ><div id="link_senha">
				<b>Caso tenha recuperado seu cadastro do ano passado, <br />confirme seus dados institucionais.</b></div>
				</td>
		</tr>

		<tr>
				<td align='center' ><div id="link_senha">
				<a href="http://sifsc.ifsc.usp.br/user/event/senha.php">Mudar Senha</a></div></td>
						</tr>
		</table>

		<?php
			include("~/public_html/sifsc/user/event/form/registration_form.php"); 
		?>
		<table cellspacing="15" cellpadding="1" border="0"  width="100%">
		<tr>
			<td class="button" colspan='2' align='right'>
				<span class="button" onClick='valid_form();' style='cursor: pointer;'>Salvar</span>
			</td>
		</tr>
		</table>
		<input type='hidden' name='page' value=''/>
		<script language="JavaScript">valid_fields();</script>
	</form>

</div>

<?php require_once($foot_file);?>
