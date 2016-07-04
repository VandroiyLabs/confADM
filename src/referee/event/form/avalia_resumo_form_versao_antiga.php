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
		<td align="right" width="80%">Quesito 1:<br /><b>Contextualização:</b>  como o trabalho influi na ciência </td>
		<td align="left"><input type="text" name="Q1i" value="<?=$Q1i;?>" maxlength="2" size="1" style="height=20">,<input type="text" name="Q1d" value="<?=$Q1d;?>" maxlength="1" size="1" style="height=20">&nbsp;*</td> 
	</tr>
	<tr>
		<td  colspan='2'> Observe como o trabalho se inclui no âmbito científico ou tecnológico, o que ele traz de diferente e, em especial, qual é a sua relevância no contexto em que está inserido.</td>
	</tr>
	<tr>
		<td align="right" >Quesito 2: <br /><b>Domínio</b> do assunto.</td>
		<td align="left"><input type="text" name="Q2i" value="<?=$Q2i;?>" maxlength="2" size="1" style="height=20">,<input type="text" name="Q2d" value="<?=$Q2d;?>" maxlength="1" size="1" style="height=20">&nbsp;*</td> 
	</tr>
	<tr>
		<td  colspan='2'> Verifique se o aluno é conhecedor das bases do seu projeto e se ele sabe fundamentá-lo na sua área.</td>
	</tr>
	<tr>
		<td align="right" >Quesito 3: <br /> <b> Resultados </b>.</td>
		<td align="left" ><input type="text" name="Q3i" value="<?=$Q3i;?>" maxlength="2" size="1" style="height=20">,<input type="text" name="Q3d" value="<?=$Q3d;?>" maxlength="1" size="1" style="height=20">&nbsp;*</td> 
	</tr>
	<tr>
		<td  colspan='2'> Analise os resultados que o aluno obteve no seu trabalho e sua pertinência. </td>
	</tr>
	<tr>
		<td align="right" >Quesito 4: <br /> <b>Perspectivas</b>.</td>
		<td align="left"><input type="text" name="Q4i" value="<?=$Q4i;?>" maxlength="2" size="1" style="height=20">,<input type="text" name="Q4d" value="<?=$Q4d;?>" maxlength="1" size="1" style="height=20">&nbsp;*</td> 
	</tr>
	
	<tr>
		<td  colspan='2'> Para trabalhos em estágio inicial, considere as perspectivas que o aluno tem sobre seu projeto.</td>
	</tr>
	<tr>
		<td align="right" >Quesito 5: <br /> <b>Língua (Portuguesa/Inglesa):</b> ortografia e concordância.</td>
		<td align="left"><input type="text" name="Q5i" value="<?=$Q5i;?>" maxlength="2" size="1" style="height=20">,<input type="text" name="Q5d" value="<?=$Q5d;?>" maxlength="1" size="1" style="height=20">&nbsp;*</td> 
	</tr>
	<tr>
		<td  colspan='2'> Considerando o texto em si, julgue se ele foi bem escrito e se consegue passar sua mensagem seguindo corretamente as regras da língua em questão. Ao inserir a versão em inglês, o aluno permite também ser avaliado em apenas um dos idiomas.</td>
	</tr>
	<tr><td align="right" colspan='2'>	<span class="button" onClick='valid_avalia_resumo_form();' style='cursor: pointer'; >Salvar</span></td></tr>
</table>
