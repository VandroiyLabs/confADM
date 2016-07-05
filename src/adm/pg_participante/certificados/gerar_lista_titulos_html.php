<?php
$home = "/home/" . get_current_user() . "/";
require_once($home . "public_html/sifsc/user/classes/class.resumo.php");
$mensagem="
";
$resumo = new Resumo();
$count=0;
$filtro=" and codigo_resumo in (536,545,562,581,640,647) ";
$consulta = $resumo->find_all_by_evento_pt(3,$filtro);

while ($row = mysql_fetch_object($consulta))
{
	$count++;
	$mensagem.="<p>".$count." --> ".$row->codigo_resumo." - ".$row->titulo_html."</p>";

}

?>

<?php
        ob_start();
?>
   <page >
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
        require_once($home . 'public_html/sifsc/MPDF54/mpdf.php');
      // $pdf = new mPDF('en-GB','A4',0,'Arial',10,10,10,10,0,0);
		$pdf = new mPDF();
        $pdf->WriteHTML($content);
        $pdf->Output('titulos.pdf','D');

?>
