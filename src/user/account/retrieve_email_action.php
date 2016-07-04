<?php
$home = "/home/" . get_current_user() . "/";
include($home . "public_html/sifsc/user/error_handler.php");
require_once("./../classes/class.pessoa.php");
require_once("./../classes/class.conexao.php");
require_once("./../classes/class.evento.php");

$evento = new Evento();
$pessoa = new Pessoa();

require_once("../user_edition_variables.php");
require_once($head_file);

?>

<h1>Área do usuário - Recupere seu e-mail</h1>

<div id="texto">


<?php

$consulta = $pessoa->find_by_cpf($_POST["cpf"]);

$nrows = mysql_num_rows($consulta);

if ( $nrows > 0 && $evento->find_evento_aberto())
{
	if ( $nrows == 1 )
	{
		$row = mysql_fetch_object($consulta);
		echo "<p>CPF encontrado ligado ao e-mail <b>" . $row->email . "</b> - caso não se lembre da senha, clique <a href='http://sifsc.ifsc.usp.br/user/account/reset_password.php'>aqui</a>.</p>";
	}
	else
	{
		$mensagem = "<p>Seu CPF foi encontrado ligado a múltiplas contas de e-mail. Não tem nenhum problema com isso, mas seus certificados e dados estarão espalhados. A seguir, os e-mails detectados:</p><ol>";
		while ( $row = mysql_fetch_object($consulta) )
		{
			$mensagem .= "<li>" . $row->email . "</li>";
		}

		$mensagem .= "</ol><p>Caso não se lembre da senha, clique <a href='http://sifsc.ifsc.usp.br/user/account/reset_password.php'>aqui</a>.</p>";

		echo $mensagem;
	}
}
else
{
	echo "<p>CPF não encontrado em nossos sistemas. Lembre-se de digitar apenas números. Caso queira tentar novamente, <a href='http://sifsc.ifsc.usp.br/user/account/retrieve_email.php'>volte à página de recuperação de e-mail</a>.</p>";
}

echo "</div>";
require_once($foot_file);
?>
