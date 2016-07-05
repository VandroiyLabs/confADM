
<div id="content">
<div class="post">
<div class="content">

<?php

	if(!isset($_REQUEST["opcao"])) $opcao = "dados_pessoais";
	else $opcao = $_REQUEST["opcao"];
$aberto = 1; $status="";

	if($_REQUEST["opcao"] == 'new' )
	{
		unset($_SESSION["pessoa"]);
		unset($_SESSION["evento"]);
		unset($_SESSION["arte"]);
		unset($_SESSION["inscricao"]);
		unset($_SESSION["participacao"]);
	}

	if ( !isset($_GET["CP"]) )
	{
		if( !isset($_SESSION["evento"])){
			$evento = new Evento();

			// Verifica se o evento está aberto
			if($evento->find_evento_aberto())
			{
				$_SESSION["evento"] = $evento;
			}
			else{
				$aberto = 0; $status=disabled;
			}
		}
		else{
			$evento = $_SESSION["evento"];
		}

		if(!isset($_SESSION["pessoa"]))
		{
			$pessoa = new Pessoa();
		}
		else
		{
			$pessoa = $_SESSION["pessoa"];

		}

		if( !isset($_SESSION["inscricao"])){
			$inscricao = new Inscricao();
			$inscricao->find_by_pessoa_evento($pessoa->get_codigo_pessoa(), $evento->get_codigo_evento());
			$_SESSION["inscricao"] = $inscricao;
		}
		else{
			$inscricao = $_SESSION["inscricao"];
		}

		$participacao = new ParticipaMinicurso();
		$minicurso = new Minicurso();
		if($participacao->find_by_codigo($pessoa->get_codigo_pessoa(),$evento->get_codigo_evento()))
		{
			$minicurso_checked='checked'; $minicurso_nochecked='';

		}
		else{
			$minicurso_checked=''; $minicurso_nochecked='checked';
		}
		$_SESSION["participacao"] = $participacao;

		$arte = new Arte();
		if($arte->find_by_codigo($inscricao->get_codigo_arte()))
		{
			$arte_checked='checked'; $arte_nochecked='';

		}
		else{
			$arte_checked=''; $arte_nochecked='checked';
		}
		$_SESSION["arte"] = $arte;

	}
	else
	{
		$pessoa = new Pessoa();
		$inscricao = new Inscricao();
		$minicurso = new Minicurso();
		$participacao = new ParticipaMinicurso();
		$evento = new Evento();
		$evento->find_evento_aberto();
		$aberto = $evento->get_aberto();
		$arte = new Arte();
		$arte_checked=''; $arte_nochecked='checked';
		$minicurso_checked='';$minicurso_nochecked='checked';

		$pessoa->find_by_codigo($_REQUEST["CP"]);
		$_SESSION["pessoa"] = $pessoa;
		$_SESSION["codigo_pessoa"] = $_REQUEST["CP"];

		$inscricao->find_by_pessoa_evento($pessoa->get_codigo_pessoa(),$evento->get_codigo_evento());
		$_SESSION["inscricao"]=$inscricao;

		if($participacao->find_by_codigo($pessoa->get_codigo_pessoa(),$evento->get_codigo_evento()))
		{
			$minicurso_checked='checked'; $minicurso_nochecked='';

		}
		$_SESSION["participacao"]=$participacao;

		if($arte->find_by_codigo($inscricao->get_codigo_arte()))
		{
			$arte_checked='checked'; $arte_nochecked='';

		}
		$_SESSION["arte"]=$arte;

	}


	require_once('./../../user/classes/class.EmEdicao.php');

	$editando = new EmEdicao();
	if ( $editando->find_by_pessoa($_SESSION["codigo_pessoa"]) and strcmp($editando->get_adm_usuario(), $adm->get_usuario()) != 0 )
	{
		echo "<div id='annoyingwarning'>Sendo editado no momento por " . $editando->get_adm_usuario() . "</div>";
	}
	else
	{
		$editando = new EmEdicao();
		$editando->set_codigo_pessoa($_SESSION["codigo_pessoa"]);
		$editando->set_adm_usuario( $adm->get_usuario() );
		$editando->insert();
	}



	$resumo = new Resumo();
	$resumo->find_by_codigo($inscricao->get_codigo_resumo());
	$_SESSION['resumo'] = $resumo;

?>

	<div id="barrasuperior">
		<ul>

			<li <?php if($opcao == "dados_pessoais") echo "class='active'"; ?>>
				<a href='home.php?p1=incluir&opcao=dados_pessoais' title=''>Dados Pessoais</a>
			</li>

			<li <?php if($opcao == "resumo" || $opcao == "abstract") echo "class='active'"; ?>>
				<a href='home.php?p1=incluir&opcao=resumo' title=''>Resumo</a>
			</li>

			<li <?php if($opcao == "minicurso") echo "class='active'"; ?>>
				<a href='home.php?p1=incluir&opcao=minicurso' title=''>Minicurso</a>
			</li>

			<li <?php if($opcao == "arte") echo "class='active'"; ?>>
				<a href='home.php?p1=incluir&opcao=arte' title=''>Arte</a>
			</li>

			<li <?php if($opcao == "status") echo "class='active'"; ?>>
				<a href='home.php?p1=incluir&opcao=status' title=''>Status</a>
			</li>

			<li <?php if($opcao == "status") echo "class='active'"; ?>>
				<a href='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp=<?php echo $pessoa->get_codigo_pessoa(); ?>' title=''>Voltar à conta</a>
			</li>
		</ul>

	</div>

	<table border='0' width='100%'  >
	<tr><td  align="center">
	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
	?>
	 </td></tr>
	</table>

<?php
		if(!isset($_REQUEST["opcao"]))
		{
			include('inscricao/registration.php');
		}
		elseif($opcao == 'new')
		{
			include('inscricao/account.php');
		}
		elseif($opcao == 'dados_pessoais')
		{
			include('inscricao/registration.php');
		}
		elseif($opcao == 'resumo')
		{
			include('inscricao/abstract_home.php');
		}
		elseif($opcao == 'abstract')
		{
			include('inscricao/abstract.php');
		}
		elseif($opcao == 'minicurso')
		{
			include('inscricao/minicurso.php');
		}
		elseif($opcao == 'arte')
		{
			include('inscricao/arte.php');
		}
		elseif($opcao == 'status')
		{
			include('inscricao/status.php');
		}

?>

	</div>
</div>

</div>
