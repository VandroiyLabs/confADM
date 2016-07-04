<?php 
	require_once("./../classes/class.pessoa.php");
	require_once("./../classes/class.evento.php");
	require_once("./../classes/class.inscricao.php");

	session_start();
	require_once("./../user_edition_variables.php");
	require_once($head_file);
 	


	require_once("./../already_logged.php");
	$evento = new Evento();

?>
	  
<script type="text/javascript" language="javascript" src="account_script.js" ></script>

	<h1>Área do usuário - Cadastre-se site</h1>

	<div id="texto">
		<?php 
		
		if( $evento->find_evento_aberto() == 1 and $evento->get_inscricao_aberta() == 1 )
		{ ?>	
		<p>Para iniciar sua inscrição na <? echo $evento->get_nome(); ?>, forneça e-mail e senha. Em seguida, <b>enviaremos um e-mail para que você confirme sua inscrição e para que você tenha acesso ao sistema da <? echo $evento->get_nome(); ?></b>. Fique tranquilo, sua senha será armazenada de forma segura e nenhum humano terá contato direto com ela.</p>
		<br />
		
		<div id="login_">
			<form method="post" action="http://sifsc.ifsc.usp.br/user/account/account_action.php" name="formulario"  class="boxed">
			
				<?php include('account_form.php'); ?>	
			
			</form>
		</div>
		<?php 
		}
		else{ ?>	
			<p>Inscrições fechadas.</p>

		<?php } ?>	
	</div>
	 
	  
<?php 	require_once($foot_file);?>	
