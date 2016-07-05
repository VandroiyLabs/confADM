
<div id="content2">
<div class="post">
<div class="content2">
<?php 


// Reencontrando a pessoa
$pessoa = new Pessoa();
$pessoa->find_by_codigo($_GET['cp']);

$evento = new Evento();
$evento->find_evento_aberto();

$inscricao = new Inscricao();
$inscricao->find_by_pessoa_evento( $pessoa->get_codigo_pessoa(), $evento->get_codigo_evento() );

$resumo = new Resumo(); 
$resumo->find_by_codigo($inscricao->get_codigo_resumo());

// Preparando variáveis para o formulário
$_SESSION['pessoa'] = $pessoa;
$_SESSION['codigo_pessoa'] = $_GET['cp'];
$_SESSION['inscricao'] = $inscricao;
$_SESSION['evento'] = $evento;
$_SESSION['resumo'] = $resumo;
		
?>	
<table border='0' width='100%'  >
	<tr><td  align="center">
		<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
		?>
	</td></tr>
</table>
	
<?php 	

include('inscricao/abstract.php'); 

?>
		
</div>
</div>

</div>

