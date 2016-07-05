<?php

function number_significant($number, $decimals, $sep1='.', $sep2='') {

        if (($number * pow(10 , $decimals + 1) % 10 ) == 5)  //if next not significant digit is 5
            $number -= pow(10 , -($decimals+1));

        return number_format($number, $decimals, $sep1, $sep2);

}

?>

<div id="content">
<div class="post">
	<div class='content'>
	
		<h2>Relatório dos Minicursos</h2>	
		
		<?php
		
		// Numero de algarismos significativos para as porcentagens
		$alg_sign = 0;
		
		$minicurso = new Minicurso();
		$pessoa = new Pessoa();
		$evento = new Evento();
		$evento->find_evento_aberto();

		echo "
		<h3 class='mc_title'>
			Geral
		</h3>";
		
		$total_insc = mysql_num_rows( $pessoa->find_by_evento_minicurso( $evento->get_codigo_evento() ) );
		if ( $total_insc > 0 )
		{
		$total_grad = mysql_num_rows( $pessoa->find_by_evento_minicurso( $evento->get_codigo_evento() , " AND Inscricao.nivel = 'Graduacao' ") );
		$total_gradp = $total_grad/$total_insc*100;
		$total_pg = mysql_num_rows( $pessoa->find_by_evento_minicurso( $evento->get_codigo_evento() , " AND ( Inscricao.nivel = 'Doutorado' OR Inscricao.nivel = 'Mestrado' ) ") );
		$total_pgp = $total_pg/$total_insc*100;
		
		$total_IFSC = mysql_num_rows( $pessoa->find_by_evento_minicurso( $evento->get_codigo_evento() , " AND Inscricao.instituicao = 'IFSC-USP' ") );
		$total_IFSCp = $total_IFSC/$total_insc*100;
		$total_fIFSC = mysql_num_rows( $pessoa->find_by_evento_minicurso( $evento->get_codigo_evento() , " AND Inscricao.instituicao <> 'IFSC-USP' ") );
		$total_fIFSCp = $total_fIFSC/$total_insc*100;
		}
		else
		{
		$total_gradp = 0;
		$total_pgp = 0;
		$total_IFSCp = 0;
		$total_fIFSCp = 0;
		}
		
		
		echo "<p class='mc_report'>Total de inscritos: <b>$total_insc</b></p>";
		echo "<p class='mc_report'>Total de graduandos: <b>$total_grad</b> &nbsp;&nbsp;&nbsp;(" . number_significant($total_gradp, $alg_sign) . "%)</p>";
		echo "<p class='mc_report_largespace'>Total de pós-graduandos: <b>$total_pg</b> &nbsp;&nbsp;&nbsp;(" . number_significant($total_pgp, $alg_sign) . "%)</p>";
		echo "<p class='mc_report'>Total de IFSC: <b>$total_IFSC</b> &nbsp;&nbsp;&nbsp;(" . number_significant($total_IFSCp, $alg_sign) . "%)</p>";
		echo "<p class='mc_report_largespace'>Total de fora do IFSC: <b>$total_fIFSC</b> &nbsp;&nbsp;&nbsp;(" . number_significant($total_fIFSCp, $alg_sign) . "%)</p>";
		
		echo "
		<h3 class='mc_title'>
			Por número de inscritos
		</h3>";
		
		// Consultando ordenado pelo número de inscritos
		$consulta = $minicurso->find_by_evento($evento->get_codigo_evento());
		$total = mysql_num_rows($consulta);
		
		$row = mysql_fetch_object($consulta);
		echo "<p class='mc_report_largespace'>" . substr($row->titulo, 0, 3) . "  - Inscritos: <font color='Green'><b>$row->inscritos</b></font><br /><font size='1pt'>" . substr($row->titulo, 5, 100) . "</font></p>";
		$ninsc = $row->inscritos;
		
		while ( $row = mysql_fetch_object($consulta) )
		{
			$delta = $row->inscritos - $ninsc;
			$ninsc = $row->inscritos;
			echo "<p class='mc_report_largespace'>" . substr($row->titulo, 0, 3) . "  - Inscritos: $ninsc (<font color='Red'><b>$delta</b></font>)<br /><font size='1pt'>" . substr($row->titulo, 5, 100) . "</font></p>";
		}
		
		
		$consulta_min = $minicurso->find_all();
		while ( $linha = mysql_fetch_object($consulta_min) )
		{
			
			$inscricao = new Inscricao();
			
			// Total
			$total = $linha->inscritos;
			
			// Por nivel
			$ninsc_grad = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(), '', "and ParticipaMinicurso.codigo_minicurso = '$linha->codigo_minicurso' and Inscricao.nivel = 'Graduacao'") );
			$ninsc_gradp = $ninsc_grad/$total*100;
			$ninsc_pg = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(), '', "and ParticipaMinicurso.codigo_minicurso = '$linha->codigo_minicurso' and (Inscricao.nivel = 'Mestrado' or Inscricao.nivel = 'Doutorado') ") );
			$ninsc_pgp = $ninsc_pg/$total*100;
			
			$vagas_remanescentes = $linha-> vagas - $linha->inscritos;
			
			// Por instituicao
			$ninsc_IFSC = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(), '', "and ParticipaMinicurso.codigo_minicurso = '$linha->codigo_minicurso' and Inscricao.instituicao = 'IFSC-USP'") );
			$ninsc_IFSCp = $ninsc_IFSC/$total*100;
			$ninsc_ICMC = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(), '', "and ParticipaMinicurso.codigo_minicurso = '$linha->codigo_minicurso' and Inscricao.instituicao LIKE '%ICMC%'") );
			$ninsc_ICMCp = $ninsc_ICMC/$total*100;
			$ninsc_IQSC = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(), '', "and ParticipaMinicurso.codigo_minicurso = '$linha->codigo_minicurso' and Inscricao.instituicao LIKE '%IQSC%'") );
			$ninsc_IQSCp = $ninsc_IQSC/$total*100;
			$ninsc_UFSCar = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(), '', "and ParticipaMinicurso.codigo_minicurso = '$linha->codigo_minicurso' and Inscricao.instituicao LIKE '%UFSC%'") );
			$ninsc_UFSCarp = $ninsc_UFSCar/$total*100;
			
			echo "
			<h3 class='mc_title'>
				" . $linha->titulo . "
			</h3>
			
			<p class='mc_report'>Nome do responsável: ". $linha->responsavel ."</p>
			<p class='mc_report'>N. de inscritos: ". $total ."</p>
			<p class='mc_report_largespace'>N. de vagas abertas: ". $vagas_remanescentes ."</p>
			<p class='mc_report'>N. Inscricos Graduação: ". $ninsc_grad ." &nbsp;&nbsp;&nbsp;(" . number_significant($ninsc_gradp, $alg_sign) . "%)</p>
			<p class='mc_report_largespace'>N. Inscricos Pós-Graduação: ". $ninsc_pg ." &nbsp;&nbsp;&nbsp;(" . number_significant($ninsc_pgp, $alg_sign) . "%)</p>
			<p class='mc_report'>N. Inscricos do IFSC: ". $ninsc_IFSC ." &nbsp;&nbsp;&nbsp;(" . number_significant($ninsc_IFSCp, $alg_sign) . "%)</p>
			<p class='mc_report'>N. Inscricos do ICMC: ". $ninsc_ICMC ." &nbsp;&nbsp;&nbsp;(" . number_significant($ninsc_ICMCp, $alg_sign) . "%)</p>
			<p class='mc_report'>N. Inscricos do IQSC: ". $ninsc_IQSC ." &nbsp;&nbsp;&nbsp;(" . number_significant($ninsc_IQSCp, $alg_sign) . "%)</p>
			<p class='mc_report_largespace'>N. Inscricos do UFSCar: ". $ninsc_UFSCar ." &nbsp;&nbsp;&nbsp;(" . number_significant($ninsc_UFSCarp, $alg_sign) . "%)</p>
			
			";
		}
		
		?>
		
	</div>
</div>

</div>
