<?php
$home = "/home/" . get_current_user() . "/";
include($home . 'pubic_html/sifsc/adm/error_handler.php');
require_once('./../../../user/classes/class.avaliador.php');
require_once('./../../../user/classes/class.avaliacao.php');
require_once('./../../../user/classes/class.avalia_resumo.php');
require_once('./../../../user/classes/class.inscricao.php');
require_once('./../../../user/classes/class.nota_resumo.php');
require_once('./../../../user/classes/class.evento.php');
require_once('./../../../user/classes/class.administrador.php');
require_once('./../../../user/classes/class.log.php');

session_start();


/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
require_once($home . "public_html/sifsc/adm/restricted.php");


$evento = new Evento();
$evento->find_evento_aberto();

$avalia_resumo = new AvaliaResumo();
$nota_resumo = new NotaResumo();


// Estimativa
$avaliacao = new Avaliacao();
$lista_avaliadores_premio = $avaliacao->find_all_secao($evento->get_codigo_evento(), 0);

// Essa variavel diz se ao menos um participante nao pode ter ao menos um avaliador
// com a mesma área que o curso!
$avaliadores_especificos_esgotados = 0;

// Numero de avaliadores que carecem de avaliacao
$n_avaliadores_premio = mysql_num_rows($lista_avaliadores_premio);

// Buscando por todoas as inscricoes com resumo concorrendo ao premio
$inscricao = new Inscricao();
$consulta = $inscricao->find_by_evento_situacao_resumo_premio($evento->get_codigo_evento(), 5);

// Numero de resumos que carecem de avaliacao
$n_resumos_premio = mysql_num_rows($consulta);


// Contando quantos avaliadores precisaremos
$alpha = ceil( 2*$n_resumos_premio/$n_avaliadores_premio ) ;


// Vamos construir o vetor do qual vamos sortear os avaliadores
function vetor_avaliadores($alpha, $lista, $evento, $excluir, $ingles)
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
			$avalia_resumo = new AvaliaResumo();
			$num_avaliacoes = mysql_num_rows( $avalia_resumo->find_by_avaliador_evento( $row->codigo_avaliador, $evento->get_codigo_evento() ) );

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


// Variavel para verificar se estah tudo okay
$ok=1;

// Inserindo inscricoes novas na roda da fortuna
// Para garantir que novos resumos deferidos nao fiquem de fora da premiacao
while ( $row = mysql_fetch_object($consulta) )
{

	// Busca se a inscricao jah estah na lista para avaliacao
	if( !$avalia_resumo->find_by_codigo($row->codigo_pessoa,$row->codigo_evento) )
	{
		// Caso nao esteja, adicionando...
		$avalia_resumo->set_codigo_evento($row->codigo_evento);
		$avalia_resumo->set_codigo_pessoa($row->codigo_pessoa);

		if(!$avalia_resumo->insert())
		{
			$ok=0;
		}
	}
}


// Caso tenha dado algum erro, parada do sorteio imediatamente
// e joga aviso na tela
if($ok == 0)
{
	$_SESSION['msg'] = "Erro no sorteio!!";
	echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_resumo\");</script>";
	exit();
}



//  Sorteando o primeiro avaliador primeiro
//
//*****************************************************************************
//


// Encontrando todas as avaliacoes de resumo
$consulta = $avalia_resumo->find_all( $evento->get_codigo_evento() );

// Variavel para verificar se estah tudo okay
$ok=1;

