<?php
include("form/novo_evento.php");
?>

<table>
	<tr>
		<td height="20"></td>
	</tr>
</table>

<h2>Eventos Inscritos</h2><br>

<table width="100%" border="0" cellspacing="0" cellpadding="0" >
	<tr>
		<td>
		<?php

			$inscricao = new Inscricao();
			$consulta = $inscricao->find_by_pessoa($pessoa->get_codigo_pessoa());

			$total = mysql_num_rows($consulta);

			while ($row = mysql_fetch_object($consulta)){

				if($row->situacao_deferimento == '2')
					$deferimento = "<font color='green'>SIM</font>";
				else
					$deferimento = "<font color='red'>Não</font>";

				$nome_secao = $row->nome_secao;

				echo"
				<tr>
					<td valign='top' colspan='3'>
						<table border='0' cellspacing='0' cellpadding='5' width='100%' id='block'>
							<tr>
								<td height='30' bgcolor='#c4c4c4' colspan='2'>
									<table width='100%'>
										<tr>
										<td height='20' ><b>$row->nome_evento</b></td>
										";

										if($row->situacao_deferimento != '2')
										echo "
										<!--
										<td align='right' width='10%'>
											<form method='get' action='action/deferimento_action.php'>
												<input type='submit' value='  Deferir  ' class='button_deferir'>
											<input type='hidden' name='codigo_pessoa' value='$row->codigo_pessoa'/>
											<input type='hidden' name='codigo_evento' value='$row->codigo_evento'/>
											<input type='hidden' name='deferir' value='direto'/>
											</form>
										</td>


										<td align='right'></td>
										-->
										";

										echo "

										<td align='right' width='10%'>
											<form method='post' action='home.php'>
												<input type='submit' value='  Detalhes  ' class='button'>

											<input type='hidden' name='p1' value='detalhes'/>
											<input type='hidden' name='p2' value='inscricao'/>
											<input type='hidden' name='p3' value='update_inscricao'/>
											<input type='hidden' name='codigo_pessoa' value='$row->codigo_pessoa'/>
											<input type='hidden' name='codigo_evento' value='$row->codigo_evento'/>

											</form>
										</td>

										<td align='right'></td>

										<td align='right' bgcolor='#c4c4c4' width='10%'>
											<form method='post' action='home.php'>
												<input type='submit' value='  Excluir  ' class='button_excluir'>
											<input type='hidden' name='p1' value='detalhes'/>
											<input type='hidden' name='p2' value='inscricao'/>
											<input type='hidden' name='p3' value='remove_inscricao'/>
											<input type='hidden' name='codigo_pessoa' value='$row->codigo_pessoa'/>
											<input type='hidden' name='codigo_evento' value='$row->codigo_evento'/>
											</form>
										</td>
										<td width='5'></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan='3' height='10'></td>
							</tr>
							<tr>
								<td width='5'></td>
								<td height='30'>
									<table cellspacing='0'>
										<tr>
											<td height='20' colspan='3'><b>Seção:</b> $nome_secao</td>
										</tr>
										<!--
										<tr>
											<td height='20' colspan='3'><b>Titulo do Resumo: </b>$row->titulo_resumo</td>
										</tr>
										-->
										<tr>
											<td height='20' colspan='3'><b>Deferido: </b>$deferimento</td>
										</tr>

										<!--<tr>
											<td height='20' colspan='3'><b>Financiamento: </b>$row->codigo_financiadora</td>
										</tr>	-->
										<tr>
											<td height='10' colspan='2'></td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<table>
						<tr>
							<td height='12'></td>
						</tr>
						</table>

					</td>
				</tr>
				";

			}
			if($total == 0){
				echo "Nenhum evento cadastrado";
			}

			?>
		</td>
	</tr>
</table>
