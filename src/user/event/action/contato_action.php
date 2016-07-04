<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.pessoa.php");
require_once($home . "public_html/sifsc/user/classes/class.inscricao.php");

session_start();
include($home . "public_html/sifsc/user/error_handler.php");

include($home . "public_html/sifsc/user/event/secao.php");


if ( isset($_POST["assunto"]) and isset($pessoa) )
{

	$subject = $_POST['assunto'];
	$conteudo = $_POST['mensagem'];
	$headlines = $_POST['natureza'];
	$organiza_email = 'semanaifsc@gmail.com';

	$assunto = '[CONTATO] <' . $headlines . '> - ' . $subject;


	$mensagem = "Usuário: " . $pessoa->get_nome() . "\n" .
				"Email: " . $pessoa->get_email() . "\n";

	if ( isset($_SESSION["SemInscricao"]) && $_SESSION["SemInscricao"] == 1 )
	{
		$mensagem .="Pessoa não inscrita na edição atual.\n";
	}
	else
	{
		$modalidade = $inscricao->get_modalidade();

		if($inscricao->get_situacao_resumo() == '1')
		{
			$mensagem .= "Resumo: não submeteu para avaliação.\n";
		}
		elseif($inscricao->get_situacao_resumo() == '2' && $inscricao->get_situacao_deferimento() == '0')
	 	{
			$mensagem .= "Resumo: Aguardando deferimento da biblioteca.\n";
		}
		elseif($inscricao->get_situacao_resumo() == '2' && $inscricao->get_situacao_deferimento() == '1')
		{
			$mensagem .= "Resumo: Aguardando deferimento da comissão.\n";
	 	}
		elseif($inscricao->get_situacao_resumo() == '5' && $inscricao->get_situacao_deferimento() == '2')
		{
			$mensagem .= "Resumo: Deferido.\n";
		}
		elseif($inscricao->get_situacao_resumo() == '3' && $inscricao->get_situacao_deferimento() == '0')
		{
			$mensagem .= "Resumo: Aguardando nova submissão.\n";
		}
		elseif($inscricao->get_situacao_resumo() == '4')
		{
			$mensagem .= "Resumo: Indeferido.\n";
		}
		elseif ( $modalidade[1] == '0' )
		{
			$mensagem .= "Resumo: não salvou nada ainda.\n";
		}

		if ( $modalidade[3] == '1' )
		{
			$mensagem .= "Minicurso: Inscrito.\n";
		}
		else
		{
			$mensagem .= "Minicurso: Não inscrito.\n";
		}

		if ( $modalidade[4] == '0' )
		{
			$mensagem .= "Arte: Nada salvo ainda.\n";
		}
		elseif ($inscricao->get_situacao_arte() == '4' )
		{
			$mensagem .= "Arte: Deferido.\n";
		}
		elseif ($inscricao->get_situacao_arte() == '3' )
		{
			$mensagem .= "Arte: Indeferido.\n";
		}
		elseif ($inscricao->get_situacao_arte() == '1' )
		{
			$mensagem .= "Arte: Aguardando submissão.\n";
		}
		elseif ($inscricao->get_situacao_arte() == '2'  )
		{
			$mensagem .= "Arte: Aguardando deferimento.\n";
		}
	}

		$mensagem .= "\n\n" .
				" -> Conteúdo da mensagem: \n---------------------------------------------------\n" . $conteudo . "\n---------------------------------------------------\n\n" .
				" ";

	if ( $pessoa->contata_organizacao($organiza_email, $assunto, $mensagem) )
	{
		$_SESSION["pessoa"] = $pessoa;
		$_SESSION["msg"] = "Mensagem enviada com sucesso";
		echo "<script language=\"JavaScript\"> location=(\"../faleconosco.php\"); </script>";
	}
}
?>
