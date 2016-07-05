<?php
require_once('./../user/classes/class.administrador.php');
require_once('./../user/classes/class.inscricao.php');
require_once('./../user/classes/class.evento.php');
require_once('./../user/classes/class.pessoa.php');
require_once('./../user/classes/class.minicurso.php');
require_once('./../user/classes/class.participa_minicurso.php');
require_once('./../user/classes/class.arte.php');
require_once('./../user/classes/class.resumo.php');
require_once('./../user/classes/class.autor.php');

session_start();

$adm = new Administrador();

?>

<?php include('header.php'); ?>

<div id="content">

	<div id="welcome" class="post">

		<div class="content">
			<h2>Ocorreu um erro interno</h2>

			<p>Caro usuário, ocorreu algum erro interno em nosso sistema.
			<b>Para agilizar a solução, nós já estamos sabendo sobre detalhes deste erro!</b></p>
			<p>É bastante provável que este erro tenha acontecido por um volume momentaneo de acessos, por isso tente acessar de o sistema.</p>
			<br />
			<p>Caso queira o problema persista, entre em contato. Pedimos desculpas pelo incoveniente!</p>
		</div>

	</div>


</div>

<?php

include('footer.php');
?>
