 <?php
 include("../database_connection.php");
$category = array();
$category['name'] = 'Folio Year';

$from = $_GET['from'];
$to = $_GET['to'];

$series1 = array();
$series1['name'] = 'Avg Loading Time<br>From: '.$from.' To '.$to;

$query = $mysqli->query("select folio_yr,load_start_time,load_stop_time from TransHeader where (folio_yr BETWEEN $from AND $to) group by folio_yr");
while($r = mysqli_fetch_array($query)) {
    
	$load_start_time = $r['load_start_time'];
	$load_stop_time = $r['load_stop_time'];
	
	$load_start_time1 = substr($load_start_time, 0, 2);
	$load_start_time2 = substr($load_start_time, 2, 4);
	
	$load_stop_time1 = substr($load_stop_time, 0, 2);
	$load_stop_time2 = substr($load_stop_time, 2, 4);
	
	$time1 = abs($load_stop_time1).":".(abs($load_stop_time2));
	$time2 = abs($load_start_time1).":".(abs($load_start_time2));
	$time = ( strtotime($time1) - strtotime($time2) ) / 60;
	//echo "<br>";
	$series1['data'][] = abs($time);
	$category['data'][] = $r['folio_yr'];
}
$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);
?> 

