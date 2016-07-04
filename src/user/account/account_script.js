function valid_form(){
	
	if(!verifyEmail())
	return false;
	if(!verifyPassword())
	return false;
					
	document.formulario.submit();
};


function verifyEmail(){

	var filtro_mail = /^.+@.+\..{2,3}$/;
	
	if (!filtro_mail.test(document.formulario.email.value) || document.formulario.email.value=="") {
		alert("Email inválido");
		
		document.formulario.email.style.border='2px solid red';
		document.formulario.email.focus();
		return false;
	}

	document.formulario.email.style.border='';	
	return true;
}

function verifyPassword(){


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

	if(document.formulario.senha.value.length > 10 || document.formulario.senha.value.length < 5){
		alert("Insira uma senha de 5 a 10 digitos!");
		
		document.formulario.senha.style.border='2px solid red';
		document.formulario.senha_confirm.style.border='2px solid red';
		document.formulario.senha.focus();
		return false;
	}

	document.formulario.senha.style.border='';
	document.formulario.senha_confirm.style.border='';
	return true;
} 
