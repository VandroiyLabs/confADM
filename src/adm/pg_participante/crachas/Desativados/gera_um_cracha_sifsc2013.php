<?php

$zip = new ZipArchive();
$filename = "./crachas/crachas_extras.zip";





if ($zip->open($filename, ZIPARCHIVE::CREATE)!==TRUE) {
    exit("cannot open <$filename>\n");
}

$saida = "\documentclass[a4paper, prb, portuguese, nobalancelastpage]{revtex4-1}

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
\begin{minipage}[t]{13.4cm}
 \\vspace{0.1cm}
  \hspace{-0.3cm}
 \begin{minipage}{ 0.1cm }
  	\includegraphics[ width = 14.5 	cm ]{arte/frente.png}
  \end{minipage}
  \begin{minipage}[t]{13cm}
  	
  	\\vspace{-4.2cm}
  	\hspace{11cm}
	\begin{minipage}[t]{4cm}
		\details{\phantom{.}#1}
	\end{minipage}
	
  	\hspace{11cm}
	\begin{minipage}[t]{4cm}
		\\vspace{.2cm}
		\details{\phantom{.}#2}
	\end{minipage}
	
  	\hspace{11cm}
	\begin{minipage}[t]{4cm}
		\\vspace{.15cm}
		\details{\phantom{.}#3}
	\end{minipage}
	
  	\hspace{11cm}
	\begin{minipage}[t]{4cm}
		\\vspace{.2cm}
		\details{\phantom{.}#4}
	\end{minipage}
  	
  	\\vspace{1.55cm}
  	\hspace{9.35cm}
  	\begin{minipage}{ 2cm }
  		\\vspace{-1.15cm}
	  	\begin{flushright}
  			\includegraphics[ scale = 1 ]{#5}
	  	\end{flushright}
	  \end{minipage}
	  
	  \\vspace{0.65cm}
	  \begin{minipage}{14cm}
		\hspace{1.6cm}
		\\nome{\phantom{.}#6 }
	  \end{minipage}
	  \begin{minipage}{15cm}
	  	\\vspace{0.9cm}
		\hspace{3.2cm}
		\\titulo{\phantom{(}#7}
	  \end{minipage}
	  \begin{minipage}{15cm}
	  	\\vspace{.8cm}
		\hspace{2.8cm}
		\\titulo{\phantom{(}#8}
	  \end{minipage}
  \end{minipage}

}
{
\end{minipage}}


\usepackage[landscape, top=.2cm, bottom=.8cm, left=.1cm, right=.1cm]{geometry}


\\newcommand{\details}{\\normalsize}
\\newcommand{\\nome}{\Large}
\\newcommand{\\titulo}{\Large}


\definecolor{azulsifsc}{RGB}{49,63,129}


\begin{document}
	";

$pessoa = new Pessoa();
$evento = new Evento();
$participa_minicurso = new ParticipaMinicurso();
$avalia_poster = new AvaliaPoster();
$minicurso = new Minicurso();
$kit = new Kits();
$participa_premiacao = new ParticipaPremiacao();


$salasminicuros = array(
12 => "Aud. Masc. (IFSC)",
14 => "Aud. Caron (EESC)",
13 => "Anfiverde (IFSC)",
11 => "Anfiazul (IFSC)",
15 => "F-146 (IFSC)",
16 => "F-147 (IFSC)",
10 => "F-149 (IFSC)"
);

$evento->find_evento_aberto();
$_SESSION["evento"]=$evento;
 
$codigo_evento = $evento->get_codigo_evento();
//$filtro = " and Inscricao.modalidade LIKE '0%' and Pessoa.nome = ''";
$filtro = " and  Pessoa.codigo_pessoa = 549 ";

$consulta = $pessoa->find_by_evento_alfabetico($codigo_evento,$filtro);
$count=0;
while ($row = mysql_fetch_object($consulta)){

	$bc = new Barcode39($row->codigo_pessoa."-".$codigo_evento); 

	$bc->draw('./crachas/codigos/'.$row->codigo_pessoa.'-'.$codigo_evento.'.png');
	
	$zip->addFile('./crachas/codigos/'.$row->codigo_pessoa.'-'.$codigo_evento.'.png');

	if($kit->find_by_codigo_pessoa($row->codigo_pessoa,$codigo_evento))
	{
		if($kit->get_tipo_camiseta() == 'azul')
		$tipo = 'A';
		elseif($kit->get_tipo_camiseta() == 'cinza')
		$tipo = 'C';
		else
		$tipo = 'AC';

		$camiseta = $kit->get_camiseta()." - ".$tipo;
	}
	else
		$camiseta = "NÃO";


	if($row->codigo_arte != 0)
		$arte = "SIM";
	else
		$arte = "NÃO";

	if($participa_minicurso->find_by_codigo($row->codigo_pessoa,$codigo_evento))
	{
		$minicurso->find_by_codigo($participa_minicurso->get_codigo_minicurso());
		$nome_minicurso = encurta_titulo($minicurso->get_titulo(), 43);
		//$nome_minicurso .= " -- Sala: " . $salasminicuros[$participa_minicurso->get_codigo_minicurso()];
	}
	else
		$nome_minicurso = "";
	
	if($row->nivel == 'Mestrado' or $row->nivel == 'Doutorado')
		$codigo="PG";
	elseif($row->nivel == 'Graduacao')
		$codigo = "GR";
	else
		$codigo = "OT";
		
		$codigo.=$row->codigo_pessoa;

	if($row->situacao_resumo == 5 )
	{
		if($row->nivel == 'Mestrado' or $row->nivel == 'Doutorado')
			$painel="PG";
		elseif($row->nivel == 'Graduacao')
			$painel = "GR";
		else
			$painel = "OT";
		
			$painel.=$row->codigo_pessoa;
		$painel= "";

	}
	else
	{
		$painel= "NÃO";
	}

	$avalia_poster = new AvaliaPoster();	
	$avalia_poster->find_by_codigo($row->codigo_pessoa,$codigo_evento);
	if($avalia_poster->get_secao() == 1)
		$dia = "03-out 8h"; 
	elseif($avalia_poster->get_secao() == 2)
		$dia = "03-out 10h";
	elseif($avalia_poster->get_secao() == 3)
		$dia = "03-out 14h";
	elseif($avalia_poster->get_secao() == 4)
		$dia = "03-out 17h";
	elseif($avalia_poster->get_secao() == 5)
		$dia = "17:00H";
	else
		$dia="";
	
	if($participa_premiacao->find_by_codigo($row->codigo_pessoa,$codigo_evento))
	{
		$convocado = "SIM";
		$diaoral = $participa_premiacao->get_dia()."/".$participa_premiacao->get_hora()."H";
	}
	else
	{
		$convocado = "NÃO";
		$diaoral = "";
	}
$diaoral = "";
	if($row->codigo_resumo != 0 and $row->situacao_resumo == 5)
	{
		$titulo = acertaStrings_tex( $row->titulo );
		$titulo = encurta_titulo($titulo, 43);

	}
	else
		$titulo = "";

	
	$max = sizeof($nome);
	if($max > 2)
	{
		$nome = $nome[0]." ".$nome[$max-2]." ".$nome[$max-1];
	}
	else
	{
		$nome = $nome[0]." ".$nome[$max-1];
	}

	if($row->nome <> '')
	{
		$nome = explode(' ',$row->nome );
	}
	else
		$nome = $row->email;
	$count++;
	if($count%2 == 1)
	$saida.="\\vspace{0cm}";
	else
	$saida.="\\hspace{1.0cm}";

	$cracha= str_replace("",'',"	
	\begin{cracha}{ $camiseta }{ $convocado $diaoral }{ $painel $dia }{ $arte }{codigos/$row->codigo_pessoa-$codigo_evento.png}{ $codigo $nome }{ $titulo}{ $nome_minicurso }
	\end{cracha}
	"); 
	$saida.=str_replace('’','\'',$cracha); 
	if($count%2 == 0)
	$saida.="
	";	
}

$saida=$saida."
\phantom{Breu Breu}
\end{document}";

//echo "crachas/teste.tex";
$fp = fopen("crachas/crachas_extras.tex", "w");

$saida=iconv("UTF-8", "ISO-8859-1", $saida);
$escreve = fwrite($fp, $saida);
fclose($fp);

	$zip->addFile('./crachas/crachas_extras.tex');
	//$zip->addFile('./crachas/logo.jpg');
	//$zip->addFile('./crachas/faixa_laranja.png');
	$zip->addFile('./crachas/aip4-1.rtx');
	$zip->addFile('./crachas/aps12pt4-1.rtx');
	$zip->addFile('./crachas/ltxdocext.sty');
	$zip->addFile('./crachas/ltxutil.sty');
	$zip->addFile('./crachas/revtex4-1.cls');
	$zip->addFile('./crachas/aps10pt4-1.rtx');
	$zip->addFile('./crachas/aps4-1.rtx');
	$zip->addFile('./crachas/ltxfront.sty');
	$zip->addFile('./crachas/reftest4-1.tex');
	$zip->addFile('./crachas/aps11pt4-1.rtx');
	$zip->addFile('./crachas/apsrmp4-1.rtx');
	$zip->addFile('./crachas/ltxgrid.sty');
	$zip->addFile('./crachas/revsymb4-1.sty');
	$zip->addFile('./crachas/arte/frente.png');

$zip->close();


//$result = exec("pdflatex crachas/crachas_extras.tex")or die("It doesn't work");

echo "<br /><br />Crachas gerados com sucesso (<a href='crachas/crachas_extras.zip'>crachas_extras.zip</a>)";
?>
