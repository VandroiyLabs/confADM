<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.avaliador.php");
require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.avalia_resumo.php");
require_once($home . "public_html/sifsc/user/classes/class.nota_resumo.php");

session_start();
require_once("../referee_edition_variables.php");
require_once($head_file);

require_once($home . "public_html/sifsc/referee/event/secao.php");
require_once($home . "public_html/sifsc/referee/restricted.php");

include('index.php');

$nota_resumo = new NotaResumo();
$consulta = $nota_resumo->find_by_codigo_avaliador_evento($avaliador->get_codigo_avaliador(),$evento->get_codigo_evento());

?>

<script type="text/javascript" language="javascript" src="http://sifsc.ifsc.usp.br/referee/event/action/avalia_resumo_script.js" ></script>

<div id="user_system">



	<div id="titulo_form_secao">
		Avaliação de Resumo
	</div>


<?php
	if ( isset($_SESSION['msg']) )
	{
		echo "	<div id=\"msg\">";
		echo "<p>" . $_SESSION['msg'] . "</p>";
		echo "	</div>";
		unset($_SESSION['msg']);
	}

	if($evento->get_avaliacao_aberta() == 1)
	{


		if(mysql_num_rows($consulta) > 0)
		{



			echo "<p>Caro avaliador(a),</p>

<p>Abaixo estão listados todos os resumos que lhe foram atribuídos. Lembramos que o sorteio foi feito para que <b>cada aluno fosse avaliado da melhor maneira possível</b>, garantindo pelo menos um avaliador da sua grande área. É possível que algum resumo não seja do seu campo de conhecimento básico, mas acreditamos que os quesitos escolhidos permitirão que ele seja avaliado de qualquer forma.</p>

<p>Lembramos que, após salvar as notas de todos os resumos, o(a) senhor(a) deve clicar no botão <b>Submeter Avaliações</b> para que as notas sejam computadas pelo nosso sistema. É possível salvar uma avaliação e alterá-la mais tarde, desde que as notas não sejam submetidas.</p>

<p>O prazo máximo para submissão das notas é dia <b>19 de setembro</b>, às 23h59.</p>

<p>Na existência de qualquer dúvida sobre o processo de avaliação, por favor, entre em contato conosco utilizando o <i>Fale Conosco!</i> desta interface.</p>

<p>Atenciosamente,<br />
<i>Comissão Organizadora da SIFSC 5</i><br /><br /></p>";

	echo "<form method='POST' name='submit_question_form' action='action/submit_question_action.php'>
			<table>	<tr><td align='right' colspan='2'>	<span class='button' onClick='valid_submit_question_form();' style='cursor: pointer'; > Submeter avaliações </span></td></tr></table>
			</form>";

			$count=0;
			while($row = mysql_fetch_object($consulta))
			{
				echo "<p><a href=\"http://sifsc.ifsc.usp.br/referee/event/avalia_resumo.php?codigo=".$row->codigo_pessoa."\">".$row->titulo."</a><br /></p>";
				if($row->situacao == 0)
				{

					echo "<p>Status - avaliação pendente.<br /><br /><br /></p>";
				}
				elseif($row->situacao == 1)
				{

					echo "<p>Status - avaliação pendente de submissão.<br /><br /> Nota do Quesito 1: $row->Q1 <br /> Nota do Quesito 2: $row->Q2 <br /> Nota do Quesito 3: $row->Q3 <br /><br /><br /></p>"; $count++;
				}
				elseif($row->situacao == 2)
				{
					echo "<p>Status - avaliação submetida.<br /><br /> Nota do Quesito 1: $row->Q1 <br /> Nota do Quesito 2: $row->Q2 <br /> Nota do Quesito 3: $row->Q3 <br /> <br /><br /></p>";
				}

			}



		}
		else
		{
			echo "<p class=\"titulo\">Nenhum resumo associado ao avaliador.</p>";
		}
	}
	else
	{
		echo "<p class=\"titulo\"> Resumos ainda não disponíveis.</p>";
	}

?>

</div>

<?php
	require_once($home . "public_html/sifsc/referee/event/session.php");
	require_once($foot_file);

?>
