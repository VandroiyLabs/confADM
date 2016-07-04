<?php 
	session_start();
	require_once("./user_edition_variables.php");
	require_once($head_file);
	$contato_url = $baseurl."contato.php";
	

	
?>
	
	<div id="texto">
				
		<h2>Ocorreu um erro interno</h2>
		
		<p>Caro usuário, ocorreu algum erro interno em nosso sistema. 
		Para agilizar a solução, nossa equipe já foi informada sobre detalhes deste erro!</p>
		<p>É bastante provável que este erro tenha acontecido por um volume momentaneo de acessos, por isso tente acessar de o sistema.</p>
		<br />
		<p>Caso queira entrar em contato com a comissão ou <b>contribuir com detalhes sobre como o erro ocorreu</b>, clique <a href="<?php echo $contato_url; ?>">aqui</a>. Pedimos desculpas pelo incoveniente!</p>
		
	</div>
	  
<?php require_once($foot_file);?>	
