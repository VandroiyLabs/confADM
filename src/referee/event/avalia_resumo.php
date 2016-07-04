<?php
	
require_once("~/public_html/sifsc/user/classes/class.avaliador.php");
require_once("~/public_html/sifsc/user/classes/class.evento.php");
require_once("~/public_html/sifsc/user/classes/class.inscricao.php");
require_once("~/public_html/sifsc/user/classes/class.resumo.php");
require_once("~/public_html/sifsc/user/classes/class.autor.php");
require_once("~/public_html/sifsc/user/classes/class.nota_resumo.php");

session_start();
require_once("../referee_edition_variables.php");
require_once($head_file);




require_once("~/public_html/sifsc/referee/event/secao.php");
require_once("~/public_html/sifsc/referee/restricted.php");

include('index.php');

$inscricao = new Inscricao();
$ok=1;
if(isset( $_GET["codigo"]) and  $_GET["codigo"] != 0)
{
	$inscricao->find_by_pessoa_evento( $_GET["codigo"], $evento->get_codigo_evento() );
	$nota_resumo = new NotaResumo();
	if(!$nota_resumo->find_by_codigo($avaliador->get_codigo_avaliador(),$_GET["codigo"],$evento->get_codigo_evento()))
	$ok=0;
}
else
{
	$ok=0;
}

if($ok==0)
{
echo "<script language=\"javascript\">location=(\"./avalia_resumo_home.php\");</script>";
exit();
}
?>



<div id="user_system">

	

	<script type="text/javascript" language="javascript" src="http://sifsc.ifsc.usp.br/referee/event/action/avalia_resumo_script.js" ></script>
	
	<div id="titulo_form_secao">
		Avaliação de Resumo
	</div>	

	
	<?php
		if ( isset($_SESSION['msg']) )
		{
			echo "	<div id=\"msg\">";
			echo "<p>" . $_SESSION['msg'] . "</p>";
			echo "	</div>";
			unset($_SESSION['msg']);
		}
	?>

	<p>As orientações abaixo têm como principal objetivo tornar homogenêas as avaliações de resumos da SIFSC 5, possibilitando que, independente da área do aluno e do avaliador, o processo de avaliação ocorra da maneira mais eficiente possível. Deve ser atribuída uma nota entre 0 e 10 para cada um do 3 critérios listados abaixo. </p>
	
	<form method="POST" name="avalia_resumo_form" action="action/avalia_resumo_action.php">
		<?php 
			if($nota_resumo->get_situacao() == 0 or $nota_resumo->get_situacao() == 1)
			{
				include("~/public_html/sifsc/referee/event/form/avalia_resumo_form.php");
			}
			else
			{
				echo "<p>Avaliação submetida.<br /></p>";
			}
			
			include('show_resumo.php');
		?>
			
		<input type='hidden' name='page' value='avalia_resumo'/>
		<input type='hidden' name='codigo' value="<?=$_GET['codigo']?>"/>
	
	</form> 
</div>

<?php
	require_once("~/public_html/sifsc/referee/event/session.php");
	require_once($foot_file);
?>
