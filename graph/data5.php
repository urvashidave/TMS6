<?php        
        include("../database_connection.php");

	$m= date("m");
	$de= date("d");
	$y= date("Y");

$customer = $_GET['short_cname'];
$splitter = "-";
$pieces = explode($splitter, $customer);
$cust_no = $pieces[0];
//$cust_name = $pieces[1];

$supp_name = $_GET['supp_name'];
$splitter2 = "-";
$pieces2 = explode($splitter2, $supp_name);
$supp_no = $pieces2[0];
//$supp_name = $pieces2[1];


$category = array();
$category['name'] = 'Folio Date';

	for($i=1; $i<=16; $i++){
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
	//echo $info2[$i]."<br>";

}
 

$query1 = "select folio_no,count(cust_no) from TransHeader where cust_no = $cust_no AND supplier_no = $supp_no AND folio_yr=";
$query2 = " group by folio_no"; 
$query5="";
for($i=1; $i<16; $i++){
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
	$query6=" UNION ";
	
	
	if($i < 15)
		$query4 = $query6;
	else
		$query4 = "";
		
  $query5 = $query5.$query1.$query3.$query2.$query4;
// echo $query5;

}
//echo $query5;

$query_final = $mysqli->query($query5);
$series1 = array();
$series1['name'] = 'No. of Customer per Day';

while($r = mysqli_fetch_array($query_final)) {
	  $category['data'][] = $r['folio_no'];
	  $series1['data'][] = $r['count(cust_no)'];
    //$series1['data'][] = $r['count(truck)'];
}

$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);

?> 
