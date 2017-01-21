<?php 
include("database_connection.php");
	session_start();
if(isset($_POST['btnsubmit']))
	{
		//echo $_POST['remember'];
		 if(isset($_POST['remember']))
			{
			  $_SESSION['global'] = "hello";

			}
   
		$username=$_POST['username'];
		echo $username;
		$password=$_POST['password'];
		echo $password;
		$_SESSION['timeout'] = time();
		//echo $_SESSION['timeout'];
		
		
		
	
			$query1="SELECT group_id FROM SYSTEM_USER where user_id='$username' AND password='$password'";
				$result1=$mysqli->query($query1);
							echo $query = mysqli_num_rows($result1);
							
							if($query>0){
							while($value1 = mysqli_fetch_array($result1))
							{
								 $group = $value1['group_id'];
								 if(strcmp($group,"Group100") == 2)
								 {
									echo "You have Logged in successfully";
									header("Location:dashboard2.php");
									$_SESSION['user']=$username;
                                                                        $_SESSION['date']=date('d-m-Y');
									$_SESSION['global'] = "hello";	
									die();
								 }
								 
								 else if(strcmp($group,"Greenergy") == 1)
								 {
									echo "You have Logged in successfully";
									header("Location:dashboard2.php");
									$_SESSION['user']=$username;
                                                                        $_SESSION['date']=date('d-m-Y');
									$_SESSION['global'] = "hello";	
									$_SESSION['user_id']= 'Greenergy';
									die();
								 }
								 else if(strcmp($group,"Group3") == 1)
								 {
									echo "You have Logged in successfully";
									header("Location:dashboard2.php");
									$_SESSION['global'] = "hello";	
									$_SESSION['user']=$username;
                                                                        $_SESSION['date']= date('d-m-Y');
									die();
								 }
								
							}
							}
							else
								{
									$error='error';
									echo "else";
									header("Location:index.php?link=$error");
									die();
									
								}
				
	}
	else
	{
		header("location:index.php");	
	}
?>