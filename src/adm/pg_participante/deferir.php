<div id="content">
<div class="post">
	<div class="content">



<script type="text/javascript" language="javascript" src="http://sifsc.ifsc.usp.br/adm/pg_participante/form/deferimento_script.js" ></script>

<form method="POST" name="formulario" action="http://sifsc.ifsc.usp.br/adm/pg_participante/action/deferimento_action.php">


	<?php
	
	/* Marcando o resumo como SOB EDICAO */
	require_once('./../../user/classes/class.EmEdicao.php');
	
	$editando = new EmEdicao();
	if ( $editando->find_by_adm($adm->get_usuario()) )
	{
		$editando->remove();
	}
	
	$editando = new EmEdicao();
	if ( $editando->find_by_pessoa($_SESSION["codigo_pessoa"]) and strcmp($editando->get_adm_usuario(), $adm->get_usuario()) != 0 )
	{
		echo "<div id='annoyingwarning'>Sendo editado no momento por " . $editando->get_adm_usuario() . "</div>";
	}
	else
	{
		$editando = new EmEdicao();
		$editando->set_codigo_pessoa($_SESSION["codigo_pessoa"]);
		$editando->set_adm_usuario( $adm->get_usuario() );
		$editando->insert();
	}

	
	$pessoa = new Pessoa();
	$pessoa->find_by_codigo( $_POST['codigo_pessoa'] );
	$_SESSION["pessoa"] = $pessoa;
	
	include("form/deferimento_form.php");		
	?>

	<input type='hidden' name='codigo_pessoa' value="<?=$_POST['codigo_pessoa']?>"/>
	<input type='hidden' name='codigo_evento' value="<?=$_POST['codigo_evento']?>"/>
	<input type='hidden' name='tipo' value="<?=$_POST['tipo']?>"/>
	<input type='hidden' name='action' value="<?=$_POST['action']?>"/>
	<input type='hidden' name='pagina_atual' value="<?=$_POST['pagina_atual']?>"/>
	

</form>

</div>
</div>
</div>
