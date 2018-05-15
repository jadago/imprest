<?php
include('check_permission.php');

 header("Content-Type: application/vnd.ms-excel");
 header("Content-Disposition: attachment;Filename=unretired_imprest_staff.xls");
?>
<table width="100%" border="1">
  <tr>
    <td colspan="7"><B>Unretired Imprest </B></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td width="15%">Staff Name</td>
    <td width="14%">Start Date</td>
    <td width="13%">End Date</td>
    <td width="15%">Description</td>
    <td width="17%">Paid Amount</td>
    <td width="8%">File #</td>
    <td width="18%">Payment Date</td>
  </tr>
  <?php
                                        $counter = 1;
                                        $getitem = "SELECT * FROM imprest WHERE addedby='".$arraylogUser['user_id']."' AND status=5 AND stage < 3";
                                        $query = mysqli_query($con, $getitem);
                                        while ($result = mysqli_fetch_array($query)) {
                                            //get users
                                            $users = "SELECT * FROM users WHERE user_id='".$result['staff_id']."'";
                                            $query1 = mysqli_query($con,$users);
                                            $array1 = mysqli_fetch_array($query1);
                                            
                                           // get total amount
                                            $amount = "SELECT SUM(amount) AS tamount FROM imprest_item WHERE imprest_id='".$result['imprest_id']."'";
                                            $queryA = mysqli_query($con,$amount);
                                            $arrayA = mysqli_fetch_array($queryA);
                                            
                                            //get voucher details
                                            $v = "SELECT * FROM imprest_voucher WHERE imprest_id='".$result['imprest_id']."'";
                                            $queryv = mysqli_query($con,$v);
                                            $arrayv = mysqli_fetch_array($queryv);
                                            ?>
  <tr>
                                                <td><?php echo $array1['firstname'] . " " . $array1['lastname']; ?></td>
                                                <td><?php echo date("d M Y", strtotime($result['leaving_date'])); ?></td>
                                                <td><?php echo date("d M Y", strtotime($result['return_date'])); ?></td>
                                                <td><?php echo $result['purpose']; ?></td>
                                                <td><?php echo number_format($arrayA['tamount']); ?></td>
                                                <td><?php echo $arrayv['file_name'];?></td>
                                                <td><?php echo $arrayv['date'];?></td>
  </tr>
     <?php
                                            $counter++;
                                        }
                                        ?>
</table>
