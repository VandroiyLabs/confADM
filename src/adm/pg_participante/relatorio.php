<?php

echo "
<script src=\"http://sifsc.ifsc.usp.br/js/jquery-1.9.1.min.js\"></script>
<script src=\"http://sifsc.ifsc.usp.br/js/knockout-2.2.1.js\"></script>
<script src=\"http://sifsc.ifsc.usp.br/js/globalize.js\"></script>
<script src=\"http://sifsc.ifsc.usp.br/js/dx.chartjs.js\"></script>
";

function number_significant($number, $decimals, $sep1='.', $sep2='') {
        if (($number * pow(10 , $decimals + 1) % 10 ) == 5)  //if next not significant digit is 5
            $number -= pow(10 , -($decimals+1));
        return number_format($number, $decimals, $sep1, $sep2);
}
?>


<div id="content">
<div class="post">
<div class="content">

	<h2>Relatório de Participantes</h2>

	<?php
	$evento = new Evento();
	$evento->find_evento_aberto();
	$num_eventos = $evento->get_codigo_evento();

	echo '
	<form name="input" action="http://sifsc.ifsc.usp.br/adm/pg_participante/home.php" method="get">
		Edição:
		<select style="width: 70px" name="evento">';

	for ($j = $num_eventos; $j >= 1; $j--)
	{
		$evento->find_by_codigo($j);
		echo  '<option value="' . $evento->get_codigo_evento() . '">' . $evento->get_nome() . '</option>';
	}
	echo '
		</select>
		<input name="p1" value="relatorio" type="hidden" />
		&nbsp;&nbsp;&nbsp;
		<input type="submit" value="Submit" class="button_azul">
	</form> ';


	// Numero de algarismos significativos para as porcentagens
	$alg_sign = 0;

	$pessoa = new Pessoa();
	$inscricao = new Inscricao();
	$evento = new Evento();


	// Selecting which event to display
	if ( isset($_GET['evento']) and $_GET['evento'] <= 3 )
	{
		$evento->find_by_codigo( $_GET['evento'] );
	}
	else
	{
		$evento->find_evento_aberto();
	}


	echo "
	<h3 class='mc_title'>
		Geral
	</h3>";

	$total_insc = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', '') );
	$total_dadospessoais = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.modalidade LIKE '1%' ") );
	$total_semdadospessoais = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.modalidade LIKE '0%' and Inscricao.token = 'ativado' ") );
	$total_semativar = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.token <> 'ativado' ") );

	echo "<p class='mc_report_largespace'>Total de inscritos: <b>$total_insc</b></p>";
	echo "<p class='mc_report'>N. com dados pessoais: <font color='Green'><b>$total_dadospessoais</b></font></p>";
	echo "<p class='mc_report'>N. sem dados pessoais: $total_semdadospessoais</p>";
	echo "<p class='mc_report_largespace'>N. sem ativar a conta: $total_semativar</p>";

	$total_PG = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " AND Inscricao.modalidade LIKE '1%' AND Inscricao.instituicao = 'IFSC-USP' AND ( Inscricao.nivel = \"Mestrado\" OR Inscricao.nivel = \"Doutorado\" ) ") );
	$total_grad = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " AND Inscricao.modalidade LIKE '1%' AND Inscricao.instituicao = 'IFSC-USP' AND Inscricao.nivel = \"Graduacao\" ") );


	echo "<p class='mc_report'>N. Pós IFSC com dados pessoais: $total_PG</p>";
	echo "<p class='mc_report'>N. com dados pessoais: $total_grad</font></p>";


	echo "
	<h3 class='mc_title'>
		Contagens de Inscrições
	</h3>";

	$conta0 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Graduacao' and Inscricao.curso = 'Bacharelado em Física' ") );
	/*echo "<p class='mc_report_largespace'>Graduação - Bacharelado em Física: <b>$conta</b></p>";*/
	$conta1 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Graduacao' and Inscricao.curso = 'Bacharelado em Física Computacional' ") );
	/*echo "<p class='mc_report_largespace'>Graduação - Física Computacional: <b>$conta</b></p>";*/
	$conta2 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Graduacao' and Inscricao.curso = 'Bacharelado em Ciências Físicas e Biomoleculares' ") );
	/*echo "<p class='mc_report_largespace'>Graduação - Fisica Biomolecular: <b>$conta</b></p>";*/
	$conta3 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Graduacao' and Inscricao.curso LIKE '==%' ") );
	/*echo "<p class='mc_report_largespace'>Graduação - Outros cursos: <b>$conta</b></p>";*/

	$contatot = $conta0 + $conta1 + $conta2 + $conta3;

	echo "<script type=\"text/javascript\">
			$(function ()
				{
   var dataSource = [
    { country: 'Fisica', area: $conta0 },
    { country: 'Fiscomp', area: $conta1 },
    { country: 'Biomol', area: $conta2 },
    { country: 'Outros', area: $conta3 },
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
    title: '<span style=\"font-size: 15px; color: #333;\">Graduacao: $contatot</span>'
});
}

			);
	</script>
	<div id=\"pieContainer\" style=\"width: 300px; height: 280px;\"></div>
	";



	$conta0 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Mestrado' and Inscricao.curso = 'Física Básica' ") );
	$conta1 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Mestrado' and Inscricao.curso = 'Física Aplicada' ") );
	$conta2 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Mestrado' and Inscricao.curso = 'Física Aplicada Computacional' ") );
	$conta3 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Mestrado' and Inscricao.curso = 'Física Aplicada Biomolecular' ") );
	$conta4 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Mestrado' and Inscricao.curso LIKE '==%' ") );

	$contatot = $conta0 + $conta1 + $conta2 + $conta3 + $conta4;

	echo "<script type=\"text/javascript\">
			$(function ()
				{
   var dataSource = [
    { country: 'Fis Basica', area: $conta0 },
    { country: 'Fis Aplicada', area: $conta1 },
    { country: 'FisComp', area: $conta2 },
    { country: 'BioMol', area: $conta3 },
    { country: 'Outros', area: $conta4 },
];

var chart = $(\"#pieContainermestrado\").dxPieChart({
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
    title: '<span style=\"color: #333;\">Mestrado: $contatot</span>'
});
}

			);
	</script>
	<div id=\"pieContainermestrado\" style=\"width: 300px; height: 280px;\"></div>
	";


	$conta0 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Doutorado' and Inscricao.curso = 'Física Básica' ") );
	$conta1 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Doutorado' and Inscricao.curso = 'Física Aplicada' ") );
	$conta2 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Doutorado' and Inscricao.curso = 'Física Aplicada Computacional' ") );
	$conta3 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Doutorado' and Inscricao.curso = 'Física Aplicada Biomolecular' ") );
	$conta4 = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Doutorado' and Inscricao.curso LIKE '==%' ") );

	$contatot = $conta0 + $conta1 + $conta2 + $conta3 + $conta4;

	echo "<script type=\"text/javascript\">
			$(function ()
				{
   var dataSource = [
    { country: 'Fis Basica', area: $conta0 },
    { country: 'Fis Aplicada', area: $conta1 },
    { country: 'FisComp', area: $conta2 },
    { country: 'BioMol', area: $conta3 },
    { country: 'Outros', area: $conta4 },
];

var chart = $(\"#pieContainerdoutorado\").dxPieChart({
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
    title: '<span style=\"color: #333;\">Doutorado: $contatot</span>'
});
}

			);
	</script>
	<div id=\"pieContainerdoutorado\" style=\"width: 300px; height: 280px;\"></div>
	";





	echo "
	<h3 class='mc_title'>
		Contagens de Trabalhos Inscritos
	</h3>";

	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Graduacao' and Inscricao.curso = 'Bacharelado em Física' and Inscricao.situacao_resumo = 5") );
	echo "<p class='mc_report_largespace'>Graduação - Bacharelado em Física: <b>$conta</b></p>";
	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Graduacao' and Inscricao.curso = 'Bacharelado em Física Computacional' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Graduação - Física Computacional: <b>$conta</b></p>";
	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Graduacao' and Inscricao.curso = 'Bacharelado em Ciências Físicas e Biomoleculares' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Graduação - Fisica Biomolecular: <b>$conta</b></p>";
	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Graduacao' and Inscricao.curso LIKE '==%' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Graduação - Outros cursos: <b>$conta</b></p>";

	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Mestrado' and Inscricao.curso = 'Física Básica' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Mestrado - Física Básica: <b>$conta</b></p>";
	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Mestrado' and Inscricao.curso = 'Física Aplicada' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Mestrado - Física Aplicada: <b>$conta</b></p>";
	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Mestrado' and Inscricao.curso = 'Física Aplicada Computacional' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Mestrado - Física Aplicada Computacional: <b>$conta</b></p>";
	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Mestrado' and Inscricao.curso = 'Física Aplicada Biomolecular' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Mestrado - Física Aplicada Biomolecular: <b>$conta</b></p>";
	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Mestrado' and Inscricao.curso LIKE '==%' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Mestrado - Outros cursos: <b>$conta</b></p>";

	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Doutorado' and Inscricao.curso = 'Física Básica' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Doutorado - Física Básica: <b>$conta</b></p>";
	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Doutorado' and Inscricao.curso = 'Física Aplicada' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Doutorado - Física Aplicada: <b>$conta</b></p>";
	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Doutorado' and Inscricao.curso = 'Física Aplicada Computacional' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Doutorado - Física Aplicada Computacional: <b>$conta</b></p>";
	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Doutorado' and Inscricao.curso = 'Física Aplicada Biomolecular' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Doutorado - Física Aplicada Biomolecular: <b>$conta</b></p>";
	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', " and Inscricao.nivel = 'Doutorado' and Inscricao.curso LIKE '==%' and Inscricao.situacao_resumo = 5 ") );
	echo "<p class='mc_report_largespace'>Doutorado - Outros cursos: <b>$conta</b></p>";




	echo "
	<h3 class='mc_title'>
		Listas de nomes
	</h3>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=listanomes&mod=IFSC'>Lista dos nomes de participantes com resumo da pós do IFSC</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=listanomes'>Lista dos nomes de todos os participantes (com dados pessoais)</a></p>";
echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=listanomes_e_emails'>Lista dos nomes de todos os participantes (nome e email)</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=listanomes&mod=15___'>Lista dos nomes de participantes que apresentam poster</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=listanomes&mod=15___&cod=1'>Lista dos nomes de participantes que apresentam poster (<b>com código</b>)</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=listanomes&mod=1___4'>Lista dos nomes de participantes que apresentam obra artística</a></p>";
	echo "<p class='mc_report_largespace'><a href='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=listanomes&mod=100_0'>Lista dos nomes de participantes sem apresentação</a></p>";

	echo "
	<h3 class='mc_title'>
		Resumos submetidos
	</h3>";

	$total = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', ' AND situacao_resumo IN (2,5) ') );
	echo "<p class='mc_report_largespace'>N. resumos  submetidos (aceitos + aguardando deferimento): <b>$total</b></p>";

	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', ' AND situacao_resumo IN (2,5) AND Inscricao.instituicao = "IFSC-USP" ') );
	$perc = $conta/$total*100;
	echo "<p class='mc_report'>N. resumos do IFSC: <font color='Green'><b>$conta</b></font> &nbsp;&nbsp;&nbsp;(" . number_significant($perc, $alg_sign) . "%)</p>";

	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', ' AND situacao_resumo IN (2,5) AND Inscricao.instituicao = "IFSC-USP" AND ( Inscricao.nivel = "Mestrado" OR Inscricao.nivel = "Doutorado" ) ') );
	$perc = $conta/$total*100;
	echo "<p class='mc_report'>N. resumos  IFSC (IFSC - Pós): <b>$conta</b> &nbsp;&nbsp;&nbsp;(" . number_significant($perc, $alg_sign) . "%)</p>";

	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', ' AND situacao_resumo IN (2,5) AND Inscricao.instituicao = "IFSC-USP" AND Inscricao.nivel = "Graduacao" ') );
	$perc = $conta/$total*100;
	echo "<p class='mc_report_largespace'>N. resumos  IFSC (IFSC - Grad): <b>$conta</b> &nbsp;&nbsp;&nbsp;(" . number_significant($perc, $alg_sign) . "%)</p>";


	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', ' AND situacao_resumo IN (2,5) AND Inscricao.instituicao LIKE "%ICMC%" ') );
	$perc = $conta/$total*100;
	echo "<p class='mc_report'>N. resumos  ICMC: $conta &nbsp;&nbsp;&nbsp;(" . number_significant($perc, $alg_sign) . "%)</p>";

	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', ' AND situacao_resumo IN (2,5) AND Inscricao.instituicao LIKE "%IQSC%" ') );
	$perc = $conta/$total*100;
	echo "<p class='mc_report'>N. resumos  IQSC: $conta &nbsp;&nbsp;&nbsp;(" . number_significant($perc, $alg_sign) . "%)</p>";

	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', ' AND situacao_resumo IN (2,5) AND Inscricao.instituicao LIKE "%UFSC%" ') );
	$perc = $conta/$total*100;
	echo "<p class='mc_report_largespace'>N. resumos  UFSCar: $conta &nbsp;&nbsp;&nbsp;(" . number_significant($perc, $alg_sign) . "%)</p>";


	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', ' AND situacao_resumo IN (3)') );
	echo "<p class='mc_report'>Total atualmente em correção: $conta</p>";

	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', ' AND situacao_resumo IN (3) AND ( Inscricao.nivel = "Mestrado" OR Inscricao.nivel = "Doutorado" ) ') );
	echo "<p class='mc_report'>Atualmente em correção (IFSC - Pós): $conta</p>";

	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', ' AND situacao_resumo IN (2) ') );
	echo "<p class='mc_report_largespace'>N. resumos  aguardando (in)deferimento: <font color='Red'><b>$conta</b></font></p>";

	$conta = mysql_num_rows( $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),'', ' AND situacao_resumo IN (2) AND Inscricao.instituicao = "IFSC-USP" AND ( Inscricao.nivel = "Mestrado" OR Inscricao.nivel = "Doutorado" ) ') );
	echo "<p class='mc_report_largespace'>N. aguardando (in)deferimento do IFSC Pós: <font color='Red' size='3pt'><b>$conta</b></font></p>";

	?>

</div>
</div>
</div>
