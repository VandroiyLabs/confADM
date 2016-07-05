<?php
		 $anterior = $contador_pagina - 1;
		 $proximo = $contador_pagina + 1;

		 $codigo_evento = $_GET["codigo_evento"];

		 
		 if ($contador_pagina > 1)		{ $lk_anterior="?p1=listar&pagina_atual=".$anterior; }
		 else							{ $lk_anterior="#"; };
		 
		 if ($contador_pagina < $total_pagina)		{ $lk_proximo="?p1=listar&pagina_atual=".$proximo; }
		 else										{ $lk_proximo="#"; };
			  
		 echo "<td align=\"left\" height=\"20\"><a href='$lk_anterior'><b><< anterior</b></a></td>";

		 // Listando páginas
		 echo "<td  align=\"center\" height=\"20\"> ";
		 
		 $cota_paginacao=10;
		 
		 for($lk_total=1; $lk_total<=$total_pagina; $lk_total++){


			if($contador_pagina == $lk_total){
			  echo "<a href=\"?p1=listar&pagina_atual=$lk_total\"><font color='red'><b>$lk_total</b></font></a>&nbsp&nbsp";
			}
			else{
			  echo "<a href=\"?p1=listar&pagina_atual=$lk_total\"><b>$lk_total</b></a>&nbsp&nbsp";
			}
			
			  if ($lk_total >= $cota_paginacao) { echo "<br>"; $cota_paginacao = $cota_paginacao + 10; };																	
		 };
		 
		 echo "</td><td  align=\"right\" height=\"20\" class=\"font10\"><a href='$lk_proximo'><b>próxima >></b></a></td>";
		 
?>
