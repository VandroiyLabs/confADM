<?php
$home = "/home/" . get_current_user() . "/";


// Esta página pede para confirmar se o usuário
// realmente quer deletar seu resumo em inglês

require_once('../classes/class.pessoa.php');
require_once('../classes/class.evento.php');
require_once('../classes/class.inscricao.php');
require_once('../classes/class.resumo.php');
require_once('../classes/class.conexao.php');
require_once('../classes/class.autor.php');

session_start();

include('./secao.php');

$page = $_POST["page"];


if ( $inscricao->get_codigo_resumo_ingles() != 0 )
{

	// Garatinr que passou por aqui!
	$_SESSION['abstract_dropenglish_question'] = 1;

	require_once("./../user_edition_variables.php");
	require_once($head_file);
	include($home . 'public_html/sifsc/user/event/index.php');
	?>


	<div id="user_system">

		<div id="titulo_form_secao">
			Submissão de resumo
		</div>

	<?php
		if(($inscricao->get_situacao_resumo() == 1  and $evento->get_inscricao_aberta()== 1) or ($inscricao->get_situacao_resumo() == 3 and $evento->get_resubmissao_aberta()== 1))
		{
	?>
		<div id="status">

			<p>Tem certeza de que deseja realmente excluir a versão em inglês de seu resumo? Esta ação é irreversível (esta versão não poderá mais ser recuperada), no entanto você poderá escrever uma nova versão em inglês de seu resumo. A versão em português de seu resumo ficará intacta, e, caso você submeta seu resumo, apenas a versão em português será considerada pela organização do evento. Apenas seu resumo em inglês será descartado</p>

			<p><i><b>Tem certeza que deseja descartar a versão em inglês?</b></i></p>

			<p><a class="submeter_chamativo" href="http://sifsc.ifsc.usp.br/user/event/action/abstract_dropenglish_action.php">Sim, quero descartar meu resumo em inglês</a></p>
		</div>

	<?php
		}
		else
		{
	?>
		<p>Inscrições encerradas.</p>
	<?php
		}
	?>

	</div>


	<?php
	require_once($foot_file);
}
else
{
	echo "<script language=\"javascript\">location=(\"../abstract_home.php#submissaoresumo\");</script>";
}

?>
