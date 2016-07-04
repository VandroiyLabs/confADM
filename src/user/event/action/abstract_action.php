<?php
require_once('../../classes/class.pessoa.php');
require_once('../../classes/class.evento.php');
require_once('../../classes/class.inscricao.php');
require_once('../../classes/class.resumo.php');
require_once('../../classes/class.conexao.php');
require_once('../../classes/class.autor.php');
require_once('../../classes/class.administrador.php');

if(!isset($_SESSION['adm_usuario']))
{
	session_start();
}

include("~/public_html/sifsc/user/error_handler.php");



include("~/public_html/sifsc/user/restricted.php");
include("~/public_html/sifsc/user/event/secao.php");

if( ! $inscricao->find_by_pessoa_evento( $pessoa->get_codigo_pessoa(), $evento->get_codigo_evento() ))
{
	$_SESSION['msg'] = "Ocorreu um erro inesperado, desculpe!";
	echo "<script language=\"javascript\">location=(\"../abstract.php?lng=$_POST[ingles]\");</script>";
}

$page = $_POST["page"];


$resumo = new Resumo();
$autor = new Autor();

$situacao_resumo = $inscricao->get_situacao_resumo();

$status_insc = $inscricao->get_modalidade();

if ( (($inscricao->get_situacao_resumo() == 0 or $inscricao->get_situacao_resumo() == 1)  and $evento->get_submissao_aberta()== 1) or ($inscricao->get_situacao_resumo() == 3 and $evento->get_resubmissao_aberta()== 1) or ( $situacao_resumo == 2 and isset($_SESSION["adm_usuario"]) ) )
{

	// Resumos não submetidos no periodo regular nao podem concorrer ao premio
	//
	if (strcmp( $inscricao->get_instituicao(), 'IFSC-USP') != 0 or (($inscricao->get_situacao_resumo() == 0 or $inscricao->get_situacao_resumo() == 1) and $evento->get_premio_aberto() == 0) or ($inscricao->get_situacao_resumo() == 3 and  $inscricao->get_premio() == 0 and $evento->get_premio_aberto() == 0)  )
	{
		$inscricao->set_premio('0');
	}
	else
	{
		$inscricao->set_premio($_POST['premio']);
	}



	if ( $_POST['ingles'] == 1 )
	{
		$codigo_pra_procurar = 	$inscricao->get_codigo_resumo_ingles();
	}
	else
	{
		$codigo_pra_procurar = 	$inscricao->get_codigo_resumo();
		$inscricao->set_grupo($_POST['grupo']);
		$inscricao->set_subarea($_POST['subarea']);

		if($_POST['orientador']=='OUTRO')
		{
			$inscricao->set_orientador($_POST['outro_orientador']);
		}
		else
		{
			$inscricao->set_orientador($_POST['orientador']);
		}
		//Para não dar problemas com caracteres '\"
		$instituicao = $inscricao->get_instituicao();
		$inscricao->set_instituicao($instituicao);

		$nivel = $inscricao->get_nivel();
		$inscricao->set_nivel($nivel);

		$curso = $inscricao->get_curso();
		$inscricao->set_curso($curso);

	}

	if ( $codigo_pra_procurar != 0 )
	{
		$resumo->find_by_codigo($codigo_pra_procurar);
	}

	/*

		Como é para setar a modalidade do resumo ingles

		- o resumo em português já foi salvo em algum momento

		- se ainda nao tiver sido submetido, $status_insc[1] = 1. Então a modalidade
			fica setada como 1 também -- Okay

		- se o resumo estiver sendo ressubmetido em algum momento, $status_insc[1] = 3.
			Então a modalidade do resumo inglês fica setado como 3 em conjunto!!

		- caso o resumo esteja sob avaliação ou já esteja aceito, então este script não
			poderá mais ser invocado pelo usuário e portanto tá isso não é chamado.

	*/

	if ( $_POST['ingles'] == 1 and isset($status_insc[2]) and $status_insc[2] == '0' )
	{
		/* Atualiza o resumo como já salvo! */
		$inscricao->seta_modalidade( $status_insc[1] , 2);
	}
	else if ( $situacao_resumo == 0 or $situacao_resumo == 1  )
	{
		/* Setando resumo como salvo em algum momento! */
		$inscricao->set_situacao_resumo(1);
		/* Atualiza o resumo como já salvo! */
		$inscricao->seta_modalidade(1, 1);
	}


	$resumo->set_titulo($_POST['titulo']);
	$resumo->set_texto($_POST['texto_abstract']);
	$resumo->set_email($_POST['email']);
	$resumo->set_lingua($_POST['lingua']);

	/* Tempo por que o trabalho vem sendo desenvolvido */
	$resumo->set_tempo($_POST['tempo']);


	/* ingles? */
	$resumo->set_ingles($_POST['ingles']);

	/* Keywords */
	$resumo->set_kw1($_POST['kw1']);
	$resumo->set_kw2($_POST['kw2']);
	$resumo->set_kw3($_POST['kw3']);

	/* Referências */
	$resumo->set_tipo_ref1($_POST['tipo_ref1']);

	if($_POST['tipo_ref1'] == "nan")//SEM REF
	{
		$resumo->set_tipo_ref1(-1);
		$resumo->set_autor1("");
		$resumo->set_titulo1("");
		$resumo->set_info1("");

	}
	elseif($_POST['tipo_ref1'] == 0)//OUTROS
	{
		$resumo->set_autor1($_POST['autores_0_1']);
		$resumo->set_titulo1($_POST['titulo_0_1']);
		$resumo->set_info1($_POST['info0_0_1']."||||||||||||||||");
	}
	elseif($_POST['tipo_ref1'] == 1)//PERIODICO
	{
		$resumo->set_autor1($_POST['autores_1_1']);
		$resumo->set_titulo1($_POST['titulo_1_1']);
		$resumo->set_info1($_POST['info0_1_1']."||".$_POST['info1_1_1']."||".$_POST['info2_1_1']."||".$_POST['info3_1_1']."||".$_POST['info4_1_1']."||".$_POST['info5_1_1']."||||||");
	}
elseif($_POST['tipo_ref1'] == 2)//LIVRO
	{
		$resumo->set_autor1($_POST['autores_2_1']);
		$resumo->set_titulo1($_POST['titulo_2_1']);
		$resumo->set_info1($_POST['info0_2_1']."||".$_POST['info1_2_1']."||".$_POST['info2_2_1']."||".$_POST['info3_2_1']."||".$_POST['info4_2_1']."||".$_POST['info5_2_1']."||".$_POST['info6_2_1']."||".$_POST['info7_2_1']."||".$_POST['info8_2_1']);
	}
elseif($_POST['tipo_ref1'] == 3)//EVENTO
	{
		$resumo->set_autor1($_POST['autores_3_1']);
		$resumo->set_titulo1($_POST['titulo_3_1']);
		$resumo->set_info1($_POST['info0_3_1']."||".$_POST['info1_3_1']."||".$_POST['info2_3_1']."||".$_POST['info3_3_1']."||".$_POST['info4_3_1']."||".$_POST['info5_3_1']."||".$_POST['info6_3_1']."||".$_POST['info7_3_1']."||");
	}
elseif($_POST['tipo_ref1'] == 4)//TESE
	{
		$resumo->set_autor1($_POST['autores_4_1']);
		$resumo->set_titulo1($_POST['titulo_4_1']);
		$resumo->set_info1($_POST['info0_4_1']."||".$_POST['info1_4_1']."||".$_POST['info2_4_1']."||".$_POST['info3_4_1']."||".$_POST['info4_4_1']."||".$_POST['info5_4_1']."||".$_POST['info6_4_1']."||".$_POST['info7_4_1']."||");
	}

	$resumo->set_tipo_ref2($_POST['tipo_ref2']);
	if($_POST['tipo_ref2'] == "nan")//SEM REF
	{
		$resumo->set_tipo_ref2(-1);
		$resumo->set_autor2("");
		$resumo->set_titulo2("");
		$resumo->set_info2("");

	}
	elseif($_POST['tipo_ref2'] == 0)//OUTROS
	{
		$resumo->set_autor2($_POST['autores_0_2']);
		$resumo->set_titulo2($_POST['titulo_0_2']);
		$resumo->set_info2($_POST['info0_0_2']."||||||||||||||||");
	}
	elseif($_POST['tipo_ref2'] == 1)//PERIODICO
	{
		$resumo->set_autor2($_POST['autores_1_2']);
		$resumo->set_titulo2($_POST['titulo_1_2']);
		$resumo->set_info2($_POST['info0_1_2']."||".$_POST['info1_1_2']."||".$_POST['info2_1_2']."||".$_POST['info3_1_2']."||".$_POST['info4_1_2']."||".$_POST['info5_1_2']."||||||");
	}
elseif($_POST['tipo_ref2'] == 2)//LIVRO
	{
		$resumo->set_autor2($_POST['autores_2_2']);
		$resumo->set_titulo2($_POST['titulo_2_2']);
		$resumo->set_info2($_POST['info0_2_2']."||".$_POST['info1_2_2']."||".$_POST['info2_2_2']."||".$_POST['info3_2_2']."||".$_POST['info4_2_2']."||".$_POST['info5_2_2']."||".$_POST['info6_2_2']."||".$_POST['info7_2_2']."||".$_POST['info8_2_2']);
	}
elseif($_POST['tipo_ref2'] == 3)//EVENTO
	{
		$resumo->set_autor2($_POST['autores_3_2']);
		$resumo->set_titulo2($_POST['titulo_3_2']);
		$resumo->set_info2($_POST['info0_3_2']."||".$_POST['info1_3_2']."||".$_POST['info2_3_2']."||".$_POST['info3_3_2']."||".$_POST['info4_3_2']."||".$_POST['info5_3_2']."||".$_POST['info6_3_2']."||".$_POST['info7_3_2']."||");
	}
elseif($_POST['tipo_ref2'] == 4)//TESE
	{
		$resumo->set_autor2($_POST['autores_4_2']);
		$resumo->set_titulo2($_POST['titulo_4_2']);
		$resumo->set_info2($_POST['info0_4_2']."||".$_POST['info1_4_2']."||".$_POST['info2_4_2']."||".$_POST['info3_4_2']."||".$_POST['info4_4_2']."||".$_POST['info5_4_2']."||".$_POST['info6_4_2']."||".$_POST['info7_4_2']."||");
	}


	$resumo->set_tipo_ref3($_POST['tipo_ref3']);
	if($_POST['tipo_ref3'] == "nan")//SEM REF
	{
		$resumo->set_tipo_ref3(-1);
		$resumo->set_autor3("");
		$resumo->set_titulo3("");
		$resumo->set_info3("");

	}
	elseif($_POST['tipo_ref3'] == 0)//OUTROS
	{
		$resumo->set_autor3($_POST['autores_0_3']);
		$resumo->set_titulo3($_POST['titulo_0_3']);
		$resumo->set_info3($_POST['info0_0_3']."||||||||||||||||");
	}
	elseif($_POST['tipo_ref3'] == 1)//PERIODICO
	{
		$resumo->set_autor3($_POST['autores_1_3']);
		$resumo->set_titulo3($_POST['titulo_1_3']);
		$resumo->set_info3($_POST['info0_1_3']."||".$_POST['info1_1_3']."||".$_POST['info2_1_3']."||".$_POST['info3_1_3']."||".$_POST['info4_1_3']."||".$_POST['info5_1_3']."||||||");
	}
elseif($_POST['tipo_ref3'] == 2)//LIVRO
	{
		$resumo->set_autor3($_POST['autores_2_3']);
		$resumo->set_titulo3($_POST['titulo_2_3']);
		$resumo->set_info3($_POST['info0_2_3']."||".$_POST['info1_2_3']."||".$_POST['info2_2_3']."||".$_POST['info3_2_3']."||".$_POST['info4_2_3']."||".$_POST['info5_2_3']."||".$_POST['info6_2_3']."||".$_POST['info7_2_3']."||".$_POST['info8_2_3']);
	}
elseif($_POST['tipo_ref3'] == 3)//EVENTO
	{
		$resumo->set_autor3($_POST['autores_3_3']);
		$resumo->set_titulo3($_POST['titulo_3_3']);
		$resumo->set_info3($_POST['info0_3_3']."||".$_POST['info1_3_3']."||".$_POST['info2_3_3']."||".$_POST['info3_3_3']."||".$_POST['info4_3_3']."||".$_POST['info5_3_3']."||".$_POST['info6_3_3']."||".$_POST['info7_3_3']."||");
	}
elseif($_POST['tipo_ref3'] == 4)//TESE
	{
		$resumo->set_autor3($_POST['autores_4_3']);
		$resumo->set_titulo3($_POST['titulo_4_3']);
		$resumo->set_info3($_POST['info0_4_3']."||".$_POST['info1_4_3']."||".$_POST['info2_4_3']."||".$_POST['info3_4_3']."||".$_POST['info4_4_3']."||".$_POST['info5_4_3']."||".$_POST['info6_4_3']."||".$_POST['info7_4_3']."||");
	}

	$resumo->set_codigo_evento( $evento->get_codigo_evento() );
	$resumo->set_codigo_pessoa( $inscricao->get_codigo_pessoa() );

	if ( $codigo_pra_procurar == 0 )
	{
		/* Salvando novo resumo */

		$_SESSION["msg"] = "Resumo criado e salvo com sucesso";
		if($resumo->insert())
		{

			if ( $_POST['ingles'] == 1)
			{
				$inscricao->set_codigo_resumo_ingles($resumo->get_codigo_resumo());
			}
			else
			{
				$inscricao->set_codigo_resumo($resumo->get_codigo_resumo());
			}

			if($inscricao->update())
			{
				$_SESSION["resumo"] = $resumo;
				$_SESSION["inscricao"] = $inscricao;

				$codigo_pessoa = $inscricao->get_codigo_pessoa();
				$codigo_evento = $inscricao->get_codigo_evento();

			}
		}


	}
	else
	{
		/* Salvando alterações no resumo antigo */

		$_SESSION["msg"] = "Resumo salvo com sucesso";

		if( $resumo->update() and $inscricao->update() )
		{

			$_SESSION["inscricao"] = $inscricao;
			$_SESSION["resumo"] = $resumo;

		}
	}

	// Setando o autor principal
	if ( isset($_POST['autorprincipal']) and $_POST['autorprincipal'] != '' )
	{
		$ordem_autor_principal = $_POST['autorprincipal'];
	}
	else
	{
		$ordem_autor_principal = -1;
		$resumo->set_autor_principal( NULL );
		$resumo->update();
		$_SESSION["resumo"] = $resumo;
	}

	$nauthors = $_POST['nauthors_hidden'];

	$aut_remove = $_POST['list_authors_delete'];

	$lista_ids_authors2remove = explode(";", $aut_remove);
	$nauthors2remove = count($lista_ids_authors2remove);

	for ( $j = 0; $j < $nauthors2remove; $j++ )
	{
		$autor = new Autor();
		$autor->find_by_codigo( intval( $lista_ids_authors2remove[ $j ] ) );
		$autor->remove();
	}

	$contador = 0;

	for ( $j = 0; $j < $nauthors; $j++ )
	{

		if ( isset($_POST["autor" . $j ]) )
		{

			if ( $_POST["author_id" . $j] == 0 )
			{
				$contador++;
				$autor->set_codigo_resumo($inscricao->get_codigo_resumo());
				$autor->set_nome( $_POST[ "autor" . $j ] );
				$autor->set_instituicao( $_POST[ "instituicao" . $j ] );
				$autor->set_ordem( $contador );

				if ( $autor->insert() )
				{
					$ok=true;
				}
			}
			else
			{
				$contador++;
				$autor->find_by_codigo($_POST["author_id" . $j]);

				$autor->set_nome( $_POST[ "autor" . $j ] );
				$autor->set_instituicao( $_POST[ "instituicao" . $j ] );
				$autor->set_ordem( $contador );

				if ( $autor->update() )
				{
					$ok=true;
				}

			}

			if ( $ordem_autor_principal != -1 and $ordem_autor_principal == $contador )
			{
				$resumo->set_autor_principal( $autor->get_codigo_autor() );
				$resumo->update();
				$_SESSION["resumo"] = $resumo;

			}
		}
	}

}
else
{
	$_SESSION['msg'] = "Você não pode mudar seu resumo agora!";
	echo "<script language=\"javascript\">history.back(1);</script>";
}

if ( !isset( $_SESSION['adm_usuario'] ) )
{
	echo "<script language=\"javascript\">location=(\"../abstract.php?lng=$_POST[ingles]\");</script>";
}
else
{
	// Salvando log desta alteração
	require_once('../../../user/classes/class.log.php');

	$adm = new Administrador();
	$adm->find_by_usuario($_SESSION['adm_usuario']);

	$log = new Log();
	$log->set_adm_usuario( $adm->get_usuario() );
	$log->set_codigo_evento( $evento->get_codigo_evento() );
	$log->set_operacao( 'Editar resumo' );
	$log->set_detalhes( 'codigo_resumo = ' . $inscricao->get_codigo_resumo() . ' :: codigo_pessoa = ' . $pessoa->get_codigo_pessoa() . ' :: situacao_resumo = ' . $inscricao->get_situacao_resumo() . '' );

	$log->insert();


	// Redirecionando a página
	echo "<script language=\"javascript\">location=(\"" . $_SESSION['url_abstract_tosave'] . "\");</script>";
	unset( $_SESSION['url_abstract_tosave'] );
}
?>
