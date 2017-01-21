<?php

    session_start();
    error_reporting(0);

    $transrefno = $_POST['transrefno'];
    
// define some variables
$local_file = "BOL/".$transrefno.".pdf";
$server_file = "/tms6/docs/bol/".$transrefno.".pdf";

// set up basic connection

$conn_id = ftp_connect("184.149.36.41");

// login with username and password
$login_result = ftp_login($conn_id, "tms6", "toptech");
ftp_pasv($conn_id, true);
//echo $login_result;
// try to download $server_file and save to $local_file
if (ftp_get($conn_id, $local_file, $server_file, FTP_BINARY)) {
    echo "$local_file";
} else {
    echo "0";
}

// close the connection
ftp_close($conn_id);

?>