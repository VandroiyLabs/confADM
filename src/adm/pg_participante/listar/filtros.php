<form method='get' action='home.php' name='formulario' >
	
<table cellspacing="0" cellpadding="0" border="0" width="100%"  id='block_new'> 
	<tr>
		<td bgcolor="#c4c4c4" height="20" valign="center" align="center" colspan="6"><b>Filtros:</b></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr>
		<td align="center" width='100%'>
			<b>Evento: </b>
			
			<select name="codigo_evento" ONCHANGE="submit();" class='opcoes_filtro'>
			<option value="0">Todos os Eventos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
			<?php
				$evento = new Evento();
				$consulta = $evento->find_all();
				while ($row = mysql_fetch_object($consulta)){
					if($_GET["codigo_evento"] == $row->codigo_evento)
						echo "<option value='$row->codigo_evento' selected='selected'>$row->nome</option>";
					else
						echo "<option value='$row->codigo_evento'>$row->nome</option>";
				}
			?>
			</select>
			&nbsp;&nbsp;&nbsp;			
			<b>Seção: </b>
			<select name="codigo_secao" ONCHANGE="submit();" class='opcoes_filtro'>
			<option value="0">Todos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
			<?php
				$secao = new Secao();
				$consulta = $secao->find_by_evento($_GET["codigo_evento"]);
				while ($row = mysql_fetch_object($consulta)){
					if($_GET["codigo_secao"] == $row->codigo_secao)
						echo "<option value='$row->codigo_secao' selected='selected'>$row->nome</option>";
					else
						echo "<option value='$row->codigo_secao'>$row->nome</option>";
				}
			?>
			</select>
			&nbsp;&nbsp;&nbsp;
			<button  class="ui-button ui-button-text-only ui-state-default ui-corner-all">
				<span class="ui-button-text">OK</span>
			</button>
			<!--<input type="submit" value="  OK  " class="button">-->
			<input type='hidden' name='p1' value='listar'/>
		</td>				
	</tr>
	<tr> 
		<td height="15" colspan="2"></td> 
	</tr> 	
</table>
</form>

<table>
	<tr> 
		<td height="12" colspan="2"></td> 
	</tr> 
</table>
