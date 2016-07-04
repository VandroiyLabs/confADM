<?php
require_once('./../classes/class.pessoa.php');
require_once('./../classes/class.evento.php');
require_once('./../classes/class.inscricao.php');

/*
//Para fechar criação de contas
$fechar = true;
if($fechar == true)
{
	echo "<script language=\"JavaScript\">location=(\"http://sifsc.ifsc.usp.br/\")</script>";
	exit();
}

*/


session_start();
$home = "/home/" . get_current_user() . "/";
include($home . "public_html/sifsc/user/error_handler.php");

require_once('Mail.php');


$pessoa = new Pessoa();
$evento = new Evento();
$inscricao = new Inscricao();

if($evento->find_evento_aberto())
{
	$aberto = 1;
}
else
{
	$aberto = 0;
}


if($aberto != 0)
{
	$pessoa->set_email($_POST["email"]);
	$pessoa->set_senha($_POST["senha"]);

	if ( $pessoa->find_by_email($_POST["email"]) )
	{
		echo "<script language=\"JavaScript\">alert(\"Email já cadastrado! Caso não lembre de sua senha, use 'Esqueceu sua senha?'.\");history.back();</script>";
	}
	else if ( $pessoa->insert() )
	{
		$codigo_pessoa = $pessoa->get_codigo_pessoa();
		$codigo_evento = $evento->get_codigo_evento();
		$inscricao->set_codigo_pessoa($codigo_pessoa);
		$inscricao->set_codigo_evento($codigo_evento);
		$inscricao->set_codigo_secao(0);
		$inscricao->set_codigo_resumo(0);
		$inscricao->set_codigo_resumo_ingles(0);
		$inscricao->set_codigo_arte(0);
		$inscricao->set_situacao_resumo(0);
		$inscricao->set_situacao_deferimento(0);
		$inscricao->set_situacao_arte(0);
		$inscricao->set_modalidade('00000');

		/*
			Generating the token to use in the first login!
		*/
		$token = $inscricao->generate_token($codigo_pessoa);

		if( $inscricao->insert() )
		{

			$assunto    = $evento->get_tag_email() . " Inscrição no evento";
			$mensagem   = "Caro(a) correspondente, \n\ncadastramos você com sucesso no site da " . $evento->get_nome() . ".";
			$mensagem  .= " Para ativar sua conta, no entanto, pedimos para que acesse o seguinte endereço: \n";
			$mensagem  .= "http://sifsc.ifsc.usp.br/user/login.php?token=" . $token;
			$mensagem  .= "\n\nApós a ativação você poderá logar em nosso sistema. Somente após fornecer suas informações sua inscrição será considerada válida.";
			$mensagem  .= "\n\n" . $evento->get_assinatura_email();

			$enviada = $pessoa->manda_email($assunto, $mensagem);

			if ( $enviada == 1 )
			{
				echo "<script language=\"JavaScript\">location=(\"http://sifsc.ifsc.usp.br/user/login.php?alert=4\")</script>";
			}
			else
			{
				echo "<script language=\"JavaScript\">location=(\"http://sifsc.ifsc.usp.br/user/login.php?alert=3\")</script>";
			}

		}
		else
		{
					echo "<script language=\"JavaScript\">alert(\"Erro inesperado!\");history.back();</script>";

		}
	}

}
else
{
	echo "<script language=\"JavaScript\">alert(\"Inscrições fechadas neste momento!\");location=(\"http://sifsc.ifsc.usp.br\")</script>";

}
?>
