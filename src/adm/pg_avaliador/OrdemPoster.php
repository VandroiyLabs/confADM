<?php
$home = "/home/" . get_current_user() . "/";
require_once($home . 'public_html/sifsc/user/classes/class.avaliacao.php');
require_once($home . 'public_html/sifsc/user/classes/class.avalia_poster.php');
require_once($home . 'public_html/sifsc/user/classes/class.inscricao.php');
require_once($home . 'public_html/sifsc/user/classes/class.pessoa.php');
?>

<div id="content">

<div class="post">
<div class="content">
<h2>Ordem para Posters</h2>


<table border=0 style="table-layout:fixed; height:500px;">
<tr>
<th align="left" width="70px">Cod.</th>
<th width="300px" align="left">Nome</th>
<th align="left">Grupo</th>
<th width="50px">Sec</th>
</tr>


<?php

$evento = new Evento();
$evento->find_evento_aberto();

$inscricao = new Inscricao();
$consulta = $inscricao->find_by_evento_situacao_resumo_by_grupo($evento->get_codigo_evento(), 5);


$secoes = array(1,2,3,4);

$partsecs = array(
	1 => array(),
	2 => array(),
	3 => array(),
	4 => array()
	);

$j = array( 1 => 0, 2 => 0, 3 => 0, 4 => 0);

while ( $row = mysql_fetch_object($consulta) )
{
	$pessoa = new Pessoa();
	$pessoa->find_by_codigo($row->codigo_pessoa);

	$avaliacao = new AvaliaPoster();
	$avaliacao->find_by_codigo($row->codigo_pessoa, $evento->get_codigo_evento());

	$curr_sec = $avaliacao->get_secao();
	if( in_array( $curr_sec , $secoes) )
	{

		if ( strcmp( $row->nivel, 'Graduacao') == 0 )
		{
			$codigoresumo = "IC" . $pessoa->get_codigo_pessoa();
		}
		elseif ( strcmp( $row->nivel, 'Doutorado') == 0 or strcmp( $row->nivel, 'Mestrado') == 0 )
		{
			$codigoresumo = "PG" . $pessoa->get_codigo_pessoa();
		}
		else
		{
			$codigoresumo = "OT" . $pessoa->get_codigo_pessoa();
		}


		$string = "<tr />";

		$string .= "<th align=\"left\" width=\"70px\">" . $codigoresumo . '</th>';
		$string .= "<th width=\"300px\" align=\"left\">" . $pessoa->get_nome() . '</th>';
		$string .= "<th align=\"left\">" . $row->grupo . '</th>';
		$string .= "<th width=\"50px\">" . $curr_sec. '</th>';
		$string .= "</tr>";

		$partsecs[ $curr_sec ][ $j[$curr_sec] ] = $string;
		$j[$curr_sec] += 1;
	}
}


while ( $j[1] + $j[2] + $j[3] + $j[4] > 0 )
{
	if ($j[1] > 0)
	{
		echo $partsecs[ 1 ][ $j[1] ];
		$j[1] -= 1;
	}
	if ($j[2] > 0)
	{
		echo $partsecs[ 2 ][ $j[2] ];
		$j[2] -= 1;
	}
	if ($j[3] > 0)
	{
		echo $partsecs[ 3 ][ $j[3] ];
		$j[3] -= 1;
	}
	if ($j[4] > 0)
	{
		echo $partsecs[ 4 ][ $j[4] ];
		$j[4] -= 1;
	}

	if ($j[2] - $j[3] > 1)
	{
		echo $partsecs[ 2 ][ $j[2] ];
		$j[2] -= 1;
	}
}


?>


</table>

</div>
</div>
</div>
