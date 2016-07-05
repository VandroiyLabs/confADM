<?php
$evento = new Evento();
if(!isset($_REQUEST["email"])){

	$_REQUEST["email"] = '';

	if (isset($_GET["codigo_evento"]))
	{
		$consulta = $pessoa->find_by_evento($_GET["codigo_evento"]);

		$row = mysql_fetch_object($consulta);
		$_REQUEST["email"] .= $row->email;
	
		while ($row = mysql_fetch_object($consulta))
		{
			$_REQUEST["email"] .= ', ';
			$_REQUEST["email"] .= $row->email;
		}
		
		$evento->find_by_codigo($_GET["codigo_evento"]);
	}
	

	
}



?>


<div id='content'>
<div class='post'>
	<div class='content'>
	
	<h2>Sistema de Correio</h2>
	
	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "		<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
	?>

	<table >
		<tr> 
			<td height='12' colspan='2'></td> 
		</tr> 
		<tr>
			<td align='right' ><b>Recuperar lista de e-mails: </b></td>
				<td align='left'  >
				<form method='get' action='home.php'>
					<select name='codigo_evento' ONCHANGE='submit();' class='opcoes'>
						<option value='null'>&nbsp;&nbsp;&nbsp;</option>
						

						<?php

							$consulta = $evento->find_all();

							/*if($_GET["codigo_evento"] == 'todos')
								echo "<option value='todos' selected='selected'>Todos&nbsp;&nbsp;&nbsp;</option>";
							else
								echo "<option value='todos'>Todos&nbsp;&nbsp;&nbsp;</option>";*/
							
							while ($row = mysql_fetch_object($consulta))
							{
								if($_GET["codigo_evento"] == $row->codigo_evento)
									echo "<option value='$row->codigo_evento' selected='selected'>$row->nome&nbsp;&nbsp;&nbsp;</option>";
								else
									echo "<option value='$row->codigo_evento'>$row->nome&nbsp;&nbsp;&nbsp;</option>";
							}
						?>			
					</select>											
				<input type='hidden' name='p1' value='correio'/>
				</form>
			</td>
		</tr>
		<tr> 
			<td height='12' colspan='2'></td> 
		</tr> 

	</table>
<?php $evento->find_evento_aberto();?>

	<form method='POST' name='formulario' action='action/correio_action.php' onsubmit="return valid_form()">

		<table cellspacing="0" cellpadding="0" border="0" width="100%" id="block"> 

			<tr>
				<td colspan="2" bgcolor="#c4c4c4" height="20" valign="center" align="center"><b><?=Conexao::$adm_email;?></b></td>
			</tr>
			<tr>
				<td colspan="2" height="10"></td>
			</tr>
			<tr >
				<td align="center" >
					<table width="100%" border="0" cellspacing="5" cellpadding="1"> 
						
						<tr>
							<td align="right"><b>Destinatário:</b></td>
							<td align="left">
									<textarea rows="7" cols="61" name="destino" class='form'><?=$_REQUEST["email"]?>
									</textarea>
							</td>
						</tr>
						<tr>
							<td align="center" colspan='2'><b>Não colocar tag <?php echo $evento->get_tag_email();?> no campo assunto.</b></td>
						</tr>
						<tr>
							<td align="right"><b>Assunto:</b></td>
							<td align="left"><input type="text" name="assunto" value="" class='form'  size="61"/></td>
						</tr>
						<tr>
							<td align="right"><b>Mensagem:</b></td>
							<td align="left">
									<textarea rows="14" cols="61" name="mensagem" class='form'>
									</textarea>
							</td>
						</tr>
						<tr>
							<td align="center" colspan='2'><b>Não colocar assinatura (<?php echo $evento->get_assinatura_email();?>) no campo mensagem.</b></td>
						</tr>
					</table> 
				</td> 
			</tr>
			<tr> 
				<td height="10" colspan="2"></td> 
			</tr> 	
		</table>

		<table>
			<tr> 
				<td height="12" colspan="2"></td> 
			</tr> 
		</table>

		<table border='0' width='100%' > 
			<tr> 
				<td align='right' colspan='2' >
					<input type="submit" value="  Enviar  " class="button_verde">
				</td> 
			</tr>
		</table>

	</form>
	
	</div>
</div>

</div>
