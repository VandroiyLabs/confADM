<script type="text/javascript" language="javascript" src="form/adm_script.js" ></script>

<table cellspacing="0" cellpadding="0" border="0" width="100%" id="block"> 
	<tr>
		<td colspan="2" bgcolor="#c4c4c4" height="20" valign="center" align="center" id="pt"><b>Dados da Conta</b></td>
	</tr>
	<tr>
		<td colspan="2" height="10"></td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="5" cellpadding="1"> 
				<tr>
					<td align="right" width="30%"><b>Usuário:</b></td>
					<input type="hidden" name="usuario" value="<?=$adm_novo->get_usuario()?>" />
					<td align="left"><input type="text" name="usuario" value="<?=$adm_novo->get_usuario()?>" maxlength="15" size="46"   <?php if(isset($_REQUEST["usuario"])) echo "disabled='disabled'"; ?>>&nbsp;*</td>
				</tr>
				<tr>
					<td align="right"><b>Senha:</b></td>
					<td align="left"><input type="password" name="senha" value="" maxlength="8" size="46" >&nbsp;* (max 8 digítos)</td>
				</tr>
				<tr>
					<td align="right"><b>Confirmar Senha:</b></td>
					<td align="left"><input type="password" name="senha_confirm" value="" maxlength="8" size="46" >&nbsp;*</td>
				</tr>
			</table> 
		</td> 
	</tr>
	<tr> 
		<td height="5" colspan="2"></td> 
	</tr> 	
</table>

<table>
	<tr> 
		<td height="12" colspan="2"></td> 
	</tr> 
</table>

<!------------------------------------------------------------------------------------------------------------------------------>

<table cellspacing="0" cellpadding="1" border="0" width="100%" id="block"> 
<tr>
	<td bgcolor="#c4c4c4" height="20" valign="center" align="center"><b>Identificação do Administrador</b></td>
</tr>
<tr>
	<td height="10"></td>
</tr>
<tr align="center">
	<td>
		<table width="100%" border="0" cellspacing="5">
		<tr>
			<td align="right" width='30%'><b>Nome:</b></td>
			<td align="left"><input  type="text" name="nome" value="<?=$adm_novo->get_nome()?>" maxlength="40" size="46" >&nbsp;*</td>
		</tr>
		<tr>
			<td align="right"><b>E-mail:</b></td>
			<td align="left"><input type="text" name="email" value="<?=$adm_novo->get_email()?>" maxlength="30" size="46" >&nbsp;*</td>
		</tr>
		<tr>
			<td colspan="2" height="4"></td>
		</tr>
		</table>
	</td>
</tr>
<tr> 
	<td height="5" colspan="2"></td> 
</tr> 
</table>

<table>
	<tr> 
		<td height='12' colspan='2'></td> 
	</tr> 
</table>

<?php

if ( $adm->get_tipo() == 0 )
{

?>
<table cellspacing="0" cellpadding="1" border="0" width="100%" id="block"> 
<tr>
	<td bgcolor="#c4c4c4" height="20" valign="center" align="center"><b>Escolha os privilégios do administrador:</b></td>
</tr>
<tr>
	<td height="10"></td>
</tr>
<tr>
	<td colspan="2" height="4"></td>
</tr>
<tr>
	<td align="center" colspan="2">
		
		<input type='radio' name='tipo' value='0' <?php if ( $adm_novo->get_tipo() == 0 ) echo "checked"; ?>> Completo &nbsp;&nbsp;&nbsp;
		<input type='radio' name='tipo' value='1' <?php if ( $adm_novo->get_tipo() == 1 ) echo "checked"; ?>> Sem avaliação &nbsp;&nbsp;&nbsp;
		<input type='radio' name='tipo' value='2' <?php if ( $adm_novo->get_tipo() == 2 ) echo "checked"; ?>> Biblioteca &nbsp;&nbsp;&nbsp;
		
</tr>

<tr>
	<td height="10"></td>
</tr>
</table>

<?php
}

?>

<table>
	<tr> 
		<td height='12' colspan='2'></td> 
	</tr> 
</table>
