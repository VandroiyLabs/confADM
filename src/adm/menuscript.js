// Função para registrar um novo cookie
function GerarCookie(strCookie, strValor, lngDias)
{
    var dtmData = new Date();

    if(lngDias)
    {
        dtmData.setTime(dtmData.getTime() + (lngDias * 24 * 60 * 60 * 1000));
        var strExpires = "; expires=" + dtmData.toGMTString();
    }
    else
    {
        var strExpires = "";
    }
    document.cookie = strCookie + "=" + strValor + strExpires + "; path=/";
}

// Função para ler o cookie.
function LerCookie(strCookie)
{
    var strNomeIgual = strCookie + "=";
    var arrCookies = document.cookie.split(';');

    for(var i = 0; i < arrCookies.length; i++)
    {
        var strValorCookie = arrCookies[i];
        while(strValorCookie.charAt(0) == ' ')
        {
            strValorCookie = strValorCookie.substring(1, strValorCookie.length);
        }
        if(strValorCookie.indexOf(strNomeIgual) == 0)
        {
            return strValorCookie.substring(strNomeIgual.length, strValorCookie.length);
        }
    }
    return null;
}

// Função para excluir o cookie desejado.
function ExcluirCookie(strCookie)
{
    GerarCookie(strCookie, '', -1);
}


function menuhide(index, obj)
{
	
	if ( document.getElementById('menuitem' + index + 0).style.display == "none" )
	{
		toset = "inline";
	}
	else
	{
		toset = "none";
	}
	
	var status = LerCookie('menuitem' + index);
	if ( status != null && status != "" )
	{
		ExcluirCookie('menuitem' + index);
		GerarCookie('menuitem' + index, toset, 0);
	}
	else 
	{
		GerarCookie('menuitem' + index, toset, 0);
	}
	
	for ( j=0; j < 20; j++ )
	{
		if ( document.getElementById('menuitem' + index + j) )
		{
			document.getElementById('menuitem' + index + j).style.display = toset;
		}
	}
}

function menucookiesHandler()
{
	for (index = 1; index <= 6; index++)
	{
		var status = LerCookie('menuitem' + index);
		
		if ( status != null && status != "" )
		{
			for ( j=0; j < 20; j++ )
			{
				if ( document.getElementById('menuitem' + index + j) )
				{
					document.getElementById('menuitem' + index + j).style.display = status;
				}
			}
		}
		else 
		{
			for ( j=0; j < 20; j++ )
			{
				if ( document.getElementById('menuitem' + index + j) )
				{
					document.getElementById('menuitem' + index + j).style.display = 'inline';
				}
			}
		}
	}
}


