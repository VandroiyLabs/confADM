	<div id="vendakits">
	
		<ul>
		<?php
		
		$evento = new Evento();
		$evento->find_evento_aberto();
		$opiniao = new PesquisaOpiniao();
		
		$consulta = $opiniao->find_all_by_evento($evento->get_codigo_evento());
		echo "<li><b>Número de respostas:</b> " . mysql_num_rows($consulta) . "</li>";
		
		$consulta = $opiniao->find_all_participantes_by_evento($evento->get_codigo_evento());
		echo "<li><b>Respostas com identificação de participantes:</b> " . mysql_num_rows($consulta) . "</li>";
		
		$consulta = $opiniao->find_all_avaliadores_by_evento($evento->get_codigo_evento());
		echo "<li><b>Respostas com identificação de avaliadores:</b> " . mysql_num_rows($consulta) . "</li>";
		
		$consulta = $opiniao->media_quesito(1, $evento->get_codigo_evento() );
		$row = mysql_fetch_row($consulta);
		$n_notas = mysql_num_rows( $opiniao->find_comentarios_notas_by_quesito(1, $evento->get_codigo_evento() ) );
		echo "<li><b>Média Palestras:</b> " . $row[0] . " - sobre " . $n_notas . " opinioes</li>";
		
		$consulta = $opiniao->media_minicursos($evento->get_codigo_evento() );
		$row = mysql_fetch_row($consulta);
		echo "<li><b>Média Minicursos:</b> " . $row[0] . "</li>";
		
		$consulta = $opiniao->media_quesito(2, $evento->get_codigo_evento() );
		$row = mysql_fetch_row($consulta);
		$n_notas = mysql_num_rows( $opiniao->find_comentarios_notas_by_quesito(2, $evento->get_codigo_evento() ) );
		echo "<li><b>Média Workshop:</b> " . $row[0] . " - sobre " . $n_notas . " opinioes</li>";
		
		$consulta = $opiniao->media_quesito(3, $evento->get_codigo_evento() );
		$row = mysql_fetch_row($consulta);
		$n_notas = mysql_num_rows( $opiniao->find_comentarios_notas_by_quesito(3, $evento->get_codigo_evento() ) );
		echo "<li><b>Média Site:</b> " . $row[0] . " - sobre " . $n_notas . " opinioes</li>";
		
		$consulta = $opiniao->media_quesito(4, $evento->get_codigo_evento() );
		$n_notas = mysql_num_rows( $opiniao->find_comentarios_notas_by_quesito(4, $evento->get_codigo_evento() ) );
		$row = mysql_fetch_row($consulta);
		echo "<li><b>Média Kits:</b> " . $row[0] . " - sobre " . $n_notas . " opinioes</li>";
		
		$consulta = $opiniao->media_quesito(5, $evento->get_codigo_evento() );
		$row = mysql_fetch_row($consulta);
		$n_notas = mysql_num_rows( $opiniao->find_comentarios_notas_by_quesito(5, $evento->get_codigo_evento() ) );
		echo "<li><b>Média Espaço/Localização:</b> " . $row[0] . " - sobre " . $n_notas . " opinioes</li>";
		
		$consulta = $opiniao->media_quesito(6, $evento->get_codigo_evento() );
		$row = mysql_fetch_row($consulta);
		$n_notas = mysql_num_rows( $opiniao->find_comentarios_notas_by_quesito(6, $evento->get_codigo_evento() ) );
		echo "<li><b>Média Empresas:</b> " . $row[0] . " - sobre " . $n_notas . " opinioes</li>";
		
		?>
		</ul>
	
	</div>
