<?php
$home = "/home/" . get_current_user() . "/";

require_once($home . "public_html/sifsc/user/classes/class.avaliador.php");
require_once($home . "public_html/sifsc/user/classes/class.evento.php");

session_start();
require_once($home . "public_html/sifsc/referee/restricted.php");
require_once($home . "public_html/sifsc/referee/event/secao.php");


//
// Choosing the background image according to the evento code.
//
$bgfile_names = array(
	1 => "certificado2012.jpg",
	2 => "certificado2013.jpg",
	3 => "certificado2014.jpg",
	4 => "certificado2015.jpg"
);
$backgroundfile_name = $bgfile_names[ $_POST['e'] ];


//
// Details in the certificates text
//
$eventname_names = array(
	1 => "II Semana Integrada de Graduação e Pós-Graduação do Instituto de Física de São Carlos - II SIFSC",
	2 => "III Semana Integrada do Instituto de Física de São Carlos - SIFSC 3",
	3 => "IV Semana Integrada do Instituto de Física de São Carlos - SIFSC 4",
	4 => "V Semana Integrada do Instituto de Física de São Carlos - SIFSC 5"
);
$eventname = $eventname_names[ $_POST['e'] ];

$periodo_names = array(
	1 => "de 16 a 19 de Outubro de 2012",
	2 => "de 30 de Setembro a 04 de Outubro de 2013",
	3 => "de 6 a 9 de Outubro de 2014",
	4 => "de 28 de Setembro a 02 de Outubro de 2015"
);
$periodo = $periodo_names[ $_POST['e'] ];

$margins_values = array(
	1=> array(67,7,65,0),
	2=> array(67,7,65,0),
	3=> array(67,7,65,0),
	4=> array(20,20,65,0)
);

$margins = $margins_values[ $_POST['e'] ];


//
// Writing the certificate.
//
$mensagem='<style>
body {

      font-family: sans-serif;
      background-image: url(\'http://sifsc.ifsc.usp.br/referee/event/certificados/' . $backgroundfile_name . '\');
      background-repeat:no-repeat;
      backgroundPosition: top center;
      width:1122;
}

</style>
<body >';


$ok=1;
if(isset($_POST['tipo']) && $_POST['tipo'] == 'poster')
{
	$mensagem.="<p style='font-size:16pt;line-height:16pt;text-align:center;'>Certificamos que</p>";

	$mensagem.="<p style='font-size:22pt;line-height:20pt;text-align:center;'>".$avaliador->get_nome()."</p>";

	$mensagem.="<p style='font-size:16pt;line-height:26pt;text-align:center;'>participou como avaliador(a) do <b>Workshop de Pós-Graduação e Iniciação Científica</b> na " . $eventname . " ocorrida no período ".$periodo.".</p>";

	$certificado = 'CertificadoWorkshop.pdf';
}
elseif(isset($_POST['tipo']) && $_POST['tipo'] == 'resumo')
{

	$mensagem.="<p style='font-size:16pt;line-height:16pt;text-align:center;'>Certificamos que</p>";

	$mensagem.="<p style='font-size:22pt;line-height:20pt;text-align:center;'>".$avaliador->get_nome()."</p>";

	$mensagem.="<p style='font-size:16pt;line-height:26pt;text-align:center;'>participou da Comissão Avaliadora do Prêmio <b>“Yvonne Primerano Mascarenhas”</b> como avaliador(a) de resumos na " . $eventname . " ocorrida no período ".$periodo.".</p>";
	$certificado = 'CertificadoResumos.pdf';

}
else
{
	$ok=0;
}

if($ok)
{
        ob_start();
?>

	<page>
      		<page_header>
      		</page_header>

	        <page_footer>
                      </page_footer>
   		<?php
		echo $mensagem;
		?>

 		</page>

<?php
	$content = ob_get_clean();
	require_once('~/public_html/sifsc/MPDF54/mpdf.php');
	$pdf = new mPDF('en-GB','A4-L',0,'Arial',$margins[0],$margins[1],$margins[2],$margins[3],0,0);
	$pdf->WriteHTML($content);
	$pdf->Output($certificado,'D');
}
	echo "<script language=\"JavaScript\"> location=(\"http://sifsc.ifsc.usp.br/referee/event/certificado.php\"); </script>";
?>
