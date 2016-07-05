<?php

$codes = array(
1 => "A", 2 => "B", 3 => "C", 4 => "D",  5 => "E",
6 => "F", 7 => "G", 8 => "H", 9 => "I", 10 => "J",
11 => "K", 12 => "L", 13 => "M", 14 => "N", 15 => "O",
16 => "P", 17 => "Q", 18 => "R", 19 => "S", 20 => "T",
21 => "U", 22 => "V", 23 => "W", 24 => "X", 25 => "Y",  26 => "Z"
);

include "./crachas/Barcode39.php"; 
$zip = new ZipArchive();
$filename = "./crachas/crachas.zip";

/* 
	Funcao pra encurtar uma string 
*/
function encurta_titulo($titulo, $ncharlim)
{
	$opencb = 0;
	
	/* Numero de caracteres na string fornecida */
	$nchar = strlen($titulo);
	
	/* Verifica se é maior que o limite */
	if ( $nchar > $ncharlim )
	{
		$titaux = substr($titulo, 0, $ncharlim);
		
		$titaux2 = explode(" ", $titaux);
		$nparts = count($titaux2);
		
		$final_titulo = "";
		for ( $j = 0; $j < $nparts - 1; $j++ )
		{
			if ( stripos($titaux2[$j], "{") and $opencb == 0 )
			{
				$opencb = 1;
			}
			if ( stripos($titaux2[$j], "}") and $opencb == 1 )
			{
				$opencb = 0;
			}
			
			$final_titulo .= $titaux2[$j] . " ";
		}
		
		if ( $opencb == 1 )
		{
			$final_titulo .= "}";
		}
		
		$final_titulo .= " (...)";
		return($final_titulo);
	}
	else
	{
		return($titulo);
	}
	
}


/* Funcao para acertar detalhes de latex */
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

               $finaltexto = str_replace('DOIS_SIFROES', '$$', $texto1);                

               
                                                               
               return $finaltexto;
       }





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
$codigo_evento = $evento->get_codigo_evento();
//$filtro = "and Pessoa.nome <> '' ";
$filtro="";

