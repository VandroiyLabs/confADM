<?php
	unset($_SESSION["pessoa"]);
	$inscricao = new Inscricao();
	$evento = new Evento();
	if(isset($_SESSION["evento"])){$evento = $_SESSION["evento"];}else{ $evento->find_evento_aberto(); $_SESSION["evento"]=$evento;}

		if (!isset($_GET["pagina_atual"])) {$contador_pagina = 1; }
			else	{$contador_pagina = $_GET["pagina_atual"]; }

	if ( isset($_GET['nome']) and !isset($_POST['nome']) )
	{
		$_POST['nome'] = $_GET['nome'];
	}
?>
<div id="content">

<div class="post">
	<div class="content">
	<h2>Pesquiar por Participante (em construção!)</h2>
	<table>
		<tr> 
			<td height="12" colspan="2"></td> 
		</tr> 
	</table>

	
	<form nome='formulario' method='post' action='home.php?p1=pesquisar'>

	<table cellspacing="0" cellpadding="0" border="0" width="100%"  id="block_new"> 
		<tr>
			<td bgcolor="#c4c4c4" height="20" valign="center" align="center" colspan="3"><b>Pesquisar por nome:</b></td>
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

	<?php include('listar/filtro.php');?>
	
	</form>
	
	<table>
		<tr> 
			<td height="12" colspan="2"></td> 
		</tr> 
	</table>
			
	<table width="100%" border="0" cellspacing="0" cellpadding="10">
	
	
	<?php

		if( isset($_POST["nome"]) )
		{
			include('listar/filtro_action.php');
			
			$limite = 8;			
			
			$consulta = $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),$_POST["nome"], $filtro);

			
			$intervalo = $inscricao->find_by_nome_inscricao_limmited($evento->get_codigo_evento(),$_POST["nome"], $filtro,$_GET["pagina_atual"],$limite);
		
			$registro_inicial = (($contador_pagina - 1) * $limite);

			$total = mysql_num_rows($consulta);
			$total_pagina =( (int)($total/$limite) ); 

			if($total%$limite != 0)
			$total_pagina++;
			include("listar/indice_pesquisar.php");

			
			if($intervalo){
				$total = mysql_num_rows($intervalo);
			
				while ($row = mysql_fetch_object($intervalo)){

				echo"
				<tr>
					<td valign='top' colspan='3'>
				<table border='0' cellspacing='0' cellpadding='10' width='100%'  id='block'>
					<tr>
						<td height='30' bgcolor='#c4c4c4' colspan='2'>
							<table width='100%'>
								<tr>
								<td width='50%' height='20' ><b>$row->nome</b></td>
								 
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
					
					<tr>
						<td height='10' colspan='2'></td>							
					</tr>		
				</table>
				<table>
				<tr> 
					<td height='9'></td> 
				</tr> 
				</table>
				</td>
			</tr>
			";
			}
		}
	include("listar/indice_pesquisar.php");
	}

	echo"</table>";

	
	?>
	
	</div>
</div>
</div>
