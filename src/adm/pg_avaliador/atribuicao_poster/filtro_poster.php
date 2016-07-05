<div id="filtros_busca" style="display:none;">
<table width="100%" border="0">
	<tr class="trodd">
		<td width="15%">Codigo do resumo</td>
		<td width="60%">
			<input type="text" name="indexacaosifsc" id="indexacaosifsc" value="<?=$_POST['indexacaosifsc'];?>" /> &nbsp;&nbsp;&nbsp; <span style="cursor: pointer;" onClick="document.getElementById('indexacaosifsc').value='';" ><b>Apagar índice</a></span>
		</td>
	</tr>
	<tr class="treven">
		<td width="15%">Número / página</td>
		<td width="60%">
			<select name="numperpage">
				<option value='15' <?php /*if ( $_POST['numperpage'] == 15 )*/ { echo 'selected'; } ?>>15 (default)</option>
				<option value='5' <?php if ( $_POST['numperpage'] == 5 ) { echo 'selected'; } ?>>5</option>
				<option value='10' <?php if ( $_POST['numperpage'] == 10 ) { echo 'selected'; } ?>>10</option>
				<option value='30' <?php if ( $_POST['numperpage'] == 30 ) { echo 'selected'; } ?>>30</option>
				<option value='50' <?php if ( $_POST['numperpage'] == 50 ) { echo 'selected'; } ?>>50</option>
				<option value='100' <?php if ( $_POST['numperpage'] == 100 ) { echo 'selected'; } ?>>100</option>
				<option value='150' <?php if ( $_POST['numperpage'] == 150 ) { echo 'selected'; } ?>>150</option>
			</select>
		</td>
	</tr>
	<tr class="trodd">
		<td width="10%">Instituição</td>
		<td width="85%">
			<input type="radio" name="instituicao" value="0" <?php if(!isset($_POST['instituicao']) || $_POST['instituicao']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="instituicao" value="1" <?php if($_POST['instituicao']== '1') echo 'checked';?> />IFSC-USP &nbsp;&nbsp;&nbsp;
			<input type="radio" name="instituicao" value="2" <?php if($_POST['instituicao']== '2') echo 'checked';?> />Outras
		</td>
	</tr>
	<tr class="treven">
		<td width="10%">Nível</td>
		<td width="85%">
			<input type="radio" name="nivel" value="0"  <?php if(!isset($_POST['nivel']) || $_POST['nivel']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="nivel" value="1" <?php if($_POST['nivel']== '1') echo 'checked';?> />Filtrar: &nbsp;<br />
			<input type="checkbox" name="nivel_check_grad" value="1" <?php if($_POST['nivel_check_grad']== '1') echo 'checked';?> />Graduação &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="nivel_check_mest" value="1" <?php if($_POST['nivel_check_mest']== '1') echo 'checked';?> />Mestrado &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="nivel_check_doc" value="1" <?php if($_POST['nivel_check_doc']== '1') echo 'checked';?> />Doutorado &nbsp;&nbsp;&nbsp;
			
		</td>
	</tr>
	<tr class="trodd">
		<td width="10%">Avaliador</td>
		<td width="85%">
			<input type="radio" name="avaliador" value="0" <?php if(!isset($_POST['avaliador']) || $_POST['avaliador']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="avaliador" value="1" <?php if($_POST['avaliador']== '1') echo 'checked';?> />Filtrar: &nbsp;<br />
			<input type="checkbox" name="avaliador_check_0" value="0" <?php if($_POST['avaliador_check_0']== '0') echo 'checked';?> />Completo &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="avaliador_check_1" value="1" <?php if($_POST['avaliador_check_1']== '1') echo 'checked';?>/>Sem 1 avaliador &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="avaliador_check_2" value="2" <?php if($_POST['avaliador_check_2']== '2') echo 'checked';?>/>Sem avaliadores	
			
		</td>
	</tr>
	<tr class="treven">
		<td width="10%">Sessão</td>
		<td width="85%">
			<input type="radio" name="secao" value="0" <?php if(!isset($_POST['secao']) || $_POST['secao']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="secao" value="1" <?php if($_POST['secao']== '1') echo 'checked';?> />Filtrar: &nbsp;<br />
			<input type="checkbox" name="secao_check_0" value="0" <?php if($_POST['secao_check_0']== '0') echo 'checked';?> />Sem sessão &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="secao_check_1" value="1" <?php if($_POST['secao_check_1']== '1') echo 'checked';?>/>Sessão 1 &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="secao_check_2" value="2" <?php if($_POST['secao_check_2']== '2') echo 'checked';?>/>Sessão 2 &nbsp;&nbsp;&nbsp;	
			<input type="checkbox" name="secao_check_3" value="3" <?php if($_POST['secao_check_3']== '3') echo 'checked';?>/>Sessão 3 &nbsp;&nbsp;&nbsp;	
			<input type="checkbox" name="secao_check_4" value="4" <?php if($_POST['secao_check_4']== '4') echo 'checked';?>/>Sessão 4 &nbsp;&nbsp;&nbsp;	
			<input type="checkbox" name="secao_check_5" value="5" <?php if($_POST['secao_check_5']== '5') echo 'checked';?>/>Sessão 5 &nbsp;&nbsp;&nbsp;		
		</td>
	</tr>
	
</table>
</div>
