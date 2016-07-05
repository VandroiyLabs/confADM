<div id="content">
<div class="post">
	<div class="content">
	<h2>Informações Gerais</h2>

	<table border="0" cellspacing="0" cellpadding="0" width='100%'>

	<?php
		$home = "/home/" . get_current_user() . "/";
		require_once($home . 'public_html/sifsc/user/classes/class.kits.php');
		require_once($home . 'public_html/sifsc/user/classes/class.minicurso.php');


		/* Garantindo que nenhum lixo fique solto e a edicao de alguem fique em aberto! */
		require_once('./../../user/classes/class.EmEdicao.php');
		$editando = new EmEdicao();
		if ( $editando->find_by_adm($adm->get_usuario()) )
		{
			$editando->remove();
		}

		$evento = new Evento();

		$consulta = $evento->find_all_aberto();
		$total = mysql_num_rows($consulta);

		while ( $row = mysql_fetch_object($consulta) )
		{

			$inscricao = new Inscricao();
			$pessoa = new Pessoa();

			$consulta2 = $inscricao->find_by_evento($row->codigo_evento);
			$total_inscritos = mysql_num_rows($consulta2);

			// Dados sobre os resumos
			$nresumos0 = mysql_num_rows( $pessoa->find_by_evento_situacao($row->codigo_evento, 0) );
			$nresumos1 = mysql_num_rows( $pessoa->find_by_evento_situacao($row->codigo_evento, 1) );
			$nresumos2 = mysql_num_rows( $pessoa->find_by_evento_situacao($row->codigo_evento, 2) );
			$comissao = mysql_num_rows( $pessoa->find_by_evento_situacao_deferimento($row->codigo_evento, 1) );
			$biblioteca = mysql_num_rows( $pessoa->find_by_evento_situacao_deferimento($row->codigo_evento, 0) );
			$nresumos3 = mysql_num_rows( $pessoa->find_by_evento_situacao($row->codigo_evento, 3) );
			$nresumos4 = mysql_num_rows( $pessoa->find_by_evento_situacao($row->codigo_evento, 4) );
			$nresumos5 = mysql_num_rows( $pessoa->find_by_evento_situacao($row->codigo_evento, 5) );

			// Dados sobre os minicursos
			$consulta2 = $pessoa->find_by_evento_minicurso($row->codigo_evento);
			$total_minicurso= mysql_num_rows($consulta2);

			$minicurso = new Minicurso();
			$consulta_min = $minicurso->find_all_by_evento_alfabetico($row->codigo_evento);

			// Numero de participantes em diversos niveis
			$consulta2 = $inscricao->find_by_nivel_evento('Graduacao', $row->codigo_evento);
			$ngrad = mysql_num_rows($consulta2);
			$consulta2 = $inscricao->find_by_nivel_evento('Mestrado', $row->codigo_evento);
			$nmest = mysql_num_rows($consulta2);
			$consulta2 = $inscricao->find_by_nivel_evento('Doutorado', $row->codigo_evento);
			$ndoc = mysql_num_rows($consulta2);
			$ndif = $total_inscritos - $ngrad - $nmest - $ndoc;

			// Dados sobre as artes
			$consulta2 = $pessoa->find_by_evento_arte_situacao($row->codigo_evento,1);
			$total_arte_nao_submetida= mysql_num_rows($consulta2);

			$consulta2 = $pessoa->find_by_evento_arte_situacao($row->codigo_evento,2);
			$total_arte_submetida= mysql_num_rows($consulta2);

			$consulta2 = $pessoa->find_by_evento_arte_situacao($row->codigo_evento,3);
			$total_arte_indeferida= mysql_num_rows($consulta2);

			$consulta2 = $pessoa->find_by_evento_arte_situacao($row->codigo_evento,4);
			$total_arte_deferida= mysql_num_rows($consulta2);

			$total_arte = $total_arte_nao_submetida + $total_arte_submetida+$total_arte_indeferida+$total_arte_deferida;

			// Dados sobre os kits
			/*$kits = new Kits();
			$kits_numpedidos = mysql_num_rows( $kits->find_all_by_evento($row->codigo_evento));
			$kits_numcP = mysql_num_rows( $kits->find_by_camiseta_by_evento('P', $row->codigo_evento));
			$kits_numcM = mysql_num_rows( $kits->find_by_camiseta_by_evento('M', $row->codigo_evento));
			$kits_numcG = mysql_num_rows( $kits->find_by_camiseta_by_evento('G', $row->codigo_evento));
			$kits_numcGG = mysql_num_rows( $kits->find_by_camiseta_by_evento('GG', $row->codigo_evento));
			$kits_numcBP = mysql_num_rows( $kits->find_by_camiseta_by_evento('BLP', $row->codigo_evento));
			$kits_numcBM = mysql_num_rows( $kits->find_by_camiseta_by_evento('BLM', $row->codigo_evento));
			$kits_numcBG = mysql_num_rows( $kits->find_by_camiseta_by_evento('BLG', $row->codigo_evento));
			$kits_numcBGG = mysql_num_rows( $kits->find_by_camiseta_by_evento('BLGG', $row->codigo_evento));
			$kits_numcEG = mysql_num_rows( $kits->find_by_camiseta_by_evento('EG', $row->codigo_evento));
			$kits_numcEGG = mysql_num_rows( $kits->find_by_camiseta_by_evento('EGG', $row->codigo_evento));*/

			if($row->aberto == 0) $evento_aberto = "Não <img  src='../images/s_error.png'";
			else $evento_aberto = "Sim <img  src='../images/s_success.png'";

			if($row->inscricao_aberta == 0) $inscricoes_abertas = "Não <img  src='../images/s_error.png'";
			else $inscricoes_abertas = "Sim <img  src='../images/s_success.png'";

			if($row->minicurso_aberto == 0) $minicurso_aberto = "Não <img  src='../images/s_error.png'";
			else $minicurso_aberto = "Sim <img  src='../images/s_success.png'";

			if($row->submissao_aberta == 0) $submissoes_abertas = "Não <img  src='../images/s_error.png'";
			else $submissoes_abertas = "Sim <img  src='../images/s_success.png'";

			if($row->resubmissao_aberta == 0) $resubmissoes_abertas = "Não <img  src='../images/s_error.png'";
			else $resubmissoes_abertas = "Sim <img  src='../images/s_success.png'";

			if($row->avaliacao_aberta == 0) $avaliacoes_abertas = "Não <img  src='../images/s_error.png'";
			else $avaliacoes_abertas = "Sim <img  src='../images/s_success.png'";

			if($row->pesquisa_aberta == 0) $pesquisa_aberta = "Não <img  src='../images/s_error.png'";
			else $pesquisa_aberta = "Sim <img  src='../images/s_success.png'";

			if($row->premio_aberto == 0) $premio_aberto = "Não <img  src='../images/s_error.png'";
			else $premio_aberto = "Sim <img  src='../images/s_success.png'";

			echo "
			<tr>
				<td valign='top'>
				<!-- Topo 1 ---------------------------------->
					<table border='0' cellspacing='0' cellpadding='5' bgcolor='#e9e9e9' width='100%' id='block'>
	<tr  bgcolor='#c4c4c4'>
		<td height='30' > <span class=\"nomeevento\">$row->nome</span></td>
		<td align='right' >
			<form method='get' action='home.php'>
			<input type='submit' value='  Alterar  ' class='button_azul'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type='hidden' name='codigo_evento' value='$row->codigo_evento'/>
			<input type='hidden' name='p1' value='alterar'/>
			</form>
		</td>
	</tr>
	<tr>
		<td height = '20' colspan='2'>
		<div id=\"info\">
			<div id=\"inscrabertas\">
				<b>Evento Ativo: </b>$evento_aberto
			</div>
			<div id=\"inscrabertas\">
				<b>Inscrições Abertas: </b>$inscricoes_abertas
			</div>
			<div id=\"inscrabertas\">
				<b>Minicurso Aberto: </b>$minicurso_aberto
			</div>
			<div id=\"inscrabertas\">

				<b>Submissões Abertas: </b>$submissoes_abertas

			</div>
			<div id=\"inscrabertas\">
				<b>Resubmissões Abertas: </b>$resubmissoes_abertas
			</div>
			<div id=\"inscrabertas\">
				<b>Avaliações Abertas: </b>$avaliacoes_abertas

			</div>

			<div id=\"inscrabertas\">
				<b>Pesquisa Aberta: </b>$pesquisa_aberta


			</div>

			<div id=\"inscrabertas\">
				<b>Prêmio Aberto: </b>$premio_aberto


			</div>
			<div id=\"website\">
				<b>Tag dos e-mails:</b> $row->tag_email
			</div>
			<div id=\"website\">
				<b>Assinatura dos e-mails:</b> $row->assinatura_email
			</div>
			<div id=\"website\">
				<b>Web-site: </b><a href='$row->website' target='_blank'>$row->website</a>
			</div>
			<div id=\"titulosecao\">
				<p>Participantes</p>
			</div>" .
			/*<div id=\"dado\">
				<b>Número de inscritos: </b>
			</div>" .
			<div id=\"dado\">

				<b>Graduandos: </b>$ngrad
			</div>
			<div id=\"dado\">

				<b>Mestrandos: </b>$nmest
			</div>
			<div id=\"dado\">

				<b>Doutorandos: </b>$ndoc
			</div>*/ "

					<script type=\"text/javascript\">
			$(function ()
				{
   var dataSource = [
    { country: 'Graduandos', area: $ngrad },
    { country: 'Mestrandos', area: $nmest },
    { country: 'Doutorandos', area: $ndoc },
    { country: 'Outros níveis', area: $ndif }
];

var chart = $(\"#pieContainer\").dxPieChart({
    size:{
        width: 500
    },
    dataSource: dataSource,
    series: [
        {
            argumentField: 'country',
            valueField: 'area',
            label:{
                visible: true,
                connector:{
                    visible:true,
                    width: 1
                }
            }
        }
    ],
    title: '<span style=\"font-size: 18px; color: #333;\">Total inscritos: $total_inscritos</span>'
});
}

			);
		</script>

		<div id=\"pieContainer\" style=\"width: 300px; height: 280px;\"></div>


		<div class=\"colleft\">
			<div id=\"titulosecao\">
				<p>Resumos</p>
			</div>
			<div id=\"dado\">
				<b>Sem resumo:</b> $nresumos0
			</div>
			<div id=\"dado\">
				<b>Não submetidos:</b> $nresumos1
			</div>
			<div id=\"dado\">
				<b>Submetidos:</b> $nresumos2 (C: $comissao - B: $biblioteca )
			</div>
			<div id=\"dado\">
				<b>Resubmissão:</b> $nresumos3
			</div>
			<div id=\"dado\">
				<b>Indeferidos:</b> $nresumos4
			</div>
			<div id=\"dado\">
				<b>Deferidos:</b> $nresumos5
			</div>
		</div>
		<div class=\"colright\">
			<div id=\"titulosecao\">
				<p>Arte</p>
			</div>
			<div id=\"dado\">
				<b>Inscritos: </b>$total_arte
			</div>
			<div id=\"dado\">
				<b>Não submetidos: </b>$total_arte_nao_submetida
			</div>
			<div id=\"dado\">
				<b>Submetidos: </b>$total_arte_submetida
			</div>
			<div id=\"dado\">
				<b>Indeferidos: </b>$total_arte_indeferida
			</div>
			<div id=\"dado\">
				<b>Deferidos: </b>$total_arte_deferida
			</div>
			<div id=\"dado\">
				&nbsp;
			</div>
		</div>

		<div class=\"colleft\">
			<div id=\"titulosecao\">
				<p>Minicursos</p>
			</div>";


	      echo "
		<script src=\"./js/jquery-1.9.1.min.js\"></script>
		<script src=\"./js/knockout-2.2.1.js\"></script>
		<script src=\"./js/globalize.js\"></script>
		<script src=\"./js/dx.chartjs.js\"></script>
		";

		$mindados = "";

		while ( $linha = mysql_fetch_object($consulta_min) )
		{

			/*echo "
			<div id=\"dado\">
				<b> " . substr($linha->titulo, 0, 3) . " : </b>" . $linha->inscritos .
			"</div>";*/
			$mindados .= "," . substr($linha->titulo, 0, 3) . ":" . " " . $linha->inscritos . " ";
		}

		echo "
