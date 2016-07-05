<?php
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
		$status_dic['resumo'] = 'Ainda não preenchido.';
	}
	else if ( $status_insc[1] == '1')
	{
		$status_dic['resumo'] = 'Resumo cadastrado, ainda não submetido.';
	}
	else if ( $status_insc[1] == '2')
	{
		$status_dic['resumo'] = 'Resumo submetido, aguardando deferimento da organização.';
	}
	else if ( $status_insc[1] == '3')
	{
		$status_dic['resumo'] = '<b>Problemas no deferimento, veja razões na seção <a href="http://sifsc.ifsc.usp.br/user/event/abstract_home.php">RESUMO</a>.</b>';
	}
	else if ( $status_insc[1] == '4')
	{
		$status_dic['resumo'] = 'Resumo não deferido, veja razões na seção <a href="http://sifsc.ifsc.usp.br/user/event/abstract_home.php">RESUMO</a>.';
	}
	else if ( $status_insc[1] == '5')
	{
		$status_dic['resumo'] = 'Resumo deferido pela organização.';
	}
	if ( !isset($status_insc[3]) or $status_insc[3] == '0')
	{
		$status_dic['minicurso'] = 'Não está inscrito em nenhum minicurso.';
	}
	else
	{
		$status_dic['minicurso'] = 'Inscrito no minicurso ' .  $minicurso->get_titulo() . '.';
	}
	if ( !isset($status_insc[4]) or $status_insc[4] == '0')
	{
		$status_dic['arte'] = 'Nenhuma obra cadastrada.';
	}
	elseif ($status_insc[4] == '1')
	{
		$status_dic['arte'] = 'Você tem uma obra de arte (' . $arte->get_tipo() . ') cadastrada de título "' . $arte->get_titulo() . '".';
	}
	elseif ($status_insc[4] == '2')
	{
		$status_dic['arte'] = 'Você tem uma obra de arte (' . $arte->get_tipo() . ') submetida de título "' . $arte->get_titulo() . '".';
	}
	elseif ($status_insc[4] == '3')
	{
		$status_dic['arte'] = 'Sua obra de arte não foi aceita.';
	}
	elseif ($status_insc[4] == '4')
	{
		$status_dic['arte'] = 'Sua obra de arte foi aceita.';
	}
	
	
?>

	<div id="status">
		
		<p>Seja bem vindo à sua área de usuário. Para atualizar detalhes de sua conta (dados pessoais, resumo, etc), navegue usando as abas laterais. Abaixo, a situação geral de sua conta.</p>
		
		<ul>
			<li><b>Registrado como</b> <?php echo $pessoa->get_email(); ?> </li>
			<li><b>Dados pessoais:</b> <?php echo $status_dic['dados']; ?></li>
			<li><b>Resumo:</b> <?php echo $status_dic['resumo']; ?></li>
			<li><b>Minicurso:</b> <?php echo $status_dic['minicurso']; ?></li>
			<li><b>Obra de arte:</b> <?php echo $status_dic['arte']; ?></li>
			<li><b>Certificados:</b> Ainda não estão disponíveis.</li>
		</ul>
	</div>
