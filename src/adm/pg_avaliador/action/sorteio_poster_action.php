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


/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
require_once($home . "public_html/sifsc/adm/restricted.php");


$secao = $_GET['secao'];

$evento = new Evento();
$evento->find_evento_aberto();

$avalia_poster = new AvaliaPoster();


// Estimativa de avalidores por secao
$avaliacao = new Avaliacao();
$lista_avaliadores_poster = $avaliacao->find_all_secao($evento->get_codigo_evento(),$secao);

// Essa variavel diz se ao menos um participante nao pode ter ao menos um avaliador 
// com a mesma área que o curso!
$avaliadores_especificos_esgotados = 0;

// Numero de avaliadores que carecem de avaliacao
$n_avaliadores_poster = mysql_num_rows($lista_avaliadores_poster);


// Numero de resumos que carecem de avaliacao
$n_resumos_poster = mysql_num_rows($avalia_poster->find_all_by_secao($evento->get_codigo_evento(),$secao));

// Contando quantos avaliadores precisaremos
$alpha = ceil( 2*$n_resumos_poster/$n_avaliadores_poster ) ;

// Vamos construir o vetor do qual vamos sortear os avaliadores
function vetor_avaliadores($alpha, $lista, $evento, $excluir, $ingles,$secao)
{
	// Vetor que terá a lista de avaliadores
	$vetor_orientadores = array(0 => 0);
	
	while ( $row = mysql_fetch_object( $lista ) )
	{
		$avaliador = new Avaliador();
		$avaliador->find_by_codigo_avaliador( $row->codigo_avaliador );
		
		// Excluindo o orientador do participante
		
		$ingles_aux = $ingles+1; // Fazendo um matching
		
		if ( strcmp($avaliador->get_nome(), $excluir) != 0 and ( $avaliador->get_lingua() == 3 or $ingles_aux == $avaliador->get_lingua() ) )
		{
			
			// Adicionando cada um dos orientadores
			
			// Duplicando as chances caso algum avaliador tenha as duas areas iguais
			if ( strcmp( $avaliador->get_area1(), $avaliador->get_area2() ) == 0 )
			{
				$coeficiente = 2;
			}
			else
			{
				$coeficiente = 1;
			}
						
			// Verificando quantas vezes este avaliador jah foi escolhido
			$avalia_poster = new AvaliaPoster();
			$num_avaliacoes = $avalia_poster->find_avaliacoes_by_avaliador_secao( $evento->get_codigo_evento(),$row->codigo_avaliador,$secao);
			
			// Inserindo na lista de avaliadores dadas as condicoes.
			if ( $num_avaliacoes < $alpha )
			{
				for ( $j = 0; $j < $coeficiente*( $alpha - $num_avaliacoes ); $j++ )
				{
					$vetor_orientadores[] = $row->codigo_avaliador;
				}
			}
			
		}
	}
	
	return( $vetor_orientadores );
}


//  Sorteando o primeiro avaliador primeiro
//
//*****************************************************************************
//

function SorteiaAvaliador1($consulta, $secao, $alpha, $evento)
{
	$avaliacao = new Avaliacao();


	// Variavel para verificar se estah tudo okay
	$ok=1;

	// Fazendo o sorteio de fato com preferência a avaliadores da mesma área
	while ( $row = mysql_fetch_object($consulta) )
	{
		
		// Setando a avaliacao
		$avalia_poster = new AvaliaPoster();	
		$avalia_poster->set_codigo_evento($row->codigo_evento);
		$avalia_poster->set_codigo_pessoa($row->codigo_pessoa);
		$avalia_poster->set_secao($row->secao);
		$avalia_poster->set_codigo_avaliador2($row->codigo_avaliador2);
	

		if ( $row->codigo_avaliador1 == 0)
		{
			$avaliacao = new Avaliacao();
		
			// Atualizando a lista de avaliadores de acordo com o curso do participante
			$inscricao = new Inscricao();
			$inscricao->find_by_pessoa_evento( $row->codigo_pessoa, $evento->get_codigo_evento() );


			if ( strcmp($inscricao->get_curso(), 'Física Básica') == 0 or strcmp($inscricao->get_curso(), 'Bacharelado em Física') == 0 or strcmp($inscricao->get_curso(), 'Licenciatura em Ciências Exatas') == 0 )
			{
				$lista_avaliadores_poster = $avaliacao->find_all_secao_area($evento->get_codigo_evento(), 'Física básica', $secao);
			}
			else if ( strcmp($inscricao->get_curso(), 'Física Aplicada Computacional') == 0 or strcmp($inscricao->get_curso(), 'Bacharelado em Física Computacional') == 0 )
			{
				$lista_avaliadores_poster = $avaliacao->find_all_secao_area($evento->get_codigo_evento(), 'Física computacional', $secao);
			}
			else if ( strcmp($inscricao->get_curso(), 'Física Aplicada Biomolecular') == 0 or strcmp($inscricao->get_curso(), 'Bacharelado em Ciências Físicas e Biomoleculares') == 0 )
			{
				$lista_avaliadores_poster = $avaliacao->find_all_secao_area($evento->get_codigo_evento(), 'Biomolecular', $secao);
			}
			else if ( strcmp($inscricao->get_curso(), 'Física Aplicada') == 0 )
			{
				$lista_avaliadores_poster = $avaliacao->find_all_secao_area($evento->get_codigo_evento(), 'Física aplicada', $secao);
			}
			else
			{
				$lista_avaliadores_poster = $avaliacao->find_all_secao($evento->get_codigo_evento(), $secao);
			}
		
			// Buscando o nome do orientador para exclui-lo da lista
			// de possiveis avaliadores
			$orientador = $inscricao->get_orientador();
				
			// Verificando se o participante pode ser avaliado em ingles
			if ( $inscricao->get_codigo_resumo_ingles() == 0 )
			{
				$ingles = 0;
			}
			else
			{
				$ingles = 1;
			}
		
			// Caso se esgotaram as opcoes especificas...
			$vetor = vetor_avaliadores($alpha, $lista_avaliadores_poster, $evento, $orientador, $ingles,$secao);
			$nelementos = count($vetor);
			if ( $nelementos < 2 )
			{
				$avaliadores_especificos_esgotados = 1;
				$lista_avaliadores_poster = $avaliacao->find_all_secao($evento->get_codigo_evento(), $secao);
				$vetor = vetor_avaliadores($alpha, $lista_avaliadores_poster, $evento, $orientador, $ingles,$secao);
			}	
		
			// Fazendo a o sorteio
			$doitagain = 1;
			while( $doitagain == 1 )
			{
				$randomn = rand(1, $nelementos - 1);
			
				if ( $vetor[ $randomn ] != $avalia_poster->get_codigo_avaliador2() and $vetor[ $randomn ] != 0 )
				{
					$avalia_poster->set_codigo_avaliador1( $vetor[ $randomn ] );
					$doitagain = 0;
				}
			}
			
	
		
		}
		else
		{
			$avalia_poster->set_codigo_avaliador1( $row->codigo_avaliador1 );
		}
				
		if ( !$avalia_poster->update() )
		{
			$ok=0;
		}
		
	}
	return $ok;
}



