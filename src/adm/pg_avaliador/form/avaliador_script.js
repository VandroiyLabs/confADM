/**********************************************************************/

function valid_form(){

	
		
	if(!verifyEmail())
		return false;

	if (!document.formulario.premio[0].checked && !document.formulario.premio[1].checked  ){
			alert("Por favor, preencha o campo resumo!");
			return false;
	}

	if (document.formulario.premio[1].checked && (!document.formulario.dia1.checked && !document.formulario.dia2.checked && !document.formulario.dia3.checked) ){
			alert("Por favor, preencha o postêr!");
			return false;
	}

	if (!document.formulario.linguap.checked && !document.formulario.linguae.checked  ){
			alert("Por favor, preencha o campo língua!");
			return false;
	}

		
			
	//document.formulario.submit();
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


function verifyFields(){

	var fields = true;

	for (i=0; i<=2; i++){
		if (document.formulario[i].value==""){
			document.formulario[i].style.border='2px solid red';
			fields = false;
		}
		else
			document.formulario[i].style.border='';
	}	
	

	return fields;
}
