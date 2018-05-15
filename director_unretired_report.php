
<?php
include('check_permission.php');

 header("Content-Type: application/vnd.ms-excel");
 header("Content-Disposition: attachment;Filename=unretired_imprest_staff_division.xls");
?>
<table width="100%" border="1">
  <tr>
    <td colspan="6"><b>Unretired Imprest Report</b></td>
  </tr>
  <tr bgcolor="#CCCCCC">
    <td>Staff Name</td>
    <td>Start Date</td>
    <td>End Date</td>
    <td>Description</td>
    <td>Amount Paid</td>
    <td>Payment Date</td>
  </tr>
  <?php
                               require_once('includes/db_conn.php');
                                $counter=1;
								
             	
								if($_GET['item'] > 0) $staff = "AND addedby IN(SELECT user_id FROM users WHERE user_id='".$_GET['item']."')"; else $staff="";
								
								
								         $counter = 1;
										 $total=0;
										 if($_GET['item']==0)
										 {
                                        $getitem = "SELECT * FROM imprest WHERE status=5 AND stage < 4 AND addedby IN(SELECT user_id FROM users WHERE department= '".$arraylogUser['department']."' )";
										}
										else
										{
										$getitem = "SELECT * FROM imprest WHERE status=5 AND stage < 4 AND addedby IN(SELECT user_id FROM users WHERE department= '".$arraylogUser['department']."' )".$staff."";
										}
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
  <td width="19%"><?php echo $array1['firstname'] . " " . $array1['lastname']; ?></td>
  <td><?php echo date("d M Y", strtotime($result['leaving_date'])); ?></td>
  <td><?php echo date("d M Y", strtotime($result['return_date'])); ?></td>
  <td align="center"><?php echo $result['purpose']; ?></td>
  <td align="center"><?php echo number_format($arrayA['tamount']); ?></td>
  <td><?php echo $arrayv['date'];?></td>
  </tr>
  <?php
			$total = $total + 	$arrayA['tamount'];
									$counter++;
								}
								?>
  <tr>
    <td colspan="4" align="right"><b>Total Unretired Imprest:</b></td>
    <td align="center"><b><?php echo number_format($total);?></b></td>
    <td>&nbsp;</td>
  </tr>
</table>
