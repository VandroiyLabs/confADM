<?php

$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];

$status_conta = ' ';
$choosable = 1;
$items = array(
	0 => 'class="button"',
	1 => 'class="button"',
	2 => 'class="button"',
	3 => 'class="button"',
	4 => 'class="button"',
	5 => 'class="button"',
	6 => 'class="button"',
	7 => 'class="button"'
);

if ( strcmp($currentFile, 'status.php') == 0 )
{
	$items[0] = 'class="chosen"';
}
elseif ( strcmp($currentFile, 'avalia_resumo_home.php') == 0 or strcmp($currentFile, 'avalia_resumo.php') == 0 or strcmp($currentFile, 'submit_question_action.php') == 0 )
{
	$items[1] = 'class="chosen"';
}
elseif ( strcmp($currentFile, 'avalia_poster.php') == 0  or  strcmp($currentFile, 'workshop_home.php') == 0)
{
	$items[2] = 'class="chosen"';
}

elseif ( strcmp($currentFile, 'senha.php') == 0 )
{
	$items[3] = 'class="chosen"';
}
elseif ( strcmp($currentFile, 'certificado.php') == 0 )
{
	$items[4] = 'class="chosen"';
}

elseif ( strcmp($currentFile, 'faleconosco.php') == 0 )
{
	$items[5] = 'class="chosen"';
}

elseif ( strcmp($currentFile, 'pesquisa_opiniao.php') == 0 )
{
	$items[6] = 'class="chosen"';
}

?>

<div id="floating-menu">

	<div id="upper">
		<h3>Área do avaliador</h3>
		<?php 
		if ( strcmp($avaliador->get_nome(), "") == 0 )
		{
			echo "<p>Olá, visitante</span>.</p>";
		}
		else
		{
			$nomepessoa = explode(" ", $avaliador->get_nome());
			if ($nomepessoa[0] != "")
			{
				$nomepessoa = $nomepessoa[0];
			}
			else
			{
				$nomepessoa = $avaliador->get_nome();
			}
			?>
			<p>Olá, <span id=\"nome_participant\"><? echo $nomepessoa; ?></span>.</p>
			<?php 
		}
		?>
	</div>
	
	<p class="logout"><a href="http://sifsc.ifsc.usp.br/referee/logconfig/logout.php">Sair</a></p>
	
	<ul>
		<li><a href="http://sifsc.ifsc.usp.br/referee/event/status.php" <?php echo $items[0] ?>>&nbsp;Status da conta</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/referee/event/avalia_resumo_home.php" <?php echo $items[1] ?>>&nbsp;Avaliar Resumos</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/referee/event/workshop_home.php" <?php echo $items[2] ?>>&nbsp;Workshop</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/referee/event/senha.php" <?php echo $items[3] ?>>&nbsp;Alterar senha</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/referee/event/certificado.php" <?php echo $items[4] ?>>&nbsp;Certificados</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/referee/event/pesquisa_opiniao.php"  <?php echo $items[6] ?>>&nbsp;Pesquisa de opinião</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/referee/event/faleconosco.php" <?php echo $items[5] ?>>&nbsp;Fale conosco!</a></li>
	</ul>

</div>
