<?php

	require_once("~/public_html/sifsc/user/classes/class.pessoa.php");
	require_once("~/public_html/sifsc/user/classes/class.evento.php");
	require_once("~/public_html/sifsc/user/classes/class.inscricao.php");
	require_once("~/public_html/sifsc/user/classes/class.autor.php");
	require_once("~/public_html/sifsc/user/classes/class.arte.php");
	require_once("~/public_html/sifsc/user/classes/class.minicurso.php");
	require_once("~/public_html/sifsc/user/classes/class.avalia_poster.php");
	require_once("~/public_html/sifsc/user/classes/class.participa_premiacao.php");
	require_once("~/public_html/sifsc/user/classes/class.participa_minicurso.php");
	require_once("~/public_html/sifsc/user/classes/class.resumo.php");
	require_once("~/public_html/sifsc/user/classes/class.kits.php");
	require_once("~/public_html/sifsc/user/classes/class.participante_frequencia.php");
	session_start();
	require_once("./../user_edition_variables.php");
	require_once($head_file);

	require_once("~/public_html/sifsc/user/restricted.php");

	$evento = $_SESSION["evento"];
	require_once("~/public_html/sifsc/user/event/secao.php");
	include('index.php');

	$count_certs = 0;
	$frequencia = new ParticipanteFrequencia();
	$premiacao = new ParticipaPremiacao();
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


$num_eventos = $evento->get_codigo_evento();
for ($j = $num_eventos; $j > 0 ; $j--)
{

$Runevento = new Evento();
$Runevento->find_by_codigo($j);

$Runinscricao = new Inscricao();

echo '<div id="' . $Runevento->get_nome() . '" style="display: none;">
	<div class="titulo_secao">' . $Runevento->get_nome() . '
	</div>';

if ( $Runevento->get_certificados_disponiveis() == 1)
{
	if( ! $Runinscricao->find_by_pessoa_evento($pessoa->get_codigo_pessoa(), $Runevento->get_codigo_evento()))
	{
		echo "<p>Nenhum certificado associado a este participante.</p>";
	}
	else
	{

		echo "<p>Clique nos botões abaixo para fazer o download dos certificados.</p>";
		if( $frequencia->find_by_codigo_pessoa( $pessoa->get_codigo_pessoa(), $Runevento->get_codigo_evento() ) )
		{
			if($frequencia->get_frequencia_palestras() >= $Runevento->get_threshold_participacao())
			{ $count_certs++;
	?>
				<form method='post' action='http://sifsc.ifsc.usp.br/user/event/certificados/gerar_certificado.php'>

				<input type='hidden' name='tipo' value='participacao'/>
				<input type='hidden' name='e' value="<?php echo $j;?>" />
				<table cellspacing="15" cellpadding="1" border="0">
				<tr>
					<td  align='left'>
					<input  class="button_certificado" type="submit" value="Participação">
					</td>
				</tr>
				</table>

				</form>

	<?php
			}

			if($frequencia->get_frequencia_minicurso() >= $Runevento->get_threshold_minicurso())
			{ $count_certs++;
	?>
				<form method='post' action='http://sifsc.ifsc.usp.br/user/event/certificados/gerar_certificado.php'>

				<input type='hidden' name='tipo' value='minicurso'/>
				<input type='hidden' name='e' value="<?php echo $j;?>"/>
				<table cellspacing="15" cellpadding="1" border="0">
				<tr>
					<td  align='left'>
					<input  class="button_certificado" type="submit" value="Minicurso">
					</td>
				</tr>
				</table>

				</form>


	<?php
			}


			if($frequencia->get_frequencia_arte() == 1)
			{ $count_certs++;
	?>
				<form method='post' action='http://sifsc.ifsc.usp.br/user/event/certificados/gerar_certificado.php'>

				<input type='hidden' name='tipo' value='obra'/>
				<input type='hidden' name='e' value="<?php echo $j;?>"/>
				<table cellspacing="15" cellpadding="1" border="0">
				<tr>
					<td  align='left'>
					<input  class="button_certificado" type="submit" value="Obra Artística">
					</td>
				</tr>
				</table>

				</form>

	<?php
			}

			if($frequencia->get_frequencia_workshop() == 1)
			{ $count_certs++;
	?>
				<form method='post' action='http://sifsc.ifsc.usp.br/user/event/certificados/gerar_certificado.php'>

				<input type='hidden' name='tipo' value='workshop'/>
				<input type='hidden' name='e' value="<?php echo $j;?>"/>
				<table cellspacing="15" cellpadding="1" border="0">
				<tr>
					<td  align='left'>
					<input  class="button_certificado" type="submit" value="Workshop">
					</td>
				</tr>
				</table>
				</form>
	<?php
			}

			if($frequencia->get_frequencia_oral() == 1)
			{ $count_certs++;
	?>
				<form method='post' action='http://sifsc.ifsc.usp.br/user/event/certificados/gerar_certificado.php'>

				<input type='hidden' name='tipo' value='oral'/>
				<input type='hidden' name='e' value="<?php echo $j;?>"/>
				<table cellspacing="15" cellpadding="1" border="0">
				<tr>
					<td  align='left'>
					<input  class="button_certificado" type="submit" value="Apresentação Oral">
					</td>
				</tr>
				</table>

				</form>


	<?php
			}

		}



		if($count_certs == 0)
		{
			echo "<p><b>Nenhum certificado associado a este participante.</b></p>";
		}
	}
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

<?php  require_once($foot_file);?>
