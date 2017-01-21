<?php
include("../database_connection.php");
$from = $_GET['from'];
$to = $_GET['to'];

$query = $mysqli->query("select distinct folio_yr,count(truck) from TransHeader where folio_yr  BETWEEN $from AND $to group by folio_yr");

//echo "select distinct folio_yr,count(truck) from TransHeader where folio_yr  BETWEEN $from AND $to group by folio_yr";
$category = array();
$category['name'] = 'Folio Year';

$series1 = array();
$series1['name'] = 'No. of Trucks<br>From: '.$from.' To '.$to;

while($r = mysqli_fetch_array($query)) {
    $category['data'][] = $r['folio_yr'];
    $series1['data'][] = $r['count(truck)'];
}

$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);

?> 
