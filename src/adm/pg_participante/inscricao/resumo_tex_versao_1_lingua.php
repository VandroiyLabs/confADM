	<?php 

	function print_ref($resumo, $i)
	{
		if($i == 1)
		{
			$tipo = $resumo->get_tipo_ref1();
			if ( $tipo == -1 ) { return ""; }
			
			$autor    = $resumo->get_autor1(); 
			$titulo   = $resumo->get_titulo1(); 
			$info     = $resumo->get_info1(); 
		}
		elseif($i == 2)
		{
			$tipo = $resumo->get_tipo_ref2();
			if ( $tipo == -1 ) { return ""; }

			$autor    = $resumo->get_autor2(); 
			$titulo   = $resumo->get_titulo2(); 
			$info     = $resumo->get_info2(); 
		}
		elseif($i == 3)
		{
			$tipo = $resumo->get_tipo_ref3();
			if ( $tipo == -1 ) { return ""; }
			
			$autor    = $resumo->get_autor3(); 
			$titulo   = $resumo->get_titulo3(); 
			$info     = $resumo->get_info3(); 
		}
		
		$info_item = explode("||", $info);
		$referencia_2print = "";  // Starting with list tag + reference id
		
		// Adding author and title, since these are common to all reference types
		$referencia_2print .= $autor . ". ";
		
		
		
		if($tipo == 0)          // === Outros      ===
		{
			
			$referencia_2print .= acertaStrings_tex($titulo) . ". " . acertaStrings_tex($info_item[0]).". ";
			
		}
		elseif($tipo == 1)      // === Periodico   ===
		{
			
			$referencia_2print .= acertaStrings_tex($titulo) . ". " . "\\textbf{".acertaStrings_tex($info_item[0])."}, v. ".acertaStrings_tex($info_item[1]).", ";
			
			if ( strcmp( $info_item[2], "") != 0 )
			{			
				$referencia_2print .= "n. " . acertaStrings_tex($info_item[2]) . ", "; 
			}
			
			$referencia_2print .= "p. ".acertaStrings_tex($info_item[3]).", ".acertaStrings_tex($info_item[4]).". ";
			if ( strcmp( $info_item[5], "") != 0 )
			{
				$referencia_2print .= "doi: " . acertaStrings_tex(str_replace('_', '\_', $info_item[5])) . ".";
			}
			
		}
		elseif($tipo == 2)      // === Livro       ===
		{	
			if(strcmp($info_item[2], "" ) == 0)
			{
				$referencia_2print .= "\\textbf{" . acertaStrings_tex($titulo) . "}";
				if ( strcmp($info_item[3], "") != 0 ) { $referencia_2print .= ": " . acertaStrings_tex($info_item[3]); }
				$referencia_2print .= ". ";
				$referencia_2print .= acertaStrings_tex($info_item[4]) . ": " . acertaStrings_tex($info_item[5]); 
				$referencia_2print .= ", " . acertaStrings_tex($info_item[6]) . ". " . acertaStrings_tex($info_item[7]) . " p. ";
			}
			else
			{
				$referencia_2print = "";
				$referencia_2print .= acertaStrings_tex($info_item[0]) . ". ";
				$referencia_2print .= acertaStrings_tex($info_item[2]) . ". "; 
				$referencia_2print .= "In: " . acertaStrings_tex($autor);
				if ( strcmp($info_item[1],"") != 0 ) {
				$referencia_2print .= " (" . acertaStrings_tex($info_item[1]) . ")";
				}
				$referencia_2print .= ". \\textbf{" . acertaStrings_tex($titulo) . "}";
				if ( strcmp($info_item[3], "") != 0 ) { $referencia_2print .= ": " . acertaStrings_tex($info_item[3]); }
				$referencia_2print .= ". ";
				$referencia_2print .= acertaStrings_tex($info_item[4]) . ": " . acertaStrings_tex($info_item[5]); 
				$referencia_2print .= ", " . acertaStrings_tex($info_item[6]) . ". " . acertaStrings_tex($info_item[7]) . " p. ";
			}
			
			//Verificando se tem ISBN
			if(strcmp($info_item[8], "" ) != 0)
			{
				$str_2print .=". ISBN: ".acertaStrings_tex($info_item[8]);
			}
			
		}
		elseif($tipo == 3)     // === Evento     ===
		{
			
			$referencia_2print .= acertaStrings_tex($titulo) . ". " . "In: " . acertaStrings_tex($info_item[0]) . ", " . acertaStrings_tex($info_item[1]) . ", " . acertaStrings_tex($info_item[2]) . ". ";
			$referencia_2print .= "\\textbf{" . acertaStrings_tex($info_item[3]) . "}... "; 

			if ( strcmp($info_item[4], "") != 0 )
			{
				$referencia_2print .= acertaStrings_tex($info_item[4]);
			}
			if ( strcmp($info_item[4], "") != 0 and strcmp($info_item[5], "") != 0 ) { $referencia_2print .= ": "; }
			if ( strcmp($info_item[5], "") != 0 )
			{
				$referencia_2print .= acertaStrings_tex($info_item[5]);
			}
			
			if ( strcmp($info_item[4], "") != 0 or strcmp($info_item[5], "") != 0 )
			{
				$referencia_2print .= ", ";
			}
			$referencia_2print .= acertaStrings_tex($info_item[6]);
			
			if ( strcmp($info_item[7], "") != 0 )
			{
				$referencia_2print .= ", " . acertaStrings_tex($info_item[7]);
			}
			
			$referencia_2print .= ".";
			
			
		}
		elseif($tipo == 4)     // === Tese       ===
		{
			$referencia_2print .= "\\textbf{" . acertaStrings_tex($titulo).".} ".acertaStrings_tex($info_item[0]).". ".acertaStrings_tex($info_item[1])."p. ".acertaStrings_tex($info_item[2])." (".acertaStrings_tex($info_item[3]).") - ".acertaStrings_tex($info_item[4]).", ".acertaStrings_tex($info_item[5]).", ".acertaStrings_tex($info_item[6]).", ".acertaStrings_tex($info_item[7]) . ". ";
		}
		
		
		$referencia_2print .= "";
		return $referencia_2print;
	}

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

		$texto1 = str_replace('DOIS_SIFROES', '$$', $texto1);
		$texto1 = str_replace('Å', '$AA$', $texto1);	
		$texto1 = str_replace('´', "'", $texto1);		
		$texto1 = str_replace('¹', '$^{1}$', $texto1);
		$texto1 = str_replace('µ', '$\mu$', $texto1);

		$texto1 = str_replace('×', '$\times$', $texto1);

		$texto1 = str_replace('½', '1/2', $texto1);
	
		//$texto1 = str_replace('\_', '_', $texto1);
		$texto1 = str_replace('4_', '4\_', $texto1);
	
		$texto1 = str_replace('±', '$\pm$', $texto1);	

		$texto1 = str_replace('\&', '&', $texto1);	
		$texto1 = str_replace('&', '\&', $texto1);	

		$texto1 = str_replace('de 10^{7} células', 'de 10$^{7}$ células', $texto1);
		$texto1 = str_replace('', '', $texto1);
		$texto1 = str_replace('', '', $texto1);	
		$texto1 = str_replace('', '', $texto1);
		$texto1 = str_replace('de \CO_2\ e s', 'de CO$_2$ e s', $texto1);	
		$texto1 = str_replace('PIV*', 'PIV$\ast$', $texto1);
		$texto1 = str_replace('PII*', 'PII$\ast$', $texto1);

		$texto1 = str_replace('doi:10.1007/978-3-642-12176-0_7', 'doi:10.1007/978-3-642-12176-0\_7', $texto1);
		$texto1 = str_replace('doi:10.1007/1-4020-4789-4_15', 'doi:10.1007/1-4020-4789-4\_15', $texto1);
		$texto1 = str_replace('oi: 10.1007/10_2009_54', 'oi: 10.1007/10\_2009\_54', $texto1);
		$texto1 = str_replace('\textbf{Journal of Statistical Mechanics}: theory and experiment},v', '\textbf{Journal of Statistical Mechanics}: theory and experiment, v', $texto1);
		$texto1 = str_replace('}T. cruzi} has identified', '\textit{T. cruzi} has identified', $texto1);
		$texto1 = str_replace('pET_Trx', 'pET\_Trx', $texto1);
		$texto1 = str_replace('Xcc_1754, Xcc_2404 and Xcc_2895', 'Xcc\_1754, Xcc\_2404 and Xcc\_2895', $texto1);
		$texto1 = str_replace('®', '{\textregistered}', $texto1);
		$texto1 = str_replace('\textregistered', '{\textregistered}', $texto1);
		$texto1 = str_replace('\textsubscript{KPC}', '\subscript{KPC}', $texto1);
		$texto1 = str_replace('¨a', 'ä', $texto1);
		$texto1 = str_replace('ﬁ', 'fi', $texto1);
		$texto1 = str_replace('', 'ff', $texto1);
                

		$texto1 = str_replace('45^{\circ} (1)', '45$^{\circ}$ (1)', $texto1);		
		$texto1 = str_replace(' ', ' ', $texto1);
		$texto1 = str_replace('', '', $texto1);
		$texto1 = str_replace('', '', $texto1);
		$texto1 = str_replace('', '', $texto1);
		
		
		
		
		$finaltexto = str_replace('°','$^{\circ}$', $texto1);
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
			$texto1 = str_replace('$<$arXiv', '$<$\url{arXiv', $texto1);
			$texto1 =  str_replace('$>$', '}$>$', $texto1);
			$finaltexto = str_replace('|n}$>$', 'n$>$', $texto1);		
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

			$email_autor = $resumo->get_email();
			$email_autor = str_replace('\_', '_', $email_autor);
			$email_autor = str_replace('_', '\_', $email_autor);

			$autores_tex.="\emailprincautor{".retiraEspacos($email_autor)."}\n\n";
			
			for ( $j = 1; $j <= $ninst; $j++ )
			{
				$autores_tex.="\instituicao{".$j."}{".acertaStrings_tex(retiraEspacos($instituicoes[$j - 1]))."}\n\n";
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
		return acertaStrings_tex($str_2print);
	}
	
