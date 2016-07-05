	<div id="vendakits">
	
		<ul>
		<?php
		
		$evento = new Evento();
		$evento->find_evento_aberto();
		$opiniao = new PesquisaOpiniao();
		$minicurso = new Minicurso();
		
		// Recuperando os minicursos
		$consulta = $minicurso->find_all();
		
		while ( $row = mysql_fetch_array($consulta) )
		{
			$mcons = $opiniao->media_minicurso( $row['codigo_minicurso'], $evento->get_codigo_evento() );
			$nmcons = mysql_num_rows($mcons);
			$mres = mysql_fetch_row($mcons);
			
			$mcomm = $opiniao->comentarios_minicurso( $row['codigo_minicurso'], $evento->get_codigo_evento() );
			$nmcomm = mysql_num_rows($mcomm);
			
			$cons_quant_notas = $opiniao->find_comentarios_e_notas_by_minicurso( $row['codigo_minicurso'], $evento->get_codigo_evento() );
			$quant_notas = mysql_num_rows($cons_quant_notas);
			
			
			echo "<li>" . $row['titulo'] . "<br />
					<b>Média:</b> &nbsp; " . $mres[0] . " - sobre " . $quant_notas . " votos<br />";
			
			if ( $nmcomm > 0 )
			{
				echo "
					<div style=\"cursor: pointer;\" onClick=\"if (document.getElementById('cm" . $row['codigo_minicurso'] . "').style.display == 'none') {  document.getElementById('cm" . $row['codigo_minicurso'] . "').style.display = 'block'; } else {document.getElementById('cm" . $row['codigo_minicurso'] . "').style.display = 'none';} \">Mostrar <b>" . $nmcomm . "</b> comentários</div><br />
					<div id=\"cm" . $row['codigo_minicurso'] . "\" style=\"display:none;\">";
				
				while ( $crow = mysql_fetch_array($mcomm) )
				{
					echo " &nbsp; → &nbsp; " . $crow[0] . "<br />";
				}
			}
			else
			{
				echo "
					<div>Sem comentários!</div><br />
					<div id=\"cm" . $row['codigo_minicurso'] . "\" style=\"display:none;\">";
			}
						
			echo "</div>
						</li><br />";
		}
		
		?>
		</ul>
	
	</div>

