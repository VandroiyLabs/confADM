<?php
	function acertaStrings( $texto )
	{
		$texto1 = str_replace('<', '&lt;', $texto);
		$texto1 = str_replace('>', '&gt;', $texto1);
		
		$texto1 = str_replace('&lt;b&gt;', '<b>', $texto1);
		$texto1 = str_replace('&lt;/b&gt;', '</b>', $texto1);
		
		$texto1 = str_replace('&lt;i&gt;', '<i>', $texto1);
		$finaltexto = str_replace('&lt;/i&gt;', '</i>', $texto1);
		
		return $finaltexto;
	}
	
	
	function imprimeautores($resumo, $nautores, $codigo_resumo, $cod_autor_principal)
	{
		
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
					$ninst++;
					$AxI[$j] = $ninst;
				}
				
				if ( $cod_autor_principal == $autor->get_codigo_autor() )
				{
					echo "<u>" . $autor->get_nome() . "</u><sup>" . $AxI[$j] . "</sup>";
				}
				else
				{
					echo $autor->get_nome() . "<sup>" . $AxI[$j] . "</sup>";
				}
				
				if ( $j != $nautores - 1 )
				{
					echo "; ";
				}
			}
			
			echo "</p>\n";
			echo "<p class=\"email\">" . $resumo->get_email() . "</p>";
			echo "\t\t<p class=\"instituicao\">";
			
			for ( $j = 1; $j <= $ninst; $j++ )
			{
				 echo " <sup>" . $j . "</sup> " . $instituicoes[$j - 1] . "<br />";
			}
			
			echo "</p>\n";
		}

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
			$str_2print .= $resumo->get_kw3() . '. ';
		}
		
		return $str_2print;
	}
	
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
		$referencia_2print = "<li> " . $i . " ";  // Starting with list tag + reference id
		
		// Adding author and title, since these are common to all reference types
		$referencia_2print .= $autor . ". ";
		
		
		
		if($tipo == 0)          // === Outros      ===
		{
			
			$referencia_2print .= acertaStrings($titulo) . ". " . acertaStrings($info_item[0]).". ";
			
		}
		elseif($tipo == 1)      // === Periodico   ===
		{
			
			$referencia_2print .= acertaStrings($titulo) . ". " . "<b>".acertaStrings($info_item[0])."</b>, v. ".acertaStrings($info_item[1]).", ";
			
			if ( strcmp( $info_item[2], "") != 0 )
			{			
				$referencia_2print .= "n. " . acertaStrings($info_item[2]) . ", "; 
			}
			
			$referencia_2print .= "p. ".acertaStrings($info_item[3]).", ".acertaStrings($info_item[4]).". ";
			if ( strcmp( $info_item[5], "") != 0 )
			{
				$referencia_2print .= "doi: " . acertaStrings($info_item[5]) . ".";
			}
			
		}
		elseif($tipo == 2)      // === Livro       ===
		{	
			if(strcmp($info_item[2], "" ) == 0)
			{
				$referencia_2print .= "<b>" . acertaStrings($titulo) . "</b>";
				if ( strcmp($info_item[3], "") != 0 ) { $referencia_2print .= ": " . acertaStrings($info_item[3]); }
				$referencia_2print .= ". ";
				$referencia_2print .= acertaStrings($info_item[4]) . ": " . acertaStrings($info_item[5]); 
				$referencia_2print .= ", " . acertaStrings($info_item[6]) . ". " . acertaStrings($info_item[7]) . " p. ";
			}
			else
			{
				$referencia_2print = "<li> " . $i . " ";
				$referencia_2print .= acertaStrings($info_item[0]) . ". ";
				$referencia_2print .= acertaStrings($info_item[2]) . ". "; 
				$referencia_2print .= "In: " . acertaStrings($autor);
				if ( strcmp($info_item[1],"") != 0 ) {
				$referencia_2print .= " (" . acertaStrings($info_item[1]) . ")";
				}
				$referencia_2print .= ". <b>" . acertaStrings($titulo) . "</b>";
				if ( strcmp($info_item[3], "") != 0 ) { $referencia_2print .= ": " . acertaStrings($info_item[3]); }
				$referencia_2print .= ". ";
				$referencia_2print .= acertaStrings($info_item[4]) . ": " . acertaStrings($info_item[5]); 
				$referencia_2print .= ", " . acertaStrings($info_item[6]) . ". " . acertaStrings($info_item[7]) . " p. ";
			}
			
			//Verificando se tem ISBN
			if(strcmp($info_item[8], "" ) != 0)
			{
				$str_2print .=". ISBN: ".acertaStrings($info_item[8]);
			}
			
		}
		elseif($tipo == 3)     // === Evento     ===
		{
			
			$referencia_2print .= acertaStrings($titulo) . ". " . "In: " . acertaStrings($info_item[0]) . ", " . acertaStrings($info_item[1]) . ", " . acertaStrings($info_item[2]) . ". ";
			$referencia_2print .= "<b>" . acertaStrings($info_item[3]) . "</b>... "; 

			if ( strcmp($info_item[4], "") != 0 )
			{
				$referencia_2print .= acertaStrings($info_item[4]);
			}
			if ( strcmp($info_item[4], "") != 0 and strcmp($info_item[5], "") != 0 ) { $referencia_2print .= ": "; }
			if ( strcmp($info_item[5], "") != 0 )
			{
				$referencia_2print .= acertaStrings($info_item[5]);
			}
			
			if ( strcmp($info_item[4], "") != 0 or strcmp($info_item[5], "") != 0 )
			{
				$referencia_2print .= ", ";
			}
			$referencia_2print .= acertaStrings($info_item[6]);
			
			if ( strcmp($info_item[7], "") != 0 )
			{
				$referencia_2print .= ", " . acertaStrings($info_item[7]);
			}
			
			$referencia_2print .= ".";
			
			
		}
		elseif($tipo == 4)     // === Tese       ===
		{
			$referencia_2print .= "<b>" . acertaStrings($titulo).".</b> ".acertaStrings($info_item[0]).". ".acertaStrings($info_item[1])."p. ".acertaStrings($info_item[2])." (".acertaStrings($info_item[3]).") - ".acertaStrings($info_item[4]).", ".acertaStrings($info_item[5]).", ".acertaStrings($info_item[6]).", ".acertaStrings($info_item[7]) . ". ";
		}
		
		
		$referencia_2print .= "</li>";
		return $referencia_2print;
	}
		
?>
