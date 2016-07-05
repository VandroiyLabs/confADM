<?php
require_once('./../../user/classes/class.pessoa.php');
require_once('./../../user/classes/class.evento.php');
require_once('./../../user/classes/class.inscricao.php');
require_once('./../../user/classes/class.resumo.php');
require_once('./../../user/classes/class.conexao.php');
require_once('./../../user/classes/class.autor.php');

session_start();


function IsLatin1($str)
{
	$res = preg_match("/^[\\x00-\\xFF]*$/u", $str, $m, PREG_OFFSET_CAPTURE);	
	return ( $res === 1 );
}



$cp = $_GET["cp"];
$cr = $_GET["cr"];


$evento = new Evento();
$evento->find_evento_aberto();

$prb_pessoa = new Pessoa();
$prb_pessoa->find_by_codigo( $cp );

$prb_inscricao = new Inscricao();
$prb_inscricao->find_by_pessoa_evento( $cp , $evento->get_codigo_evento() );

$prb_resumo = new Resumo();
$prb_resumo->find_by_codigo( $cr );

// Verifica se houve algum problema
$condicoes = 1;

// Lista de problemas ocorridos!
$mensagem = "<ul name=\"lista\">\n";



if ( strcmp($prb_resumo->get_titulo(), '') == 0 )
{
	$mensagem .= "<li>Falta preencher título do resumo.</li>\n";
	$condicoes = 0;
}

// Verificação se há um autor principal setado
if ( $prb_resumo->get_autor_principal() == 0 or strcmp($prb_resumo->get_autor_principal(), '') == 0 )
{
	$mensagem .= "<li>Falta selecionar um autor como principal.</li>\n";
	$condicoes = 0;
}

// Verificando a condição dos autores fornecidos para os autores cadastrados
// Verificando a regra do numero minimo de autores, passado como 2!!
$prb_autor = new Autor();
$nautores = $prb_autor->numero_autores_by_resumo( $cr );
if ( $nautores <= 1 )
{

	$mensagem .= "<li>São necessários no mínimo <b>dois</b> autores.".$nautores."</li>\n";
	$condicoes = 0;
}
else
{
	// Caso haja autores, precisamos verificar se todos os campos estão preenchidos

	for ( $ordem = 1; $ordem <= $nautores; $ordem++ )
	{
		$prb_autor = new Autor();
		$prb_autor->find_by_resumo_ordem( $prb_inscricao->get_codigo_resumo() ,  $ordem);

		// Verificando se o nome do autor foi preenchido
		if ( strcmp( $prb_autor->get_nome(), "") == 0 )
		{
			$mensagem .= "<li>Não foi definido o nome de seu autor " . $ordem . ".</li>\n";
			$condicoes = 0;
		}

		// Verificando se a instituicao do autor foi preenchido
		if ( strcmp( $prb_autor->get_instituicao(), "") == 0 )
		{
			$mensagem .= "<li>Não foi definida a instituição de seu autor " . $ordem . ".</li>\n";
			$condicoes = 0;
		}
	}
}


// Verificando se QUALQUER uma das três palavras-chave estão em branco (todas são obrigatórias)
if ( strcmp($prb_resumo->get_kw1(), '') == 0 or strcmp($prb_resumo->get_kw2(), '') == 0 or strcmp($prb_resumo->get_kw3(), '') == 0 )
{
	$mensagem .= "<li>São necessárias três palavras-chave para cada resumo.</li>\n";
	$condicoes = 0;
}

// Verifica se as palavras chave são idênticas (naive level)
if ( strcmp($prb_resumo->get_kw1(), $prb_resumo->get_kw2()) == 0 or strcmp($prb_resumo->get_kw1(), $prb_resumo->get_kw3()) == 0 or strcmp($prb_resumo->get_kw2(), $prb_resumo->get_kw3()) == 0 )
{
	$mensagem .= "<li>Cada palavra-chave deve ser diferente uma da outra e as três são obrigatórias.</li>\n";
	$condicoes = 0;
}

