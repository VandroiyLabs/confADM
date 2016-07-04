<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.pessoa.php");
require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.inscricao.php");
require_once($home . "public_html/sifsc/user/classes/class.autor.php");
require_once($home . "public_html/sifsc/user/classes/class.arte.php");
require_once($home . "public_html/sifsc/user/classes/class.minicurso.php");
require_once($home . "public_html/sifsc/user/classes/class.avalia_poster.php");
require_once($home . "public_html/sifsc/user/classes/class.participa_premiacao.php");
require_once($home . "public_html/sifsc/user/classes/class.participa_minicurso.php");
require_once($home . "public_html/sifsc/user/classes/class.resumo.php");
require_once($home . "public_html/sifsc/user/classes/class.kits.php");
session_start();
require_once("./../user_edition_variables.php");
require_once($head_file);

require_once($home . "public_html/sifsc/user/restricted.php");
require_once($home . "public_html/sifsc/user/event/secao.php");


	include('index.php');

	$codigo_pessoa = $pessoa->get_codigo_pessoa();

	if ( !isset($_SESSION["SemInscricao"]) )
	{
		$resumo = new Resumo();
		$resumo->find_by_codigo($inscricao->get_codigo_resumo());
		$_SESSION["resumo"] = $resumo;

		$resumo_ingles = new Resumo();
		$resumo_ingles->find_by_codigo($inscricao->get_codigo_resumo_ingles());
		$_SESSION["resumo_ingles"] = $resumo_ingles;

		$participacao = new ParticipaMinicurso();
		$participacao->find_by_codigo($pessoa->get_codigo_pessoa(),$evento->get_codigo_evento());
		$_SESSION["participacao"] = $participacao;

		$minicurso = new Minicurso();
		$minicurso->find_by_codigo($participacao->get_codigo_minicurso());
		$_SESSION["minicurso"] = $minicurso;

		$arte = new Arte();
		$arte->find_by_codigo($inscricao->get_codigo_arte());
		$_SESSION["arte"] = $arte;

		$status_insc = $inscricao->get_modalidade();
	}


	$status_dic = array();
	if ( !isset($status_insc[0]) or $status_insc[0] == '0')
	{
		$status_dic['dados'] = "Ainda não preenchido.";
	}
	else
	{
		$status_dic['dados'] = "Completo.";
	}
	if ( !isset($status_insc[1]) or $status_insc[1] == '0')
	{
		$status_dic['resumo'] = 'Nada preenchido.';
	}
	else if ( $status_insc[1] == '1')
	{
		$status_dic['resumo'] = '<font color="#A00">Não submetido</font>.';
	}
	else if ( $status_insc[1] == '2')
	{
		$status_dic['resumo'] = '<font color="#D60">Submetido: em avaliação - aguarde</font>.';
	}
	else if ( $status_insc[1] == '3')
	{
		if ( strcmp( $inscricao->get_nivel(), 'Graduacao') == 0 )
		{
			$codigoresumo = "IC" . $pessoa->get_codigo_pessoa();
		}
		elseif ( strcmp( $inscricao->get_nivel(), 'Doutorado') == 0 )
		{
			$codigoresumo = "PG" . $pessoa->get_codigo_pessoa();
		}
		else
		{
			$codigoresumo = "OT" . $pessoa->get_codigo_pessoa();
		}

		$status_dic['resumo'] = '<font color="#D60">Submetido: indeferido - necessárias correções (<a href="http://sifsc.ifsc.usp.br/user/event/abstract_home.php#submissaoresumo">detalhes</a>)</font>.</span><br />
								<span class=\'status_casoduvida\'>Em caso de dúvidas nas correções, entre em contato com a <a href="http://www.biblioteca.ifsc.usp.br/" target="_blank">Biblioteca do IFSC</a> e informe a identificação de seu resumo: <b>' . $codigoresumo . '</b>.</span><span>';
	}
	else if ( $status_insc[1] == '4')
	{
		$status_dic['resumo'] = '<font color="#A00">Submetido: indeferido - não aceito (<a href="http://sifsc.ifsc.usp.br/user/event/abstract_home.php">detalhes</a>)</font>.';
	}
	else if ( $status_insc[1] == '5')
	{
		$status_dic['resumo'] = '<font color="#0A0"><span class="status_resumo">Submetido: deferido - aceito.</span>';

		$avaliaposter = new AvaliaPoster();
		$avaliaposter->find_by_codigo( $pessoa->get_codigo_pessoa(), $evento->get_codigo_evento() );
		$sessoesarray = array(
			"" => "",
			1 => " dia 01/10 (quinta-feira) às 8h",
			2 => " dia 01/10 (quinta-feira) às 10h15",
			3 => " dia 01/10 (quinta-feira) às 14h",
			4 => " dia 01/10 (quinta-feira) às 16h"
		);
		$status_dic['resumo'] .= " Sua sessão: <b><u>" . $sessoesarray[ $avaliaposter->get_secao() ] . "</u></b></font>";
	}
	if ( !isset($status_insc[3]) or $status_insc[3] == '0')
	{
		$status_dic['minicurso'] = 'Nenhuma inscrição.';
	}
	else
	{
		$status_dic['minicurso'] = 'Inscrito: <i>' .  $minicurso->get_titulo() . '</i>.';
	}
	if ( !isset($status_insc[4]) or $status_insc[4] == '0')
	{
		$status_dic['arte'] = 'Nada preenchido.';
	}
	elseif ($status_insc[4] == '1')
	{
		$status_dic['arte'] = '<font color="#A00">Não submetida</font>.';
	}
	elseif ($status_insc[4] == '2')
	{
		$status_dic['arte'] = '<font color="#D60">Submetida: em avaliação - aguarde</font>.';
	}
	elseif ($status_insc[4] == '3')
	{
		$status_dic['arte'] = '<font color="#A00">Submetida: indeferida - não aceita (<a href="http://sifsc.ifsc.usp.br/user/event/abstract_home.php">detalhes</a>)</font>.';
	}
	elseif ($status_insc[4] == '4')
	{
		$status_dic['arte'] = '<font color="#0A0">Submetida: deferida - aceita</font>.';
	}

	$kits = new Kits();
	if ( $kits->find_by_codigo_pessoa( $pessoa->get_codigo_pessoa() , $evento->get_codigo_evento()) )
	{
		$status_dic['kit'] = 'comprado, camiseta(s) ' . $kits->get_tipo_camiseta() . ', tamanho ' . $kits->get_camiseta() . '.';
	}
	else
	{
		$status_dic['kit'] = 'Sem kit.';
	}

	$participa_premio = new ParticipaPremiacao();
	if ( $participa_premio->find_by_codigo($pessoa->get_codigo_pessoa() , $evento->get_codigo_evento() ) )
	{
		$aviso_premiacao = "<li><b>Premiação:</b> <font color='#0A0'><span class='status_resumo'>convocado para
apresentação oral</span>. Data: <b>dia " . $participa_premio->get_dia() . " (quarta-feira). </b></font></li>";
	}
	else
	{
		$aviso_premiacao = "";
	}

