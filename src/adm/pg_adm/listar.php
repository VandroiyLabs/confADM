<div id="content">

<div class="post">
	<div class="content">
	<div id='menu' >
		<ul><li class='listar'><a href='#' title=''><center>Relatório de Administradores</center></a></li></ul>
	</div>
	<table>
		<tr> 
			<td height="12" colspan="2"></td> 
		</tr> 
	</table>

	<table border="0" cellspacing="0" cellpadding="0" width='100%'>

	<?php
		
		$consulta = $adm->find_all();
		$total = mysql_num_rows($consulta);
			
		while ($row = mysql_fetch_object($consulta)){

			$toprint = "
			<tr>
				<td valign='top'>
				<!-- Topo 1 ---------------------------------->
					<table border='0' cellspacing='0' cellpadding='5' bgcolor='#e9e9e9' width='100%' id='block'>					
						<tr>
							<td height='30' bgcolor='#c4c4c4' colspan='2'>
								<table width='100%'>
									<tr>
									<td width='530'><b>$row->usuario</b></td>";
			if ( $_SESSION['adm']->get_tipo() == -1 )
			{
				$toprint .= "
									<td align='right' bgcolor='#c4c4c4' width='10%'>
										<form method='get' action='home.php'>
											<input type='submit' value='  Super adm  ' class='button_azul'>
										<input type='hidden' name='usuario' value='$row->usuario'/>
										<input type='hidden' name='p1' value='setasuperadm'/>
										</form>
									</td>";
			}
									
			$toprint .="
									<td align='right' bgcolor='#c4c4c4' width='10%'>
										<form method='get' action='home.php'>
											<input type='submit' value='  Alterar  ' class='button_azul'>
										<input type='hidden' name='usuario' value='$row->usuario'/>
										<input type='hidden' name='p1' value='alterar'/>
										</form>
									</td>
									
									<td align='right' bgcolor='#c4c4c4'></td>
									
									<td align='right' bgcolor='#c4c4c4' width='10%'>
										<form method='get' action='home.php'>
											<input type='submit' value='  Excluir  ' class='button_vermelho'>
										<input type='hidden' name='usuario' value='$row->usuario'/>
										<input type='hidden' name='p1' value='excluir'/>
										</form>
									</td>
									
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
										<td width='30%'><b>Nome: </b></td>
										<td align=left >$row->nome</td>
									</tr>
									<tr>
										<td><b>Email:</b></td>
										<td align=left >$row->email</td>
									</tr>
									<tr>
										<td><b>Tipo:</b></td>
										<td align=left >";
			if ( $row->tipo == 0 )
			{
				$toprint .= "Completo";
			}
			if ( $row->tipo == 1 )
			{
				$toprint .= "Sem avaliação";
			}
			if ( $row->tipo == 2 )
			{
				$toprint .= "Biblioteca";
			}
											
	$toprint .=	"							</td>
									</tr>

									<tr>
										<td height='10' colspan='2'></td>							
									</tr>

								</table>
							</td>
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
			
			echo $toprint;
		}	
	?>
	</table>
	
	</div>
</div>

</div>
