<?php 
	
	if( isset($_SESSION["adm_usuario"]) )
	{
		echo "<script language=\"javascript\">" .
		"location=(\"http://sifsc.ifsc.usp.br/adm\");" .
		"</script>";
		exit();
		
	}
	
	elseif( isset($_SESSION["codigo_pessoa"]) )
	{
		echo "<script language=\"javascript\">" .
		"location=(\"http://sifsc.ifsc.usp.br/user/event/status.php\");" .
		"</script>";
		
	};
?>
