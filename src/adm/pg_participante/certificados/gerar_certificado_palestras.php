<?php
/*
$nomes = array(
"Alessandro Silva Nascimento",
"Ana Paula Ulian de Araujo", 
"Fernando Fernandes Paiva",
"Gonzalo Travieso", 
"Leonardo Paulo Maia", 
"Luiz Nunes de Oliveira",
"Attílio Cucchieri",
"Otavio Henrique Thiemann",
"Ricardo De Marco",
"Rodrigo Gonçalves Pereira");

$palestras = array("", "", "", "", "", "", "", "", "", "");

$tipo = array(
"B",
"B",
"B",
"B",
"B",
"B",
"B",
"B",
"B",
"B");
*/


/*
$nomes = array(
"Rodrigo Guedes Lang",
"Matheus de Oliveira Schossler",
"Tiago Martinelli",
"João Victor de Souza Cunha",
"Uilson Barbosa da Silva",
"Laís Canniatti Brazaca",
"Celso Ricardo Caldeira Rêgo",
"Débora Orcia",
"Jaciara Cássia de Carvalho Santos"
);

$palestras = array(
"Optimization of the CTA array",
"Dinâmica de operadores de dois corpos em cadeias de spin exatamente solúveis",
"Álgebra linear e aplicações á física: geradores de dinâmica",
"Geração de ensembles e cálculos de energia livre na aplicação de Monte Carlo em um algoritmo de docking",
"Um novo método de RMN no domínio do tempo para identificação e caracterização de relaxações moleculares em sistemas orgânicos",
"Nanostructured biosensors for adiponectin hormone detection and investigation on its correlation with diabetes Mellitus type",
"Structural and electronic properties of bulk graphite: a DFT investigation within van der Wall corrections",
"Estudo da estrutura e parceiros proteicos da proteína codificada pelo gene micro-exon 14 (MEG-14) do parasita Schistosoma mansoni",
"Water monolayer adsorbed on gypsum at room temperature"
);

$tipo = array(
"PrIc",
"MHIc",
"MHIc",
"PrMe",
"MHMe",
"MHMe",
"PrDo",
"MHDo",
"MHDo"
);

*/

/*
$nomes = array(
"Ana Laura de Lima",
"André Henrique Senhorino Teschke",
"Celso Ricardo Caldeira Rêgo",
"Edmilson Roque dos Santos",
"Emérita Mendoza Rengifo",
"Érika Chang de Azevedo",
"Krissia de Zawadzki",
"Gabriel dos Santos Araujo Pinto",
"Graziele Izalina Vasconcelos Bento",
"Guilherme Eduardo de Souza",
"Lucas Henrique Francisco",
"Marcelo Saito Nogueira",
"Milena Menezes Carvalho",
"Murilo Leão Pereira",
"Natália Karla Bellini",
"Nicolau Barbosa Palma Filho",
"Paola Cristina Barbosa",
"Pedro Ivo Silva Batista",
"Raul Ribeiro Prado",
"Vicente Silva Mattos",
"Victor Silva Tona de Abranches",
"Victor Rabesquine"
);

$palestras = array("", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "", "");

$tipo = array("C","C","C","C","C","C","C","C","C","C","C","C","C","C","C","C","C","C","C","C","C","C" );
*/
$nomes = array(
"Thiago Schiavo Mosqueiro"
);

$palestras = array("LaTeX e Bibtex para Teses e Dissertações no IFSC");

$tipo = array("P");


$duracao["M"]="com duração de 7h na ";
$duracao["P"]="na ";
$duracao["B"]="na ";
$duracao["C"]="da ";
$duracao["PrIc"]="apresentado na ";
$duracao["PrMe"]="apresentado na ";
$duracao["PrDo"]="apresentado na ";
$duracao["MHIc"]="apresentado na ";
$duracao["MHMe"]="apresentado na ";
$duracao["MHDo"]="apresentado na ";

$tipo_palestra["M"] = "ministrou o minicurso";
$tipo_palestra["P"] = "ministrou a palestra";
$tipo_palestra["B"] = "participou da Comissão Avaliadora do Prêmio \"Yvonne Primerano Mascarenhas\" como integrante da Banca de Avaliação da Comunicação Oral";
$tipo_palestra["C"] = "participou como integrante da Comissão Organizadora";
$tipo_palestra["MHIc"] = "recebeu uma Menção Honrosa ao Prêmio \"Yvonne Primerano Mascarenhas\" de Pesquisa de Iniciação Científica pelo trabalho";
$tipo_palestra["MHMe"] = "recebeu uma Menção Honrosa ao Prêmio \"Yvonne Primerano Mascarenhas\" de Pesquisa de Mestrado pelo trabalho";
$tipo_palestra["MHDo"] = "recebeu uma Menção Honrosa ao Prêmio \"Yvonne Primerano Mascarenhas\" de Pesquisa de Doutorado pelo trabalho";
$tipo_palestra["PrIc"] = "recebeu o Prêmio \"Yvonne Primerano Mascarenhas\" de Pesquisa de Iniciação Científica pelo trabalho";
$tipo_palestra["PrMe"] = "recebeu o Prêmio \"Yvonne Primerano Mascarenhas\" de Pesquisa de Mestrado pelo trabalho";
$tipo_palestra["PrDo"] = "recebeu o Prêmio \"Yvonne Primerano Mascarenhas\" de Pesquisa de Doutorado pelo trabalho";

 
$ano="2012";  

for($i=0; $i< count($nomes); $i++)
{  

	if($tipo[$i] != "B" and $tipo[$i] != "C")
		$palestras[$i]="<b>“".$palestras[$i]."”</b>";

	$mensagem="<style>
	body {  font-family: sans-serif;
		 	background-image: url('http://sifsc.ifsc.usp.br/adm/pg_participante/certificados/certificado".$ano.".jpg');
			background-repeat:no-repeat;
			backgroundPosition: top center;
			width:1122;}
	</style>
	<body >

	<p style='font-size:16pt;line-height:16pt;text-align:center;'>Certificamos que</p>
	<p style='font-size:22pt;line-height:20pt;text-align:center;'><b>".$nomes[$i]."</b></p>
	<p style='font-size:16pt;line-height:26pt;text-align:center;'> ".$tipo_palestra[$tipo[$i]]." ".$palestras[$i]." ".$duracao[$tipo[$i]]."II Semana Integrada de Graduação e Pós-Graduação do Instituto de Física de São Carlos - II SIFSC ocorrida no período de 16 a 19 de Outubro de 2012.</p></body>";


			$certificado = 'pdfs/CertificadoSIFSC_'.$tipo[$i].'_'.$nomes[$i].'.pdf';
	
	 
		
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
				$home = "/home/" . get_current_user() . "/";
				require_once($home . 'public_html/sifsc/MPDF54/mpdf.php'); 
				$pdf = new mPDF('en-GB','A4-L',0,'Arial',67,7,65,0,0,0);
				$pdf->WriteHTML($content); 
				$pdf->Output($certificado); 	
}

?>
