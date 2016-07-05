<?php
require_once('../../../user/classes/class.conexao.php');
require_once('../../../user/classes/class.evento.php');
$evento = new Evento();
$evento->find_evento_aberto();
//$evento->find_by_codigo(1);
$action = $_REQUEST['action'];

$conexao = new Conexao();

if(!isset($_REQUEST['action']))
{
	$sql= "SELECT id, titulo, resumo, 
			DATE_FORMAT(start, '%Y-%m-%dT%H:%i' ) AS startTime, DATE_FORMAT(end, '%Y-%m-%dT%H:%i' ) AS endTime, color, instituicao, autor, chamada, local
		   FROM Calendar
		WHERE codigo_evento = ".$evento->get_codigo_evento()."	
		   ORDER BY start DESC, aux";
	
	$result = $conexao->db_query($sql);

	if (!$result) {
		echo "DB Error, could not query the database\n";
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}

	$events = array();

	while ($row = mysql_fetch_assoc($result)) {
	   $eventArray['id'] = $row['id'];
	   $eventArray['color'] =  $row['color'];
	   $eventArray['titulo'] =  $row['titulo'];
	   $eventArray['resumo'] =  $row['resumo'];
	   $eventArray['start'] = $row['startTime'];
	   $eventArray['end'] = $row['endTime'];
	   $eventArray['instituicao'] = $row['instituicao'];
	   $eventArray['autor'] = $row['autor'];
	   $eventArray['chamada'] = $row['chamada'];
	   $eventArray['local'] = $row['local'];
	   $events[] = $eventArray;
	}

	echo json_encode($events);
}
else if($action == 'save')
{

	$titulo = $_REQUEST['titulo'];
	$resumo = $_REQUEST['resumo'];
	$color = $_REQUEST['color'];
	$start_time = (int)$_REQUEST['start'];
	$start_time = $start_time;// -3600*3;
	$end_time = (int)$_REQUEST['end'];
	$end_time = $end_time;// -3600*3;
	$start = date('c',$start_time);
	$end = date('c',$end_time);
	
	$instituicao = $_REQUEST['instituicao'];
	$autor = $_REQUEST['autor'];
	$chamada = $_REQUEST['chamada'];
	$local = $_REQUEST['local'];
	
	
	
	$sql = "INSERT INTO Calendar(codigo_evento,titulo,resumo,start,end, color, instituicao, autor, chamada, local) VALUES (".$evento->get_codigo_evento().",'$titulo','$resumo','$start','$end', '$color', '$instituicao', '$autor', '$chamada', '$local')";
	$result = $conexao->db_query($sql);
}
else if($action == 'delete')
{

	$id = $_REQUEST['id'];
	$sql = "DELETE FROM Calendar WHERE id=$id";
	
	
	$result = $conexao->db_query($sql);
}
else if($action == 'update')
{

	$id = $_REQUEST['id'];
	$titulo = $_REQUEST['titulo'];
	$resumo = $_REQUEST['resumo'];
	$color = $_REQUEST['color'];
	$start_time = (int)$_REQUEST['start'];
	$start_time = $start_time;//  -3600*3;
	$end_time = (int)$_REQUEST['end'];
	$end_time = $end_time;// -3600*3;
	$start = date('c',$start_time);
	$end = date('c',$end_time);
	
	$instituicao = $_REQUEST['instituicao'];
	$autor = $_REQUEST['autor'];
	$chamada = $_REQUEST['chamada'];
	$local = $_REQUEST['local'];
	
	$sql = "UPDATE Calendar SET titulo = '$titulo', resumo = '$resumo', start = '$start', end = '$end', color = '$color', instituicao = '$instituicao', autor = '$autor', chamada = '$chamada', local = '$local' WHERE id = $id";
	
	$result = $conexao->db_query($sql);
}

?>
