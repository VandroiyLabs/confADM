<?php

function number_significant($number, $decimals, $sep1='.', $sep2='') {

        if (($number * pow(10 , $decimals + 1) % 10 ) == 5)  //if next not significant digit is 5
            $number -= pow(10 , -($decimals+1));

        return number_format($number, $decimals, $sep1, $sep2);

}

?>



<div id="content">
<div class="post">
<div class="content">

	<h2>Relatório de Participantes</h2>
	
	<?php

	echo "
	<h3 class='mc_title'>
		Listas de painéis por sessão
	</h3>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=painel&sessao=1'>Lista de painéis da sessão 1</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=painel&sessao=2'>Lista de painéis da sessão 2</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=painel&sessao=3'>Lista de painéis da sessão 3</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=painel&sessao=4'>Lista de painéis da sessão 4</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=painel&sessao=5'>Lista de painéis da sessão 5</a></p>";




	echo "
	<h3 class='mc_title'>
		Listas de avaliadores e respectivos painéis por sessão
	</h3>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=avaliador&sessao=1'>Lista de avaliadores e painéis da sessão 1</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=avaliador&sessao=2'>Lista de avaliadores e painéis da sessão 2</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=avaliador&sessao=3'>Lista de avaliadores e painéis da sessão 3</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=avaliador&sessao=4'>Lista de avaliadores e painéis da sessão 4</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=avaliador&sessao=5'>Lista de avaliadores e painéis da sessão 5</a></p>";

	
	echo "
	<h3 class='mc_title'>
		Listas de nomes por sessão
	</h3>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=poster&sessao=1'>Lista dos nomes da sessão 1</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=poster&sessao=2'>Lista dos nomes da sessão 2</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=poster&sessao=3'>Lista dos nomes da sessão 3</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=poster&sessao=4'>Lista dos nomes da sessão 4</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listanomes&tipo=poster&sessao=5'>Lista dos nomes da sessão 5</a></p>";


	?>
	
</div>
</div>
</div>
