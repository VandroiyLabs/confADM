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
	
	
	if ( isset($_POST['cadastro']) and $_POST['cadastro'] == '0' )
	$filtro .= " and Inscricao.modalidade LIKE '1%' ";
	
	if ( isset($_POST['cadastro']) and $_POST['cadastro'] == '1' )
	$filtro .= " and Inscricao.modalidade LIKE '0%' and Inscricao.token = 'ativado' ";
	
	if ( isset($_POST['cadastro']) and $_POST['cadastro'] == '2' )
	$filtro .= " and Inscricao.token <> 'ativado' ";
		
	if ( isset($_POST['minicurso']) and $_POST['minicurso'] == '1' )
	$filtro .= " and ParticipaMinicurso.codigo_minicurso > 0 ";
	
	if(isset($_POST['minicurso']) and $_POST['minicurso'] == '2')
	$filtro .= " and ParticipaMinicurso.codigo_minicurso IS NULL ";

	if ( isset($_POST['premio']) and $_POST['premio'] == '1' )
	$filtro .= " and premio = 1 ";
	
	if(isset($_POST['premio']) and $_POST['premio'] == '2')
	$filtro .= " and premio = 0 ";	
	
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
		}
		
		$filtro .= " and nivel IN (" . $niveis . ")";
	}
	
	if(isset($_POST['resumo']) and $_POST['resumo'] == '1')
	{
		$situacao = "";
		$virgula = "";
		for ($j = 0; $j <= 5; $j++)
		{
			if ( isset($_POST['resumo_check_' . $j]) and strcmp($_POST['resumo_check_' . $j], $j) == 0 )
			{
				
				$situacao .= $virgula . "'" . $_POST['resumo_check_' . $j] . "'";
				$virgula = ",";
			}
		}
		
		$filtro .= " and situacao_resumo IN (" . $situacao . ")";
	}
	
	if(isset($_POST['arte']) and $_POST['arte'] == '1')
	{
		$situacao = "";
		$virgula = "";
		for ($j = 0; $j <= 4; $j++)
		{
			if ( isset($_POST['arte_check_' . $j]) and strcmp($_POST['arte_check_' . $j], $j) == 0 )
			{
				$situacao .= $virgula . "'" . $j . "'";
				$virgula = ",";
			}
		}
		
		$filtro .= " and situacao_arte IN (" . $situacao . ")";
	}

	if(isset($_POST['deferimento']) and $_POST['deferimento'] == '1')
	$filtro .= " and situacao_deferimento= 0 and situacao_resumo = 2";
	
	if(isset($_POST['deferimento']) and $_POST['deferimento'] == '2')
	$filtro .= " and situacao_deferimento= 1 and situacao_resumo = 2";

	
?>
