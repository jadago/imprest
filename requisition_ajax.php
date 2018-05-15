<?php
require_once('includes/db_conn.php');
$id = $_GET['id'];
$count = $_GET['i'];


$choose = "SELECT * FROM item WHERE id='".$id."'";
$querychoose = mysqli_query($con,$choose);
$arraychoose = mysqli_fetch_array($querychoose);

$stock_available = $arraychoose['stock'];
$unitid = $arraychoose['unit'];

//get unit value
$unitget = "SELECT * FROM unit WHERE unit_id='".$unitid."'";
$queryunit = mysqli_query($con,$unitget);
$arrayunit = mysqli_fetch_array($queryunit);

$unit = $arrayunit['unit_name'];





$response = array('itemid'=>$id, 'stock'=>$stock_available, 'unit' =>$unit,'count'=>$count);
echo json_encode($response);
?>