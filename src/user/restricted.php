<?php 
	
	if( !isset($_SESSION["codigo_pessoa"]) )
	{
		echo "<script language=\"javascript\">" . 
				"location=(\"http://sifsc.ifsc.usp.br/user/login.php?error=1\");" . 
				"</script>";
		
		// Finaliza o script de forma forçada.
		exit();
	};
?>
