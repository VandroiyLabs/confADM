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


function dateMask(inputData, e){

	if(document.all) // Internet Explorer
		var tecla = event.keyCode;
	else //Outros Browsers
		var tecla = e.which;

	if(tecla >= 47 && tecla < 58){ // numeros de 0 a 9 e "/"
		var data = inputData.value;
		
		if (data.length == 2 || data.length == 5){
			data += '/';
			inputData.value = data;
		}
	}
	else if(tecla == 8 || tecla == 0) // Backspace, Delete e setas direcionais(para mover o cursor, apenas para FF)
		return true;
	else
		return false;
}
