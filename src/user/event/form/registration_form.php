<table cellspacing="15" cellpadding="1" border="0" > 	


				<tr>
					<td align="right" width="30%">Nome Completo: <br />(usado para o certificado)</td>
					<td align="left"><input type="text" name="nome" value="<?php echo htmlspecialchars($pessoa->get_nome(), ENT_QUOTES);?>" maxlength="200" size="46" style="height=20">&nbsp;*</td>
				</tr>
				<tr>
					<td align="right" width="30%">CPF:</td>
					<td  align="left"><input type="text" name="icpf" maxlength="11" size="14" style="height=20"   value="<?php echo htmlspecialchars($pessoa->get_cpf(), ENT_QUOTES);?>"  >&nbsp;* (somente números)</td>
				</tr>

				<tr>
					<td align="right" width="30%">Instituição:</td>
					<td  align="left">
						 <input type="radio"  name="instituicao" value="IFSC-USP" onClick='valid_fields();' <?php if($inscricao->get_instituicao() == 'IFSC-USP' || $inscricao->get_instituicao() == '') echo 'checked';?> />IFSC-USP
						 <input type="radio" name="instituicao" value="Outra"  onClick='valid_fields();' <?php if($inscricao->get_instituicao() != 'IFSC-USP' && $inscricao->get_instituicao() != '') echo 'checked';?> />Outras *
					</td>
				</tr>
				<tr>
					<td align="right" width="30%"></td>
					<td  align="left"><input type="text" name="outrainstituicao" value="<?php if($inscricao->get_instituicao() != 'IFSC-USP') echo htmlspecialchars($inscricao->get_instituicao(), ENT_QUOTES);?>"  maxlength="200" size="46" ></td>
				</tr>
				<tr>
					<td align="right" width="30%">Número USP:</td>
					<td  align="left"><input type="text" name="nusp" value="<?php echo htmlspecialchars($pessoa->get_nusp(), ENT_QUOTES);?>" maxlength="10" size="10" > obrigatório para alunos do IFSC-USP</td>
				</tr>
				<tr>
					<td align="right" width="30%">Nível:</td>
					<td  align="left">
					<input type="radio" name="nivel" value="Doutorado" onClick='valid_fields();' <?php if($inscricao->get_nivel() == 'Doutorado' || $inscricao->get_nivel() == '') echo 'checked';?>  /> Doutorado
					<input type="radio" name="nivel" value="Mestrado" onClick='valid_fields();'  <?php if($inscricao->get_nivel() == 'Mestrado') echo 'checked';?> /> Mestrado
					<input type="radio" name="nivel" value="Graduacao" onClick='valid_fields();' <?php if($inscricao->get_nivel() == 'Graduacao') echo 'checked';?> /> Graduação
					<input type="radio" name="nivel" value="Outro" onClick='valid_fields();' <?php if($inscricao->get_nivel() != 'Doutorado' && $inscricao->get_nivel() != 'Mestrado' && $inscricao->get_nivel() != 'Graduacao') echo 'checked';?>  /> Outro *

				</td>
				</tr>
				<tr>
					<td align="right" width="30%"></td>
					<td  align="left">
						<input type="text" name="outronivel" value="<?php if($inscricao->get_nivel() != 'Doutorado' && $inscricao->get_nivel() != 'Mestrado' && $inscricao->get_nivel() != 'Graduacao') echo htmlspecialchars($inscricao->get_nivel(), ENT_QUOTES); ?>" maxlength="60" size="26" >
					</td>
				</tr>

	<tr>
		<td align="right" width="30%">Curso:</td>
		<td  align="left">
		<select name="curso" onClick='valid_fields();'>
			<?php $outro = 'selected';  ?>
			<option value="" <?php if($inscricao->get_curso()==''){ echo 'selected'; $outro='';}?> ></option>
	 		<option value="Física Básica"<?php if($inscricao->get_curso()=='Física Básica'){ echo 'selected'; $outro='';}?>>Física Básica</option>
			<option value="Física Aplicada" <?php if($inscricao->get_curso()=='Física Aplicada'){ echo 'selected'; $outro='';}?>>Física Aplicada</option>
			<option value="Física Aplicada Computacional" <?php if($inscricao->get_curso()=='Física Aplicada Computacional'){ echo 'selected'; $outro='';}?>>Física Aplicada Computacional</option>
			<option value="Física Aplicada Biomolecular" <?php if($inscricao->get_curso()=='Física Aplicada Biomolecular'){ echo 'selected'; $outro='';}?>>Física Aplicada Biomolecular</option>
			<option value="Bacharelado em Física" <?php if($inscricao->get_curso()=='Bacharelado em Física'){ echo 'selected'; $outro='';}?>>Bacharelado em Física</option>
			<option value="Bacharelado em Física Computacional" <?php if($inscricao->get_curso()=='Bacharelado em Física Computacional'){ echo 'selected'; $outro='';}?>>Bacharelado em Física Computacional</option>
			<option value="Bacharelado em Ciências Físicas e Biomoleculares" <?php if($inscricao->get_curso()=='Bacharelado em Ciências Físicas e Biomoleculares'){ echo 'selected'; $outro='';}?> >Bacharelado em Ciências Físicas e Biomoleculares</option>
			<option value="Licenciatura em Ciências Exatas" <?php if($inscricao->get_curso()=='Licenciatura em Ciências Exatas'){ echo 'selected'; $outro='';}?> >Licenciatura em Ciências Exatas</option>

			<option value="Outro" <?php echo $outro;?>>Outro curso</option>

		</select>
	*</td>
</tr>
<tr>
	<td align="right" width="30%"></td>
	<td  align="left">
		<?php
			if($outro=='selected')
			{
				$nomecurso = explode("==", $inscricao->get_curso());
				$nomecurso = $nomecurso[1];
			}
			else
			{
				$nomecurso = "";
			}
		?>
		<input type="text" name="outrocurso" value="<?php echo htmlspecialchars($nomecurso, ENT_QUOTES); ?>" maxlength="100" size="26" >
	</td>
</tr>


</table>
