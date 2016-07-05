<?php

	$limite = 10;

	if (!isset($_GET["pagina_atual"])) $contador_pagina = 1; 
	else	$contador_pagina = $_GET["pagina_atual"];
	
	$consulta = $pessoa->find_all();
	$intervalo = $pessoa->find_all_limmited($_GET["pagina_atual"],$limite);
	
	$registro_inicial = (($contador_pagina - 1) * $limite);
	
	$total = mysql_num_rows($consulta);
	$total_pagina =( (int)($total/$limite) ) + 1;


	 echo "<tr>";
			include("listar/indice.php");
	 echo "</tr>
			<tr> 
				<td height='12'></td> 
			</tr> "
			;
	
	while ($row = mysql_fetch_object($intervalo)){

		echo"
		<tr>
			<td valign='top' colspan='3'>
				<table border='0' cellspacing='0' cellpadding='5' width='100%'  id='block'>
					<tr>
						<td height='30' bgcolor='#c4c4c4' colspan='2'>
							<table>
								<tr>
								<td width='10'></td>
								
								<td width='530' height='20' ><b>$row->nome</b></td>
								
								<td width='10'></td>
								
								<td align='right' width='10%'>
									<form method='get' action='home.php'>
										<input type='submit' value='  Detalhes  ' class='button'>
									<input type='hidden' name='codigo_pessoa' value='$row->codigo_pessoa'/>
									<input type='hidden' name='p1' value='detalhes'/>
									<input type='hidden' name='p2' value='eventos'/>
									</form>
								</td>
								
								<td width='5'></td>
								
								<td align='right' bgcolor='#c4c4c4' width='10%'>
									<form method='get' action='home.php'>
										<input type='submit' value='  Excluir  ' class='button_excluir'>
									<input type='hidden' name='codigo_pessoa' value='$row->codigo_pessoa'/>
									<input type='hidden' name='codigo_evento' value='$row->codigo_evento'/>
									<input type='hidden' name='p1' value='excluir_participante'/>
									</form>
								</td>
								<td width='5'></td>
								
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height='10' colspan='2'></td>							
					</tr>
					<tr>
						<td width='5'></td>
						<td height='30'>
							<table cellspacing='0'>
								<tr>
									<td height='20' colspan='2'><b>Instituição: </b>$row->instituicao</td>
								</tr>
								<tr>
									<td height='20' colspan='2'><b>E-mail: </b><a href='home.php?p1=correio&email=$row->email'>$row->email</a></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height='10' colspan='2'></td>							
					</tr>		
				</table>
			<table>
			<tr> 
				<td height='12'></td> 
			</tr> 
			</table>
		</td>
	</tr>
	";

	}	
	
