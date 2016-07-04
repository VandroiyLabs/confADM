<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.avaliador.php");
require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.avalia_poster.php");

session_start();

require_once("../referee_edition_variables.php");
require_once($head_file);

$secao_poster = array(
	0 =>"",
	1 =>"01 de outubro - quinta-feira -  8h",
	2 =>"01 de outubro - quinta-feira -  10h15",
	3 =>"01 de outubro - quinta-feira -  14h",
	4 =>"01 de outubro - quinta-feira -  16h");



require_once($home . "public_html/sifsc/referee/event/secao.php");
require_once($home . "public_html/sifsc/referee/restricted.php");

include('index.php');

$avalia_poster = new AvaliaPoster();


?>



<div id="user_system">


	<div id="titulo_form_secao">
		Workshop
	</div>


<?php
$total=0;

if($evento->get_avaliacao_aberta() == 1)
{
	$ok=0;
	for($j=1; $j<=4; $j++)
	{
		$consulta = $avalia_poster->find_by_codigo_avaliador_evento_secao($avaliador->get_codigo_avaliador(),$evento->get_codigo_evento(),$j);
		$total = mysql_num_rows($consulta);
		if($total > 0)
		{
			$ok+=$total;
			echo "<p class=\"titulo\"> Sessão $j - $secao_poster[$j]</p>";
			while($row = mysql_fetch_object($consulta))
			{
				if($row->nivel == 'Mestrado' or $row->nivel == 'Doutorado')
					$painel="PG";
				elseif($row->nivel == 'Graduacao')
					$painel = "GR";
				else
					$painel = "OT";

				echo "<p> <a href=\"http://sifsc.ifsc.usp.br/referee/event/avalia_poster.php?codigo=".$row->codigo_pessoa."\">Painel $painel $row->codigo_pessoa - ".$row->titulo."</a></p>";

			}	echo "<br /><br />";
		}
	}


	if($ok == 0)
	echo "<p class=\"titulo\"> Nenhuma avaliação associada.</p>";
}
else
{
	echo "<p class=\"titulo\"> Resumos ainda não disponíveis.</p>";
}

?>

</div>

<?php
	require_once($home . "public_html/sifsc/referee/event/session.php");
	require_once($head_file);
?>
