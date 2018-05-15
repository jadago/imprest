<?php 
$today = date('Y');
if ( $_POST['action'] == "add")
{
require_once('includes/db_conn.php');
$user="SELECT * FROM registration ORDER BY reg_no DESC";
$queryuser=mysqli_query($con,$user);
$arrayuser = mysqli_fetch_array($queryuser);

$id = $arrayuser['reg_no'] + 1;
$card_no = $today."/".$id;
$fname= $_POST['a1'];
$mname= $_POST['a2'];
$lname= $_POST['a3'];

$insert = "INSERT INTO registration( fname, mname, lname, address, p_number, sex, birth_date,kin_phone,kin,patient_card_no,added_by,status ) VALUES( '$fname', '$mname', '$lname', '$_POST[a4]', '$_POST[a5]', '$_POST[a6]', '$_POST[a7]','$_POST[a8]','$_POST[a9]','$card_no','$_POST[addedby]','1' )";
$query = mysqli_query($con,$insert);

if ($query)
{
  header('Location: patient_view.php');
  exit();
}//close if


}//close add

else if ( $_POST[action] == "edit")

{
require_once('includes/db_conn.php');
$description = mysql_real_escape_string(trim($_POST['description']));
$date1 = mysql_real_escape_string(trim($_POST['date1']));
$place1 = mysql_real_escape_string(trim($_POST['place1']));
$date2 = mysql_real_escape_string(trim($_POST['date2']));
$place2 = mysql_real_escape_string(trim($_POST['place2']));

$update = "UPDATE session SET group_id = '$_POST[group]', nature = '$_POST[nature]', description = '$description', session_date = '$date1', session_place = '$place1', counselling_date = '$date2', counselling_place = '$place2' WHERE session_id  = '$_POST[id]'";

$query = mysql_query($update);
if ($query) $ok = "Session details edited"; else $error = "Session details NOT edited";
}//close edit
?>