<?php
ob_start();
  include('includes/db_conn.php');
  $username = trim($_POST['username']);
  $getpassword = trim($_POST['password']);
  $getpassword = md5 ($getpassword);
 
 $select = "SELECT * FROM users WHERE  username = \"".$username."\" AND password = \"".$getpassword."\"";
 $query = mysqli_query($con,$select);
 $userArray = mysqli_fetch_array($query);
 $rows = mysqli_num_rows($query);
 
 if ($rows == 0) 
 {
 $error='<div class="alert alert-danger fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p align="center">Wrong username and Password</p>
                        </div>';
 }
 
 else if ( $userArray['status'] == 2 )
 {
 $error='<div class="alert alert-danger fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p align="center">Your Account has been deactivated</p>
                        </div>';
 }
 
 else if ( $userArray['login_status'] == "1" && $_POST['loginfrom'] != "firstlog") 
 {
 header('Location: firstlogin.php');
 exit();
 }
 
 else {
  
 if ( $_POST['loginfrom'] == "firstlog")
 
 {
   include('includes/db_conn.php');
   $yourpassword = trim($_POST['yourpassword']);
   $yourpassword = md5($yourpassword);
   $username = $_POST['username'];


 $update = "UPDATE users SET login_status = \"2\", password = \"".$yourpassword."\" WHERE username = \"".$username."\"";
 $updatequery = mysqli_query($con,$update);
 }
 session_start();
 $_SESSION['login'] = true;
 $_SESSION['userid'] = $userArray['user_id'];
 $_SESSION['approve'] = $userArray['approve'];
 $_SESSION['category'] = $userArray['category'];
 
 header('Location: home.php');
 exit();	
 }//end else after checking email and password are correct

?>