	<div id="content">
		<br />
		<p>Os comentários mais novos são exibidos em primeiro</p>
		<br />

		<?php
		
		$evento = new Evento();
		$evento->find_evento_aberto();
		$opiniao = new PesquisaOpiniao();
		
		$quesitos = array(
			1 => "Palestras",
			2 => "Workshop",
			3 => "Site",
			4 => "Kits",
			5 => "Espaço",
			6 => "Empresas",
			7 => "Outros Comentários",
		);
		
		$resposta = array(
			1 => "Ruim",
			2 => "Regular",
			3 => "Bom",
			4 => "Muito bom",
			5 => "Excelente"
		);
		
		for ( $j = 1; $j <= 6; $j++ )
		{
			$consulta = $opiniao->find_comentarios_by_quesito($j, $evento->get_codigo_evento() );
			$n_comentarios = mysql_num_rows( $consulta );
			
			// Título de cada quesito
			echo "<h3 class=\"mc_title\">Comentários sobre " . $quesitos[$j] . " (" . $n_comentarios . " comentários)</h3>";
			
			
			// Imprimindo a distribuição de respostas
			echo "<p>Distribuição das respostas<br />";
			for ( $notas = 1; $notas <= 5; $notas++ )
			{
				$op = mysql_fetch_row( $opiniao->quantidade_respostas($j, $notas, $evento->get_codigo_evento()) );
				echo "<b><u>" . $resposta[$notas] . "</u>:</b> " . $op[0] . "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
			}
			echo "</p>";
			
			
			// Calculando a média
			$mediacons = $opiniao->media_quesito($j, $evento->get_codigo_evento() );
			$row = mysql_fetch_row($mediacons);
			$n_notas = mysql_num_rows( $opiniao->find_comentarios_notas_by_quesito($j, $evento->get_codigo_evento() ) );
			echo "<p>Média deste quesito: <b>" . $row[0] . "</b> medido em " . $n_notas . " opiniões</p>";
			
			
			// Imprimindo em lista os comentários enviados
			// neste quesito
			echo "<ul>";
			while ( $row = mysql_fetch_row($consulta) )
			{
				echo "<li>" . nl2br($row[0]) . "<br />Nota: <b>" . $row[1] . "</b><br /><br /></li>";
			}
			echo "</ul>";
		}
		
		$consulta = $opiniao->find_comentarios_by_quesitogeral($evento->get_codigo_evento() );
		$n_comentarios = mysql_num_rows( $consulta );
			
		echo "<h3 class=\"mc_title\">" . $quesitos[$j] . " (" . $n_comentarios . " comentários)</h3>";
				
		echo "<ul>";
		while ( $row = mysql_fetch_row($consulta) )
		{
			echo "<li>" . nl2br($row[0]) . "<br /><br /></li>";
		}
		echo "</ul>";
	
		?>

	</div>
