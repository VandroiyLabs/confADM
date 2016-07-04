<?php 
	
	if( !isset($_SESSION["avaliador"]) )
	{
		echo "<script language=\"javascript\">" . 
				"location=(\"http://sifsc.ifsc.usp.br/referee/login.php?error=1\");" . 
				"</script>";
		
		// Finaliza o script de forma forçada.
		exit();
	};
?>
