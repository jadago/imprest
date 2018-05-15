<?php
require_once('includes/db_conn.php');
$unit_id = $_GET['unit_id'];
$choose = "SELECT * FROM unit WHERE unit_id='".$unit_id."'";
$querychoose = mysqli_query($con,$choose);
$arraychoose = mysqli_fetch_array($querychoose);

$name = $arraychoose['unit_name'];
$status = $arraychoose['status'];
$id = $arraychoose['unit_id'];

$response = array('name'=>$name, 'status'=>$status,'unit_id'=>$id);
echo json_encode($response);
?>
