 <?php
 include("../database_connection.php");
$category = array();
$category['name'] = 'Folio Month';

$from_mo = $_GET['from'];
$to_mo = $_GET['to'];
$year = date('Y');

$series1 = array();
$series1['name'] = 'Avg Loading Time<br>From: '.$from_mo.'-'.$year.'<br> To '.$to_mo.'-'.$year;


$query = $mysqli->query("select folio_mo,load_start_time,load_stop_time from TransHeader where (folio_mo BETWEEN $from_mo AND $to_mo) AND (folio_yr = $year) group by folio_mo");
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
	$category['data'][] = $r['folio_mo'];
}
$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);
?> 

