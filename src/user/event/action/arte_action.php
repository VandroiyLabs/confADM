<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.evento.php");
require_once($home . 'public_html/sifsc/user/classes/class.inscricao.php');
require_once($home . 'public_html/sifsc/user/classes/class.arte.php');
require_once($home . "public_html/sifsc/user/classes/class.pessoa.php");
require_once($home . 'public_html/sifsc/user/classes/class.administrador.php');

session_start();
include($home . "public_html/sifsc/user/error_handler.php");
$page = $_POST["page"];

include($home . 'public_html/sifsc/user/event/secao.php');

$arte = new Arte();
$arte->find_by_codigo($inscricao->get_codigo_arte());


if($evento->get_inscricao_aberta() == '1' or isset( $_SESSION['adm_usuario'] ))
{

	if($page=='insert')
	{
		if(!isset( $_SESSION['adm_usuario'] ))
		{
			$inscricao->seta_modalidade(1,4);
			$inscricao->set_situacao_arte(1);
		}
		else
		{
			require_once('../../../user/classes/class.log.php');


			$adm = new Administrador();
			$adm->find_by_usuario($_SESSION['adm_usuario']);

			$log = new Log();
			$log->set_adm_usuario( $adm->get_usuario() );
			$log->set_codigo_evento( $evento->get_codigo_evento() );
			$log->set_operacao( 'Editar arte' );
			$log->set_detalhes( 'codigo_arte = ' . $inscricao->get_codigo_arte() . ' :: codigo_pessoa = ' . $pessoa->get_codigo_pessoa() . ' :: situacao_arte = ' . $inscricao->get_situacao_arte() . '' );

			$log->insert();

		}

		if($inscricao->update_no_form())
		{
			$_SESSION["inscricao"] = $inscricao;

			if( $arte->find_by_codigo( $inscricao->get_codigo_arte() ) )
			{
				$arte->set_titulo($_POST["titulo"]);
				$arte->set_tipo_obra($_POST["tipo_obra"]);
				$arte->set_tipo_apresentacao($_POST["tipo_apresentacao"]);
				$arte->set_largura($_POST["largura"]);
				$arte->set_altura($_POST["altura"]);
				$arte->set_profundidade($_POST["profundidade"]);
				$arte->set_descricao($_POST["descricao"]);

				if ( $arte->update() and $_POST['submissao'] == 0 )
				{
					$_SESSION["arte"] = $arte;
					$_SESSION['msg'] = 'Detalhes da sua obra de arte foram atualizados.';
					echo "<script language=\"JavaScript\">history.back();</script>";
				}
			}
			else
			{
				$arte->set_titulo($_POST["titulo"]);
				$arte->set_tipo_obra($_POST["tipo_obra"]);
				$arte->set_tipo_apresentacao($_POST["tipo_apresentacao"]);
				$arte->set_largura($_POST["largura"]);
				$arte->set_altura($_POST["altura"]);
				$arte->set_profundidade($_POST["profundidade"]);
				$arte->set_descricao($_POST["descricao"]);
				$arte->set_codigo_evento($inscricao->get_codigo_evento());
				$arte->set_codigo_secao(0);

				if( $arte->insert() )
				{
					$inscricao->set_codigo_arte( $arte->get_codigo_arte() );
					$_SESSION["arte"] = $arte;
					if ( $inscricao->update_no_form() and $_POST['submissao'] == 0)
					{
						$_SESSION["inscricao"] = $inscricao;
						$_SESSION['msg'] = 'Pronto, agora sua obra de arte está cadastrada.';
						echo "<script language=\"JavaScript\">history.back();</script>";
					}
				}

			}

		}
	}

	if ( isset($_POST['submissao']) and $_POST['submissao'] == 1 )
	{
		include('arte_submit_question.php');
	}

	elseif($page=='remove')
	{
		$inscricao->seta_modalidade(0,4);
		$inscricao->set_situacao_arte(0);

		$codigo_arte = $inscricao->get_codigo_arte();
		$arte->set_codigo_arte($codigo_arte);
		$arte->set_codigo_evento($inscricao->get_codigo_evento());
		$inscricao->set_codigo_arte('0');

		if($arte->remove() && $inscricao->update_no_form())
		{
			unset($_SESSION["arte"]);
			$_SESSION["inscricao"] = $inscricao;
			$_SESSION['msg'] = 'Sua obra de arte foi removida.';
			echo "<script language=\"JavaScript\">history.back();</script>";
		}
	}
}
else
{
	$_SESSION['msg'] = 'Inscrições encerradas.';
	echo "<script language=\"JavaScript\">history.back();</script>";
}

?>
