<?php

//echo "bcon";
//$dsn = 'mysqli:dbname=Tms6Data;host=192.168.1.40:3306';
//$user = 'tms6';184
//$password = 'toptech';
//try {
//$mysqli = new PDO($dsn, $user, $password);
//} catch (PDOException $e) {
//   echo 'Connection failed: ' . $e->getMessage();
//}
// $mysqli = new mysqli("localhost","root","","Tms6Data");
//$mysqli = new mysqli("stage2.blendtech.com", "ttadmin", "toptech", "Tms6Data");
//$mysqli = new mysqli("192.168.1.16", "ttadmin", "toptech", "Tms6Data");
$mysqli = new mysqli("184.149.36.41", "ttadmin", "toptech", "Tms6Data");
//$mysqli = new mysqli("10.73.1.50","ttadmin","toptech","Tms6Data");

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>

<?php

/* $db_host = "stage.blendtech.com";
  $db_name = "Tms6Data";
  $db_user = "ttadmin";
  $db_pass = "toptech";

  try{

  $db_con = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
  $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
  echo $e->getMessage();
  } */
?>


