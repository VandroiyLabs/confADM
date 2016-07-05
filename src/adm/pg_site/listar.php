<div id="content">
<div class="post">
	<div class="content">

	<?php
		$classe = 'listar';
		$message = 'Relatório de Eventos';
		include("../includes/message.php");
	?>
	
	<table border="0" cellspacing="0" cellpadding="0" width='100%'>
		
	<?php

		$evento = new Evento();
		
		$consulta = $evento->find_all();
		$total = mysql_num_rows($consulta);
			
		while ($row = mysql_fetch_object($consulta)){
			
			$inscricao = new Inscricao();
			$consulta2 = $inscricao->find_by_evento($row->codigo_evento);
			$total = mysql_num_rows($consulta2);

			$consulta3 = $inscricao->find_by_evento_e_deferimento($row->codigo_evento,'2');
			$deferidos = mysql_num_rows($consulta3);
			$nao_deferidos = $total - $deferidos;

			if($row->aberto == 0) $inscricoes_abertas = "Não <img  src='../images/s_error.png'";
			else $inscricoes_abertas = "Sim <img  src='../images/s_success.png'";

			echo"
			<tr>
				<td valign='top'>
				<!-- Topo 1 ---------------------------------->
					<table border='0' cellspacing='0' cellpadding='5' bgcolor='#e9e9e9' width='100%' id='block'>					
	<tr  bgcolor='#c4c4c4'>
		<td height='30' > <b>$row->nome</b></td>
		<td align='right' >
			<form method='get' action='home.php'>
			<input type='submit' value='  Alterar  ' class='button_alterar'>
			<input type='hidden' name='codigo_evento' value='$row->codigo_evento'/>
			<input type='hidden' name='p1' value='alterar'/>
			</form>
		</td>
	</tr>
	<tr>
		<td height = '20' colspan='2'><b>Inscrições Abertas: </b>$inscricoes_abertas</td>
	</tr>
	<tr>		
		<td height='20' colspan='2'><b>Número de Inscritos: </b>$total ";
			if($nao_deferidos > 0)
			echo "- <font color='red'>$nao_deferidos aguardando deferimento</font>";
			echo"
		</td>
	</tr>
	<tr>
		<td height = '20' colspan='2'><b>Web-site: </b><a href='$row->website' target='_blank'>$row->website</a></td>
	</tr>
	<tr>
		<td align='right' colspan='2' >
			<form method='get' action='home.php'>
			<select name='opcao'  ONCHANGE='submit();' class='opcoes'>
			<option value='0'>Ações</option>
			<option value='listar'>Listar Participantes</option>
			<option value='correio'>Enviar e-mail para todos</option>
			<option value='relatorio_parcial'>Relatório de Participantes - Parcial</option>
			<option value='relatorio_completo'>Relatório de Participantes - Completo</option>
			<option value='resumo'>Gerar Livro de Resumos</option>
			<option value='planilha_prever'>Planilha Prever</option>
			<option value='crachas'>Gerar Crachas</option>
			<option value='certificados'>Gerar Certificados</option>
			</select>
			<input type='hidden' name='codigo_evento' value='$row->codigo_evento'/>
			<input type='hidden' name='p1' value='opcoes'/>
			</form>
		</td>
	</tr>
	<tr>
		<td height='10' colspan='2'></td>							
	</tr>
	</table>
	</td></tr>
			";

		}	
		if($total==0)
			echo "Nenhum evento cadastrado";
	?>
	</table>
	
	</div>
</div>


</div><!--Content-->
