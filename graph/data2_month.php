<?php 
include('../database_connection.php');

$from = $_GET['from'];
$to = $_GET['to'];
 
/*$year1 = explode('-', $from);
$from_yr = $year1[1];

$year2 = explode('-', $to);
$to_yr = $year2[1];*/

$month1 = explode('-', $from);
$from_mo = $month1[0];

$month2 = explode('-', $to);
$to_mo = $month2[0];

$year = date("Y");

$query = $mysqli->query("select folio_mo,count(trans_id) from TransHeader where (folio_mo BETWEEN $from_mo AND $to_mo) AND folio_yr = $year group by folio_mo");

//$query = $mysqli->query("select folio_mo,count(trans_id) from TransHeader where (folio_yr BETWEEN $from_yr AND $to_yr) AND (folio_mo BETWEEN $from_mo AND $to_mo) group by folio_mo");
//echo "select folio_mo,count(trans_id) from TransHeader where (folio_mo BETWEEN $from_mo AND $to_mo) AND folio_yr = $year group by folio_mo";
$category = array();
$category['name'] = 'Folio Month';

$series1 = array();
$series1['name'] = 'No. of Transaction<br>From: '.$from_mo.'-'.$year.'<br> To '.$to_mo.'-'.$year;
while($r = mysqli_fetch_array($query)) {
    $category['data'][] = $r['folio_mo'];
    $series1['data'][] = $r['count(trans_id)'];
}
$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);
?> 
