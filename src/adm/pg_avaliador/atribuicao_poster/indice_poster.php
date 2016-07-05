<?php
		$anterior = $contador_pagina - 1;
		$proximo = $contador_pagina + 1;
		
		$codigo_evento = $_GET["codigo_evento"];
		
		
		if ($contador_pagina > 1)		{ $lk_anterior="?page=atribuicao_poster&pagina_atual=".$anterior; }
		else							{ $lk_anterior="#"; };
		
		if ($contador_pagina < $total_pagina)		{ $lk_proximo="?page=atribuicao_poster&pagina_atual=".$proximo; }
		else										{ $lk_proximo="#"; };
		echo "<form name='indice_$local' method='post' >";

		echo "<input type='hidden' name='nome' value='".$_POST["nome"]."' />
			<input type='hidden' name='indexacaosifsc' value='".$_POST["indexacaosifsc"]."' />
			<input type='hidden' name='numperpage' value='".$limite."' />
			<input type='hidden' name='instituicao' value='".$_POST['instituicao']."'/>
			<input type='hidden' name='nivel' value='".$_POST['nivel']."'/>
			<input type='hidden' name='nivel_check_grad' value='".$_POST['nivel_check_grad']."'/>
			<input type='hidden' name='nivel_check_mest' value='".$_POST['nivel_check_mest']."'/>
			<input type='hidden' name='nivel_check_doc' value='".$_POST['nivel_check_doc']."'/>

			<input type='hidden' name='avaliador' value='".$_POST['avaliador']."' />
			<input type='hidden' name='avaliador_check_0' value='".$_POST['avaliador_check_0']."' />
			<input type='hidden' name='avaliador_check_1' value='".$_POST['avaliador_check_1']."' />
			<input type='hidden' name='avaliador_check_2' value='".$_POST['avaliador_check_2']."' />
			<input type='hidden' name='secao' value='".$_POST['secao']."' />
			<input type='hidden' name='secao_check_0' value='".$_POST['secao_check_0']."' />
			<input type='hidden' name='secao_check_1' value='".$_POST['secao_check_1']."' />
			<input type='hidden' name='secao_check_2' value='".$_POST['secao_check_2']."' />
			<input type='hidden' name='secao_check_3' value='".$_POST['secao_check_3']."' />
			<input type='hidden' name='secao_check_4' value='".$_POST['secao_check_4']."' />
			<input type='hidden' name='secao_check_5' value='".$_POST['secao_check_5']."' />

			";
		
		echo "<td align=\"left\" height=\"20\"><a href=\"javascript:void(0)\" onclick=\"submite_$local('$lk_anterior');\"><b><< anterior</b></a></td>";
		
		// Listando páginas
		echo "<td  align=\"center\" height=\"20\"> ";
		 
		$cota_paginacao = 10;
		 
		for ( $lk_total = 1; $lk_total<=$total_pagina; $lk_total++ )
		{
			$link = "?page=atribuicao_poster&pagina_atual=$lk_total";
			if ( $contador_pagina == $lk_total )
			{
			  echo "<a href=\"javascript:void(0)\" onclick=\"submite_$local('$link'); \"><font color='red'><b>$lk_total</b></font></a>&nbsp&nbsp";
			}
			else
			{
			  echo "<a href=\"javascript:void(0)\" onclick=\"submite_$local('$link'); \"><b>$lk_total</b></a>&nbsp&nbsp";
			}
			
			if ( $lk_total >= $cota_paginacao )
			{
				echo "<br>"; $cota_paginacao = $cota_paginacao + 10; 
			}
		 }
		 
		 echo "</td><td  align=\"right\" height=\"20\" class=\"font10\">
		<a href=\"javascript:void(0)\" onclick=\"submite_$local('$lk_proximo');\"><b>próxima >></b></a></td>";
		echo "</form>";
		 
?>
