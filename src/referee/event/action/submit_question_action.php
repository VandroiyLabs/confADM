<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.avaliador.php");
require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.nota_resumo.php");

session_start();
require_once("../../referee_edition_variables.php");
require_once($head_file);

require_once($home . "public_html/sifsc/referee/event/secao.php");
require_once($home . "public_html/sifsc/referee/restricted.php");

include('../index.php');

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
			$ok=1; $count=0;

			$mensagem_email=""; $mensagem="";
			while($row = mysql_fetch_object($consulta))
			{
				if($row->situacao == 0)
				$ok=0;

				if($row->situacao == 1)
				{
					$mensagem_email.=$row->titulo."\n\n";
					$mensagem_email.="Notas:\n";
					$mensagem_email.="Nota do Quesito 1: ".$row->Q1."\n";
					$mensagem_email.="Nota do Quesito 2: ".$row->Q2."\n";
					$mensagem_email.="Nota do Quesito 3: ".$row->Q3."\n";
					//$mensagem_email.="Nota do Quesito 4: ".$row->Q4."\n";
					//$mensagem_email.="Nota do Quesito 5: ".$row->Q5."\n";
					$mensagem_email.="\n\n\n";

					$mensagem.="<p>".$row->titulo."<br \><br \>";
					$mensagem.="Nota do Quesito 1: ".$row->Q1."<br \>";
					$mensagem.="Nota do Quesito 2: ".$row->Q2."<br \>";
					$mensagem.="Nota do Quesito 3: ".$row->Q3."<br \>";
					//$mensagem.="Nota do Quesito 4: ".$row->Q4."<br \>";
					//$mensagem.="Nota do Quesito 5: ".$row->Q5."<br \>";
					$mensagem.="<br \><br \><br \></p>";
					$count++;
				}

			}

			if($ok == 1)
			{
				if($count > 0)
				{
					echo "<p>Abaixo estão listadas as notas dadas pelo senhor(a) a cada um dos resumos. Confirme sua avaliação clicando no botão no fim da página. Após submetê-la, as notas <b>não poderão ser alteradas</b>.<br /><br /></p>";
				 	echo $mensagem;

					echo "<form method='POST' name='submit_form' action='submit_action.php'>
				<table>	<tr><td align='right' colspan='2'>	<span class='button' onClick='valid_submit_form();' style='cursor: pointer'; > Sim, quero submeter as avaliações acima listadas </span></td></tr></table>
				</form>";
				}
				else
				{
					echo "<p class=\"titulo\">Nenhuma avaliação para submeter.</p>";
				}

			}
			else
			{
				echo "<p class=\"titulo\">Existem resumos pendentes de avaliação.</p>";
			}

		}
		else
		{
			echo "<p class=\"titulo\">Nenhum resumo associado ao avaliador.</p>";
		}
	}
	else
	{
		echo "<p class=\"titulo\"> Avaliações fechadas.</p>";
	}

?>

</div>

<?php
require_once($foot_file);
?>
