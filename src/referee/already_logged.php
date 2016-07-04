<?php 
	
	if( isset($_SESSION["adm"]) )
	{
		echo "<script language=\"javascript\">" .
		"location=(\"http://sifsc.ifsc.usp.br/adm\");" .
		"</script>";
		exit();
		
	}
	
	elseif( isset($_SESSION["avaliador"]) )
	{
		echo "<script language=\"javascript\">" .
		"location=(\"http://sifsc.ifsc.usp.br/referee/event/status.php\");" .
		"</script>";
		
	};
?>
