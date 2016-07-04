<?php


$currentFile = $_SERVER["SCRIPT_NAME"];
$parts = Explode('/', $currentFile);
$currentFile = $parts[count($parts) - 1];


// Checando o status da inscricao, caso existente
if ( !isset($_SESSION["SemInscricao"]) and $_SESSION["SemInscricao"] != 1 )
{
	$status_insc = $inscricao->get_modalidade(1,4);
}

$status_dic = array();
if ( !isset($status_insc[0]) or ( isset($_SESSION["SemInscricao"]) and $_SESSION["SemInscricao"] == 1 )  )
{
	$status_conta = ' class="closed"';
	$choosable = 0;
	$items = array(
		0 => 'class="button"',
		1 => 'class="closed"',
		2 => 'class="closed"',
		3 => 'class="closed"',
		4 => 'class="closed"',
		5 => 'class="button"',
		6 => 'class="button"',
		7 => 'class="button"',
		8 => 'class="button"'
		);
}
else if ( $status_insc[0] == '0' )
{
	$status_conta = ' class="closed"';
	$choosable = 0;
	$items = array(
		0 => 'class="button"',
		1 => 'class="button"',
		2 => 'class="closed"',
		3 => 'class="closed"',
		4 => 'class="closed"',
		5 => 'class="button"',
		6 => 'class="closed"',
		7 => 'class="button"',
		8 => 'class="button"'
		);
}
else
{
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
		7 => 'class="button"',
		8 => 'class="button"'
		);
}


if ( strcmp($currentFile, "registration.php") == 0 || strcmp($currentFile, "senha.php") == 0 )
{
	$items[1] = 'class="chosen"';
}
//else if ( strcmp($currentFile, 'abstract_home.php') == 0 || strcmp($currentFile, 'abstract.php') == 0 || strcmp($currentFile, 'abstract.php?lingua=ingles') == 0 )
else if ( strrpos($currentFile, "abstract") !== False )
{
	$items[2] = 'class="chosen"';
}
else if ( strcmp($currentFile, 'minicursos.php') == 0 )
{
	$items[3] = 'class="chosen"';
}
else if ( strrpos($currentFile, "arte") !== False )
{
	$items[4] = 'class="chosen"';
}
else if ( strcmp($currentFile, 'certificado.php') == 0)
{
	$items[6] = 'class="chosen"';
}
else if ( strcmp($currentFile, 'status.php') == 0 )
{
	$items[0] = 'class="chosen"';
}
else if ( strcmp($currentFile, 'downloads.php') == 0 )
{
	$items[5] = 'class="chosen"';
}
else if ( strcmp($currentFile, 'pesquisa_opiniao.php') == 0 )
{
	$items[7] = 'class="chosen"';
}
else if ( strcmp($currentFile, 'faleconosco.php') == 0 )
{
	$items[8] = 'class="chosen"';
}

?>

<div id="floating-menu">

	<div id="upper">
		<h3>Área do usuário</h3>
		<?php 
		if ( strcmp($pessoa->get_nome(), "") == 0 )
		{
			echo "<p>Olá, visitante</span>.</p>";
		}
		else
		{
			$nomepessoa = explode(" ", $pessoa->get_nome());
			if ($nomepessoa[0] != "")
			{
				$nomepessoa = $nomepessoa[0];
			}
			else
			{
				$nomepessoa = $pessoa->get_nome();
			}
			?>
			<p>Olá, <span id=\"nome_participant\"><? echo $nomepessoa; ?></span>.</p>
			<?php 
		}
		?>
	</div>
	
	<p class="logout"><a href="http://sifsc.ifsc.usp.br/user/logconfig/logout.php">Sair</a></p>
	
	<ul>
		<li><a href="http://sifsc.ifsc.usp.br/user/event/status.php" <?php echo $items[0] ?>>&nbsp;Status da conta</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/user/event/registration.php" <?php echo $items[1] ?>>&nbsp;Dados pessoais</a></li>
		<li><a <?php if ( strcmp($items[2], 'class="closed"') != 0 ) { echo 'href="http://sifsc.ifsc.usp.br/user/event/abstract_home.php"'; } else { echo 'href="#"'; } ?> <?php echo $items[2] . $status_conta ?>>&nbsp;Resumo</a></li>
		<li><a <?php if ( strcmp($items[3], 'class="closed"') != 0 ) { echo 'href="http://sifsc.ifsc.usp.br/user/event/minicursos.php"'; } else { echo 'href="#"'; } ?> <?php echo $items[3] . $status_conta ?>>&nbsp;Minicurso</a></li>
		<li><a <?php if ( strcmp($items[4], 'class="closed"') != 0 ) { echo 'href="http://sifsc.ifsc.usp.br/user/event/arte.php"'; } else { echo 'href="#"'; } ?> <?php echo $items[4] . $status_conta ?>>&nbsp;Obra de arte</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/user/event/downloads.php" <?php echo $items[5] ?> >&nbsp;Downloads</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/user/event/certificado.php" <?php echo $items[6] ?>>&nbsp;Certificados</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/user/event/pesquisa_opiniao.php" <?php echo $items[7] ?> >&nbsp;Pesquisa de Opinião</a></li>
		<li><a href="http://sifsc.ifsc.usp.br/user/event/faleconosco.php" <?php echo $items[8] ?>>&nbsp;Fale conosco!</a></li>
	</ul>

</div>
