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

	<h2>Atribuição de Avaliadores de Resumos </h2>

	<table>
		<tr> 
			<td height='12' colspan='2'></td> 
		</tr> 
	</table>
	
	<table border='0' width='100%' > 
		<tr>
			<td align='left' >
				<input type='button' value=" Ranking de Notas " class="button_verde" OnClick="parent.location='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=ranking'" >
			</td> 

			<td align='right' >
				<form method="POST" name="formulario" action="action/sorteio_resumo_action.php" onsubmit="return confirma_sorteio()">
					<input type="submit" value=" Realizar Sorteio Automático " class="button">
				</form>
			</td> 
		</tr>
	</table>
	
	<?php include("./atribuicao_resumo/listar_avaliacoes.php");	?>






</div>
</div>
</div>
