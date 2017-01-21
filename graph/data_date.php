	<?php

	include("../database_connection.php");

$category = array();
$category['name'] = 'Folio Date';
$month = date('m');
$year = date('Y');

 $from = $_GET['from'];
 $to = $_GET['to'];

	$query = $mysqli->query("select distinct folio_no,count(truck) from TransHeader where (folio_no BETWEEN 0$from AND 0$to) AND (folio_mo = $month) AND (folio_yr = $year) group by folio_no");
	
	
	//echo "select distinct folio_no,count(truck) from TransHeader where (folio_no BETWEEN 0$from AND 0$to) AND (folio_mo = $month) AND (folio_yr = $year) group by folio_no";
$series1 = array();
$series1['name'] = 'No. of Trucks<br>From: '.$from.'-'.$month.'-'.$year.'<br> To '.$to.'-'.$month.'-'.$year;

while($r = mysqli_fetch_array($query)) {
    $category['data'][] = $r['folio_no'];
    $series1['data'][] = $r['count(truck)'];
}

$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);

?> 
