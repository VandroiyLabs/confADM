<div id="content"> 

<div class="post">
	<div class="content">
	<h2>Ranking das notas dos resumos</h2>

	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "		<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
		
		//
		// Cores para as tabelas
		//
		$color1 = "#E0E0FF";
//		$color2 = "#FFE0E0";
		$color2 = $color1;
		
		//
		// Cores dos primeiro 18 colocados
		//
		$color118 = "#C0C0FF";
//		$color218 = "#FFC0C0";
		$color218 = $color118;
		
	?>
	
	<table border="0" cellspacing="0" cellpadding="0" width='100%'>

	<?php
	
		
	$niveis = array('Graduacao', 'Mestrado', 'Doutorado');
	$limites = array('Graduacao' => 100, 'Mestrado' => 100, 'Doutorado' => 100);
	$limite_premio = array('Graduacao' => 0, 'Mestrado' => 0, 'Doutorado' => 0);
	
	
	foreach( $niveis as $nivel )
	{	
		echo "<p>Ranking de " . $nivel . "</p>";
		
		$nota_resumo = new NotaResumo();
		$consulta = $nota_resumo->ranking_by_nivel_evento( $nivel, $evento->get_codigo_evento() , $limites[$nivel]);
		
		$j = 1;
		$nota_antiga = -1.0;
		$ranking_aux = 0;
		$color = $color1;
		
		echo "<table  width='700px'>";
		echo "<tr style='background-color: " . $color . ";'>
			<td width='10%' align='center'>
				<font color='#888'><b>Colocação</b></font>
			</td>
			<td width='40%' style='padding: 2px 10px;'>
				<b>Nome<b>
			</td>
			<td width='10%' align='center'>
				<b>Média</b>
			</td>
			<td width='8%' align='center'>
				<b>Q1</b>
			</td>
			<td width='8%' align='center'>
				<b>Q2</b>
			</td>
			<td width='8%' align='center'>
				<b>Q3</b>
			</td>
			<td width='8%' align='center'>
				<b>Q4</b>
			</td>
			<td width='8%' align='center'>
				<b>Q5</b>
			</td>
			<td width='13%' align='center'>
				Avaliações
			</td>
		</tr>";	
		while ( $row = mysql_fetch_object($consulta) )
		{
			
			if ( $row->numero_avaliacoes == 2 )
			{
				$numavaliacoes = "<b><font color='green'>2 </font></b>"; 
			}
			else
			{
				$numavaliacoes = "1 ";
			}
			
			if ( 1 ) // $nota_antiga != $row->nota )
			{
				$ranking_aux++;
				$ranking = $ranking_aux;
				$nota_antiga = $row->nota;
				
				// Trocando as cores de cada linha
				if ( strcmp($color, $color1) == 0 or strcmp($color, $color118) == 0 )
				{
					if ( $j <= $limite_premio[$nivel] )
					{
						$color = $color218;
					}
					else
					{
						$color = $color2;
					}
				}
				else
				{
					if ( $j <= $limite_premio[$nivel] )
					{
						$color = $color118;
					}
					else
					{
						$color = $color1;
					}
				}
				
			}
			else
			{
				$ranking = "";
			}
			
			echo "<tr style='background-color: " . $color . ";'><td width='10%' align='center'><font color='#888'>" . $j++ . "</font></td><td width='40%' style='padding: 2px 10px;'><a href='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp=" . $row->codigo_pessoa . "' style='color: #000;'><b>" . $row->nome . "<b></a></td><td width='8%' align='center'>" . number_format($row->nota, 4, '.', '') . "</td></td><td width='8%' align='center'>" . number_format($row->Q1, 2, '.', '') . "</td><td width='8%' align='center'>" . number_format($row->Q2, 2, '.', '') . "</td><td width='8%' align='center'>" . number_format($row->Q3, 2, '.', '') . "</td><td width='8%' align='center'>" . number_format($row->Q4,2, '.', '') . "</td><td width='8%' align='center'>" . number_format($row->Q5,2, '.', '') . "</td><td width='15%' align='center'>" . $numavaliacoes . "</td></tr>";
		}
		echo "</table>";
	}
		
	?>
	</table>
	
	</div>
</div>

</div>
