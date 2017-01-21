<?php

	include("../database_connection.php");

$category = array();
$category['name'] = 'Folio Date';
$month = date('m');
$year = date('Y');

 $from = $_GET['from'];
 $to = $_GET['to'];
 $customer = $_GET['short_cname'];
 

	$splitter = "-";
$pieces = explode($splitter, $customer);

$cust_no = $pieces[0];


	$query = $mysqli->query("select distinct folio_mo,count(cust_no) from TransHeader
	where (cust_no = $cust_no) AND (folio_mo BETWEEN 0$from AND 0$to) AND (folio_yr = $year) group by folio_mo,cust_no");	
	
//	echo "select distinct TransHeader.folio_no,Customer.short_cust_name,count(TransHeader.cust_no) from TransHeader,Customer
//	where (TransHeader.cust_no = $cust_no) AND (folio_no BETWEEN 0$from AND 0$to) AND (folio_mo = $month) AND (folio_yr = $year) group by folio_no,TransHeader.cust_no";
//	
	$series1 = array();
$series1['name'] = 'No. of '.$cust_no.' Customer<br>From: '.$from.'-'.$year.'<br> To '.$to.'-'.$year;
	
	
while($r = mysqli_fetch_array($query)) {
    $category['data'][] = $r['folio_mo'];
    $series1['data'][] = $r['count(cust_no)'];
}

$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);

?> 
