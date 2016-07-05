<script type="text/javascript" language="javascript" src="http://sifsc.ifsc.usp.br/user/event/script/abstract_script.js" ></script>

	<form method="POST" name="abstract_form" action="http://sifsc.ifsc.usp.br/user/event/action/abstract_action.php">
		<?php
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
			$home = "/home/" . get_current_user() . "/";
			include($home . "public_html/sifsc/user/event/form/abstract_form.php");
		?>
		<input type='hidden' name='page' value='abstract'/>

		<table border="0" cellspacing="4" cellpadding="1" width="100%">
		<tr>
		<?php
		if ( $inscricao->get_situacao_resumo() != 2 or $inscricao->get_situacao_resumo() != 4 )
		{
			$host = $_SERVER['HTTP_HOST'];
			$self = $_SERVER['PHP_SELF'];
			$query = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : null;
			$url = !empty($query) ? "http://$host$self?$query" : "http://$host$self";

			$_SESSION['url_abstract_tosave'] = $url;


			echo "		<td  colspan='2' align='center'>";
			echo "			<input type=\"button\" class=\"button_azul\" onClick='valid_form_abstract();' value=\" Salvar \" />";
			echo "		</td>";
		}
		?>
		</tr></table>

		<?php

		// Caso o resumo já tenha sido submetido,
		// ele ficará travado.

		if ( $inscricao->get_situacao_resumo() == 4 or $inscricao->get_situacao_resumo() == 5 or ($evento->get_inscricao_aberta()== 0 and ($inscricao->get_situacao_resumo() == 0 or $inscricao->get_situacao_resumo() == 1)) or ( $inscricao->get_situacao_resumo() == 3 and $evento->get_resubmissao_aberta()== 0) )
		{
			echo "<SCRIPT LANGUAGE=\"javascript\"><!--\n";
			echo "toggleFormElements();\n";
			echo "// --></SCRIPT>\n";

		}
		?>
	</form>
