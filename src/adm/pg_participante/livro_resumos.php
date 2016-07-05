<div id="content">
<div class="post">
	<div class="content">
	<div id='menu' >
		<ul><li class='listar'><a href='#' title=''><center>Livro de Resumos</center></a></li></ul>
	</div>
	<table>
		<tr> 
			<td height="12" colspan="2"></td> 
		</tr> 
	</table>


	<table border="0" cellspacing="0" cellpadding="0">
		
<?php
	
	//include "resumos/function_date_eng.php";
	$evento = $_SESSION["evento"];
	$cd_evento = $evento->get_nome();
	$contador = 0;
	
	//Preparando o arquivo para escrita
	$nm_caminho = "resumos/livro_".$cd_evento.".tex";
	
	if ( file_exists("$nm_caminho") ){	
		if ( !unlink($nm_caminho) )
		{	echo "<b>ATENÇÃO:</b> Arquivo não Disponível para Download! </br></br> Verifique as permissões (escrita/leitura) do <i>usuário</i> para os diretórios da conta <i>Summer</i> </br></br>"; exit;	};
	};
	
	$handle = fopen("$nm_caminho", "x");
	
	//Consultando/Carregando dados do evento para formatação

	$evento = new Evento();
	$evento->find_by_codigo($codigo_evento);
	$nm_evento = $evento->get_nome();
	$ds_evento = $evento->get_descricao();

	$data_inicio = $evento->get_data_inicio();
	$d=explode("/",$data_inicio);
	$dd_evento = $d[1];
	$mm_evento = $d[0];

	$data_fim = $evento->get_data_fim();
	$d=explode("/",$data_fim);
	$dd_evento_f = $d[1];
	$mm_evento_f = $d[0];
	$aa_evento_f = $d[2];
	

	//incluindo no resumo a formatação adequada
	include "resumos/gerar_resumo.php";

	
	$pessoa = new Pessoa();
	$consulta = $pessoa->find_by_evento_conferencista_resumo($codigo_evento);
		
	//Escrevendo os resumos no livro
	while ( $linha = mysql_fetch_array($consulta) )
	{
		$nm_participante = $linha["nome"];
		$ds_url_resumo= $linha["url_resumo"];
		
		$corpo[$contador] .= '
		%%%%%%%%%%
		%'.$linha["nome"].'
		%%%%%%%%%%
		
		{\center{\bf\large '.$linha["titulo_resumo"].'}
		
		\noindent
		
		\addcontentsline{toc}{section}{\newline '.$nm_participante.'
		\newline '.$linha["titulo_resumo"].'}
		
		\smallskip
		
		{\sc '.$linha["nome_autor1"].' , '.$linha["nome_autor2"].' , '.$linha["nome_autor3"].'}

		\smallskip
		
		'.$linha["instituicao"].'
		
		}
		
		\medskip
		
		
		\par '.$ds_url_resumo.'
		
		
		%\begin{thebibliography}{99}
		
		%\end{thebibliography}
		
		
		\vspace{0.1in}\noindent\hrulefill \vspace{0.1in}';
		
		$corpo[$contador] .= "\r\n\r\n".'%============== Fim do Registro =============='."\r\n\r\n";
		
	
		if ( (!fwrite($handle, $corpo[$contador])) )
		{	echo "<b>ATENÇÃO</b>: Ocorreu um erro ao gravar o registro do participante <i>$nm_participante</i> no arquivo <i>$nm_caminho</i>! </br></br> O arquivo foi fechado incorretamente! </br></br>";	fclose($handle);  };

		$contador++;
	};
	
	//Finalizando resumo e fechando o arquivo
	$final = "}\r\n\r\n".'\end{document}';
	
	if ( (!fwrite($handle, $final)) )
	{	echo "<b>ATENÇÃO</b>: O arquivo <i>$nm_caminho</i> não foi finalizado corretamente! </br></br>";	};
	
	fclose($handle);
	
	echo "O arquivo encontra-se disponível, pronto para download, em: <a href=\"resumos/livro_$cd_evento.tex\" target=\"_blank\"\">livro_$cd_evento.tex</a>";

?>

	</table>
	
	</div>
</div>


</div><!--Content-->
