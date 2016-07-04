<?php
		session_start();
		require_once("./../user_edition_variables.php");
	
		session_unset();
		$_SESSION = array();
		session_destroy();

		header("Location:".$baseurl);
		exit;
?>
