	<?php 

	function imprimeautores($nautores, $codigo_resumo, $cod_autor_principal)
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
					$AxI[$j] = array_search($autor->get_instituicao(), $instituicoes);
				}
				else
				{
					$instituicoes[$ninst] = $autor->get_instituicao();
					$AxI[$j] = $ninst;
					$ninst++;
				}
				
				if ( $cod_autor_principal == $autor->get_codigo_autor() )
				{
					echo "<u>" . $autor->get_nome() . "</u> <sup>(" . $AxI[$j] . ")</sup>";
				}
				else
				{
					echo $autor->get_nome() . " <sup>(" . $AxI[$j] . ")</sup>";
				}
				
				if ( $j != $nautores - 1 )
				{
					echo ", ";
				}
			}
			
			echo "</p>\n";
			
			echo "\t\t<p class=\"instituicao\">";
			
			for ( $j = 0; $j < $ninst; $j++ )
			{
				 echo " <sup>(" . $AxI[$j] . ")</sup> " . $instituicoes[$j] . "<br />";
			}
			
			echo "</p>\n";
		}

	}
	
	function print_keywrds($resumo)
	{
		$str_2print = '';
		
		if ( strcmp($resumo->get_kw1(), '') != 0 )
		{
			$str_2print .= $resumo->get_kw1() . ', ';
		}
		if ( strcmp($resumo->get_kw2(), '') != 0 )
		{
			$str_2print .= $resumo->get_kw2() . ', ';
		}
		if ( strcmp($resumo->get_kw3(), '') != 0 )
		{
			$str_2print .= $resumo->get_kw3();
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
	
	$autor = new Autor();
	$codigo_resumo = $inscricao->get_codigo_resumo();
	$nautores = $autor->numero_autores_by_resumo( $codigo_resumo );
	$cod_autor_principal = $resumo->get_autor_principal();
	
	?>
	
	<br />	
	<br />
	
	<div id="titulo_secao" class='section'>
		Resumo em Português
	</div>

	<div id="resumo">
		
		<?php 
			if ( $inscricao->get_situacao_resumo() == 1 or $inscricao->get_situacao_resumo() == 3 )
			{
				echo "<a href=\"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=incluir&opcao=abstract\" class='resumo'>clique aqui pra editar</a>";
			}
		?>
		
		<p class="titulo"><?php echo $resumo->get_titulo(); ?></p>
		<?php 
			
			imprimeautores($nautores, $codigo_resumo, $cod_autor_principal);
			
		?>
		<p class="email"><?php echo $resumo->get_email(); ?></p>
		<p class="texto"><?php echo $resumo->get_texto(); ?></p>
		<p class="kw">Palavras-chave: <?php echo print_keywrds($resumo); ?></p>
	</div>
	<?php }

	if ( !isset($status_insc[2]) or $status_insc[2] == '0')
	{
	?>

	<br />	
	<div id="titulo_secao" class='section'>
		Versão em inglês do resumo
	</div>

	<div id="resumo">
		<p>Sem versão do resumo em inglês salvo por hora.</p>
	</div>
	<?php
	}
	else
	{
	
	$autor = new Autor();
	$resumoing = new Resumo();
	$resumoing->find_by_codigo($inscricao->get_codigo_resumo_ingles());
	
	
	?>
	
	<br />	
	<div id="titulo_secao" class='section'>
		Versão em inglês do resumo
	</div>
	
	<div id="resumo">
		
		<?php		
			if ( $inscricao->get_situacao_resumo() == 1 or $inscricao->get_situacao_resumo() == 3 )
			{
				if($inscricao->get_codigo_resumo() == 0) 
				{ 
					$icd = "class='closed'";
				}
				else
				{
					$icd = "class='resumo'";
				}
				echo "<a href=\"http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=incluir&opcao=abstract&lng=1\" " . $icd . " >(clique para editar)</a>";
			}
		?>
		
		<p class="titulo"><?php echo $resumoing->get_titulo(); ?></p>
		<?php 
			
			imprimeautores($nautores, $codigo_resumo, $cod_autor_principal);
			
		?>
		<p class="email"><?php echo $resumo->get_email(); ?></p>
		<p class="texto"><?php echo $resumoing->get_texto(); ?></p>
		<p class="kw">Palavras-chave: <?php echo print_keywrds($resumoing); ?></p>
	</div>
	<?php } ?>