// Verificacao do tamanho do texto
$explodido = explode(" ", $prb_resumo->get_texto());
if ( strcmp($prb_resumo->get_texto(), '') == 0 )
{
	$mensagem .= "<li>O texto do seu resumo está em branco.</li>\n";
	$condicoes = 0;
}
elseif ( sizeof($explodido) <= 150 and ( $prb_inscricao->get_nivel() == 'Doutorado' or $prb_inscricao->get_nivel() == 'Doutorado Direto' or $prb_inscricao->get_nivel() == 'Mestrado' )  )
{
	$mensagem .= "<li>O texto de seu resumo tem menos de 150 palavras, <b>mínimo</b> estipulado para a " . $evento->get_nome() . ".</li>\n";
	$condicoes = 0;
}
elseif ( sizeof($explodido) >= 500 )
{
	$mensagem .= "<li>O texto de seu resumo tem mais de 500 palavras, <b>máximo</b> estipulado para a " . $evento->get_nome() . ".</li>\n";
	$condicoes = 0;
}

// Email do autor principal precisa estar setado
if ( strcmp($prb_resumo->get_email(), '') == 0 )
{
	$mensagem .= "<li>Falta o e-mail do autor principal.</li>\n";
	$condicoes = 0;
}

// Todos os campos de uma das referências precisa estar setado
if ( strcmp($prb_resumo->get_autor1(), '') == 0 or strcmp($prb_resumo->get_titulo1(), '') == 0 or strcmp($prb_resumo->get_info1(), '') == 0)
{
	$mensagem .= "<li>Ao menos a referência 1 deve ser completamente preenchida.</li>\n";
	$condicoes = 0;
}

// Testando o texto no texto principal
if ( !IsLatin1($prb_resumo->get_texto()) )
{
	$palavras = explode(" ", $prb_resumo->get_texto());
	$npvs = sizeof($palavras);

	$detected = array();
	$indexdet = array();
	$ndetected = 0;
	for($j = 0; $j < $npvs; $j++)
	{
		if ( !( preg_match("/^[\\x00-\\xFF]*$/u", $palavras[$j], $m) === 1 ) )
		{
			$detected[$ndetected] = $palavras[$j];
			$indexdet[$ndetected] = $j;
			$ndetected++;
		}
	}


	$mensagem .= "<li>Uso  de caracteres não permitidos no resumo! Palavras problemáticas: ";
	$mensagem .= "<br />";
	if ( $ndetected == 1 )
	{
		$mensagem .= "- <b><u>" . $detected[0] . "</u></b> " . $palavras[1] . " " . $palavras[2] . "...";
	}
	else
	{
		$mensagem .= "- <b><u>" . $detected[0] . "</u></b> " . $palavras[1] . " " . $palavras[2] . "...<br />";

		for($j = 1; $j < $ndetected - 1; $j++)
		{
			$mensagem .= "- ..." . $palavras[$indexdet[$j] - 1] . " <b><u>" . $detected[$j] . "</u></b> " . $palavras[$indexdet[$j]+1] . "...<br />";
		}

		if ( $indexdet[$j] == $ndetected - 1 )
		{
			$mensagem .= "- ..." . $palavras[$indexdet[$j] - 2] . " " . $palavras[$indexdet[$j] - 1] . " " . $detected[$ndetected - 1] . ".";
		}
		else
		{
			$mensagem .= "- ..." . $palavras[$indexdet[$j] - 1] . " <b><u>" . $detected[$j] . "</u></b> " . $palavras[$indexdet[$j]+1] . "...<br />";
		}

	}
	$mensagem .= "</li>\n";
	$condicoes = 0;
}

// Testando o texto do título
if ( !IsLatin1($prb_resumo->get_titulo()) )
{
	$mensagem .= "<li>Uso  de caracteres não permitidos no título!</li>\n";
	$condicoes = 0;
}


// Testando o texto das palavras-chave
if ( !IsLatin1($prb_resumo->get_kw1()) or !IsLatin1($prb_resumo->get_kw2()) or !IsLatin1($prb_resumo->get_kw3()) )
{
	$mensagem .= "<li>Uso  de caracteres não permitidos no nas palavras-chave!</li>\n";
	$condicoes = 0;
}


