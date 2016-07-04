<?php


	require_once("~/public_html/sifsc/user/classes/class.pessoa.php");
	require_once("~/public_html/sifsc/user/classes/class.evento.php");
	require_once("~/public_html/sifsc/user/classes/class.inscricao.php");
	require_once("~/public_html/sifsc/user/classes/class.resumo.php");
	require_once("~/public_html/sifsc/user/classes/class.autor.php");

	session_start();
	require_once("./../user_edition_variables.php");
	require_once($head_file);

	require_once("~/public_html/sifsc/user/restricted.php");
	require_once("~/public_html/sifsc/user/event/secao.php");


	include('index.php');

	$resumo = new Resumo();
	$resumo->find_by_codigo($inscricao->get_codigo_resumo());
	$_SESSION['resumo'] = $resumo;
	unset( $_SESSION['abstract_question'] );
?>




<div id="user_system">


	<div id="titulo_form_secao">
		Utilizando \(\LaTeX\)
	</div>

	<p class="textocorrido">O \(\LaTeX\) é uma linguagem de marcação (semelhante ao HTML) utilizada com frequência em congressos e revistas científicas. Serve para criação de textos estruturados, em que as formatações saem de foco e não são, quase sempre, definidas pelo usuário. A idéia em geral é fazer com que o usuário escreva seu texto e a formatação fique por conta da organização do evento ou da editora responsável. Este é o nosso caso: utilizaremos esta linguagem para confeccionar nosso livro texto.</p>

	<p class="textocorrido">Uma das vantagens indiretas para os participantes da II SIFSC é a criação de um modelo, que já segue os altos padrões do IFSC, que pode ser facilmente modaldo para diferentes temas (sem perda de formatação). Uma vantagem mais direta aos participantes é a possibilidade de utilizar símbolos matemáticos sem sacrifícios.</p>

	<p class="textocorrido">Para inserir \(\LaTeX\) em seu resumo, basta escrever o código entre \(\backslash(\) e \(\backslash)\). Ao salvar seu resumo, você já pode ver como ficam os símbolos matemáticos. Neste momento, <b>corrija qualquer problema em seu código</b>. Se você utilizar qualquer macro inválida, um aviso em amarelo aparecerá.</p>

	<p class="textocorrido">Caso você não tenha familiaridade com os símbolos, há dezenas de listas com os respectivos códigos. Alguns links interessantes para símbolos matemáticos:</p>
	<ul>
		<li><a href="http://omega.albany.edu:8008/Symbols.html" target="_blank">Lista de símbolos da Albany University</a></li>
		<li><a href="http://web.ift.uib.no/Teori/KURS/WRK/TeX/symALL.html" target="_blank">Lista de símbolos da Institutt for Fysikk og Teknologi</a></li>
	</ul>


	<p class="textocorrido">Para visualizar os resumos que utilizaram \(\LaTeX\) apropriadamente, utilizamos o <a href="http://www.mathjax.org/" target="_blank">MathJax</a> (software livre). Alguns exemplos:</p>

	<ul>
		<li>\( \psi( {\bf r} ) = e^{-i {\bf k} \cdot {\bf r} } \quad \rightarrow \,\) \psi( {\bf r} ) = e^{-i {\bf k} \cdot {\bf r} }</li>
		<li>\( \int\limits_{X} f \, d\mu \quad \rightarrow \,\) \int\limits_{X} f \, d\mu</li>
		<li>\( \sigma \times \nabla V( {\bf r} ) \cdot {\bf P} \quad \rightarrow \,\) \sigma \times \nabla V( {\bf r} ) \cdot {\bf P} </li>
	</ul>

	<p class="textocorrido">A ideia de possibilitar o uso desta linguagem é uma tentativa de ajudá-los, e estamos à disposição para quaisquer dúvidas.</p>

</div>

<?php
 require_once($foot_file);
?>
