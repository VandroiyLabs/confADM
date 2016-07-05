<div id="content">
<div class="post">
	<div class='content'>
	<div id='menu' >
		<ul><li class='incluir'><a href='#' title=''><center>Alterar Minicurso</center></a></li></ul>
	</div>
	<table>
		<tr> 
			<td height='12' colspan='2'></td> 
		</tr> 
	</table>

<form method="POST" name="formulario" action="action/action.php" onsubmit="return valid_form()">
<?php
	$minicurso = new Minicurso();
	$minicurso->find_by_codigo($_GET["codigo"]);
	include("form/form.php");
	$_SESSION["minicurso"] = $minicurso;
?>
<table border='0' width='100%' > 
	<tr> 
		<!--<td align='right' width="90%">
			<input type="reset" value=" Limpar " class="button" >			
		</td> -->
		<td align='right' >
			<input type="submit" value=" Atualizar " class="button">
		</td> 
	</tr>
</table>
<input type='hidden' name='codigo_evento' value='<?=$evento->get_codigo_evento()?>'/>
<input type='hidden' name='page' value='alterar'/>
</form>


</div>
</div>
</div>
