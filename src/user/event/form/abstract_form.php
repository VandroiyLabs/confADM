<?php

if(isset($_GET["lng"]))
{
	if($_GET["lng"] == 0)
	{
		$lingua = 'port';
	}
	else
	{
		$lingua = "eng";
	}
}
else
{
	$lingua = "port";
}

$status = array(
        "port" => "",
	"eng" => "disabled=\"true\""

);


$orientadores = array(
0 =>"",
1 =>"Adriano Defini Andricopulo",
2 =>"Albérico Borges Ferreira da Silva",
3 =>"Alberto Tannus",
4 =>"Ana Paula Ulian de Araujo",
5 =>"Andrea Simone Stucchi de Camargo Alvarez Bernardez",
6 =>"Antonio Carlos Hernandes",
7 =>"Antônio José da Costa Filho",
8 =>"Antonio Ricardo Zanatta",
9 =>"Attílio Cucchieri",
10 =>"Bernhard Joachim Mokross",
11 =>"Cibelle Celestino Silva",
12 =>"Claudia Elisabeth Munte",
13 =>"Cleber Renato Mendonça",
14 =>"Cristina Kurachi",
15 =>"Daniel Augusto Turolla Vanzella",
16 =>"Daniel Varela Magalhães",
17 =>"Debora Goncalves",
18 =>"Debora Marcondes Bastos Pereira Milori",
19 =>"Diogo de Oliveira Soares Pinto",
20 =>"Eduardo Horjales Reboredo",
21 =>"Eduardo Ribeiro de Azevêdo",
22 =>"Esmerindo de Sousa Bernardes",
23 =>"Euclydes Marega Junior",
24 =>"Francisco Aparecido Rodrigues",
25 =>"Francisco Castilho Alcaraz",
26 =>"Francisco Eduardo Gontijo Guimaraes",
27 =>"Glaucius Oliva",
28 =>"Gonzalo Travieso",
29 =>"Guilherme Matos Sipahi",
30 =>"Hellmut Eckert",
31 =>"Humberto D'Muniz Pereira",
32 =>"Igor Polikarpov",
33 =>"Ilana Lopes Baratella da Cunha Camargo",
34 =>"Jan Frans Willem Slaets",
35 =>"Jarbas Caiado de Castro Neto",
36 =>"Javier Alcides Ellena",
37 =>"Jean Claude M'Peko",
38 =>"Jose Carlos Egues de Menezes",
39 =>"Jose Eduardo Martinho Hornos",
40 =>"Jose Fabian Schneider",
41 =>"Jose Fernando Fontanari",
42 =>"Jose Pedro Donoso Gonzalez",
43 =>"Juarez Lopes Ferreira da Silva",
44 =>"Kilvia Mayre Farias Magalhães",
45 =>"Leandro Martínez",
46 =>"Leonardo Paulo Maia",
47 =>"Lino Misoguti",
48 =>"Luciano da Fontoura Costa",
49 =>"Luis Gustavo Marcassa",
50 =>"Luiz Agostinho Ferreira",
51 =>"Luiz Alberto Colnago",
52 =>"Luiz Nunes de Oliveira",
53 =>"Luiz Vitor de Souza Filho",
54 =>"Marcos Vicente de Albuqueque Salles Navarro",
55 =>"Mario de Oliveira Neto",
56 =>"Maximo Siu Li",
57 =>"Miled Hassan Youssef Moussa",
58 =>"Milton Ferreira de Souza",
59 =>"Natalia Mayumi Inada Bortoleto",
60 =>"Nelma Regina Segnini Bossolan",
61 =>"Odemir Martinez Bruno",
62 =>"Osvaldo Novais de Oliveira Junior",
63 =>"Otaciro Rangel Nascimento",
64 =>"Otavio Henrique Thiemann",
65 =>"Paulo Barbeitas Miranda",
66 =>"Paulo Estevão Cruvinel",
67 =>"Philippe Wilhelm Courteille",
68 =>"Rafael Victório Carvalho Guido",
69 =>"Reginaldo de Jesus Napolitano",
70 =>"Reynaldo Daniel Pinto",
71 =>"Ricardo De Marco",
72 =>"Richard Charles Garratt",
73 =>"Roberto Mendonça Faria",
74 =>"Rodrigo Capobianco Guido",
75 =>"Rodrigo Gonçalves Pereira",
76 =>"Sergio Carlos Zilio",
77 =>"Tereza Cristina da Rocha Mendes",
78 =>"Tito Jose Bonagamba",
79 =>"Valmor Roberto Mastelaro",
80 =>"Valtencir Zucolotto",
81 =>"Vanderlei Salvador Bagnato",
82 =>"Yvonne Primerano Mascarenhas"
);



