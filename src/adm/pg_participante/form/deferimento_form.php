<?php
	
	if($_POST['action'] == 'deferir' && $_POST['tipo']== 'resumo')
	{
		$inscricao = new Inscricao();
		$inscricao->find_by_pessoa_evento($_POST['codigo_pessoa'],$_POST['codigo_evento']); 		      	$resumo = new Resumo();
		$resumo->find_by_codigo($inscricao->get_codigo_resumo()); 	
?>		
	<h2>Deferimento de Resumo</h2>
	<p>Tem certeza que defere o resumo entitulado "<?php echo $resumo->get_titulo(); ?>"?</p>
		<table cellspacing="15" cellpadding="1" border="0"  width="100%">
			<tr> 
				<td >
					<input type="button" class="button_azul" onClick='cancel();' value=" Cancelar " >
				</td>
				<td >
					<input type="button" class="button_azul" onClick='confirm();' value=" Confirmar " >
				</td>
			</tr>
		</table>
				
<?php			
	}
	elseif($_POST['action'] == 'deferir' && $_POST['tipo']== 'arte')
	{
		$inscricao = new Inscricao();
		$inscricao->find_by_pessoa_evento($_POST['codigo_pessoa'],$_POST['codigo_evento']); 		      	$arte = new Arte();
		$arte->find_by_codigo($inscricao->get_codigo_arte()); 	
?>		
	<h2>Deferimento de Arte</h2>
	<p>Tem certeza que defere a apresentação/obra artística entitulada "<?php echo $arte->get_titulo(); ?>"?</p>
		<table cellspacing="15" cellpadding="1" border="0"  width="100%">
			<tr> 
				<td >
					<input type="button" class="button_azul" onClick='cancel();' value=" Cancelar " >
							
				</td>
				<td >
					<input type="button" class="button_azul" onClick='confirm();' value=" Confirmar " >
				</td>
			</tr>
		</table>
				
<?php			
	}
	elseif($_POST['action'] == 'indeferir' && $_POST['tipo']== 'resumo')
	{
		$inscricao = new Inscricao();
		$inscricao->find_by_pessoa_evento($_POST['codigo_pessoa'],$_POST['codigo_evento']); 		      	$resumo = new Resumo();
		$resumo->find_by_codigo($inscricao->get_codigo_resumo()); 	
			
		if($adm->get_tipo()!='2')
		{		
?>	
			<h2>Indeferir Definitivamente o Resumo</h2>
			<p>Tem certeza que deseja indeferir o resumo entitulado "<?php echo $resumo->get_titulo(); ?>" definitivamente? Escolhendo esta opção o usuário não poderá corrigir e resubmeter o resumo.</p>

				<table cellspacing="15" cellpadding="1" border="0"  width="100%">
					<tr>
						<td>
							Comentário:<br /> <div id="warning_mensagem_direto" class='warning_mensagem'>Por favor, escreva um comentário para que o usuário seja informado da razão de seu indeferimento.</div>
						</td>
						<td align='right'>
							<textarea name="comentario_direto" rows="10" cols="46" ></textarea>
						</td>
					</tr>
					<tr> 
						<td colspan='2'  align='right'>
							<input type="button" class="button_azul" onClick='cancel();' value=" Cancelar " >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="button" class="button_azul" onClick='indeferir_direto();' value=" Continuar " >
						</td>				
					</tr>	
				</table>
<?php			
		}
		
		$codigopessoa = $inscricao->get_codigo_pessoa();
		
?>
		<h2>Edição de resumo</h2>
		<p>Você está editando o resumo entitulado "<?php echo $resumo->get_titulo(); ?>". Para modificá-lo, clique em "editar resumo". Se o resumo <b>não precisar voltar para o usuário</b>, selecione a opção "não" na pergunta abaixo. Caso o usuário precise incluir novas informações, escreva uma mensagem e selecione a opção "sim".</p>
		<p>
			<a class="resumo" target="iframeformulario" onClick="document.getElementById('iframeformulario').style.height='400px'; document.getElementById('botao_fecha_formulario').style.display='inline';" href="http://sifsc.ifsc.usp.br/adm/pg_participante/indeferimento_edita_resumo.php?p1=incluir&opcao=abstract&cp=<?php echo $codigopessoa; ?>">Editar resumo</a>
			<br />
			<?php
			if ( $inscricao->get_codigo_resumo_ingles() != 0 )
			{
				echo "<a class=\"resumo\" target=\"iframeformulario\" onClick=\"document.getElementById('iframeformulario').style.height='400px';document.getElementById('botao_fecha_formulario').style.display='inline';\" href=\"http://sifsc.ifsc.usp.br/adm/pg_participante/indeferimento_edita_resumo.php?p1=incluir&opcao=abstract&lng=1&cp=$codigopessoa\">Editar versão em inglês do resumo</a>";
			}
			?>
		</p>

		<p><a style="display: none; cursor: pointer;" id="botao_fecha_formulario" class="resumo" onClick="document.getElementById('iframeformulario').style.height='0px'; this.style.display= 'none';">Fechar formulário</a></p>
		<iframe name="iframeformulario" id="iframeformulario" width="100%" height="1px" src="" frameborder="0"></iframe>
		
		<table cellspacing="15" cellpadding="1" border="0"  width="100%">
			<tr> 
				<td>
					Comentário: <br /> <div id="warning_mensagem_temp" class='warning_mensagem'>Por favor, escreva um comentário com orientações para que o usuário corrija seu resumo.</div>
				</td>
				<td align='right'>
					<textarea name="comentario_temp" rows="10" cols="46" ></textarea>
				</td>
			</tr>
			<?php if($adm->get_tipo()=='2')
			{?>
			<tr> 
				<td colspan='2' align='right'>
					A pessoa terá que efetuar mudanças no resumo?&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;		
					
					<input type="radio" name="desconta_ponto" value="0" checked />Não
					&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="radio" name="desconta_ponto" value="1" />Sim
				</td>
			</tr>
			<?php 
			}else{
			?>
			      
			<?php 
			}?>
			<tr> 
				<td colspan='2' align='right' >
					<input type="button" class="button_azul" onClick='cancel();' value=" Cancelar " >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
					<input type="button" class="button_azul" onClick='indeferir_temp();' value=" Indeferir para correção " >
				</td>
			</tr>
		</table>
		
		<input type='hidden' name='direto' value=''/>	
<?php			
	}elseif($_POST['action'] == 'indeferir' && $_POST['tipo']== 'arte')
	{
		$inscricao = new Inscricao();
		$inscricao->find_by_pessoa_evento($_POST['codigo_pessoa'],$_POST['codigo_evento']); 		      	$arte = new Arte();
		$arte->find_by_codigo($inscricao->get_codigo_arte()); 	 	
?>		
	<h2>Indeferir Definitivamente Arte</h2>
	<p>Tem certeza que deseja indeferir a arte entitulada "<?php echo $arte->get_titulo(); ?>" definitivamente? </p>

		<table cellspacing="15" cellpadding="1" border="0"  width="100%">
			<tr>
				<td>
					Comentário:<br /> <div id="warning_mensagem_direto" class='warning_mensagem'>Por favor, escreva um comentário para que o usuário seja informado da razão de seu indeferimento.</div>
				</td>
				<td align='right'>
					<textarea name="comentario_direto" rows="10" cols="46" ></textarea>
				</td>

			<tr> 
				<td colspan='2'  align='right'>
					<input type="button" class="button_azul" onClick='cancel();' value=" Cancelar " >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="button" class="button_azul" onClick='indeferir_direto();' value=" Indeferir definitivamente " >
				</td>				
			</tr>	
		</table>	
		
		<input type='hidden' name='direto' value=''/>	
<?php			
	}
	
?>

