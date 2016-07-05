<script type="text/javascript">
function submite_sup(url)
{
  document.indice_sup.action=url;	
  document.indice_sup.submit();
}
function submite_inf(url)
{
  document.indice_inf.action=url;	
  document.indice_inf.submit();
}
</script>

<?php
	

	$avaliacao = new Avaliacao();	

	if ( isset($_GET["pagina_atual"]) )
	{
		$contador_pagina = $_GET["pagina_atual"];
		$_SESSION["listar_pagina_atual"] = $contador_pagina;
	}
	else
	{
		$contador_pagina = 1;
	}
?>

<form nome='formulario' method='post' action='home.php?page=listar'>

	<table cellspacing="0" cellpadding="0" border="0" width="100%"  id="block_new"> 
		<tr>
			<td bgcolor="#c4c4c4" height="20" valign="center" align="center" colspan="3"><b>Pesquisar por nome/e-mail:</b></td>
		</tr>
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td align="center">
				<input type='text' name='nome' value='<?=$_POST["nome"]?>' size='40'/>
				&nbsp;&nbsp;
				<button  class="ui-button ui-button-text-only ui-state-default ui-corner-all">
					<span class="ui-button-text">Pesquisar</span>
				</button>
				<button type="button" class="ui-button ui-button-text-only ui-state-default ui-corner-all" onClick="document.getElementById('filtros_busca').style.display='inline';">
					<span class="ui-button-text">Mostrar Filtros</span>
				</button>				
				<input type='hidden' name='p1' value='pesquisar'/>
			</td>				
		</tr>
		<tr> 
			<td>
				&nbsp;&nbsp;&nbsp;
			</td>
		</tr> 	
	</table>

	<?php
		include('./listar/filtro_listar.php');

		include('./action/filtro_listar_action.php');
	?>
</form>


<table border="0" cellspacing="0" cellpadding="0" width='100%'>

	<?php
		if ( isset( $_POST['numperpage'] ) )
		{
			$limite = $_POST['numperpage'];
		}
		else
		{
			$limite = 15;
		}

	$consulta = $avaliacao->find_all_filtro($evento->get_codigo_evento(),$_POST["nome"],$filtro ); 
	$intervalo = $avaliacao->find_limmited_filtro($evento->get_codigo_evento(), $_GET["pagina_atual"],$limite,$_POST["nome"],$filtro);
			
	$registro_inicial = (($contador_pagina - 1) * $limite);

	$total = mysql_num_rows($consulta);
	$total_pagina =( (int)($total/$limite) ); 

	if($total%$limite != 0)
	$total_pagina++;
	
	$email="";	$total = mysql_num_rows($consulta);

	while($row = mysql_fetch_object($consulta) )
	{
		$email.= $row->email.",";
	}

	

	echo "<p>Número total de avaliadores cadastrados no momento: " . mysql_num_rows($avaliador->find_all()) . " (<a href='http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listar_nomes'>lista de nomes</a>)</p>";

	

	echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
	<tr> 
		<td height='12' colspan='3'> <p>Número de registros retornados: ".$total.". 				<form method='post' action='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=correio'>
				<input type='submit' value='  Enviar email ' class='button_azul'/>
				<input type='hidden' name='email' value='$email'/>
				<input type='hidden' name='p1' value='correio'/>
                              </form></p></td> 
	</tr> 
	<tr>";
	$local="sup";
	include("./listar/indice_listar.php");
	
	echo "</tr>

	<tr> 
		<td height='12'></td> 
	</tr> "	;

	if($total > 0)
	{
		
		while ($row = mysql_fetch_object($intervalo))
		{		
			echo"
			<tr>
				<td  valign='top' colspan='3'>
				<!-- Topo 1 ---------------------------------->
					<table border='0' cellspacing='0' cellpadding='5' bgcolor='#e9e9e9' width='100%' id='block'>					
						<tr>
							<td height='30' bgcolor='#c4c4c4' colspan='2'>
								<table width='100%'>
									<tr>
									<td><b>$row->codigo_avaliador - $row->nome</b></td>

									<td align='right' bgcolor='#c4c4c4' width='10%'>
										<form method='post' action='home.php'>
											<input type='submit' value='  Alterar  ' class='button_azul'>
										<input type='hidden' name='codigo' value='$row->codigo_avaliador'/>
										<input type='hidden' name='page' value='alterar'/>
										</form>
									</td>
									
									<td align='right' bgcolor='#c4c4c4'></td>
									
									<td align='right' bgcolor='#c4c4c4' width='10%'>
										<form method='post' action='home.php'>
											<input type='submit' value='  Excluir  ' class='button_vermelho'>
										<input type='hidden' name='codigo' value='$row->codigo_avaliador'/>
										<input type='hidden' name='page' value='excluir'/>
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
							<td width='200px'><b>Nome:</b> $row->nome</td>
							<td width='200px'><b>Grande área:</b> $row->area1</td>
						</tr>
						<tr>
							<td><b>Email:</b> $row->email</td>
							<td width='200px'><b>Grande área (2):</b> $row->area2</td>
						</tr>
						<tr>
							<td><b>Especialidade:</b> $row->subarea</td>
							<td width='200px'><b>Avalia resumo?</b> " . $av_resumo . " </td>
						</tr>
						<tr> 
							<td height='12' colspan='2'></td> 
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
	}
	else
	{
		echo "<tr> 
			<td height='19' colspan='3' align='center'> <p>Nenhum avaliador cadastrado.</p></td> </tr>";
	}
	echo "<tr>";
	$local="inf";
	include("./listar/indice_listar.php");	
	echo "</tr>";	
?>
	</table>
	
