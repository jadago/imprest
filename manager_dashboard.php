<?php
$today = date('Y-m-d');
//pending requisitions


$auth = "SELECT COUNT(*) AS totalapproved FROM requisition_approval WHERE decision='1' AND addedby='".$arraylogUser['user_id']."'";
$queryauth = mysqli_query($con,$auth);
$arrayauth = mysqli_fetch_array($queryauth);

$auth2 = "SELECT COUNT(*) AS totalrejected FROM requisition_approval WHERE decision='2' AND addedby='".$arraylogUser['user_id']."'";
$queryauth2 = mysqli_query($con,$auth2);
$arrayauth2 = mysqli_fetch_array($queryauth2);


//echo $arrayissued['totalissued'];


?>