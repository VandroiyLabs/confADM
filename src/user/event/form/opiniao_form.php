		<form name="opiniao_form" action="action/opiniao_action.php" method="POST">
			<ul>
				<li>
					<b>Deseja se identificar?</b><br />
					<input type="radio" name="id" value="1">Sim 
					<input type="radio" name="id" value="0" checked>Não
				</li>
				<li>
					<b>PALESTRAS</b>
					<br />
					<input type="radio" name="pa" value="5">Excelente 
					<input type="radio" name="pa" value="4">Muito bom 
					<input type="radio" name="pa" value="3">Bom 
					<input type="radio" name="pa" value="2">Regular 
					<input type="radio" name="pa" value="1">Ruim 
					<div style="display:none;"><input type="radio" name="pa" value="0" checked>Não opinar</div>
					<br />
					Comentários:<br />
					<textarea name="pa_comment" maxlength="500" cols=80 rows=5></textarea>
				</li>
				<?php
				$participacao = new ParticipaMinicurso();	
				if ( $participacao->find_by_codigo($pessoa->get_codigo_pessoa(),$evento->get_codigo_evento()) )
				{	
					$minicurso = new Minicurso();
					$minicurso->find_by_codigo($participacao->get_codigo_minicurso());
					?>
					
					<li>
						<b>MINICURSO<br /><?php echo $minicurso->get_titulo(); ?></b>
						<br />
						<input type="radio" name="mi" value="5">Excelente 
						<input type="radio" name="mi" value="4">Muito bom 
						<input type="radio" name="mi" value="3">Bom 
						<input type="radio" name="mi" value="2">Regular 
						<input type="radio" name="mi" value="1">Ruim 
						<div style="display:none;"><input type="radio" name="mi" value="0" checked>Não opinar</div>
						<br />
						Comentários:<br />
						<textarea name="mi_comment" maxlength="500" cols=80 rows=5></textarea>
					</li>
				<?php
				}
				else
				{
					?>
					<div style="display:none;"><input type="radio" name="mi" value="0" checked>Não opinar</div>
					<?php
				}
				?>
				<li>
					<b>WORKSHOP</b>
					<br />
					<input type="radio" name="ws" value="5">Excelente 
					<input type="radio" name="ws" value="4">Muito bom 
					<input type="radio" name="ws" value="3">Bom 
					<input type="radio" name="ws" value="2">Regular 
					<input type="radio" name="ws" value="1">Ruim 
					<div style="display:none;"><input type="radio" name="ws" value="0" checked>Não opinar</div>
					<br />
					Comentários:<br />
					<textarea name="ws_comment" maxlength="500" cols=80 rows=5></textarea>
				</li>
				<li>
					<b>SITE</b>
					<br />
					<input type="radio" name="st" value="5">Excelente 
					<input type="radio" name="st" value="4">Muito bom 
					<input type="radio" name="st" value="3">Bom 
					<input type="radio" name="st" value="2">Regular 
					<input type="radio" name="st" value="1">Ruim 
					<div style="display:none;"><input type="radio" name="st" value="0" checked>Não opinar</div>
					<br />
					Comentários:<br />
					<textarea name="st_comment" maxlength="500" cols=80 rows=5></textarea>
				</li>
				<?php
				$kits = new Kits();
				if ( $kits->find_by_codigo_pessoa( $pessoa->get_codigo_pessoa() , $evento->get_codigo_evento()) )
				{
					?>
					<li>
						<b>KIT</b>
						<br />
						<input type="radio" name="kit" value="5">Excelente 
						<input type="radio" name="kit" value="4">Muito bom 
						<input type="radio" name="kit" value="3">Bom 
						<input type="radio" name="kit" value="2">Regular 
						<input type="radio" name="kit" value="1">Ruim 
						<div style="display:none;"><input type="radio" name="kit" value="0" checked>Não opinar</div>
						<br />
						Comentários:<br />
						<textarea name="kit_comment" maxlength="500" cols=80 rows=5></textarea>
					</li>
					<?php
				}
				else
				{
					?>
					<div style="display:none;"><input type="radio" name="kit" value="0" checked>Não opinar</div>
					<?php
				}
				?>
				<li>
					<b>ESPAÇO/LOCALIZAÇÃO</b>
					<br />
					<input type="radio" name="es" value="5">Excelente 
					<input type="radio" name="es" value="4">Muito bom 
					<input type="radio" name="es" value="3">Bom 
					<input type="radio" name="es" value="2">Regular 
					<input type="radio" name="es" value="1">Ruim 
					<div style="display:none;"><input type="radio" name="es" value="0" checked>Não opinar</div>
					<br />
					Comentários:<br />
					<textarea name="es_comment" maxlength="500" cols=80 rows=5></textarea>
				</li>
				<li>
					<b>EMPRESAS</b>
					<br />
					<input type="radio" name="em" value="5">Excelente 
					<input type="radio" name="em" value="4">Muito bom 
					<input type="radio" name="em" value="3">Bom 
					<input type="radio" name="em" value="2">Regular 
					<input type="radio" name="em" value="1">Ruim 
					<div style="display:none;"><input type="radio" name="em" value="0" checked>Não opinar</div>
					<br />
					Comentários:<br />
					<textarea name="em_comment" maxlength="500" cols=80 rows=5></textarea>
				</li>
				<li>
					<b>APLICATIVO INEVENT</b>
					<br />
					<input type="radio" name="inne" value="5">Excelente 
					<input type="radio" name="inne" value="4">Muito bom 
					<input type="radio" name="inne" value="3">Bom 
					<input type="radio" name="inne" value="2">Regular 
					<input type="radio" name="inne" value="1">Ruim 
					<div style="display:none;"><input type="radio" name="inne" value="0" checked>Não opinar</div>
					<br />
					Comentários:<br />
					<textarea name="inne_comment" maxlength="500" cols=80 rows=5></textarea>
				</li>

				<li>
					<b>Comentários gerais</b>
					<br />Aproveite aqui para também dar sugestões para a próxima edição da SIFSC.
					<br />
					<textarea name="gr_comment" maxlength="1000" cols=80 rows=12></textarea>
				</li>
			</ul>
			
			<p style="text-align:right;">
				<input type="submit" value="Submeter" />
			</p>
		</form>