//  Sorteando o primeiro avaliador primeiro
//
//*****************************************************************************
//

function SorteiaAvaliador2($consulta, $secao, $alpha, $evento)
{
	// Variavel para verificar se estah tudo okay
	$ok=1;

	// Fazendo o sorteio de fato com preferência a avaliadores da mesma área
	while ( $row = mysql_fetch_object($consulta) )
{
	
	// Setando a avaliacao
	$avalia_poster = new AvaliaPoster();	
	$avalia_poster->set_codigo_evento($row->codigo_evento);
	$avalia_poster->set_codigo_pessoa($row->codigo_pessoa);
	$avalia_poster->set_codigo_avaliador1($row->codigo_avaliador1);
	$avalia_poster->set_secao($row->secao);
	
	
	if ( $row->codigo_avaliador2 == 0 )
	{
		$avaliacao = new Avaliacao();

		// Atualizando a lista de avaliadores 
		$lista_avaliadores_poster = $avaliacao->find_all_secao($evento->get_codigo_evento(), $secao);
				
		// Buscando o nome do orientador para exclui-lo da lista
		// de possiveis avaliadores
		$inscricao = new Inscricao();
		$inscricao->find_by_pessoa_evento( $row->codigo_pessoa, $evento->get_codigo_evento() );
		$orientador = $inscricao->get_orientador();
		
		// Verificando se o participante pode ser avaliado em ingles
		if ( $inscricao->get_codigo_resumo_ingles() == 0 )
		{
			$ingles = 0;
		}
		else
		{
			$ingles = 1;
		}
		
		// Atualizando a lista de avaliadores
		$vetor = vetor_avaliadores($alpha, $lista_avaliadores_poster, $evento, $orientador, $ingles,$secao);
		$nelementos = count($vetor);
				
		// Fazendo o sorteio
		$doitagain = 1;
		while( $doitagain == 1 )
		{
			$randomn = rand(1, $nelementos - 1);
			
			if ( $vetor[ $randomn ] != $avalia_poster->get_codigo_avaliador1() and $vetor[ $randomn ] != 0 )
			{
				$avalia_poster->set_codigo_avaliador2( $vetor[ $randomn ] );
				$doitagain = 0;
			}
		}
		if ( $avalia_poster->get_codigo_avaliador2() == '' ) echo $row->codigo_pessoa . " " . $randomn . " " . $vetor[ $randomn ] . "<br />";
		
				
	}
	else
	{
		$avalia_poster->set_codigo_avaliador2( $row->codigo_avaliador2 );
	}
				
	if ( !$avalia_poster->update() )
	{
		$ok=0;
	}

}
	return $ok;
}

// Encontrando todas as avaliacoes de resumo
$consulta = $avalia_poster->find_all_by_secao( $evento->get_codigo_evento(), $secao);
$ok1=SorteiaAvaliador1($consulta,$secao, $alpha, $evento);

#$consulta = $avalia_poster->find_all_by_secao( $evento->get_codigo_evento(), $secao);
//$ok2=SorteiaAvaliador2($consulta,$secao, $alpha, $evento);
//$ok=$ok1*$ok2;

$ok = $ok1;


if($ok == 1)
{
	if 	( $avaliadores_especificos_esgotados == 1 )
	{
		$_SESSION['msg'] = "Sorteio realizado -- nem todos têm avaliadores da mesma área";
	}
	else
	{
		$_SESSION['msg'] = "Sorteio de avaliadores realizado com sucesso!";
	}
	
	$log = new Log();
	$log->set_adm_usuario( $adm->get_usuario() );
	$log->set_codigo_evento( $evento->get_codigo_evento() );
	$log->set_operacao( 'Sortear avaliadores' );
	$log->set_detalhes( '' );
	
	$log->insert();


	
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