$grupo = array(
0 =>"",
1 =>"Biofísica Molecular",
2 =>"Biotecnologia Molecular",
3 =>"Computação Interdisciplinar",
4 =>"Cresc. Cristais e Mat. Cerâmicos",
5 =>"Cristalografia",
6 =>"Espectroscopia de Sólidos",
7 =>"Filmes Finos",
8 =>"Física Comput. e Instr. Aplicada",
9 =>"Física Teórica - FCM",
10 =>"Física Teórica - FFI",
11 =>"Fotônica",
12 =>"Métodos Mat. em Ciênc. Moleculares",
13 =>"Nanomedicina e Nanotoxicologia",
14 =>"Óptica",
15 =>"Polímeros",
16 =>"Ressonância Magnética",
17 =>"Semicondutores",
18 =>"OUTROS"
);

$subarea = array(
­0 =>"",
1 =>"Astronomia, Astrofísica e Cosmologia",
2 =>"­Biofísica",
3 =>"Biotecnologia Molecular",
4 =>"Cristalografia",
5 =>"Ensino de Física e História da Ciência",
6 =>"Espectroscopia",
7 =>"Física de Altas Energias, Partículas e Campos",
8 =>"Física Aplicada",
9 =>"Física Atômica e Molecular",
10 =>"Física Computacional e Simulação Numérica",
11 =>"Física Nuclear",
12 =>"Física Matemática",
13 =>"Física da Matéria Condensada",
14 =>"­Física de Materiais",
15 =>"­Física Médica e Aplicações",
16 =>"­Óptica e Lasers",
17 =>"Ressonância Magnética Nuclear­",
18 =>"­Sistemas Complexos e Caos­",
19 =>"­Teoria da Informação Quântica­",
20 =>"­Termodinâmica, Fluidodinâmica e Estatística­"
);

$tipo_ref = array(
0 => "outros",
1 => "periodico",
2 => "evento",
3 => "livro",
4 => "tese"
);






$pessoa = $_SESSION["pessoa"];
$evento = $_SESSION["evento"];

$inscricao = new Inscricao();
$inscricao->find_by_pessoa_evento( $pessoa->get_codigo_pessoa(), $evento->get_codigo_evento() );



$resumo = new Resumo();

// Caso esteja editando o resumo em ingles
if ( $ingles == 1 )
{
	$resumoing = new Resumo();

	$codigo_pra_procurar_ing = $inscricao->get_codigo_resumo_ingles();

	if ( $codigo_pra_procurar_ing != 0)
	{
		$resumoing->find_by_codigo($codigo_pra_procurar_ing);
	}

}

// Recuperando os dados do resumo em portugues
$codigo_pra_procurar = 	$inscricao->get_codigo_resumo();
if ( $codigo_pra_procurar != 0 )
{
	$resumo->find_by_codigo($codigo_pra_procurar);
	$t_ref1 = $resumo->get_tipo_ref1();
	$t_ref2 = $resumo->get_tipo_ref2();
	$t_ref3 = $resumo->get_tipo_ref3();
}
else
{
	$t_ref1 = "\"nan\"";
	$t_ref2 = "\"nan\"";
	$t_ref3 = "\"nan\"";
}

?>


<script>


hashJ = {0:"outros", 1:"periodico", 2:"livro", 3:"evento", 4:"tese"};

