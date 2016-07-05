	<div id="vendakits">
	
	<?php
	
	$pessoa = new Pessoa();
	$kits = new Kits();
	$evento = new Evento();
	$evento->find_evento_aberto();
	
	if ( isset( $_GET['cp'] ) and $pessoa->find_by_codigo( $_GET['cp'] ) )
	{
		$nome = $pessoa->get_nome();
		$email = $pessoa->get_email();
		$cp = $pessoa->get_codigo_pessoa();
	?>
	
	<h2>Remover a venda do kit a <?php echo $pessoa->get_nome(); ?>?</h2>
		
	<h2><a href="kits/action/deleta_action.php?cp=<?php echo $pessoa->get_codigo_pessoa(); ?>">Sim, a venda foi cancelada.</a></h2>
	
	<?php
	
	}
	elseif ( isset( $_GET['em'] ) and $kits->find_by_email( $_GET['em'] , $evento->get_codigo_evento() ) )
	{
		
	?>
	
	<h2>Remover a venda do kit a <?php echo $kits->get_nome(); ?>?</h2>
		
	<h2><a href="kits/action/deleta_action.php?em=<?php echo $kits->get_email(); ?>">Sim, a venda foi cancelada.</a></h2>
	
	<?php
	
	}
	else
	{
		$_SESSION['msg'] = "Tentando acessar páginas sem contexto!!";
		echo "<script language=\"JavaScript\">location=(\"../../home.php?p1=kits\");</script>";
	}
	
	?>
	
	</div>
