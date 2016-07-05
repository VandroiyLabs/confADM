<?php
			// Serve pra determinar o nome dos formularios pra atualizar
			// o tamanho de camisetas
			$contador = 0;
			
			while ( $row = mysql_fetch_object($consulta) )
			{
				
				$toprint = "";
								
				$toprint .=" " . $row->nome .  " -- Camiseta: ";
								
				$toprint .= $row->camiseta . " - ";

				$toprint .= $row->tipo_camiseta . "<br />";
							
				echo $toprint;
				
			}
?>