?>

<div id="user_system">

	<div id="titulo_form_secao">
		Status da Conta
	</div>

	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
	?>

	<div id="status">

	<?php

	if ( isset($_SESSION['msg']) )
	{
		echo "	<div id=\"msg\">";
		echo "<p>" . $_SESSION['msg'] . "</p>";
		echo "	</div>";
		unset($_SESSION['msg']);
	}


	if ( isset($_SESSION["SemInscricao"]) and $_SESSION["SemInscricao"] == 1 )
	{
	?>
		<p>Seja bem vindo à sua área de usuário! Aqui você tem acesso ao material dos anos anteriores e aos seus certificados de quaisquer edições da SIFSC que você tenha participado!</p>

		<?php
		if ( $evento->get_inscricao_aberta() == 1 )
		{
			include($home . "public_html/sifsc/user/event/form/RegistroInscricao_form.php");
		}
		else
		{
			echo "<br /><p>O período de inscrições está fechado.</p>";
		}
		?>

	</div>
	<?php
	}
	else
	{
	?>
		<p>Seja bem vindo à sua área de usuário! Aqui você tem acesso ao material dos anos anteriores e aos seus certificados de quaisquer edições da SIFSC que você tenha participado!</p>
		<p>Para atualizar detalhes de sua conta (dados pessoais,
resumo, etc), navegue usando as abas laterais. Lembre-se de sempre preencher os
seus dados pessoais para poder escrever seu resumo, se inscrever em minicursos
e submeter arte. Abaixo, a situação geral de sua conta.</p>

		<ul>
			<li><b>Registrado como</b> <?php echo $pessoa->get_email(); ?> </li>
			<li><b>Dados pessoais:</b> <span class="status_dados"><?php echo $status_dic['dados']; ?></span></li>
			<li><b>Resumo:</b> <?php echo $status_dic['resumo']; ?></li>
			<?php echo $aviso_premiacao; ?>
			<li><b>Minicurso:</b> <span class="status_minicurso"><?php echo $status_dic['minicurso']; ?></span></li>
			<li><b>Obra de arte:</b> <span class="status_arte"><?php echo $status_dic['arte']; ?></span></li>
			<li><b>Kit:</b> <span class="status_kit"><?php echo $status_dic['kit']; ?></span></li>
			<li><b>Certificados:</b> <span class="status_certificados">Ainda não estão disponíveis.</span></li>
		</ul>
	</div>
	<?php
	}
	?>


</div>

<?php  require_once($foot_file);?>
