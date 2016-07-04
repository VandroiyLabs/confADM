<?php

	require_once("~/public_html/sifsc/user/classes/class.pessoa.php");
	require_once("~/public_html/sifsc/user/classes/class.evento.php");
	require_once("~/public_html/sifsc/user/classes/class.inscricao.php");
	require_once("~/public_html/sifsc/user/classes/class.autor.php");
	require_once("~/public_html/sifsc/user/classes/class.arte.php");
	require_once("~/public_html/sifsc/user/classes/class.minicurso.php");
	require_once("~/public_html/sifsc/user/classes/class.avalia_poster.php");
	require_once("~/public_html/sifsc/user/classes/class.participa_premiacao.php");
	require_once("~/public_html/sifsc/user/classes/class.participa_minicurso.php");
	require_once("~/public_html/sifsc/user/classes/class.resumo.php");
	require_once("~/public_html/sifsc/user/classes/class.kits.php");

	session_start();

	require_once("./../user_edition_variables.php");
	require_once($head_file);

	require_once("~/public_html/sifsc/user/restricted.php");

	$pessoa = new Pessoa();
	$codigo_pessoa = $_SESSION["codigo_pessoa"];
	$pessoa->find_by_codigo( $codigo_pessoa );
	$_SESSION['pessoa'] = $pessoa;


	$evento_aberto = new Evento();
	$evento_aberto->find_evento_aberto();
	$num_eventos = $evento_aberto->get_codigo_evento();

	$inscricao_antiga = new Inscricao();

	for ( $j = $num_eventos; $j >= 1; $j-- )
	{
		if ( $inscricao_antiga->find_by_pessoa_evento( $pessoa->get_codigo_pessoa(), $j )  )
		{
			$evento = new Evento();
			$evento->find_by_codigo($j);
		}
	}
	$inscricao = $inscricao_antiga;
	$_SESSION["inscricao"] = $inscricao;

	include('index_activation.php');

?>

<div id="user_system">

	<div id="titulo_form_secao">
		Status da Conta
	</div>

	<div id="status">

		<p>Seja bem vindo à sua área de usuário. Para atualizar detalhes de sua conta (dados pessoais, resumo, etc), navegue usando as abas laterais. Abaixo, a situação geral de sua conta.</p>

		<ul>
			<li>.</li>
		</ul>
	</div>


</div>

<?php  require_once($foot_file);?>
