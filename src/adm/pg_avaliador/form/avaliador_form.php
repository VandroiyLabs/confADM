<script type="text/javascript" language="javascript" src="form/avaliador_script.js" ></script>

<?php 
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
17 =>"Semicondutores"
);

$area = array(
0 =>"",
1 =>"Física básica",
2 =>"Física aplicada",
3 =>"Biomolecular",
4 =>"Física computacional");




$secao = array(
0 =>"",
1 =>"dia 01/10 (8h)",
2 =>"dia 01/10 (10h15)",
3 =>"dia 01/10 (14h)",
4 =>"dia 01/10 (16h)");

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
82 =>"Yvonne Primerano Mascarenhas");
$outro_nome =1;

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
?>



<table cellspacing="0" cellpadding="1" border="0" width="100%" id="block"> 
	<tr>
		<td bgcolor="#c4c4c4" height="20" valign="center" align="center"><b>Identificação do Avaliador</b></td>
	</tr>
	<tr>
		<td height="10"></td>
	</tr>
	<tr align="center">
		<td>
			<table width="100%" border="0" cellspacing="10">

<script type="text/javascript"> 
function setoutronome(valor)
{
	if ( valor == 'OUTRO' )
	{
		document.formulario.outro_nome.disabled=false;
	}
	else
	{
		document.formulario.outro_nome.disabled=true;
		document.formulario.outro_nome.value='';
	}
};
</script>
	<tr>
	<td align="right" width="30%"><b>Nome:</b></td>
	<td  align="left">
	<select name="nome" <?php echo $status[$lingua];?> onchange="setoutronome(this.value);" >
	<?php 
		for ($i = 0; $i <= 82; $i++)
		{
		    echo "<option value=\"".$orientadores[$i]."\" "; if($avaliador->get_nome() == $orientadores[$i]){ echo 'selected';  $outro_nome=0; } echo ">".$orientadores[$i]."</option>";		
		}
		?>
		<option value="OUTRO" <?php if($outro_nome == 1){ echo 'selected'; }?> >OUTRO</option>
	</select>
	*</td>
	</tr>
	<tr>
		<td align="right" width="30%"></td>
		<td  align="left"><input type="text" name="outro_nome" value="<?php if($outro_nome == 1) echo $avaliador->get_nome();?>" maxlength="200" size="46" <?php echo $status[$lingua];  if ( $outro_nome != 1 ){ echo 'disabled="disabled"'; } ?> /></td>
	</tr>
				
				
				<tr>
					<td align="right"><b>E-mail:</b></td>
					<td align="left"><input type="text" name="email" value="<?=$avaliador->get_email()?>" maxlength="48" size="46" >&nbsp;*</td>
				</tr>
				<tr>
					<td align="right"><b>Nivel:</b></td>
					<td align="left">
						<input type="radio" name="nivel" value="Professor" <?php if($avaliador->get_nivel()=='Professor' || $avaliador->get_nivel()=='' ) echo 'checked';?> />Professor
						&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="nivel" value="Pós-doc" <?php if($avaliador->get_nivel()=='Pós-doc') echo 'checked';?> />Pós-doc &nbsp;&nbsp;&nbsp;&nbsp;
						<input type="radio" name="nivel" value="Pesquisador" <?php if($avaliador->get_nivel()=='Pesquisador') echo 'checked';?> />Pesquisador
						&nbsp;&nbsp;*</td>
				</tr>
				<tr>
					<td align="right" width="30%"><b>Grupo de Pesquisa:</b></td>
					<td  align="left">
						<select name="grupo" >
						<?php 
							for ($i = 0; $i <= 17; $i++)
							{
							    echo "<option value=\"".$grupo[$i]."\" "; if($avaliador->get_grupo() == $grupo[$i]) echo 'selected'; echo ">".$grupo[$i]."</option>";		
							} 
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" width="30%"><b>Grande área principal:</b></td>
					<td  align="left">
						<select name="area1" >
						<?php 
							for ($i = 0; $i <= 4; $i++)
							{
							    echo "<option value=\"".$area[$i]."\" "; if($avaliador->get_area1() == $area[$i]) echo 'selected'; echo ">".$area[$i]."</option>";		
							} 
						?>						
						</select>
					</td>
				</tr>
								<tr>
					<td align="right" width="30%"><b>Grande área secundária:</b></td>
					<td  align="left">
						<select name="area2" >
							<?php 
							for ($i = 0; $i <= 4; $i++)
							{
							    echo "<option value=\"".$area[$i]."\" "; if($avaliador->get_area2() == $area[$i]) echo 'selected'; echo ">".$area[$i]."</option>";		
							} 
						?>	
						</select>
					</td>
				</tr>
				<tr>
					<td align="right" width="30%"><b>Especialidade:</b></td>
					<td  align="left"><select name="subarea" <?php echo $status[$lingua];?>>
					<?php 
						for ($i = 0; $i <= 20; $i++)
						{
						    echo "<option value=\"".$subarea[$i]."\" "; if($avaliador->get_subarea() == $subarea[$i]) echo 'selected'; echo ">".$subarea[$i]."</option>";		
						} 
					?>
					</select>
					</td>
				</tr>
				<tr>
					<td align="right"><b>Avalia resumos?</b></td>
					<td align="left">
						<?php

						// Primeira parte, definindo já qual seção é
						$chckbx = "<span class=\"checkbox\"><input type=\"radio\" name=\"avaliaresumo\" value=\"1\"";
						$chckbxnot = "<span class=\"checkbox\"><input type=\"radio\" name=\"avaliaresumo\" value=\"0\"";

						// Agora precisamos verificar se o avaliador já disse que estaria nesta
						// seção específica. Se sim, adicionamos um checked.
						$avaliacao = new Avaliacao();
						if ( $avaliacao->find( $avaliador->get_codigo_avaliador(), 0, $evento->get_codigo_evento() ) )
						{
							$chckbx .= " checked ";
						}
						else
						{
							$chckbxnot .= " checked ";
						}
						
						// Finalizando a Tag radio.
						$chckbx .= "/> Sim</span>";
						$chckbxnot .= "/> Não</span>";
						
						// Imprimindo o resultado pro HTML.
						echo $chckbx . "   " . $chckbxnot;
						
						?>
					</td>
				</tr>
				<tr>
					<td align="right"><b>Seções:</b></td>
					<td align="left">
						
						<?php

						// Imprimindo um checkbox para cada seção possível do evento.						
						for ( $j = 1; $j <= 4; $j++ )
						{
							
							// Primeira parte, definindo já qual seção é
							$chckbx = "<span class=\"checkboxsections\"><input type=\"checkbox\" name=\"secao" . $j . "\" value=\"1\"";
							
							// Agora precisamos verificar se o avaliador já disse que estaria nesta
							// seção específica. Se sim, adicionamos um checked.
							$avaliacao = new Avaliacao();
							if ( $avaliacao->find( $avaliador->get_codigo_avaliador(), $j, $evento->get_codigo_evento() ) )
							{
								 $chckbx .= " checked ";
							}
							
							// Finalizando a Tag checkbox.
							$chckbx .= "/>" . $secao[$j] . "</span>";
							
							// Imprimindo o resultado pro HTML.
							echo $chckbx;
						}
						
						?>
					</td>
				</tr>
				<tr>
					<td align="right"><b>Língua:</b></td>
					<td align="left">
						<input type="checkbox" name="linguap" value="1" <?php if($avaliador->get_lingua()=='1' || $avaliador->get_lingua()=='3') echo 'checked';?>/>Português&nbsp;&nbsp;&nbsp;
		                <input type="checkbox" name="linguae" value="2" <?php if($avaliador->get_lingua()=='2' || $avaliador->get_lingua()=='3') echo 'checked';?> /> Inglês
					</td>
				</tr>
				<tr>
					<td colspan="2" height="4"></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr> 
		<td height="5"></td> 
	</tr> 
</table>
