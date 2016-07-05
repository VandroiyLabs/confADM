	<div id="vendakits">
	
		<ul>
		<?php
			
		$kits = new Kits();
		$evento = new Evento();
		$evento->find_evento_aberto();

		
		$consulta = $kits->find_by_evento( $evento->get_codigo_evento() );
		echo "<li><b>Número de Kits pedidos até o momento:</b> " . mysql_num_rows($consulta) . "</li>";

		$consulta = $kits->find_by_nome_nosubscription('', $evento->get_codigo_evento());
		echo "<li><b>Pedidos de Kit sem conta no sistema:</b> " . mysql_num_rows($consulta) . "</li>";
		
		$consulta = $kits->find_by_nome_wsubscription('', $evento->get_codigo_evento());
		echo "<li><b>Pedidos de Kit com conta no sistema:</b> " . mysql_num_rows($consulta) . "</li>";



		echo "<table width='50%'>";
		echo "<tr><td width><b>Tamanho</b> </td><td><b> cinza</b></td><td><b>azul</b> </td></tr>";
		$consulta_cinza = $kits->find_by_camiseta_e_tipo('BLPP','cinza', $evento->get_codigo_evento());
		$consulta_azul = $kits->find_by_camiseta_e_tipo('BLPP','azul', $evento->get_codigo_evento());
		echo "<tr><td><b>Camisetas BLPP:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td><td>" . mysql_num_rows($consulta_azul). "</td></tr>";

	$consulta_cinza = $kits->find_by_camiseta_e_tipo('BLP','cinza', $evento->get_codigo_evento());
		$consulta_azul = $kits->find_by_camiseta_e_tipo('BLP','azul', $evento->get_codigo_evento());
		echo "<tr><td><b>Camisetas BLP:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td><td>" . mysql_num_rows($consulta_azul). "</td></tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('BLM','cinza', $evento->get_codigo_evento());
		$consulta_azul = $kits->find_by_camiseta_e_tipo('BLM','azul', $evento->get_codigo_evento());
		echo "<tr><td><b>Camisetas BLM:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td><td>" . mysql_num_rows($consulta_azul). "</td></tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('BLG','cinza', $evento->get_codigo_evento());
		$consulta_azul = $kits->find_by_camiseta_e_tipo('BLG','azul', $evento->get_codigo_evento());
		echo "<tr><td><b>Camisetas BLG:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td><td>" . mysql_num_rows($consulta_azul). "</td></tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('BLGG','cinza', $evento->get_codigo_evento());
		$consulta_azul = $kits->find_by_camiseta_e_tipo('BLGG','azul', $evento->get_codigo_evento());
		echo "<tr><td><b>Camisetas BLGG:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td><td>" . mysql_num_rows($consulta_azul). "</td></tr>";

	$consulta_cinza = $kits->find_by_camiseta_e_tipo('PP','cinza', $evento->get_codigo_evento());
		$consulta_azul = $kits->find_by_camiseta_e_tipo('PP','azul', $evento->get_codigo_evento());
		echo "<tr><td><b>Camisetas PP:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td><td>" . mysql_num_rows($consulta_azul). "</td></tr>";


		$consulta_cinza = $kits->find_by_camiseta_e_tipo('P','cinza', $evento->get_codigo_evento());
		$consulta_azul = $kits->find_by_camiseta_e_tipo('P','azul', $evento->get_codigo_evento());
		echo "<tr><td><b>Camisetas P:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td><td>" . mysql_num_rows($consulta_azul). "</td></tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('M','cinza', $evento->get_codigo_evento());
		$consulta_azul = $kits->find_by_camiseta_e_tipo('M','azul', $evento->get_codigo_evento());
		echo "<tr><td><b>Camisetas M:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td><td>" . mysql_num_rows($consulta_azul). "</td></tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('G','cinza', $evento->get_codigo_evento());
		$consulta_azul = $kits->find_by_camiseta_e_tipo('G','azul', $evento->get_codigo_evento());
		echo "<tr><td><b>Camisetas G:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td><td>" . mysql_num_rows($consulta_azul). "</td></tr>";
		
		$consulta_cinza = $kits->find_by_camiseta_e_tipo('GG','cinza', $evento->get_codigo_evento());
		$consulta_azul = $kits->find_by_camiseta_e_tipo('GG','azul', $evento->get_codigo_evento());
		echo "<tr><td><b>Camisetas GG:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td><td>" . mysql_num_rows($consulta_azul). "</td></tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('EG','cinza', $evento->get_codigo_evento());
		$consulta_azul = $kits->find_by_camiseta_e_tipo('EG','azul', $evento->get_codigo_evento());
		echo "<tr><td><b>Camisetas EG:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td><td>" . mysql_num_rows($consulta_azul). "</td></tr>";
		
		echo "</table>";
		
		
		?>
		</ul>
	
	</div>
