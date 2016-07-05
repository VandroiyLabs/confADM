<?php
$home = "/home/" . get_current_user() . "/";
include($home . 'public_html/sifsc/adm/error_handler.php');
require_once('./../../../user/classes/class.avaliador.php');
require_once('./../../../user/classes/class.avaliacao.php');
require_once('./../../../user/classes/class.avalia_poster.php');
require_once('./../../../user/classes/class.inscricao.php');
require_once('./../../../user/classes/class.evento.php');
require_once('./../../../user/classes/class.administrador.php');
require_once('./../../../user/classes/class.log.php');

session_start();
$ok=1;

/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
require_once($home . "public_html/sifsc/adm/restricted.php");


$secao = $_GET['secao'];

$evento = new Evento();
$evento->find_evento_aberto();

echo $evento->get_codigo_evento();

$avalia_poster = new AvaliaPoster();

/*
 * Function SorteiaSecao
 *
 * what the function does
 *
 * @param ini (int)    - inicio das tuplas
 * @param limite (int) - quantos pegar a partir de ini
 * @param secao (int)  - secao em que os resumos serao colocados
 * @param evento (int) - evento em que esta ocorrendo o sorteio
 *
 * @return okay (int)  - Retorna 1 se tudo correu bem, 0 se houve algum problema durante as atribuicoes.
 *
 */
function SorteiaSecao($ini, $limite, $secao, $evento)
{

	// Buscando por todas inscricoes com resumo concorrendo ao poster
	$inscricao = new Inscricao();
	$consulta = $inscricao->find_by_evento_situacao_resumo($evento->get_codigo_evento(), 5, $ini, $limite);
	$avalia_poster = new AvaliaPoster();

	// Variavel para verificar se estah tudo okay
	$ok=1;
	$contador=1;

	// Inserindo inscricoes novas na roda da fortuna
	// Para garantir que novos resumos deferidos nao fiquem de fora da premiacao
	while ( $row = mysql_fetch_object($consulta) )
	{

		// Busca se a inscricao jah estah na lista para avaliacao
		if( !$avalia_poster->find_by_codigo($row->codigo_pessoa,$row->codigo_evento) )
		{
			// Caso nao esteja, adicionando...
			$avalia_poster->set_codigo_evento($row->codigo_evento);
			$avalia_poster->set_codigo_pessoa($row->codigo_pessoa);
			$avalia_poster->set_secao(0);
			$avalia_poster->set_codigo_avaliador1(0);
			$avalia_poster->set_codigo_avaliador2(0);

			if(!$avalia_poster->insert())
			{
				$ok=0;
			}
		}

		$avalia_poster->set_codigo_evento($row->codigo_evento);
		$avalia_poster->set_codigo_pessoa($row->codigo_pessoa);
		$avalia_poster->set_secao($secao);
		$avalia_poster->set_codigo_avaliador1(NULL);
		$avalia_poster->set_codigo_avaliador2(NULL);

		if(!$avalia_poster->update())
		{
			$ok=0;
		}

		$contador++;

	}
	return $ok;

}



