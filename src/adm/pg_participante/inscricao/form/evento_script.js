function disableResumo(){
	document.formulario_summer.titulo_resumo.disabled=true;
	document.formulario_summer.titulo_resumo.class='disabled';
	
   document.formulario_summer.nome_autor1.disabled=true;
   document.formulario_summer.nome_autor2.disabled=true;
   document.formulario_summer.nome_autor3.disabled=true;
   document.formulario_summer.url_resumo.disabled=true;
   document.formulario_summer.situacao_deferimento.disabled=true;   
}
function enableResumo(){
	document.formulario_summer.titulo_resumo.disabled=false;
   document.formulario_summer.nome_autor1.disabled=false;
   document.formulario_summer.nome_autor2.disabled=false;
   document.formulario_summer.nome_autor3.disabled=false;
   document.formulario_summer.url_resumo.disabled=false;
   document.formulario_summer.situacao_deferimento.disabled=false;   
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

function hourMask(inputData, e){

	if(document.all) // Internet Explorer
		var tecla = event.keyCode;
	else //Outros Browsers
		var tecla = e.which;

	if(tecla >= 47 && tecla < 58){ // numeros de 0 a 9 e "/"
		var data = inputData.value;
	if (data.length == 2){
		data += ':';
		inputData.value = data;
	}
	}
	else if(tecla == 8 || tecla == 0) // Backspace, Delete e setas direcionais(para mover o cursor, apenas para FF)
		return true;
	else
		return false;
}
