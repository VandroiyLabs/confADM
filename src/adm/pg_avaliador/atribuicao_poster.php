<div id="content">
<div class="post">
<div class='content'>


	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "		<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
	?>

<SCRIPT LANGUAGE="JavaScript" TYPE="text/javascript">

function confirma_sorteio()
{	
	decisao = confirm("Esta é uma tarefa pesada, pode levar alguns segundos. Sortear avaliadores?");

	if (decisao)
	{
		document.formulario.submit();
	}
	else
	{
		return false;
	}	
};
</SCRIPT>

	<h2>Atribuição de Avaliadores de Posters </h2>
	
	<table>
		<tr width="100%"> 
			<td align="center"><a style="font-size: 18px;" href="http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=lista_ordenada_poster">Mapa ordenado por secoes</a></td> 
		</tr> 
	</table>
	<br />
	
	<table border='0' width='100%' > 
		<tr>
			<td  colspan = '2' >
				<form method="POST" name="formulario" action="./home.php?page=sorteio_poster">
					<input type="submit" value=" Realizar sorteio " class="button">
				</form>
			</td> 
		</tr>
	</table>
	
	<?php 
		include("./atribuicao_poster/listar_avaliacoes.php");
	?>
	
</div>
</div>
</div>
