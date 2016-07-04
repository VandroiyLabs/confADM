<?php


$Q1 = explode(".",$nota_resumo->get_Q1());
if(strlen($Q1[0]) == 1)
$Q1[0] = "0".$Q1[0];

$Q1i = $Q1[0];
$Q1d = $Q1[1];

$Q2 = explode(".",$nota_resumo->get_Q2());
if(strlen($Q2[0]) == 1)
$Q2[0] = "0".$Q2[0];

$Q2i = $Q2[0];
$Q2d = $Q2[1];

$Q3 = explode(".",$nota_resumo->get_Q3());
if(strlen($Q3[0]) == 1)
$Q3[0] = "0".$Q3[0];

$Q3i = $Q3[0];
$Q3d = $Q3[1];

$Q4 = explode(".",$nota_resumo->get_Q4());
if(strlen($Q4[0]) == 1)
$Q4[0] = "0".$Q4[0];

$Q4i = $Q4[0];
$Q4d = $Q4[1];

$Q5 = explode(".",$nota_resumo->get_Q5());
if(strlen($Q5[0]) == 1)
$Q5[0] = "0".$Q5[0];

$Q5i = $Q5[0];
$Q5d = $Q5[1];


?>
<table cellspacing="15" cellpadding="1" border="0" width="100%"> 	
	<tr>
		<td align="right" width="80%">Quesito 1:<br /><b>Contextualização e domínio do tema (peso: 4.0)</b> </td>
		<td align="left"><input type="text" name="Q1i" value="<?=$Q1i;?>" maxlength="2" size="1" style="height=20"><input type="hidden" name="Q1d" value="0" maxlength="1" size="1" style="height=20">&nbsp;*</td> 
	</tr>
	<tr>
		<td  colspan='2'>O estudante deve demonstrar domínio da área na qual seu projeto está inserido. Para tanto, ele deve ser capaz de definir conceitos importantes, contextualizar e rever os principais resultados da literatura, elucidar as dificuldades, revisitar as principais questões e desafios importantes para o desenvolvimento da área, bem como defender a contribuição de seu projeto de pesquisa diante do tema.  </td>
	</tr>
	<tr>
		<td align="right" >Quesito 2: <br /><b>Proposta e metolodogia (peso: 3.0)</b></td>
		<td align="left"><input type="text" name="Q2i" value="<?=$Q2i;?>" maxlength="2" size="1" style="height=20"><input type="hidden" name="Q2d" value="0" maxlength="1" size="1" style="height=20">&nbsp;*</td> 
	</tr>
	<tr>
		<td  colspan='2'> A  motivação do trabalho e o seu potencial para o desenvolvimento da área de pesquisa deve ser apresentada na proposta do projeto. O estudante deve elucidar as principais ferramentas utilizadas, tais como materiais, métodos ou bases teóricas, citando-os de forma concisa e inteligível e justificando seu uso. </td>
	</tr>
	<tr>
		<td align="right" >Quesito 3: <br /> <b> Resultados, perspectivas e conclusões (peso: 3.0)</b></td>
		<td align="left" ><input type="text" name="Q3i" value="<?=$Q3i;?>" maxlength="2" size="1" style="height=20"><input type="hidden" name="Q3d" value="0" maxlength="1" size="1" style="height=20">&nbsp;*</td> 
	</tr>
	<tr>
		<td  colspan='2'>O estudante deve apresentar os principais resultados de seu projeto encontrados até o momento. As implicações desses resultados e suas constribuições devem ser enfatizadas na conclusão. Para estudantes em estágio inicial do projeto, as perspectivas referentes às etapas que devem ser realizadas ou aos resultados esperados devem ser citados.  </td>
	</tr>
	
	<tr><td align="right" colspan='2'>	<span class="button" onClick='valid_avalia_resumo_form();' style='cursor: pointer'; >Salvar</span></td></tr>
</table>
