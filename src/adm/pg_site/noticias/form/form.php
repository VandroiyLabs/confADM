<script type="text/javascript" language="javascript" src="noticias/form/script.js" ></script>

<table cellspacing="0" cellpadding="0" border="0" width="100%" id="block"> 
<tr>
	<td colspan="2" bgcolor="#c4c4c4" height="20" valign="center" align="center" id="pt"><b>Cadastro de Notícias</b></td>
</tr>
<tr>
	<td colspan="2" height="10"></td>
</tr>
<tr>
	<td>
		<table width="100%" border="0" cellspacing="5" cellpadding="1"> 

			<tr>
				<td align="right" width="30%"><b>Titulo:</b></td>
				<td align="left"><input type="text" name="titulo" value="<?=$noticia->get_titulo()?>" maxlength="40" class='form' <?php if($p2 == "excluir") echo "disabled"?>>&nbsp;*</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Autor:</b></td>
				<td align="left"><input type="text" name="autor" value="<?php if($_GET["p2"] == "incluir") echo $adm->get_nome(); else echo $noticia->get_autor(); ?>" maxlength="100" class='form' <?php if($p2 == "excluir") echo "disabled"?>>&nbsp;*</td>
			</tr>
			<tr>
				<td align="right" width="30%"><b>Conteúdo:</b></td>
				<td align="left"><textarea rows="15" cols="44" name="conteudo" class='form' <?php if($p2 == "excluir") echo "disabled"?>><?=$noticia->get_conteudo()?></textarea>&nbsp;*</td>
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
