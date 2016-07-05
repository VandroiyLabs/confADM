<h2>Notícias do site</h2>

<?php
	if ( isset($_SESSION['msg']) )
	{
		echo "	<div id=\"msg\">";
		echo "		<p>" . $_SESSION['msg'] . "</p>";
		echo "	</div>";
		unset($_SESSION['msg']);
	}
?>

<form method='get' action='home.php'>
	<button  class="ui-button ui-button-text-only ui-state-default ui-corner-all">
		<span class="ui-button-text">Adicionar notícia</span>
	</button>
	<input type='hidden' name='p1' value='noticias'/>
	<input type='hidden' name='p2' value='incluir'/>
</form>

<table>
	<tr> 
		<td height="12"></td> 
	</tr> 
</table>



<table border="0" cellspacing="0" cellpadding="0" width='100%'>

<?php
	
	$consulta = $noticia->find_by_evento($evento->get_codigo_evento());
	$total = mysql_num_rows($consulta);
	$i = 0;
	while ($row = mysql_fetch_object($consulta)){
		$i++;
		echo"
		<tr>
			<td valign='top'>
			<!-- Topo 1 ---------------------------------->
				<table border='0' cellspacing='0' cellpadding='5' bgcolor='#e9e9e9' width='100%' id='block'>					
					<tr>
						<td height='30' bgcolor='#c4c4c4' colspan='2'>
							<table width='100%'>
								<tr>
								<td><b>Título: $row->titulo</b></td>

								<td align='right' bgcolor='#c4c4c4' width='10%'>
									<form method='get' action='home.php'>
										<input type='submit' value='  Alterar  ' class='button_azul'>
									<input type='hidden' name='p1' value='noticias'/>
									<input type='hidden' name='p2' value='alterar'/>
									<input type='hidden' name='codigo' value='$row->codigo_noticia'/>
									</form>
								</td>
								
								<td align='right' bgcolor='#c4c4c4'></td>
								
								<td align='right' bgcolor='#c4c4c4' width='10%'>
									<form method='get' action='home.php'>
										<input type='submit' value='  Excluir  ' class='button_vermelho'>
									<input type='hidden' name='p1' value='noticias'/>
									<input type='hidden' name='p2' value='excluir'/>
									<input type='hidden' name='codigo' value='$row->codigo_noticia'/>
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
									<td><b>Autor:</b></td>
									<td align=left >$row->autor</td>
								</tr>
								<tr>
									<td width='70' style=\"vertical-align:top;\"><b>Conteúdo:</b></td>
									<td align=left >" . nl2br($row->conteudo) . "</td>
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
	}	
	if($i == 0){
		echo "Nenhuma noticia cadastrada";
	}	
?>
</table>
