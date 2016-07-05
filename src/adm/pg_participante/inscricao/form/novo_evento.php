<script type='text/javascript' language='javascript' src='inscricao/form/script.js' ></script>
<form name="formulario" method='get' action='home.php' onsubmit="return valid_form()">
<table cellspacing="0" cellpadding="0" border="0" width="100%" id="block_new"> 
	<tr>
		<td bgcolor="#c4c4c4" height="20" valign="center" align="center" colspan="3"><b>Inscrever em Novo Evento:</b></td>
	</tr>
	<tr>
		<td height="20" colspan="3"></td>
	</tr>
	<tr>
		<td align="center" width='50%'>
			<b>Eventos Abertos:</b>
			&nbsp;
			<select name="codigo_evento" >
			<?php
				$evento = new Evento();
				$consulta = $evento->find_all_aberto_disponivel($pessoa->get_codigo_pessoa());
				while ($row = mysql_fetch_object($consulta)){
					echo "<option value='$row->codigo_evento' selected='selected'>$row->nome</option>";
				}
			?>
			</select>
			&nbsp;&nbsp;&nbsp;
			<button  class="ui-button ui-button-text-only ui-state-default ui-corner-all" >
				<span class="ui-button-text">Adiconar</span>
			</button>
		</td>	
	</tr>
	<tr> 
		<td height="20" colspan="2"></td> 
	</tr> 	
</table>
<input type='hidden' name='p1' value='detalhes'/>
<input type='hidden' name='p2' value='inscricao'/>
<input type='hidden' name='p3' value='insert_inscricao'/>

</form>
