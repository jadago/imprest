<?php
require_once('includes/db_conn.php');
$stockout_id = isset($_GET['stockout_id']) ? $_GET['stockout_id']:'';
//$count = $_GET['i'];
$choose = "SELECT * FROM stock_out WHERE stockout_id='".$stockout_id."'";
$querychoose = mysqli_query($con,$choose);
$arraychoose = mysqli_fetch_array($querychoose);

$price = $arraychoose['price'];

//select from stock in

$drug_attribute = "SELECT * FROM stock_in WHERE stock_id = '".$arraychoose['stockin_id']."'";
$querydrugattribute = mysqli_query($con,$drug_attribute);
$arraydrugattribute = mysqli_fetch_array($querydrugattribute);

$stockin_id = $arraydrugattribute['stock_id'];
$tradename = $arraydrugattribute['trade_name'];
$quantity = $arraydrugattribute['quantity'];

//select unit

$unit1 = "SELECT * FROM units WHERE id='".$arraydrugattribute['units']."'";
$queryunit1 = mysqli_query($con,$unit1);
$arrayunit1 = mysqli_fetch_array($queryunit1);
$unit = $arrayunit1['name'];

//select form
$form = "SELECT * FROM form WHERE id='".$arraydrugattribute['form']."'";
$queryform = mysqli_query($con,$form);
$arrayform = mysqli_fetch_array($queryform);
$formtype = $arrayform['name'];


$response = array('stockin'=>$stockin_id, 'tradename'=>$tradename, 'quantity' =>$quantity,'formation'=>$formtype,'price'=>$price);
echo json_encode($response);
?>