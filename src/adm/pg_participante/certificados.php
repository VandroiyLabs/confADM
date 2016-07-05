
<?php
	$evento  = new Evento();
	$evento->find_evento_aberto();

	$frequencia = new ParticipanteFrequencia();
	$consulta_participacao = mysql_num_rows($frequencia->find_all_by_evento_by_filtro($evento->get_codigo_evento(), "AND frequencia_palestras >= ".$evento->get_threshold_participacao()));
	$consulta_minicurso = mysql_num_rows($frequencia->find_all_by_evento_by_filtro($evento->get_codigo_evento(), "AND frequencia_minicurso >= ".$evento->get_threshold_minicurso()));


?>
<div id="content">
<div class="post">
	<div class="content">
	<h2>Certificados do Evento</h2>
<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "		<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}


	echo "<p>Total de participantes que recebem certificados de participação: ".$consulta_participacao."</p>";
	echo "<p>Total de participantes que recebem certificados de minicurso: ".$consulta_minicurso."</p>";


?>

	
	<form method="post" action="http://sifsc.ifsc.usp.br/adm/pg_participante/action/certificado_action.php" name="formulario">

	<table align="center" width="100%" border="0" cellspacing="4" cellpadding="1" >
		<tr>
			<td colspan='2' height='20' ></td>
		</tr>
		<tr>
			<td width="30%" align="right" >Liberar certificados?</td>
			<td align="left" class="input"><input type="radio" name="certificados_disponiveis"  value="1" <?php if($evento->get_certificados_disponiveis()== 1) echo "checked";?> />Sim <input type="radio" name="certificados_disponiveis"  value="0" <?php if($evento->get_certificados_disponiveis()== 0) echo "checked";?> />Não</td>
		</tr>
		<tr>
			<td colspan='2' height='20' ></td>
		</tr>
		<tr>
			<td width="30%" align="right" >Threshold Participação</td>
			<td align="left" class="input"><input type="text" name="threshold_participacao"  value="<?php echo $evento->get_threshold_participacao();?>" class="textfield" size="10"/></td>
		</tr>
		<tr>
			<td colspan='2' height='20' ></td>
		</tr>
		<tr>
			<td width="30%" align="right" >Threshold Minicurso</td>
			<td align="left" class="input"><input type="text" name="threshold_minicurso"  value="<?php echo $evento->get_threshold_minicurso();?>" class="textfield" size="10"/></td>
		</tr>
<tr> 
			<td  colspan='2' align='right'>
				<input type="submit" class="button_azul" value=" Salvar " />
			</td>
		</tr>
	</table>
	</form>
<?php

echo "Número de participantes detectados: 463 (70.1515151515 %)<br /><br />

  Numero de falhas encontradas: 8<br />
  ------------------------------------------------------------ <br /><br />

  Erro 1<br />
   - Leitor:              leitor6.txt<br />
   - Data:                 2:32:44 PM 2/18/12 <br />
   - Codigo identificado: Code-128<br />
   - Leitura (no codigo): TR10<br /><br />

  Erro 2<br />
   - Leitor:              leitor6.txt<br />
   - Data:                 2:32:54 PM 2/18/12 <br />
   - Codigo identificado: Code-128<br />
   - Leitura (no codigo): TR10<br /><br />

  Erro 3<br />
   - Leitor:              leitor6.txt<br />
   - Data:                 6:11:49 PM 2/18/12 <br />
   - Codigo identificado: Code-128<br />
   - Leitura (no codigo): TR10<br /><br />

  Erro 4<br />
   - Leitor:              leitor6.txt<br />
   - Data:                 6:12:00 PM 2/18/12 <br />
   - Codigo identificado: Code-128<br />
   - Leitura (no codigo): TR10<br /><br />

  Erro 5<br />
   - Leitor:              leitor6.txt<br />
   - Data:                 6:17:21 PM 2/18/12 <br />
   - Codigo identificado: EAN-13<br />
   - Leitura (no codigo): 9788537801550<br /><br />

  Erro 6<br />
   - Leitor:              leitor6.txt<br />
   - Data:                 6:17:27 PM 2/18/12 <br />
   - Codigo identificado: EAN-13<br />
   - Leitura (no codigo): 9788537801550<br /><br />

  Erro 7<br />
   - Leitor:              leitor7.txt<br />
   - Data:                 17:37:19 AM 2/17/12 <br />
   - Codigo identificado: EAN-8<br />
   - Leitura (no codigo): 78600010<br /><br />

  Erro 8<br />
   - Leitor:              leitor4.txt<br />
   - Data:                 4:11:10 PM 10/17/12<br />
   - Codigo identificado: EAN-8<br />
   - Leitura (no codigo): 78600010";
?>
</div>
</div>
</div><!--Content-->
