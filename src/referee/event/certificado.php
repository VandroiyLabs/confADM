<?php

		
	require_once("~/public_html/sifsc/user/classes/class.avaliador.php");
	require_once("~/public_html/sifsc/user/classes/class.evento.php");
	require_once("~/public_html/sifsc/user/classes/class.avalia_poster.php");
	require_once("~/public_html/sifsc/user/classes/class.avalia_resumo.php");
	require_once("~/public_html/sifsc/user/classes/class.avaliacao.php");
	session_start();
	require_once("../referee_edition_variables.php");
	require_once($head_file);
	require_once("~/public_html/sifsc/referee/restricted.php");
	require_once("~/public_html/sifsc/referee/event/secao.php");
	
	$poster = new Avaliacao();
	$resumo = new Avaliacao();
	
	
	$count_certs = 0;
?>

<script>

function showLast()
{
	document.getElementById("II SIFSC").style.display = 'none';
	document.getElementById("SIFSC 3").style.display = 'none';
	document.getElementById("SIFSC 4").style.display = 'none';
	document.getElementById("SIFSC 5").style.display = 'inline';
}

function favBrowser()
{
var eddown=document.getElementById("edicao");

document.getElementById("II SIFSC").style.display = 'none';
document.getElementById("SIFSC 3").style.display = 'none';
document.getElementById("SIFSC 4").style.display = 'none';
document.getElementById("SIFSC 5").style.display = 'none';
document.getElementById(eddown.options[eddown.selectedIndex].text).style.display = 'inline';

}
</script>

<?php
 include('index.php');
 ?>

<div id="user_system">
<div id="titulo_form_secao">
		certificados
</div>	


<p>Veja seus certificados abaixo (caso estejam disponíveis):</p>

<br />
<div style="width: 200px; margin: 0 auto 0 auto;">
	<span style="color: #223C7F;"><b>Escolha a edição: </b></span>
	<select id="edicao" onchange="favBrowser()">
		<option>SIFSC 5</option>
		<option>SIFSC 4</option>
		<option>SIFSC 3</option>
		<option>II SIFSC</option>
	 </select>
</div>

<?php
$count=0;

$num_eventos = $evento->get_codigo_evento();
for ($j = $num_eventos; $j > 0 ; $j--)
{

$Runevento = new Evento();
$Runevento->find_by_codigo($j);


echo '<div id="' . $Runevento->get_nome() . '" style="display: none;"><p p style="margin: 50px 0 20px; color: #223c7f; font: bold 18px sans-serif, Arial; text-transform: uppercase; border-bottom-width: 1px; border-bottom-style: solid; border-color: #223c7f;">' . $Runevento->get_nome() . '</p>';

if( $Runevento->get_certificados_disponiveis() == 1 )
{
	echo "<p>Clique nos botões abaixo para fazer o download dos certificados.</p>";			
	if(mysql_num_rows($poster->find_poster_by_avaliador_evento($avaliador->get_codigo_avaliador(),$Runevento->get_codigo_evento())) > 0)
	{
		
?>		
			<form method='post' action='http://sifsc.ifsc.usp.br/referee/event/certificados/gerar_certificado.php'>

			<input type='hidden' name='tipo' value='poster'/>
			<table cellspacing="15" cellpadding="1" border="0">
			<tr> 
				<td  align='left'>
				<input  type="hidden" name="e" value="<?php echo $Runevento->get_codigo_evento(); ?>">
				<input  class="button_certificado" type="submit" value="Workshop">

				</td>
			</tr>	
			</table>	
	
			</form>
		
<?php            $count++;
		}
		
		if(mysql_num_rows($resumo->find_resumo_by_avaliador_evento($avaliador->get_codigo_avaliador(),$Runevento->get_codigo_evento()))== 1)
		{
?>
			<form method='post' action='http://sifsc.ifsc.usp.br/referee/event/certificados/gerar_certificado.php'>

			<input type='hidden' name='tipo' value='resumo'/>
			<table cellspacing="15" cellpadding="1" border="0">
			<tr> 
				<td  align='left'>
				<input  type="hidden" name="e" value="<?php echo $Runevento->get_codigo_evento(); ?>">
				<input  class="button_certificado" type="submit" value="Avaliação de Resumo">
				</td>
			</tr>	
			</table>	
	
			</form>
	
			
<?php		$count++;
		}		

		if($count == 0) echo "<p>Nenhum certificado associado.</p>";
}
else
{
	echo "<p>Certificados ainda não disponíveis.</p>";			
}
echo "</div>";
}
?>	

	
<script>
	showLast();
</script>	
</div>	
</div>

<?php  require_once($foot_file);
?>			

