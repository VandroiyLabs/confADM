<?php
$home = "/home/" . get_current_user() . "/";

	require_once($home . "public_html/sifsc/user/classes/class.pessoa.php");
	require_once($home . "public_html/sifsc/user/classes/class.evento.php");
	require_once($home . "public_html/sifsc/user/classes/class.inscricao.php");
	require_once($home . "public_html/sifsc/user/classes/class.arte.php");
	require_once($home . "public_html/sifsc/user/classes/class.minicurso.php");
	require_once($home . "public_html/sifsc/user/classes/class.avalia_poster.php");
	require_once($home . "public_html/sifsc/user/classes/class.participa_minicurso.php");
	require_once($home . "public_html/sifsc/user/classes/class.resumo.php");
	session_start();
	require_once("./../user_edition_variables.php");
	require_once($head_file);

	require_once($home . "public_html/sifsc/user/restricted.php");
	require_once($home . "public_html/sifsc/user/event/secao.php");

	include('index.php');

?>

<script>
function favBrowser()
{
	var eddown=document.getElementById("edicao");

	document.getElementById("II SIFSC").style.display = 'none';
	document.getElementById("SIFSC 4").style.display = 'none';
	document.getElementById("SIFSC 5").style.display = 'none';
	document.getElementById(eddown.options[eddown.selectedIndex].text).style.display = 'inline';
}
</script>

<div id="user_system">

	<div id="titulo_form_secao">
		Downloads disponibilizados
	</div>

	<div id="status">

		<p>Nesta seção, você tem acesso aos arquivos disponibilizados pelos palestrantes e/ou utilizados nos minicursos, tais como apresentações, códigos ou materiais complementares. Selecione abaixo a edição.</p>

		<br />
		<div style="width: 200px; margin: 0 auto 0 auto;">
		<span style="color: #223C7F;"><b>Escolha a edição: </b></span>
		<select id="edicao" onchange="favBrowser()">
		    <option>SIFSC 5</option>
		    <option>SIFSC 4</option>
		    <option>II SIFSC</option>
		 </select>
		 </div>

		<div id="SIFSC 5" style="display: inline;">
		<div class="titulo_secao">SIFSC 5</div>
		<ul style="list-style-type:square;">
			<li><a href="http://sifsc.ifsc.usp.br/2015/livro_de_resumos_2015.pdf" target="_blacnk">Livro de resumos</a> da SIFSC 5</li>
		</ul>
		</div>


		<div id="SIFSC 4" style="display: none;">
		<div class="titulo_secao">SIFSC 2014</div>

		<div class="titulo_secao">Minicursos</div>

		<ul style="list-style-type:square;">
			<li> <a>Cronobiologia</a> por profa. Dra. Gisele A. Oda (USP)<br />
<a href="http://sifsc.ifsc.usp.br/downloads/2014/AulaSIFSC1.pdf" target="_blank"> Aula 1</a><br />
<a href="http://sifsc.ifsc.usp.br/downloads/2014/AulaSIFSC2.pdf" target="_blank"> Aula 2</a></li>
			<li><a href="http://sifsc.ifsc.usp.br/downloads/2014/Escolasaocarlos.pdf" target="_blank">Tópicos em ótica e informação quântica</a> por prof. Dr. Sebastião de Pádua (UFMG)</li>

<li> <a>Introdução aos métodos numéricos para mecânica dos fluidos</a> por Prof. Dr. Fabricio Simeoni de Sousa<br />
<a href="http://sifsc.ifsc.usp.br//downloads/2014/mfc1-part2.pdf" target="_blank"> Parte 2</a><br />
<a href="http://sifsc.ifsc.usp.br//downloads/2014/mfc1-part3.pdf" target="_blank"> Parte 3</a><br />
<a href="http://sifsc.ifsc.usp.br//downloads/2014/mfc1-part4.pdf" target="_blank"> Parte 4</a><br />
<a href="http://sifsc.ifsc.usp.br//downloads/2014/mfc1-part5.pdf" target="_blank"> Parte 5</a></li>

