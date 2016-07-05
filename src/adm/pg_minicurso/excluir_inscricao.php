<div id="content">
<div class="post">


<form method="POST" name="formulario" action="action/action.php" onsubmit="return valid_form()">
<?php
	$minicurso = new Minicurso();
	$minicurso->find_by_codigo($_GET["codigo_minicurso"]);
	$_SESSION["minicurso"] = $minicurso;
	
	$pessoa = new Pessoa();
	$pessoa->find_by_codigo($_GET["codigo_pessoa"]);
	
	echo "<h2>Realmente deseja retirar a inscrição de " . $pessoa->get_nome() . " do minicurso " . $minicurso->get_titulo() . "?</h2><br /><br />";
?>
<table border='0' width='100%' > 
	<tr> 
		<td align='right' >
			<input type="submit" value=" Desmatricular " class="button_vermelho">
		</td> 
	</tr>
</table>
<?php 
	echo "<input type='hidden' name='codigo_pessoa' value='" . $pessoa->get_codigo_pessoa() . "'/>";
	echo "<input type='hidden' name='codigo_minicurso' value='" . $minicurso->get_codigo_minicurso() . "'/>";
	echo "<input type='hidden' name='page' value='excluir_inscricao'/>";
?>
</form>


</div>
</div>
