	<div id='menu' >
		<ul><li class='incluir'><a href='#' title=''><center>Minicursos</center></a></li></ul>
	</div>

	<?php
		$situacao = $inscricao->get_modalidade();

		if ( strcmp($situacao[3], '0') == 0 )
		{
	?>
	<p>Minicursos têm vagas limitadas. Caso queira participar de um, basta selecionar abaixo sua opção e clicar em salvar (sua escolha não poderá ser modificada depois disso). Isso não precisa ser feito agora, você pode escolher o minicurso quando quiser, limitando-se apenas ao número de vagas.</p>
	<script type="text/javascript" language="javascript" src="http://sifsc.ifsc.usp.br/user/event/script/minicurso_script.js" ></script>
	<form accept-charset="ISO-8859-1" method="POST" name="formulario" action="http://sifsc.ifsc.usp.br/user/event/action/minicurso_action.php" >

		<?php
		$home = "/home/" . get_current_user() . "/";
		include($home . "public_html/sifsc/user/event/form/minicurso_form.php"); 
		?>

		<input type='hidden' name='page' value=''/>
		<input type='hidden' name='total' value="<?=$total?>"/>
	<table cellspacing="15" cellpadding="1" border="0" width="100%">
		<tr>

			<td  align='right'>
						<input type="button" class="button_azul" onClick='valid_form();' value=" Salvar "/>
			</td>
		</tr>
	</table>
	</form>

		<?php

			//echo "<script language=\"JavaScript\">desabilita();</script>";

		}
		elseif ( strcmp($situacao[3], '1') == 0 )
		{
			echo "<p>Inscrição com sucesso no seguinte minicurso:</p>";

			$participacao->find_by_codigo($pessoa->get_codigo_pessoa(),$evento->get_codigo_evento());
			$minicurso->find_by_codigo($participacao->get_codigo_minicurso());

			echo "<table cellspacing=\"15\" cellpadding=\"1\" border=\"0\" >";
			echo "			<tr>\n				" .
			"<td class='mc_titulo'><b>".$minicurso->get_titulo()."</b> </td>\n".
			"			</tr>".
			"			<tr>\n				" .
			"<td class='mc_autor2'>" . $minicurso->get_responsavel() . "</td>\n".
			"			</tr>".
			"			<tr>\n				" .
			"<td class='mc_descricao2'><b>Resumo:</b> " . $minicurso->get_descricao() . "</td>\n".
			"			</tr><tr><td></td></tr>";
			echo "</table>";
		}
		?>
