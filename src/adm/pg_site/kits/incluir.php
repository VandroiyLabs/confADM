	<div id="vendakits">
	
	<?php
	
	$pessoa = new Pessoa();
	if ( isset($_GET['cp']) and $pessoa->find_by_codigo($_GET['cp']))
	{
		$nome = $pessoa->get_nome();
		$email = $pessoa->get_email();
		$cp = $pessoa->get_codigo_pessoa();
	}
	else
	{
		$nome = "";
		$nome = "";
		$cp = "";
	}
	
	?>
	
	<p>Não use diretamente este formulário caso a pessoa que vai comprar o kit tenha (ou possa vir a ter) uma conta no sistema, caso contrário o kit não será ligado à pessoa.</p>
	
	<form method="post" action="kits/action/incluir_action.php">	
		<table width="70%">
			<tr>
				<td height='20' align="right" width='100'>Nome: </td>
				<td width='200'><input type="text" name="nome" size="30" value="<?php echo htmlspecialchars($nome, ENT_QUOTES);?>" /></td>
			</tr>
			<tr>
				<td height='20' align="right" width='100'>Email: </td>
				<td width='200'><input type="text" name="email" size="30" value="<?php echo $email;?>" /></td>
			</tr>
			<tr>
				<td height='20' align="right" width='100'>Camiseta:</td>
				<td width='200'>
					<select name="camiseta">
						<option value="BLP">BLPP</option>
						<option value="BLP">BLP</option>
						<option value="BLM">BLM</option>
						<option value="BLG">BLG</option>
						<option value="BLGG">BLGG</option>
						<option value="P">PP</option>
						<option value="P">P</option>
						<option value="M">M</option>
						<option value="G">G</option>
						<option value="GG">GG</option>
						<option value="EG">EG</option>
						<option value="EGG">EGG</option>
					</select>
				</td>
			</tr>
			<tr>
				<td height='20' align="right" width='100'>Tipo da camiseta:</td>
				<td width='200'>
					<select name="tipo_camiseta">
						<option value="azul">azul</option>
						<option value="cinza">cinza</option>
						<option value="azul e cinza">azul e cinza</option>
						
					</select>
				</td>
			</tr>
			<tr>
				<td colspan='2' align='right'>
					<input type="hidden" name="cp" value="<?php echo $cp;?>" />
					<input type="submit" value=" Incluir " class="button">
				</td>
			</tr>
		</table>
	</form>
	
	</div>
