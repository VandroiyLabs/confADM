<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.pessoa.php");
require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.inscricao.php");
require_once($home . "public_html/sifsc/user/classes/class.arte.php");

if ( !isset($_SESSION["arte"]) )
{
	echo "<script language=\"JavaScript\">history.back();</script>";
}
require_once("./../../user_edition_variables.php");
require_once($head_file);
include($home . "public_html/sifsc/user/event/index.php");


?>

<div id="user_system">

	<div id="titulo_form_secao">
		Submissão de obra de arte
	</div>

	<?php
		if($evento->get_inscricao_aberta() == '1')
		{
	?>
			<div id="status">

				<p>Ao submeter, a organização do SIFSC 3 passará a considerar sua obra ou apresentação como confirmadas para o evento. Após submetê-la, você não poderá mais modificar seus dados.</p>

				<p>Tem certeza que deseja submeter?</p>

				<p><a class="submeter_chamativo" href="arte_submit_action.php">Sim, quero submeter minha obra ou apresentação</a></p>
			</div>
	<?php
		}
		else
		{
	?>
		<p>Inscrições encerradas.</p>
	<?php
		}
	?>

</div>

<?php

	require_once($foot_file);
?>
