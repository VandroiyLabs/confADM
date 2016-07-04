<?php 
	echo "<div id=\"showarte\">";
	echo "<p class=\"titulo\">" . $arte->get_titulo() . "</p>";
	echo "<p class=\"tipo\">Tipo de obra: " . $arte->get_tipo_obra() . "</p>";
	echo "<p class=\"tipo\">Tipo de apresentação: " . $arte->get_tipo_apresentacao() . "</p>";
	echo "<p class=\"medidas\">Altura: " . $arte->get_altura() . "cm</p>";
	echo "<p class=\"medidas\">Profundidade: " . $arte->get_profundidade() . "cm</p>";
	echo "<p class=\"medidas\">Largura: " . $arte->get_largura() . "cm</p>";
	echo "<p class=\"descricao\">Descricao: " . $arte->get_descricao() . "</p>";
	echo "</div>";
?>
