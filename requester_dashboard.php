<?php
$today = date('Y-m-d');
//pending requisitions
$totalreq = "SELECT COUNT(*) AS totalrequisition FROM requisition WHERE addedby='".$arraylogUser['user_id']."'";
$queryreq = mysqli_query($con,$totalreq);
$arrayreq = mysqli_fetch_array($queryreq);

$totalcancel= "SELECT COUNT(*) AS totalcancel FROM requisition WHERE status = '2' AND addedby='".$arraylogUser['user_id']."'";
$querycancel = mysqli_query($con,$totalcancel);
$arraycancel = mysqli_fetch_array($querycancel);

$totalissued= "SELECT COUNT(*) AS totalissued FROM requisition WHERE stage = '4' AND addedby='".$arraylogUser['user_id']."'";
$queryissued = mysqli_query($con,$totalissued);
$arrayissued = mysqli_fetch_array($queryissued);

$totaldraft= "SELECT COUNT(*) AS totaldraft FROM requisition WHERE stage = '1' AND addedby='".$arraylogUser['user_id']."'";
$querydraft = mysqli_query($con,$totaldraft);
$arraydraft= mysqli_fetch_array($querydraft);


//echo $arrayissued['totalissued'];


?>