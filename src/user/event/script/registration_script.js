function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function leech(v){
    v=v.replace(/o/gi,"0")
    v=v.replace(/i/gi,"1")
    v=v.replace(/z/gi,"2")
    v=v.replace(/e/gi,"3")
    v=v.replace(/a/gi,"4")
    v=v.replace(/s/gi,"5")
    v=v.replace(/t/gi,"7")
    return v
}

function soNumeros(v){
    return v.replace(/\D/g,"")
}

function VerificaCPF()
{
cpf= document.formulario.icpf.value.replace(/\D/g,"")

if (vercpf(cpf))
{ return true;}else
{ return false;}
}

function vercpf (cpf)
{if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" || cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf == "99999999999")
return false;
add = 0;
for (i=0; i < 9; i ++)
add += parseInt(cpf.charAt(i)) * (10 - i);
rev = 11 - (add % 11);
if (rev == 10 || rev == 11)
rev = 0;
if (rev != parseInt(cpf.charAt(9)))
return false;
add = 0;
for (i = 0; i < 10; i ++)
add += parseInt(cpf.charAt(i)) * (11 - i);
rev = 11 - (add % 11);
if (rev == 10 || rev == 11)
rev = 0;
if (rev != parseInt(cpf.charAt(10)))
return false;
return true;}


function cpf(v){
    v=v.replace(/\D/g,"")                    //Remove tudo o que não é dígito
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{3})(\d)/,"$1.$2")       //Coloca um ponto entre o terceiro e o quarto dígitos
                                             //de novo (para o segundo bloco de números)
    v=v.replace(/(\d{3})(\d{1,2})$/,"$1-$2") //Coloca um hífen entre o terceiro e o quarto dígitos
    return v
}



function valid_form(){

	document.formulario.page.value='update';

	if(!verifyFields()) return false;

	document.formulario.submit();
};


function valid_fields(){

	if(document.formulario.instituicao[1].checked)
	{
		document.formulario.outrainstituicao.disabled=false;
	}
	else
	{
		document.formulario.outrainstituicao.disabled=true;
	}

	if(document.formulario.nivel[3].checked)
	{
		document.formulario.outronivel.disabled=false;
	}
	else
	{
		document.formulario.outronivel.disabled=true;
	}


	if(document.formulario.instituicao[0].checked && (document.formulario.nivel[0].checked || document.formulario.nivel[1].checked))
	{
		document.formulario.curso[0].disabled=true;
		document.formulario.curso[1].disabled=false;
		document.formulario.curso[2].disabled=false;
		document.formulario.curso[3].disabled=false;
		document.formulario.curso[4].disabled=false;
		document.formulario.curso[5].disabled=true;
		document.formulario.curso[6].disabled=true;
		document.formulario.curso[7].disabled=true;
		document.formulario.curso[8].disabled=true;
		document.formulario.curso[9].disabled=true;
		document.formulario.curso[9].selected=false;
		document.formulario.curso[5].selected=false;
	}
	else if(document.formulario.instituicao[0].checked && document.formulario.nivel[2].checked)
	{
		document.formulario.curso[0].disabled=true;
		document.formulario.curso[1].disabled=true;
		document.formulario.curso[2].disabled=true;
		document.formulario.curso[3].disabled=true;
		document.formulario.curso[4].disabled=true;
		document.formulario.curso[5].disabled=false;
		document.formulario.curso[6].disabled=false;
		document.formulario.curso[7].disabled=false;
		document.formulario.curso[8].disabled=false;
		document.formulario.curso[9].disabled=true;
		document.formulario.curso[9].selected=false;
		document.formulario.curso[1].selected=false;


	}
	else
	{
		document.formulario.curso[0].disabled=true;
		document.formulario.curso[1].disabled=true;
		document.formulario.curso[2].disabled=true;
		document.formulario.curso[3].disabled=true;
		document.formulario.curso[4].disabled=true;
		document.formulario.curso[5].disabled=true;
		document.formulario.curso[6].disabled=true;
		document.formulario.curso[7].disabled=true;
		document.formulario.curso[8].disabled=true;
		document.formulario.curso[9].disabled=false;
		document.formulario.curso[9].selected=true;

	}

	if(document.formulario.curso[9].selected)
	{
		document.formulario.outrocurso.disabled=false;
	}
	else
	{
		document.formulario.outrocurso.disabled=true;
	}
	return true;

};


function verifyFields(){

	var fields = true;

	if (document.formulario.nome.value==""){
		document.formulario.nome.style.border='2px solid red';
		fields = false;
	}
	else
		document.formulario.nome.style.border='';

	if ( VerificaCPF() == false )
	{
		document.formulario.icpf.style.border='2px solid red';
		fields = false;
	}
	else
		document.formulario.icpf.style.border='';


	if (document.formulario.instituicao[0].checked && document.formulario.nusp.value==""){
		document.formulario.nusp.style.border='2px solid red';
		fields = false;
	}
	else
		document.formulario.nusp.style.border='';

	if (document.formulario.nivel[3].checked && document.formulario.outronivel.value==""){
		document.formulario.outronivel.style.border='2px solid red';
		fields = false;
	}
	else
		document.formulario.outronivel.style.border='';

	if (document.formulario.curso[0].selected ){
		document.formulario.curso.style.border='2px solid red';
		fields = false;
	}
	else
		document.formulario.curso.style.border='';


	if (document.formulario.curso[9].selected && document.formulario.outrocurso.value==""){
		document.formulario.outrocurso.style.border='2px solid red';
		fields = false;
	}
	else
		document.formulario.outrocurso.style.border='';



	return fields;
}

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

function valid_form_adm(){

	if(!verifyEmail()) return false;

	if(!verifyPassword()) return false;

	if(!verifyFields()) return false;

	document.formulario.submit();
};