function SorteiaSecao_separado($n1, $n2, $n3, $n4, $evento)
{

	// Buscando por todas inscricoes com resumo concorrendo ao poster
	$inscricao = new Inscricao();
	$consulta = $inscricao->find_by_evento_situacao_resumo_by_grupo($evento->get_codigo_evento(), 5);
	$avalia_poster = new AvaliaPoster();

	// Variavel para verificar se estah tudo okay
	$ok=1;
	$contador=1;

	$secao = 0;
	$nsecoes = array(
		1 => $n1,
		2 => $n2,
		3 => $n3,
		4 => $n4
	);

	$semposter = array(613, 1011, 537, 871, 173, 770, 455, 251, 134, 14, 527, 572, 1066, 790, 577, 400, 433, 703, 370, 135, 355, 715, 609, 466, 156, 582, 613);

	// Inserindo inscricoes novas na roda da fortuna
	// Para garantir que novos resumos deferidos nao fiquem de fora da premiacao
	while ( $row = mysql_fetch_object($consulta) )
	{
		$key = True;
		$newsecao = ( $secao ) % 4 + 1;
		while ($key)
		{
			if ( $nsecoes[$newsecao] >= 0 )
			{
				$secao = $newsecao;
				$nsecoes[$secao] -= 1;
				$key = False;
			}
			else
			{
				$newsecao = ( $newsecao + 1 ) % 4;
			}
		}

		if ( !in_array( $row->codigo_pessoa , $semposter ) )
		{
			// Busca se a inscricao jah estah na lista para avaliacao
			if( !$avalia_poster->find_by_codigo($row->codigo_pessoa,$row->codigo_evento) )
			{
			  // Caso nao esteja, adicionando...
			  $avalia_poster->set_codigo_evento($row->codigo_evento);
			  $avalia_poster->set_codigo_pessoa($row->codigo_pessoa);
			  $avalia_poster->set_secao(0);
			  $avalia_poster->set_codigo_avaliador1(0);
			  $avalia_poster->set_codigo_avaliador2(0);

			  if(!$avalia_poster->insert())
			  {
				  $ok=0;
			  }
			}

			$avalia_poster->set_codigo_evento($row->codigo_evento);
			$avalia_poster->set_codigo_pessoa($row->codigo_pessoa);
			$avalia_poster->set_secao($secao);
			$avalia_poster->set_codigo_avaliador1(NULL);
			$avalia_poster->set_codigo_avaliador2(NULL);

			if(!$avalia_poster->update())
			{
				$ok=0;
			}
		}
		$contador++;
	}

	return $ok;

}





# Numero de resumos deferidos
$inscricao = new Inscricao();
$consulta = $inscricao->find_by_evento_e_deferimento($evento->get_codigo_evento(), 2);
$numresumos = mysql_num_rows( $consulta );

# Numero de secoes disponiveis
$numsecoes = 4.;

# Numero medio de resumos por secao
//$resumosporsecao = intval( $numresumos/$numsecoes );
//$adicional = $numresumos % $numsecoes;
//$firstRpS = $resumosporsecao + $adicional;
//$firstRpS = $resumosporsecao + $adicional;

$nres_sec1 = intval( $numresumos*0.2 );
$nres_sec3 = intval( $numresumos*0.2666 );
$nres_sec4 = intval( $numresumos*0.2666 );
$nres_sec2 = intval( $numresumos - $nres_sec3 - $nres_sec4 - $nres_sec1 );



# Atribuindo os resumos a secoes
/*$ok =  SorteiaSecao(0,					$nres_sec1,        			1, $evento);
$ok *= SorteiaSecao($nres_sec1,				$nres_sec2+$nres_sec2, 			2, $evento);
$ok *= SorteiaSecao($nres_sec2+$nres_sec2,   		$nres_sec2+$nres_sec2+$nres_sec3,	3, $evento);
$ok *= SorteiaSecao($nres_sec2+$nres_sec2+$nres_sec3, 	$numresumos, 				4, $evento);*/


$ok =  SorteiaSecao_separado($nres_sec1, $nres_sec2 + 1, $nres_sec3 + 1, $nres_sec4 + 1, $evento);


/*
$ok =  SorteiaSecao(0, 50, 1, $evento);
$ok *= SorteiaSecao(50, 49, 2, $evento);
$ok *= SorteiaSecao(99, 49, 3, $evento);
$ok *= SorteiaSecao(148, 49, 4, $evento);
#$ok *= SorteiaSecao(197,40,5,$evento);*/


if($ok == 1)
{

	$_SESSION['msg'] = "Sorteio de seções realizado com sucesso!";

	/*$log = new Log();
	$log->set_adm_usuario( $adm->get_usuario() );
	$log->set_codigo_evento( $evento->get_codigo_evento() );
	$log->set_operacao( 'Sortear seções' );
	$log->set_detalhes( 'Sorteio de seções de avaliações de poster' );

	$log->insert();*/

	echo "<script language=\"JavaScript\">location=(\"../home.php?page=sorteio_poster\");</script>";
	exit();
}
else
{
	$_SESSION['msg'] = "Erro no sorteio!!";
	echo "<script language=\"JavaScript\">location=(\"../home.php?page=sorteio_poster\");</script>";
	exit();
}


?>
