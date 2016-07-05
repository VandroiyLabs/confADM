<?php

$saida = "

<html xmlns='http://www.w3.org/1999/xhtml'>

<head>
	<title>Carta Convite</title>
</head>

<body>


<table align='center' width='100%'>
<tr>
	<td height='22'>
	</td>
</tr>
<tr>
	 <td align='left'>
		<img src='carta/icmc_logo.png' width='250' height='113'/>
	 </td>
	 <td align='right'>
			<b>Ali Tahzibi</b><br>
			Departamento de Matemática<br><br>
			Instituto de Ciências Matemáticas e de Computação<br><br>
			Universidade de São Paulo<br>
			Caixa Postal 668<br>
			13560-970 - São Carlos SP, Brazil<br>
			e-mail: tahzibi@icmc.usp.br<br>
			Tel: +55 (16) 3373-8636<br>
			FAX: +55 (16) 3373-9650<br>
	 </td>
</tr>
</table>

<br>

<table align='center' width='100%'>
	<tr>
		<td height='12'>
		</td>
	</tr>
	<tr>
		<td>
			$dear $nome,
		</td>
	</tr>
	<tr>
		<td height='12'>
		</td>
	</tr>
	<tr>
		<td>
			On behalf of the Scientific Committee, I am pleased to confirm acceptance of your participation in the II Brazilian School in Dynamical Systems ( EBSD 2012), to be held at University of São Paulo, on the campus of São Carlos and Ribeirão Preto, from 29th October to 3rd November of 2012.
		</td>
	</tr>		
	<tr>
		<td height='12'>
		</td>
	</tr>
	<tr>
		<td>
			We are looking forward to meeting you in the School.
		</td>
	</tr>
	<tr>
		<td height='20'>
		</td>
	</tr>
	<tr>
		<td>
			Yours sincerely,
		</td>
	</tr>
	<tr>
		<td height='12'>
		</td>
	</tr>		
</table>

<p align='center'>                           
  <img src='carta/assinatura.png' width='302' height='90'/><br>
  Ali Tahzibi
</p>


<table align='center' width='100%'>
	<tr>
		<td align='center'>
		<!--Chair of the Organizing Committee-->
		</td>
	</tr>
	<tr>
		<td height='22'>
		</td>
	</tr>
	<tr>
		<td>
			<b>Organizing Committee:</b>
		</td>
	</tr>		
	<tr>
		<td>
			Benito Pires (USP-Ribeirão Preto), Americo López Gálvez (USP-Ribeirão Preto), Carlos Maquera (ICMC), Daniel Smania (ICMC), Ali Tahzibi (ICMC), Geraldine Góes Bosco (USP/Rib. Preto) <br><br>
		</td>
	</tr>
	<tr>
		<td height='17'>
		</td>
	</tr>
	<tr>
		<td>
			<b>Scientific Committee:</b>
		</td>
	</tr>		
	<tr>
		<td>
			Jairo Bochi (PUC-RJ), Edson de Faria (IME-USP), Artur Lopes (UFRGS), Krerley Oliveira (UFAL), Ali Tahzibi (ICMC), Marcelo Viana (IMPA).
		</td>
	</tr>		
</td>
</tr>

</table>
</body>

</html>
";


// Abre ou cria o arquivo bloco1.txt
// "a" representa que o arquivo é aberto para ser escrito
$fp = fopen("carta/carta.html", "w");

// Escreve "exemplo de escrita" no bloco1.txt
$escreve = fwrite($fp, $saida);

// Fecha o arquivo
fclose($abre);
?>
