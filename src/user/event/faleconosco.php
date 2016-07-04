<?php

require_once("~/public_html/sifsc/user/classes/class.pessoa.php");
require_once("~/public_html/sifsc/user/classes/class.evento.php");
require_once("~/public_html/sifsc/user/classes/class.inscricao.php");
require_once("~/public_html/sifsc/user/classes/class.arte.php");
require_once("~/public_html/sifsc/user/classes/class.minicurso.php");
require_once("~/public_html/sifsc/user/classes/class.participa_minicurso.php");
require_once("~/public_html/sifsc/user/classes/class.resumo.php");
session_start();
require_once("./../user_edition_variables.php");
require_once($head_file);

require_once("~/public_html/sifsc/user/restricted.php");
require_once("~/public_html/sifsc/user/event/secao.php");

?>

<?php include('index.php'); ?>

<div id="user_system">

	<div id="titulo_form_secao">
		Contato com a organização
	</div>

	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "		<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
	?>

	<div id="status">

		<p>Nesta seção, você tem um canal rápido para conversar com a organização. Se quiser fazer perguntas à organização, dê preferência por começar uma conversa através desta página para agilizar a identificação de seu problema e, quem sabe, agilizar a solução de qualquer problema que você possa ter.</p>

		<form method="POST" action="action/contato_action.php">
			<table border="0" cellspacing="4" cellpadding="1">
				<tr>
					<td align="right" width="30%">Assunto: </td>
					<td align="left"><input type="text" name="assunto" value="" size="30" /></td>
				</tr>
				<tr>
					<td align="right" width="30%">Escolha o que melhor<br />enquadra seu contato:</td>
					<td>
						<select name="natureza">
							<option value="Sistema eletrônico da SIFSC">Sistema eletrônico da SIFSC</option>
							<option value="Regras para as referências do resumo">Regras para as referências do resumo</option>
							<option value="Minicursos">Minicursos</option>
							<option value="Obra de arte">Obra de arte</option>
							<option value="Palestras da biblioteca">Palestras da biblioteca</option>
							<option value="Certificados">Certificados</option>
							<option value="Venda de KITs">Venda de KITs</option>
							<option value="Outro">Outro</option>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" width="30%">Mensagem: </td>
					<td align="left"><textarea name="mensagem" rows="10" cols="29" value=""></textarea></td>
				</tr>
				<tr>
					<td align="center" colspan='2'><input type="submit" value="Enviar" /></td>
				</tr>
			</table>
		</form>

	</div>


	</table>
</div>

<?php  require_once($foot_file);?>
