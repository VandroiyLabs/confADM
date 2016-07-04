<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.pessoa.php");
require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . "public_html/sifsc/user/classes/class.inscricao.php");
require_once($home . "public_html/sifsc/user/classes/class.minicurso.php");
require_once($home . "public_html/sifsc/user/classes/class.participa_minicurso.php");

session_start();

include($home . "public_html/sifsc/user/error_handler.php");
$page = $_POST["page"];



include($home . "public_html/sifsc/user/event/secao.php");

$minicurso = new Minicurso();
$participacao = new ParticipaMinicurso();
//$participacao= $_SESSION["participacao"];
$participacao->find_by_codigo( $pessoa->get_codigo_pessoa(), $evento->get_codigo_evento() );
$_SESSION["participacao"] = $participacao;

if($evento->get_minicurso_aberto() == '1')
{

	if($page=='insert')
	{
		$inscricao->seta_modalidade(1,3);

		if ( $participacao->find_by_codigo( $inscricao->get_codigo_pessoa(), $inscricao->get_codigo_evento()) )
		{
				$minicurso->find_by_codigo($_POST["minicurso"]);

				if ( $minicurso->insert_inscritos() )
				{
					$minicurso->find_by_codigo( $participacao->get_codigo_minicurso() );
					$participacao->set_codigo_minicurso($_POST["minicurso"]);

					if($minicurso->remove_inscritos() && $participacao->update($inscricao->get_codigo_pessoa(),$inscricao->get_codigo_evento()) && $inscricao->update_no_form())
					{
						$_SESSION["inscricao"] = $inscricao;
						$_SESSION["participacao"] = $participacao;

						if ( !isset( $_SESSION['adm_usuario'] ) )
						{
							echo "<script language=\"javascript\">location=(\"http://sifsc.ifsc.usp.br/user/event/minicursos.php\");</script>";
						}
						else
						{
							echo "<script language=\"JavaScript\">history.back();</script>";
						}
					}
				}


		}
		else
		{
			$participacao->set_codigo_pessoa($inscricao->get_codigo_pessoa());
			$participacao->set_codigo_evento($inscricao->get_codigo_evento());
			$participacao->set_codigo_minicurso($_POST["minicurso"]);
			$minicurso->find_by_codigo($_POST["minicurso"]);

			if($participacao->insert() && $minicurso->insert_inscritos() && $inscricao->update_no_form())
			{
				$_SESSION["inscricao"] = $inscricao;
				$_SESSION["participacao"] = $participacao;
				$_SESSION['msg'] = 'Pronto, você já está inscrito no minicurso.';

				if ( !isset( $_SESSION['adm_usuario'] ) )
				{
					echo "<script language=\"javascript\">location=(\"http://sifsc.ifsc.usp.br/user/event/minicursos.php\");</script>";
				}
				else
				{
					echo "<script language=\"JavaScript\">history.back();</script>";
				}
			}
		}

	}




	if($page=='remove')
	{
		$inscricao->seta_modalidade(0,3);
		if($participacao->find_by_codigo($inscricao->get_codigo_pessoa(),$inscricao->get_codigo_evento()) && $inscricao->update_no_form())
		{
			$_SESSION["inscricao"] = $inscricao;
			$minicurso->find_by_codigo($participacao->get_codigo_minicurso());

			if($minicurso->remove_inscritos() && $participacao->remove($inscricao->get_codigo_pessoa(),$inscricao->get_codigo_evento()) )
			{

				unset($_SESSION["participacao"]);
				$_SESSION['msg'] = 'Seu cadastro foi removido.';

				if ( !isset( $_SESSION['adm_usuario'] ) )
				{
					echo "<script language=\"javascript\">location=(\"http://sifsc.ifsc.usp.br/user/event/minicursos.php\");</script>";
				}
				else
				{
					echo "<script language=\"JavaScript\">history.back();</script>";
				}

			}
		}
	}
}
else
{
	$_SESSION['msg'] = 'Inscrições encerradas.';
	echo "<script language=\"JavaScript\">location=(\"../status.php\");</script>";
}

?>
