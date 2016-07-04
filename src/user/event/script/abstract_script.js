function valid_form_abstract()
{	
	/* Checando casos da biblioteca */
	var key = 0;
	higherWrongRef = 3;
	
	for ( var refid = 1; refid <= 3; refid++ )
	{
		var TipoRef = document.getElementById("tipo_ref"+refid);
		TipoRef_id = TipoRef.value;
		var campos = document.getElementsByClassName("bib_obrigatorio_"+TipoRef_id+refid);
		for(var j = 0; j < campos.length; j++)
		{
			if ( campos.item(j).value == "" )
			{
				campos.item(j).style.border = "1px solid #F00";
				campos.item(j).style.background = "#FEE";
				key = 1;
				higherWrongRef =  Math.min(higherWrongRef, refid); 
			}
		}
	}
	
	if ( key == 1 )
	{
		window.location.hash = '#toporeferencias'+higherWrongRef;
		return false;
	}
	
	if(document.abstract_form.termos.checked == false)
	{
		document.getElementById("termos").style.display='inline';
		return false;
	}
	
	
	document.abstract_form.submit();
};





/* 
 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
 * 

	Função que adiciona os campos de referencias;
	
	@thmosqueiro
	Testada em 23/06/2015
	
*/




/* 

	Função que adiciona os campos;
	
	@thmosqueiro
	Testada em 23/06/2012
	
*/
function resetAuthorsFields() 
{
	// Zerando mudanças no css possivelmente feitas anteriormente
	document.getElementById('aviso_menos_autores').style.visibility = 'hidden';
	document.getElementById('aviso_letrasnao').style.visibility = 'hidden';


	// Quantos autores o usuario quer?
	var N_authors_new = document.getElementById('NumAuthors').value;
	
	// Quantos tinha até o momento?
	var N_authors = document.getElementById('nauthors_hidden').value;
	
	// Verifica se o usuario tah trollando a nossa cara
	if ( ! is_int(N_authors_new) )
	{
		document.getElementById('NumAuthors').value = N_authors;
		document.getElementById('aviso_letrasnao').style.visibility = 'visible';
		return;
	}
	
	if ( N_authors_new > 50 )
	{
		N_authors_new = 50;
		document.getElementById('NumAuthors').value = 50;
	}
	
	// Recuperando os valores autais de cada campo
	// Array onde vamos salva-los
	var Authors_name = new Array();
	var Institut_name = new Array();
	var Authors_ids = new Array();
	
	// Conta o numero de campos nao nulos no momento da deleção
	var nao_nulos = 0;
	
	var camposTexto = document.getElementById('camposTexto');
	var authors2delete = document.getElementById('authors2delete_hidden');
	
	// Carregando de volta
	for ( j = 0; j < N_authors; j++ )
	{
		var authorname = document.getElementById('autor' + j).value;
		var authorid = document.getElementById('author_id' + j).value;

		if ( authorname != null && authorname != '' && authorname != "" )
		{
			Authors_name[nao_nulos] = authorname;
			Institut_name[nao_nulos] = document.getElementById('instituicao' + j).value;
			Authors_ids[nao_nulos] = authorid;
			
			// Incrementa a contagem de nao_nulos;
			nao_nulos++;
		}
		else if ( authorid != '0' )
		{
			authors2delete.value = authors2delete.value + authorid + ';';
		}
		
		camposTexto.removeChild( document.getElementById('autor' + j) );
		camposTexto.removeChild( document.getElementById('instituicao' + j) );
		camposTexto.removeChild( document.getElementById('author_id' + j) );
		camposTexto.removeChild( document.getElementById('autorprincipal' + j) );
		camposTexto.removeChild( document.getElementById('br1' + j) );
		camposTexto.removeChild( document.getElementById('br2' + j) );
		camposTexto.removeChild( document.getElementById('br3' + j) );
		camposTexto.removeChild( document.getElementById('br4' + j) );
		camposTexto.removeChild( document.getElementById('p1_' + j) );
		camposTexto.removeChild( document.getElementById('p2_' + j) );
		camposTexto.removeChild( document.getElementById('p3_' + j) );
	}
	
	// Numero de campos novos
	var delta = N_authors_new - nao_nulos;
	
	// Adicionando campos.
	for ( j = 0; j < nao_nulos; j++ )
	{
		var author = document.createElement('input');
		author.setAttribute('type', 'hidden');
		author.setAttribute('value', Authors_ids[j]);
		author.setAttribute('name', 'author_id' + j);
		author.setAttribute('id', 'author_id' + j);
		document.getElementById('camposTexto').appendChild(author);
		
		var oNewP = document.createElement("span");
		oNewP.setAttribute('id', 'p1_' + j);
		var oText = document.createTextNode("Autor: ");
		oNewP.appendChild(oText);
		document.getElementById('camposTexto').appendChild(oNewP);
		
		var author = document.createElement('input');
		author.setAttribute('type', 'text');
		author.setAttribute('value', Authors_name[j]);
		author.setAttribute('size', '34');
		author.setAttribute('id', 'autor' + j);
		author.setAttribute('name', 'autor' + j);
		document.getElementById('camposTexto').appendChild(author);

		var br = document.createElement('br');
		br.setAttribute('id', 'br1' + j);
		document.getElementById('camposTexto').appendChild( br );
		
		var oNewP = document.createElement("span");
		oNewP.setAttribute('id', 'p2_' + j);
		var oText = document.createTextNode("Instituição: ");
		oNewP.appendChild(oText);
		document.getElementById('camposTexto').appendChild(oNewP);
		
		var instit = document.createElement('input');
		instit.setAttribute('type', 'text');
		instit.setAttribute('value', Institut_name[j]);
		instit.setAttribute('size', '30');
		instit.setAttribute('id', 'instituicao' + j);
		instit.setAttribute('name', 'instituicao' + j);
		document.getElementById('camposTexto').appendChild(instit);

		var br = document.createElement('br');
		br.setAttribute('id', 'br2' + j);
		document.getElementById('camposTexto').appendChild( br );
		
		var oNewP = document.createElement("span");
		oNewP.setAttribute('id', 'p3_' + j);
		var oText = document.createTextNode("Autor principal?  ");
		oNewP.appendChild(oText);
		document.getElementById('camposTexto').appendChild(oNewP);
		
		var autprinc = document.createElement('input');
		autprinc.setAttribute('type', 'radio');
		autprinc.setAttribute('value', j + 1);
		autprinc.setAttribute('size', '30');
		autprinc.setAttribute('id', 'autorprincipal' + j);
		autprinc.setAttribute('name', 'autorprincipal');
		document.getElementById('camposTexto').appendChild(autprinc);
		
		var br = document.createElement('br');
		br.setAttribute('id', 'br3' + j);
		document.getElementById('camposTexto').appendChild( br );

		var br = document.createElement('br');
		br.setAttribute('id', 'br4' + j);
		document.getElementById('camposTexto').appendChild( br );
		
	}
	
	if ( delta >= 0 )
	{
		// Adicionando campos.
		for ( j = nao_nulos; j < N_authors_new; j++ )
		{
			var author = document.createElement('input');
			author.setAttribute('type', 'hidden');
			author.setAttribute('value', '0');
			author.setAttribute('name', 'author_id' + j);
			author.setAttribute('id', 'author_id' + j);
			document.getElementById('camposTexto').appendChild(author);
			
			var oNewP = document.createElement("span");
			oNewP.setAttribute('id', 'p1_' + j);
			var oText = document.createTextNode("Autor: ");
			oNewP.appendChild(oText);
			document.getElementById('camposTexto').appendChild(oNewP);
			
			var author = document.createElement('input');
			author.setAttribute('type', 'text');
			author.setAttribute('value', '');
			author.setAttribute('size', '34');
			author.setAttribute('id', 'autor' + j);
			author.setAttribute('name', 'autor' + j);
			document.getElementById('camposTexto').appendChild(author);
			
			var br = document.createElement('br');
			br.setAttribute('id', 'br1' + j);
			document.getElementById('camposTexto').appendChild( br );

			var oNewP = document.createElement("span");
			oNewP.setAttribute('id', 'p2_' + j);
			var oText = document.createTextNode("Instituição: ");
			oNewP.appendChild(oText);
			document.getElementById('camposTexto').appendChild(oNewP);
			
			var instit = document.createElement('input');
			instit.setAttribute('type', 'text');
			instit.setAttribute('value', '');
			instit.setAttribute('size', '30');
			instit.setAttribute('id', 'instituicao' + j);
			instit.setAttribute('name', 'instituicao' + j);
			document.getElementById('camposTexto').appendChild(instit);
			
			var br = document.createElement('br');
			br.setAttribute('id', 'br2' + j);
			document.getElementById('camposTexto').appendChild( br );
			
			var oNewP = document.createElement("span");
			oNewP.setAttribute('id', 'p3_' + j);
			var oText = document.createTextNode("Autor principal?  ");
			oNewP.appendChild(oText);
			document.getElementById('camposTexto').appendChild(oNewP);
			
			var autprinc = document.createElement('input');
			autprinc.setAttribute('type', 'radio');
			autprinc.setAttribute('value', j + 1);
			autprinc.setAttribute('size', '30');
			autprinc.setAttribute('id', 'autorprincipal' + j);
			autprinc.setAttribute('name', 'autorprincipal');
			document.getElementById('camposTexto').appendChild(autprinc);
			
			var br = document.createElement('br');
			br.setAttribute('id', 'br3' + j);
			document.getElementById('camposTexto').appendChild( br );
			
			var br = document.createElement('br');
			br.setAttribute('id', 'br4' + j);
			document.getElementById('camposTexto').appendChild( br );
		}
		
		document.getElementById('nauthors_hidden').value = N_authors_new;		
	}
	else
	{
		// Caso o numero novo de autores (pedido) seja menor do que o
		// numero de autores de fato, então entramos aqui. Neste caso	
		// os valores sao forçados novamente às variáveis.

		document.getElementById('nauthors_hidden').value = nao_nulos;
		document.getElementById('NumAuthors').value = nao_nulos;
		document.getElementById('aviso_menos_autores').style.visibility = 'visible';
	}
	
	// Unsetting arrays
	delete window.Authors_name;
	delete window.Institut_name;
	delete window.Authors_ids;
	
	return;
}




