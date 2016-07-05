<?php
$home = "/home/" . get_current_user() . "/";
include($home . 'public_html/sifsc/adm/error_handler.php');
require_once('./../../../user/classes/class.avaliador.php');
require_once('./../../../user/classes/class.avaliacao.php');
require_once('./../../../user/classes/class.avalia_poster.php');
require_once('./../../../user/classes/class.inscricao.php');
require_once('./../../../user/classes/class.nota_resumo.php');
require_once('./../../../user/classes/class.evento.php');
require_once('./../../../user/classes/class.administrador.php');
require_once('./../../../user/classes/class.log.php');

session_start();

/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
require_once($home . "public_html/sifsc/adm/restricted.php");


if(isset($_POST["pessoa"]) and isset($_POST["evento"]) and isset($_POST["old_avaliador1"]) and isset($_POST["old_avaliador2"]) and (isset($_POST["avaliador1"]) or isset($_POST["avaliador2"])))
{

	//Buscando a inscricao
	$inscricao = new Inscricao();
	$inscricao->find_by_pessoa_evento($_POST["pessoa"],$_POST["evento"]);

	$avalia_poster = new AvaliaPoster();
	$avaliador_novo = new Avaliador();
	$avaliacao = new Avaliacao();
	$avalia_poster->find_by_codigo($_POST["pessoa"],$_POST["evento"]);
	$ok=0;

	if($_POST["avaliador1"] == $_POST["avaliador2"]  and $_POST["avaliador2"] != 0)
	{
		$_SESSION['msg'] = "Avaliadores devem ser diferentes.";
		echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_poster\");</script>";
		exit();
	}

	if($_POST["secao"] != $_POST["old_secao"])
	{
		if($_POST["secao"] == 0)
		{

			$avalia_poster->set_codigo_avaliador1(0);
			$avalia_poster->set_codigo_avaliador2(0);
			$avalia_poster->set_secao(0);



		}
		else
		{
			$avalia_poster->find_by_codigo($_POST["pessoa"],$_POST["evento"]);
			if(!$avaliacao->find($_POST["avaliador1"], $_POST["secao"], $_POST["evento"]))
			{
				$avalia_poster->set_codigo_avaliador1(0);
			}
			if(!$avaliacao->find($_POST["avaliador2"], $_POST["secao"], $_POST["evento"]))
			{
				$avalia_poster->set_codigo_avaliador2(0);
			}

			$avalia_poster->set_secao($_POST["secao"]);


		}

		if($avalia_poster->update())
		{

			$log = new Log();
			$log->set_adm_usuario( $adm->get_usuario() );
			$log->set_codigo_evento( $_POST["evento"] );
			$log->set_operacao('Edicao da secao de avaliação de poster');
			$log->set_detalhes('Modificado de ' . $_POST["old_secao"] . ' para ' . $_POST['secao']  . ' do participante ' . $_POST["pessoa"]);
			$log->insert();

			$_SESSION['msg'] = "Seção atualizada com sucesso.";
		}
		else
		{
			$ok=1;
		}
	}


	if($_POST["avaliador1"] != $_POST["old_avaliador1"])
	{

		$avalia_poster->set_codigo_avaliador1($_POST["avaliador1"]);

		if($avalia_poster->update())
		{

			$log = new Log();
			$log->set_adm_usuario( $adm->get_usuario() );
			$log->set_codigo_evento( $_POST["evento"] );
			$log->set_operacao('Edicao do avaliador1 de avaliação de poster');
			$log->set_detalhes('Modificado de ' . $_POST["old_avaliador1"] . ' para ' . $_POST['avaliador1']  . ' do participante ' . $_POST["pessoa"]);
			$log->insert();

			$_SESSION['msg'] = "Avaliador1 atualizado com sucesso.";
		}
		else
		{
			$ok=1;
		}
	}

	if($_POST["avaliador2"] != $_POST["old_avaliador2"])
	{

		$avalia_poster->set_codigo_avaliador2($_POST["avaliador2"]);

		if($avalia_poster->update())
		{

			$log = new Log();
			$log->set_adm_usuario( $adm->get_usuario() );
			$log->set_codigo_evento( $_POST["evento"] );
			$log->set_operacao('Edicao do avaliador2 de avaliação de poster');
			$log->set_detalhes('Modificado de ' . $_POST["old_avaliador2"] . ' para ' . $_POST['avaliador2']  . ' do participante ' . $_POST["pessoa"]);
			$log->insert();

			$_SESSION['msg'] = "Avaliador2 atualizado com sucesso.";
		}
		else
		{
			$ok=1;
		}
	}

	if($ok == 0)
	{

		echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_poster\");</script>";
		exit();
	}
	else
	{
		$_SESSION['msg'] = "Erro inesperado. Por favor, contacte a comissão organizadora.";
		echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_poster\");</script>";
		exit();
	}
}

echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_poster\");</script>";
exit();

?>
