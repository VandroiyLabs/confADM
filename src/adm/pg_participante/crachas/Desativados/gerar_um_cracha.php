<?php

include "./crachas/Barcode39.php"; 
$zip = new ZipArchive();
$filename = "./crachas/crachas.zip";

if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
}

$saida = "

\documentclass[a4paper, prb, portuguese, twocolumn, nobalancelastpage]{revtex4}

  \usepackage[brazil]{babel}
  \usepackage{amsmath, amssymb, amsfonts, bbm}
  \usepackage[utf8]{inputenc}
  \usepackage[T1]{fontenc}
  \usepackage{lmodern}
  \usepackage[usenames,dvipsnames]{pstricks}
  \usepackage{color}
  \usepackage{subfigure}
  \usepackage{epsfig}
  \usepackage{ifthen}
 

\\renewcommand*\\familydefault{\sfdefault}
\\thispagestyle{empty}
\\newcommand{\makecolor}[1]
{
  \ifthenelse{\equal{#1}{1}}{\color{Blue}}{}
  \ifthenelse{\equal{#1}{2}}{\color{Olivegreen}}{}
  \ifthenelse{\equal{#1}{3}}{\bf \color{Orange}}{}
  \ifthenelse{\equal{#1}{4}}{\color{Red}}{}
  \ifthenelse{\equal{#1}{5}}{\color{black}}{}
}
 
\\newenvironment{cracha}[1]
{
  \begin{minipage}{ 0.5cm }
    %\ifthenelse{\equal{#1}{1}}{\includegraphics[ width = 10.7cm ]{quarta}}{}
    %\ifthenelse{\equal{#1}{2}}{\includegraphics[ width = 10.7cm ]{quinta}}{}
    %\ifthenelse{\equal{#1}{3}}{\includegraphics[ width = 10.7cm ]{sexta}}{}
   % \ifthenelse{\equal{#1}{5}}{\includegraphics[ width = 10.7cm ]{avaliadores}}{}
   % \ifthenelse{\equal{#1}{4}}{\includegraphics[ width = 10.7cm ]{palestrantes}}{}
\ifthenelse{\equal{#1}{6}}{\includegraphics[ width = 9.5cm ]{sifsc2012}}{}
  \end{minipage}
  \begin{minipage}{ 8.5cm }
   
    \\vspace{ 1.99cm }
     \begin{center}
         \Large
	  \ifthenelse{\equal{#1}{1}}{\color{Blue}}{}
	  \ifthenelse{\equal{#1}{2}}{\color{OliveGreen}}{}
	  \ifthenelse{\equal{#1}{3}}{\bf \color{Orange}}{}
	  \ifthenelse{\equal{#1}{4}}{\color{black}}{}
	  \ifthenelse{\equal{#1}{4}}{\color{Red}}{}
         \huge
}
{
   \end{center}                               
  \end{minipage}

}
  \addtolength{\oddsidemargin}{-.66in}
  \addtolength{\evensidemargin}{-.86in}
%   \addtolength{\leftmargin}{-10cm}
  \addtolength{\\textwidth}{.47cm}
 \addtolength{\\topmargin}{-1.2cm}
   \addtolength{\\textheight}{2.8cm}
   
\begin{document}";

$pessoa = new Pessoa();
$evento = new Evento();
if(!isset($_SESSION["evento"]))
{
	$evento->find_evento_aberto();
	$_SESSION["evento"]=$evento();
}
else{
	$evento = $_SESSION["evento"];
} 
$codigo_evento = $evento->get_codigo_evento();

$consulta = $pessoa->find_by_evento_alfabetico($codigo_evento);

while ($row = mysql_fetch_object($consulta)){

	$bc = new Barcode39($row->codigo_pessoa.$codigo_evento); 

	$bc->draw('./crachas/codigos/'.$row->codigo_pessoa.'.png');
	
	$zip->addFile('./crachas/codigos/'.$row->codigo_pessoa.'.png');

	//inicio bloco
	$saida=$saida."
	\begin{cracha}{6}
	$row->nome

	\\vspace{0.3cm}
	\Large \bf \color{Orange}{$row->instituicao}

	\\vspace{0.5cm}
	\includegraphics{./codigos/$row->codigo_pessoa.png}	
	\end{cracha}
	";
	//fim bloco

}

$saida=$saida."\end{document}";

//echo "crachas/teste.tex";
$fp = fopen("crachas/crachas.tex", "w");

$escreve = fwrite($fp, $saida);
fclose($fp);

	$zip->addFile('./crachas/crachas.tex');
	$zip->addFile('./crachas/sifsc2012.png');

$zip->close();


//$result = exec("pdflatex crachas/crachas.tex")or die("It doesn't work");

echo "Crachas gerados com sucesso (<a href='crachas/crachas.zip'>crachas.zip</a>)";
?>
