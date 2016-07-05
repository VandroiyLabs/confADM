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
	
	function imprimeStatus($codigo_evento,$codigo_pessoa,$codigo_avaliador)
	{
		$nota_resumo = new NotaResumo();

		$status = $nota_resumo->find_status($codigo_evento,$codigo_pessoa,$codigo_avaliador);
	
		if($codigo_avaliador == 0)
		{
			return "Sem avaliador.";
		}
		elseif($status==0)
		{
			return "Resumo não avaliado.";
		}
		else if($status==1)
		{
			return "Nota não submetida.";
		}
		else if($status==2)
		{
			return "Nota submetida.";
		}
	
	} 

	
	function imprimeNivel($nivel)
	{
		
		if($nivel=='Graduacao')
		{
			return "Graduação";
		}
		else 
		{
			return $nivel;
		}
	
	} 
	

	
	/* Garantindo que nenhum lixo fique solto e a edicao de alguem fique em aberto! */
	require_once('./../../user/classes/class.EmEdicao.php');
	$editando = new EmEdicao();	
	if ( $editando->find_by_adm($adm->get_usuario()) )
	{
		$editando->remove();
	}

	if ( isset($_GET["pagina_atual"]) )
	{
		$contador_pagina = $_GET["pagina_atual"];
		$_SESSION["listar_pagina_atual"] = $contador_pagina;
	}
	/*else if ( isset($_SESSION["listar_pagina_atual"]) )
	{
		$contador_pagina = $_SESSION["listar_pagina_atual"];
	}*/
	else
	{
		$contador_pagina = 1;
	}
?>

	<form nome='formulario' method='post' action='home.php?page=atribuicao_resumo'>

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
		include('./atribuicao_resumo/filtro_resumo.php');
	?>
	</form>
<?php
	
	
	$avaliacao = new Avaliacao();
	$nota_resumo = new NotaResumo();

	$consulta = $nota_resumo->find_all_pendentes($evento->get_codigo_evento());
	$total_pendentes = mysql_num_rows($consulta);

	include('./action/filtro_resumo_action.php');

	

	if ( isset( $_POST['numperpage'] ) )
	{
		$limite = $_POST['numperpage']; //echo "poooooo";
	}
	else
	{
		$limite = 15;
	}
	//echo "Filtro ".$limite.".nome:".$_GET["pagina_atual"];
	
	$avalia_resumo = new AvaliaResumo();

	$consulta = $avalia_resumo->find_all($evento->get_codigo_evento(),$_POST["nome"],$filtro ); 
	$intervalo = $avalia_resumo->find_limmited_all($evento->get_codigo_evento(), $_GET["pagina_atual"],$limite,$_POST["nome"],$filtro);
			
	$registro_inicial = (($contador_pagina - 1) * $limite);

	$total = mysql_num_rows($consulta);
	$total_pagina =( (int)($total/$limite) ); 

	if($total%$limite != 0)
	$total_pagina++;	
	
	echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
	<tr> 
		<td height='12' colspan='3'> <p>Número de registros retornados: ".$total.".</p></td> 
	</tr> 
	<tr> 
		<td height='12' colspan='3'> <p><b>Avaliações pendentes:</b> ".$total_pendentes.".</p></td> 
	</tr> 
	<tr>";
	$local="sup";
	include("./atribuicao_resumo/indice_resumo.php");
	
	echo "</tr>

	<tr> 
		<td height='12'></td> 
	</tr> "	;
	
	if(mysql_num_rows($intervalo) > 0)
	{
		while ( $row = mysql_fetch_object($intervalo) )
		{
			$status1 = $nota_resumo->find_status($row->codigo_evento,$row->codigo_pessoa,$row->codigo_avaliador1);
			$status2 = $nota_resumo->find_status($row->codigo_evento,$row->codigo_pessoa,$row->codigo_avaliador2);
			if($status1 == 2 or $status1==1) $select1="disabled = 'disabled'"; else $select1="";
			if($status2 == 2 or $status2==1) $select2="disabled = 'disabled'"; else $select2="";	
		

			echo " <tr><td bgcolor='#c4c4c4' colspan='3'><form method='post' action= './action/avalia_resumo_atribuicao_action.php'>
				<table border='0' cellspacing='3' cellpadding='10' width='100%'>
			  	<tr><td colspan='2'><b>Nome:</b> $row->nome</td></tr>
				<tr><td colspan='2'><b>Grupo:</b> $row->grupo - <b>Especialidade:</b> ".$row->subarea."</td></tr>
				<tr><td colspan='2'><b>Nível/Curso:</b> ".imprimeNivel($row->nivel)." / $row->curso</td></tr>
				<tr><td colspan='2'><b>Resumo:</b> $row->titulo</td></tr>
				<tr><td><b>Avaliador1:</b><br />
					<select name='avaliador1'".$select1.">
					<option value='0'> Sem avaliador </option>";
					$consulta = $avaliacao->find_all_secao($evento->get_codigo_evento(),0);
					while($row2 = mysql_fetch_object($consulta) )
					{
						$avaliacoes = $nota_resumo->find_avaliacoes_by_avaliador($evento->get_codigo_evento(),$row2->codigo_avaliador);
						if($row2->codigo_avaliador == $row->codigo_avaliador1)
						$checked = "selected";
						else
						$checked ="";	
						echo "<option value='$row2->codigo_avaliador' ".$checked.">".$row2->nome." - ".$avaliacoes." avaliações - Área1: ".$row2->area1." - Esp: ".$row2->subarea." - Área2: ".$row2->area2." - Grupo: ".$row2->grupo.".</option>";
					}
					echo "</select> -> <b>Status: </b>".imprimeStatus($row->codigo_evento,$row->codigo_pessoa,$row->codigo_avaliador1)." 
				</td> <td rowspan='2'><input type='submit' value='Salvar' class='button'>			
				</td><tr>
				<tr><td ><b>Avaliador2:</b><br />
					<select name='avaliador2' ".$select2.">
					<option value='0'> Sem avaliador</option>";
					$consulta = $avaliacao->find_all_secao($evento->get_codigo_evento(),0);
					while($row2 = mysql_fetch_object($consulta) )
					{
						$avaliacoes = $nota_resumo->find_avaliacoes_by_avaliador($evento->get_codigo_evento(),$row2->codigo_avaliador);
						if($row2->codigo_avaliador == $row->codigo_avaliador2)
						$checked = "selected";
						else
						$checked ="";	
						echo "<option value='$row2->codigo_avaliador' ".$checked.">".$row2->nome." - ".$avaliacoes." avaliações - Área1: ".$row2->area1." - Área2: ".$row2->area2."- Grupo: ".$row2->grupo.".</option>";
					}
					
					echo "</select> -> <b>Status: </b>".imprimeStatus($row->codigo_evento,$row->codigo_pessoa,$row->codigo_avaliador2)." </td><tr>
				</table>
				<input type='hidden' name='cp' value='$row->codigo_pessoa' />
				<input type='hidden' name='ce' value='$row->codigo_evento' />
				<input type='hidden' name='ca1' value='$row->codigo_avaliador1' />
				<input type='hidden' name='ca2' value='$row->codigo_avaliador2' />
				</form>
			</td>	
			</tr>
			<tr> 
				<td height='19'></td> 
			</tr> 	";
		}
	}
	else
	{
		echo "<tr> 
				<td height='19' colspan='3' align='center'> <p>Nenhum registro encontrado.</p></td> 
			</tr>";
	}

	echo "<tr>";
	$local="inf";
	include("./atribuicao_resumo/indice_resumo.php");
	echo "</tr></table>";
	
?>
