
<h2>Deseja excluir esta notícia?</h2>

<form method="POST" name="formulario" action="noticias/action/action.php" onsubmit="return valid_form()">
<?php
	$noticia = new Noticia();
	$noticia->find_by_codigo($_GET["codigo"]);
	include("form/form.php");
	$_SESSION["noticia"] = $noticia;
?>
<table border='0' width='100%' > 
	<tr> 
		<td align='right' >
			<input type="submit" value=" Excluir " class="button_vermelho">
		</td> 
	</tr>
</table>
<input type='hidden' name='codigo_evento' value='<?=$evento->get_codigo_evento()?>'/>
<input type='hidden' name='page' value='remove'/>
</form>
