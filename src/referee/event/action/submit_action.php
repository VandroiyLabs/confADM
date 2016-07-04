<?php

require_once("~/public_html/sifsc/user/classes/class.avaliador.php");
require_once("~/public_html/sifsc/user/classes/class.evento.php");
require_once("~/public_html/sifsc/user/classes/class.avalia_resumo.php");
require_once("~/public_html/sifsc/user/classes/class.nota_resumo.php");
session_start();


require_once("~/public_html/sifsc/referee/event/secao.php");
require_once("~/public_html/sifsc/referee/restricted.php");


$nota_resumo = new NotaResumo();
$consulta = $nota_resumo->find_by_codigo_avaliador_evento($avaliador->get_codigo_avaliador(),$evento->get_codigo_evento());


if($evento->get_avaliacao_aberta() == 1 )
{
	if(mysql_num_rows($consulta) > 0)
	{
		$ok=1; $mensagem_email="";
		while($row = mysql_fetch_object($consulta))
		{
			
			if($nota_resumo->find_by_codigo($avaliador->get_codigo_avaliador(), $row->codigo_pessoa, $evento->get_codigo_evento())	)
			{

				$mensagem_email.=$row->titulo."\n\n";
				$mensagem_email.="Notas:\n";
				$mensagem_email.="Nota do Quesito 1: ".$nota_resumo->get_Q1()."\n";
				$mensagem_email.="Nota do Quesito 2: ".$nota_resumo->get_Q2()."\n";
				$mensagem_email.="Nota do Quesito 3: ".$nota_resumo->get_Q3()."\n";
				//$mensagem_email.="Nota do Quesito 4: ".$nota_resumo->get_Q4()."\n";
				//$mensagem_email.="Nota do Quesito 5: ".$nota_resumo->get_Q5()."\n";
				$mensagem_email.="\n\n\n";

				$situacao = $nota_resumo->get_situacao();
				$nota_resumo->set_situacao(2);

				

				if($nota_resumo->update())
				{
					if($situacao != 2)
					{
						$nota_resumo->insert_backup();
					}
					
				}
				else	
				{
					$ok=0;
				}		

			}
			
		}
			
		if($ok == 1)
		{

			$assunto = $evento->get_tag_email() . " Recibo de submissao de avaliacoes"	;
			$nome = explode(" ", $avaliador->get_nome());
			$nome = $nome[0];
			$mensagem = "Caro(a) " . $nome . ",\n\n";
			$mensagem .= "registramos em nosso sistema a submissão das seguintes avaliações:\n\n\n";
			$mensagem.=$mensagem_email;
			$mensagem.="Em caso de dúvidas, entre em contato pelo e-mail avaliacaosifsc@gmail.com.\n\n";
			$mensagem .= $evento->get_assinatura_email();
			$avaliador->manda_email($assunto, $mensagem);

			$_SESSION['msg'] = "Avaliações submetidas com sucesso!";
			echo "<script language=\"javascript\">location=(\"../avalia_resumo_home.php\");</script>";

		}
		else
		{
			$_SESSION['msg'] = "Erro ao submeter avaliações. Por favor, contacte a comissão organizadora!";
			echo "<script language=\"javascript\">location=(\"../avalia_resumo_home.php\");</script>";
		}
			
	}
}
else
{
	echo "<script language=\"javascript\">location=(\"../avalia_resumo_home.php\");</script>";
}

?>

