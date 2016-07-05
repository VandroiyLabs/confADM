<script type="text/javascript">
<!--

function get_check_value()
{
var c_value = "";
for (var i=0; i < document.orderform.music.length; i++)
   {
   if (document.orderform.music[i].checked)
      {
      c_value = c_value + document.orderform.music[i].value + "\n";
      }
   }
}

//-->
</script>
<?php

	$filtro="";	
	
	
	if(isset($_POST['nivel']) and $_POST['nivel'] == '1')
	{
		$niveis = "";
		$virgula = "";
		$count_nivel=0;
		if ( isset($_POST['nivel_check_pos']) and $_POST['nivel_check_pos'] == '1' ) 
		{
			$niveis .= $virgula . "'Pós-doc'";
			$virgula = ",";
		}
		if ( isset($_POST['nivel_check_pesq']) and $_POST['nivel_check_pesq'] == '1' )
		{
			$niveis .= $virgula . "'Pesquisador'";
			$virgula = ",";
		}
		if ( isset($_POST['nivel_check_prof']) and $_POST['nivel_check_prof'] == '1' )
		{
			$niveis .= $virgula . "'Professor'";
			$virgula = ",";
		}
		if($virgula == ",")
		$filtro .= " and nivel IN (" . $niveis . ")";
	}
		
	if(isset($_POST['area']) and $_POST['area'] == '1')
	{
		$areas = "";
		$virgula = "";

		if ( isset($_POST['area_check_fa']) and $_POST['area_check_fa'] == 'Física Aplicada' ) 
		{
			$areas .= $virgula . "'Física Aplicada'";
			$virgula = ",";
		}
		if ( isset($_POST['area_check_bi']) and $_POST['area_check_bi'] == 'Biomolecular' ) 
		{
			$areas .= $virgula . "'Biomolecular'";
			$virgula = ",";
		}
		if ( isset($_POST['area_check_fb']) and $_POST['area_check_fb'] == 'Física Biomolecular' )
		{
			$areas .= $virgula . "'Física Biomolecular'";
			$virgula = ",";
		}
		if ( isset($_POST['area_check_fc']) and $_POST['area_check_fc'] == 'Física Computacional' )
		{
			$areas .= $virgula . "'Física Computacional'";
			$virgula = ",";
		}
		if($virgula == ",")
		$filtro .= " and (area1 IN (" . $areas . ")  or area2 IN (" . $areas . ")) ";
	}
	
	
	if(isset($_POST['secao']) and $_POST['secao'] == '1')
	{
		$situacao = "";
		$virgula = "";
		$count_secao=0;
		for ($j = 0; $j <= 4; $j++)
		{
			if ( isset($_POST['secao_check_' . $j]) and strcmp($_POST['secao_check_' . $j], $j) == 0 )
			{
				$count_secao++;
				$situacao .= $virgula . "'" . $_POST['secao_check_' . $j] . "'";
				$virgula = ",";
			}
		}
		if($count_secao>0)
		$filtro.= " and secao IN (" . $situacao . ") ";
	}

	
?>
