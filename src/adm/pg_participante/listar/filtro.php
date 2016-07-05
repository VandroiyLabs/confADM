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
		<td width="10%">Resumo</td>
		<td width="85%">
			<input type="radio" name="resumo" value="0" <?php if(!isset($_POST['resumo']) || $_POST['resumo']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="resumo" value="1" <?php if($_POST['resumo']== '1') echo 'checked';?> />Filtrar: &nbsp;<br />
			<input type="checkbox" name="resumo_check_0" value="0" <?php if($_POST['resumo_check_0']== '0') echo 'checked';?> />Sem resumo &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="resumo_check_1" value="1" <?php if($_POST['resumo_check_1']== '1') echo 'checked';?>/>Não submetidos &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="resumo_check_2" value="2" <?php if($_POST['resumo_check_2']== '2') echo 'checked';?>/>Submetidos &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="resumo_check_3" value="3" <?php if($_POST['resumo_check_3']== '3') echo 'checked';?>/>Em correção &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="resumo_check_4" value="4" <?php if($_POST['resumo_check_4']== '4') echo 'checked';?>/>Indeferidos &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="resumo_check_5" value="5" <?php if($_POST['resumo_check_5']== '5') echo 'checked';?>/>Deferidos
			
		</td>
	</tr>
	<tr class="treven">
		<td width="10%">Deferimento</td>
		<td width="85%">
			<input type="radio" name="deferimento" value="0" <?php if(!isset($_POST['deferimento']) || $_POST['deferimento']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="deferimento" value="1" <?php if($_POST['deferimento']== '1') echo 'checked';?> />Aguardando biblioteca &nbsp;&nbsp;&nbsp;
			<input type="radio" name="deferimento" value="2" <?php if($_POST['deferimento']== '2') echo 'checked';?> />Aguardando comissão
		</td>
	</tr>
	<tr class="trodd">
		<td width="10%">Arte</td>
		<td width="85%">
			<input type="radio" name="arte" value="0" <?php if(!isset($_POST['arte']) || $_POST['arte']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="arte" value="1" <?php if($_POST['arte']== '1') echo 'checked';?> />Filtrar: &nbsp;<br />
			<input type="checkbox" name="arte_check_0" value="0" <?php if($_POST['arte_check_0']== '0') echo 'checked';?> />Sem arte &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="arte_check_1" value="1" <?php if($_POST['arte_check_1']== '1') echo 'checked';?>/>Não submetidos &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="arte_check_2" value="2" <?php if($_POST['arte_check_2']== '2') echo 'checked';?>/>Submetidos &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="arte_check_3" value="3" <?php if($_POST['arte_check_3']== '3') echo 'checked';?>/>Indeferidos &nbsp;&nbsp;&nbsp;
			<input type="checkbox" name="arte_check_4" value="4" <?php if($_POST['arte_check_4']== '4') echo 'checked';?>/>Deferidos
			
		</td>
	</tr>
	<tr class="treven">
		<td width="10%">Minicursos</td>
		<td width="85%">
			<input type="radio" name="minicurso" value="0" <?php if(!isset($_POST['minicurso']) || $_POST['minicurso']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="minicurso" value="1" <?php if($_POST['minicurso']== '1') echo 'checked';?> />Inscritos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="minicurso" value="2" <?php if($_POST['minicurso']== '2') echo 'checked';?>/>Não inscritos
		</td>
	</tr>
	<tr class="trodd">
		<td width="10%">Cadastros</td>
		<td width="85%">
			<input type="radio" name="cadastro" value="0" <?php if(!isset($_POST['cadastro']) || $_POST['cadastro']== '0') echo 'checked';?>/>Dados pessoas preenchidos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="cadastro" value="1" <?php if($_POST['cadastro']== '1') echo 'checked';?>/>Sem preencher dados pessoais &nbsp;&nbsp;&nbsp;
			<input type="radio" name="cadastro" value="2" <?php if($_POST['cadastro']== '2') echo 'checked';?>/>Conta não ativada
		</td>
	</tr>
	<tr class="treven">
		<td width="10%">Prêmio</td>
		<td width="85%">
			<input type="radio" name="premio" value="0" <?php if(!isset($_POST['premio']) || $_POST['premio']== '0') echo 'checked';?>/>Todos &nbsp;&nbsp;&nbsp;
			<input type="radio" name="premio" value="1" <?php if($_POST['premio']== '1') echo 'checked';?> />Concorre &nbsp;&nbsp;&nbsp;
			<input type="radio" name="premio" value="2" <?php if($_POST['premio']== '2') echo 'checked';?>/>Não concorre
		</td>
	</tr>
</table>
</div>
