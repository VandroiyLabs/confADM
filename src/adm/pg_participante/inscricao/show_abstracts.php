	<?php
	$home = "/home/" . get_current_user() . "/";
	include($home . 'public_html/sifsc/adm/pg_participante/inscricao/resumo_tex.php');
	require_once($home . "public_html/sifsc/user/classes/show_resumo_functions.php");
	$status_insc = $inscricao->get_modalidade(1,4);

	if ( !isset($status_insc[1]) or $status_insc[1] == '0')
	{
		//
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

	<div id="titulo_secao" class='section'>
		Resumo do participante.
	</div>
	o número do código é provisório, assim que for definida a regra para ordenamento implementaremos o código oficial
	<div id="resumo">

		<?php

			if ( strcmp( $inscricao->get_nivel(), 'Graduacao') == 0 )
			{
				$codigoresumo = "IC" . $pessoa->get_codigo_pessoa();

			}
			elseif ( strcmp( $inscricao->get_nivel(), 'Doutorado') == 0 or strcmp( $inscricao->get_nivel(), 'Mestrado') == 0 )
			{
				$codigoresumo = "PG" . $pessoa->get_codigo_pessoa();

			}
			else
			{
				$codigoresumo = "OT" . $pessoa->get_codigo_pessoa();
			}
			echo "<p class=\"codigo\">Tempo de trabalho: " . $resumo->get_tempo() . " meses.</p>";
			echo "<p class=\"codigo\">" . $codigoresumo . "</p>";
			echo "<p class=\"titulo\">" . acertaStrings( $resumo->get_titulo() ) . "</p>";



			if ( isset( $resumoing ) )
			{
				echo "<p class=\"titulo\">" . acertaStrings( $resumoing->get_titulo() ) . "</p>";

			}
			imprimeautores($resumo, $nautores, $codigo_resumo, $cod_autor_principal);


			$textodoresumo = $resumo->get_texto();
			$textodoresumo = acertaStrings( $textodoresumo );


			$testedoresumo = str_replace("\(", "<font style=\"color:#00C;\">C7712b00bs1", $textodoresumo);
			$testedoresumo = str_replace("\)", "C7712b00bs2</font>", $testedoresumo);
			$testedoresumo = str_replace("C7712b00bs1", "\(\backslash(\)", $testedoresumo);
			$testedoresumo_alterado = str_replace("C7712b00bs2", "\(\backslash)\)", $testedoresumo);

			echo "<p class=\"texto\">" . $testedoresumo_alterado . "</p>";
			$explodido = explode(" ", str_replace("  ", " ", $resumo->get_texto()) );
			echo "<p class=\"kw\">Contagem de palavras: " . sizeof($explodido) . "</p>";
			echo "<p class=\"kw\"><b>Palavras-chave:</b> " .  print_keywrds($resumo) . "</p>";


			if ( isset($resumoing) )
			{
				echo "<br />";

				$textodoresumo = $resumoing->get_texto();
				$textodoresumo = acertaStrings( $textodoresumo );


				$testedoresumo = str_replace("\(", "<font style=\"color:#00C;\">C7712b00bs1", $textodoresumo);
				$testedoresumo = str_replace("\)", "C7712b00bs2</font>", $testedoresumo);
				$testedoresumo = str_replace("C7712b00bs1", "\(\backslash(\)", $testedoresumo);
				$testedoresumo_alterado = str_replace("C7712b00bs2", "\(\backslash)\)", $testedoresumo);

				echo "<p class=\"texto\">" . $testedoresumo_alterado . "</p>";
				echo "<p class=\"kw\"><b>Keywords:</b> " . print_keywrds($resumoing) . "</p>";

			}



			echo "<br /><p class=\"kw\"><b>Referências:</b></p>";

			echo "<div id='referencias'><ul>";


			echo print_ref($resumo, 1);
			echo print_ref($resumo, 2);
			echo print_ref($resumo, 3);

			echo "</ul></div>";

		?>
	</div>
	<?php
	}


