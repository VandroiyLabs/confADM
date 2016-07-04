function valid_form()  
{ 
	if (document.formulario.participa.value == 1)
	{

		
		if(document.formulario.termos.checked == false)
		{
			document.getElementById("termos").style.display='inline';
			return false;
		}

		if(document.formulario.total.value < 2)
		{
			 if(document.formulario.minicurso.checked == false)
				return false;
		}
		else
		{
			checked=false;
			for (i=0; i < document.formulario.total.value; i++)	
		    		if(document.formulario.minicurso[i].checked == true)
				 checked=true;

			if(!checked) return false;
		}	

			document.formulario.page.value = 'insert';
	}
	else
	{
		document.formulario.page.value = 'remove';
	}

	document.formulario.submit();
}


function habilita_minicurso()  
{  

	if(document.formulario.total.value < 2)
	{
		 document.formulario.minicurso.disabled = false;
	}
	else
	{

		for (i=0; i < document.formulario.total.value; i++)	
	    		document.formulario.minicurso[i].disabled = false; //Desabilitando
	}	  
}  
function desabilita_minicurso()  
{  

	if(document.formulario.total.value < 2)
	{
		 document.formulario.minicurso.disabled = true;
		 document.formulario.minicurso.checked = false;
	}
	else
	{

		for (i=0; i < document.formulario.total.value; i++){	
	    		document.formulario.minicurso[i].disabled = true; //Desabilitando
			document.formulario.minicurso[i].checked = false;}
	}
}  

function desabilita()  
{  
         document.formulario.participa[0].disabled = true;
         document.formulario.participa[1].disabled = true;

	if(document.formulario.total.value < 2)
	{
		 document.formulario.minicurso.disabled = true;
	}
	else
	{

		for (i=0; i < document.formulario.total.value; i++)	
	    		document.formulario.minicurso[i].disabled = true; //Desabilitando
	}
 	 
}


function showabstract(idx)
{
	
	if ( document.getElementById('resumomc' + lastid) )
	{
		document.getElementById('autormc' + lastid).style.display = 'none';
		document.getElementById('resumomc' + lastid).style.display = 'none';
	}
	
	document.getElementById('autormc' + idx).style.display = 'inline';
	document.getElementById('resumomc' + idx).style.display = 'inline';
	
	lastid = idx;
		
	return true;
}

lastid = 150;







