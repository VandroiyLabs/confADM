<div id="content">
<div class="post">
	<div class='content'>
	<div id='menu' >
		<ul><li class='incluir'><a href='#' title=''><center>Premiação</center></a></li></ul>
	</div>
	<table>
		<tr> 
			<td height='12' colspan='2'></td> 
		</tr> 
		
		
		<?php
		echo "
		<h3 class='mc_title'>
			Participantes da sessão".$_GET['sessao'] ."
		</h3>";
		$ParticipaPremiacao = New ParticipaPremiacao();
		$consulta = $ParticipaPremiacao->find_all_by_evento($evento->get_codigo_evento());

		echo "<p>";
		while( $row = mysql_fetch_object($consulta) )
		{
			
			echo $row->codigo_pessoa. " & ".$row->nome. " & ".$row->nivel. " & ".$row->curso. " & ".$row->orientador. " & ".$row->tempo."</br>";
		}
		echo "</p>";
		?>
	</table>

	

	</div>
</div>

</div>