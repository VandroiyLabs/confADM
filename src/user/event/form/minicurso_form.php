<input type="hidden"  name="participa" value="1" onClick='habilita_minicurso();' >

<table id="tabela_de_minicursos" cellspacing="15" cellpadding="1" border="0" > 
<tr>

		<td  align="center">
			<input type="checkbox" name="termos" value="1" /> Li e aceito os <a href="<?php echo $baseurl;?>minicurso.php">Termos</a>.
			<p id="termos" style="display:none;color: #a00;">Você deve ler e aceitar os termos antes de prosseguir.</p><br />
		</td>
	</tr>
<?php
	$consulta = $minicurso->find_all_available_by_evento( $evento->get_codigo_evento() );
	$total = mysql_num_rows($consulta);
	while ($row = mysql_fetch_object($consulta))
	{
		$vagas = $row->vagas - $row->inscritos;
		if( $vagas > 0 )
		{
		echo "			<tr>\n				" .
			"<td><input type=\"radio\" name=\"minicurso\" onClick=\"showabstract('" . $row->codigo_minicurso . "');\" value=\"".$row->codigo_minicurso."\" /><b>".$row->titulo."</b> - ".$vagas." vagas. </td>\n".
			"			</tr>".
			"			<tr>\n				" .
			"<td id=\"autormc" . $row->codigo_minicurso . "\" class='mc_autor'>" . $row->responsavel . "</td>\n".
			"			</tr>".
			"			<tr>\n				" .
			"<td id=\"resumomc" . $row->codigo_minicurso . "\" class='mc_descricao'><p class='textocorrido'><b>Resumo:</b> " . nl2br($row->descricao) . "</p></td>\n".
			"			</tr>";
		}

	}
	?>

</table>
