<div id="filtros_busca" style="display:none;">
<table width="100%" border="0">
	<tr class="trodd">
		<td width="15%">Número / página</td>
		<td width="60%">
			<select name="numperpage">
				<option value='15' <?php if ( $_POST['numperpage'] == 15 ) { echo 'selected'; } ?>>15 (default)</option>
				<option value='5' <?php if ( $_POST['numperpage'] == 5 ) { echo 'selected'; } ?>>5</option>
				<option value='10' <?php if ( $_POST['numperpage'] == 10 ) { echo 'selected'; } ?>>10</option>
				<option value='30' <?php if ( $_POST['numperpage'] == 30 ) { echo 'selected'; } ?>>30</option>
				<option value='50' <?php if ( $_POST['numperpage'] == 50 ) { echo 'selected'; } ?>>50</option>
				<option value='100' <?php if ( $_POST['numperpage'] == 100 ) { echo 'selected'; } ?>>100</option>
				<option value='150' <?php if ( $_POST['numperpage'] == 150 ) { echo 'selected'; } ?>>150</option>
			</select>
		</td>
	</tr>
	<tr class="treven">
		<td width="10%">Nível</td>
		<td width="85%">
			<input type="radio" name="nivel" value="0"  <?php if(!isset($_POST['nivel']) || $_POST['nivel']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="nivel" value="1" <?php if($_POST['nivel']== '1') echo 'checked';?> />Filtrar: &nbsp;<br />
			<input type="checkbox" name="nivel_check_pos" value="1" <?php if($_POST['nivel_check_pos']== '1') echo 'checked';?> />Pós-doc &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="nivel_check_pesq" value="1" <?php if($_POST['nivel_check_pesq']== '1') echo 'checked';?> />Pesquisador &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="nivel_check_prof" value="1" <?php if($_POST['nivel_check_prof']== '1') echo 'checked';?> />Professor &nbsp;&nbsp;&nbsp;
			
		</td>
	</tr>
	<tr class="trodd">
		<td width="10%">Área</td>
		<td width="85%">
			<input type="radio" name="area" value="0" <?php if(!isset($_POST['area']) || $_POST['area']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="area" value="1" <?php if($_POST['area']== '1') echo 'checked';?> />Filtrar: &nbsp;<br />
			<input type="checkbox" name="area_check_fb" value="Física Básica" <?php if($_POST['area_check_fb']== 'Física Básica') echo 'checked';?>/>Física Básica &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="area_check_fa" value="Física Aplicada" <?php if($_POST['area_check_fa']== 'Física Aplicada') echo 'checked';?>/>Física Aplicada &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="area_check_bi" value="Biomolecular" <?php if($_POST['area_check_bi']== 'Biomolecular') echo 'checked';?>/>Biomolecular &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="area_check_fc" value="Física Computacional" <?php if($_POST['area_check_fc']== 'Física Computacional') echo 'checked';?>/>Física Computacional	
			
		</td>
	</tr>
	<tr class="treven">
		<td width="10%">Seção</td>
		<td width="85%">
			<input type="radio" name="secao" value="0" <?php if(!isset($_POST['secao']) || $_POST['secao']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="secao" value="1" <?php if($_POST['secao']== '1') echo 'checked';?> />Filtrar: &nbsp;<br />
			<input type="checkbox" name="secao_check_0" value="0" <?php if($_POST['secao_check_0']== '0') echo 'checked';?> />Resumo &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="secao_check_1" value="1" <?php if($_POST['secao_check_1']== '1') echo 'checked';?>/>Seção 1 &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="secao_check_2" value="2" <?php if($_POST['secao_check_2']== '2') echo 'checked';?>/>Seção 2 &nbsp;&nbsp;&nbsp;	
			<input type="checkbox" name="secao_check_3" value="3" <?php if($_POST['secao_check_3']== '3') echo 'checked';?>/>Seção 3 &nbsp;&nbsp;&nbsp;	
			<input type="checkbox" name="secao_check_4" value="4" <?php if($_POST['secao_check_4']== '4') echo 'checked';?>/>Seção 4 &nbsp;&nbsp;&nbsp;	
					
		</td>
	</tr>
	
	
</table>
</div>
