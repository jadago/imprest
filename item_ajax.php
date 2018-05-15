<?php
require_once('includes/db_conn.php');
$imprest_id = $_GET['imprest_id'];
$choose = "SELECT * FROM imprest WHERE imprest_id='".$imprest_id."'";
$querychoose = mysqli_query($con,$choose);
$arraychoose = mysqli_fetch_array($querychoose);

//$itemname = $arraychoose['item_name'];
//$price = $arraychoose['unit_price'];
//$order = $arraychoose['reordering_point'];
//$stock= $arraychoose['stock'];
$id = $arraychoose['imprest_id'];

$response = array('imprest_id'=>$id);
echo json_encode($response);
?>