$resumo_tex =
"\documentclass[12pt, a4paper, twoside,openright]{report}

%-------------------------------------------
% Pacotes
%
\usepackage{tocloft}
\usepackage[portuguese,english]{babel}
\usepackage{pdfpages}
\usepackage{multicol}
\usepackage[utf8]{inputenc}
\usepackage[hyphens]{url}

% Indice de autores
\usepackage{multind}
\makeindex{authors}


% Cabeçalho
\usepackage{fancyhdr}
\pagestyle{fancy}
\\fancyhead{}
\\fancyfoot{}
\\renewcommand{\headrulewidth}{0pt}

\\renewcommand{\\familydefault}{\sfdefault}


%-------------------------------------------
% Criando lista de resumos
%
\\newcommand{\BItocsep}{-}
\\newcommand{\listresumoname}{Lista de Resumos}
\\newlistof{resumo}{res}{\listresumoname}
\\newcommand{\\resumo}[2]{
\\newpage
\\refstepcounter{resumo}
\addcontentsline{res}{resumo}
{\protect {\bf PG\\theresumo \ \BItocsep} {\bf #2} \\\\ #1}
}

% Criando lista de resumos
\\newcommand{\listresumonameic}{{\Large Workshop de Inicia\c{c}\~ao Cient\'ifica}}
\\newlistof{resumoic}{resic}{\listresumonameic}
\\newcommand{\\resumoic}[2]{
\\newpage
\\refstepcounter{resumoic}
\addcontentsline{resic}{resumoic}
{\protect {\bf IC\\theresumoic \ \BItocsep} {\bf #2} \\\\ #1}
}

\\newcommand{\listresumonamepg}{{\Large Workshop da P\'os-Gradua\c{c}\~ao}}
\\newlistof{resumopg}{respg}{\listresumonamepg}
\\newcommand{\\resumopg}[2]{
\\newpage
\\refstepcounter{resumopg}
\addcontentsline{respg}{resumopg}
{\protect {\bf PG\\theresumopg \ \BItocsep} {\bf #2} \\\\ #1}
}

\\newcommand{\listresumoingname}{Lista de Resumos em Ingl\^es}
\\newlistof{resumoing}{resing}{\listresumoingname}
\\newcommand{\\resumoing}[3]{
\\newpage
\\refstepcounter{resumo}
\\refstepcounter{resumoing}
\addcontentsline{res}{resumo}
{\protect {\bf PG\\theresumo \ \BItocsep} {\bf #2} \\\\ #1}

\addcontentsline{resing}{resumoing}
{\protect {\bf PG\theresumo \ \BItocsep} {\bf #3} \\\\ #1}
}

\\newcommand{\listresumoingnamepg}{{\Large Workshop da P\'os-Gradua\c{c}\~ao}}
\\newlistof{resumoingpg}{resingpg}{\listresumoingnamepg}
\\newcommand{\\resumoingpg}[3]{
\\newpage
\\refstepcounter{resumopg}
\\refstepcounter{resumoingpg}
\addcontentsline{respg}{resumopg}
{\protect {\bf PG\\theresumopg \ \BItocsep} {\bf #2} \\\\ #1}

\addcontentsline{resingpg}{resumoingpg}
{\protect {\bf PG\\theresumopg \ \BItocsep} {\bf #3} \\\\ #1}
}

\\newcommand{\listresumoingnameic}{{\Large Workshop de Inicia\c{c}\~ao Cient\'ifica}}
\\newlistof{resumoingic}{resingic}{\listresumoingnameic}
\\newcommand{\\resumoingic}[3]{
\\newpage
\\refstepcounter{resumoic}
\\refstepcounter{resumoingic}
\addcontentsline{resic}{resumoic}
{\protect {\bf IC\\theresumoic \ \BItocsep} {\bf #2} \\\\ #1}

\addcontentsline{resingic}{resumoingic}
{\protect {\bf IC\\theresumoic \ \BItocsep} {\bf #3} \\\\ #1}
}

% Usando padrões da biblioteca
\setlength{\cftbeforeresumoicskip}{.6cm}
\setlength{\cftbeforeresumopgskip}{.6cm}
\setlength{\cftbeforeresumoingicskip}{.6cm}
\setlength{\cftbeforeresumoingpgskip}{.6cm}
\\renewcommand{\cftresumoicdotsep}{0.5}
\\renewcommand{\cftresumopgdotsep}{0.5}
\\renewcommand{\cftresumoingicdotsep}{0.5}
\\renewcommand{\cftresumoingpgdotsep}{0.5}
\cftsetindents{resumoic}{0em}{0em}
\cftsetindents{resumopg}{0em}{0em}
\cftsetindents{resumoingic}{0cm}{0cm}
\cftsetindents{resumoingpg}{0cm}{0cm}



%-------------------------------------------
% Definiçõe dos resumos
%
\\newcommand{\superscript}[1]{{\small \ensuremath{^{\\textrm{#1}}}}}

\\newcommand{\\titulo}[1]{\\vspace{0.3cm} {\bf \Large #1 } }
\\newcommand{\\tituloing}[1]{\\vspace{0.3cm} {\bf \Large #1 } }

\\newcommand{\autor}[1]{\\vspace{0.5cm} #1}

\\newcommand{\emailprincautor}[1]{\\vspace{0.1cm} {\small #1}}

\\newcommand{\instituicao}[2]{\\vspace{-0.3cm} \phantom{}\superscript{#1}#2}

\\newcommand{\\textoresumo}[1]{\\vspace{0.6cm}\\vspace{0.5cm} #1}
\\newcommand{\\textoresumoing}[1]{\\vspace{0.6cm} #1}

\\newcommand{\palavraschave}[1]{\\vspace{0.3cm} {\bf Palavras-chave:} #1}
\\newcommand{\palavraschaveing}[1]{\\vspace{0.3cm} {\bf Keywords:} #1}

\\newcommand{\\referencia}[1]{\\vspace{0.2cm} #1}

\\newcommand{\\referenciacall}{\\vspace{0.3cm} {\bf Refer\^encias:}}

\\newcommand{\inicioic}{\setlength{\parindent}{0cm} {\bf \Large IC\\theresumoic} }
\\newcommand{\iniciopg}{\setlength{\parindent}{0cm} {\bf \Large PG\\theresumopg} }

\\newcommand{\chamadapt}{{\setlength{\parindent}{0cm} \Huge Lista de resumos}}
\\newcommand{\chamadaing}{{\setlength{\parindent}{0cm} \Huge Lista de resumos em ingl\^es}}


% margem
\setlength{\oddsidemargin}{-0.8cm}
\setlength{\evensidemargin}{-0.8cm}
\setlength{\\textwidth}{17.8cm}
\setlength{\headwidth}{17.8cm}
\setlength{\\topmargin}{0cm}
\setlength{\headsep}{2cm}
\setlength{\\textheight}{24cm}
\setlength{\marginparwidth}{0cm}


\\newcommand{\secaominicurso}[1]{\cleardoublepage \\newpage \begin{center} {\Huge \bf #1 } \end{center}}

\begin{document}

\lhead{\includegraphics[scale = 0.25]{logo_sifsc.png} }
\\rhead{\\footnotesize SIFSC 3, 30 de setembro a 4 de outubro de 2013, S\~ao Carlos-SP}
\setlength{\\voffset}{-1.5cm}

";
	$resumo_tex.=Resumo_tex($inscricao->get_codigo_pessoa(),$inscricao->get_codigo_evento());
	$resumo_tex.="
\end{document}";
	$fp = fopen("./resumos/resumo".$pessoa->get_codigo_pessoa().".tex", "w");
	$escreve = fwrite($fp, $resumo_tex);
	fclose($fp);
	?>
