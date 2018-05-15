<?php
$today = date('Y-m-d');
//pending requisitions
$pending = "SELECT COUNT(*) AS totalpending FROM requisition WHERE stage='3'";
$querypending = mysqli_query($con,$pending);
$arraypending = mysqli_fetch_array($querypending);
//total issued items today
//$issuedtoday = "SELECT COUNT(*) AS total_today FROM issuing_items WHERE timeadded=DATE($today)";
//$querytoday = mysqli_query($con,$issuedtoday);
//$arraytoday = mysqli_fetch_array($querytoday);

//total issued items 
$issuedtoday2 = "SELECT COUNT(*) AS total_all FROM issuing_items";
$querytoday2 = mysqli_query($con,$issuedtoday2);
$arraytoday2 = mysqli_fetch_array($querytoday2);

//re-ordering
$rea = "SELECT COUNT(*) AS item_ordered FROM item WHERE (reordering_point = stock) or (stock < reordering_point)";
$queryrea = mysqli_query($con,$rea);
$arrayrea = mysqli_fetch_array($queryrea);



?>