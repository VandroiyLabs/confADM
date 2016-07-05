<div id="content">
<div class="post">
	<div class="content">
	<h2>Livro de Resumos</h2>



	<table>
		<tr>
			<td height="12" colspan="2">Em construção!</td>
		</tr>
	</table>





<?php

//Download do livro de resumos em \(\LaTeX\): &nbsp;&nbsp;&nbsp;<a href="http://sifsc.ifsc.usp.br/adm/pg_participante/livro/livro.zip">Livro.zip</a>
$home = "/home/" . get_current_user() . "/";
include($home . 'public_html/sifsc/adm/pg_participante/inscricao/resumo_tex_versao_1_lingua.php');

$livro_tex =
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
\usepackage{amssymb}
\usepackage{amsmath}

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
%\par\\noindent\\textbf{PG\\theexample. #1}
\addcontentsline{res}{resumo}
%{\protect\\numberline{\\thechapter.\\theresumo}#1}
{\protect {\bf PG\\theresumo \ \BItocsep} {\bf #2} \\\\ #1}
}


% Criando lista de resumos
\\newcommand{\listresumonameic}{{\Large Workshop de Inicia\c{c}\~ao
Cient\'ifica}}
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
%\par\\noindent\\textbf{PG\\theexample. #1}
\addcontentsline{res}{resumo}
%{\protect\\numberline{\\thechapter.\\theresumoing}#1}\par
{\protect {\bf PG\\theresumo \ \BItocsep} {\bf #2} \\\\ #1}

\addcontentsline{resing}{resumoing}
%{\protect\\numberline{\\thechapter.\\theresumoing}#1}\par
{\protect {\bf PG\\theresumo \ \BItocsep} {\bf #3} \\\\ #1}
}

\\newcommand{\listresumoingnamepg}{{\Large Workshop da P\'os-Gradua\c{c}\~ao}}
\\newlistof{resumoingpg}{resingpg}{\listresumoingnamepg}
\\newcommand{\\resumoingpg}[3]{
\\newpage
\\refstepcounter{resumopg}
\\refstepcounter{resumoingpg}
%\par\\noindent\\textbf{PG\\theexample. #1}
\addcontentsline{respg}{resumopg}
%{\protect\\numberline{\\thechapter.\\theresumoing}#1}\par
{\protect {\bf PG\\theresumopg \ \BItocsep} {\bf #2} \\\\ #1}

\addcontentsline{resingpg}{resumoingpg}
%{\protect\\numberline{\\thechapter.\\theresumoing}#1}\par
{\protect {\bf PG\\theresumopg \ \BItocsep} {\bf #3} \\\\ #1}
}

\\newcommand{\listresumoingnameic}{{\Large Workshop de Inicia\c{c}\~ao
Cient\'ifica}}
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
%\\newcommand{\cftsetrmarg}[1]{\@tocrmarg}{#1}}
%\cftsetrmarg{0cm}


%-------------------------------------------
% Definiçoes dos resumos
%
\\newcommand{\superscript}[1]{{\small \ensuremath{^{\\textrm{#1}}}}}
\\newcommand{\subscript}[1]{{\small \ensuremath{_{\\textrm{#1}}}}}

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
\\newcommand{\chamadaing}{{\setlength{\parindent}{0cm} \Huge Lista de resumos em
ingl\^es}}


% margem
\setlength{\oddsidemargin}{-0.8cm}
\setlength{\evensidemargin}{-0.8cm}
\setlength{\\textwidth}{17.8cm}
\setlength{\headwidth}{17.8cm}
\setlength{\\topmargin}{0cm}
\setlength{\headsep}{2cm}
\setlength{\\textheight}{24cm}
\setlength{\marginparwidth}{0cm}


\\newcommand{\secaominicurso}[1]{\cleardoublepage \\newpage \begin{center} {\Huge
\bf #1 } \end{center}}


\begin{document}

% Capa
\includepdf[pages={1}]{capa_livro_2011.pdf}

% Segunda capa
\begin{center}
\huge \bf

Universidade de S\~ao Paulo

Instituto de F\'isica de S\~ao Carlos

\\vfill
SIFSC 4



\\vfill
Caderno de Resumos

\\vfill
S\~ao Carlos

2012

\end{center}

\\newpage

% Informações catalográficas
\cleardoublepage
{
\setlength{\parindent}{0pt}

\\vspace{4cm}

{\bf Universidade de S\~ao Paulo}

\\vspace{0.3cm}
\hspace{-0.3cm}
\begin{tabular}{ p{3cm} p{10cm} }
Reitor & Jo\~ao Grandino Rodas \\\\
Vice-Reitor & Helio Nogueira da Cruz
\end{tabular}

\\vspace{1.5cm}

{\bf Instituto de F\'isica de S\~ao Carlos}

\\vspace{0.3cm}
\hspace{-0.3cm}

\begin{tabular}{ p{3cm} p{10cm} }
Diretor & Antonio Carlos Hernandes \\\\
Vice-Diretor & Vanderlei Salvador Bagnato
\end{tabular}

\\vspace{1.5cm}

{\bf Normalização e revisão – SBI/IFSC}

\\vspace{.5cm}

\begin{tabular}{ p{1cm} p{10cm} }
 & Ana Mara Marques da Cunha Prado \\\\
 & Gracieli B. Pepe Cardoso \\\\
 & Luciana Ap. Brasil Martinez \\\\
 & Maria Cristina Cavarette Dziabas \\\\
 & Maria Neusa de Aguiar Azevedo \\\\
 & Tania Ortin de Almeida \\\\
 & Vilma Del Grossi Coutinho
\end{tabular}

\\vspace{4cm}
Ficha catalogr\'afica

}
\\newpage

\lhead{\includegraphics[scale = 0.25]{logo_sifsc.png} }
\\rhead{\\footnotesize SIFSC 4, 06 a 09 de outubro 2014, S\~ao
Carlos-SP}
\setlength{\\voffset}{-1.5cm}


\secaominicurso{Programa}

\secaominicurso{Minicursos}

Mesas redondas

Exposi\c{c}\~oes

\secaominicurso{Apresenta\c{c}\~ao da SIFSC 4}

\secaominicurso{Apresenta\c{c}\~ao do Workshop de Inicia\c{c}\~ao Cient\'ifica}

\secaominicurso{Apresenta\c{c}\~ao do \\textit{Workshop} do Programa de
P\'os-Gradua\c{c}\~ao em F\'isica do IFSC/USP}

%\cleardoublepage\\newpage

% Tabelas de conteúdo
\selectlanguage{portuguese}
\chamadapt
\listofresumoic
\listofresumopg
\\newpage
%\selectlanguage{english}
%\chamadaing
%\listofresumoingic
%\listofresumoingpg

\\rfoot{\\thepage}
\cleardoublepage \\newpage


";

$evento = new Evento();
$evento->find_evento_aberto();

$inscricao = new Inscricao();
$consulta = $inscricao->find_by_situacao_nivel($evento->get_codigo_evento(),5,'ic');

while ( $row = mysql_fetch_object($consulta) )
{

	$livro_tex.= Resumo_tex($row->codigo_pessoa,$row->codigo_evento);
}

$consulta = $inscricao->find_by_situacao_nivel($evento->get_codigo_evento(),5,'pos');

while ( $row = mysql_fetch_object($consulta) )
{

	$livro_tex.= Resumo_tex($row->codigo_pessoa,$row->codigo_evento);
}

$livro_tex.="


\cleardoublepage \\newpage
\\renewcommand{\\twocolumn}[1][]{#1}
\printindex{authors}{{\'Indice de Autores}}

% Contracapa
\cleardoublepage \\newpage \phantom{} \\newpage
\includepdf[pages={1}]{contracapa_livro_2011.pdf}

\end{document}
";

$fp = fopen("./livro/livro_de_resumos.tex", "w");
$escreve = fwrite($fp, $livro_tex);
fclose($fp);

$zip = new ZipArchive();
$filename = "./livro/livro.zip";

if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
}

$zip->addFile('./livro/livro_de_resumos.tex');
$zip->addFile('./livro/logo_sifsc.png');
$zip->addFile('./livro/sifsc_idxstyle.ist');
$zip->addFile('./livro/makeindex.sh');
$zip->addFile('./livro/capa_livro_2011.pdf');
$zip->addFile('./livro/contracapa_livro_2011.pdf');
$zip->close();

?>


</div>
</div>
</div><!--Content-->