<li><a href="http://sifsc.ifsc.usp.br/downloads/2014/MiniCursoCosmologia-USP-SaoCarlos_2014.pdf" target="_blank">O UNIVERSO: PASSADO, PRESENTE E FUTURO</a> por prof. Dr. Nivaldo Lemos (UFF)</li>

<li><a href="http://sifsc.ifsc.usp.br/downloads/2014/SC14PPR.pdf" target="_blank">Física, aprendizado e ensino: acertos e erros</a> por prof. Dr. Antonio F. R. de Toledo Piza (IF-USP)</li>

<li><a href="http://sifsc.ifsc.usp.br/downloads/2014/QCDnaRede.pdf" target="_blank">QCD na Rede e a Vida Íntima dos Quarks</a> por profa. Dra. Tereza Mendes (IFSC-USP)</li>

		</ul>
		</div>



		<div id="II SIFSC" style="display: none;">
		<div class="titulo_secao">SIFSC 2012</div>

		<ul style="list-style-type:square;">
			<li><a href="http://sifsc.ifsc.usp.br/downloads/Livro_de_Resumos_II_SIFSC.pdf" target="_blacnk">Livro de resumos</a> da II SIFSC</li>
		</ul>

		<div class="titulo_secao">Seminários</div>

		<ul style="list-style-type:square;">
			<li>Slides - <a href="http://sifsc.ifsc.usp.br/downloads/luizdavidovich_SIFSC_2012_20121016.pdf" target="_blacnk">Surpresas do Mundo Quântico</a> por prof. Dr. Luiz Davidovich (UFRJ)</li>
			<li>Slides - <a href="http://sifsc.ifsc.usp.br/downloads/SIFSC_2012_Makler.pdf" target="_blacnk">Desafios da Cosmologia para o Século XXI</a> por prof. Dr. Martín Markler (CBPF, ICRA, LINEA)</li>
			<li>Slides - <a href="http://sifsc.ifsc.usp.br/downloads/Tavares_SIFSC_2012_NVIDIA.pdf" target="_blacnk">A Revolução das GPU's</a> por MBA Arnaldo Tavares (NVIDIA)</li>
			<li>Slides - <a href="http://sifsc.ifsc.usp.br/downloads/Mosqueiro_SIFSC_2012_LaTeX.pdf" target="_blacnk">LaTeX e BibTeX para teses e dissertações no IFSC</a> por Thiago Mosqueiro (IFSC) e Jaqueline Brito (ICMC). Clique <a target="_blank" href="http://thmosqueiro.vandroiy.com/ifsc-latex/">aqui</a> para o site com o pacote LaTeX.</li>
		</ul>

		<div class="titulo_secao">Minicursos</div>

		<ul style="list-style-type:square;">
			<li><a href="http://sifsc.ifsc.usp.br/downloads/Guido_II_sifsc_2012_palestra_processamento_de_sinais_ifsc_usp.pdf" target="_blacnk">M2 - Processamento de Sinais para Físicos: técnicas e aplicações</a> por prof. Dr. Rodrigo Guido (UNESP)</li>
			<li><a href="http://sifsc.ifsc.usp.br/downloads/Bolfarine_SIFSC_2012_NOTASSAOCARLOS.pdf" target="_blacnk">M6 -  Inferência Estatística Básica</a> por prof. Dr. Heleno Bolfarine (IME-USP)</li>
			<li><a href="http://sifsc.ifsc.usp.br/downloads/Egues_SIFSC_2012.pdf" target="_blacnk">M7 - Novas Tendências em Matéria Condensada</a> por prof. Dr. José Carlos Egues (IFSC)</li>
		</ul>
		</div>

	</div>

</div>

<?php  require_once($foot_file);?>
