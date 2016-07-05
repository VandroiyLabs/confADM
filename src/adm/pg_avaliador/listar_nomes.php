<div id="content">

<div class="post">
	<div class="content">
	<h2>Lista dos nomes dos avaliadores</h2>

	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "		<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
	?>

	<table border="0" cellspacing="0" cellpadding="0" width='100%'>

	<?php

		

		$consulta = $avaliador->find_all_ab();

		echo "<p>Número de avaliadores cadastrados no momento: " . mysql_num_rows($consulta) . " (<a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listar'>voltar aos detalhes</a>)</p>";
		$total = mysql_num_rows($consulta);
		
		while ($row = mysql_fetch_object($consulta))
		{
			if ( strcmp($row->nome, 'Avaliador Teste') != 0 ) { echo $row->nome . "<br />"; }
		}
		if($total == 0)
		{
			echo "Nenhum avaliador cadastrado";
		}	
	?>
	</table>
	
	</div>
</div>

</div>
