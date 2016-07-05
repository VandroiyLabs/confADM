/**********************************************************************/

function valid_form()
{

	if(!verifyFields())
	{
		alert("Por favor, complete os campos obrigatórios!");
		return false;
	}

	if(!verifyPassword())
		return false;
		
	if(!verifyEmail())
		return false;
			
	document.formulario.submit();
};

function valid_form_semsenha()
{

	if(!verifyFields_semsenha())
	{
		alert("Por favor, complete os campos obrigatórios!");
		return false;
	}
		
	if(!verifyEmail())
		return false;
			
	document.formulario.submit();
};


/**********************************************************************/

function verifyEmail(){

	var filtro_mail = /^.+@.+\..{2,3}$/;
	
	if (!filtro_mail.test(document.formulario.email.value) || document.formulario.email.value=="") {
		alert("Insert a valid e-mail.");
		
		document.formulario.email.style.border='2px solid red';
		document.formulario.email.focus();
		return false;
	}

	document.formulario.email.style.border='';	
	return true;
}

function verifyPassword(){

   if (document.formulario.senha.value != document.formulario.senha_confirm.value || document.formulario.senha.value == ""){
      alert("Passwords do not match");
       
		document.formulario.senha.style.border='2px solid red';
		document.formulario.senha_confirm.style.border='2px solid red';
		document.formulario.senha.focus();
		return false;
	}

	document.formulario.senha.style.border='';
	document.formulario.senha_confirm.style.border='';
	return true;
} 

function verifyFields()
{

	var fields = true;

	for (i=1; i<7; i++){
		if (document.formulario[i].value==""){
			document.formulario[i].style.border='2px solid red';
			fields = false;
		}
		else
			document.formulario[i].style.border='';
	}	

	return fields;
}

function verifyFields_semsenha()
{

	var fields = true;

	if (document.formulario[0].value==""){
		document.formulario[0].style.border='2px solid red';
		fields = false;
	}
	else
		document.formulario[0].style.border='';
	
	for (i=4; i<7; i++){
		if (document.formulario[i].value==""){
			document.formulario[i].style.border='2px solid red';
			fields = false;
		}
		else
			document.formulario[i].style.border='';
	}	

	return fields;
}