/* 
 * %%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
 * 

	Função que adiciona os campos;
	
	@thmosqueiro
	Testada em 23/06/2012
	
*/
function adicionaautor(todelete) 
{
	
	// Quantos tinha até o momento?
	var N_authors = parseInt( document.getElementById('nauthors_hidden').value );
	
	// Variavel para armazenar o indice do autor principal
	var idx_autor_principal = -1;
	
	// Recuperando os valores autais de cada campo
	// Array onde vamos salva-los
	var Authors_name = new Array();
	var Institut_name = new Array();
	var Authors_ids = new Array();
	
	var camposTexto = document.getElementById('camposTexto');
	var authors2delete = document.getElementById('authors2delete_hidden');
	
	// Contagem dos campos
	jj = 0;
	
	// Carregando de volta
	for ( j = 0; j < N_authors; j++ )
	{
		// Salvando os campos CASO este nao seja um dos campos a serem deletados!
		if ( todelete != j )
		{
			if ( document.getElementById('autorprincipal' + j).checked )
			{
				idx_autor_principal = jj;
			}
			
			var authorname = document.getElementById('autor' + j).value;
			var authorid = document.getElementById('author_id' + j).value;
			
			Authors_name[jj] = authorname;
			Institut_name[jj] = document.getElementById('instituicao' + j).value;
			Authors_ids[jj] = authorid;
			
			// Mais um autor salvo
			jj++;
		}
		else
		{
			// Adicionando o autor removido para a lista de autores a serem removidos do banco de dados
			document.getElementById('list_authors_delete').value += document.getElementById('author_id' + j).value + ';'; 
		}
		
		// Deletando os campos		
		camposTexto.removeChild( document.getElementById('autor' + j) );
		camposTexto.removeChild( document.getElementById('instituicao' + j) );
		camposTexto.removeChild( document.getElementById('author_id' + j) );
		camposTexto.removeChild( document.getElementById('autorprincipal' + j) );
		camposTexto.removeChild( document.getElementById('delete_button' + j) );
		camposTexto.removeChild( document.getElementById('br1' + j) );
		camposTexto.removeChild( document.getElementById('br2' + j) );
		camposTexto.removeChild( document.getElementById('br3' + j) );
		camposTexto.removeChild( document.getElementById('br4' + j) );
		camposTexto.removeChild( document.getElementById('p1_' + j) );
		camposTexto.removeChild( document.getElementById('p2_' + j) );
		camposTexto.removeChild( document.getElementById('p3_' + j) );
	}
	
	
	// Contagem correta dos autores
	if ( todelete > -1 )
	{
		var N_authors_after = N_authors - 1;
	}
	else
	{
		var N_authors_after = N_authors;
	}
	
	// Adicionando campos.
	for ( j = 0; j < N_authors_after; j++ )
	{
		var author = document.createElement('input');
		author.setAttribute('type', 'hidden');
		author.setAttribute('value', Authors_ids[j]);
		author.setAttribute('name', 'author_id' + j);
		author.setAttribute('id', 'author_id' + j);
		document.getElementById('camposTexto').appendChild(author);
		
		var oNewP = document.createElement("span");
		oNewP.setAttribute('id', 'p1_' + j);
		var oText = document.createTextNode("Autor " + (j + 1) + ": ");
		oNewP.appendChild(oText);
		document.getElementById('camposTexto').appendChild(oNewP);
		
		var author = document.createElement('input');
		author.setAttribute('type', 'text');
		author.setAttribute('value', Authors_name[j]);
		author.setAttribute('size', '34');
		author.setAttribute('maxlength', '200');
		author.setAttribute('id', 'autor' + j);
		author.setAttribute('name', 'autor' + j);
		document.getElementById('camposTexto').appendChild(author);
		
		// Botão de deleção!!
		var autprinc = document.createElement('input');
		autprinc.setAttribute('type', 'button');
		autprinc.setAttribute('value', ' X ');
		autprinc.setAttribute('id', 'delete_button' + j);
		autprinc.setAttribute('class', 'button_deleteauthor');
		autprinc.setAttribute('name', 'delete_button');
		autprinc.setAttribute('onclick', 'adicionaautor(' + j + ');');
		document.getElementById('camposTexto').appendChild(autprinc);
		
		var br = document.createElement('br');
		br.setAttribute('id', 'br1' + j);
		document.getElementById('camposTexto').appendChild( br );
		
		var oNewP = document.createElement("span");
		oNewP.setAttribute('id', 'p2_' + j);
		var oText = document.createTextNode("Instituição: ");
		oNewP.appendChild(oText);
		document.getElementById('camposTexto').appendChild(oNewP);
		
		var instit = document.createElement('input');
		instit.setAttribute('type', 'text');
		instit.setAttribute('value', Institut_name[j]);
		instit.setAttribute('size', '34');
		author.setAttribute('maxlength', '200');
		instit.setAttribute('id', 'instituicao' + j);
		instit.setAttribute('name', 'instituicao' + j);
		document.getElementById('camposTexto').appendChild(instit);

		var br = document.createElement('br');
		br.setAttribute('id', 'br2' + j);
		document.getElementById('camposTexto').appendChild( br );
		
		var oNewP = document.createElement("span");
		oNewP.setAttribute('id', 'p3_' + j);
		var oText = document.createTextNode("Autor principal?  ");
		oNewP.appendChild(oText);
		document.getElementById('camposTexto').appendChild(oNewP);
		
		var autprinc = document.createElement('input');
		autprinc.setAttribute('type', 'radio');
		autprinc.setAttribute('value', j + 1);
		autprinc.setAttribute('id', 'autorprincipal' + j);
		autprinc.setAttribute('name', 'autorprincipal');
		document.getElementById('camposTexto').appendChild(autprinc);
		
		if ( idx_autor_principal == j )
		{
			document.getElementById('autorprincipal' + j).checked = true;
		}
		
		// Terminando		
		var br = document.createElement('br');
		br.setAttribute('id', 'br3' + j);
		document.getElementById('camposTexto').appendChild( br );

		var br = document.createElement('br');
		br.setAttribute('id', 'br4' + j);
		document.getElementById('camposTexto').appendChild( br );
		
	}
	
	if ( todelete == -1 & N_authors < 50 )
	{
		j = N_authors;
		
		N_authors_after = parseInt( N_authors + 1 );
		
		var author = document.createElement('input');
		author.setAttribute('type', 'hidden');
		author.setAttribute('value', '0');
		author.setAttribute('name', 'author_id' + j);
		author.setAttribute('id', 'author_id' + j);
		document.getElementById('camposTexto').appendChild(author);
		
		var oNewP = document.createElement("span");
		oNewP.setAttribute('id', 'p1_' + j);
		var oText = document.createTextNode("Autor " + (j + 1) + ": ");
		oNewP.appendChild(oText);
		document.getElementById('camposTexto').appendChild(oNewP);
		
		var author = document.createElement('input');
		author.setAttribute('type', 'text');
		author.setAttribute('value', '');
		author.setAttribute('size', '34');
		author.setAttribute('id', 'autor' + j);
		author.setAttribute('name', 'autor' + j);
		document.getElementById('camposTexto').appendChild(author);
		
		// Botão de deleção!!
		var autprinc = document.createElement('input');
		autprinc.setAttribute('type', 'button');
		autprinc.setAttribute('value', ' X ');
		autprinc.setAttribute('id', 'delete_button' + j);
		autprinc.setAttribute('class', 'button_deleteauthor');
		autprinc.setAttribute('name', 'delete_button');
		autprinc.setAttribute('onclick', 'adicionaautor(' + j + ');');
		document.getElementById('camposTexto').appendChild(autprinc);
				
		var br = document.createElement('br');
		br.setAttribute('id', 'br1' + j);
		document.getElementById('camposTexto').appendChild( br );
	
		var oNewP = document.createElement("span");
		oNewP.setAttribute('id', 'p2_' + j);
		var oText = document.createTextNode("Instituição: ");
		oNewP.appendChild(oText);
		document.getElementById('camposTexto').appendChild(oNewP);
		
		var instit = document.createElement('input');
		instit.setAttribute('type', 'text');
		instit.setAttribute('value', '');
		instit.setAttribute('size', '34');
		instit.setAttribute('id', 'instituicao' + j);
		instit.setAttribute('name', 'instituicao' + j);
		document.getElementById('camposTexto').appendChild(instit);
		
		var br = document.createElement('br');
		br.setAttribute('id', 'br2' + j);
		document.getElementById('camposTexto').appendChild( br );
		
		var oNewP = document.createElement("span");
		oNewP.setAttribute('id', 'p3_' + j);
		var oText = document.createTextNode("Autor principal?  ");
		oNewP.appendChild(oText);
		document.getElementById('camposTexto').appendChild(oNewP);
		
		var autprinc = document.createElement('input');
		autprinc.setAttribute('type', 'radio');
		autprinc.setAttribute('value', j + 1);
		autprinc.setAttribute('id', 'autorprincipal' + j);
		autprinc.setAttribute('name', 'autorprincipal');
		document.getElementById('camposTexto').appendChild(autprinc);
		
		var br = document.createElement('br');
		br.setAttribute('id', 'br3' + j);
		document.getElementById('camposTexto').appendChild( br );
		
		var br = document.createElement('br');
		br.setAttribute('id', 'br4' + j);
		document.getElementById('camposTexto').appendChild( br );
	}
	
	// Setando o numero atual de autores!
	document.getElementById('nauthors_hidden').value = N_authors_after;
	
	// Unsetting arrays
	delete window.Authors_name;
	delete window.Institut_name;
	delete window.Authors_ids;
	
	return;
}





function is_int(value)
{
	if((parseFloat(value) == parseInt(value)) && !isNaN(value))
	{
		return true;
	}
	else
	{ 
		return false;
	} 
}




/*
	Script para travar formularios de forma simplificada
*/
function toggleFormElements(bDisabled) 
{
    var inputs = document.getElementsByTagName("input");
    for (var i = 0; i < inputs.length; i++) 
	{
        inputs[i].disabled = true;
    }

    var selects = document.getElementsByTagName("select");
    for (var i = 0; i < selects.length; i++) 
	{
        selects[i].disabled = true;
    }

    var textareas = document.getElementsByTagName("textarea");
    for (var i = 0; i < textareas.length; i++) 
	{
        textareas[i].disabled = true;
    }
    
    var buttons = document.getElementsByTagName("button");
    for (var i = 0; i < buttons.length; i++) 
	{
        buttons[i].disabled = true;
    }

}
