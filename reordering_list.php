<?php 
include('check_permission.php');
   
     header("Content-Type: application/vnd.ms-excel");
     header("Content-Disposition: attachment;Filename=Reordering_list.xls");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php $today = date('Y-m-d');?>
<table width="83%" border="1" style="border-collapse:collapse">
  <tr>
    <td colspan="6"><b>Items Reordering List<br />Produced :<?php echo $today;?></b></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td width="7%">#</td>
    <td width="20%">Items Name</td>
    <td width="18%">Category</td>
    <td width="15%">Subcategory</td>
    <td width="17%" align="center">Reordering Point</td>
    <td width="23%" align="center">Available Amount</td>
  </tr>
  <?php
  require_once('includes/db_conn.php');
  $counter=1;
  $item = "SELECT * FROM item WHERE (reordering_point = stock) or (stock < reordering_point)";
  $query=mysqli_query($con,$item);
  while($array = mysqli_fetch_array($query))
  {
  //category
  $cat = "SELECT * FROM item_category WHERE category_id='".$array['category']."'";
  $querycat = mysqli_query($con,$cat);
  $arraycat = mysqli_fetch_array($querycat);
  
  //sub
  $sub = "SELECT * FROM subcategory WHERE id='".$array['subcategory']."'";
  $querysub = mysqli_query($con,$sub);
  $arraysub = mysqli_fetch_array($querysub);
  ?>
  <tr>
    <td><?php echo $counter.".";?></td>
    <td><?php echo $array['item_name'];?></td>
    <td><?php echo $arraycat['category_name'];?></td>
    <td><?php echo $arraysub['subcategory_name'];?></td>
    <td align="center"><?php echo $array['reordering_point'];?></td>
    <td align="center"><?php echo $array['stock'];?></td>
  </tr>
  <?php
  $counter++;
  }
  ?>
</table>

</body>
</html>
