<?php
			// Serve pra determinar o nome dos formularios pra atualizar
			// o tamanho de camisetas
			$contador = 0;
			
			while ( $row = mysql_fetch_object($consulta) )
			{
				
				$toprint = "<li><div class=\"nome\">";
				if ( $row->codigo_pessoa != 0 )
				{
					$pessoa = new Pessoa();
					$pessoa->find_by_codigo( $row->codigo_pessoa );
					
					//$nomeexp = exlpode(' ', $pessoa->get_nome() );
					
					$toprint .= "<a href=\"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp=" . $pessoa->get_codigo_pessoa() . "\">" . 
								$pessoa->get_nome() . "</a>";
					
					$linkentrega = "http://sifsc.ifsc.usp.br/adm/pg_site/home.php?p1=kits&cp=" . $pessoa->get_codigo_pessoa() . "&opcao=entrega";
					$linkdeleta = "http://sifsc.ifsc.usp.br/adm/pg_site/home.php?p1=kits&cp=" . $pessoa->get_codigo_pessoa() . "&opcao=deleta";
					$hidden = "<input type=\"hidden\" name=\"cp\" value=\"" . $pessoa->get_codigo_pessoa() . "\" />";
				}
				else
				{
					$toprint .= "<a href=\"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=correio&email=" . $row->email . "\">" . $row->nome . "</a>";
					$linkentrega = "http://sifsc.ifsc.usp.br/adm/pg_site/home.php?p1=kits&em=" . $row->email . "&opcao=entrega";
					$linkdeleta = "http://sifsc.ifsc.usp.br/adm/pg_site/home.php?p1=kits&em=" . $row->email . "&opcao=deleta";
					$hidden = "<input type=\"hidden\" name=\"em\" value=\"" . $row->email . "\" />";
				}
				
				$toprint .= "</div>\n<form name=\"formcamiseta" . $contador . "\" method=\"post\" action=\"kits/action/altera_action.php\"><div class=\"camiseta\">Camiseta: ";
				
				$selectcmst = array( 
						'BLPP'   => '',
						'BLP'   => '',
						'BLM' => '',
						'BLG' => '',
						'BLGG' => '',
						'PP'   => '',
						'P'   => '',
						'M' => '',
						'G' => '',
						'GG' => '',
						'EG' => '',
						'EGG' => ''
			          );
				
				$cmst = array('BLPP', 'BLP', 'BLM', 'BLG', 'BLGG', 'PP', 'P', 'M', 'G', 'GG', 'EG', 'EGG');
				
				$toprint .= "<select name=\"camiseta\" style=\"overflow-x:scroll; width:60px;\">\n";
				foreach ( $cmst as $camiseta )
				{
					if ( strcmp( $row->camiseta, $camiseta ) == 0  ) { $selectcmst[$camiseta] = 'selected'; }
					$toprint .= "<option value=\"" . $camiseta . "\" " . $selectcmst[$camiseta] . ">" . $camiseta . "</option>\n";
				}
				$toprint .= "</select>\n";


				$select_tipo_cmst = array( 
				 		'azul' => '',
						'cinza'   => '',			           
						'azul e cinza'   => ''
			          );
				
				$tipo_cmst = array('azul','cinza', 'azul e cinza');
				
				$toprint .= "<select name=\"tipo_camiseta\" style=\"overflow-x:scroll; width:60px;\">\n";
				foreach ( $tipo_cmst as $tipo_camiseta )
				{
					if ( strcmp( $row->tipo_camiseta, $tipo_camiseta ) == 0  ) { $select_tipo_cmst[$tipo_camiseta] = 'selected'; }
					$toprint .= "<option value=\"" . $tipo_camiseta . "\" " . $select_tipo_cmst[$tipo_camiseta] . ">" . $tipo_camiseta . "</option>\n";
				}
				$toprint .= "</select>\n";


				$toprint .= "<a onClick=\"javascript:document.formcamiseta" . $contador++ . ".submit()\">" .
							 $hidden .
							"<img src=\"http://sifsc.ifsc.usp.br/adm/images/VALID.png\" height=\"20px\" /></a></div></form>";
				
				$toprint .= "<div class=\"entregue\">";
				if ( $row->entrega == 0 )
				{
					$toprint .= "<a href=\"" . $linkentrega . "\">Entregar?</a>";
				}
				else
				{
					$toprint .= "Entregue";
				}
				
				$toprint .= "</div><div class=\"deleta\"><a href=\"" . $linkdeleta . "\"><img src=\"http://sifsc.ifsc.usp.br/adm/images/delete_image.gif\" height=\"20px\" /></a></div></li><br /><li><br />&nbsp;</li>\n\n";
				
				echo $toprint;
				
			}
?>