$consulta = $pessoa->find_by_evento_alfabetico_crachas($codigo_evento,$filtro);
$count=0;
while ($row = mysql_fetch_object($consulta)){

	//$bc = new Barcode39($row->codigo_pessoa."-".$codigo_evento); 
	
	if(($row->id)%26 != 0){ $L2=($row->id)%26; $L1=$row->id/26+1; }else {$L1=$row->id/26; $L2=26;}


	$codigo_crq=$codes[$L1]."".$codes[$L2];
	//echo $row->id." ".$codigo_crq."<br />";	
	//$codigo_crq="ZZ";
	/*$bc = new Barcode39($codigo_crq);

	$bc->draw('./crachas/codigos/'.$codigo_crq.'.png');	
	$zip->addFile('./crachas/codigos/'.$codigo_crq.'.png');*/

	//$bc->draw('./crachas/codigos/'.$row->codigo_pessoa.'-'.$codigo_evento.'.png');	
	//$zip->addFile('./crachas/codigos/'.$row->codigo_pessoa.'-'.$codigo_evento.'.png');

	if($kit->find_by_codigo_pessoa($row->codigo_pessoa,$codigo_evento))
	{
		if($kit->get_tipo_camiseta() == 'azul')
		$tipo = '';
		elseif($kit->get_tipo_camiseta() == 'cinza')
		$tipo = 'C';
		else
		$tipo = 'AC';

		$camiseta = $kit->get_camiseta()."".$tipo;
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
		$nome_minicurso = encurta_titulo($minicurso->get_titulo(), 36);
		if($participa_minicurso->get_codigo_minicurso() == 26)
		$nome_minicurso = encurta_titulo("M2 - O Universo: passado, presente e futuro", 36);
		//$nome_minicurso .= " -- Sala: " . $salasminicuros[$participa_minicurso->get_codigo_minicurso()];
	}
	else
		$nome_minicurso = "";
	
	if($row->nivel == 'Mestrado' or $row->nivel == 'Doutorado')
		$codigo="PG";
	elseif($row->nivel == 'Graduacao')
		$codigo = "GR";
	elseif($row->nivel == '' and $row->nome =='')
		$codigo = "COD";
	else
		$codigo = "OT";
		
		$codigo.=$row->codigo_pessoa;
	
	$painel= ""; $dia="";
	$avalia_poster = new AvaliaPoster();	
	if($avalia_poster->find_by_codigo($row->codigo_pessoa,$codigo_evento))
	{
		if($avalia_poster->get_secao() == 1)
			$dia = "01-out 8h"; 
		elseif($avalia_poster->get_secao() == 2)
			$dia = "01-out 10h15";
		elseif($avalia_poster->get_secao() == 3)
			$dia = "01-out 14h";
		elseif($avalia_poster->get_secao() == 4)
			$dia = "01-out 16h";
		elseif($avalia_poster->get_secao() == 5)
			$dia = "17:00H";
		else
			$dia="";
	}
	else
	{
		$painel= "NÃO"; 
	}
	
	if($participa_premiacao->find_by_codigo($row->codigo_pessoa,$codigo_evento))
	{
		$convocado = "SIM";
		//$diaoral = $participa_premiacao->get_dia()."/".$participa_premiacao->get_hora()."H";
		$diaoral = ""; 


	}
	else
	{
		$convocado = "NÃO";
		$diaoral = "";
	}

	if($row->codigo_resumo != 0 and $row->situacao_resumo == 5)
	{
		$titulo = acertaStrings_tex( $row->titulo );
		$titulo = encurta_titulo($titulo, 35);

	}
	else
		$titulo = "";

	$nome = explode(' ',$row->nome );
	$max = sizeof($nome);
	if($row->nome == strtoupper($row->nome) or $max < 3 )
	{
		$nome = $nome[0]." ".$nome[$max-1];
	}	
	else
	{
		$nome = $nome[0]." ".$nome[$max-2]." ".$nome[$max-1];
	}
	

	

	$count++;
	if($count%2 == 1)
	$saida.="\\vspace{0cm}";
	else
	$saida.="\\hspace{1.0cm}";

	$cracha= str_replace("",'',"	
	\begin{cracha}{ $camiseta }{ $convocado $diaoral }{ $painel $dia }{}{".$codigo_crq."}{ $codigo $nome }{ $titulo}{ $nome_minicurso }
	\end{cracha}
	"); 
	 $cracha=str_replace('\textit{ P. falciparum }: }', '\textit{ P. falciparum }: ', $cracha);
	 $cracha=str_replace('$ ^{87} ', '$ ^{87}$ ', $cracha);

	$saida.=str_replace('’','\'',$cracha); 
	if($count%2 == 0)
	$saida.="
	";	
}
/*$saida.="

	\\vspace{0cm}	
	\begin{cracha}{ NÃO }{ NÃO  }{ NÃO  }{  }{ZZ}{    }{ }{  }
	\end{cracha}
	\hspace{1.0cm}	
	\begin{cracha}{ NÃO }{ NÃO  }{ NÃO  }{  }{ZZ}{    }{ }{  }
	\end{cracha}
";
*/
$saida=$saida."
\end{document}";

//echo "crachas/teste.tex";
$fp = fopen("crachas/crachas.tex", "w");

$saida=iconv("UTF-8", "ISO-8859-1", $saida);
$escreve = fwrite($fp, $saida);
fclose($fp);

	$zip->addFile('./crachas/crachas.tex');
	//$zip->addFile('./crachas/logo.jpg');
	//$zip->addFile('./crachas/faixa_laranja.png');
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

echo "Crachas gerados com sucesso (<a href='crachas/crachas.zip'>crachas.zip</a>)";
?>
