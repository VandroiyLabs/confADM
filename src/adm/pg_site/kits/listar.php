	<div id="vendakits">
	
		<ul>
		<?php
			
			$kits = new Kits();
			$evento = new Evento();
			$evento->find_evento_aberto();
			$consulta = $kits->find_by_evento( $evento->get_codigo_evento() );

			include('kits/printlistakits.php');
			
		?>
		</ul>
	
	</div>
