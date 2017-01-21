<?php 
include('../database_connection.php');

 $from = $_GET['from'];
 $to = $_GET['to'];

$category = array();
$category['name'] = 'Folio Date';
$month = date('m');
$year = date('Y');


$query = $mysqli->query("select folio_no,count(trans_id) from TransHeader where folio_no BETWEEN 0$from AND 0$to AND (folio_mo = $month) AND (folio_yr = $year) group by folio_no");
//echo "select folio_no,count(trans_id) from TransHeader where folio_no BETWEEN 0$from AND 0$to AND (folio_mo = $month) AND (folio_yr = $year) group by folio_no";

$series1 = array();
$series1['name'] = 'No. of Transaction<br>From: '.$from.'-'.$month.'-'.$year.'<br> To '.$to.'-'.$month.'-'.$year;
while($r = mysqli_fetch_array($query)) {
    $category['data'][] = $r['folio_no'];
    $series1['data'][] = $r['count(trans_id)'];
}
$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);
?> 
