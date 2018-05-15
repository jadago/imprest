<?php
header("Content-Type: application/msword");
header("Content-Disposition: attachment;Filename=imprest.doc");
include('check_permission.php');
?>
<table width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="31%" align="left"><font size="-2">PPF Tower, 8th Floor<br />
    Ohio Street/Garden Avenue<br/>P.O.BOX 49,<br /><b>Dar es Salaam</b>,<br/> Tanzania</font> </td>
    <td width="34%" align="right"><img src="C:\xampp\htdocs\pmis2015\imprest_ppra\img\logo.jpg" width="320" height="71" /></td>
    <td width="35%"><font size="-2">Tel: +255 22 2133466, 2121236/7<br />
    Fax: +255 22 2121238<br/>E-mail: <u>ceo@ppra.go.tz</u><br /><b>Website: www.ppra.go.tz</b></font></td>
  </tr>
  <tr>
    <td colspan="3" bgcolor="#CCCCCC" align="center"><font size="+1">SAFARI IMPREST APPLICATION FORM</font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1"><b>Ref. No.:.................................................................................................</b></font></td>
  </tr>
   <?php
   require_once('includes/db_conn.php');
                            $id2 = $_GET['eid'];
							echo $id2;
                            $get = "SELECT * FROM imprest WHERE imprest_id='$id2'";
                            $query = mysqli_query($con, $get);
                            $array = mysqli_fetch_array($query);

                            //get user details
                            $user = "SELECT * FROM users WHERE user_id='" . $array['staff_id'] . "'";
                            $queryU = mysqli_query($con, $user);
                            $arrayU = mysqli_fetch_array($queryU);
							//get department name
							$dep = "SELECT * FROM departments WHERE department_id='".$arrayU['department']."'";
							$queryD = mysqli_query($con,$dep);
							$arrayD = mysqli_fetch_array($queryD);
                            ?>
  <tr>
    <td colspan="3"><font size="-1"><p>A:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <strong>To be completed by the applicant (in  Duplicate)</strong></p></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1. Name  as per payroll: <b><?php echo $arrayU['firstname'] . " " . $arrayU['lastname']; ?></b></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2. Designation :&nbsp;<b><?php echo $arrayU['designation']; ?></b>&nbsp;&nbsp;&nbsp;3.Department: <b><?php echo $arrayD['department_name']; ?></b></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4. Check Number..........................................5.Salary Scale: <b><?php echo $arrayU['salary']; ?></b></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6. Subsistence Allowance rate:&nbsp; <b><?php echo number_format($array['rate'],0);?></b></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7.	Purpose for which the Imprest is Requested:&nbsp;<b><?php echo $array['purpose'];?></b></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;8.	<b>Details of Imprest Required</b></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;a) Date of leaving station;&nbsp;<b><?php echo date("d M Y", strtotime($array['leaving_date'])); ?></b> b) Returning to the station:&nbsp;<b><?php echo date("d M Y", strtotime($array['return_date'])); ?></b></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;c) Place to be visited:&nbsp;<b><?php echo $array['place'];?></b> </font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;d) 	Subsistence allowance for :&nbsp;<b><?php echo number_format($array['night'],0);?></b> nights each per night:&nbsp; <b><?php echo number_format($array['rate'],0);?></b></font></td>
  </tr>
  <tr>
    <td colspan="3"><table width="100%"  style="border-collapse: collapse;">
      <tr bgcolor="#CCCCCC">
        <td width="6%" style="border: 1px solid black;"><font size="-1">No</font></td>
        <td width="29%" style="border: 1px solid black;"><font size="-1">Item Name</font></td>
        <td width="34%" style="border: 1px solid black;"><font size="-1">Description</font></td>
        <td width="31%" style="border: 1px solid black;"><font size="-1">Amount</font></td>
      </tr>
      <?php
$counter = 1;
$total=0;
$getitem = "SELECT * FROM imprest_item WHERE imprest_id='" . $array['imprest_id'] . "'";
$query = mysqli_query($con, $getitem);
while ($result = mysqli_fetch_array($query)) {


    // get item name
    $item_name = "SELECT * FROM item_category WHERE item_id='" . $result['item_name'] . "'";
    $queryA = mysqli_query($con, $item_name);
    $arrayA = mysqli_fetch_array($queryA);
    ?>
 
      <tr>
        <td style="border: 1px solid black;" align="center"><font size="-1"><?php echo $counter."."; ?></font></td>
        <td style="border: 1px solid black;"><font size="-1"><?php echo $arrayA['name']; ?></font></td>
        <td style="border: 1px solid black;"><font size="-1"><?php echo $result['description']; ?></font></td>
        <td style="border: 1px solid black;">&nbsp;&nbsp;<font size="-1"><?php echo number_format($result['amount'],0); ?></font></td>
      </tr>
      <?php
	  $total = $total + $result['amount'];
	  $counter++;
	  }
	  
	  ?>
      <tr>
        <td colspan="3" style="border: 1px solid black;" align="right"><font size="-1">Total&nbsp;&nbsp;</font></td>
        <td style="border: 1px solid black;"><font size="-1">&nbsp;&nbsp;<b><?php echo  number_format($total,0);?></b></font></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;9.I hereby certify that the particulars given above are correct to the best of my knowledge and that I have no previous imprest outstanding</font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Date:</b>........................................................<b>Signature....................................</b></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">B:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>To</strong> <strong>be completed by Accountant In-charge</strong></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.The above officer has no /has the following outstanding imprest</font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.Amount of oustanding imprest:&nbsp; <?php 
                                   $balance = "SELECT imprest_id,SUM(amount) AS Oamount FROM imprest_item WHERE imprest_id IN(SELECT imprest_id FROM imprest WHERE addedby='".$arraylogUser['user_id']."' AND status=5 AND stage=1)";
                                   $queryb = mysqli_query($con,$balance);
                                   $arrayb = mysqli_fetch_array($queryb);
                                   echo number_format($arrayb['Oamount'],0);
                                    
                                    
                                    ?></font></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="-1"><b>Date:</b>........................................................<b>Signature.....................................</b></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">C:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Approval by Head of Division</strong></font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.The above Imprest of TShs: <b><?php echo  number_format($total,0);?></b>&nbsp;is approved/not approved.</font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.This imprest must be retired before...falling which the Officer will be liable to pay surcharge of 10% of unreturned amount until the whole imprest is retired fully</font></td>
  </tr>
  <tr>
    <td colspan="3"><font size="-1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.Unspent balance if any must be refunded in cash.</font></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size="-1"><b>Date:</b></font>........................................................<b><font size="-1">Signature.....................................</font></b></td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>

