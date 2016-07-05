<div id="content">
<div class="post">
	<div class="content">
	

	<table>
		<tr> 
			<td height="10" colspan="2"></td> 
		</tr> 
	</table>


	<table border="0" cellspacing="0" cellpadding="0">
		
	<?php
	$evento = new Evento();
	$evento->find_evento_aberto();
	
	$avalia_poster = new AvaliaPoster();

	

	if($_GET['tipo'] == 'painel')
	{ echo $evento->get_codigo_evento();
		$consulta = $avalia_poster->find_all_painel_by_secao($evento->get_codigo_evento(),$_GET['sessao']);

		echo "
		<h3 class='mc_title'>
			Painéis da sessão".$_GET['sessao'] ."
		</h3>";
		echo "<p>";
		while( $row = mysql_fetch_object($consulta) )
		{

			$painel="";
			if($row->nivel == 'Mestrado' or $row->nivel == 'Doutorado')
				$painel="PG";
			elseif($row->nivel == 'Graduacao')
				$painel = "GR";
			else
				$painel = "OT";
		
			$painel.=$row->codigo_pessoa;
			echo $row->nome ." -  ".$painel. "</br>";
		}
		echo "</p>";
	}
	elseif($_GET['tipo'] == 'poster')
	{
		echo "
		<h3 class='mc_title'>
			Participantes da sessão".$_GET['sessao'] ."
		</h3>";
		$consulta = $avalia_poster->find_all_resumo_by_secao($evento->get_codigo_evento(),$_GET['sessao']);

		echo "<p>";
		while( $row = mysql_fetch_object($consulta) )
		{
			
			echo $row->nome. "</br>";
		}
		echo "</p>";
	}
	elseif($_GET['tipo'] == 'avaliador')
	{
		$consulta = $avalia_poster->find_all_avaliador_by_secao($evento->get_codigo_evento(),$_GET['sessao']);
		$old_avaliador="";
	echo "
	<h3 class='mc_title'>
		Avaliadores e respectivos painéis da sessão".$_GET['sessao'] ."
	</h3>";
		echo "<p>";
		while( $row = mysql_fetch_object($consulta) )
		{

			$painel="";
			if($row->nivel == 'Mestrado' or $row->nivel == 'Doutorado')
				$painel="PG";
			elseif($row->nivel == 'Graduacao')
				$painel = "GR";
			else
				$painel = "OT";
			$painel.=$row->codigo_pessoa;

			if($old_avaliador != $row->nome)
			{			
				echo "<br />".$row->nome. "   ---    Painéis: ".$painel;
				$old_avaliador = $row->nome;
			}
			else
			{
			
				echo ", ".$painel;
			}
		}
		echo "</p>";
	}
	?>

	</table>
	
	</div>
</div>


</div>
