function valid_avalia_resumo_form()
{
	if ( !VerificaValor(document.avalia_resumo_form.Q1i.value,document.avalia_resumo_form.Q1d.value) )
	{ 
		document.avalia_resumo_form.Q1i.style.border='2px solid red';
		document.avalia_resumo_form.Q1d.style.border='2px solid red';
		return false;
	}
	
	if ( !VerificaValor(document.avalia_resumo_form.Q2i.value,document.avalia_resumo_form.Q2d.value) )
	{ 
		document.avalia_resumo_form.Q2i.style.border='2px solid red';
		document.avalia_resumo_form.Q2d.style.border='2px solid red';
		return false;
	}

	if ( !VerificaValor(document.avalia_resumo_form.Q3i.value,document.avalia_resumo_form.Q3d.value) )
	{ 
		document.avalia_resumo_form.Q3i.style.border='2px solid red';
		document.avalia_resumo_form.Q3d.style.border='2px solid red';
		return false;
	}


	document.avalia_resumo_form.submit();
};

function valid_avalia_resumo_form_5quesitos()
{
	if ( !VerificaValor(document.avalia_resumo_form.Q1i.value,document.avalia_resumo_form.Q1d.value) )
	{ 
		document.avalia_resumo_form.Q1i.style.border='2px solid red';
		document.avalia_resumo_form.Q1d.style.border='2px solid red';
		return false;
	}
	
	if ( !VerificaValor(document.avalia_resumo_form.Q2i.value,document.avalia_resumo_form.Q2d.value) )
	{ 
		document.avalia_resumo_form.Q2i.style.border='2px solid red';
		document.avalia_resumo_form.Q2d.style.border='2px solid red';
		return false;
	}

	if ( !VerificaValor(document.avalia_resumo_form.Q3i.value,document.avalia_resumo_form.Q3d.value) )
	{ 
		document.avalia_resumo_form.Q3i.style.border='2px solid red';
		document.avalia_resumo_form.Q3d.style.border='2px solid red';
		return false;
	}

	if ( !VerificaValor(document.avalia_resumo_form.Q4i.value,document.avalia_resumo_form.Q4d.value) )
	{ 
		document.avalia_resumo_form.Q4i.style.border='2px solid red';
		document.avalia_resumo_form.Q4d.style.border='2px solid red';
		return false;
	}

	if ( !VerificaValor(document.avalia_resumo_form.Q5i.value,document.avalia_resumo_form.Q5d.value) )
	{ 
		document.avalia_resumo_form.Q5i.style.border='2px solid red';
		document.avalia_resumo_form.Q5d.style.border='2px solid red';
		return false;
	}
	
	

	document.avalia_resumo_form.submit();
};

function VerificaValor(i,d)
{
	
	var stri = i.replace(" ","");
	var strd = d.replace("","0");
		 strd = strd.replace(" ","0");
	

	var digito = /^\d+$/;
	
	if ( !digito.test( stri ) || !digito.test( strd ) )
	{ 
		alert('Valor inválido.')
		return false;
	}
	else if(stri > 10 || (stri == 10 && strd > 0))
	{
		alert('Valor máximo deve ser 10.')
		return false;
	}
	
	return true;
};


function valid_submit_form()
{
	document.submit_form.submit();
};

function valid_submit_question_form()
{
	document.submit_question_form.submit();
};