<script type=\"text/javascript\">
			$(function ()
				{
   var dataSource = [
    { state: 'Minicursos'" . $mindados . " }
    ];

var chart = $(\"#chartContainer\").dxChart({
    dataSource: dataSource,
    commonSeriesSettings: {
        argumentField: 'state',
        type: 'bar',
        hoverMode: 'allArgumentPoints',
        selectionMode: 'allArgumentPoints',
        label:{
            visible: true,
            format: \"fixedPoint\",
            precision: 0
        }
    },
    series: [
        { valueField: 'M1', name: 'M1' },
        { valueField: 'M2', name: 'M2' },
        { valueField: 'M3', name: 'M3' },
        { valueField: 'M4', name: 'M4' },
        { valueField: 'M5', name: 'M5' },
        { valueField: 'M6', name: 'M6' }
    ],
    title: '<span style=\"font-size: 18px; color: #333;\">Total de inscritos: " . $total_minicurso . "</span>',
    legend: {
        verticalAlignment: 'bottom',
        horizontalAlignment: 'center'
    },
    pointClick: function (point) {
        this.select();
    }
});
}

			);
		</script>
		";
		echo "<div id=\"chartContainer\" style=\"width: 100%; height: 300px;\"></div>";

		echo "
		</div>
		<div class=\"colright\">
			<div id=\"titulosecao\">
				<p>Kits</p>
			</div>";


		$kits = new Kits();
		$numkitstipo = 1;
		echo "<table width='100%'>";
		echo "<tr><td width><b>Tamanho</b> </td><td><b></b></td>";
		if ( $numkitstipo == 2)
		{
			echo "<td><b>2</b> </td>";
		}
		echo "</tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('BLPP','', $row->codigo_evento );
		echo "<tr><td><b>Camisetas BLPP:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td>";
		if ( $numkitstipo == 2)
		{
			$consulta_azul = $kits->find_by_camiseta_e_tipo('BLPP','azul', $row->codigo_evento );
			echo "<td>" . mysql_num_rows($consulta_azul). "</td>";
		}
		echo "</tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('BLP','', $row->codigo_evento );
		echo "<tr><td><b>Camisetas BLP:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td>";
		if ( $numkitstipo == 2)
		{
			$consulta_azul = $kits->find_by_camiseta_e_tipo('BLP','azul', $row->codigo_evento );
			echo "<td>" . mysql_num_rows($consulta_azul). "</td>";
		}
		echo "</tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('BLM','', $row->codigo_evento );
		echo "<tr><td><b>Camisetas BLM:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td>";
		if ( $numkitstipo == 2)
		{
			$consulta_azul = $kits->find_by_camiseta_e_tipo('BLM','azul', $row->codigo_evento );
			echo "<td>" . mysql_num_rows($consulta_azul). "</td>";
		}
		echo "</tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('BLG','', $row->codigo_evento );
		echo "<tr><td><b>Camisetas BLG:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td>";
		if ( $numkitstipo == 2)
		{
			$consulta_azul = $kits->find_by_camiseta_e_tipo('BLG','azul', $row->codigo_evento );
			echo "<td>" . mysql_num_rows($consulta_azul). "</td>";
		}
		echo "</tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('BLGG','', $row->codigo_evento );
		echo "<tr><td><b>Camisetas BLGG:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td>";
		if ( $numkitstipo == 2)
		{
			$consulta_azul = $kits->find_by_camiseta_e_tipo('BLGG','azul', $row->codigo_evento );
			echo "<td>" . mysql_num_rows($consulta_azul). "</td>";
		}
		echo "</tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('PP','', $row->codigo_evento );
		echo "<tr><td><b>Camisetas PP:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td>";
		if ( $numkitstipo == 2)
		{
			$consulta_azul = $kits->find_by_camiseta_e_tipo('PP','azul', $row->codigo_evento);
			echo "<td>" . mysql_num_rows($consulta_azul). "</td>";
		}
		echo "</tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('P','', $row->codigo_evento );
		echo "<tr><td><b>Camisetas P:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td>";
		if ( $numkitstipo == 2)
		{
			$consulta_azul = $kits->find_by_camiseta_e_tipo('P','azul', $row->codigo_evento);
			echo "<td>" . mysql_num_rows($consulta_azul). "</td>";
		}
		echo "</tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('M','', $row->codigo_evento );
		echo "<tr><td><b>Camisetas M:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td>";
		if ( $numkitstipo == 2)
		{
			$consulta_azul = $kits->find_by_camiseta_e_tipo('M','azul', $row->codigo_evento );
			echo "<td>" . mysql_num_rows($consulta_azul). "</td>";
		}
		echo "</tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('G','', $row->codigo_evento );
		echo "<tr><td><b>Camisetas G:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td>";
		if ( $numkitstipo == 2)
		{
			$consulta_azul = $kits->find_by_camiseta_e_tipo('G','azul', $row->codigo_evento );
			echo "<td>" . mysql_num_rows($consulta_azul). "</td>";
		}
		echo "</tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('GG','', $row->codigo_evento );
		echo "<tr><td><b>Camisetas GG:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td>";
		if ( $numkitstipo == 2)
		{
			$consulta_azul = $kits->find_by_camiseta_e_tipo('GG','azul', $row->codigo_evento );
			echo "<td>" . mysql_num_rows($consulta_azul). "</td>";
		}
		echo "</tr>";

		$consulta_cinza = $kits->find_by_camiseta_e_tipo('EG','', $row->codigo_evento );
		echo "<tr><td><b>Camisetas EG:</b></td><td> " . mysql_num_rows($consulta_cinza) . "</td>";
		if ( $numkitstipo == 2)
		{
			$consulta_azul = $kits->find_by_camiseta_e_tipo('EG','azul', $row->codigo_evento );
			echo "<td>" . mysql_num_rows($consulta_azul). "</td>";
		}
		echo "</tr>";

		echo "</table>";

		echo "</div>
		</div>
	</tr>
	<tr>
		<td align='right' colspan='2' >

		</td>
	</tr>
	<tr>
		<td height='10' colspan='2'></td>
	</tr>
	</table>
	</td></tr>
			";

		}
		if($total==0)
			echo "Nenhum evento cadastrado";
	?>
	</table>

	</div>
</div>


</div><!--Content-->
