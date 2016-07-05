	<div id="vendakits">

		<form method='post' action='home.php?p1=kits&opcao=busca'>
			<table cellspacing="0" cellpadding="0" border="0" width="100%"  id="block_new"> 
				<tr>
					<td bgcolor="#c4c4c4" height="20" valign="center" align="center" colspan="3"><b>Pesquisar por nome:</b></td>
				</tr>
				<tr>
					<td height="10"></td>
				</tr>
				<tr>
					<td align="center" width='10%'>
						<input type='text' name='nome' value='<?=$_POST["nome"]?>' size='40'/>
						&nbsp;&nbsp;&nbsp;
						<button class="ui-button ui-button-text-only ui-state-default ui-corner-all">
						<span class="ui-button-text">Pesquisar</span>
						</button>
					</td>
				</tr>
				<tr>
					<td align="center" width='10%'>
						<?php 
							$check = array(
								0 => "checked",
								1 => "",
								2 => "",
							);
							$check[$_POST['cadastro']] = "checked";
						 ?>
						<input type="radio" name="cadastro" value="0" <?php echo $check[0]; ?> /> Todos &nbsp;&nbsp;&nbsp;
						<input type="radio" name="cadastro" value="1" <?php echo $check[1]; ?> /> Com cadastro &nbsp;&nbsp;&nbsp;
						<input type="radio" name="cadastro" value="2" <?php echo $check[2]; ?> /> Sem cadastro
					</td>
				</tr>
				<tr> 
					<td height="10" colspan="2"></td> 
				</tr> 	
			</table>
		</form>
	
		<ul>
		<?php
			
			$kits = new Kits();
			$evento = new Evento();
			$evento->find_evento_aberto();
			
			if ( $_POST['cadastro'] == 0 )		{ $consulta = $kits->find_by_nome_evento( $_POST['nome'], $evento->get_codigo_evento() ); }
			elseif ( $_POST['cadastro'] == 1 )	{ $consulta = $kits->find_by_nome_wsubscription($_POST['nome'], $evento->get_codigo_evento()); }
			elseif ( $_POST['cadastro'] == 2 )	{ $consulta = $kits->find_by_nome_nosubscription($_POST['nome'], $evento->get_codigo_evento()); }

			include('kits/printlistakits.php');
			
		?>
		</ul>
	
	</div>
