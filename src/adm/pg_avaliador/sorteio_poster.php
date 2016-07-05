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
		<tr> 
			<td height='12' colspan='2'></td> 
		</tr> 
	</table>
	
	<table border='0' width='100%' > 
		<tr>
			<td  colspan = '2' >
				
				<form method="POST" name="formulario" action="action/sorteio_poster_secao_action.php" onsubmit="return confirma_sorteio()">
					<input type="submit" value=" Sortear seções e zerar avaliadores" class="button">
				</form>
				
				<br /><br /><br /><br />
				
				<form method="POST" name="formulario" action="action/sorteio_poster_action.php?secao=1" onsubmit="return confirma_sorteio()">
					<input type="submit" value=" Sortear Avaliadores Sessão1 " class="button">
				</form>
				
				<br /><br />
				<form method="POST" name="formulario" action="action/sorteio_poster_action.php?secao=2" onsubmit="return confirma_sorteio()">
					<input type="submit" value=" Sortear Avaliadores Sessão2 " class="button">
				</form>
				
				<br /><br />
				<form method="POST" name="formulario" action="action/sorteio_poster_action.php?secao=3" onsubmit="return confirma_sorteio()">
					<input type="submit" value=" Sortear Avaliadores Sessão3 " class="button">
				</form>
				
				<br /><br />
				<form method="POST" name="formulario" action="action/sorteio_poster_action.php?secao=4" onsubmit="return confirma_sorteio()">
					<input type="submit" value=" Sortear Avaliadores Sessão4 " class="button">
				</form>
				
				
				
				<br /><br />
				
			</td> 
		</tr>
	</table>	

</div>
</div>
</div>
