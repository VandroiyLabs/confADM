<?php

	require_once("~/public_html/sifsc/user/classes/class.pessoa.php");
	require_once("~/public_html/sifsc/user/classes/class.evento.php");
	require_once("~/public_html/sifsc/user/classes/class.inscricao.php");
	require_once("~/public_html/sifsc/user/classes/class.minicurso.php");
	require_once("~/public_html/sifsc/user/classes/class.participa_minicurso.php");
	require_once("~/public_html/sifsc/user/classes/class.kits.php");
	require_once("~/public_html/sifsc/user/classes/class.pesquisa_opiniao.php");

	session_start();

	require_once("./../user_edition_variables.php");
	require_once($head_file);

	require_once("~/public_html/sifsc/user/restricted.php");
	require_once("~/public_html/sifsc/user/event/secao.php");


	include('index.php');

	$codigo_pessoa = $pessoa->get_codigo_pessoa();

?>

<div id="user_system">

	<div id="titulo_form_secao">
		Pesquisa de Opinião
	</div>

	<div id="status">

		<p>Por meio deste formulário, você pode expressar sua opinião sobre a <?php echo $evento->get_nome(); ?>. Caso não queira opinar sobre algum dos itens abaixo, basta não marcar nenhuma opção. Os comentários escritos também são opcionais.</p>


		<?php

		// Verificando se o usuario jah opinou alguma vez
		$opiniao = new PesquisaOpiniao();
		if(!$evento->get_pesquisa_aberta())//Para fechar a pesquisa
		{
			echo "<p> → Ainda não disponível!</p>";

		}
		elseif ( ! $opiniao->find_by_pessoa_evento( $codigo_pessoa, $evento->get_codigo_evento() ) )
		{
			echo "<p><a href='https://docs.google.com/forms/d/1kBuD8jrwv7bNy7fFnccfDU_ixHPlCOyEnjrQ8_vYlCA/viewform' target='_blank'> Clique aqui para acessar.</a></p>";
		}
		else
		{
			echo "<p> → Sua opinião já foi registrada!</p>";
		}

		?>

	</div>


</div>

<?php  require_once($foot_file);?>
