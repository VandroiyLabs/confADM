<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . 'public_html/sifsc/user/classes/class.pesquisa_opiniao.php');
require_once($home . 'public_html/sifsc/user/classes/class.minicurso.php');

$opcao = $_GET['opcao'];

?>

<div id="content">
<div class="post">
<div class="content">

	<h2>Pesquisa de Opinião</h2>

	<div id="barrasuperior">
		<ul>

			<li <?php if ( !isset($opcao) or $opcao == "") echo "class='active'"; ?>>
				<a href='home.php?p1=opiniao' title=''>Home</a>
			</li>

			<li <?php if($opcao == "listar") echo "class='active'"; ?>>
				<a href='home.php?p1=opiniao&opcao=listar' title=''>Listar comentários</a>
			</li>

			<li <?php if($opcao == "minicurso") echo "class='active'"; ?>>
				<a href='home.php?p1=opiniao&opcao=minicurso' title=''>Minicurso</a>
			</li>

		</ul>

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

	<?php

	if ( !isset( $opcao )  )
	{
		include($home . 'public_html/sifsc/adm/pg_site/opiniao/resumo.php');
	}
	if (  strcmp( $opcao, 'listar') == 0 )
	{
		include('opiniao/listar.php');
	}
	if (  strcmp( $opcao, 'minicurso') == 0 )
	{
		include('opiniao/minicurso.php');
	}

	?>

</div>
</div>
</div>
