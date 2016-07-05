<?php
	$resumo = new Resumo();
	$resumo->find_by_codigo($inscricao->get_codigo_resumo());
	$_SESSION['resumo'] = $resumo;

?>


	<a name="submissaoresumo">
	<div id="submissao">
		<div id="titulo_secao">
			Situação do resumo
		</div>
	<?php

	if ( $inscricao->get_situacao_resumo() == 0 )
	{
		echo "\t\t<p>Nada foi salvo por este usuário.</p>";
	}

	if ( $inscricao->get_situacao_resumo() == 1 or $inscricao->get_situacao_resumo() == 3 )
	{
		echo "\t\t<p>Usuário já salvo algo no resumo. Um preview está disponível abaixo.</p>";
	}

	if ( $inscricao->get_situacao_resumo() == 2 )
	{
		echo "\t\t<p>Resumo está aguardando deferimento.</p>\n";
	}

	if ( $inscricao->get_situacao_resumo() == 4 )
	{
		echo "\t\t<p>Este resumo foi indeferido pela organização.</p>\n";
	}

	if ( $inscricao->get_situacao_resumo() == 5 )
	{
		echo "\t\t<p>Este resumo foi aceito pela comissão organizadora.</p>\n";
	}

	if ( $inscricao->get_situacao_resumo() == 0 or $inscricao->get_situacao_resumo() == 1 or $inscricao->get_situacao_resumo() == 3 )
	{
	?>
	<ul>
		<li><a class="resumo" href="http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=incluir&opcao=abstract">Escrever/editar resumo em português</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=incluir&opcao=abstract&lng=1" <?php if($inscricao->get_codigo_resumo() == 0) { echo "class='closed'";}else{echo "class='resumo'";} ?>>Escrever/editar resumo em inglês (apenas depois de salvar uma versão em português)</a></li>
 	</ul>
	<?php
	}


	$home = "/home/" . get_current_user() . "/";
	include($home . 'public_html/sifsc/adm/pg_participante/inscricao/show_abstracts.php');

	?>
	</div>
