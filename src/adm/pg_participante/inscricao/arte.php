	<div id='menu' >
		<ul><li class='incluir'><a href='#' title=''><center>Arte</center></a></li></ul>
	</div>

<script type="text/javascript" language="javascript" src="http://sifsc.ifsc.usp.br/user/event/script/arte_script.js" ></script>

<?php
$home = "/home/" . get_current_user() . "/";

		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}

		$modalidade = $inscricao->get_modalidade();

		if ( $modalidade[4] == 0 or $modalidade[4] == 1 or (isset( $_SESSION['adm'] ) && $modalidade[4] == 2))
		{
	?>

	<form method="POST" name="formulario" action="http://sifsc.ifsc.usp.br/user/event/action/arte_action.php" >



		<?php 	include($home . "public_html/sifsc/user/event/form/arte_form.php"); ?>

		<input type='hidden' name='page' value=''/>
		<input type='hidden' name='submissao' value='0'/>
		<table cellspacing="15" cellpadding="1" border="0"  width="100%">
		<tr>
			<td  colspan='2' align='right'>
				<input type="button" class="button" onClick='valid_form();' value=" Salvar " />
			</td>
		</tr>
		</table>


		<?php if($aberto == 0 )
		{?>
				<script language="JavaScript">desabilita();</script>
		<?php }
		elseif($inscricao->get_codigo_arte()== 0 )
		{ ?>
				<script language="JavaScript">desabilita_arte();</script>
		<?php }?>

	</form>

	<?php

		}
		elseif( $modalidade[4] == 2 )
		{
			// Arte já submetida e esperando avaliação pela organização
			echo "<h2 class=\"deferimento\">Sua obra de arte está sob avaliação.</h2>";

			echo "<p>Sua obra de arte:</p>";
			include($home . 'public_html/sifsc/user/event/show_arte.php');
		}
		elseif( $modalidade[4] == 3 )
		{
			// Arte foi indeferida
			echo "<h2 class=\"deferimento\">Sua obra de arte foi indeferida.</h2>";
			echo "<p>Segue o motivo pelo indeferimento:</p>";

		 	require_once($home . "public_html/sifsc/user/classes/class.deferimento.php");
			$def = new Deferimento();
			$def->find_by_evento_pessoa_arte(1, $pessoa->get_codigo_pessoa(), $inscricao->get_codigo_arte());
			echo "<hr class=\"notadeferimentou\" /><p class=\"notadeferimento\">" . nl2br( $def->get_comentario() ) . "</p><hr class=\"notadeferimentod\" /><br /><br />";

			echo "<p>Sua obra de arte:</p>";
			include('show_arte.php');
		}
		elseif( $modalidade[4] == 4 )
		{
			// Arte deferida
			echo "<h2 class=\"deferimento\">Sua obra de arte foi deferida, parabéns!! <br /> Entre em contato com a comissão para maiores detalhes.</h2>";

			echo "<p>Sua obra de arte:</p>";
			include($home . 'public_html/sifsc/user/event/show_arte.php');
		}

	?>
