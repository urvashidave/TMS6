
	<?php
	session_start();
	include "database_connection.php";
        if (isset($_POST['selCarrier'])){
        $carrier = $_POST['selCarrier'];
        }
        if (isset($_POST['selaccount'])){
        $account =  $_POST['selaccount'];
        }
        if (isset($_POST['seldriver'])){
            $driver = $_POST['seldriver'];
        }
        if (isset($_POST['selmot'])){
        $mot =   $_POST['selmot'];
        }
        
        
        
	if(isset($_POST['supplier_no']))
	{
		$supplier_no = $_POST['supplier_no'];
		//echo $supplier_no;
		echo "<option value=''></option>";
		$query4="SELECT cust_no FROM Customer where supplier_no='$supplier_no'";
		$result4=$mysqli->query($query4);
		while($value4 = mysqli_fetch_array($result4))
		{
			echo "<option value=".$value4['cust_no'].">".$value4['cust_no']."</option>";
		}
	}
	
	if(isset($_POST['cust_no']))
	{
                //echo "hi";
		$cust_no = $_POST['cust_no'];
		echo "<option value=''></option>";
		$query5="SELECT acct_no FROM Account where cust_no='$cust_no'";
		$result5=$mysqli->query($query5);
		while($value5 = mysqli_fetch_array($result5))
		{
			echo "<option>".$value5['acct_no']."</option>";
		}
	}
	
	if(isset($_POST['acct_no']))
	{
		echo "<option value=''></option>";
		$acct_no = $_POST['acct_no'];
		$query6="SELECT destination_no FROM Destination where acct_no='$acct_no'";
		$result6=$mysqli->query($query6);
		while($value6 = mysqli_fetch_array($result6))
		{
			echo "<option>".$value6['destination_no']."</option>";
		}
	}
	
	if(isset($_POST['destination_no']))
	{
		echo "<option value=''></option>";
		$destination_no = $_POST['destination_no'];
	}
	
	if(isset($_POST['carr_no']))
	{
		echo "<option value=''></option>";
		$carr_no = $_POST['carr_no'];
		$query8="SELECT driver_no FROM Driver where carrier_no='$carr_no'";
		$result8=$mysqli->query($query8);
		while($value8 = mysqli_fetch_array($result8))
		{
			echo "<option>".$value8['driver_no']."</option>";
		}
	}
	
	if(isset($_POST['driver_no']))
	{
		echo "<option value=''></option>";
		
	}
	
	//$MOT = $_POST['MOT'];

	