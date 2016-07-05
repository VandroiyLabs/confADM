<div id="content">
<div class="post">
	<div class="content">
	<h2>Listar por nome</h2>
	

	<table>
		<tr> 
			<td height="12" colspan="2"></td> 
		</tr> 
	</table>


	<table border="0" cellspacing="0" cellpadding="0">
		
	<?php
	$evento = new Evento();
	$evento->find_evento_aberto();
	
	$inscricao = new Inscricao();
	
	$codigo = "";
	
	if( isset($_GET['mod']) and strcmp($_GET['mod'], "IFSC") == 0 )
	{
		$consulta = $inscricao->find_all_resumo_ifsc_pos($evento->get_codigo_evento());
	}
	elseif ( isset($_GET['mod']) and strcmp($_GET['mod'], "") != 0 and isset($_GET['cod']) and $_GET['cod'] == 1 )
	{
		$consulta = $inscricao->find_nomes_codigo_by_evento_e_modalidade($evento->get_codigo_evento(), $_GET['mod']);
	}
	elseif ( isset($_GET['mod']) and strcmp($_GET['mod'], "") != 0 )
	{
		$consulta = $inscricao->find_nomes_by_evento_e_modalidade($evento->get_codigo_evento(), $_GET['mod']);
	}
	else
	{
		$consulta = $inscricao->find_nomes_by_evento_e_modalidade($evento->get_codigo_evento(), "1%");
	}
	
	echo "<p>";
	if ( isset($_GET['cod']) and $_GET['cod'] == 1 )
	{
		while( $row = mysql_fetch_object($consulta) )
		{
		      echo $row->nome . " (cod. " . $row->codigo_pessoa . ")</br>";
		}
	}
	else
	{
		while( $row = mysql_fetch_object($consulta) )
		{
		      echo $row->nome . "</br>";
		}
	}
	echo "</p>";
	
	?>

	</table>
	
	</div>
</div>


</div>