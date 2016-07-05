<?php
$home = "/home/" . get_current_user() . "/";
include($home . 'public_html/sifsc/adm/error_handler.php');
require_once('./../../../user/classes/class.avaliador.php');
require_once('./../../../user/classes/class.avaliacao.php');
require_once('./../../../user/classes/class.evento.php');
require_once('./../../../user/classes/class.administrador.php');
require_once('./../../../user/classes/class.log.php');
session_start();

$avaliador = new Avaliador();
$page = $_POST["page"];

/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
require_once($home . "public_html/sifsc/adm/restricted.php");


$evento = new Evento();
$evento->find_evento_aberto();

if($page == 'incluir')
{
	// Verificando se tudo correu bem
	$ok = 1;

	$log = new Log();
	$log->set_adm_usuario( $adm->get_usuario() );
	$log->set_codigo_evento( $evento->get_codigo_evento() );
	$log->set_operacao( 'Incluir avaliador' );
	$log->set_detalhes( 'Nome = ' . $_POST["nome"] . ' :: email = ' . $_POST["email"]);
	$log->insert();

	if($_POST["nome"] == 'OUTRO')
	$avaliador->set_nome($_POST["outro_nome"]);
	else
	$avaliador->set_nome($_POST["nome"]);

	$avaliador->set_cpf('11111111111');
	$avaliador->set_email($_POST["email"]);
	$avaliador->generate_token($_POST["email"]);
	$avaliador->set_nivel($_POST["nivel"]);
	$avaliador->set_grupo($_POST["grupo"]);
	$avaliador->set_area1($_POST["area1"]);
	$avaliador->set_area2($_POST["area2"]);
	$avaliador->set_subarea($_POST["subarea"]);
	$avaliador->set_lingua($_POST["linguap"]+$_POST["linguae"]);

	// Gerando nova senha
	$salt = sha1(rand());
	$new_password = substr($salt, 0, 8);
	$password = $avaliador->encrypt_senha($new_password);
	$avaliador->set_senha($password);

	if( $avaliador->insert() )
	{

			//email
			$assunto = $evento->get_tag_email() . " Confirmação de cadastro como avaliador"	;
			$nome = explode(" ", $avaliador->get_nome());
			$nome = $nome[0];
			$mensagem = "Caro(a) " . $nome . ",\n\n";
			$mensagem .= "seu cadastro como avaliador da ".$evento->get_nome()." foi registrado em nosso sistema.\n\n\n";
			$mensagem .= "Usuário: ".$_POST["email"]."\n\n";
			$mensagem .= "Senha inicial: ".$new_password."\n\n\n";
			$mensagem .= "Essa senha pode ser alterada realizando login pelo link sifsc.ifsc.usp.br/referee.\n\n";
			$mensagem .= "Para entrar em contato com a organização, você pode usar o sistema web.\n\n";
			$mensagem .= $evento->get_assinatura_email();
			$avaliador->manda_email($assunto, $mensagem);


	}
	else
	{
		$ok = 0;
	}


	if ( $_POST['avaliaresumo'] == 1 )
	{
		$avaliacao = new avaliacao();
		$avaliacao->set_codigo_avaliador( $avaliador->get_codigo_avaliador() );
		$avaliacao->set_secao( 0 );
		$avaliacao->set_codigo_evento( $evento->get_codigo_evento() );

		if ( $avaliacao->insert() )
		{
		}
		else
		{
			$ok = 0;
		}
	}

	for ( $j = 1; $j <= 4; $j++ )
	{
		if ( isset($_POST["secao" . $j]) and $_POST["secao" . $j] == 1 )
		{
			$avaliacao = new avaliacao();
			$avaliacao->set_codigo_avaliador( $avaliador->get_codigo_avaliador() );
			$avaliacao->set_secao( $j );
			$avaliacao->set_codigo_evento( $evento->get_codigo_evento() );

			if ( $avaliacao->insert() )
			{

			}
			else
			{
				$ok = 0;
			}
		}
	}

	if( $ok == 1 )
	{
		$_SESSION['msg'] = "Avaliador incluído com sucesso!";
		echo "<script language=\"JavaScript\">location=(\"../home.php?page=listar\");</script>";
	}
	else
	{
		echo "<script language=\"JavaScript\">window.alert(\"Usuário já existente!\");history.back();</script>";
	}
}

