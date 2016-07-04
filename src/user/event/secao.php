<?php
	$evento = new Evento();
	$pessoa = new Pessoa();
	$inscricao = new Inscricao();
	
	
	// Removing SemInscricao to be re-evaluated!
	if ( isset($_SESSION["SemInscricao"]) ) { unset( $_SESSION["SemInscricao"] ); }
	
	
	// Setando o codigo pessoa em uma variavel de secao em vez do objeto pessoa
	if ( isset( $_SESSION['codigo_pessoa'] ) )
	{
		$codigo_pessoa = $_SESSION['codigo_pessoa'];
		$pessoa->find_by_codigo( $codigo_pessoa );
		$_SESSION['pessoa'] = $pessoa;
	}
	else
	{
		$pessoa = $_SESSION["pessoa"];
		$codigo_pessoa = $pessoa->get_codigo_pessoa();
		$_SESSION['codigo_pessoa'] = $codigo_pessoa;
	}
	
	// Pegando o evento que estiver aberto
	$evento->find_evento_aberto();
	$_SESSION["evento"] = $evento;
	$_SESSION["pessoa"] = $pessoa;
	
	// Pegando a inscricao a partir do codigo pessoa recuperado
	if ( $inscricao->find_by_pessoa_evento($pessoa->get_codigo_pessoa(),$evento->get_codigo_evento()) )
	{
		$_SESSION["inscricao"] = $inscricao;
	}
	else
	{
		$_SESSION["SemInscricao"] = 1;
		unset($_SESSION["inscricao"] );
	}
?>
