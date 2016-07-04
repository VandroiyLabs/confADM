<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.participante.php");
require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.inscricao.php");

session_start();
require_once("./../user_edition_variables.php");
require_once($head_file);
require_once($home . "public_html/sifsc/user/restricted.php");
require_once($home . "public_html/sifsc/user/event/status.php");
?>

<table width="100%">
	<tr align="right">
		<td><b>Olá, <?=$pessoa->get_nome();?>.&nbsp;&nbsp;&nbsp;&nbsp;</b><a href="http://sifsc.ifsc.usp.br/user/logconfig/logout.php" title="logout">Log Out</a></td>
	</tr>
</table>

<script type="text/javascript" language="javascript" src="participante_script.js" ></script>

<div id="titulo_form_secao">
	<img src="http://sifsc.ifsc.usp.br/user/images/abstract.png" height="35px" />
</div>



<?php require_once($foot_file);?>