function updeitaCamposReferencias(e,which)
{
	var i;
	var j;
	for (i = 0; i < 5; i++)
	{
		var typeName = hashJ[i] + which;
		var elements = document.getElementsByClassName(typeName);

		if ( e.value == i ) { value = ''; }
		else { value = 'none'; }

		for (j = 0; j < elements.length; j++)
		{
			elements[j].style.display=value;
		}
	}


	TipoRef_id = e.value;
	var campos = document.getElementsByClassName("bib_obrigatorio_" + TipoRef_id + which);
	for(var j = 0; j < campos.length; j++)
	{
		campos.item(j).value = "";
	}
	var campos = document.getElementsByClassName("bib_opcional_" + TipoRef_id + which );
	for(var j = 0; j < campos.length; j++)
	{
		campos.item(j).value = "";
	}

}


function updeitaCamposReferencias__(e,which)
{
	var i;
	var j;
	for (i = 0; i < 5; i++)
	{
		var typeName = hashJ[i] + which;
		var elements = document.getElementsByClassName(typeName);

		if ( e.value == i ) { value = ''; }
		else { value = 'none'; }

		for (j = 0; j < elements.length; j++)
		{
			elements[j].style.display=value;
		}
	}

	if ( e.value == "nan" )
	{
		var tiposelect = document.getElementById("tipo_ref" + which);
		tiposelect.selectedIndex = 0;
	}
}


</script>


<table border="0" cellspacing="4" cellpadding="1" >
	<tr>
		<td align="right" width="30%">Grupo de Pesquisa:</td>
		<td  align="left"><select name="grupo" <?php echo $status[$lingua];?>>
		<?php
			for ($i = 0; $i <= 18; $i++)
			{
			    echo "<option value=\"".$grupo[$i]."\" "; if($inscricao->get_grupo() == $grupo[$i]) echo 'selected'; echo ">".$grupo[$i]."</option>";
			}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td align="right" width="30%">Subárea de Pesquisa:</td>
		<td  align="left"><select name="subarea" <?php echo $status[$lingua];?>>
		<?php
			for ($i = 0; $i <= 20; $i++)
			{
			    echo "<option value=\"".$subarea[$i]."\" "; if($inscricao->get_subarea() == $subarea[$i]) echo 'selected'; echo ">".$subarea[$i]."</option>";
			}
		?>
		</select>
		</td>
	</tr>

<?php $outro_orient=1;?>

