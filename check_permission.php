<?php
session_start();
header("Cache-control: private"); //IE 6 Fix


if( $_SESSION['login'] != "true")
{
	header('Location: index.php');
	exit;
}

else 
{
   //get logged on user details
   require_once('includes/db_conn.php');
   $logUser = "SELECT * FROM users WHERE user_id = '".$_SESSION['userid']."'";
   $arraylogUser = mysqli_fetch_array(mysqli_query($con,$logUser));
   
   //get organisation details
  // require_once('includes/db_conn.php');
  // $org="SELECT * FROM lap WHERE lap_no='".$arraylogUser['org_no']."'";
  // $queryorg=mysql_query($org);
  // $arrayorg=mysql_fetch_array($queryorg);
}
?>