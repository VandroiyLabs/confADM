<?php

require_once('./../../../../user/classes/class.inscricao.php');
require_once('./../../../../user/classes/class.evento.php');
require_once('./../../../../user/classes/class.pessoa.php');
	
require_once('Mail.php');

session_start();

$pessoa = new Pessoa();
$evento = new Evento();
$inscricao = new Inscricao();
		
if($evento->find_evento_aberto())
{
	$_SESSION["evento"] = $evento;
	$aberto = 1; 
}
else
{
	$aberto = 0; 
}


	$pessoa->set_email($_POST["email"]);
	$pessoa->set_senha($_POST["senha"]);
	
	if($pessoa->find_by_email($_POST["email"]))
	{
		echo "<script language=\"JavaScript\">alert(\"Email já cadastrado!\");history.back();</script>";
	}	
	else if($pessoa->insert())
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
		$inscricao->set_token('ativado');
		
		if($inscricao->insert())
		{	$_SESSION["pessoa"]=$pessoa;
			$_SESSION["evento"]=$evento;
			$_SESSION["inscricao"]=$inscricao;

			$assunto    = "[SIFSC 2012] Confirmacao da sua inscricao de evento";
			$mensagem   = "Caro correspondente, \n\n inscrevemos você com sucesso.
	 		\n\n Att, Organização do SIFSC 2012";
			
			$enviada = $pessoa->manda_email($assunto, $mensagem);
			
			if ( $enviada == 1 )
			{
				echo "<script language=\"JavaScript\">location=(\"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=incluir&alert=4&CP=".$pessoa->get_codigo_pessoa()."\")</script>";
				
			}
			else
			{
				echo "<script language=\"JavaScript\">location=(\"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=incluir&opcao=new?alert=3\")</script>";
			}
				
		}
		else
		{
					echo "<script language=\"JavaScript\">alert(\"Erro inesperado!\");history.back();</script>";
	
		}
	}
	


?>
