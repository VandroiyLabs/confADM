<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN""http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>

	<link rel='stylesheet' type='text/css' href='reset.css' />
	<link rel='stylesheet' type='text/css' href='http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/themes/start/jquery-ui.css' />
	<link rel='stylesheet' type='text/css' href='jquery.weekcalendar.css' />
	<link rel='stylesheet' type='text/css' href='calendar.css' />
	
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js'></script>
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js'></script>
	<script type='text/javascript' src='jquery.weekcalendar.js'></script>
	<script type='text/javascript' src='calendar.js'></script>

</head>
<body> 

	<table width='100%' align='left'>
		<tr>
			<td>
				<div id='calendar'></div>
			</td>
		</tr>
	</table>
	<div id="event_edit_container">
		<form>
			<input type="hidden" />
			<ul>
				<li>
					<span>Date: </span><span class="date_holder"></span> 
				</li>
				<li>
					<label for="start">Tipo: </label>
					<select name="color" >
						
						<option value="fffc17" style="background: #fffc17;">Palestras (Amarela)</option>
						
						<option value="888fe8" style="background: #888fe8;">Minicursos (Azul)</option>
						
						<option value="84de8b" style="background: #84de8b;">Cultural (Verde)</option>
						
						<option value="c3c8c4" style="background: #c3c8c4;">Intervalos/Coffee (Cinza)</option>
						
						<option value="808080" style="background: #808080;">Intervalo (Cinza Escuro)</option>
						
						<option value="FF3333" style="background: #FF3333;">Workshop (Vermelho)</option>
						
						<option value="fe8eff" style="background: #fe8eff;">Apresentação Oral (Roxo)</option>
						
						<option value="d2a142" style="background: #d2a142;">Abertura/Encerramento (Laranja)</option>
					</select>
				</li>
				<li>
					<label for="start">Inicio: </label><select name="start"></select>
				</li>
				<li>
					<label for="end">Fim: </label><select name="end"></select>
				</li>
				<li>
					<label for="titulo">Titulo: </label><input type="text" name="titulo" />
				</li>
				<li>
					<label for="resumo">Resumo: </label><textarea name="resumo"></textarea>
				</li>
				<li>
					<label for="instituicao">Instituicao: </label><input type="text" name="instituicao" />
				</li>
				<li>
					<label for="autor">Autor: </label><input type="text" name="autor" />
				</li>
				<li>
					<label for="chamada">Chamada: </label><input type="text" name="chamada" />
				</li>
				<li>
					<label for="local">Local: </label><input type="text" name="local" />
				</li>
			</ul>
		</form>
	</div>	

</body>
</html>
