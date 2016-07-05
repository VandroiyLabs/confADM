
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
		

	<form nome='formulario' method='post' action='home.php?page=atribuicao_poster'>

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
		include('./atribuicao_poster/filtro_poster.php');

	?>
	</form>
<?php
	
	
	$avaliacao = new Avaliacao();
	$nota_resumo = new NotaResumo();

	include('./action/filtro_poster_action.php');

	//echo "Filtro ".$filtro.".nome:".$_POST["nome"];

	if ( isset( $_POST['numperpage'] ) )
	{
		$limite = $_POST['numperpage']; //echo "LIMITE ".$_POST['numperpage'];
	}
	else
	{
		$limite = 15;
	}


	$avalia_poster = new AvaliaPoster();

	$consulta = $avalia_poster->find_all($evento->get_codigo_evento(),$_POST["nome"],$filtro ); 	
	$intervalo = $avalia_poster->find_limmited_all($evento->get_codigo_evento(), $_GET["pagina_atual"],$limite,$_POST["nome"],$filtro);
			
	$registro_inicial = (($contador_pagina - 1) * $limite);

	$total = mysql_num_rows($consulta);
	$total_pagina =( (int)($total/$limite) ); 

	if($total%$limite != 0)
	$total_pagina++;	
	
	$nsecao1 = mysql_num_rows($avalia_poster->find_all_by_secao($evento->get_codigo_evento(),1));
	$nsecao2 = mysql_num_rows($avalia_poster->find_all_by_secao($evento->get_codigo_evento(),2));
	$nsecao3 = mysql_num_rows($avalia_poster->find_all_by_secao($evento->get_codigo_evento(),3));
	$nsecao4 = mysql_num_rows($avalia_poster->find_all_by_secao($evento->get_codigo_evento(),4));
	//$nsecao5 = mysql_num_rows($avalia_poster->find_all_by_secao($evento->get_codigo_evento(),5));

	echo "<table width='100%' border='0' cellspacing='0' cellpadding='0'>
	<tr> 
		<td height='12' colspan='3'> <p>Sessão1: ".$nsecao1."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sessão2: ".$nsecao2."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sessão3: ".$nsecao3."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sessão4: ".$nsecao4."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p></td> 
	</tr> 
	<tr> 
		<td height='12' colspan='3'> <p>Número de registros retornados: ".$total.".</p></td> 
	</tr> 
	<tr>";
	$local="sup";
	include("./atribuicao_poster/indice_poster.php");
	
	echo "</tr>

	<tr> 
		<td height='12'></td> 
	</tr> "	;
	$count=0;
	if(mysql_num_rows($intervalo) > 0)
	{
		
		while ( $row = mysql_fetch_object($intervalo) )
		{
			$count++;	

			$painel="";
			if($row->nivel == 'Mestrado' or $row->nivel == 'Doutorado')
				$painel="PG";
			elseif($row->nivel == 'Graduacao')
				$painel = "GR";
			else
				$painel = "OT";
			$painel.=$row->codigo_pessoa;

			echo " <tr><td bgcolor='#c4c4c4' colspan='3'><form method='post' name='form_poster".$count."' action= './action/avalia_poster_atribuicao_action.php'>
				<table border='0' cellspacing='3' cellpadding='10' width='100%'>
			  	<tr><td colspan='2'><b>Painel: $painel </b><b> Nome:</b> $row->nome</td></tr>
				<tr><td colspan='2'><b>Grupo:</b> $row->grupo - <b>Especialidade:</b> ".$row->subarea."</td></tr>
				<tr><td colspan='2'><b>Nível/Curso:</b> ".imprimeNivel($row->nivel)." / $row->curso</td></tr>
				<tr><td colspan='2'><b>Resumo:</b> $row->titulo</td></tr>
				<tr><td colspan='2'><b>Sessão</b>";
					
					$secao1 = ""; $secao2 = "";$secao3 = "";$secao4 = "";$secao5 = "";
					if($row->secao == 1)
					$secao1 = "selected";
					elseif($row->secao == 2)
					$secao2 = "selected";
					elseif($row->secao == 3)
					$secao3 = "selected";
					elseif($row->secao == 4)
					$secao4 = "selected";
					elseif($row->secao == 5)
					$secao5 = "selected";
						
					if($row->secao > 0 and $row->secao < 6)
						$secao=	$row->secao;
					else
						$secao= 9;

					echo "<select name='secao' onChange='document.form_poster".$count.".submit()'>
					<option value='0'> Sem sessão </option>
					<option value='1' $secao1> Sessão 1 - 08:00 às 09:45 horas</option>
					<option value='2' $secao2> Sessão 2 - 10:15 às 12:00 horas</option>
					<option value='3' $secao3> Sessão 3 - 14:00 às 15:30 horas</option>
					<option value='4' $secao4> Sessão 4 - 16:00 às 17:30 horas</option>
					
					</select>
					</td></tr>

					<tr><td >
					<b>Avaliador 1:</b>
					<select name='avaliador1' onChange='document.form_poster".$count.".submit()'>
					<option value='0'> Sem avaliador </option>";
					

					$consulta = $avaliacao->find_all_secao($evento->get_codigo_evento(),$secao);
					while($row2 = mysql_fetch_object($consulta) )
					{
						$avaliacoes = $avalia_poster->find_avaliacoes_by_avaliador_secao($evento->get_codigo_evento(),$row2->codigo_avaliador,$row->secao);
						if($row2->codigo_avaliador == $row->codigo_avaliador1)
						$checked = "selected";
						else
						$checked ="";	
						echo "<option value='$row2->codigo_avaliador' ".$checked.">".$row2->nome." - ".$avaliacoes." avaliações - Área1: ".$row2->area1." - Esp: ".$row2->subarea." - Área2: ".$row2->area2."- Grupo: ".$row2->grupo.".</option>";
					}
					echo "</select>
				</td> <td ><b>Avaliador 2:</b>
					<select name='avaliador2' onChange='document.form_poster".$count.".submit()'>
					<option value='0'> Sem avaliador</option>";
					$consulta = $avaliacao->find_all_secao($evento->get_codigo_evento(),$secao);
					while($row2 = mysql_fetch_object($consulta) )
					{
						$avaliacoes = $avalia_poster->find_avaliacoes_by_avaliador_secao($evento->get_codigo_evento(),$row2->codigo_avaliador, $row->secao);
						if($row2->codigo_avaliador == $row->codigo_avaliador2)
						$checked = "selected";
						else
						$checked ="";	
						echo "<option value='$row2->codigo_avaliador' ".$checked.">".$row2->nome." - ".$avaliacoes." avaliações - Área1: ".$row2->area1." - Área2: ".$row2->area2."- Grupo: ".$row2->grupo.".</option>";
					}
					
					echo "</select></td><tr>
				</table>
				<input type='hidden' name='pessoa' value='$row->codigo_pessoa' />
				<input type='hidden' name='evento' value='$row->codigo_evento' />
				<input type='hidden' name='old_secao' value='$row->secao' />
				<input type='hidden' name='old_avaliador1' value='$row->codigo_avaliador1' />
				<input type='hidden' name='old_avaliador2' value='$row->codigo_avaliador2' />
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
	include("./atribuicao_poster/indice_poster.php");
	echo "</tr></table>";
	
?>
