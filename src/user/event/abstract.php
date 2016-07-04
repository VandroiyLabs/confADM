<?php
require_once("~/public_html/sifsc/user/classes/class.pessoa.php");
require_once("~/public_html/sifsc/user/classes/class.evento.php");
require_once("~/public_html/sifsc/user/classes/class.inscricao.php");
require_once("~/public_html/sifsc/user/classes/class.resumo.php");
require_once("~/public_html/sifsc/user/classes/class.autor.php");

session_start();
require_once("./../user_edition_variables.php");
require_once($head_file);

require_once("~/public_html/sifsc/user/restricted.php");
require_once("~/public_html/sifsc/user/event/secao.php");


//Verificando se o participante está inscrito na edição atual
if(isset($_SESSION["SemInscricao"]) AND $_SESSION["SemInscricao"] == 1)
{
	$_SESSION['msg'] = 'Faça sua inscrição antes de prosseguir.';
	echo "<script language=\"JavaScript\">location=(\"http://sifsc.ifsc.usp.br/user/event/status.php\")</script>";
	exit();
}

?>



<?php include('index.php'); ?>

<div id="user_system">

	<div id="titulo_form_secao">
		Resumo
	</div>

	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
	?>
	<p>Caso tenha dúvias sobre a elaboração de seu resumo (e.g., referências, citação, etc), veja <a href="http://sifsc.ifsc.usp.br/downloads/Orientações_sobre_elaboração_resumos_referencias_citação.pdf" target="_blacnk">aqui um guia geral desenvolvido pelo Serviço de Biblioteca e Informação do IFSC</a>.</p>
	<form method="POST" name="abstract_form" action="action/abstract_action.php">
		<?php

			// Verifica se o resumo que está sendo editado/salvo
			// é resumo em inglês
			if ( isset($_GET['lng']) and $_GET['lng'] == 1)
			{
				$ingles = 1;
				echo "		<input type='hidden' name='ingles' value='1'/>";
			}
			else
			{
				$ingles = 0;
				echo "<input type='hidden' name='ingles' value='0'/>";
			}

			// Insere o formulário referente ao resumo
			include("~/public_html/sifsc/user/event/form/abstract_form.php");
		?>


		<input type='hidden' name='page' value='abstract'/>


		<table border="0" cellspacing="4" cellpadding="1">
		<tr>
		<?php

		// Imprime o botão de salvar sempre que puder
		if ( $inscricao->get_situacao_resumo() < 2 or $inscricao->get_situacao_resumo() == 3 )
		{
			echo "		<td class=\"button\" colspan='2' align='right'>";
			echo "			<span class=\"button\" onClick='valid_form_abstract();' style='cursor: pointer;'>Salvar</span>";
			echo "		</td>";
		}
		?>
		</tr></table>
		<?php

		// Caso o resumo já tenha sido submetido,
		// ele ficará travado.

		if ( $inscricao->get_situacao_resumo() == 2 or $inscricao->get_situacao_resumo() == 4 or $inscricao->get_situacao_resumo() == 5 or ($evento->get_inscricao_aberta()== 0 and $inscricao->get_situacao_resumo() == 0 ) or ($evento->get_submissao_aberta()== 0 and  $inscricao->get_situacao_resumo() == 1) or ( $inscricao->get_situacao_resumo() == 3 and $evento->get_resubmissao_aberta()== 0) )
		{
			echo "<SCRIPT LANGUAGE=\"javascript\"><!--\n";
			echo "toggleFormElements();\n";
			echo "// --></SCRIPT>\n";

		}
		?>
	</form>
</div>
<?php

echo '<script type="text/javascript" language="javascript" src="http://sifsc.ifsc.usp.br/user/event/script/abstract_script.js" ></script>';

 require_once($foot_file);
?>
