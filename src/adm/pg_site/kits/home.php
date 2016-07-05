<?php
$home = "/home/" . get_current_user() . "/";
require_once($home . 'public_html/sifsc/user/classes/class.kits.php');
require_once($home . 'public_html/sifsc/user/classes/class.evento.php');

$opcao = $_GET['opcao'];

?>

<div id="content">
<div class="post">
<div class="content">

	<h2>Venda de Kits</h2>

	<div id="barrasuperior">
		<ul>

			<li <?php if ( !isset($opcao) or $opcao == "") echo "class='active'"; ?>>
				<a href='home.php?p1=kits' title=''>Listar Kits vendidos</a>
			</li>

			<li <?php if($opcao == "incluir" || $opcao == "abstract") echo "class='active'"; ?>>
				<a href='home.php?p1=kits&opcao=incluir' title=''>Incluir</a>
			</li>

			<li <?php if($opcao == "busca") echo "class='active'"; ?>>
				<a href='home.php?p1=kits&opcao=busca' title=''>Buscar</a>
			</li>

			<li <?php if($opcao == "relatorio") echo "class='active'"; ?>>
				<a href='home.php?p1=kits&opcao=relatorio' title=''>Relatório</a>
			</li>

			<li <?php if($opcao == "listatxt") echo "class='active'"; ?>>
				<a href='home.php?p1=kits&opcao=listatxt' title=''>Lista de Kits</a>
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
		include($home . 'public_html/sifsc/adm/pg_site/kits/listar.php');
	}
	if (  strcmp( $opcao, 'incluir') == 0 )
	{
		include('kits/incluir.php');
	}
	if (  strcmp( $opcao, 'entrega') == 0 )
	{
		include('kits/entrega.php');
	}
	if (  strcmp( $opcao, 'deleta') == 0 )
	{
		include('kits/deleta.php');
	}
	if (  strcmp( $opcao, 'relatorio') == 0 )
	{
		include('kits/relatorio.php');
	}
	if (  strcmp( $opcao, 'busca') == 0 )
	{
		include('kits/busca.php');
	}
	if (  strcmp( $opcao, 'listatxt') == 0 )
	{
		include('kits/listar_txt.php');
	}

	?>

</div>
</div>
</div>