// Fazendo o sorteio de fato com preferência a avaliadores da mesma área
while ( $row = mysql_fetch_object($consulta) )
{

	// Setando a avaliacao
	$avalia_resumo = new AvaliaResumo();
	$avalia_resumo->set_codigo_evento($row->codigo_evento);
	$avalia_resumo->set_codigo_pessoa($row->codigo_pessoa);
	$avalia_resumo->set_codigo_avaliador2($row->codigo_avaliador2);

	$nota_resumo = new NotaResumo();
	if ( $row->codigo_avaliador1 == 0 or $nota_resumo->find_status($row->codigo_evento, $row->codigo_pessoa, $row->codigo_avaliador1) == 0 )
	{
		$avaliacao = new Avaliacao();

		// Atualizando a lista de avaliadores de acordo com o curso do participante
		$inscricao = new Inscricao();
		$inscricao->find_by_pessoa_evento( $row->codigo_pessoa, $evento->get_codigo_evento() );

		if ( strcmp($inscricao->get_curso(), 'Física Básica') == 0 or strcmp($inscricao->get_curso(), 'Bacharelado em Física') == 0 or strcmp($inscricao->get_curso(), 'Licenciatura em Ciências Exatas') == 0 )
		{
			$lista_avaliadores_premio = $avaliacao->find_all_secao_area($evento->get_codigo_evento(), 'Física básica', 0);
		}
		else if ( strcmp($inscricao->get_curso(), 'Física Aplicada Computacional') == 0 or strcmp($inscricao->get_curso(), 'Bacharelado em Física Computacional') == 0 )
		{
			$lista_avaliadores_premio = $avaliacao->find_all_secao_area($evento->get_codigo_evento(), 'Física computacional', 0);
		}
		else if ( strcmp($inscricao->get_curso(), 'Física Aplicada Biomolecular') == 0 or strcmp($inscricao->get_curso(), 'Bacharelado em Ciências Físicas e Biomoleculares') == 0 )
		{
			$lista_avaliadores_premio = $avaliacao->find_all_secao_area($evento->get_codigo_evento(), 'Biomolecular', 0);
		}
		else if ( strcmp($inscricao->get_curso(), 'Física Aplicada') == 0 )
		{
			$lista_avaliadores_premio = $avaliacao->find_all_secao_area($evento->get_codigo_evento(), 'Física aplicada', 0);
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
		$vetor = vetor_avaliadores($alpha, $lista_avaliadores_premio, $evento, $orientador, $ingles);
		$nelementos = count($vetor);
		if ( $nelementos < 2 )
		{
			$avaliadores_especificos_esgotados = 1;
			$lista_avaliadores_premio = $avaliacao->find_all_secao($evento->get_codigo_evento(), 0);
			$vetor = vetor_avaliadores($alpha, $lista_avaliadores_premio, $evento, $orientador, $ingles);
		}

		// Fazendo a o sorteio
		$doitagain = 1;
		while( $doitagain == 1 )
		{
			$randomn = rand(1, $nelementos - 1);

			if ( $vetor[ $randomn ] != $avalia_resumo->get_codigo_avaliador2() and $vetor[ $randomn ] != 0 )
			{
				$avalia_resumo->set_codigo_avaliador1( $vetor[ $randomn ] );
				$doitagain = 0;
			}
		}

		// Removendo Nota_Resumo caso haja algo lah
		$nota_resumo = new NotaResumo();
		if ( $row->codigo_avaliador1 != 0 and $nota_resumo->find_by_codigo( $row->codigo_avaliador1, $row->codigo_pessoa, $evento->get_codigo_evento() ))
		{
			$nota_resumo->remove();
		}

		// Adicionando em nota_resumo
		$nota_resumo = new NotaResumo();
		$nota_resumo->set_codigo_avaliador( $avalia_resumo->get_codigo_avaliador1() );
		$nota_resumo->set_codigo_evento( $evento->get_codigo_evento() );
		$nota_resumo->set_codigo_pessoa( $row->codigo_pessoa );
		$nota_resumo->insert();

	}
	else
	{
		$avalia_resumo->set_codigo_avaliador1( $row->codigo_avaliador1 );
	}

	if ( !$avalia_resumo->update() )
	{
		$ok=0;
	}

}


//  Agora sim vamos para o sorteio do segundo avaliador
//
//*****************************************************************************
//

// Encontrando todas as avaliacoes de resumo
$consulta = $avalia_resumo->find_all( $evento->get_codigo_evento() );

// Variavel para verificar se estah tudo okay
$ok=1;

// Fazendo o sorteio de fato com preferência a avaliadores da mesma área
while ( $row = mysql_fetch_object($consulta) )
{

	// Setando a avaliacao
	$avalia_resumo = new AvaliaResumo();
	$avalia_resumo->set_codigo_evento($row->codigo_evento);
	$avalia_resumo->set_codigo_pessoa($row->codigo_pessoa);
	$avalia_resumo->set_codigo_avaliador1($row->codigo_avaliador1);

	$nota_resumo = new NotaResumo();
	if ( $row->codigo_avaliador2 == 0 or $nota_resumo->find_status($row->codigo_evento, $row->codigo_pessoa, $row->codigo_avaliador2) == 0 )
	{
		$avaliacao = new Avaliacao();

		// Atualizando a lista de avaliadores
		$lista_avaliadores_premio = $avaliacao->find_all_secao($evento->get_codigo_evento(), 0);

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
		$vetor = vetor_avaliadores($alpha, $lista_avaliadores_premio, $evento, $orientador, $ingles);
		$nelementos = count($vetor);

		// Fazendo o sorteio
		$doitagain = 1;
		while( $doitagain == 1 )
		{
			$randomn = rand(1, $nelementos - 1);

			if ( $vetor[ $randomn ] != $avalia_resumo->get_codigo_avaliador1() and $vetor[ $randomn ] != 0 )
			{
				$avalia_resumo->set_codigo_avaliador2( $vetor[ $randomn ] );
				$doitagain = 0;
			}
		}
		if ( $avalia_resumo->get_codigo_avaliador2() == '' ) echo $row->codigo_pessoa . " " . $randomn . " " . $vetor[ $randomn ] . "<br />";

		// Removendo Nota_Resumo caso haja algo lah
		$nota_resumo = new NotaResumo();
		if ( $row->codigo_avaliador2 != 0 and $nota_resumo->find_by_codigo( $row->codigo_avaliador2, $row->codigo_pessoa, $evento->get_codigo_evento() ))
		{
			$nota_resumo->remove();
		}

		// Adicionando em nota_resumo
		$nota_resumo = new NotaResumo();
		$nota_resumo->set_codigo_avaliador( $avalia_resumo->get_codigo_avaliador2() );
		$nota_resumo->set_codigo_evento( $evento->get_codigo_evento() );
		$nota_resumo->set_codigo_pessoa( $row->codigo_pessoa );
		$nota_resumo->insert();

	}
	else
	{
		$avalia_resumo->set_codigo_avaliador2( $row->codigo_avaliador2 );
	}

	if ( !$avalia_resumo->update() )
	{
		$ok=0;
	}

}






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



	echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_resumo\");</script>";
	exit();
}
else
{
	$_SESSION['msg'] = "Erro no sorteio!!";
	echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_resumo\");</script>";
	exit();
}


?>