if($page == 'alterar')
{
	// Para verificar se tudo correu bem.
	$ok = 1;
		$avaliador->find_by_codigo_avaliador($_POST["codigo"]);

	$log = new Log();
	$log->set_adm_usuario( $adm->get_usuario() );
	$log->set_codigo_evento( $evento->get_codigo_evento() );
	$log->set_operacao( 'Alterar avaliador' );
	$log->set_detalhes( 'Nome = ' . $_POST["nome"] . ' :: email = ' . $_POST["email"]  );
	$log->insert();

	if($_POST["nome"] == 'OUTRO')
	$avaliador->set_nome($_POST["outro_nome"]);
	else
	$avaliador->set_nome($_POST["nome"]);

	$avaliador->set_cpf('11111111111');
	$avaliador->set_email($_POST["email"]);
	$avaliador->set_nivel($_POST["nivel"]);
	$avaliador->set_grupo($_POST["grupo"]);
	$avaliador->set_area1($_POST["area1"]);
	$avaliador->set_area2($_POST["area2"]);
	$avaliador->set_subarea($_POST["subarea"]);
	$avaliador->set_lingua($_POST["linguap"]+$_POST["linguae"]);


	if( $avaliador->update() )
	{

	}
	else
	{
		$ok = 0;
	}

	$avaliacao = new avaliacao();
	if ( $avaliacao->find( $avaliador->get_codigo_avaliador(), 0, $evento->get_codigo_evento() ) and $_POST['avaliaresumo'] == 0 )
	{
		$avaliacao->remove($evento->get_codigo_evento(), 0);
	}
	elseif ( !$avaliacao->find( $avaliador->get_codigo_avaliador(), 0, $evento->get_codigo_evento() ) and $_POST['avaliaresumo'] == 1 )
	{
		$avaliacao = new avaliacao();
		$avaliacao->set_codigo_avaliador( $avaliador->get_codigo_avaliador() );
		$avaliacao->set_secao( 0 );
		$avaliacao->set_codigo_evento( $evento->get_codigo_evento() );

		if ( $avaliacao->insert() )
		{

		}
		else
		{
			$ok = 0;
		}
	}

	for ( $j = 1; $j <= 4; $j++ )
	{
		$avaliacao = new avaliacao();

		if ( $avaliacao->find( $avaliador->get_codigo_avaliador(), $j, $evento->get_codigo_evento() ) and !isset( $_POST["secao" . $j] ) and $_POST["secao" . $j] != 1 )
		{
			// Caso em que checkbox referente a essa seção não foi checado
			// e o avaliador avaliaria nesta seção
			//echo "remove secao".$j."\n";
			$avaliacao->remove($evento->get_codigo_evento(), $j);
		}
		elseif ( !$avaliacao->find( $avaliador->get_codigo_avaliador(), $j, $evento->get_codigo_evento() ) and isset( $_POST["secao" . $j] ) and $_POST["secao" . $j] == 1 )
		{
			// Caso em que checkbox referente a essa seção foi checado
			// e o avaliador não avaliaria nesta seção
			$avaliacao = new avaliacao();
			$avaliacao->set_codigo_avaliador( $avaliador->get_codigo_avaliador() );
			$avaliacao->set_secao( $j );
			$avaliacao->set_codigo_evento( $evento->get_codigo_evento() );
			//echo "insere".$j."\n";
			if ( $avaliacao->insert() )
			{
			}
			else
			{
				$ok = 0;
			}
		}
	}

	if( $ok == 1 )
	{
		$_SESSION['msg'] = "Dados do avaliador atualizados com sucesso!";
		echo "<script language=\"JavaScript\">location=(\"../home.php?page=alterar&codigo=".$_POST["codigo"]."\");</script>";
	}
	else{
		echo "<script language=\"JavaScript\">window.alert(\"Usuário já existente!\");location=(\"../home.php?page=listar\");</script>";
	}
}

if($page == 'excluir')
{

	$avaliador->find_by_codigo_avaliador($_POST["codigo"]);
	$avaliacao = new avaliacao();

	$log = new Log();
	$log->set_adm_usuario( $adm->get_usuario() );
	$log->set_codigo_evento( $evento->get_codigo_evento() );
	$log->set_operacao( 'Excluir avaliador' );
	$log->set_detalhes( 'Nome = ' . $avaliador->get_nome() . ' :: email = ' . $avaliador->get_email() );
	$log->insert();

	if ( $avaliador->remove() and $avaliacao->remove_by_avaliador_and_evento( $avaliador->get_codigo_avaliador(),$evento->get_codigo_evento() ) )
	{
		$_SESSION['msg'] = "Avaliador excluído.";
		echo "<script language=\"JavaScript\">location=(\"../home.php?page=listar\");</script>";
	}
	else
	{
		echo "<script language=\"JavaScript\">location=(\"../home.php?page=listar\");</script>";
	}

}

?>
