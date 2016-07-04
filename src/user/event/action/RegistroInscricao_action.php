<?php
require_once("~/public_html/sifsc/user/classes/class.evento.php");
require_once('~/public_html/sifsc/user/classes/class.inscricao.php');
require_once('~/public_html/sifsc/user/classes/class.arte.php');
require_once("~/public_html/sifsc/user/classes/class.pessoa.php");
require_once('~/public_html/sifsc/user/classes/class.administrador.php');

session_start();
include("~/public_html/sifsc/user/error_handler.php");
$page = $_POST["page"];

include('~/public_html/sifsc/user/event/secao.php');

$evento->find_evento_aberto();


// Checando se jah existe inscricao para este usuario no evento atual
if (  $evento->get_inscricao_aberta() == 0 )
{
	// Se entrar aqui eh porque as inscricoes estao fechadas,
	// e por isso voltamos para a pagina inicial do USER.
	$_SESSION['msg'] = 'Inscrições estão encerradas!';
	header("location: http://sifsc.ifsc.usp.br/user/event/status.php");
}
else if ( $inscricao->find_by_pessoa_evento($pessoa->get_codigo_pessoa(), $evento->get_codigo_evento()) )
{
	// Se entrar aqui eh porque esse usuario jah tem inscricao no evento,
	// e por isso voltamos para a pagina inicial do USER.
	$_SESSION['msg'] = 'Não precisa se inscrever de novo... ;)';
	header("location: http://sifsc.ifsc.usp.br/user/event/status.php");

}
else
{
	//
	// Inscricao não encontrada: vamos criar uma nova.
	//

	// Criando uma nova inscricao
	$inscricao->set_codigo_pessoa($pessoa->get_codigo_pessoa());
	$inscricao->set_codigo_evento($evento->get_codigo_evento());
	$inscricao->set_codigo_secao(0);
	$inscricao->set_codigo_resumo(0);
	$inscricao->set_codigo_resumo_ingles(0);
	$inscricao->set_codigo_arte(0);
	$inscricao->set_situacao_resumo(0);
	$inscricao->set_situacao_deferimento(0);
	$inscricao->set_situacao_arte(0);
	$inscricao->set_modalidade('00000');


	// Setting token as already activated!
	$inscricao->set_token('ativado');

	if($inscricao->insert() )
	{

		$assunto    = $evento->get_tag_email() . " Inscrição no evento";
		$mensagem   = "Caro(a) " . $pessoa->get_nome() . ", \n\ncadastramos você com sucesso no site da " . $evento->get_nome() . ". ";
		$mensagem  .= "Como você já havia criado sua conta em edições anteriores, ela já está ativada e pronta para uso.";
		$mensagem  .= "\n\n" . $evento->get_assinatura_email();

		$enviada = $pessoa->manda_email($assunto, $mensagem);

		if ( $enviada == 1 )
		{
			$_SESSION['msg'] = 'Você agora está inscrito!';
		}
		else
		{
			$_SESSION['msg'] = 'Você agora está inscrito, mas seu e-mail parece ter problema!';
		}
	}
	else
	{
		$_SESSION['msg'] = 'Erro na inscrição! Contate a comissão!!';
	}

}

header("location: http://sifsc.ifsc.usp.br/user/event/status.php");

?>
