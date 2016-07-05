<?php
  session_start();
  require_once('already_logged.php');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title>Adm-WEB v.4</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<div id="pre_header">

	<div id="header">
	</div>

    <div id="pre_header2">
		<div id="header2">
			<h3 align="right"><?php echo "<b>".date("l")."</b>, ".date("F")." ".date("d")." of ".date("Y"); ?></h3>
		</div>
	</div>
</div>

<div id="page">


<div id="content">

	<div id="welcome" class="post">

		<div class="content">
		<table cellspacing='10'>
			<tr>

			</tr>
		</table>
		</div>

	</div>


</div>

<div id="sidebar">

	<div id="login" class="boxed">
		<h2 class="title">Account</h2>
		<div class="content">
			<form method="post" action="logconfig/login.php" name="login_form" target="_top" class="login">
				<fieldset>
				<legend>Sign-In</legend>

					<label for="input_email">User:</label><br>
					<input type="text" name="usuario" id="input_email" value="" class="textfield"/>

					<label for="input_senha">Password:</label><br>
					<input type="password" name="senha" id="input_senha" value="" class="textfield" size="100"/>

					<p>
					<input type="submit" value=" Login " class="button">
					</p>
				</fieldset>
			</form>
		</div>
	</div>

</div>

</div>

	<div id="footer">
		<p id="legal"> | C - Developed by VANDROIY LABS (2012).</p>
	</div>

</body>
</html>