function Resumo_tex($codigoPessoa, $codigoEvento)
{
	$resumo_tex="";

	$inscricao = new Inscricao();
	$inscricao->find_by_pessoa_evento($codigoPessoa, $codigoEvento);
	
	
	$pessoa = new Pessoa(); 
	$pessoa->find_by_codigo( $codigoPessoa );
	
	$resumo = new Resumo(); 
	$resumo->find_by_codigo( $inscricao->get_codigo_resumo() );


	$autor = new Autor();
	$codigo_resumo = $inscricao->get_codigo_resumo();
	$nautores = $autor->numero_autores_by_resumo( $codigo_resumo );
	$cod_autor_principal = $resumo->get_autor_principal();
	
	if ( strcmp( $inscricao->get_nivel(), 'Graduacao') == 0 )
	{
		
		if($resumo->get_lingua() == 1)
		{
			$resumo_tex.= "\\resumoingic{".imprimeautores_tag($resumo, $nautores, $codigo_resumo, $cod_autor_principal)."}{".acertaStrings_tex($resumo->get_titulo())."}{".acertaStrings_tex($resumo->get_titulo())."}\n\n\inicioic\n\n";	
		}
		else
		{
			$resumo_tex.= "\\resumoic{".imprimeautores_tag($resumo, $nautores, $codigo_resumo, $cod_autor_principal)."}{".acertaStrings_tex($resumo->get_titulo())."}\n\n\inicioic\n\n";	
		}	
	}
	else
	{
		
		if($resumo->get_lingua() == 1)
		{
			$resumo_tex.= "\\resumoingpg{".imprimeautores_tag($resumo, $nautores, $codigo_resumo, $cod_autor_principal)."}{".acertaStrings_tex($resumo->get_titulo())."}{".acertaStrings_tex($resumo->get_titulo())."}\n\n\iniciopg\n\n";	
		}
		else
		{
			$resumo_tex.= "\\resumopg{".imprimeautores_tag($resumo, $nautores, $codigo_resumo, $cod_autor_principal)."}{".acertaStrings_tex($resumo->get_titulo())."}\n\n\iniciopg\n\n";	
		}
	}
	
	
	if ($resumo->get_lingua() == 1)
	{
		$resumo_tex.="\selectlanguage{english}\n\\tituloing{".acertaStrings_tex($resumo->get_titulo())."}\n\n";
	}
	else
	{
		$resumo_tex.="\selectlanguage{portuguese}\n\\titulo{".acertaStrings_tex($resumo->get_titulo())."}\n\n";
	}
			
	$resumo_tex.= "\selectlanguage{portuguese}\n".imprimeautores_tex($resumo, $nautores, $codigo_resumo, $cod_autor_principal);
	$resumo_tex.= imprimeautores_index($resumo, $nautores, $codigo_resumo, $cod_autor_principal);		
	
//	$resumo_tex.=$pessoa->get_nome()."\n\n";

	if ($resumo->get_lingua() == 1)
	{
		$resumo_tex.= "\selectlanguage{english}\n\\textoresumo{".acertaStrings_tex($resumo->get_texto())."}\n\n";
		$resumo_tex.= "\palavraschaveing{".print_keywrds_tex($resumo) ."}\n\n";
	}
	else
	{
		$resumo_tex.= "\\textoresumo{".acertaStrings_tex($resumo->get_texto())."}\n\n";
		$resumo_tex.= "\palavraschave{".print_keywrds_tex($resumo)."}\n\n";
	}
	
			
	$resumo_tex.="\selectlanguage{portuguese}\n\\referenciacall\n\n";

	$resumo_tex.="\\referencia{1 ".print_ref($resumo, 1) ."}\n\n";
			
	if ( strcmp( $resumo->get_autor2(), "" ) != 0 and strcmp( $resumo->get_autor2(), " " ) != 0 )
	{
		$resumo_tex.="\\referencia{2 ".print_ref($resumo, 2) ."}\n\n";
	}
	if ( strcmp($resumo->get_autor3(), "") != 0 and strcmp($resumo->get_autor3(), " ") != 0 )
	{				
		$resumo_tex.="\\referencia{3 ".print_ref($resumo, 3) ."}\n\n";
	}
			
	$resumo_tex.="\n%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%\n\n";
	return $resumo_tex;
}

?>

