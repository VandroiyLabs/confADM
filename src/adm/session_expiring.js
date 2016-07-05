var time = 20*60; // 20*60;

function startCount2ExpireSession()
{
	setInterval( function(){ SessionTimer() }, 1000);
}


function SessionTimer()
{
	
	mtime = Math.floor( time/60 );
	stime = time - mtime*60;
	
	document.getElementById("session_counter_timemin").innerHTML = ( mtime < 10 ? '0' : '') + mtime;
	document.getElementById("session_counter_times").innerHTML = ( stime < 10 ? '0' : '') + stime;
	time--;
	
	if ( time <= 0 )
	{
		location.reload(true);
	}
}

function showExpireSessionAlert()
{
	document.getElementById('session_counter_aviso').style.display = 'inline';
}

function hideExpireSessionAlert()
{
	document.getElementById('session_counter_aviso').style.display = 'none';
}
