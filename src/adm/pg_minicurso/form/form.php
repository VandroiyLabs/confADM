<script type="text/javascript" language="javascript" src="minicursos/form/script.js" ></script>

<table cellspacing="0" cellpadding="0" border="0" width="100%" id="block"> 
<tr>
	<td colspan="2" bgcolor="#c4c4c4" height="20" valign="center" align="center" id="pt"><b>Minicurso</b></td>
</tr>
<tr>
	<td colspan="2" height="10"></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="1"> 

			<tr>
				<td align="right" width="30%"><b>Titulo:</b></td>
				<td align="left"><input type="text" name="titulo" value="<?=$minicurso->get_titulo()?>" maxlength="200" size='40' class='form'></td>
			</tr>
			<tr>
				<td align="right"><b>Responsável:</b></td>
				<td align="left"><input type="text" name="responsavel" value="<?=$minicurso->get_responsavel()?>" maxlength="180" size='40' class='form'></td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Vagas:</b></td>
				<td align="left"><input type="text" name="vagas" value="<?=$minicurso->get_vagas()?>" maxlength="4" size='40' class='form'></td>
			</tr>
			<?php
			if ( $page == 'excluir' )
			{ ?>
			<tr>
				<td align="right" width="30%"><b>Inscritos:</b></td>
				<td align="left"><input type="text" name="inscritos" value="<?=$minicurso->get_inscritos()?>" maxlength="4" class='form_warning' disabled></td>
			</tr>
			<?php 
			}?>
			<tr>
				<td align="right"><b>Resumo:</b></td>
				<td align="left"><textarea type="text" name="descricao" rows="15" cols="40" class='form'><?=$minicurso->get_descricao()?></textarea>
			</tr>
			<tr>
				<td align="left"><input type="hidden" name="tipo" value="<?=$minicurso->get_tipo()?>" maxlength="20" class='form'></td>
				<td height="10"></td>
			</tr>
		</table>
	</td>
</tr>
</table>
<input type="hidden" name="codigo" value="<?=$minicurso->get_codigo_minicurso()?>" maxlength="20" class='form' />
<table>
	<tr> 
		<td height='12' colspan='2'></td> 
	</tr> 
</table>
