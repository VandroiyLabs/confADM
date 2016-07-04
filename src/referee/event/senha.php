<?php 

require_once("~/public_html/sifsc/user/classes/class.avaliador.php");
require_once("~/public_html/sifsc/user/classes/class.evento.php");

session_start();
require_once("../referee_edition_variables.php");
require_once($head_file);

require_once("~/public_html/sifsc/referee/restricted.php");
require_once("~/public_html/sifsc/referee/event/secao.php");

include('index.php'); 
?>

<div id="user_system">


<script type="text/javascript" language="javascript" src="http://sifsc.ifsc.usp.br/user/event/script/senha_script.js" ></script>

	
<div id="titulo_form_secao">
	Alterar Senha
</div>

<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
?>


<form method="POST" name="formulario" action="http://sifsc.ifsc.usp.br/referee/event/action/senha_action.php" >
<table cellspacing="15" cellpadding="1" border="0" >
	<tr >
		<td align="right" width="30%">Senha Antiga:</td>
		<td align="left"><input type="password" name="senha_antiga"  value="" maxlength="8"  size="27"/></td>
	</tr>
	
	<tr>
		<td align="right" width="30%">Nova Senha:</td>
		<td align="left"><input type="password" name="senha"  value=""  maxlength="8" class="textfield" size="27" /></td>
	</tr>
	<tr>
		<td align="right" width="30%">Confirme:</td>
		<td lalign="left"><input type="password" name="senha_confirm" value="" maxlength="8"  size="27" /></td>
	</tr>
<tr> 
		<td align='right' colspan='2'>

			<span class="button" onClick='valid_form();' style='cursor: pointer;'>Salvar</span>
		</td> 
	</tr>
	<tr>
				<td colspan='2' align='center'>Senha com mínimo de 6 e máximo de 8 caracteres</td>
	</tr>
</table>
		<?php if($evento->get_aberto() == 0 )
		{?>
				<script language="JavaScript">desabilita();</script>
		<?php } ?>

</form>

</div>

<?php  
require_once("~/public_html/sifsc/referee/event/session.php");

require_once($foot_file);
?>
