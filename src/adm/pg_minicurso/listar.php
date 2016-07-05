<div id="content">
<div class="post">
	<div class='content'>
	<div id='menu' >
		<ul><li class='incluir'><a href='#' title=''><center>Listar Minicursos</center></a></li></ul>
	</div>
	<table>
		<tr>
			<td height='12' colspan='2'></td>
		</tr>
	</table>

<table border="0" cellspacing="0" cellpadding="0" width='100%'>

<?php

	$consulta = $minicurso->find_by_evento($evento->get_codigo_evento());
	$total = mysql_num_rows($consulta);
	$i = 0;
	while ($row = mysql_fetch_object($consulta)){
		$i++;
		echo"
		<tr>
			<td valign='top'>
			<!-- Topo 1 ---------------------------------->
				<table border='0' cellspacing='0' cellpadding='5' bgcolor='#e9e9e9' width='100%' id='block'>
					<tr>
						<td height='30' bgcolor='#c4c4c4' colspan='2'>
							<table width='100%'>
								<tr>
								<td><b>$row->titulo</b></td>

								<td align='right' bgcolor='#c4c4c4' width='10%'>
									<form method='get' action='home.php'>
										<input type='submit' value='  Alterar  ' class='button_amarelo'>
									<input type='hidden' name='page' value='alterar'/>
									<input type='hidden' name='codigo' value='$row->codigo_minicurso'/>
									</form>
								</td>

								<td align='right' bgcolor='#c4c4c4'></td>

								<td align='right' bgcolor='#c4c4c4' width='10%'>
									<form method='get' action='home.php'>
										<input type='submit' value='  Ver inscritos  ' class='button_azul'>
									<input type='hidden' name='page' value='listainscritos'/>
									<input type='hidden' name='codigo' value='$row->codigo_minicurso'/>
									</form>
								</td>

								<td align='right' bgcolor='#c4c4c4'></td>

								<td align='right' bgcolor='#c4c4c4' width='10%'>
									<form method='get' action='home.php'>
										<input type='submit' value='  Excluir  ' class='button_vermelho'>
									<input type='hidden' name='page' value='excluir'/>
									<input type='hidden' name='codigo' value='$row->codigo_minicurso'/>
									</form>
								</td>
								<td width='5'></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td height='10' colspan='2'></td>
					</tr>
					<tr>
						<td width='5'></td>
						<td height='30'>
							<table cellspacing='0'>
								<tr>

									<td width='90' colspan = '2'><a href='http://sifsc.ifsc.usp.br/adm/pg_minicurso/home.php?page=listainscritostxt&codigo=$row->codigo_minicurso'>Gerar lista de presença</a></td>
								</tr>
								<tr>
									<td width='90'><b>Responsavel:</b></td>
									<td align=left >$row->responsavel</td>
								</tr>
								<tr>
									<td><b>Vagas:</b></td>
									<td align=left >$row->vagas</td>
								</tr>
								<tr>
									<td><b>Inscritos:</b></td>
									<td align=left >$row->inscritos</td>
								</tr>
								<tr>
									<td height='10' colspan='2'></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>

				<table>
				<tr>
					<td height='12'></td>
				</tr>
				</table>
			</td>
		</tr>
		";
	}
	if($i == 0){
		echo "Nenhum minicurso cadastrado";
	}
?>
</table>


</div>
</div>
</div>
