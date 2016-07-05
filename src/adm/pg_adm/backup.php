<div id="content">

<div class="post">
	<h1 class="title">Backup </h1>
	<div class="content">

	<table width="100%">
		<tr> 
			<td height="30">Arquivo: <?php echo 'adm-'.date("Y-m-d-H-i-s").'.sql'?></td>
		</tr>

	</table>
	<table>
		<tr> 
			<td height="12" colspan="2">
				<form method="POST" name="formulario" action="action/backup_action.php">
					
					<table border='0' width='100%' > 
						<tr> 
							<td align='right' >
								<input type="submit" value=" Backup " class="button">
							</td> 
						</tr>
					</table>
					
					<input type='hidden' name='page' value='backup'/>
				</form>	
			</td> 
		</tr> 
	</table>

	</div>
</div>
</div>
