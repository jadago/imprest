<?php 
include('check_permission.php');
   
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=stock_taking.xls");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%">
  <tr>
    <td align="center">PHYSICAL COUNTING –STATIONERY, FOOD & REFRESHMENT, HOUSEHOLDS AND KITCHEN APPLIANCES, ICT EQUIPMENT,CONTROLLED DOCUMENTS,REQUEST FOR PROPOSALS, BIDDING DOCUMENTS AND PPRA ANNUAL REPORTS AS PER -- <?php $date = date('Y-m-d');?><?php echo date("d M Y", strtotime($date));?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" style="border-collapse:collapse;" border="1" align="center">
      <tr>
        <td width="6%">#</td>
        <td width="33%" align="center">Description of Items</td>
        <td width="8%" align="center">Unit</td>
        <td width="16%" align="center">System Count</td>
        <td width="10%" align="center">Physical Count</td>
        <td width="13%" align="center">System Status</td>
        <td width="14%" align="center">System Status</td>
      </tr>
        <?php
                                require_once('includes/db_conn.php');
								$keepname=isset($keepname) ? $keepname:'';
                                $counter=1;
	                            $getitem = "SELECT * FROM item ORDER BY category ASC";		
                                $query = mysqli_query($con,$getitem);
                              while($result = mysqli_fetch_array($query))  
                                {
								
								  $cat = "SELECT * FROM item_category WHERE category_id='".$result['category']."'";
								  $querycat = mysqli_query($con,$cat);
								  $arraycat = mysqli_fetch_array($querycat);
								  //get unit
								  $unit = "SELECT * FROM unit WHERE unit_id = '".$result['unit']."'";
								  $queryunit = mysqli_query($con,$unit);
								  $arrayunit = mysqli_fetch_array($queryunit);
								  
								 $fullname = $arraycat['category_name'];
	                             if($fullname != $keepname)
                                  {
									
                                ?>
      <tr>
        <td colspan="7"><strong><?php echo $fullname;?></strong></td>
        </tr>
        <?php
									  }
									  ?>
      <tr>
        <td><?php echo $result['id'];?></td>
        <td><?php echo $result['item_name'];?></td>
        <td align="center"><?php echo $arrayunit['unit_name'];?></td>
        <td align="center"><?php echo $result['stock'];?></td>
        <td align="center">&nbsp;</td>
        <td align="center"><?php if($result['status']) echo $result['status']; else echo "-";?></td>
        <td align="center">&nbsp;</td>
      </tr>
        <?php
	$counter++;
	$keepname= trim($fullname );
	}
 ?>
    </table></td>
  </tr>
</table>

</body>
</html>
