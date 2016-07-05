<?php

	/* Garantindo que nenhum lixo fique solto e a edicao de alguem fique em aberto! */
	require_once('./../../user/classes/class.EmEdicao.php');
	$editando = new EmEdicao();
	if ( $editando->find_by_adm($adm->get_usuario()) )
	{
		$editando->remove();
	}

	unset($_SESSION["pessoa"]);
	$inscricao = new Inscricao();
	$evento = new Evento();
	$evento->find_evento_aberto(); $_SESSION["evento"]=$evento;

	if ( isset($_GET["pagina_atual"]) )
	{
		$contador_pagina = $_GET["pagina_atual"];
		$_SESSION["pesquisar_pagina_atual"] = $contador_pagina;
	}
	if ( isset($_SESSION["pesquisar_pagina_atual"]) )
	{
		$contador_pagina = $_SESSION["pesquisar_pagina_atual"];
	}
	else
	{
		$contador_pagina = 1;
	}

	if ( isset($_GET['nome']) and !isset($_POST['nome']) )
	{
		$_POST['nome'] = $_GET['nome'];
	}
?>
<div id="content">

<div class="post">
	<div class="content">
	<h2>Pesquisar por Participante</h2>
	<table>
		<tr>
			<td height="12" colspan="2"></td>
		</tr>
	</table>
<script type="text/javascript">
function submite_sup(url)
{
  document.indice_sup.action=url;
  document.indice_sup.submit();
}
function submite_inf(url)
{
  document.indice_inf.action=url;
  document.indice_inf.submit();
}
</script>

	<form nome='formulario' method='post' action='home.php?p1=pesquisar'>

	<table cellspacing="0" cellpadding="0" border="0" width="100%"  id="block_new">
		<tr>
			<td bgcolor="#c4c4c4" height="20" valign="center" align="center" colspan="3"><b>Pesquisar por nome/e-mail:</b></td>
		</tr>
		<tr>
			<td height="10"></td>
		</tr>
		<tr>
			<td align="center">
				<input type='text' name='nome' value='<?=$_POST["nome"]?>' size='40'/>
				&nbsp;&nbsp;
				<button  class="ui-button ui-button-text-only ui-state-default ui-corner-all">
					<span class="ui-button-text">Pesquisar</span>
				</button>
				<button type="button" class="ui-button ui-button-text-only ui-state-default ui-corner-all" onClick="document.getElementById('filtros_busca').style.display='inline';">
					<span class="ui-button-text">Mostrar Filtros</span>
				</button>
				<input type='hidden' name='p1' value='pesquisar'/>
			</td>
		</tr>
		<tr>
			<td>
				&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>

	<?php include('listar/filtro.php');?>
	</form>


	<table>
		<tr>
			<td height="12" colspan="2"></td>
		</tr>
	</table>

	<table width="100%" border="0" cellspacing="0" cellpadding="10">


	<?php

		if( isset($_POST["nome"]) )
		{
			include('listar/filtro_action.php');
			//echo $filtro;

			if ( isset( $_POST['numperpage'] ) )
			{
				$limite = $_POST['numperpage'];
			}
			else
			{
				$limite = 15;
			}
			//echo $evento->get_codigo_evento();
			$consulta = $inscricao->find_by_nome_inscricao($evento->get_codigo_evento(),$_POST["nome"], $filtro);



			$intervalo = $inscricao->find_by_nome_inscricao_limmited($evento->get_codigo_evento(),$_POST["nome"], $filtro,$_GET["pagina_atual"],$limite);

			$registro_inicial = (($contador_pagina - 1) * $limite);

			$total = mysql_num_rows($consulta);
			$total_pagina =( (int)($total/$limite) );

			echo "
				<tr>
					<td colspan='3'>
						<span style=\"font: 15px sans-serif; color: #009;\">Número de resultados encontrados: <b>$total</b></span>
					</td>
				</tr>
				";

			$email="";
			while ($result = mysql_fetch_object($consulta))
			{
				$email.= $result->email.",";
			}

			echo "<tr><td colspan='3'>
				<form method='post' action='home.php?p1=correio'>
				<input type='submit' value='  Enviar email  ' class='button_azul'/>
				<input type='hidden' name='email' value='$email'/>
				<input type='hidden' name='p1' value='correio'/>
                              </form></td></tr>";

			if($total%$limite != 0)
			$total_pagina++;
			$local="sup";
			include("listar/indice_pesquisar.php");

			if($intervalo &&  mysql_num_rows($intervalo) > 0){
				$total = mysql_num_rows($intervalo);

				while ($row = mysql_fetch_object($intervalo)){

				echo"
				<tr>
					<td valign='top' colspan='3'>
				<table border='0' cellspacing='0' cellpadding='10' width='100%'  id='block'>
					<tr>
						<td height='30' bgcolor='#c4c4c4' colspan='2'>
							<table width='100%'>
								<tr>
								<td width='50%' height='20' ><b>($row->codigo_pessoa) $row->nome</b></td>

								";



										echo "<td width='15%'></td><td width='15%'></td>";



									echo "<td align='center' width='10%'>
									<form method='get' action='home.php'>
										<input type='submit' value='  Detalhes  ' class='button_azul'>
									<input type='hidden' name='p1' value='showpessoa'/>
									<input type='hidden' name='cp' value='$row->codigo_pessoa'/>
									</form>
								</td>";


								echo "<td width='10%'></td></tr>";

								echo "

							</table>
						</td>
					</tr>
					<tr>
						<td height='10' colspan='2'></td>
					</tr>
					<tr>
						<td width='5'></td>
						<td height='30'>
							<table cellspacing='0'>
								<tr>
									<td height='20' colspan='2'><b>Instituição: </b>$row->instituicao</td>
								</tr>
								<tr>
									<td height='20' colspan='2'><b>E-mail: </b><a href='home.php?p1=correio&email=$row->email'>$row->email</a></td>
								</tr>

							</table>
						</td>
					</tr>
					<tr>
						<td height='10' colspan='2'></td>
					</tr>

					<tr>
						<td height='10' colspan='2'></td>
					</tr>
				</table>
				<table>
				<tr>
					<td height='9'></td>
				</tr>
				</table>
				</td>
			</tr>
			";
			}
		}
		else
		{
			echo "<tr height='100' >

					<td valign='top' colspan='3'></td>
			      </tr>
			      <tr >
					<td align='center' colspan='3'><h2><font style=\"color:#F00;\">Nenhum participante.</font></h2></td>
			      </tr>
			      <tr height='100' >
					<td valign='top' colspan='3'></td>
			      </tr>";
		}
	$local="inf";
	include("listar/indice_pesquisar.php");
	}

	echo"</table>";


	?>

	</div>
</div>
</div>
