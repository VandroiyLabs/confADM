<?php 
	require_once("./classes/class.pessoa.php");
	require_once("./classes/class.evento.php");
	require_once("./classes/class.inscricao.php");
	session_start();
	require_once("./user_edition_variables.php");
	require_once($head_file);	


	require_once("./already_logged.php");
	$evento = new Evento();
	if($evento->find_evento_aberto())
{
?>
	  
	<h1>Inscrições na <?php echo $evento->get_nome(); ?></h1>
	
	<div id="texto">
		
		<h2>Área do usuário</h2>
		
		<br />
		<div id="login_">
		
			<?php
			if ( isset($_GET['error']) and $_GET['error'] == 1 )
			{ ?>
			<div id="aviso">
				<p>Esta é uma página restrita. Para ter acesso, identifique-se abaixo.</p>
			</div>
			<?php } 
	
			if ( isset($_GET['error']) and $_GET['error'] == 2 )
			{ ?>
			<div id="aviso">
				<p>E-mail ou password fornecidos não existem ou não coincidem.</p>
			</div>
			<?php } 
			
			if ( isset($_GET['error']) and $_GET['error'] == 21 )
			{ ?>
			<div id="aviso">
				<p>Aguarde a abertura das inscrições.</p>
			</div>
			<?php }
	
			if ( isset($_GET['error']) and $_GET['error'] == 25 )
			{ ?>
			<div id="aviso">
				<p>Entre no link fornecido em seu e-mail primeiramente.</p>
			</div>
			<?php } 

			if ( isset($_GET['alert']) and $_GET['alert'] == 4 )
			{ ?>
			<div id="msg2">
				<p>Acesse seu e-mail para ativar sua conta (verifique a caixa de Spams!)</p>
			</div>
			<?php }

			if ( isset($_GET['alert']) and $_GET['alert'] == 5 )
			{ ?>
			<div id="msg2">
				<p>Conta ativada e pronta pra uso (log novamente)</p>
			</div>
			<?php }
			
	
			if ( isset($_GET['alert']) and $_GET['alert'] == 3 )
			{ ?>
			<div id="aviso">
				<p>Ocorreu um erro. Entre em contato com a organização!</p>
			</div>
			<?php }
	
			if ( isset($_GET['out']) and $_GET['out'] == 1 )
			{ ?>
			<div id="msg">
				<p>Senha nova enviada para seu e-mail!</p>
			</div>
			<?php }
	
			if ( isset($_GET['error']) and $_GET['error'] == 7 )
			{ ?>
			<div id="aviso">
				<p>E-mail ainda não cadastrado!</p>
			</div>
			<?php }
			
			if ( isset($_GET['error']) and $_GET['error'] == 6 )
			{ ?>
			<div id="aviso">
				<p>Um erro ocorreu, por favor entre em contato com a organização.</p>
			</div>
			<?php } ?>
			
			<?php 
	
			if ( isset($_GET['token']) )
			{
				$inscricao = new Inscricao();
				
				if ( $inscricao->find_by_token($_GET['token']) )
				{
					echo "		<div id=\"msg\">";
					echo "			<p>Sua conta foi ativada!</p>";
					echo "		</div>";
					
					$pessoa = new Pessoa();
					
					if ( $pessoa->find_by_codigo( $inscricao->get_codigo_pessoa() ) )
					{
						$uservalue = $pessoa->get_email();
						$inscricao->set_token("ativado");

						if($evento->get_inscricao_aberta() == 1 )
						{
							$inscricao->update();

						}
						else
						{
							echo "<script>location=(\"http://sifsc.ifsc.usp.br/user/login.php?error=21\")</script>";
						}
					}
				}
				else
				{
					echo "		<div id=\"aviso\">";
					echo "			<p>Erro, entre em contato com a organização!</p>";
					echo "		</div>";
					echo "<p>Talvez você já tenha ativado sua conta. Se este for o caso, basta identificar-se abaixo.</p>";
				}
			}
			else
			{
				$uservalue = "";
			}
			?>
			
			<p>Já teve conta nas edições passadas e não lembra do e-mail? <a href="http://sifsc.ifsc.usp.br/user/account/retrieve_email.php">Recupere aqui usando seu CPF!</a></p>
			<form method="post" action="http://sifsc.ifsc.usp.br/user/logconfig/login.php" name="login_form" class="boxed">
				<fieldset>
					<table>
						<tr>
							<td width="50px">Email</td>
							<td width="200px" class="input"><input type="text" name="email" id="input_email" value="<?php echo $uservalue; ?>" class="textfield" size="27"/></td>
						</tr>
						<tr>
							<td><div id="field">Senha</td>
							<td class="input"><input type="password" name="senha" id="input_senha" maxlength="8" value="" class="textfield" size="27" /></td>
						</tr>
						<tr>
							<td colspan = 2><div id="links"><input type="submit" value="Entrar" /></div></td>
						</tr>
						<tr>					
							<td colspan = 2><div id="links"><a href="http://sifsc.ifsc.usp.br/user/account/reset_password.php" >Esqueceu sua senha?</a></div></td>
						</tr>
						<?php 
						if($evento->get_inscricao_aberta() == 1 )
						{
						?>
						<tr>					
							<td colspan = 2><div id="links"><a href="http://sifsc.ifsc.usp.br/user/account/account.php" >Criar uma conta</a></div></td>
						</tr>
					<?php } ?>
					</table>
						<!-- <font style="cursor: pointer; text-decoration: underline;" onClick="window.open('pg_mail.php', 'nph_window', 'width=403,height=250,toolbar=no,menubar=no,status=no,scrollbars=yes,resizable=no')"></font> -->
				</fieldset>
			</form>
		  </div>  

	</div>
	  
<?php
}
else //Nenhum evento aberto
{
	$evento->find_last_evento();
?>

	<h1>Inscrições na <?php echo $evento->get_nome(); ?></h1>
	
	<div id="texto">
	
		<h2>Área do usuário</h2>
		
		<p>Inscrições fechadas</p>

	</div>

<?php
}

require_once($foot_file);?>	
