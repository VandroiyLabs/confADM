<form method='POST' name='formulario_summer' action='inscricao/action/participante_action.php'>
<script type='text/javascript' language='javascript' src='inscricao/form/evento_script.js' ></script>


<table cellspacing="0" cellpadding="0" border="0" width="100%" id="block"> 
<tr>
	<td colspan="2" bgcolor="#c4c4c4" height="20" valign="center" align="center" id="pt"><b>Dados Gerais</b></td>
</tr>
<tr>
	<td colspan="2" height="10"></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="1"> 

			<tr>
				<td align="right" width="30%"><b>Instituição:</b></td>
				<td align="left"><input type="text" name="instituicao" value="<?=$inscricao->get_instituicao()?>" maxlength="90" class='form'>&nbsp;*</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Nível:</b></td>
				<td align="left"><input type="text" name="nivel" value="<?=$inscricao->get_nivel()?>" maxlength="30" class='form'>&nbsp;*</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Curso:</b></td>
				<td align="left"><input type="text" name="curso" value="<?=$inscricao->get_curso()?>" maxlength="30" class='form'>&nbsp;*</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Grupo de Pesquisa:</b></td>
				<td align="left"><input type="text" name="grupo" value="<?=$inscricao->get_grupo()?>" maxlength="30" class='form'>&nbsp;*</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Orientador:</b></td>
				<td align="left"><input type="text" name="orientador" value="<?=$inscricao->get_orientador()?>" maxlength="90" class='form'>&nbsp;*</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Codigo de Barra:</b></td>
				<td align="left"><input type="text" name="codigo_barra" value="<?=$inscricao->get_codigo_barra()?>" maxlength="20" class='form'>&nbsp;*</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Token:</b></td>
				<td align="left"><input type="text" name="token" value="<?=$inscricao->get_token()?>" maxlength="20" class='form'>&nbsp;*</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Modalidade:</b></td>
				<td align="left"><input type="text" name="modalidade" value="<?=$inscricao->get_modalidade()?>" maxlength="20" class='form'>&nbsp;*</td>
			</tr>

			<tr>
				<td align="right" width="30%"><b>Premio:</b></td>
				
				<td align="left"><input type="text" name="premio" value="<?=$inscricao->get_premio()?>" maxlength="100" class='form'>&nbsp;*</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Dia da Avaliação:</b></td>
				<td align="left"><input type="text" name="dia_avaliacao" value="<?=$inscricao->get_dia_avaliacao()?>" maxlength="100" class='form'>&nbsp;*</td>
			</tr>
			
			<tr>
				<td colspan="2" height="10"></td>
			</tr>
		</table>
	</td>
</tr>

<table>
	<tr> 
		<td height="12" colspan="2"></td> 
	</tr> 
</table>

<table border="0" width="100%" > 
	<tr> 
		<td align="right" >
			<td align='right' width="90%">
				<input type="reset" value=" Limpar " class="button" >			
			</td> 
			<td align='right' >
				<input type="submit" <?=$button?>>
			</td> 
		</td> 
	</tr>
</table>
