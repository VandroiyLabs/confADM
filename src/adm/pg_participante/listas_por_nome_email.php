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
	
	$consulta = $inscricao->find_all_nomes_and_emails_by_evento($evento->get_codigo_evento());
	
	
	echo "<p>";
	while( $row = mysql_fetch_object($consulta) )
	{
		echo $row->nome . " & ". $row->email."</br>";
	}
	echo "</p>";
	
	?>

	</table>
	
	</div>
</div>


</div>