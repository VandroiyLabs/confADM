<div id="content">

<div class="post">
	<div class="content">
	<h2>Lista de avaliadores</h2>

	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "		<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}


		include('./listar/listar_avaliadores.php');
	?>

</div>
</div>
</div>
