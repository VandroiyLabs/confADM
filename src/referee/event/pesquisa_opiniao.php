<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.avaliador.php");
require_once($home . "public_html/sifsc/user/classes/class.avaliacao.php");
require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.pesquisa_opiniao.php");

session_start();

require_once("../referee_edition_variables.php");
require_once($head_file);

require_once($home . "public_html/sifsc/referee/restricted.php");
require_once($home . "public_html/sifsc/referee/event/secao.php");


include('index.php');

$codigo_avaliador = $avaliador->get_codigo_avaliador();

?>

<div id="user_system">

	<div id="titulo_form_secao">
		Pesquisa de Opinião
	</div>

	<div id="status">

		<p>Por meio deste formulário, você pode expressar sua opinião sobre a <?php echo $evento->get_nome();?>. Caso não queira opinar sobre algum dos itens abaixo, basta não marcar nenhuma opção. Os comentários escritos também são opcionais.</p>


		<?php

		// Verificando se o usuario jah opinou alguma vez
		$opiniao = new PesquisaOpiniao();

		//Para fechar a pesquisa
		if(!$evento->get_pesquisa_aberta())
		{
			echo "<p> → Ainda não disponível!</p>";
		}
		elseif ( ! $opiniao->find_by_avaliador_evento( $codigo_avaliador, $evento->get_codigo_evento() ) )
		{
			//Avaliacao pelo formulario
			//include("form/opiniao_form.php");
			//echo "<br />";

			//Avaliacao pelo google docs
			echo "<p><a href='https://docs.google.com/forms/d/1kBuD8jrwv7bNy7fFnccfDU_ixHPlCOyEnjrQ8_vYlCA/viewform' target='_blank'> Clique aqui para acessar.</a></p>";
		}
		else
		{
			echo "<p> → Sua opinião já foi registrada!</p>";
		}

		?>

	</div>


</div>

<?php
require_once($foot_file);
?>
