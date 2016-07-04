<?php
	require_once("~/public_html/sifsc/user/classes/class.avaliador.php");
	require_once("~/public_html/sifsc/user/classes/class.avaliacao.php");
	require_once("~/public_html/sifsc/user/classes/class.evento.php");

	session_start();
	require_once("../referee_edition_variables.php");
	require_once($head_file);

	require_once("~/public_html/sifsc/referee/restricted.php");
	require_once("~/public_html/sifsc/referee/event/secao.php");

	include('index.php');
	
	$secao = array(
	0 =>"",
	1 =>"01/10 - 8h",
	2 =>"01/10 - 10h15",
	3 =>"01/10 - 14h",
	4 =>"01/10 - 16h");
	
	
	$dias = '';
	$avalia = 0;
	$avaliacao = new Avaliacao();
	if($avaliacao->find( $avaliador->get_codigo_avaliador(), 0, $evento->get_codigo_evento() ))
	{
		$resumo="<li><b>Cadastrado como avaliador de resumos para premiação.</b>  </li>";
	}
	else
	{
		$resumo="";
	}	
		
	for ( $j = 1; $j <= 4; $j++ )
	{
		$avaliacao = new Avaliacao();
		if ( $avaliacao->find( $avaliador->get_codigo_avaliador(), $j,$evento->get_codigo_evento()  ) )
		{
			$dias .= " [" . $secao[$j] . "] ";
			$avalia = 1;
		}
	}
	if ( $avalia == 0 )
	{
		$dias = " Não foram cadastradas sessões!";
	}
?>

<div id="user_system">

	<div id="titulo_form_secao">
		Conta de avaliador
	</div>	
	
	<div id="status">
		
		<p>Seja bem vindo à sua área de avaliador. Verifique seus dados abaixo, se algum deles estiver incorreto, entre em contato imediatamente com a comissão (eles influenciam a distribuição de resumos).</p>
		
		<ul>
			<li><b>Registrado como</b> <?php echo $avaliador->get_email(); ?> </li>
			<li><b>Grupo de pesquisa:</b> <?php echo $avaliador->get_grupo(); ?> </li>
			<li><b>Área primária:</b> <?php echo $avaliador->get_area1(); ?> </li>
			<li><b>Área secundária:</b> <?php echo $avaliador->get_area2(); ?> </li>
			<li><b>Especialidade:</b> <?php echo $avaliador->get_subarea(); ?> </li>
			<li><b>Sessões de avaliação:</b> <?php echo $dias; ?> </li>
			<?php echo $resumo; ?>
		</ul>
	</div>
	

</div>

<?php  
	require_once("~/public_html/sifsc/referee/event/session.php");
   	require_once($foot_file);
?>			
