<?php

	$limite = 100;

	$PartMinic = new ParticipaMinicurso();
	$pessoa = new Pessoa();
	$inscricao = new Inscricao();
	
	if (!isset($_GET["pagina_atual"])) 
	{
		$contador_pagina = 1; 
	}
	else
	{
		$contador_pagina = $_GET["pagina_atual"]; 
	}
	
	if($adm->get_tipo()=='2')
	{
	}
	else
	{
		//$consulta = $pessoa->find_by_evento($_REQUEST["codigo_evento"]); 
		$consulta = $PartMinic->find_by_minicurso_evento($_GET["codigo"], $_REQUEST["codigo_evento"]);
		$intervalo = $PartMinic->find_by_minicurso_evento_limited($_REQUEST["codigo"], $_REQUEST["codigo_evento"], $_GET["pagina_atual"], $limite);
	}
	
	$registro_inicial = (($contador_pagina - 1) * $limite);

	$total = mysql_num_rows($consulta);
	$total_pagina =( (int)($total/$limite) ); 

	if($total%$limite != 0)
	$total_pagina++;

	
	echo "<tr>";

	include("listar/indice.php");
	
	echo "</tr>
	<tr> 
		<td height='12'></td> 
	</tr> "	;
	
		
	while ($row = mysql_fetch_object($intervalo))
	{
		$pessoa->find_by_codigo($row->codigo);
		$inscricao->find_by_pessoa_evento($row->codigo, $_REQUEST["codigo_evento"]);
		
		echo"

		<tr>
			<td valign='top' colspan='3'>
				<table border='0' cellspacing='0' cellpadding='10' width='100%'  id='block'>
					<tr>
						<td height='30' bgcolor='#c4c4c4' colspan='2'>
							<table width='100%'>
								<tr>
								<td width='50%' height='20' ><b>" . $pessoa->get_nome() . "</b></td>
								 
								";


									echo "<td width='15%'></td><td width='15%'></td>";

									echo "<td align='center' width='10%'>
									<form method='get' action='../pg_participante/home.php?'>
										<input type='submit' value='  Detalhes  ' class='button_amarelo'>
										<input type='hidden' name='p1' value='showpessoa'/>
										<input type='hidden' name='cp' value='" . $pessoa->get_codigo_pessoa() . "'/>						
									</form>
								</td>";
						
								if($adm->get_tipo() != '2')
								{
									echo "						
									<td align='center' bgcolor='#c4c4c4' width='10%'>
										<form method='get' action='home.php'>
											<input type='submit' value=' Desmatricular ' class='button_vermelho'>
											<input type='hidden' name='codigo_pessoa' value='" . $pessoa->get_codigo_pessoa() . "'/>
											<input type='hidden' name='codigo_minicurso' value='" . $_GET["codigo"] . "'/>
											<input type='hidden' name='page' value='excluir_inscricao'/>
										</form>
									</td>
									</tr>";
								}
								else
								{
									echo "<td width='10%'></td></tr>";
								}
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
									<td height='20' width='50%'>
										<b>Instituição: </b>" . $inscricao->get_instituicao() . "<br />
										<b>Grupo: </b>" . $inscricao->get_grupo() . "<br />
										<b>Nivel: </b>" . $inscricao->get_nivel() . "
									</td><td width='50%' >";

								   if($inscricao->get_situacao_resumo == '1')
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Não submeteu para avaliação.</td></tr></table>";
									}
									elseif($inscricao->get_situacao_resumo() == '2' && $inscricao->get_situacao_deferimento() == '0')
								 	{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Aguardando deferimento da biblioteca.</td></tr></table>";

									}elseif($inscricao->get_situacao_resumo() == '2' && $inscricao->get_situacao_deferimento() == '1')
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Aguardando deferimento da comissão.</td></tr></table>";
								 	}
									elseif($inscricao->get_situacao_resumo() == '2' && $inscricao->get_situacao_deferimento() == '2')
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Deferido.</td></tr></table>";
									}
									
									
									
								echo "</td>
								</tr>
								<tr>
									<td height='20' width='50%'><b>E-mail: </b><a href='home.php?p1=correio&email=" . $pessoa->get_email() . "'>" . $pessoa->get_email() . "</a></td><td  width='50%' >";
								
								if ( $inscricao->get_situacao_arte() == '3' && $adm->get_tipo() != '2' )
								{
									echo "<table width='100%'><tr><td ><b>Arte:</b> Deferido.</td></tr></table>";
								}
								elseif ( $inscricao->get_situacao_arte() == '2' && $adm->get_tipo() != '2' )
								{
									echo "<table width='100%'><tr><td ><b>Arte:</b> Aguardando deferimento.</td></tr></table>";
								}
								elseif ( $inscricao->get_situacao_arte() == '1' && $adm->get_tipo() != '2' )
								{
									echo "<table width='100%'><tr><td ><b>Arte:</b> Arte salva, mas não submetida.</td></tr></table>";
								}
								else
								{
									echo "<table width='100%'><tr><td></td></tr></table>";
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
