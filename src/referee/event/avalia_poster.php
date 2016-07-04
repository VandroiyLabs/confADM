<?php

require_once("~/public_html/sifsc/user/classes/class.avaliador.php");
require_once("~/public_html/sifsc/user/classes/class.evento.php");
require_once("~/public_html/sifsc/user/classes/class.inscricao.php");
require_once("~/public_html/sifsc/user/classes/class.resumo.php");
require_once("~/public_html/sifsc/user/classes/class.autor.php");
require_once("~/public_html/sifsc/user/classes/class.avalia_poster.php");

session_start();
require_once("../referee_edition_variables.php");
require_once($head_file);


require_once("~/public_html/sifsc/referee/event/secao.php");
require_once("~/public_html/sifsc/referee/restricted.php");

include('index.php');

$inscricao = new Inscricao();
$ok=1;
if(isset( $_GET["codigo"]) and  $_GET["codigo"] != 0)
{
	$inscricao->find_by_pessoa_evento( $_GET["codigo"], $evento->get_codigo_evento() );
	$avalia_poster = new AvaliaPoster();
	if(!$avalia_poster->find_by_codigo_avaliador($avaliador->get_codigo_avaliador(),$_GET["codigo"],$_GET["codigo"],$evento->get_codigo_evento()))
	$ok=0;
}
else
{
	$ok=0;
}

if($ok==0)
{
echo "<script language=\"javascript\">location=(\"./workshop_home.php\");</script>";
exit();
}
?>



<div id="user_system">
	
	<div id="titulo_form_secao">
		Workshop
	</div>	
		
		<?php 
						
			include('show_poster.php');
		?>
		
</div>

<?php
	require_once("~/public_html/sifsc/referee/event/session.php");

	require_once($foot_file);
?>
