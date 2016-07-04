function valid_form(){
	
	if(document.formulario.senha_antiga.value=='')
	{
		document.formulario.senha_antiga.style.border='2px solid red';
		document.formulario.senha_antiga.focus();
		return false;
	}
	
	if(!verifyPassword()) return false;
		
	document.formulario.submit();
};

function verifyPassword()
{


   if (document.formulario.senha.value == "" || document.formulario.senha_confirm.value == "" ){
      alert("Por favor, insira uma senha válida!");
       
		document.formulario.senha.style.border='2px solid red';
		document.formulario.senha_confirm.style.border='2px solid red';
		document.formulario.senha.focus();
		return false;
	}
	
   if (document.formulario.senha.value != document.formulario.senha_confirm.value ){
      alert("Senhas não conferem!");
       
		document.formulario.senha.style.border='2px solid red';
		document.formulario.senha_confirm.style.border='2px solid red';
		document.formulario.senha.focus();
		return false;
	}

	if(document.formulario.senha.value.length > 8 || document.formulario.senha.value.length < 6){
		alert("Insira uma senha entre 6 e 8 digitos!");
		
		document.formulario.senha.style.border='2px solid red';
		document.formulario.senha_confirm.style.border='2px solid red';
		document.formulario.senha.focus();
		return false;
	}

	document.formulario.senha.style.border='';
	document.formulario.senha_confirm.style.border='';
	return true;
} 

function desabilita()  
{  
         document.formulario.senha_antiga.disabled = true;
         document.formulario.senha.disabled = true;
    	 document.formulario.senha_confirm.disabled = true;
}  
