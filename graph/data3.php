<?php
	include("../database_connection.php");
	
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
	
	$m= date("m");
	$de= date("d");
	$y= date("Y");
	
$category = array();
$category['name'] = 'Folio Date';

$query1 = "(select folio_no, exit_time, entry_time, load_start_time, load_stop_time from TransHeader  where folio_yr ="; 
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
	//print_r ($info[$i]);
	$info2[$i] = $newmonth;
	$info3[$i] = $newyear;

	$query3 = "'".$info3[$i]."' AND folio_mo ='".$info2[$i]."' AND folio_no ='0".$info[$i]."'"; 
	$query6=") UNION ";
	
	if($i < 19)
		$query4 = $query3.$query6;
	else
		$query4 = $query3.")";
		$query5 = $query5.$query1.$query4; 
	}
//echo $query5;

$query_final = $mysqli->query($query5);

$series1 = array();
$series1['name'] = 'Avg G2G per Day';

$count = 0;
$preFol = "";
$curFol = "";
$sum =0;
$no = 0;
while($r = mysqli_fetch_array($query_final)) {

	$curFol = $r['folio_no']; 
	//echo "curfol->".$curFol;
	//echo "prevfol->".$preFol;
	//$cmpRes = strcmp($curFol,$preFol);
	//echo $cmpRes."<-cmpRes";
	/*if($no == 0){
		$preFol = $curFol;
			$category['data'][]= $r['folio_no'];
	}
	$no++;*/
	if(strcmp($curFol,$preFol) !== 0 && $preFol !== "")
	{
		
		if($count !== 0){
			//echo "hiii";
			$avg = round(($sum)/($count));
			//echo $r['folio_no'];
			$category['data'][]= $preFol;
			$series1['data'][] = $avg;
			
		}
			$sum =0;
			$count = 0;
		
	}
	$count++;
		
	$exit_time = $r['exit_time'];
	$entry_time = $r['entry_time'];
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
			
			$dtime  = date("g:i", strtotime($time1));
			$atime = date("g:i", strtotime($time2));

			
			$min = getTimeDiff($dtime,$atime);
			//echo $sum;
			$sum = $sum + ($min) ;
			//$avg = ($sum)/($count);
			//$series1['data'][] = $avg;
	}

	else
	{
			$time1 = abs($exit_time1).":".(abs($exit_time2));
			$time2 = abs($entry_time1).":".(abs($entry_time2));
			
			$dtime  = date("g:i", strtotime($time1));
			$atime = date("g:i", strtotime($time2));

			
			$min = getTimeDiff($dtime,$atime);
			$sum = $sum + ($min) ;
			//$avg = ($sum)/($count);
			//$series1['data'][] = $avg;
	}
	
	//echo $curFol.":-->".$time."---";
	
	
	$preFol = $curFol;
	//$count++;
	
}

//echo $preFol."::-->".$count;
//echo $sum."<-total";
//echo $count."count";

$result = array();
array_push($result,$category);
array_push($result,$series1);	

print json_encode($result, JSON_NUMERIC_CHECK);


//print_r($result);

?> 

 
