<?php
//database settings
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
$connect = mysqli_connect("localhost", "root", "12345", "erp");

$result = mysqli_query($connect, "select * from users");

$data = array();

while ($row = mysqli_fetch_array($result)) {
  $data[] = array('id'=>$row['user_id'],'firstname'=>$row['firstname']);
}
$json_response = json_encode($data);
echo  $json_response;
?>