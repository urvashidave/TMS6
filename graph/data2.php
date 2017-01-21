<?php
	include("../database_connection.php");

	$m= date("m");
	$de= date("d");
	$y= date("Y");

$category = array();
$category['name'] = 'Folio Date';
		

	for($i=0; $i<20; $i++){
		$newdate = date('d',mktime(0,0,0,$m,($de-$i),$y));              
		$newmonth = date('m',mktime(0,0,0,$m,($de-$i),$y));
		$array = array(
		$newdate => $newmonth
	);
//var_dump($array);

	//echo $newdate."<br>";
	$info[$i] = $newdate;
	//echo $info[$i]."<br>";
	$info2[$i] = $newmonth;
	//echo $info2[$i]."<br>";*/ss-c*******************************************************************************************

}


/*$query1 = "(select distinct th.folio_no,(select count(sqt.folio_no) from (select folio_no, truck from TransHeader where folio_yr=";
$query2 = " group by folio_no, carrier, truck, trailer1, trailer2) sqt) as 'No Of Trucks' from TransHeader th where th.folio_yr ="; 
$query5="";*/



$query5="";
$query1 = "(select folio_no , count(folio_no) from TransHeader where folio_yr=";
//$query2 = "group by folio_no,trans_id)sqt) as 'No Of Transaction' from TransHeader th where th.folio_yr=";


/* " as 'No Of Transaction' from  TransHeader where folio_yr =";
*/
for($i=0; $i<20; $i++){
		$newdate = date('d',mktime(0,0,0,$m,($de-$i),$y));              
		$newmonth = date('m',mktime(0,0,0,$m,($de-$i),$y));
		$newyear = date('Y',mktime(0,0,0,$m, ($de-$i),$y));
		$array = array(
		$newdate => $newmonth
	);
	$info[$i] = $newdate;
	$info2[$i] = $newmonth;
	$info3[$i] = $newyear;

	$query3 = "'".$info3[$i]."' AND folio_mo ='".$info2[$i]."' AND folio_no = '0".$info[$i]."'"; 
    
	$query6=") UNION ";
	if($i <19 )
		$query4 = $query6;
	else
		$query4 = ")";
	$query5 = $query5.$query1.$query3.$query4;            
}
//echo $query5;

$query_final = $mysqli->query($query5);
$series1 = array();
$series1['name'] = 'No. of Transaction per Day';

while($r = mysqli_fetch_array($query_final)) {
	  $category['data'][] = $r['folio_no'];
	  $series1['data'][] = $r['count(folio_no)'];
    //$series1['data'][] = $r['count(truck)'];
}
$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);

?> 
