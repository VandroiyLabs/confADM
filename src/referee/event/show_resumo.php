<?php
$home = "/home/" . get_current_user() . "/";
require_once($home . "public_html/sifsc/user/classes/show_resumo_functions.php");

$status_insc = $inscricao->get_modalidade();

if ( !isset($status_insc[1]) or $status_insc[1] == '0')
{

}
else
{

$resumo = new Resumo();
$resumo->find_by_codigo( $inscricao->get_codigo_resumo() );

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


<div id="resumo">

	<?php

		if ( strcmp( $inscricao->get_nivel(), 'Graduacao') == 0 )
		{
			$codigoresumo = "IC" . $inscricao->get_codigo_pessoa();
			$nivel = "Nível: Iniciação Científica";
		}
		elseif ( strcmp( $inscricao->get_nivel(), 'Doutorado') == 0 or strcmp( $inscricao->get_nivel(), 'Mestrado') == 0 )
		{
			$codigoresumo = "PG" . $inscricao->get_codigo_pessoa();

			$nivel = "Nível: ".$inscricao->get_nivel();
		}
		else
		{
			$codigoresumo = "OT" . $inscricao->get_codigo_pessoa();
		}
		echo "<p class=\"destaque\">" . $nivel . "</p>";
		echo "<p class=\"destaque\"> Tempo de trabalho no projeto: " . $resumo->get_tempo(). " meses<br /></p>";

		echo "<p class=\"titulo\">" . acertaStrings( $resumo->get_titulo() ) . "</p>";

		if ( isset( $resumoing ) )
		{
			echo "<p class=\"titulo\">" . acertaStrings( $resumoing->get_titulo() ) . "</p>";
		}


		echo "<p class=\"texto\">" . acertaStrings( $resumo->get_texto() ) . "</p>";
		echo "<p class=\"kw\"><b>Palavras-chave:</b> " .  print_keywrds($resumo) . "</p>";

		if ( isset($resumoing) )
		{

			echo "<br />";
			echo "<p class=\"texto\">" . acertaStrings( $resumoing->get_texto() ) . "</p>";
			echo "<p class=\"kw\"><b>Keywords:</b> " . print_keywrds($resumoing) . "</p>";
		}

		echo "<br /><p class=\"referencias\"><b>Referências:</b></p>";

		echo "<div id='referencias'><ul>";


		echo print_ref($resumo, 1);
		echo print_ref($resumo, 2);
		echo print_ref($resumo, 3);

		echo "</ul></div>";
	?>
</div>
<?php
	}
?>
