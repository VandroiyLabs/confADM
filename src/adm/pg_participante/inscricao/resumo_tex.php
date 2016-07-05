	<?php 
	

	function retiraEspacos($texto)
	{

		
		$string = $texto;
	
		$string = str_replace("          "," ", $string);
		$string = str_replace("         "," ", $string);
		$string = str_replace("        "," ", $string);
		$string = str_replace("       "," ", $string);
		$string = str_replace("      "," ", $string);
		$string = str_replace("     "," ", $string);
		$string = str_replace("    "," ", $string);
		$string = str_replace("   "," ", $string);
		$string = str_replace("  "," ", $string);


		while(substr($string, -1) == " ")
		{
			$string = substr($string, 0, -1);
		}

		while($string{0} == " ")
		{
			$string = substr($string, 1);
		}
	
		return $string;

	}

	function acertaStrings_tex( $texto )
	{
		$texto1 = str_replace("\n"," ", $texto);
		$texto1 = str_replace("\r"," ", $texto1);

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
		
		function acertaUrl_tex( $texto )
		{
			$texto1 = str_replace('$<$ http', '$<$\url{http', $texto);
			$texto1 = str_replace('$<$http', '$<$\url{http', $texto1);
			$texto1 = str_replace('$<$ ftp', '$<$\url{ftp', $texto1);
			$texto1 = str_replace('$<$ftp', '$<$\url{ftp', $texto1);
			$texto1 = str_replace('$<$ www', '$<$\url{www', $texto1);
			$texto1 = str_replace('$<$www', '$<$\url{www', $texto1);
			$finaltexto = str_replace('$>$', '}$>$', $texto1);		
			return $finaltexto;
		}	

	



	function imprimeautores_tex($resumo, $nautores, $codigo_resumo, $cod_autor_principal)
	{
		$autores_tex="\autor{";
		$autor = new Autor();
		
		if ( $nautores > 0 )
		{
			$instituicoes = array();
			$AxI = array();
			$ninst = 0;

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
					$autores_tex.="\underline{".retiraEspacos($autor->get_nome())."}\superscript{".$AxI[$j]."}";
				}
				else
				{
					$autores_tex.=retiraEspacos($autor->get_nome())."\superscript{".$AxI[$j]."}";
				}
				
				if ( $j != $nautores - 1 )
				{
					$autores_tex.="; ";
				}
			}
			$autores_tex.="}\n\n";
			$autores_tex.="\emailprincautor{".retiraEspacos($resumo->get_email())."}\n\n";
			
			for ( $j = 1; $j <= $ninst; $j++ )
			{
				$autores_tex.="\instituicao{".$j."}{".retiraEspacos($instituicoes[$j - 1])."}\n\n";
			}
		}
		$autores_tex = str_replace('\underline{  ','\underline{', $autores_tex);
		$autores_tex = str_replace('\underline{ ','\underline{', $autores_tex);
		$autores_tex = str_replace('  \superscript{','\superscript{', $autores_tex);
		$autores_tex = str_replace('  }\superscript{','}\superscript{', $autores_tex);
		$autores_tex = str_replace(' \superscript{','\superscript{', $autores_tex);
		$autores_tex = str_replace(' }\superscript{','}\superscript{', $autores_tex);

		return $autores_tex;
	}
	
	function imprimeautores_tag($resumo, $nautores, $codigo_resumo, $cod_autor_principal)
	{
		$autores_tex="";
		$autor = new Autor();
		
		if ( $nautores > 0 )
		{
			$instituicoes = array();
			$AxI = array();
			$ninst = 0;

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
				
				
				$autores_tex.=retiraEspacos($autor->get_nome());
				
				
				if ( $j != $nautores - 1 )
				{
					$autores_tex.="; ";
				}
			}			
			
		}
		$autores_tex = acertaStrings_tex($autores_tex);
		return $autores_tex;
	}

	function imprimeautores_index($resumo, $nautores, $codigo_resumo, $cod_autor_principal)
	{
		$autores_tex="";
		$autor = new Autor();
		
		if ( $nautores > 0 )
		{
			$instituicoes = array();
			$AxI = array();
			$ninst = 0;

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
				
				
				$autores_tex.="\index{authors}{".retiraEspacos($autor->get_nome())."}\n";
							
				
			}			
			
		}
		 $autores_tex.="\n";
		 
		 return $autores_tex;
	}


	function print_keywrds_tex($resumo)
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
		$str_2print = acertaStrings_tex($str_2print);
		return $str_2print;
	}
	
