
<form method="POST" name="formulario" action="noticias/action/action.php" onsubmit="return valid_form()">
<?php
	$noticia = new Noticia();
	include("form/form.php"); 
?>
<table border='0' width='100%' > 
	<tr> 
		<td align='right' width="90%">
			<input type="reset" value=" Limpar " class="button" >			
		</td> 
		<td align='right' >
			<input type="submit" value=" Incluir " class="button">
		</td> 
	</tr>
</table>
<input type='hidden' name='codigo_evento' value='<?=$evento->get_codigo_evento()?>'/>
<input type='hidden' name='page' value='insert'/>
</form>
