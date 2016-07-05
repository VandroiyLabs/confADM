	<?php 
	include('resumo_tex.php');

	function acertaStrings( $texto )
	{
		$texto1 = str_replace('<', '&lt;', $texto);
		$texto1 = str_replace('>', '&gt;', $texto1);
		
		$texto1 = str_replace('&lt;b&gt;', '<b>', $texto1);
		$texto1 = str_replace('&lt;/b&gt;', '</b>', $texto1);
		
		$texto1 = str_replace('&lt;i&gt;', '<i>', $texto1);
		$texto1 = str_replace('&lt;/i&gt;', '</i>', $texto1);
		
		$texto1 = str_replace('&lt;', '<font style="color: #C00;">&lt;</font>', $texto1);
		$finaltexto = str_replace('&gt;', '<font style="color: #C00;">&gt;</font>', $texto1);
				
		return $finaltexto;
	}

	function acertaStrings_tex( $texto )
	{
		$texto1 = str_replace("\n"," ", $texto);
		$texto1 = str_replace("\r"," ", $texto1);

		//$texto1 = str_replace('$', '\$', $texto1);

		$texto1 = str_replace('\&', '&', $texto1);
		$texto1 = str_replace('&', '\&', $texto1);

		$texto1 = str_replace('\%', '%', $texto1);		
		$texto1 = str_replace('%', '\%', $texto1);		

		$texto1 = str_replace('\(', '$', $texto1);		
		$texto1 = str_replace('\)', '$', $texto1);

		$texto1 = str_replace('$$', 'DOIS_SIFROES', $texto1);

		$texto1 = str_replace('<i>', '\textit{', $texto1);		
		$texto1 = str_replace('</i>', '}', $texto1);

		$texto1 = str_replace('&lt;b&gt;', '\textbf{', $texto1);
		$texto1 = str_replace('&lt;/b&gt;', '}', $texto1);
		
		$texto1 = str_replace('&lt;i&gt;', '\textit{', $texto1);
		$texto1 = str_replace('&lt;/i&gt;', '}', $texto1);

		$texto1 = str_replace('<b>', '\textbf{', $texto1);		
		$texto1 = str_replace('</b>', '}', $texto1);
		
		$texto1 = str_replace('<', '$<$', $texto1);
		$texto1 = str_replace('>', '$>$', $texto1);
	
		$texto1 = str_replace('$$', '$', $texto1);

		$finaltexto = str_replace('DOIS_SIFROES', '$$', $texto1);		

		
								
		return $finaltexto;
	}
		
	function imprimeautores($resumo, $nautores, $codigo_resumo, $cod_autor_principal)
	{
		$autores_tex="\autor{";
		$autor = new Autor();
		
		if ( $nautores > 0 )
		{
			$instituicoes = array();
			$AxI = array();
			$ninst = 0;

			echo "\t\t<p class=\"autor\">";

			for ( $j = 0; $j < $nautores; $j++ )
			{
				$autor->find_by_resumo_ordem($codigo_resumo, $j + 1);
				
				if( in_array($autor->get_instituicao(), $instituicoes) ) 
				{
					$AxI[$j] = array_search($autor->get_instituicao(), $instituicoes) + 1;
				}
				else
				{
					$instituicoes[$ninst] = $autor->get_instituicao();
					
					// Instituicao começa a contar do 1.
					$ninst++;
					$AxI[$j] = $ninst;
				}
				
				if ( $cod_autor_principal == $autor->get_codigo_autor() )
				{
					echo "<u>" . $autor->get_nome() . "</u><sup>" . $AxI[$j] . "</sup>";
					$autores_tex.="\underline{".$autor->get_nome()."}\superscript{".$AxI[$j]."}";
				}
				else
				{
					echo $autor->get_nome() . "<sup>" . $AxI[$j] . "</sup>";
					$autores_tex.=$autor->get_nome()."\superscript{".$AxI[$j]."}";
				}
				
				if ( $j != $nautores - 1 )
				{
					echo "; ";$autores_tex.="; ";
				}
			}
			$autores_tex.="}\n\n";

			echo "</p>\n";
			echo "<p class=\"email\">" . $resumo->get_email() . "</p>";
			$autores_tex.="\emailprincautor{".$resumo->get_email()."}\n\n";
			
		
			echo "\t\t<p class=\"instituicao\">";
			
			for ( $j = 1; $j <= $ninst; $j++ )
			{
				 echo " <sup>" . $j . "</sup> " . $instituicoes[$j - 1] . "<br />";
				$autores_tex.="\instituicao{".$j."}{".$instituicoes[$j - 1]."}\n\n";
			}
			
			echo "</p>\n";
		}
		return $autores_tex;
	}
	
	function print_keywrds($resumo)
	{
		$str_2print = '';
		
		if ( strcmp($resumo->get_kw1(), '') != 0 )
		{
			$str_2print .= $resumo->get_kw1() . '. ';
		}
		if ( strcmp($resumo->get_kw2(), '') != 0 )
		{
			$str_2print .= $resumo->get_kw2() . '. ';
		}
		if ( strcmp($resumo->get_kw3(), '') != 0 )
		{
			$str_2print .= $resumo->get_kw3()  . '. ';
		}
		
		return $str_2print;
	}
	
	
	$status_insc = $inscricao->get_modalidade(1,4);
	
	if ( !isset($status_insc[1]) or $status_insc[1] == '0')
	{
		
	}
	else
	{
	
	if ( !isset($resumo) )
	{
		$resumo = new Resumo(); 
		$resumo->find_by_codigo( $inscricao->get_codigo_resumo() );
	}
	
	if ( isset($status_insc[2]) and $status_insc[2] != '0')
	{
		$resumoing = new Resumo();
		$resumoing->find_by_codigo($inscricao->get_codigo_resumo_ingles());
	}

	
	$autor = new Autor();
	$codigo_resumo = $inscricao->get_codigo_resumo();
	$nautores = $autor->numero_autores_by_resumo( $codigo_resumo );
	$cod_autor_principal = $resumo->get_autor_principal();
	
	?>
	
	<br />	
	
	<div id="titulo_secao" class='section'>
		Resumo do participante.
	</div>
	o número do código é provisório, assim que for definida a regra para ordenamento implementaremos o código oficial
	<div id="resumo">
		
		<?php
			
			if ( strcmp( $inscricao->get_nivel(), 'Graduacao') == 0 )
			{
				$codigoresumo = "IC" . $pessoa->get_codigo_pessoa();
				if($inscricao->get_codigo_resumo_ingles() > 0)
				{
					$resumo_tex.= "\\resumoingic{}{}{}\n\n\inicioic\n\n";	
				}
				else
				{
					$resumo_tex.= "\\resumoic{}{}{}\n\n\inicioic\n\n";	
				}	
			}
			elseif ( strcmp( $inscricao->get_nivel(), 'Doutorado') == 0 or strcmp( $inscricao->get_nivel(), 'Mestrado') == 0 )
			{
				$codigoresumo = "PG" . $pessoa->get_codigo_pessoa();
				if($inscricao->get_codigo_resumo_ingles() > 0)
				{
					$resumo_tex.= "\\resumoingpg{}{}{}\n\n\iniciopg\n\n";	
				}
				else
				{
					$resumo_tex.= "\\resumopg{}{}{}\n\n\iniciopg\n\n";	
				}
			}
			else
			{
				$codigoresumo = "OT" . $pessoa->get_codigo_pessoa();
			}
			
			echo "<p class=\"codigo\">" . $codigoresumo . "</p>";
			echo "<p class=\"titulo\">" . acertaStrings( $resumo->get_titulo() ) . "</p>";
			$resumo_tex.="\\titulo{".acertaStrings_tex($resumo->get_titulo())."}\n\n";
			
			
			if ( isset( $resumoing ) )
			{
				echo "<p class=\"titulo\">" . acertaStrings( $resumoing->get_titulo() ) . "</p>";				
				$resumo_tex.="\\tituloing{".acertaStrings_tex($resumoing->get_titulo())."}\n\n";
			}
			
			$resumo_tex.= imprimeautores($resumo, $nautores, $codigo_resumo, $cod_autor_principal);
			
			$textodoresumo = $resumo->get_texto();
			$textodoresumo = acertaStrings( $textodoresumo );

			$resumo_tex.="\begin{multicols}{2}\n\n";
			$resumo_tex.= "\\textoresumo{".acertaStrings_tex($resumo->get_texto())."}\n\n";

			$testedoresumo = str_replace("\(", "<font style=\"color:#00C;\">C7712b00bs1", $textodoresumo);
			$testedoresumo = str_replace("\)", "C7712b00bs2</font>", $testedoresumo);
			$testedoresumo = str_replace("C7712b00bs1", "\(\backslash(\)", $testedoresumo);
			$testedoresumo_alterado = str_replace("C7712b00bs2", "\(\backslash)\)", $testedoresumo);
			
			echo "<p class=\"texto\">" . $testedoresumo_alterado . "</p>";
			echo "<p class=\"kw\"><b>Palavras-chave:</b> " .  print_keywrds($resumo) . "</p>";
			$resumo_tex.= "\palavraschave{".acertaStrings_tex(print_keywrds($resumo))."}\n\n";

			if ( isset($resumoing) )
			{
				echo "<br />";
				
				$textodoresumo = $resumoing->get_texto();
				$textodoresumo = acertaStrings( $textodoresumo );

				$resumo_tex.= "\\textoresumo{".acertaStrings_tex($resumoing->get_texto())."}\n\n";
				$testedoresumo = str_replace("\(", "<font style=\"color:#00C;\">C7712b00bs1", $textodoresumo);
				$testedoresumo = str_replace("\)", "C7712b00bs2</font>", $testedoresumo);
				$testedoresumo = str_replace("C7712b00bs1", "\(\backslash(\)", $testedoresumo);
				$testedoresumo_alterado = str_replace("C7712b00bs2", "\(\backslash)\)", $testedoresumo);

				echo "<p class=\"texto\">" . $testedoresumo_alterado . "</p>";
				echo "<p class=\"kw\"><b>Keywords:</b> " . print_keywrds($resumoing) . "</p>";
				$resumo_tex.= "\palavraschaveing{".acertaStrings_tex(print_keywrds($resumoing)) ."}\n\n";
			}
			
			$resumo_tex.="\end{multicols}\n\n\\referenciacall\n\n";

			echo "<br /><p class=\"kw\"><b>Referências:</b></p>";
			
			echo "<div id='referencias'><ul>";
			
			if ( strcmp(substr($resumo->get_autor1(), -1) , ".") == 0 ) { $pontoautor = ""; }
			else { $pontoautor = "."; }
			if ( strcmp(substr($resumo->get_titulo1(), -1) , ".") == 0 ) { $pontotitulo = ""; }
			else { $pontotitulo = "."; }
			if ( strcmp(substr($resumo->get_info1(), -1) , ".") == 0 ) { $pontoinfo = ""; }
			else { $pontoinfo = "."; }
			
			echo "<li>1 " . $resumo->get_autor1() . $pontoautor . " " . acertaStrings( $resumo->get_titulo1() ) . $pontotitulo . " " . acertaStrings( $resumo->get_info1() ) . $pontoinfo . "</li>";
			$resumo_tex.="\\referencia{1 ".acertaStrings_tex($resumo->get_autor1()) . $pontoautor . " " . acertaStrings_tex( $resumo->get_titulo1() ) . $pontotitulo . " " . acertaStrings_tex( $resumo->get_info1() ) . $pontoinfo ."}\n\n";
			
			if ( strcmp( $resumo->get_autor2(), "" ) != 0 and strcmp( $resumo->get_autor2(), " " ) != 0 )
			{
				if ( strcmp(substr($resumo->get_autor2(), -1) , ".") == 0 ) { $pontoautor = ""; }
				else { $pontoautor = "."; }
				if ( strcmp(substr($resumo->get_titulo2(), -1) , ".") == 0 ) { $pontotitulo = ""; }
				else { $pontotitulo = "."; }
				if ( strcmp(substr($resumo->get_info2(), -1) , ".") == 0 ) { $pontoinfo = ""; }
				else { $pontoinfo = "."; }
				
				echo "<li>2 " . $resumo->get_autor2() . $pontoautor . " " . acertaStrings( $resumo->get_titulo2() ) . $pontotitulo . " " . acertaStrings( $resumo->get_info2() ) . $pontoinfo . "</li>";
				$resumo_tex.="\\referencia{2 ".acertaStrings_tex($resumo->get_autor2()) . $pontoautor . " " . acertaStrings_tex( $resumo->get_titulo2() ) . $pontotitulo . " " . acertaStrings_tex( $resumo->get_info2() ) . $pontoinfo ."}\n\n";
			}
			if ( strcmp($resumo->get_autor3(), "") != 0 and strcmp($resumo->get_autor3(), " ") != 0 )
			{
				if ( strcmp(substr($resumo->get_autor3(), -1) , ".") == 0 ) { $pontoautor = ""; }
				else { $pontoautor = "."; }
				if ( strcmp(substr($resumo->get_titulo3(), -1) , ".") == 0 ) { $pontotitulo = ""; }
				else { $pontotitulo = "."; }
				if ( strcmp(substr($resumo->get_info3(), -1) , ".") == 0 ) { $pontoinfo = ""; }
				else { $pontoinfo = "."; }
				
				echo "<li>3 " . $resumo->get_autor3() . $pontoautor . " " . acertaStrings( $resumo->get_titulo3() ) . $pontotitulo . " " . acertaStrings( $resumo->get_info3() ) . $pontoinfo . "</li>";
				$resumo_tex.="\\referencia{3 ".acertaStrings_tex($resumo->get_autor3()) . $pontoautor . " " . acertaStrings_tex( $resumo->get_titulo3() ) . $pontotitulo . " " . acertaStrings_tex( $resumo->get_info3() ) . $pontoinfo ."}\n\n";
			}
			
			echo "</ul></div>";
			$resumo_tex.="\n";
		?>
	</div>
	<?php 
	}
	
	$resumo_tex.="
\end{document}";
	$fp = fopen("./resumos/resumo".$pessoa->get_codigo_pessoa().".tex", "w");
	//$resumo_tex=iconv("UTF-8", "ISO-8859-1", $resumo_tex);
	//$resumo_tex = utf8_encode($resumo_tex);	
	$escreve = fwrite($fp, $resumo_tex);
	fclose($fp);
	?>
