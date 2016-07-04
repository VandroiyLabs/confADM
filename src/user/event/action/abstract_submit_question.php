<?php
$home = "/home/" . get_current_user() . "/";

require_once('../../classes/class.pessoa.php');
require_once('../../classes/class.evento.php');
require_once('../../classes/class.inscricao.php');
require_once('../../classes/class.resumo.php');
require_once('../../classes/class.conexao.php');
require_once('../../classes/class.autor.php');

session_start();
require_once("./../../user_edition_variables.php");
require_once($head_file);


function IsLatin1($str)
{
	$res = preg_match("/^[\\x00-\\xFF]*$/u", $str, $m, PREG_OFFSET_CAPTURE);
	return ( $res === 1 );
}



include($home . "public_html/sifsc/user/event/secao.php");

$_SESSION["evento"] = $evento;
$_SESSION["pessoa"] = $pessoa;
$_SESSION["inscricao"] = $inscricao;


include('~/public_html/sifsc/user/event/index.php');

$page = $_POST["page"];

$resumo = new Resumo();
$resumo->find_by_codigo($inscricao->get_codigo_resumo());

// Verifica se houve algum problema
$condicoes = 1;

// Lista de problemas ocorridos!
$mensagem = "<ul name=\"lista\">\n";

//
// Resumos não submetidos no periodo regular nao podem concorrer ao premio
//
if ( (($inscricao->get_situacao_resumo() == 0 or $inscricao->get_situacao_resumo() == 1) and $evento->get_premio_aberto() == 0) or ($inscricao->get_situacao_resumo() == 3 and  $inscricao->get_premio() == 0 and $evento->get_premio_aberto() == 0) )
{
	$inscricao->set_premio('0');
}

$inscricao->update_no_form();



if ( strcmp($resumo->get_titulo(), '') == 0 )
{
	$mensagem .= "<li>Falta preencher título do resumo.</li>\n";
	$condicoes = 0;
}

// Verificação se há um autor principal setado
if ( $resumo->get_autor_principal() == 0 or strcmp($resumo->get_autor_principal(), '') == 0 )
{
	$mensagem .= "<li>Falta selecionar um autor como principal.</li>\n";
	$condicoes = 0;
}

// Verificando a condição dos autores fornecidos para os autores cadastrados
// Verificando a regra do numero minimo de autores, passado como 2!!
$autor = new Autor();
$nautores = $autor->numero_autores_by_resumo( $inscricao->get_codigo_resumo() );
if ( $nautores <= 1 )
{
	$mensagem .= "<li>São necessários no mínimo <b>dois</b> autores.</li>\n";
	$condicoes = 0;
}
else
{
	// Caso haja autores, precisamos verificar se todos os campos estão preenchidos

	for ( $ordem = 1; $ordem <= $nautores; $ordem++ )
	{
		$autor = new Autor();
		$autor->find_by_resumo_ordem( $inscricao->get_codigo_resumo() ,  $ordem);

		// Verificando se o nome do autor foi preenchido
		if ( strcmp( $autor->get_nome(), "") == 0 )
		{
			$mensagem .= "<li>Não foi definido o nome de seu autor " . $ordem . ".</li>\n";
			$condicoes = 0;
		}

		// Verificando se a instituicao do autor foi preenchido
		if ( strcmp( $autor->get_instituicao(), "") == 0 )
		{
			$mensagem .= "<li>Não foi definida a instituição de seu autor " . $ordem . ".</li>\n";
			$condicoes = 0;
		}
	}
}


// Verificando se QUALQUER uma das três palavras-chave estão em branco (todas são obrigatórias)
if ( strcmp($resumo->get_kw1(), '') == 0 or strcmp($resumo->get_kw2(), '') == 0 or strcmp($resumo->get_kw3(), '') == 0 )
{
	$mensagem .= "<li>São necessárias três palavras-chave para cada resumo.</li>\n";
	$condicoes = 0;
}

// Verifica se as palavras chave são idênticas (naive level)
if ( strcmp($resumo->get_kw1(), $resumo->get_kw2()) == 0 or strcmp($resumo->get_kw1(), $resumo->get_kw3()) == 0 or strcmp($resumo->get_kw2(), $resumo->get_kw3()) == 0 )
{
	$mensagem .= "<li>Cada palavra-chave deve ser diferente uma da outra e as três são obrigatórias.</li>\n";
	$condicoes = 0;
}

// Verificacao do tamanho do texto
$explodido = explode(" ", str_replace("  ", " ", $resumo->get_texto()) );
if ( strcmp($resumo->get_texto(), '') == 0 )
{
	$mensagem .= "<li>O texto do seu resumo está em branco.</li>\n";
	$condicoes = 0;
}
elseif ( sizeof($explodido) <= 150 and ( $inscricao->get_nivel() == 'Doutorado' or $inscricao->get_nivel() == 'Doutorado Direto' or $inscricao->get_nivel() == 'Mestrado' )  )
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
if ( strcmp($resumo->get_email(), '') == 0 )
{
	$mensagem .= "<li>Falta o e-mail do autor principal.</li>\n";
	$condicoes = 0;
}

// Todos os campos de uma das referências precisa estar setado
if ( strcmp($resumo->get_autor1(), '') == 0 or strcmp($resumo->get_titulo1(), '') == 0 or strcmp($resumo->get_info1(), '') == 0)
{
	$mensagem .= "<li>Ao menos a referência 1 deve ser completamente preenchida.</li>\n";
	$condicoes = 0;
}

