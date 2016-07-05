<?php
$home = "/home/" . get_current_user() . "/";
include($home . 'public_html/sifsc/adm/error_handler.php');
require_once('./../../../user/classes/class.avaliador.php');
require_once('./../../../user/classes/class.avaliacao.php');
require_once('./../../../user/classes/class.avalia_resumo.php');
require_once('./../../../user/classes/class.inscricao.php');
require_once('./../../../user/classes/class.nota_resumo.php');
require_once('./../../../user/classes/class.evento.php');
require_once('./../../../user/classes/class.administrador.php');
require_once('./../../../user/classes/class.log.php');

session_start();

/* Loading section variables */
require_once($home . 'public_html/sifsc/adm/secao.php');
require_once($home . "public_html/sifsc/adm/restricted.php");



if(isset($_POST["cp"]) and isset($_POST["ce"]) and isset($_POST["ca1"]) and isset($_POST["ca2"]) and (isset($_POST["avaliador1"]) or isset($_POST["avaliador2"])))
{

	//Buscando a inscricao
	$inscricao = new Inscricao();
	$inscricao->find_by_pessoa_evento($_POST["cp"],$_POST["ce"]);

	$avalia_resumo = new AvaliaResumo();
	$nota_resumo = new NotaResumo();
	$avaliador_novo = new Avaliador();



	if( $_POST["avaliador1"] == $_POST["avaliador2"] or ($_POST["avaliador1"] == $_POST["ca2"] and $_POST["avaliador2"] == $_POST["ca1"])  or ($_POST["avaliador1"]== null and $_POST["avaliador2"] == $_POST["ca1"] ) or ($_POST["avaliador2"]== null and $_POST["avaliador1"] == $_POST["ca2"] ))
	{
		$_SESSION['msg'] = "Os avaliadores devem ser diferentes.";
		echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_resumo\");</script>";
		exit();
	}
	$ok=0;

	$altera1=1;

	if($_POST["ca1"] != 0)
	{
		$nota_resumo->find_by_codigo($_POST["ca1"], $_POST["cp"],$_POST["ce"]);
		if($nota_resumo->get_situacao() == 1 or $nota_resumo->get_situacao() == 2)
		$altera1=0;
	}

	if($_POST["avaliador1"] != $_POST["ca1"] and isset($_POST["avaliador1"]) and $altera1 == 1)//Alterando o avaliador 1
	{

		$avaliador_novo->find_by_codigo_avaliador($_POST["avaliador1"]);

		//Verificando se o avaliador é o orientador
		if($avaliador_novo->get_nome() != $inscricao->get_orientador())
		{
			//Atualizando o novo avaliador1
			$avalia_resumo->find_by_codigo($_POST["cp"],$_POST["ce"]);
			$avalia_resumo->set_codigo_avaliador1($_POST["avaliador1"]);

			if($avalia_resumo->update())
			{

				$log = new Log();
				$log->set_adm_usuario( $adm->get_usuario() );
				$log->set_codigo_evento( $_POST["ce"] );
				$log->set_operacao( 'Edicao avaliador1 na mao' );
				$log->set_detalhes( 'Modificado de ' . $_POST["ca1"] . ' para ' . $_POST['avaliador1']  . ' do participante ' . $_POST["cp"] );

				$log->insert();

				//Se não tinha avaliador, insere um registro na tabela nota_resumo
				if($_POST["ca1"] != 0)
				{
					if($nota_resumo->find_by_codigo($_POST["ca1"], $_POST["cp"],$_POST["ce"]))
					{

					}
					else
					{
						$ok=1;
					}


					if($nota_resumo->remove())
					{

					}
					else
					{
						$ok=1;
					}

				}

				if($_POST["avaliador1"] != 0)
				{
					$nota_resumo->set_codigo_pessoa($_POST["cp"]);
					$nota_resumo->set_codigo_evento($_POST["ce"]);
					$nota_resumo->set_codigo_avaliador($_POST["avaliador1"]);
					$nota_resumo->set_Q1(0.0);
					$nota_resumo->set_Q2(0.0);
					$nota_resumo->set_Q3(0.0);
					$nota_resumo->set_Q4(0.0);
					$nota_resumo->set_situacao(0);

					if($nota_resumo->insert())
					{
					}
					else
					{
						$ok=1;
					}
				}

			}
			else
			{
				$ok=1;
			}


		}
		else
		{
			$_SESSION['msg'] = "Orientador do aluno não pode ser o avaliador1.";
			echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_resumo\");</script>";
			exit();
		}



	}

	$altera2=1;
	if($_POST["ca2"] != 0)
	{
		$nota_resumo->find_by_codigo($_POST["ca2"], $_POST["cp"],$_POST["ce"]);
		if($nota_resumo->get_situacao() == 1 or $nota_resumo->get_situacao() == 2)
		$altera2=0;
	}

	if($_POST["avaliador2"] != $_POST["ca2"] and isset($_POST["avaliador2"]) and $altera2 == 1)//Alterando o avaliador 2
	{

		$avaliador_novo->find_by_codigo_avaliador($_POST["avaliador2"]);

		//Verificando se o avaliador é o orientador
		if($avaliador_novo->get_nome() != $inscricao->get_orientador())
		{
			//Atualizando o novo avaliador1
			$avalia_resumo->find_by_codigo($_POST["cp"],$_POST["ce"]);
			$avalia_resumo->set_codigo_avaliador2($_POST["avaliador2"]);

			if($avalia_resumo->update())
			{

				$log = new Log();
				$log->set_adm_usuario( $adm->get_usuario() );
				$log->set_codigo_evento( $_POST["ce"] );
				$log->set_operacao( 'Edicao avaliador2 na mao' );
				$log->set_detalhes( 'Modificado de ' . $_POST["ca2"] . ' para ' . $_POST["avaliador2"] . ' do participante ' . $_POST["cp"] );

				$log->insert();

				//Se não tinha avaliador, insere um registro na tabela nota_resumo
				if($_POST["ca2"] != 0)
				{
					if($nota_resumo->find_by_codigo($_POST["ca2"], $_POST["cp"],$_POST["ce"]))
					{

					}
					else
					{
						$ok=1;
					}


					if($nota_resumo->remove())
					{

					}
					else
					{
						$ok=1;
					}

				}

				if($_POST["avaliador2"] != 0)
				{
					$nota_resumo->set_codigo_pessoa($_POST["cp"]);
					$nota_resumo->set_codigo_evento($_POST["ce"]);
					$nota_resumo->set_codigo_avaliador($_POST["avaliador2"]);
					$nota_resumo->set_Q1(0.0);
					$nota_resumo->set_Q2(0.0);
					$nota_resumo->set_Q3(0.0);
					$nota_resumo->set_Q4(0.0);
					$nota_resumo->set_situacao(0);

					if($nota_resumo->insert())
					{
					}
					else
					{
						$ok=1;
					}
				}

			}
			else
			{
				$ok=1;
			}


		}
		else
		{
			$_SESSION['msg'] = "Orientador do aluno não pode ser o avaliador2.";
			echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_resumo\");</script>";
			exit();
		}



	}

if($ok == 0)
{
	$_SESSION['msg'] = "Avaliadores atualizados com sucesso.";
	echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_resumo\");</script>";
	exit();


}else
{
	$_SESSION['msg'] = "Erro inesperado. Por favor, contacte a comissão organizadora.";
	echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_resumo\");</script>";
	exit();
}

}

echo "<script language=\"JavaScript\">location=(\"../home.php?page=atribuicao_resumo\");</script>";
exit();

?>
