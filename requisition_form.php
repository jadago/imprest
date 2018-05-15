<?php 
session_start();
include('check_permission.php');
$id = $_SESSION['form_id'];

//ob_end_flush();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" style="border:1px #CCCCCC;">
  <tr>
    <td colspan="2" align="center"><B>THE UNITED REPUBLIC OF TANZANIA<BR/>PUBLIC PROCUREMENT REGULATORY AUTHORITY</B></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><B>INTERNAL STORES REQUISITION FORM</B></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td width="15%"><b>TO</b></td>
    <td width="85%">PMU</td>
  </tr>
  <?php
  $to = "SELECT *  FROM requisition WHERE requisition_id='$id'";
  $queryto = mysqli_query($con,$to);
  $arrayto = mysqli_fetch_array($queryto);
  //get department
  $dep = "SELECT * FROM departments WHERE department_id='".$arrayto['department']."'";
  $querydep = mysqli_query($con,$dep);
  $arraydep = mysqli_fetch_array($querydep);
  ?>
  <tr>
    <td><b>FROM</b></td>
    <td><?php echo $arraydep['department_name'];?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><i><b>Please order/supply the following items/services:-</b></i></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" style="border-collapse:collapse;" border="1">
      <tr>
        <td width="6%">S/N</td>
        <td width="28%">Desciption</td>
        <td width="11%">Unit</td>
        <td width="20%">Quantity Required</td>
        <td width="21%">Quantity Supplied</td>
        <td width="14%">&nbsp;</td>
      </tr>
      <?php
	  $id=isset($_GET['id']) ? $_GET['id']:'';
	  $counter=1;
	  $select="SELECT * FROM issuing_items WHERE requisition_id='$id'";
	  $query = mysqli_query($con,$select);
	  while($array = mysqli_fetch_array($query))
	  {
	   $item = "SELECT * FROM item WHERE id='".$array['item_id']."'";
	   $queryitem = mysqli_query($con,$item);
	   $arrayitem = mysqli_fetch_array($queryitem);
	   
	   $unit = "SELECT * FROM unit WHERE unit_id = '".$arrayitem ['unit']."'";
	   $queryunit = mysqli_query($con,$unit);
	   $arrayunit = mysqli_fetch_array($queryunit);
	   
	   //requisition_detail
	   $detail = "SELECT * FROM requisition_detail WHERE item='".$array['item_id']."' AND requisition_id='$id'";
	   $querydetail = mysqli_query($con,$detail);
	   $arraydetail = mysqli_fetch_array($querydetail);
	   //find users
	   $req ="SELECT * FROM requisition WHERE requisition_id='".$array['requisition_id']."'";
	   $queryreq = mysqli_query($con,$req);
	   $arrayreq = mysqli_fetch_array($queryreq);
	   
	   
	   //approval
	   $approval = "SELECT * FROM requisition_approval WHERE requisition_id='".$array['requisition_id']."'";
	   $queryapproval = mysqli_query($con,$approval);
	   $arrayapproval = mysqli_fetch_array($queryapproval);
	   
	   //get users
	   $user ="SELECT * FROM users WHERE user_id='".$arrayreq['addedby']."'";
	   $queryuser = mysqli_query($con,$user);
	   $arrayuser = mysqli_fetch_array($queryuser);
	   
	   
	   //get approval users
	   $user1 ="SELECT * FROM users WHERE user_id='".$arrayapproval['addedby']."'";
	   $queryuser1 = mysqli_query($con,$user1);
	   $arrayuser1 = mysqli_fetch_array($queryuser1);
	  ?>
      <tr>
        <td><?php echo $counter.".";?></td>
        <td><?php echo $arrayitem['item_name'];?></td>
        <td align="center"><?php echo  $arrayunit['unit_name'];?></td>
        <td align="center"><?php echo  $arraydetail['requested_quantity'];?></td>
        <td align="center"><?php echo  $arraydetail['supplied_quantity'];?></td>
        <td>&nbsp;</td>
      </tr>
      <?php
	  $counter++;
	  }
	  ?>

    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>Requested by:</td>
    <td><?php echo $arrayuser['firstname']." ".$arrayuser['lastname'];?></td>
  </tr>
  <tr>
    <td>Authorized by:</td>
    <td><?php echo $arrayuser1['firstname']." ".$arrayuser1['lastname'];?></td>
  </tr>
  <tr>
    <td>Date</td>
    <td><?php echo  $arrayapproval['timeadded'];?></td>
  </tr>
  <tr>
    <td>Remarks </td>
    <td><?php echo  $arraydetail['remark'];?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
</body>
</html>

