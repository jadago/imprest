<?php
if($_POST['action']=="add")
{
   require_once('includes/db_conn.php');
  $remarks=isset($_POST['remarks']) ? $_POST['remarks']:'';
  $requisitionID=isset($_POST['requisition_id']) ? $_POST['requisition_id']:'';
  $addedby = isset($_POST['addedby']) ? $_POST['addedby']:'';
   
   
   for ( $i=1; $i < $_POST['totalusers']; $i++)
	{
	  if ( $_POST['user'.$i] > 0 )
	  {
		$quantity=isset($_POST['quantity'.$i]) ? $_POST['quantity'.$i]:'';		
		$insert = "INSERT INTO issuing_items(requisition_id,item_id,addedby,remarks,supplied_quantity) VALUES('$requisitionID','".$_POST['user'.$i]."','$addedby','$remarks','$quantity')";
		$query = mysqli_query($con,$insert);
		
	    //$update="UPDATE prescription SET amount='$amount',payment_method='".$_POST['method'.$i]."' WHERE id ='".$_POST['user'.$i]."' AND date='$today'";
	   // $query=mysql_query($update);
		
	    if($query)
		{
		$update1="UPDATE requisition SET stage='4' WHERE requisition_id='".$requisitionID."'";
         $queryupdate=mysqli_query($con,$update1);
		 
		 //updating the available stock
		 $stock = "SELECT * FROM item WHERE id='".$_POST['user'.$i]."'";
		 $querystock = mysqli_query($con,$stock);
		 $arraystock = mysqli_fetch_array($querystock);
		 
		 $availableStock = $arraystock['stock'];
		 $difference = $arraystock['stock'] - $quantity;
		 //update stock 
		 
		 $up = "UPDATE item SET stock='$difference' WHERE id='".$_POST['user'.$i]."'";
		 $queryup = mysqli_query($con,$up);
		 
		 //update requisition details
		 $req = "UPDATE requisition_detail SET supplied_quantity='$quantity',remark='$remarks' WHERE requisition_id='".$requisitionID."' AND item='".$_POST['user'.$i]."'";
		 $queryreq = mysqli_query($con,$req);
		 
        //$ok="Send a patient to the phamarcy";
		} 
		else $error = "Something went wrong ".$_POST['user'.$i];
	  }
	}//close for loop
	
	header('Location:stock_issuing.php');
	exit();
}
elseif($_POST['action']=="edit")
{
	 require_once('includes/db_conn.php');
     $unitname = $_POST['uedit'];
	 $status = $_POST['sedit'];
	 $id = $_POST['id'];
	 $update="UPDATE unit SET unit_name='$unitname',status='$status' WHERE unit_id='$id'";
	 $query = mysqli_query($con,$update);
	
}
?>
