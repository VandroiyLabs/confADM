<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.pessoa.php");
require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.inscricao.php");

session_start();
require_once("./../user_edition_variables.php");
require_once($head_file);
require_once($home . "public_html/sifsc/user/restricted.php");
require_once($home . "public_html/sifsc/user/event/secao.php");

?>


<?php include('index.php'); ?>

<div id="user_system">


<script type="text/javascript" language="javascript" src="http://sifsc.ifsc.usp.br/user/event/script/senha_script.js" ></script>


<div id="titulo_form_secao">
	Mudar Senha
</div>

<form method="POST" name="formulario" action="http://sifsc.ifsc.usp.br/user/event/action/senha_action.php" >
<table cellspacing="15" cellpadding="1" border="0" >
	<tr >
		<td align="right" width="30%">Senha Antiga:</td>
		<td align="left"><input type="password" name="senha_antiga"  value="" maxlength="10"  size="27"/></td>
	</tr>
	<tr>
		<td align="right" width="30%">Nova Senha:</td>
		<td align="left"><input type="password" name="senha"  value=""  maxlength="10" class="textfield" size="27" /></td>
	</tr>
	<tr>
		<td align="right" width="30%">Confirme:</td>
		<td lalign="left"><input type="password" name="senha_confirm" value="" maxlength="10"  size="27" /></td>
	</tr>
<tr>
		<td align='right' colspan='2'>

			<span class="button" onClick='valid_form();' style='cursor: pointer;'>Salvar</span>
		</td>
	</tr>
</table>
		<?php if($evento->get_aberto() == 0 )
		{?>
				<script language="JavaScript">desabilita();</script>
		<?php } ?>

</form>

</div>

<?php  require_once($foot_file);?>
