<?php
$home = "/home/" . get_current_user() . "/";
require_once($home . 'public_html/sifsc/user/classes/class.administrador.php');

if( isset( $_SESSION["adm_usuario"] ) )
{
	$adm = new Administrador();
	$adm->find_by_usuario( $_SESSION["adm_usuario"] );
	$_SESSION["adm_usuario"] = $adm->get_usuario();
}
else
{
	echo "<script language=\"javascript\">" .
		"location=(\"http://sifsc.ifsc.usp.br/adm\");" .
		"</script>";

}
?>
