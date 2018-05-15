
<?php 
include('check_permission.php');
$error="";
 header("Content-Type: application/vnd.ms-excel");
 header("Content-Disposition: attachment;Filename=ReceivedItems.xls");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="1" style="border-collapse:collapse;">
  <tr>
    <td colspan="8" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="8"><?php if($_GET['from'] && $_GET['to'] !=""){?> Items Received between <b><?php $from=$_GET['from']; echo date("d M Y", strtotime($from))?></b> AND <b><?php $to=$_GET['to']; echo date("d M Y", strtotime($to))?></b><?php } ?></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td width="2%">#</td>
    <td width="17%">Items Name</td>
    <td width="20%">Category</td>
    <td width="12%">SubCategory</td>
    <td width="12%">Received Quantity</td>
    <td width="12%">Received Date</td>
    <td width="12%">Reference Tender</td>
    <td width="13%">Description</td>
  </tr>			
                             <?php
                               // require_once('includes/db_conn.php');
                                $counter=1;
								$getID = isset($_GET['id']) ? $_GET['id']:'';
                                if($_GET['from'] && $_GET['to'] !="") $date="AND (received_date between '".$_GET['from']."' AND '".$_GET['to']."')"; else $date="";	
								if($_GET['item'] > 0) $item_issued = "AND item IN(SELECT id FROM item WHERE id='".$_GET['item']."')"; else $item_issued="";
								
								
								$request = "SELECT * FROM stock_item WHERE id > 0 ".$date."".$item_issued."";			
                                $query = mysqli_query($con,$request);
                              while($result = mysqli_fetch_array($query))  
                                {
								 //get Items name
								 $item = "SELECT * FROM item WHERE id='".$result['item']."'";
								 $queryitem = mysqli_query($con,$item);
								 $arrayitem = mysqli_fetch_array($queryitem);
								 //category
								 $cat = "SELECT * FROM item_category WHERE category_id='".$result['category']."'";
								 $querycat = mysqli_query($con,$cat);
								 $arraycat = mysqli_fetch_array($querycat);
								 
								 //subcategory
								 $cat1 = "SELECT * FROM subcategory WHERE id='".$result['subcategory']."'";
								 $querycat1 = mysqli_query($con,$cat1);
								 $arraycat1 = mysqli_fetch_array($querycat1);
								 
								 //detail				 
								// $detail = "SELECT * FROM requisition_detail WHERE requisition_id = '".$result['requisition_id']."'";
								// $querydetail = mysqli_query($con,$detail);
								// $arraydetail = mysqli_fetch_array($querydetail);
								
								 //reqiusiition			 
								 //$detail1 = "SELECT * FROM requisition WHERE requisition_id = '".$result['requisition_id']."'";
								// $querydetail1 = mysqli_query($con,$detail1);
								 //$arraydetail1 = mysqli_fetch_array($querydetail1);
								 
								// $names = "SELECT * FROM users WHERE user_id='".$arraydetail1['addedby']."'";
								// $querynames = mysqli_query($con,$names);
								// $arraynames = mysqli_fetch_array($querynames);
									
                                ?>
						
  <tr>
    <td><?php echo $counter." .";?></td>
    <td><?php echo $arrayitem['item_name'];?></td>
    <td><?php echo $arraycat['category_name'];?></td>
    <td><?php echo $arraycat1['subcategory_name'];?></td>
    <td><?php echo  $result['quantity'];?></td>
    <td><?php echo date("d M Y", strtotime($result['received_date']));?></td>
    <td><?php echo $result['reference_tender'];?></td>
    <td><?php echo $result['description'];?></td>
  </tr>
  <?php
										$counter++;
								}
								?>
</table>

</body>
</html>
