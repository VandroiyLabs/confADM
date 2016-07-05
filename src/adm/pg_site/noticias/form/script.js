/**********************************************************************/

function valid_form(){

			
	if(!verifyFields()){
		alert("Por favor, complete os campos obrigatórios!");
		return false;
	}
	
	document.formulario.submit();
};

/**********************************************************************/

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
