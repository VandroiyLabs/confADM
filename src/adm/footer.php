<div id="sidebar">
	<div id="menu" class='boxed'>
	<h2 class="title"><?=$adm->get_nome();?></h2>
		<ul onclick='menu()'>

		<li class='superior_exit'><a href="http://sifsc.ifsc.usp.br/adm/logconfig/logout.php" title="">Sair</a></li>

		<li class='superior'><a onclick="menuhide('1')" title="">SIFSC</a></li>
		<?php $contador = 0; ?>
			<li <?php if($selected == 1.1) echo "class='active'"; echo "id=menuitem1".$contador++; ?>><a href="http://sifsc.ifsc.usp.br/adm/pg_evento/home.php?p1=info" title="">Informações</a></li>

		<?php $contador = 0; ?>
		<li class='superior'><a onClick="menuhide('2')" title="">Site</a></li>

				<li <?php if($selected == 2.1) echo "class='active'"; echo "id=menuitem2".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_site/home.php?p1=noticias" title="">Blog</a></li>
				<li <?php if($selected == 2.2) echo "class='active'"; echo "id=menuitem2".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_site/home.php?p1=programacao" title="">Programação</a></li>
				<li <?php if($selected == 2.5) echo "class='active'"; echo "id=menuitem2".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_site/home.php?p1=opiniao" title="">Pesquisa de Opinião</a></li>
				<li <?php if($selected == 2.3) echo "class='active'"; echo "id=menuitem2".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_site/home.php?p1=kits" title="">Kits</a></li>
				<li <?php if($selected == 2.4) echo "class='active'"; echo "id=menuitem2".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_site/home.php?p1=relatorio" title="">Relatórios</a></li>

		<?php $contador = 0; ?>
		<li class='superior'><a onClick="menuhide('3')" title="">Participantes</a></li>

				<li <?php if($selected == 3.1) echo "class='active'"; echo "id=menuitem3".$contador++; ?>><a href="http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=incluir&opcao=new" title="">Incluir participante</a></li>
				<li <?php if($selected == 3.2) echo "class='active'"; echo "id=menuitem3".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=listar" title="">Listar participantes</a></li>
				<li <?php if($selected == 3.3) echo "class='active'"; echo "id=menuitem3".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=pesquisar" title="">Pesquisar</a></li>
				<li <?php if($selected == 3.4) echo "class='active'"; echo "id=menuitem3".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=relatorio" title="">Relatórios</a></li>
				<li <?php if($selected == 3.5) echo "class='active'"; echo "id=menuitem3".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=crachas" title="">Crachás</a></li>
				<li <?php if($selected == 3.6) echo "class='active'"; echo "id=menuitem3".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=frequencia" title="">Frequência</a></li>
				<li <?php if($selected == 3.7) echo "class='active'"; echo "id=menuitem3".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=certificados" title="">Certificados</a></li>
				<li <?php if($selected == 3.8) echo "class='active'"; echo "id=menuitem3".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=livro" title="">Livro de Resumos</a></li>


		<?php $contador = 0; ?>
		<li class='superior'><a onClick="menuhide('4')" title="">Minicursos</a></li>
				<li <?php if($selected == 4.1) echo "class='active'"; echo "id=menuitem4".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_minicurso/home.php?page=incluir" title="">Incluir</a></li>
				<li <?php if($selected == 4.2) echo "class='active'"; echo "id=menuitem4".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_minicurso/home.php?page=listar" title="">Listar</a></li>
				<li <?php if($selected == 4.5) echo "class='active'"; echo "id=menuitem4".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_minicurso/home.php?page=relatorio" title="">Relatórios</a></li>


		<?php $contador = 0; ?>
		<li class='superior'><a onClick="menuhide('5')" title="">Avaliação</a></li>
				<li <?php if($selected == 5.1) echo "class='active'"; echo "id=menuitem5".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=incluir" title="">Incluir avaliador</a></li>
				<li <?php if($selected == 5.2) echo "class='active'"; echo "id=menuitem5".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=listar" title="">Listar avaliador</a></li>
				<li <?php if($selected == 5.5) echo "class='active'"; echo "id=menuitem5".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=atribuicao_resumo" title="">Atribuição Resumo</a></li>
				<li <?php if($selected == 5.8) echo "class='active'"; echo "id=menuitem5".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=atribuicao_poster" title="">Atribuição Poster</a></li>
				<li <?php if($selected == 5.6) echo "class='active'"; echo "id=menuitem5".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=relatorio" title="">Relatórios</a></li>
				<li <?php if($selected == 5.7) echo "class='active'"; echo "id=menuitem5".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_avaliador/home.php?page=premiacao" title="">Premiação</a></li>

		<?php $contador = 0; ?>
		<li class='superior'><a onClick="menuhide('6')" title="">Administração</a></li>
				<li <?php if($selected == 6.1) echo "class='active'"; echo "id=menuitem6".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_adm/home.php?p1=incluir" title="">Incluir</a></li>
				<li <?php if($selected == 6.2) echo "class='active'"; echo "id=menuitem6".$contador++;?>><a href="http://sifsc.ifsc.usp.br/adm/pg_adm/home.php?p1=listar" title="">Listar</a></li>


			<li class='superior_exit' id='exit'><a href="http://sifsc.ifsc.usp.br/adm/logconfig/logout.php" title="">Sair</a></li>
		</ul>
	</div>
</div><!--Sidebar-->

</div> <!--Page-->

<div id="footer">
	<p id="legal"> | C - Developed by VANDROIY LABS (2012).</p>
	<p id="links"></p>
</div>

<div id='session_counter' onmouseover='showExpireSessionAlert()'>
	Seção expira em: <span id="session_counter_timemin">20</span> min <span id="session_counter_times">01</span> s.
</div>

<div id='session_counter_aviso' onmouseout='hideExpireSessionAlert()'>
	Não é recomendável manter o computador simplesmente aberto e parado no sistema. Para que sua sessão não acabe e não haja problemas, ao fim de 20 minutos (veja o contador) sua página será automaticamente recarregada. Caso esteja editando um resumo, <b>salve em intervalos menores de 20 minutos suas alterações</b>. <br /><br /> Para esconder este quadro, passe o mouse por cima e tire-o em seguida.
</div>

</body>
</html>