// Testando o texto nas referências
if ( !IsLatin1($prb_resumo->get_autor1()) or !IsLatin1($prb_resumo->get_titulo1()) or !IsLatin1($prb_resumo->get_info1()) or !IsLatin1($prb_resumo->get_autor2()) or !IsLatin1($prb_resumo->get_titulo2()) or !IsLatin1($prb_resumo->get_info2()) or !IsLatin1($prb_resumo->get_autor3()) or !IsLatin1($prb_resumo->get_titulo3()) or !IsLatin1($prb_resumo->get_info3()) )
{
	$mensagem .= "<li>Uso  de caracteres não permitidos nas referências!</li>\n";
	$condicoes = 0;
}

// Para pessoas do IFSC, é necessário checar os seguintes componentes por questões do prêmio.
if ( strcmp($prb_inscricao->get_instituicao(), 'IFSC-USP') == 0 )
{

	if ( strcmp($prb_inscricao->get_orientador(), '') == 0 )
	{
		$mensagem .= "<li>Orientador não definido.</li>\n";
		$condicoes = 0;
	}

	if ( strcmp($prb_inscricao->get_grupo(), '') == 0 )
	{
		$mensagem .= "<li>Falta definir o grupo de pesquisa.</li>\n";
		$condicoes = 0;
	}
}

// Verificando agora sobre a versão em inglês do resumo (caso haja alguma)
if ( $prb_inscricao->get_codigo_resumo_ingles() != 0 )
{

	$prb_resumo->find_by_codigo($prb_inscricao->get_codigo_resumo_ingles());

	if ( strcmp($prb_resumo->get_titulo(), '') == 0 )
	{
		$mensagem .= "<li>Falta preencher título da versão em inglês do seu resumo.</li>\n";
		$condicoes = 0;
	}

	// Verificacao do tamanho do texto
	$explodido = explode(" ", $prb_resumo->get_texto());
	if ( strcmp($prb_resumo->get_texto(), '') == 0 )
	{
		$mensagem .= "<li>O texto da versão em inglês do seu resumo está em branco.</li>\n";
		$condicoes = 0;
	}
	elseif ( sizeof($explodido) <= 150 )
	{
		$mensagem .= "<li>O texto da versão em inglês do seu seu resumo tem menos de 150 palavras, <b>mínimo</b> estipulado para a " . $evento->get_nome() . ".</li>\n";
		$condicoes = 0;
	}
	elseif ( sizeof($explodido) >= 500 )
	{
		$mensagem .= "<li>O texto da versão em inglês do seu resumo tem mais de 500 palavras, <b>máximo</b> estipulado para a " . $evento->get_nome() . ".</li>\n";
		$condicoes = 0;
	}

	if ( strcmp($prb_resumo->get_kw1(), '') == 0 or strcmp($prb_resumo->get_kw2(), '') == 0 or strcmp($prb_resumo->get_kw3(), '') == 0 )
	{
		$mensagem .= "<li>São necessárias três palavras-chave para o resumo em inglês também!.</li>\n";
		$condicoes = 0;
	}

	if ( !IsLatin1($prb_resumo->get_texto()) )
	{
		$mensagem .= "<li>Uso  de caracteres não permitidos no resumo (inglês)!";
		$mensagem .= "</li>\n";
		$condicoes = 0;
	}
	if ( !IsLatin1($prb_resumo->get_titulo()) )
	{
		$mensagem .= "<li>Uso  de caracteres não permitidos no título (inglês)!.</li>\n";
		$condicoes = 0;
	}
	if ( !IsLatin1($prb_resumo->get_kw1()) or !IsLatin1($prb_resumo->get_kw2()) or !IsLatin1($prb_resumo->get_kw3()) )
	{
		$mensagem .= "<li>Uso  de caracteres não permitidos nas palavras-chave (inglês)!</li>\n";
		$condicoes = 0;
	}


}



$mensagem .= "</ul>";


if ( $condicoes == 1 )
{
	$_SESSION['problemasresumo'] = "<p><b>Não foram encontrados erros neste resumo! =)</b></p>";

}
else
{
	$_SESSION["problemasresumo"] = "<p><b>Foram encontrados os seguintes problemas no resumo:</b></p>" . $mensagem;
}


echo "<script language=\"javascript\">location=(\"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp=" . $cp . "#problemas\");</script>";


?>
