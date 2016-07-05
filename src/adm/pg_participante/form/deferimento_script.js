
function confirm(){
	document.formulario.submit();
};

function indeferir_direto(){

	if(document.formulario.comentario_direto.value=="")
	{
			document.getElementById('warning_mensagem_direto').style.display= 'inline';
			document.formulario.comentario_direto.style.border='2px solid red';
			return false;
	}
	document.formulario.direto.value='1';
	document.formulario.submit();
};

function indeferir_temp(){

	document.formulario.direto.value='0';

	if (document.formulario.comentario_temp.value=="")
	{
			document.getElementById('warning_mensagem_temp').style.display= 'inline';
			document.formulario.comentario_temp.style.border='2px solid red';
			return false;
	}
	document.formulario.submit();
};


function cancel(){

	location = "http://sifsc.ifsc.usp.br/adm/pg_participante/home.php?p1=showpessoa&cp="+document.formulario.codigo_pessoa.value;
};


