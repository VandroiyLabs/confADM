<?php 
		session_start();

		// Found these statements int PHP manuals
		session_unset();
		$_SESSION = array();
		session_destroy();

		header("Location:http://sifsc.ifsc.usp.br/referee");	
		exit;
?>
