<?php
require_once('includes/db_conn.php');
$user_id = $_GET['user_id'];
$choose = "SELECT * FROM users WHERE user_id='".$user_id."'";
$querychoose = mysqli_query($con,$choose);
$arraychoose = mysqli_fetch_array($querychoose);

$fname = $arraychoose['firstname'];
$lname = $arraychoose['lastname'];
$email = $arraychoose['email'];
$username = $arraychoose['username'];
$category = $arraychoose['category'];
$status = $arraychoose['status'];
$id = $arraychoose['user_id'];

$response = array('fname'=>$fname,'lname'=>$lname,'email'=>$email,'username'=>$username,'category'=>$category,'status'=>$status,'user_id'=>$id);
echo json_encode($response);
?>
