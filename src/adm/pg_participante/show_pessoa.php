<?php
$home = "/home/" . get_current_user() . "/";
unset($_SESSION["pessoa"]);
unset($_SESSION["inscricao"]);
require_once('./../../user/classes/class.kits.php');
require_once('./../../user/classes/class.participante_frequencia.php');
?>
<div id="content">

<script type="text/javascript" src="./lmcbutton.js"></script>
<script>
function goto()
{
	var eddown=document.getElementById("edicao");
	codev=eddown.options[eddown.selectedIndex].value;
	<?php echo "window.location.href = 'http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp=" . $_GET['cp'] . "&cev='+codev;" ?>

}
</script>


<div class="post">
	<div class="content">
	<h2>Informações de participante</h2>

	<?php
	if ( isset($_SESSION['msg']) )
	{
		echo "	<div id=\"msg\">";
		echo "		<p>" . $_SESSION['msg'] . "</p>";
		echo "	</div>";
		unset($_SESSION['msg']);
	}

	require_once('./../../user/classes/class.EmEdicao.php');

	$editando = new EmEdicao();
	if ( $editando->find_by_pessoa($_GET['cp']) and strcmp($editando->get_adm_usuario(), $adm->get_usuario()) == 0 )
	{
		$editando->remove();
	}
	elseif ( $editando->find_by_pessoa($_GET['cp']) and strcmp($editando->get_adm_usuario(), $adm->get_usuario()) != 0 )
	{
		echo "<div id='editingwarning'>Sendo editado no momento por " . $editando->get_adm_usuario() . "</div>";
	}

	if ( $editando->find_by_adm($adm->get_usuario()) )
	{
		$editando->remove();
	}

	// Abrindo evento
	$evento = new Evento();

	if ( isset($_GET["cev"]) and $evento->find_by_codigo( $_GET["cev"] ) )
	{
	}
	else
	{
		$evento->find_evento_aberto();
	}

	$isOpen = $evento->get_aberto();


	// Opcao para ver dados em todos os eventos
	$auxevento = new Evento();
	$auxevento->find_evento_aberto();

	$num_eventos = $auxevento->get_codigo_evento();

	echo '<div style="width: 230px; margin: 0 auto 0 auto;"><span style="color: #333;"><b>Escolha a edição: </b></span><select style="width: 80px;" id="edicao" onchange="goto()">';

	for ($j = $num_eventos; $j > 0 ; $j--)
	{
		$auxevento->find_by_codigo($j);
		$testinsc = new Inscricao();

		// Verificando se a pessoa estava neste evento.
		if ( $testinsc->find_by_pessoa_evento( $_GET["cp"] , $auxevento->get_codigo_evento() ) )
		{
			$selected = '';
			if ( $evento->get_codigo_evento() == $auxevento->get_codigo_evento() )
			{
				$selected = 'selected';
			}

			echo "<option value='" . $auxevento->get_codigo_evento() . "' " . $selected . ">" . $auxevento->get_nome() . "</option>";
		}

	}
	echo '</select></div>';

	?>


	<table width="100%" border="0" cellspacing="0" cellpadding="10">
	<tr>
		<td>

	<?php

		$pessoa = new Pessoa();
		$inscricao = new Inscricao();

		if ( isset($_GET["cp"]) and $pessoa->find_by_codigo( $_GET["cp"] ) )
		{

			$_SESSION["pessoa"]	= $pessoa;
			$_SESSION['codigo_pessoa'] = $_GET["cp"];
			$inscricao->find_by_pessoa_evento( $pessoa->get_codigo_pessoa() , $evento->get_codigo_evento() );
			$_SESSION["inscricao"] = $inscricao;

			$thresh_p = $evento->get_threshold_participacao();
			$thresh_m = $evento->get_threshold_minicurso();

			$frequencia = new ParticipanteFrequencia();
			$frequencia->find_by_codigo_pessoa($_GET["cp"], $evento->get_codigo_evento() );


			echo "
				<tr>
					<td valign='top' colspan='3'>
				<table border='0' cellspacing='0' cellpadding='10' width='100%'  id='block'>
					<tr>
						<td height='30' bgcolor='#c4c4c4' colspan='2'>
							<table>
								<tr>
								<td width='400' height='20' ><b>" . $pessoa->get_nome() . "</b></td>
								";

								if ( ( $adm->get_tipo() != '2' or $inscricao->get_situacao_resumo() != '2' )  and $isOpen )
								{
									echo "
									<td align='right' width='50'>
										<form method='get' action='home.php'>
											<input type='submit' value='  Editar  ' class='button_azul'>
										<input type='hidden' name='CP' value='" . $pessoa->get_codigo_pessoa() . "'/>

										<input type='hidden' name='p1' value='incluir'/>
										</form>
									</td>";
								}
								else
								{
									echo "<td align='right' width='50'></td>";
								}
								echo "
								<td align='right'></td>

								<td align='right' bgcolor='#c4c4c4' width='50'>
								";/*	<form method='get' action='home.php'>
										<input type='submit' value='  Excluir  ' class='button_vermelho' >
										<input type='hidden' name='codigo_pessoa' value='" . $pessoa->get_codigo_pessoa . "'/>
										<input type='hidden' name='codigo_evento' value='''/>
										<input type='hidden' name='p1' value='excluir_inscricao'/>
									</form>*/
								echo "</td>
								</tr>
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
									<td height='40px' widht='400'>
										<b>Nivel: </b>" . $inscricao->get_nivel() . "<br />
										<b>Orientador: </b>" . $inscricao->get_orientador() . " <br />
										<b>Instituição: </b>" . $inscricao->get_instituicao() . "
									</td>
									<td width='200'>";

									if ( $inscricao->get_situacao_resumo() == '1')								{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Não submeteu para avaliação.</td></tr></table>";
									}
									elseif ( $inscricao->get_situacao_resumo() == '2' && $inscricao->get_situacao_deferimento() == '0' )
								 	{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Aguardando deferimento da biblioteca.</td></tr></table>";

									}elseif ( $inscricao->get_situacao_resumo() == '2' && $inscricao->get_situacao_deferimento() == '1' )
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Aguardando deferimento da comissão.</td></tr></table>";
								 	}
									elseif ( $inscricao->get_situacao_resumo() == '5' && $inscricao->get_situacao_deferimento() == '2' )
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Deferido.</td></tr></table>";
									}
									elseif ( $inscricao->get_situacao_resumo() == '3' && $inscricao->get_situacao_deferimento() == '0' )
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Aguardando nova submissão.</td></tr></table>";
									}
									elseif ( $inscricao->get_situacao_resumo() == '4' )
									{
										echo "<table width='100%'><tr><td ><b>Resumo: </b>Indeferido.</td></tr></table>";
									}

									if (( $inscricao->get_situacao_resumo() == '2' && $inscricao->get_situacao_deferimento() == '0' && $adm->get_tipo()=='2')||( $inscricao->get_situacao_resumo() == '2' && $inscricao->get_situacao_deferimento() == '1' && $adm->get_tipo()!='2'))									{
									echo "<table width='100%'>

									      <tr><td align='center'></form>
									      <form method='post' action='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=deferir'>
										  <input type='submit' value=' Aceitar Resumo ' class='button_verde'> </td>
										  <input type='hidden' name='codigo_pessoa' value='".$pessoa->get_codigo_pessoa()."'/>
										  <input type='hidden' name='codigo_evento' value='".$inscricao->get_codigo_evento()."'/>
										  <input type='hidden' name='tipo' value='resumo'/>
										  <input type='hidden' name='action' value='deferir'/></form>
											</td></tr>

											<tr><td align='center'><form method='post' action='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=deferir'>
										   <input type='submit' value=' Editar resumo ' class='button_vermelho'>
										   <input type='hidden' name='codigo_pessoa' value='".$pessoa->get_codigo_pessoa()."'/>
										   <input type='hidden' name='codigo_evento' value='".$inscricao->get_codigo_evento()."'/>
										   <input type='hidden' name='tipo' value='resumo'/>
										   <input type='hidden' name='action' value='indeferir'/></form></td></tr>

										</table>";
									}

								$link = "http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=calculaerros&cp=" . $pessoa->get_codigo_pessoa() . "&cr=" . $inscricao->get_codigo_resumo();
								echo "	   <table width='100%'>
									    <tr><td align='center'><form method='post' action='" . $link . "'>
									   <input type='submit' value=' Verificar problemas no resumo ' class='button_verde'></form>
									    </table>";

								echo "</td>
								</tr>


								<tr>
									<td height='40px' width='400'><b>E-mail: </b><a href='home.php?p1=correio&email=" . $pessoa->get_email() . "'>" . $pessoa->get_email() . "</a></td>
								<td width='200'>";

								if ( $inscricao->get_situacao_arte() == '4' && $adm->get_tipo() != '2')
								{
									echo "<table width='100%'><tr><td ><b><a href='#showarte'>Arte:</a> </b>Deferido.</td></tr></table>";
								}
								elseif ( $inscricao->get_situacao_arte() == '3' && $adm->get_tipo() != '2')
								{
									echo "<table width='100%'><tr><td ><b><a href='#showarte'>Arte:</a> </b>Indeferido.</td></tr></table>";
								}
								elseif ( $inscricao->get_situacao_arte() == '1' && $adm->get_tipo() != '2')
								{
									echo "<table width='100%'><tr><td ><b><a href='#showarte'>Arte:</a> </b>Aguardando submissão.</td></tr></table>";
								}
								elseif ( $inscricao->get_situacao_arte() == '2' && $adm->get_tipo() != '2'  )
								{
									echo "<a href='#showarte'>Detalhes da apresentação</a>
											<table width='100%'><tr align='center'><td width='20%' align='left'><b>Arte:</td><td width='40%' >
									      <form method='post' action='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=deferir'>
										   <td width='15%' ><input type='submit' value='Rejeitar Arte' class='button_vermelho'></td>
										   <input type='hidden' name='codigo_pessoa' value='".$pessoa->get_codigo_pessoa()."'/>
										   <input type='hidden' name='codigo_evento' value='".$inscricao->get_codigo_evento()."'/>
										   <input type='hidden' name='tipo' value='arte'/>
										   <input type='hidden' name='action' value='indeferir'/>
									      </form> </td>
									      <td width='40%' >
									      <form method='post' action='http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=deferir'>
										  <td width='15%' > <input type='submit' value='Aceitar Arte' class='button_verde'> </td>
										  <input type='hidden' name='codigo_pessoa' value='".$pessoa->get_codigo_pessoa()."'/>
										  <input type='hidden' name='codigo_evento' value='".$inscricao->get_codigo_evento()."'/>
										  <input type='hidden' name='tipo' value='arte'/>
										  <input type='hidden' name='action' value='deferir'/>
									      </form></td></tr>
									      </table>";
								}
							echo "</td>
								</tr>
								<tr>
									<td>";

								if ( $frequencia->get_frequencia_palestras() > 1 )
								{
									echo "<br /><b>Frequência deste participante:</b> " . floatval( $frequencia->get_frequencia_palestras() - 2 );
								}
								elseif ( $frequencia->get_frequencia_palestras() < 0. )
								{
									echo "<br /><b>Frequência deste participante:</b> " . floatval( $frequencia->get_frequencia_palestras() + 2 );
								}
								else
								{
									echo "<br /><b>Frequência deste participante:</b> " . floatval( $frequencia->get_frequencia_palestras() );
								}

								if ( $frequencia->get_frequencia_palestras() > $thresh_p )
								{
									if ( $isOpen == 1 )
									{
										echo "<br />Recebeu certificado de participação (<a href='http://sifsc.ifsc.usp.br/adm/pg_participante/action/mudacertificado_action.php?cp=" . $_GET["cp"] . "&fp=" . floatval( $frequencia->get_frequencia_palestras() - 2.0 ) . "&fm=" . floatval( $frequencia->get_frequencia_minicurso() ) . "'>retirar certificado?</a>)";
									}
									else
									{
									      echo "<br />Recebeu certificado de participação";
									}
								}
								else
								{
									if ( $isOpen == 1 )
									{
										echo "<br />Não recebeu certificado de participação (<a href='http://sifsc.ifsc.usp.br/adm/pg_participante/action/mudacertificado_action.php?cp=" . $_GET["cp"] . "&fp=" . floatval( $frequencia->get_frequencia_palestras() + 2.0 ) . "&fm=" . floatval( $frequencia->get_frequencia_minicurso() ) . "'>dar certificado?</a>)";
									}
									else
									{
										echo "<br />Não recebeu certificado de participação";
									}
								}




							echo "<br /><br />
									</td>
								</tr>
								<tr>
									<td><b>Minicurso: </b>";

									$modalidade = $inscricao->get_modalidade();
									if ( $modalidade[3] == 1 )
									{
										$partminic = new ParticipaMinicurso();
										$partminic->find_by_codigo( $pessoa->get_codigo_pessoa() , $inscricao->get_codigo_evento());

										$minicurso = new Minicurso();
										$minicurso->find_by_codigo( $partminic->get_codigo_minicurso() );

										echo "<a href=\"http://sifsc.ifsc.usp.br/adm/pg_minicurso/home.php?page=listainscritos&codigo=" . $partminic->get_codigo_minicurso() . "\">" . $minicurso->get_titulo() . "</a>";


										if ( $frequencia->get_frequencia_minicurso() > $thresh_m )
										{
											if ( $isOpen == 1 )
											{
												echo "<br />Recebeu certificado do minicurso (<a href='http://sifsc.ifsc.usp.br/adm/pg_participante/action/mudacertificado_action.php?cp=" . $_GET["cp"] . "&fp=" . floatval( $frequencia->get_frequencia_palestras() ) . "&fm=" . floatval( $frequencia->get_frequencia_minicurso() - 2.0 ) . "'>retirar certificado?</a>)";
											}
											else
											{
												echo "<br />Recebeu certificado do minicurso ";
											}
										}
										else
										{
											if ( $isOpen == 1 )
											{
												echo "<br />Não recebeu certificado do minicurso (<a href='http://sifsc.ifsc.usp.br/adm/pg_participante/action/mudacertificado_action.php?cp=" . $_GET["cp"] . "&fp=" . floatval( $frequencia->get_frequencia_palestras() ) . "&fm=" . floatval( $frequencia->get_frequencia_minicurso() + 2.0 ) . "'>dar certificado?</a>)";
											}
											else
											{
												echo "<br />Não recebeu certificado do minicurso";
											}

										}

									}
									else
									{
										echo "Não cadastrou nenhum.";
									}

									echo "</td>
									<td><b>Kit:</b> ";

									$kits = new Kits();
									if ( $kits->find_by_codigo_pessoa( $pessoa->get_codigo_pessoa() , $evento->get_codigo_evento() ) )
									{
										if ( $kits->get_entrega() == 1 )
										{
											echo "Entregue";
										}
										else
										{
											echo "Comprado";
										}
									}
									else
									{
										echo "<a href=\"http://sifsc.ifsc.usp.br/adm/pg_site/home.php?p1=kits&opcao=incluir&cp=" . $pessoa->get_codigo_pessoa() . "\">Efetuar compra?</a>";
									}

								echo "</td>
								</tr>
								<tr>
									<td height='20px' colspan='2'><hr></td>
								</tr>
								<tr>
									<td colspan='2'>";

									require_once($home . "public_html/sifsc/user/classes/class.deferimento.php");
									$def = new Deferimento();

									if ( $def->find_by_evento_pessoa_resumo($evento->get_codigo_evento(), $pessoa->get_codigo_pessoa(), $inscricao->get_codigo_resumo() ) and ( $inscricao->get_situacao_resumo() == 3 or $inscricao->get_situacao_resumo() == 2 or $inscricao->get_situacao_resumo() == 4 ) )
									{
										echo "<b>Nota enviada no (último) indeferimento:</b><br /><hr class=\"notadeferimentou\" /><p class=\"notadeferimento\">" . nl2br( $def->get_comentario() ) ."</p><hr class=\"notadeferimentod\" /><br />";
									}
									if ( $modalidade[1] > 1 )
									{
										echo "<br />
									Download do resumo em \(\LaTeX\): &nbsp;&nbsp;&nbsp;<a href='http://sifsc.ifsc.usp.br/adm/pg_participante/resumos/resumo".$pessoa->get_codigo_pessoa().".tex' >resumo.tex</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='http://sifsc.ifsc.usp.br/adm/pg_participante/resumos/logo_sifsc.png' > logo_sifsc.png</a>
									<br />";
									}

									if ( isset( $_SESSION["problemasresumo"] ) )
									{
										echo "<a name='problemas'>" . $_SESSION["problemasresumo"] . "</a>";

										unset( $_SESSION["problemasresumo"] );
									}


									include('inscricao/show_abstracts.php');

								echo "</td>
								</tr>
								<tr>
									<td height='20px' colspan='2'><a name=\"showarte\"></a><hr></td>
								</tr>
								<tr>
									<td colspan='2'>";

									$arte = new Arte();
									if ( $arte->find_by_codigo( $inscricao->get_codigo_arte() ) )
									{
										$arte_checked='checked'; $arte_nochecked='';
										include($home . 'public_html/sifsc/user/event/show_arte.php');
										echo '<p><a href="#topo">Voltar ao topo</a></p>';
									}
									else
									{
										echo '<p>Sem apresentação de obra artística</p>';
									}
									echo "</td>

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
		else
		{
		}
	?>
	</table>

	</div>
</div>
</div>
