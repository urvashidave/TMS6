
<?php 
include('../database_connection.php');

 $from_mo = $_GET['from'];
 $to_mo = $_GET['to'];
 
 $year = date('Y');

$category = array();
$category['name'] = 'Folio Month';

$series1 = array();
$series1['name'] = 'Avg G2G<br>From: '.$from_mo.'-'.$year.'<br> To '.$to_mo.'-'.$year;

$query = $mysqli->query("select folio_mo,exit_time,entry_time,load_start_time,load_stop_time from TransHeader where (folio_mo BETWEEN $from_mo AND $to_mo) AND (folio_yr = $year) group by folio_mo");
//echo ("select folio_no,exit_time,entry_time,load_start_time,load_stop_time from TransHeader where (folio_mo BETWEEN $from AND $to) AND (folio_yr = $year) group by folio_mo");
//echo "select folio_no,exit_time,entry_time,load_start_time,load_stop_time from TransHeader where folio_no BETWEEN $from AND $to group by folio_no";

while($r = mysqli_fetch_array($query)) {
	//"exit time is -><br>";
	$exit_time = $r['exit_time'];
	//echo "entry time is -><br>";
	$entry_time = $r['entry_time'];
	//echo "load start time is -><br>";
	$load_start_time = $r['load_start_time'];
	$load_stop_time = $r['load_stop_time'];
	
	$exit_time1 = substr($exit_time, 0, 2);
	$exit_time2 = substr($exit_time, 2, 4);
	
	$entry_time1 = substr($entry_time, 0, 2);
	$entry_time2 = substr($entry_time, 2, 4);

	$load_start_time1 = substr($load_start_time, 0, 2);
	$load_start_time2 = substr($load_start_time, 2, 4);
	
	$load_stop_time1 = substr($load_stop_time, 0, 2);
	$load_stop_time2 = substr($load_stop_time, 2, 4);
		
	if(empty($entry_time))
	{
			$time1 = abs($exit_time1).":".(abs($exit_time2));
			$time2 = abs($load_start_time1).":".(abs($load_start_time2));
			$time = ( strtotime($time1) - strtotime($time2) ) / 60;
			//echo "<br>";
			$series1['data'][] = abs($time);
	}
	else
	{
			$time2 = abs($exit_time1).":".(abs($exit_time2));
			$time1 = abs($entry_time1).":".(abs($entry_time2));
			$time = ( strtotime($time1) - strtotime($time2) ) / 60;
			//echo "<br>";
			$series1['data'][] = abs($time);
	}
	$category['data'][]= $r['folio_mo'];
}

$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);


?> 


 
