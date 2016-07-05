<?php


$zip = new ZipArchive();
$filename = "./crachas/crachas_avaliadores.zip";


if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
}

$saida = "\documentclass[a4paper, prb, portuguese, nobalancelastpage]{pacotes_tex/revtex4-1}

\usepackage[brazil]{babel}
\usepackage{amsmath, amssymb, amsfonts}
\usepackage{multirow}
\usepackage{color}
%\usepackage{colortbl}
\usepackage[latin1]{inputenc}
\usepackage[T1]{fontenc}
\usepackage{lmodern}
\usepackage{subfigure}
\usepackage{epsfig}
\usepackage{ifthen}
\usepackage{pst-barcode,pstricks-add}
\usepackage{pstricks}
\usepackage[pspdf={-dNOSAFER -dAutoRotatePages=/None}, crop=off]{auto-pst-pdf}
 
\definecolor{LightGray}{gray}{.8}
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
 
\\newenvironment{cracha}[8]
{
\begin{minipage}[t]{11.5cm}
 \\vspace{0cm}
  \hspace{-0.3cm}
 \begin{minipage}{ 0.1cm }
      \includegraphics[ width = 11.5 cm ]{arte/frente.png}
  \end{minipage}
  \begin{minipage}[t]{11cm}
     
      \\vspace{-3.42cm}
      \hspace{9.1cm}
    \begin{minipage}[t]{4.5cm}
        \details{\phantom{.}#1}
    \end{minipage}
   
      \hspace{9.1cm}
    \begin{minipage}[t]{4cm}
        \\vspace{.095cm}
        \details{\phantom{.}#2}
    \end{minipage}
   
      \hspace{9.1cm}
    \begin{minipage}[t]{4cm}
        \\vspace{.01cm}
        \details{\phantom{.}#3}
    \end{minipage}
   
      \hspace{9cm}
    \begin{minipage}[t]{4cm}
        \\vspace{.2cm}
        \details{\phantom{.}#4}
    \end{minipage}
     
      \\vspace{1.1cm}
      \hspace{7.95cm}
      \begin{minipage}{ 2cm }
          \\vspace{-1.20cm}
          \begin{flushright}
               \begin{pspicture}(1.9cm,1.9cm)
                \psbarcode{#5}{eclevel=H encoding=alphanumeric width=0.748 height=0.748}{qrcode}
              \end{pspicture}
          \end{flushright}
      \end{minipage}
     
      \\vspace{0.3cm}
      \begin{minipage}{10cm}
          \\vspace{.05cm}
        \hspace{1.2cm}
        \\nome{\phantom{.}#6 }
      \end{minipage}
      \begin{minipage}{10.5cm}
          \\vspace{0.7cm}
        \hspace{2.8cm}
        \\titulo{\phantom{(} #7}
      \end{minipage}
      \begin{minipage}{10cm}
          \\vspace{.6cm}
        \hspace{2.5cm}
        \\titulo{\phantom{(} #8}
      \end{minipage}
  \end{minipage}

}
{
\end{minipage}}


\usepackage[landscape, top=.2cm, bottom=.8cm, left=.1cm, right=.1cm]{geometry}


\\newcommand{\details}{\\normalsize}
\\newcommand{\\nome}{\Large}
\\newcommand{\\titulo}{\large}


\definecolor{azulsifsc}{RGB}{49,63,129}


\begin{document}
	";
$avaliador = new Avaliador();
$evento = new Evento();
$evento->find_evento_aberto();
$_SESSION["evento"]=$evento;

$codigo_evento = $evento->get_codigo_evento();

$consulta = $avaliador->find_all_by_evento($codigo_evento);
$count=0;
$extras=40; $nome_minicurso="";
while ($row = mysql_fetch_object($consulta)){

/*	$bc = new Barcode39("A".$row->codigo_avaliador."-".$codigo_evento); 

	$bc->draw('./crachas/codigos_avaliadores/A'.$row->codigo_avaliador.'-'.$codigo_evento.'.png');

	$zip->addFile('./crachas/codigos_avaliadores/A'.$row->codigo_avaliador.'-'.$codigo_evento.'.png');*/

	$codigo = "AVALIADOR";
		
	//$codigo.=$row->codigo_avaliador;
	$camiseta="NÃO"; $painel="NÃO"; $dia="";

	$nome = explode(' ',$row->nome );
	$max = sizeof($nome);
	if($max > 2)
	{
		$nome = $nome[0]." ".$nome[$max-2]." ".$nome[$max-1];
	}
	else
	{
		$nome = $nome[0]." ".$nome[$max-1];
	}
	
	$nome = explode(' ',$row->nome );
	$max = sizeof($nome);
	if($max > 3)
	{
		$nome = $nome[0]." ".$nome[$max-3]." ".$nome[$max-2]." ".$nome[$max-1];
	}
	else
	$nome = $row->nome;
	

	$count++;
	if($count%2 == 1)
	$saida.="\\vspace{0cm}";
	else
	$saida.="\\hspace{1.0cm}";

	$cracha= "	
	\begin{cracha}{ $camiseta }{ $convocado $diaoral }{ $painel $dia }{ }{ZZ}{  $nome }{ $codigo}{ $nome_minicurso }
	\end{cracha}
	"; 
	$saida.=str_replace('’','\'',$cracha); 
	if($count%2 == 0)
	$saida.="
	";	

}

$extras=49;
while ($extras > 0){

	/*$bc = new Barcode39("P-".$codigo_evento); 

	$bc->draw('./crachas/codigos_avaliadores/P-'.$codigo_evento.'.png');
	
	$zip->addFile('./crachas/codigos_avaliadores/P-'.$codigo_evento.'.png');*/

	$codigo = " ";
		
	
	

	$nome = "";

	$count++;
	if($count%2 == 1)
	$saida.="\\vspace{0cm}";
	else
	$saida.="\\hspace{1.0cm}";
	$titulo="";
	
	$cracha= "	
	\begin{cracha}{ $camiseta }{ $convocado $diaoral }{ $painel $dia }{  }{ZZ}{ $codigo $nome }{ $titulo}{ $nome_minicurso }
	\end{cracha}
	"; 
	$saida.=str_replace('’','\'',$cracha); 
	if($count%2 == 0)
	$saida.="
	";	
	$extras--;
}
$saida=$saida."
\end{document}";

//echo "crachas/teste.tex";
$fp = fopen("crachas/crachas_avaliadores.tex", "w");

$saida=iconv("UTF-8", "ISO-8859-1", $saida);
$escreve = fwrite($fp, $saida);
fclose($fp);

	$zip->addFile('./crachas/crachas_avaliadores.tex');
	$zip->addFile('./crachas/pacotes_tex/aip4-1.rtx');
	$zip->addFile('./crachas/pacotes_tex/aps12pt4-1.rtx');
	$zip->addFile('./crachas/pacotes_tex/ltxdocext.sty');
	$zip->addFile('./crachas/pacotes_tex/ltxutil.sty');
	$zip->addFile('./crachas/pacotes_tex/revtex4-1.cls');
	$zip->addFile('./crachas/pacotes_tex/aps10pt4-1.rtx');
	$zip->addFile('./crachas/pacotes_tex/aps4-1.rtx');
	$zip->addFile('./crachas/pacotes_tex/ltxfront.sty');
	$zip->addFile('./crachas/pacotes_tex/reftest4-1.tex');
	$zip->addFile('./crachas/pacotes_tex/aps11pt4-1.rtx');
	$zip->addFile('./crachas/pacotes_tex/apsrmp4-1.rtx');
	$zip->addFile('./crachas/pacotes_tex/ltxgrid.sty');
	$zip->addFile('./crachas/pacotes_tex/revsymb4-1.sty');
	$zip->addFile('./crachas/arte/frente.png');

$zip->close();


//$result = exec("pdflatex crachas/crachas.tex")or die("It doesn't work");

echo "<br /><br />Crachas gerados com sucesso (<a href='crachas/crachas_avaliadores.zip'>crachas_avaliadores.zip</a>)";
?>