function Resumo_tex($codigoPessoa, $codigoEvento)
{
	$resumo_tex="";

	$inscricao = new Inscricao();
	$inscricao->find_by_pessoa_evento($codigoPessoa, $codigoEvento);
	$status_insc = $inscricao->get_modalidade(1,4);
	
	$resumo = new Resumo(); 
	$resumo->find_by_codigo( $inscricao->get_codigo_resumo() );

	
	if ($inscricao->get_codigo_resumo_ingles() != '0')
	{
		$resumoing = new Resumo();
		$resumoing->find_by_codigo($inscricao->get_codigo_resumo_ingles());
	}

	$autor = new Autor();
	$codigo_resumo = $inscricao->get_codigo_resumo();
	$nautores = $autor->numero_autores_by_resumo( $codigo_resumo );
	$cod_autor_principal = $resumo->get_autor_principal();
	
	if ( strcmp( $inscricao->get_nivel(), 'Graduacao') == 0 )
	{
		
		if($inscricao->get_codigo_resumo_ingles() > 0)
		{
			$resumo_tex.= "\\resumoingic{".imprimeautores_tag($resumo, $nautores, $codigo_resumo, $cod_autor_principal)."}{".acertaStrings_tex($resumo->get_titulo())."}{".acertaStrings_tex($resumoing->get_titulo())."}\n\n\inicioic\n\n";	
		}
		else
		{
			$resumo_tex.= "\\resumoic{".imprimeautores_tag($resumo, $nautores, $codigo_resumo, $cod_autor_principal)."}{".acertaStrings_tex($resumo->get_titulo())."}\n\n\inicioic\n\n";	
		}	
	}
	else
	{
		
		if($inscricao->get_codigo_resumo_ingles() > 0)
		{
			$resumo_tex.= "\\resumoingpg{".imprimeautores_tag($resumo, $nautores, $codigo_resumo, $cod_autor_principal)."}{".acertaStrings_tex($resumo->get_titulo())."}{".acertaStrings_tex($resumoing->get_titulo())."}\n\n\iniciopg\n\n";	
		}
		else
		{
			$resumo_tex.= "\\resumopg{".imprimeautores_tag($resumo, $nautores, $codigo_resumo, $cod_autor_principal)."}{".acertaStrings_tex($resumo->get_titulo())."}\n\n\iniciopg\n\n";	
		}
	}
	
	$resumo_tex.="\selectlanguage{portuguese}\n\\titulo{".acertaStrings_tex($resumo->get_titulo())."}\n\n";
	if ( isset( $resumoing ) )
	{
		$resumo_tex.="\selectlanguage{english}\n\\tituloing{".acertaStrings_tex($resumoing->get_titulo())."}\n\n";
	}
			
	$resumo_tex.= "\selectlanguage{portuguese}\n".imprimeautores_tex($resumo, $nautores, $codigo_resumo, $cod_autor_principal);
	$resumo_tex.= imprimeautores_index($resumo, $nautores, $codigo_resumo, $cod_autor_principal);		
	
	$resumo_tex.= "\\textoresumo{".acertaStrings_tex($resumo->get_texto())."}\n\n";
	$resumo_tex.= "\palavraschave{".print_keywrds_tex($resumo)."}\n\n";

	if ( isset($resumoing) )
	{
		$resumo_tex.= "\selectlanguage{english}\n\\textoresumo{".acertaStrings_tex($resumoing->get_texto())."}\n\n";
		$resumo_tex.= "\palavraschaveing{".print_keywrds_tex($resumoing) ."}\n\n";
	}
			
	$resumo_tex.="\selectlanguage{portuguese}\n\\referenciacall\n\n";

	if ( strcmp(substr($resumo->get_autor1(), -1) , ".") == 0 ) { $pontoautor = ""; }
	else { $pontoautor = "."; }
	if ( strcmp(substr($resumo->get_titulo1(), -1) , ".") == 0 ) { $pontotitulo = ""; }
	else { $pontotitulo = "."; }
	if ( strcmp(substr($resumo->get_info1(), -1) , ".") == 0 ) { $pontoinfo = ""; }
	else { $pontoinfo = "."; }
			
	$resumo_tex.="\\referencia{1 ".acertaStrings_tex($resumo->get_autor1()) . $pontoautor . " " . acertaUrl_tex(acertaStrings_tex( $resumo->get_titulo1() )) . $pontotitulo . " " . acertaUrl_tex(acertaStrings_tex( $resumo->get_info1() )) . $pontoinfo ."}\n\n";
			
	if ( strcmp( $resumo->get_autor2(), "" ) != 0 and strcmp( $resumo->get_autor2(), " " ) != 0 )
	{
		if ( strcmp(substr($resumo->get_autor2(), -1) , ".") == 0 ) { $pontoautor = ""; }
		else { $pontoautor = "."; }
		if ( strcmp(substr($resumo->get_titulo2(), -1) , ".") == 0 ) { $pontotitulo = ""; }
		else { $pontotitulo = "."; }
		if ( strcmp(substr($resumo->get_info2(), -1) , ".") == 0 ) { $pontoinfo = ""; }
		else { $pontoinfo = "."; }
				
		$resumo_tex.="\\referencia{2 ".acertaStrings_tex($resumo->get_autor2()) . $pontoautor . " " . acertaUrl_tex(acertaStrings_tex( $resumo->get_titulo2() )) . $pontotitulo . " " . acertaUrl_tex(acertaStrings_tex( $resumo->get_info2() )) . $pontoinfo ."}\n\n";
	}
	if ( strcmp($resumo->get_autor3(), "") != 0 and strcmp($resumo->get_autor3(), " ") != 0 )
	{
		if ( strcmp(substr($resumo->get_autor3(), -1) , ".") == 0 ) { $pontoautor = ""; }
		else { $pontoautor = "."; }
		if ( strcmp(substr($resumo->get_titulo3(), -1) , ".") == 0 ) { $pontotitulo = ""; }
		else { $pontotitulo = "."; }
		if ( strcmp(substr($resumo->get_info3(), -1) , ".") == 0 ) { $pontoinfo = ""; }
		else { $pontoinfo = "."; }
		
		$resumo_tex.="\\referencia{3 ".acertaStrings_tex($resumo->get_autor3()) . $pontoautor . " " . acertaUrl_tex(acertaStrings_tex( $resumo->get_titulo3() )) . $pontotitulo . " " . acertaUrl_tex(acertaStrings_tex( $resumo->get_info3() ) ). $pontoinfo ."}\n\n";
	}
			
	$resumo_tex.="\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n";
	return $resumo_tex;
}
?>