<script type="text/javascript">
function setoutroorientador(valor)
{
	if ( valor == 'OUTRO' )
	{
		document.abstract_form.outro_orientador.disabled=false;
	}
	else
	{
		document.abstract_form.outro_orientador.disabled=true;
		document.abstract_form.outro_orientador.value='';
	}
}
</script>

	<tr>
	<td align="right" width="30%">Orientador:</td>
	<td  align="left">
		<select name="orientador" <?php echo $status[$lingua];?> onchange="setoutroorientador(this.value);" >
		<?php
			for ($i = 0; $i <= 82; $i++)
			{
			    echo "<option value=\"".$orientadores[$i]."\" "; if($inscricao->get_orientador() == $orientadores[$i]){ echo 'selected';  $outro_orient=0; } echo ">".$orientadores[$i]."</option>";
			}
		?>
			<option value="OUTRO" <?php if($outro_orient == 1){ echo 'selected'; }?> >OUTRO</option>

		</select>
	*</td>
	</tr>
	<tr>
		<td align="right" width="30%"></td>
		<td  align="left"><input type="text" name="outro_orientador" value="<?php if($outro_orient == 1) echo htmlspecialchars($inscricao->get_orientador(), ENT_QUOTES); ?>" maxlength="200" size="46" <?php echo $status[$lingua];  if ( $outro_orient != 1 ){ echo 'disabled="disabled"'; } ?> /></td>
	</tr>

	<tr>
		<td align="right" width="30%"></td>
		<td  align="left">
			<input type="checkbox" name="termos" value="1" <?php if($inscricao->get_codigo_resumo() > 0) echo 'checked';?>/> Li e aceito os <a href="<?php echo $baseurl;?>workshop.php">Termos</a>.
			<p id="termos" style="display:none;color: #a00;"><br />Você deve ler e aceitar os termos antes de prosseguir.</p>
		</td>
	</tr>
	<tr>
		<td align="right" width="30%">Deseja concorrer ao prêmio?<br />Só para alunos do IFSC</td>
		<td  align="left">
			<?php
				if ( strcmp( $inscricao->get_instituicao(), 'IFSC-USP') != 0 || ( strcmp( $inscricao->get_nivel(), 'Graduacao') != 0 && strcmp( $inscricao->get_nivel(), 'Mestrado') != 0 && strcmp( $inscricao->get_nivel(), 'Doutorado') != 0 ) )
				{
					$querpremio = "disabled='disabled'";
					$naoquerpremio =  "disabled='disabled'";

				}
				else if ( $inscricao->get_premio() == '0' || $inscricao->get_situacao_resumo() == '0' )
				{
					$querpremio = "";
					$naoquerpremio = "checked";
				}
				else
				{
					$querpremio = "checked";
					$naoquerpremio = "";
				}
			?>
			<input type="radio" name="premio" value="1" <?php echo $querpremio ?> <?php echo $status[$lingua];?> /> Sim &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="premio" value="0" <?php echo $naoquerpremio ?> <?php echo $status[$lingua];?> /> Não
		</td>
	</tr>
	<tr>
		 <td  align="right">Tempo de trabalho no projeto:</td>
		 <td  align="left"><input type="text" value="<?php echo htmlspecialchars($resumo->get_tempo(), ENT_QUOTES); ?>" name='tempo' size='4'/> meses</td>
	</tr>
		<tr>
		<td align="right" width="30%">Em qual língua está o seu resumo?</td>
		<td  align="left">
			<input type="radio" name="lingua" value="0" checked /> Português &nbsp;&nbsp;&nbsp;&nbsp;
			<input type="radio" name="lingua" value="1" <?php if($resumo->get_lingua() == 1) echo 'checked';?> /> Inglês
		</td>
	</tr>
	<tr>
		 <td  align="right"><br />T&iacute;tulo<br /><br /><br /></td>
			<?php
				if ( $ingles == 0 )
				{
					$titulo = $resumo->get_titulo();
				}
				else
				{
					$titulo = $resumoing->get_titulo();
				}
			?>
			<td align="left"><br /><input type="text" id="titulo" name="titulo" value="<?php echo htmlspecialchars($titulo, ENT_QUOTES); ?>" maxlength="200" size='46' >*<br /><br /><br /></td>
	</tr>
	<tr>
      	<td valign="top" align="center">
		<?php
			$codigo_resumo = $inscricao->get_codigo_resumo();
			$autor = new Autor();
			$nautores = $autor->numero_autores_by_resumo($codigo_resumo);

			echo "<input type='button' class='button_addauthor' value=' + Autor ' name='add_input'  id='add_input' " .
					"onClick='adicionaautor(-1);' " . $status[$lingua] . ">";
			echo "<input type='hidden' value='' name='list_authors_delete'  id='list_authors_delete' >";
			echo "		<br />";
		?>

		<br /><br />
      	</td>
		<td>
		<div id="camposTexto">

		<?php
			if ( $nautores > 0 )
			{
				for ( $j = 0; $j < $nautores; $j++ )
				{
					$autor->find_by_resumo_ordem($codigo_resumo, $j + 1);

					if ( $resumo->get_autor_principal() == $autor->get_codigo_autor() )
					{
						$status_autor = "checked";
					}
					else
					{
						$status_autor = "";
					}

					echo "\t\t\t<input type=\"hidden\" name=\"author_id" . $j . "\" id=\"author_id" . $j . "\" value=\"" . $autor->get_codigo_autor() . "\" />\n";
					echo "\t\t\t<span id=\"p1_" . $j . "\">Autor " . (string)( $j + 1 ) . ": </span><input type=\"text\" name=\"autor" . $j . "\" id=\"autor" . $j . "\" maxlength='200' value=\"" . htmlspecialchars($autor->get_nome(), ENT_QUOTES) . "\" size=\"34\" " . $status[$lingua] . " /><input type='button' class='button_deleteauthor' value=' X ' name='delete_button'  id='delete_button" . $j . "' onClick='adicionaautor(" . $j . ");' " . $status[$lingua] . "><br id=\"br1" . $j . "\" />\n";
					echo "\t\t\t<span id=\"p2_" . $j . "\">Instituição: </span><input type=\"text\" maxlength='200' name=\"instituicao" . $j . "\" id=\"instituicao" . $j . "\" value=\"" . htmlspecialchars($autor->get_instituicao(), ENT_QUOTES) . "\" size=\"34\" " . $status[$lingua] . " /><br id=\"br2" . $j . "\" />\n";
					echo "<span id=\"p3_" . $j . "\">Autor principal? </span><input type=\"radio\" name=\"autorprincipal\" id=\"autorprincipal" . $j . "\" value=\"" . $autor->get_ordem() . "\" " . $status_autor . " " . $status[$lingua] . " /> <br id=\"br3" . $j . "\" /><br id=\"br4" . $j . "\" />";
					echo "\n\n";
				}
			}
			else
			{
				//
			}

		?>

		</div>
		<input type="hidden" name="nauthors_hidden" id="nauthors_hidden" size="40" value="<?php echo $nautores; ?>" >
		<input type="hidden" name="authors2delete_hidden" id="authors2delete_hidden" size="40" value="" >
	</td>
      </tr>
					<tr>
						 <td colspan="2" height="1"></td>
					</tr>

					<tr>
						 <td  align="right">Palavras-chave:</td>
			          	 <td align="left"><input type="text" name="kw1" value="<?php if ( $ingles == 0 ) {echo htmlspecialchars($resumo->get_kw1(), ENT_QUOTES);} else{echo htmlspecialchars($resumoing->get_kw1(), ENT_QUOTES);}?>" maxlength="50" size='25' >
			          	*</td>
					</tr>
					<tr>
						 <td  align="right"></td>
			          	 <td align="left"><input type="text" name="kw2" value="<?php if ( $ingles == 0 ) {echo  htmlspecialchars($resumo->get_kw2(), ENT_QUOTES);} else{echo htmlspecialchars($resumoing->get_kw2(), ENT_QUOTES);}?>" maxlength="50" size='25' >
			          	*</td>
					</tr>
					<tr>
						 <td  align="right"></td>
				          	 <td align="left"><input type="text" name="kw3" value="<?php if ( $ingles == 0 ) {echo  htmlspecialchars($resumo->get_kw3(), ENT_QUOTES);} else{echo htmlspecialchars($resumoing->get_kw3(), ENT_QUOTES);}?>" maxlength="50" size='25' >
				          	*</td>
					</tr>
					<tr>
						 <td  align="right">Email autor principal</td>
				          	 <td align="left"><input type="text" name="email" value="<?php echo htmlspecialchars($resumo->get_email(), ENT_QUOTES); ?>" maxlength="100" size='46' <?php echo $status[$lingua];?> >*</td>
					</tr>
					<tr>
						 <td  align="right" width='30%'>
						Resumo: <br />*máximo de 500 palavras<br /><br /> <div id="aviso_quant_palavras">Um máximo de 500 palavras são permitidas!!</div>
						 </td>
						 <script type="text/javascript"><!--

							// Maximum word length
							var wordLen = 500;

							function lastWord(o)
							{
								return (""+o).replace(/[\s-]+$/,'').split(/[\s-]/).pop();
							}

							function checkWordLen(obj)
							{
								var len = obj.value.split(/[\s]+/);

								document.getElementById('contapalavras').value = len.length;

								lw = lastWord(obj.value);
								lwlength = lw.length;

								if ( len.length > wordLen )
								{
									document.getElementById('aviso_quant_palavras').style.display = "inline";
									obj.value = obj.value.slice(0, -lwlength - 2);
								}
								return true;
							}
						// --></script>
							<td align=\"left\">
							<span style="color: #5f2a83; font: bold 15px Arial;">Não use HTML</span>, <br />apenas negrito (&lt;b&gt;&lt;/b&gt;) ou itálico (&lt;i&gt;&lt;/i&gt;).
							<br />
							<?php
								if ( $ingles == 0 )
								{
									echo "<textarea name=\"texto_abstract\" rows=\"20\" cols=\"44\" onkeyup=\"checkWordLen(this);\">" . $resumo->get_texto() . "</textarea>";
								}
								elseif ( $ingles != 0 )
								{
									echo "<textarea name=\"texto_abstract\" rows=\"20\" cols=\"44\" onkeyup=\"checkWordLen(this);\">" . $resumoing->get_texto() . "</textarea>";
								}
								else
								{
									echo "<textarea name=\"texto_abstract\" rows=\"20\" cols=\"44\" onkeyup=\"checkWordLen(this);\"></textarea>";
								}
							?>
							<br />
							Número de palavras: <input size="4" value="" id="contapalavras"/><br /><br />
							Se precisar de fórmulas matemáticas, <br />você pode usar LaTeX (veja um guia rápido <a href="http://sifsc.ifsc.usp.br/user/event/abstract_latex.php">aqui</a>).<br /><br />
						</td>
					</tr>

	<tr>
		<td colspan='2'>
			Em caso de dúvidas na hora de escrever suas referências, veja <a href="http://sifsc.ifsc.usp.br/2015/Downloads/TutorialReferencias.pdf" target="_blacnk">aqui um guia geral desenvolvido pelo time da SIFSC 5</a>. Não use tags HTML, o sistema aplicará negrito onde for necessário.
		</td>
	</tr>
	<tr>
		<td  align="right"><a name="toporeferencias1">Refer&ecirc;ncia [1]</a></td>
	    <td align="left"></td>
	</tr>
		<tr>
		<td  align="right">Tipo</td>
		<td  align="left"><select name="tipo_ref1" id="tipo_ref1" onchange="updeitaCamposReferencias(this,1)" >
			<option value="nan" <?php if($resumo->get_tipo_ref1() == "" or $resumo->get_tipo_ref1() == -1) echo 'selected';?>> Sem refer&ecirc;ncia</option>
			<option value="1" <?php if($resumo->get_tipo_ref1() == 1) echo 'selected';?>> Artigo de Peri&oacute;dico</option>
			<option value="2" <?php if($resumo->get_tipo_ref1() == 2) echo 'selected';?>> Livro/Cap&iacute;tulo de Livro</option>
			<option value="3" <?php if($resumo->get_tipo_ref1() == 3) echo 'selected';?>> Trabalho apresentado em evento</option>
			<option value="4" <?php if($resumo->get_tipo_ref1() == 4) echo 'selected';?>> Tese ou disserta&ccedil;&atilde;o</option>
			<option value="0" <?php if($resumo->get_tipo_ref1() == 0) echo 'selected';?>> Outros</option>
				</select> *
	</tr>

