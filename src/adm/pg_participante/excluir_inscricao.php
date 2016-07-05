<?php

	require_once('../classes/class.administrador.php');
	require_once('../classes/class.inscricao.php');
	require_once('../classes/class.evento.php');
	require_once('../classes/class.pessoa.php');

	session_start();

	$home = "/home/" . get_current_user() . "/";
	require_once($home . 'public_html/sifsc/adm/secao.php');
	include($home . "public_html/sifsc/adm/restricted.php");


	if( !isset($_SESSION["pessoa"])){
		$pessoa = new Pessoa();
		$pessoa->find_by_codigo($_GET["codigo_pessoa"]);
		$_SESSION["pessoa"] = $pessoa;
	}
	else{
		$pessoa = $_SESSION["pessoa"];
	}

	$evento = new Evento();
	if( isset($_GET["codigo_evento"])){
		$evento->find_by_codigo($_GET["codigo_evento"]);
		$_SESSION["evento"] = $evento;
	}

	$inscricao = new Inscricao();
	if($inscricao->find_by_pessoa_evento($pessoa->get_codigo_pessoa(), $evento->get_codigo_evento())){
		$_SESSION["inscricao"] = $inscricao;
	}

?>

<div id='content'>
<div class='post'>
	<div class='content'>
	<div id='menu' >
			<ul><li class='excluir'><a href='#' title=''><center>Excluir Inscrição</center></a></li></ul>
	</div>
	<table>
		<tr>
			<td height='10' colspan='2'></td>
		</tr>
	</table>


	<div id='menu' >
	<table border='0' width='100%' cellspacing="0" >
	<tr align='center' valign='center' height='30'>
		<td width='190px' >
			<ul><li class='page'><a href='home.php?page=alterar&step=0' title=''>Dados do Participante</a></li></ul>
		</td>
		<td width='5px' bgcolor='#ffffff'></td>
		<td width='190px' bgcolor='#e9e9e9' >
			<ul><li class='page'><a href='home.php?page=alterar&step=1' title=''>Participação em Eventos </a></li></ul>
		</td>
		<?php
			$nome_evento = $evento->get_nome();
			echo "
				<td width='5px' bgcolor='#ffffff'></td>
				<td width='190px' bgcolor='#e9e9e9' class='active'>
					<ul><li class='page'><a href='#' title=''> $nome_evento</a></li></ul>
				</td>
			";
		?>
	</tr>
	</table>
	</div>

	<table>
		<tr>
			<td height='10' colspan='2'></td>
		</tr>
	</table>

	<?php
		echo "<form method='POST' name='formulario' action='action/participante_action.php'>";
		include("form/summer_form.php");
		include("form/resumo_form.php");
		include("form/viagem_form.php");
		include("form/pagamento_form.php");
		echo "<input type='hidden' name='page' value='remove_inscricao'/>";
	?>

	<table>
		<tr>
			<td height='12' colspan='2'></td>
		</tr>
	</table>

	<table border="0" width="100%" >
		<tr>
			<td align="right" colspan="2">
				<input type="submit" value=" Excluir " class="button_excluir">
			</td>
		</tr>
	</table>
	</form>

	</div>
</div>

</div>