// Testando o texto no texto principal
if ( !IsLatin1($resumo->get_texto()) )
{
	$palavras = explode(" ", $resumo->get_texto());
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
if ( !IsLatin1($resumo->get_titulo()) )
{
	$mensagem .= "<li>Uso  de caracteres não permitidos no título!</li>\n";
	$condicoes = 0;
}


// Testando o texto das palavras-chave
if ( !IsLatin1($resumo->get_kw1()) or !IsLatin1($resumo->get_kw2()) or !IsLatin1($resumo->get_kw3()) )
{
	$mensagem .= "<li>Uso  de caracteres não permitidos no nas palavras-chave!</li>\n";
	$condicoes = 0;
}


// Testando o texto nas referências
if ( !IsLatin1($resumo->get_autor1()) or !IsLatin1($resumo->get_titulo1()) or !IsLatin1($resumo->get_info1()) )
{
	$mensagem .= "<li>Uso  de caracteres não permitidos na referência 1</li>\n";
	$condicoes = 0;
}
if ( !IsLatin1($resumo->get_autor2()) or !IsLatin1($resumo->get_titulo2()) or !IsLatin1($resumo->get_info2()) )
{
	$mensagem .= "<li>Uso  de caracteres não permitidos na referência 2</li>\n";
	$condicoes = 0;
}
if ( !IsLatin1($resumo->get_autor3()) or !IsLatin1($resumo->get_titulo3()) or !IsLatin1($resumo->get_info3()) )
{
	$mensagem .= "<li>Uso  de caracteres não permitidos na referência 3</li>\n";
	$condicoes = 0;
}



// Para pessoas do IFSC, é necessário checar os seguintes componentes por questões do prêmio.
if ( strcmp($inscricao->get_instituicao(), 'IFSC-USP') == 0 )
{

	if ( strcmp($inscricao->get_orientador(), '') == 0 )
	{
		$mensagem .= "<li>Orientador não definido.</li>\n";
		$condicoes = 0;
	}

	if ( strcmp($inscricao->get_grupo(), '') == 0 )
	{
		$mensagem .= "<li>Falta definir o grupo de pesquisa.</li>\n";
		$condicoes = 0;
	}

	if ( strcmp($inscricao->get_subarea(), '') == 0 )
	{
		$mensagem .= "<li>Falta definir a subárea de pesquisa.</li>\n";
		$condicoes = 0;
	}
}

// Verificando agora sobre a versão em inglês do resumo (caso haja alguma)
if ( $inscricao->get_codigo_resumo_ingles() != 0 )
{

	$resumo->find_by_codigo($inscricao->get_codigo_resumo_ingles());

	if ( strcmp($resumo->get_titulo(), '') == 0 )
	{
		$mensagem .= "<li>Falta preencher título da versão em inglês do seu resumo.</li>\n";
		$condicoes = 0;
	}

	// Verificacao do tamanho do texto
	$explodido = explode(" ", $resumo->get_texto());
	if ( strcmp($resumo->get_texto(), '') == 0 )
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

	if ( strcmp($resumo->get_kw1(), '') == 0 or strcmp($resumo->get_kw2(), '') == 0 or strcmp($resumo->get_kw3(), '') == 0 )
	{
		$mensagem .= "<li>São necessárias três palavras-chave para o resumo em inglês também!.</li>\n";
		$condicoes = 0;
	}

	if ( !IsLatin1($resumo->get_texto()) )
	{
		$mensagem .= "<li>Uso  de caracteres não permitidos no resumo (inglês)!";
		$mensagem .= "</li>\n";
		$condicoes = 0;
	}
	if ( !IsLatin1($resumo->get_titulo()) )
	{
		$mensagem .= "<li>Uso  de caracteres não permitidos no título (inglês)!.</li>\n";
		$condicoes = 0;
	}
	if ( !IsLatin1($resumo->get_kw1()) or !IsLatin1($resumo->get_kw2()) or !IsLatin1($resumo->get_kw3()) )
	{
		$mensagem .= "<li>Uso  de caracteres não permitidos nas palavras-chave (inglês)!</li>\n";
		$condicoes = 0;
	}


}



$mensagem .= "</ul>";


if ( $condicoes == 1 )
{
	// Garatinr que passou por aqui!
	$_SESSION['abstract_question'] = 1;

	?>


	<div id="user_system">

		<div id="titulo_form_secao">
			Submissão de resumo
		</div>

	<?php
		if(($inscricao->get_situacao_resumo() == 1  and $evento->get_submissao_aberta()== 1) or ($inscricao->get_situacao_resumo() == 3 and $evento->get_resubmissao_aberta()== 1))
		{
	?>
		<div id="status">

			<p>Ao submeter seu resumo, a organização da <?php echo $evento->get_nome(); ?> passará a considerá-lo para o evento. Após submetê-lo, você não poderá mais modificar seu resumo até que a comissão organizadora da SIFSC o avalie.</p>

			<p><i><b>Tem certeza que deseja submeter seu resumo?</b></i></p>

			<p><a class="submeter_chamativo" href="abstract_submit_action.php">Sim, quero submeter meu resumo</a></p>
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
}
else
{
	$_SESSION["problemas"] = $mensagem;
	echo "<script language=\"javascript\">location=(\"../abstract_home.php#submissaoresumo\");</script>";
}

?>
