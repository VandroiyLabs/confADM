<script type="text/javascript" language="javascript" src="form/evento_script.js" ></script>

<table cellspacing="0" cellpadding="0" border="0" width="100%" id="block"> 
<tr>
	<td colspan="2" bgcolor="#c4c4c4" height="20" valign="center" align="center" id="pt"><b>Cadastro de Evento</b></td>
</tr>
<tr>
	<td colspan="2" height="10"></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="1"> 

			
			<tr>
				<td align="right" width="30%"><b>Evento:</b></td>
				<td align="left"><input type="text" name="nome" value="<?=$evento->get_nome()?>" maxlength="60" size="46">&nbsp;*
				</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Tag dos e-mails:</b></td>
				<td align="left"><input type="text" name="tag_email" value="<?=$evento->get_tag_email()?>" maxlength="90" size="46">&nbsp;*
				</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Assinaturas em e-mails:</b></td>
				<td align="left"><input type="text" name="assinatura_email" value="<?=$evento->get_assinatura_email()?>" maxlength="290" size="46">&nbsp;*
				</td>
			</tr>
			<tr>
				<td align="right"><b>Data do Evento:</b></td>
				<td align="left">
					<input  type="text" name="data_inicio" value="<?=$evento->get_data_inicio()?>" size="10"  maxlength="10" onkeypress="return dateMask(this, event);">&nbsp;* à &nbsp;
					<input  type="text" name="data_fim" value="<?=$evento->get_data_fim()?>" size="10" maxlength="10"onkeypress="return dateMask(this, event);">&nbsp;* (DD/MM/AAAA)
					</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Evento ativo:</b></td>
				<td  align="left">
					<input type="radio" name="aberto" value="1"
						<?php
							if($evento->get_aberto()=='1') echo "checked='checked'";
							else if($evento->find_numero_de_eventos_abertos() > 0){
								echo "disabled";
							}
						?>
					>&nbsp;Sim
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="aberto" value="0" <?php if($evento->get_aberto()!='1') echo "checked='checked'";?>>&nbsp;Não
				</td> 
			</tr>
			<tr>
				<td align="right" width="30%"><b>Inscrições abertas:</b></td>
				<td  align="left">
					<input type="radio" name="inscricao_aberta" value="1"
						<?php
							if($evento->get_inscricao_aberta()=='1') echo "checked='checked'";
														
						?>
					>&nbsp;Sim
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="inscricao_aberta" value="0" <?php if($evento->get_inscricao_aberta()=='0') echo "checked='checked'"; ?>>&nbsp;Não
				</td> 
			</tr>
			<tr>
				<td align="right" width="30%"><b>Minicursos abertos:</b></td>
				<td  align="left">
					<input type="radio" name="minicurso_aberto" value="1"
						<?php
							if($evento->get_minicurso_aberto()=='1') echo "checked='checked'";
														
						?>
					>&nbsp;Sim
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="minicurso_aberto" value="0" <?php if($evento->get_minicurso_aberto()=='0') echo "checked='checked'"; ?>>&nbsp;Não
				</td> 
			</tr>
			<tr>
				<td align="right" width="30%"><b>Submissões abertas:</b></td>
				<td  align="left">
					<input type="radio" name="submissao_aberta" value="1"
						<?php
							if($evento->get_submissao_aberta()=='1') echo "checked='checked'";
						
						?>
					>&nbsp;Sim
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="submissao_aberta" value="0" <?php if($evento->get_submissao_aberta()=='0') echo "checked='checked'";?>  >&nbsp;Não
				</td> 
			</tr>
			<tr>
				<td align="right" width="30%"><b>Resubmissões abertas:</b></td>
				<td  align="left">
					<input type="radio" name="resubmissao_aberta" value="1"
						<?php
							if($evento->get_resubmissao_aberta()=='1') echo "checked='checked'";
						
						?>
					>&nbsp;Sim
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="resubmissao_aberta" value="0" <?php if($evento->get_resubmissao_aberta()=='0') echo "checked='checked'";?>  >&nbsp;Não
				</td> 
			</tr>
			<tr>
				<td align="right" width="30%"><b>Avaliações abertas:</b></td>
			<td  align="left">
					<input type="radio" name="avaliacao_aberta" value="1"
						<?php
							if($evento->get_avaliacao_aberta()=='1') echo "checked='checked'";
						
						?>
					>&nbsp;Sim
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="avaliacao_aberta" value="0" <?php if($evento->get_avaliacao_aberta()=='0') echo "checked='checked'";?>  >&nbsp;Não
				</td> </tr>

			<tr>
				<td align="right" width="30%"><b>Pesquisas abertas:</b></td>
				<td  align="left">
					<input type="radio" name="pesquisa_aberta" value="1"
						<?php
							if($evento->get_pesquisa_aberta()=='1') echo "checked='checked'";
						
						?>
					>&nbsp;Sim
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="pesquisa_aberta" value="0" <?php if($evento->get_pesquisa_aberta()=='0') echo "checked='checked'";?>  >&nbsp;Não
				</td> 
			</tr>

			<tr>
				<td align="right" width="30%"><b>Prêmio aberto:</b></td>
				<td  align="left">
					<input type="radio" name="premio_aberto" value="1"
						<?php
							if($evento->get_premio_aberto()=='1') echo "checked='checked'";
						
						?>
					>&nbsp;Sim
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="premio_aberto" value="0" <?php if($evento->get_premio_aberto()=='0') echo "checked='checked'";?>  >&nbsp;Não
				</td> 
			</tr>

			<tr>
				<td align="right"><b>Descrição/Comentário:</b></td>
				<td align="left"><input type="text" name="descricao" value="<?=$evento->get_descricao()?>" size="46" maxlength="100"></td>
			</tr>
			<tr>
				<td align="right"><b>Web-site:</b></td>
				<td align="left"><input type="text" name="website" value="<?=$evento->get_website()?>" maxlength="100" size="46"></td>
			</tr>
			<tr>
				<td colspan="2" height="10"></td>
			</tr>
		</table>
	</td>
</tr>
</table>
<table>
	<tr> 
		<td height='12' colspan='2'></td> 
	</tr> 
</table>
