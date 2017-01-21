 <?php
 include("../database_connection.php");
$category = array();

	$m= date("m");
	$de= date("d");
	$y= date("Y");
FUNCTION getTimeDiff($atime,$dtime){
			 
			 $nextDay=$dtime>$atime?1:0;
			 $dep=EXPLODE(':',$dtime);
			 $arr=EXPLODE(':',$atime);
			 $diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))-MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j')+$nextDay,DATE('y')));
			 $hours=FLOOR($diff/(60*60));
			 $mins=FLOOR(($diff-($hours*60*60))/(60));
			 $secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
			 IF(STRLEN($hours)<2){$hours="0".$hours;}
			 IF(STRLEN($mins)<2){$mins="0".$mins;}
			 IF(STRLEN($secs)<2){$secs="0".$secs;}
			 RETURN $mins;
	}
		
$category['name'] = 'Folio Date';

$query1 ="(select folio_no,load_start_time,load_stop_time from TransHeader where folio_yr ="; 
$query5="";
for($i=0; $i<20; $i++){;
$newdate = date('d',mktime(0,0,0,$m,($de-$i),$y));              
		$newmonth = date('m',mktime(0,0,0,$m,($de-$i),$y));
		$newyear = date('Y',mktime(0,0,0,$m, ($de-$i),$y));
		//$array = array(
		//$newdate => $newmonth
	//);
	//echo $newdate;
	$info[$i] = $newdate;
	$info2[$i] = $newmonth;
	$info3[$i] = $newyear;

	$query3 = "'".$info3[$i]."' AND folio_mo ='".$info2[$i]."' AND folio_no = '0".$info[$i]."'"; 
	$query6=") UNION ";
	
	if($i < 19)
		$query4 = $query3.$query6;
	else
		$query4 = $query3.")";
		$query5 = $query5.$query1.$query4; 
	}
//echo $query5;

$query_final = $mysqli->query($query5);
//print_r($query_final);
$series1 = array();
$series1['name'] = 'Avg Loading Time per Day';

$count = 0;
$preFol = "";
$curFol = "";
$sum =0;
$no = 0;


while($r = mysqli_fetch_array($query_final)) {
	$curFol = $r['folio_no'];
	/*if($no == 0){
		//echo "hi";
		$preFol = $curFol;
		$category['data'][]= $r['folio_no'];
	}
	$no++;*/
	if(strcmp($curFol,$preFol) !== 0 && $preFol !== "")
	{
		
		if($count !== 0){
			//echo $no."-";
			$avg = round(($sum)/($count));
			//echo $r['folio_no'];
			$category['data'][]= $preFol;
			$series1['data'][] = $avg;
			
		}
			$sum =0;
			$count = 0;
		
	}
	$count++;
	
	
	$load_start_time = $r['load_start_time'];
	$load_stop_time = $r['load_stop_time'];
	
	$load_start_time1 = substr($load_start_time, 0, 2);
	$load_start_time2 = substr($load_start_time, 2, 4);
	
	$load_stop_time1 = substr($load_stop_time, 0, 2);
	$load_stop_time2 = substr($load_stop_time, 2, 4);
	
	$time1 = abs($load_stop_time1).":".(abs($load_stop_time2));
	$time2 = abs($load_start_time1).":".(abs($load_start_time2));
	
	$dtime  = date("g:i", strtotime($time1));
	$atime = date("g:i", strtotime($time2));

	$min = getTimeDiff($dtime,$atime);
	$sum = $sum + ($min) ;
	//$avg = ($sum)/($count);
	$preFol = $curFol;	
	
}

$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);
?> 

