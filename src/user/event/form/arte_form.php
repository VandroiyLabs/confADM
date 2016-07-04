<div style="margin: 20px auto 0 auto; width: 450px">
	<b>Inscrever para show de talentos/obra art&iacute;stica?
	<input type="radio"  name="participa" value="1" onClick='habilita_arte();' <?php echo $arte_checked;?> > Sim
	<input type="radio" name="participa" value="0" onClick='desabilita_arte();' <?php echo $arte_nochecked;?>> Não
	
	<br />
	<p class="textocorrido" style="width: 450px;">
		N&atilde;o fornecemos material. <br />
		T&iacute;tulo e descri&ccedil;&atilde;o serão anexados no material.<br />
		O número de vagas para o show de talentos é limitada e será confirmada via e-mail. Detalhe o máximo possível sua apresentação.
	</p>
	
</div>

<table cellspacing="15" cellpadding="1" border="0"> 
	<tr>	
		<td valign="top" align="center"  class='type' colspan='2' >
		 </b></td>
	</tr>	
	
	<tr>
		<td  align="right" width='30%'></td>
		<td align="left"> 
			
		</td>
	</tr>
	<tr>
		<td align="right" ></td>
		<td  align="left">
			<input type="checkbox" name="termos" value="1" <?php if($inscricao->get_codigo_arte() > 0) echo 'checked';?> /> Li e aceito os <a href="<?php echo $baseurl;?>obraarte.php">Termos</a>.
			<p id="termos" style="display:none;color: #a00;"><br />Você deve ler e aceitar os termos antes de prosseguir.</p>			
		</td>
	</tr>
	<tr>
		 <td  align="right">T&iacute;tulo:</td>
		<td align="left">
			<input type="text" name="titulo" value="<?php echo htmlspecialchars($arte->get_titulo(), ENT_QUOTES);?>" maxlength="200" size='46' >*
		</td>
	</tr>
	<tr>
		<td  align="right">Tipo de obra:</td>
		<td align="left">
			<select name="tipo_obra">
				<option value="Nenhum" <?php if ( strcmp($arte->get_tipo_obra(), 'Nenhum') == 0 ) echo 'selected'; ?>>Nenhum</option>
				<option value="Texto" <?php if ( strcmp($arte->get_tipo_obra(), 'Texto') == 0 ) echo 'selected'; ?>>Texto</option>
				<option value="Foto" <?php if ( strcmp($arte->get_tipo_obra(), 'Foto') == 0 ) echo 'selected'; ?>>Foto</option>
				<option value="Quadro" <?php if ( strcmp($arte->get_tipo_obra(), 'Quadro') == 0 ) echo 'selected'; ?>>Quadro (desenho ou pintura)</option>
				<option value="Escultura" <?php if ( strcmp($arte->get_tipo_obra(), 'Escultura') == 0 ) echo 'selected'; ?>>Escultura</option>
				<option value="Outros" <?php if ( strcmp($arte->get_tipo_obra(), 'Outros') == 0 ) echo 'selected'; ?>>Outros</option>
			</select>
		</td>
	</tr>
	<tr>
		<td  align="right">Tipo de apresentação:</td>
		<td align="left">
			<select name="tipo_apresentacao">
				<option value="Nenhum" <?php if ( strcmp($arte->get_tipo_apresentacao(), 'Nenhum') == 0 ) echo 'selected'; ?>>Nenhum</option>
				<option value="Música" <?php if ( strcmp($arte->get_tipo_apresentacao(), 'Música') == 0 ) echo 'selected'; ?>>Música</option>
				<option value="Dança" <?php if ( strcmp($arte->get_tipo_apresentacao(), 'Dança') == 0 ) echo 'selected'; ?>>Dança</option>
				<option value="Outros" <?php if ( strcmp($arte->get_tipo_apresentacao(), 'Outros') == 0 ) echo 'selected'; ?>>Outros</option>
			</select>
		</td>
	</tr>
	<tr>
		<td align="right" ><b>Espa&ccedil;o necess&aacute;rio:</b></td>
		<td align="left" ></td>
	</tr>
	<tr>
		<td  align="right">Altura:</td>
		<td align="left"><input type="text" name="altura" maxlength="5" size="5" value="<?php echo htmlspecialchars($arte->get_altura(), ENT_QUOTES);?>" > cm</td>
	</tr>
	<tr>
		<td  align="right">Largura:</td>
		<td align="left"><input type="text" name="largura" maxlength="5" size="5" value="<?php echo htmlspecialchars($arte->get_largura(), ENT_QUOTES);?>" > cm</td>
	</tr>
	<tr>
		<td  align="right">Profundidade:</td>
		<td align="left"><input type="text" name="profundidade"  maxlength="5" size="5" value="<?php echo htmlspecialchars($arte->get_profundidade(), ENT_QUOTES);?>" > cm</td>
	</tr>
	<tr>
		<td  align="right" width='30%'></td>
		<td align="left" >Máximo 400 caracteres.</td>
	</tr>
	<tr>
		<td  align="right" width='30%'>Descri&ccedil;&atilde;o:</td>
		<td align="left" ><textarea name="descricao" rows="8" cols="44" maxlength="400"  ><?php echo htmlspecialchars($arte->get_descricao(), ENT_QUOTES);?></textarea>*</td>
	</tr>
	
	
</table>

