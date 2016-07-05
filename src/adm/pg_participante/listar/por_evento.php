<?php

	$limite = 15;

	if ( isset($_GET["pagina_atual"]) )
	{
		$contador_pagina = $_GET["pagina_atual"];
		$_SESSION["listar_pagina_atual"] = $contador_pagina;
	}
	else if ( isset($_SESSION["listar_pagina_atual"]) )
	{
		$contador_pagina = $_SESSION["listar_pagina_atual"];
	}
	else
	{
		$contador_pagina = 1;
	}
	
	if($adm->get_tipo()=='2')  // Mostrar os que estao esperando autorizacao da biblitoeca
	{
		$consulta = $pessoa->find_by_evento_situacao_deferimento($_REQUEST["codigo_evento"],0); 
		$intervalo = $pessoa->find_by_evento_limmited_situacao_deferimento($_REQUEST["codigo_evento"], $_GET["pagina_atual"],$limite,0);
	}
	else                      // Mostrar os que estao esperando autorizacao da comissao
	{
		//$consulta = $pessoa->find_by_evento($_REQUEST["codigo_evento"]); 
		//$intervalo = $pessoa->find_by_evento_limmited($_REQUEST["codigo_evento"], $_GET["pagina_atual"],$limite);
		$consulta = $pessoa->find_by_evento_situacao_deferimento($_REQUEST["codigo_evento"], 1); 
		$intervalo = $pessoa->find_by_evento_limmited_situacao_deferimento($_REQUEST["codigo_evento"], $_GET["pagina_atual"], $limite, 1);
	}		
	$registro_inicial = (($contador_pagina - 1) * $limite);

	$total = mysql_num_rows($consulta);
	$total_pagina =( (int)($total/$limite) ); 

	if($total%$limite != 0)
	$total_pagina++;

	
	/* Garantindo que nenhum lixo fique solto e a edicao de alguem fique em aberto! */
	require_once('./../../user/classes/class.EmEdicao.php');
	$editando = new EmEdicao();	
	if ( $editando->find_by_adm($adm->get_usuario()) )
	{
		$editando->remove();
	}

	
	echo "<tr>";

	include("listar/indice.php");
	
	echo "</tr>
	<tr> 
		<td height='12'></td> 
	</tr> "	;
	
		
	while ( $row = mysql_fetch_object($intervalo) )
	{
	
		
		echo"

		<tr>
			<td valign='top' colspan='3'>
				<table border='0' cellspacing='0' cellpadding='10' width='100%'  id='block'>
					<tr>
						<td height='30' bgcolor='#c4c4c4' colspan='2'>
							<table width='100%'>
								<tr>
								<td width='50%' height='20' ><b>$row->nome_pessoa</b></td>
								 
								";


								
										echo "<td width='15%'></td><td width='15%'></td>";
									


									echo "<td align='center' width='10%'>
									<form method='get' action='home.php'>
										<input type='submit' value='  Detalhes  ' class='button_azul'>
									<input type='hidden' name='p1' value='showpessoa'/>
									<input type='hidden' name='cp' value='$row->codigo_pessoa'/>									
									</form>
								</td>";
						
								
								echo "<td width='10%'></td></tr>";
								
								echo "
								
							</table>
						</td>
					</tr>
					<tr>
						<td height='10' colspan='2'></td>							
					</tr>
					<tr>
						<td width='5'></td>
						<td height='30'>
							<table cellspacing='0' width='100%'>
								<tr>
									<td height='20' width='50%'><b>Instituição: </b>$row->instituicao</td><td width='50%' >";

								   if($row->situacao_resumo == '1')
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Não submeteu para avaliação.</td></tr></table>";
									}
									elseif($row->situacao_resumo == '2' && $row->situacao_deferimento == '0')
								 	{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Aguardando deferimento da biblioteca.</td></tr></table>";

									}elseif($row->situacao_resumo == '2' && $row->situacao_deferimento == '1')
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Aguardando deferimento da comissão.</td></tr></table>";
								 	}
									elseif($row->situacao_resumo == '5' && $row->situacao_deferimento == '2')
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Deferido.</td></tr></table>";
									}
									elseif($row->situacao_resumo == '3' && $row->situacao_deferimento == '0')
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Aguardando nova submissão.</td></tr></table>";
									}
									elseif($row->situacao_resumo == '4')
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Indeferido.</td></tr></table>";
									}
									
									
									
								echo "</td>
								</tr>
								<tr>
									<td height='20' width='50%'><b>E-mail: </b><a href='home.php?p1=correio&email=$row->email'>$row->email</a></td><td  width='50%' >";
								
								if($row->situacao_arte == '4' && $adm->get_tipo() != '2')
								{
									echo "<table width='100%'><tr><td ><b>Arte: </b>Deferido.</td></tr></table>";
								}
								elseif($row->situacao_arte == '3' && $adm->get_tipo() != '2')
								{
									echo "<table width='100%'><tr><td ><b>Arte: </b>Indeferido.</td></tr></table>";
								}
								elseif($row->situacao_arte == '1' && $adm->get_tipo() != '2')
								{
									echo "<table width='100%'><tr><td ><b>Arte: </b>Aguardando submissão.</td></tr></table>";
								}
								elseif($row->situacao_arte == '2' && $adm->get_tipo() != '2')
								{
									echo "<table width='100%'><tr><td ><b>Arte: </b>Submetido.</td></tr></table>";
								}
																
								
							echo "</td>
								</tr>		
								
							</table>
						</td>
					</tr>
					<tr>
						<td height='10' colspan='2'></td>							
					</tr>
					
					<tr>
						<td height='10' colspan='2'></td>							
					</tr>		
				</table>
			<table>
			<tr> 
				<td height='12'></td> 
			</tr> 
			</table> </td></tr>
		";

	}
	
	
?>
