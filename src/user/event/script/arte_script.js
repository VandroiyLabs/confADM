function valid_form()  
{ 


	if (document.formulario.participa[0].checked == true)
	{
		if (document.formulario.titulo.value==""){
			document.formulario.titulo.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.titulo.style.border='';

		if (document.formulario.tipo_obra.value==""){
			document.formulario.tipo_obra.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.tipo_obra.style.border='';
		
		if (document.formulario.tipo_apresentacao.value==""){
			document.formulario.tipo_apresentacao.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.tipo_apresentacao.style.border='';
		
		if (document.formulario.descricao.value==""){
			document.formulario.descricao.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.descricao.style.border='';
		
		
		if (document.formulario.altura.value==""){
			document.formulario.altura.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.altura.style.border='';
		
		if (document.formulario.largura.value==""){
			document.formulario.largura.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.largura.style.border='';

		if (document.formulario.profundidade.value==""){
			document.formulario.profundidade.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.profundidade.style.border='';
		
		
		document.formulario.page.value = 'insert';
	}
	else
	{
		document.formulario.page.value = 'remove';
	}

	if(document.formulario.termos.checked == false)
	{
		document.getElementById("termos").style.display='inline';
		return false;
	}
	
	document.formulario.submit();
}



function valid_form_submete()
{ 

	if (document.formulario.participa[0].checked == true)
	{
		if (document.formulario.titulo.value==""){
			document.formulario.titulo.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.titulo.style.border='';

		if (document.formulario.tipo_obra.value==""){
			document.formulario.tipo_obra.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.tipo_obra.style.border='';
		
		if (document.formulario.tipo_apresentacao.value==""){
			document.formulario.tipo_apresentacao.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.tipo_apresentacao.style.border='';
		
		if (document.formulario.descricao.value==""){
			document.formulario.descricao.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.descricao.style.border='';
		
		
		if (document.formulario.altura.value==""){
			document.formulario.altura.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.altura.style.border='';
		
		if (document.formulario.largura.value==""){
			document.formulario.largura.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.largura.style.border='';

		if (document.formulario.profundidade.value==""){
			document.formulario.profundidade.style.border='2px solid red';
			return false;
		}
		else
			document.formulario.profundidade.style.border='';
		
		
		document.formulario.page.value = 'insert';
	}

	if(document.formulario.termos.checked == false)
	{
		document.getElementById("termos").style.display='inline';
		return false;
	}

	document.formulario.submissao.value = '1';
	document.formulario.submit();
}


function habilita_arte()  
{  
	document.formulario.titulo.disabled = false; //Habilitando
	document.formulario.termos.disabled = false; //Desabilitando
	document.formulario.tipo_obra.disabled = false;
	document.formulario.tipo_apresentacao.disabled = false;
	document.formulario.largura.disabled = false;
	document.formulario.altura.disabled = false;
	document.formulario.profundidade.disabled = false;
	document.formulario.descricao.disabled = false;	  
}  
function desabilita_arte()  
{  
         
	document.formulario.titulo.disabled = true; //Desabilitando
	document.formulario.termos.disabled = true; //Desabilitando
	document.formulario.tipo_obra.disabled = true;
	document.formulario.tipo_apresentacao.disabled = true;
	document.formulario.largura.disabled = true;
	document.formulario.altura.disabled = true;
	document.formulario.profundidade.disabled = true;
	document.formulario.descricao.disabled = true;  
}  

function desabilita()  
{  
	document.formulario.participa[0].disabled = true;
	document.formulario.participa[1].disabled = true;
	document.formulario.titulo.disabled = true; //Desabilitando
	document.formulario.tipo.disabled = true;
	document.formulario.largura.disabled = true;
	document.formulario.altura.disabled = true;
	document.formulario.profundidade.disabled = true;
	document.formulario.descricao.disabled = true;  
}  