<?php
$info1=$resumo->get_info1();
$info2=$resumo->get_info2();
$info3=$resumo->get_info3();

if($resumo->get_tipo_ref1()== "")
{
	$info1="||||||||||||||||";
}
if($resumo->get_tipo_ref2()== "")
{
	$info2="||||||||||||||||";
}
if($resumo->get_tipo_ref3()== "")
{
	$info3="||||||||||||||||";
}


$ref1 = explode("||",$info1);
$ref2 = explode("||",$info2);
$ref3 = explode("||",$info3);


$num_campos=41;

$campos = array(
array("outros", "Autores *", "autores", "_0", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("outros","Título *", "titulo", "_0", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("outros",  "Outras informações *", "info0", "_0", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("periodico", "Autores *", "autores", "_1", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("periodico","Título *", "titulo", "_1", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("periodico", "Revista *", "info0", "_1", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("periodico","Volume *", "info1", "_1", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("periodico", "Número", "info2", "_1", "class=\"bib_opcional", ""),
array("periodico","Página *", "info3", "_1", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("periodico", "Ano *", "info4", "_1", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("periodico","DOI", "info5", "_1", "class=\"bib_opcional", ""),
array("livro", "Autor do capítulo", "info0", "_2", "class=\"bib_opcional", ""),
array("livro","Título do capítulo", "info2", "_2", "class=\"bib_opcional", ""),
array("livro", "Autor do livro *", "autores", "_2", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("livro","Participação do autor no livro (Org(s), Ed(s), etc)", "info1", "_2", "class=\"bib_opcional", ""),
array("livro", "Título do livro *", "titulo", "_2", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("livro", "Subtítulo do livro", "info3", "_2", "class=\"bib_opcional", ""),
array("livro","Local de Publicação *", "info4", "_2", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("livro","Editora *", "info5", "_2", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("livro", "Ano *", "info6", "_2", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("livro","Páginas *", "info7", "_2", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("livro", "ISBN", "info8", "_2", "class=\"bib_opcional", ""),
array("evento", "Autor *", "autores", "_3", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("evento","Título do trabalho *", "titulo", "_3", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("evento", "Nome do evento *", "info0", "_3", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("evento","Ano do evento *", "info1", "_3", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("evento", "Local do evento *", "info2", "_3", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("evento","Tipo de publicação* (livro de resumos, proceedings, anais, etc)", "info3", "_3", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("evento","Local de publicação", "info4", "_3", "class=\"bib_opcional", ""),
array("evento", "Editora", "info5", "_3", "class=\"bib_opcional", ""),
array("evento", "Ano *", "info6", "_3", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("evento","Número da página onde foi publicado", "info7", "_3", "class=\"bib_opcional", ""),
array("tese", "Autor *", "autores", "_4", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("tese","Título *", "titulo", "_4", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("tese", "Ano de defesa *", "info0", "_4", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("tese","Número de páginas *", "info1", "_4", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("tese", "Tipo (Dissertação/Tese) *", "info2", "_4", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("tese","Título (Doutorado/Mestrado) *", "info3", "_4", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("tese","Instituição *", "info4", "_4", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("tese", "Universidade *", "info5", "_4", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("tese","Local *", "info6", "_4", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\""),
array("tese", "Ano de publicação *", "info7", "_4", "class=\"bib_obrigatorio", "class=\"bib_obrigatorio_warning\"")
);

$valores1 = array(
"autores" => $resumo->get_autor1(),
"titulo" => $resumo->get_titulo1(),
"info0"=> $ref1[0],
"info1"=> $ref1[1],
"info2"=> $ref1[2],
"info3"=> $ref1[3],
"info4"=> $ref1[4],
"info5"=> $ref1[5],
"info6"=> $ref1[6],
"info7"=> $ref1[7],
"info8"=> $ref1[8]
);

$valores2 = array(
"autores" => $resumo->get_autor2(),
"titulo" => $resumo->get_titulo2(),
"info0"=> $ref2[0],
"info1"=> $ref2[1],
"info2"=> $ref2[2],
"info3"=> $ref2[3],
"info4"=> $ref2[4],
"info5"=> $ref2[5],
"info6"=> $ref2[6],
"info7"=> $ref2[7],
"info8"=> $ref2[8]
);

$valores3 = array(
"autores" => $resumo->get_autor3(),
"titulo" => $resumo->get_titulo3(),
"info0"=> $ref3[0],
"info1"=> $ref3[1],
"info2"=> $ref3[2],
"info3"=> $ref3[3],
"info4"=> $ref3[4],
"info5"=> $ref3[5],
"info6"=> $ref3[6],
"info7"=> $ref3[7],
"info8"=> $ref3[8]
);

		for($i=0; $i<= $num_campos; $i++)
		{
			echo "<tr class=\"".$campos[$i][0]."1\"><td  align=\"right\">".$campos[$i][1]."</td><td align=\"left\"><input type=\"text\"  name=\"".$campos[$i][2].$campos[$i][3]."_1\" value=\"".htmlspecialchars($valores1[$campos[$i][2]], ENT_QUOTES)."\" maxlength=\"200\" size='46' ".$status[$lingua]." ".$campos[$i][4].$campos[$i][3]."1\" /></td></tr>";
		}
	?>


	<tr>
		 <td colspan="2" height="1"></td>
	</tr>
	<tr>
		 <td  align="right"><a name="toporeferencias2">Refer&ecirc;ncia [2]</a></td>
	       	 <td align="left"></td>
	</tr>
	</tr>
		<tr>
		<td  align="right">Tipo</td>
		<td  align="left"><select name="tipo_ref2" id="tipo_ref2" onchange="updeitaCamposReferencias(this,2)" >
			<option value="nan" <?php if($resumo->get_tipo_ref2() == "" or $resumo->get_tipo_ref2() == -1) echo 'selected';?>> Sem refer&ecirc;ncia</option>
			<option value="1" <?php if($resumo->get_tipo_ref2() == 1) echo 'selected';?>> Artigo de Peri&oacute;dico</option>
			<option value="2" <?php if($resumo->get_tipo_ref2() == 2) echo 'selected';?>> Livro/Cap&iacute;tulo de Livro</option>
			<option value="3" <?php if($resumo->get_tipo_ref2() == 3) echo 'selected';?>> Trabalho apresentado em evento</option>
			<option value="4" <?php if($resumo->get_tipo_ref2() == 4) echo 'selected';?>> Tese ou disserta&ccedil;&atilde;o</option>
			<option value="0" <?php if($resumo->get_tipo_ref2() == 0) echo 'selected';?>> Outros</option>
				</select> *
	</tr>
	<?php
		for($i=0; $i<= $num_campos; $i++)
		{
			echo "<tr class=\"".$campos[$i][0]."2\"><td  align=\"right\">".$campos[$i][1]."</td><td align=\"left\"><input type=\"text\"  name=\"".$campos[$i][2].$campos[$i][3]."_2\" value=\"".htmlspecialchars($valores2[$campos[$i][2]], ENT_QUOTES)."\" maxlength=\"200\" size='46' ".$status[$lingua]." ".$campos[$i][4].$campos[$i][3]."2\" /></td></tr>";
		}
	?>
	<tr>
		 <td colspan="2" height="1"></td>
	</tr>
	<tr>
		 <td  align="right"><a name="toporeferencias3">Refer&ecirc;ncia [3]</a></td>
	       	 <td align="left"></td>
	</tr>
	</tr>
		<tr>
		<td  align="right">Tipo</td>
		<td  align="left"><select name="tipo_ref3" id="tipo_ref3" onchange="updeitaCamposReferencias(this,3)" >
			<option value="nan" <?php if($resumo->get_tipo_ref3() == "" or $resumo->get_tipo_ref3() == -1) echo 'selected';?>> Sem refer&ecirc;ncia</option>
			<option value="1" <?php if($resumo->get_tipo_ref3() == 1) echo 'selected';?>> Artigo de Peri&oacute;dico</option>
			<option value="2" <?php if($resumo->get_tipo_ref3() == 2) echo 'selected';?>> Livro/Cap&iacute;tulo de Livro</option>
			<option value="3" <?php if($resumo->get_tipo_ref3() == 3) echo 'selected';?>> Trabalho apresentado em evento</option>
			<option value="4" <?php if($resumo->get_tipo_ref3() == 4) echo 'selected';?>> Tese ou disserta&ccedil;&atilde;o</option>
			<option value="0" <?php if($resumo->get_tipo_ref3() == 0) echo 'selected';?>> Outros</option>
				</select> *
	</tr>
	<?php
		for($i=0; $i<= $num_campos; $i++)
		{
			echo "<tr class=\"".$campos[$i][0]."3\"><td  align=\"right\">".$campos[$i][1]."</td><td align=\"left\"><input type=\"text\"  name=\"".$campos[$i][2].$campos[$i][3]."_3\" value=\"".htmlspecialchars($valores3[$campos[$i][2]], ENT_QUOTES)."\" maxlength=\"200\" size='46' ".$status[$lingua]." ".$campos[$i][4].$campos[$i][3]."3\" /></td></tr>";
		}
	?>
	<tr>
		 <td colspan="2" height="1"><p id="termos" style="display:none;color: #a00;"><br />Você deve ler e aceitar os termos antes de prosseguir.</p></td>


<!--		<td align="right" colspan="2">
			<img src="../images/bt_clear.gif" onClick="document.formulario_abstract.reset()" style="cursor: pointer" border="0" height="20">
			&nbsp;&nbsp;&nbsp;</td><td>
			<a onClick='valid_form_abstract();' style='cursor: pointer;' width='106' height='20' border='0'><img src="../images/bt_save.gif" ></a>
		</td> -->
	</tr>
</table>

<?php
echo "<script>
	function lazyhack (code) { this.value = code; }
	var e = new lazyhack($t_ref1);
	updeitaCamposReferencias__(e,1);
	var e = new lazyhack($t_ref2);
	updeitaCamposReferencias__(e,2);
	var e = new lazyhack($t_ref3);
	updeitaCamposReferencias__(e,3);
</script>";
?>
