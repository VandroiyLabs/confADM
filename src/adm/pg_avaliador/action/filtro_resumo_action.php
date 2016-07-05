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
	
	if ( isset($_POST['indexacaosifsc']) and strcmp($_POST['indexacaosifsc'], "") != 0 )
	{
		// Codigos: PG, IC, OU todos têm duas letras!
		$codigo_burto_nospaces = str_replace(' ','', $_POST['indexacaosifsc'] );
		$codigopessoa_busca = substr($codigo_burto_nospaces, 2);
		if ( is_numeric( $codigopessoa_busca ) )
		{
			$filtro .= " and Inscricao.codigo_pessoa=" . $codigopessoa_busca . " ";
		}
	}
	
	
	if(isset($_POST['instituicao']) and $_POST['instituicao'] == '1')
	$filtro .= " and Instituicao='IFSC-USP' ";
	
	if(isset($_POST['instituicao']) and $_POST['instituicao'] == '2')
	$filtro .= " and Instituicao<>'IFSC-USP' ";
	
	if(isset($_POST['nivel']) and $_POST['nivel'] == '1')
	{
		$niveis = "";
		$virgula = "";
		if ( isset($_POST['nivel_check_grad']) and $_POST['nivel_check_grad'] == '1' ) 
		{
			$niveis .= $virgula . "'Graduacao'";
			$virgula = ",";
		}
		if ( isset($_POST['nivel_check_mest']) and $_POST['nivel_check_mest'] == '1' )
		{
			$niveis .= $virgula . "'Mestrado'";
			$virgula = ",";
		}
		if ( isset($_POST['nivel_check_doc']) and $_POST['nivel_check_doc'] == '1' )
		{
			$niveis .= $virgula . "'Doutorado'";
			$virgula = ",";
		}
		if($virgula == ',')
		$filtro .= " and Inscricao.nivel IN (" . $niveis . ")";
	}
	
	if(isset($_POST['avaliacao']) and $_POST['avaliacao'] == '1')
	{
		$situacao = "";
		$virgula = "";
		for ($j = 0; $j <= 2; $j++)
		{
			if ( isset($_POST['avaliacao_check_' . $j]) and strcmp($_POST['avaliacao_check_' . $j], $j) == 0 )
			{
				
				$situacao .= $virgula . "'" . $_POST['avaliacao_check_' . $j] . "'";
				$virgula = ",";
			}
		}
		if($virgula == ',')
		$filtro .= " and (N1.situacao IN (" . $situacao . ") or N2.situacao IN (" . $situacao . "))";
	}

	if(isset($_POST['avaliador']) and $_POST['avaliador'] == '1')
	{
		$situacao = "";
		$virgula = "";

			$or="";

			if ( isset($_POST['avaliador_check_0']) and strcmp($_POST['avaliador_check_0'], '0') == 0 )
			{
				$check0= "(Avalia_Resumo.codigo_avaliador1 > 0 and Avalia_Resumo.codigo_avaliador2 > 0) ";
				$or=" or ";
			}
			
			if ( isset($_POST['avaliador_check_1']) and strcmp($_POST['avaliador_check_1'], '1') == 0 )
			{
				$check1= $or."((Avalia_Resumo.codigo_avaliador1 = 0 and Avalia_Resumo.codigo_avaliador2 > 0) or (Avalia_Resumo.codigo_avaliador1 > 0 and Avalia_Resumo.codigo_avaliador2 = 0)) ";
				$or=" or ";
			}

			if ( isset($_POST['avaliador_check_2']) and strcmp($_POST['avaliador_check_2'], '2') == 0 )
			{
				$check2= $or."(Avalia_Resumo.codigo_avaliador1 = 0 and Avalia_Resumo.codigo_avaliador2 = 0) ";
				$or=" or ";
			}
		
		if($or == " or ")
		$filtro .= " and ( ".$check0." ".$check1." ".$check2." ) ";
	}
	
	

	
?>
