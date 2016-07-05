<div id="content">
<div class="post">
<div class='content'>

	<h2>Tem certeza que quer excluir este minicurso?</h2>

	<p>Excluir este minicurso irá fazer com que todos os usuários que estavam cadastrados neste minicurso possam cadastrar-se nos outros minicursos.</p>

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
					<input type="submit" value=" Excluir " class="button_vermelho">
				</td> 
			</tr>
		</table>
		<input type='hidden' name='codigo_evento' value='<?=$evento->get_codigo_evento()?>'/>
		<input type='hidden' name='page' value='excluir'/>
	</form>
</div>
</div>
</div>
