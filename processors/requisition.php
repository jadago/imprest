<?php
if($_POST['action']=="add")
{
	if ( isset($_POST['save']) ) 
	{ 
	  $stage = '1'; 
	}
	else if ( isset($_POST['submit']) ) 
	{ 
	  $stage = '2';
    }
	
    require_once('includes/db_conn.php');
	$submitted_date = $_POST['request_date'];
	$department = $_POST['department'];
	$item_type = $_POST['cat'];
	$addedby = $_POST['addedby'];
	
	$insert = "INSERT INTO requisition(department,submitted_date,status,stage,addedby,issuing_officer,item_type) VALUES('$department','$submitted_date','1','$stage','$addedby','','$item_type')";
	$query = mysqli_query($con,$insert);
	
	if($query)
	{
		//capture last ID
	require_once('includes/db_conn.php');
	$selectID="SELECT * FROM requisition ORDER BY requisition_id DESC";
	$queryID=mysqli_query($con,$selectID);
	$arrayID=mysqli_fetch_array($queryID);
	$requisitionID = $arrayID['requisition_id'];
	
	
    for ($i=1; $i <= $_POST['total']; $i++)
	{
		$quantity=isset($_POST['quantity'.$i]) ? $_POST['quantity'.$i]:'';
		$item=isset($_POST['item'.$i]) ? $_POST['item'.$i]:'';
	
        //insert into requisition detail table	
		$requestedItem ="INSERT INTO requisition_detail(requisition_id,item,requested_quantity,supplied_quantity,remark) VALUES('$requisitionID','$item','$quantity','','')";
		$queryItem = mysqli_query($con,$requestedItem);
		
		
		
		
	
	}//end of for loop
	header('Location: requisition.php');
	exit();
	}//end of if query
}
elseif($_POST['action']=="edit")
{
 require_once('includes/db_conn.php');
 
 if ( isset($_POST['save']) ) 
	{
	  $stage = '1';
	}
	else if ( isset($_POST['submit']) ) 
	{ 
	  $stage = '2';
	  }
 
 $req_id = $_POST['req_id'];
 
    for ($i=0; $i< $_POST['itemstotal']; $i++)
  {
	$itemid=isset($_POST['itemid'.$i]) ? $_POST['itemid'.$i]:'';
	$itemname=isset($_POST['item'.$i]) ? $_POST['item'.$i]:'';
	$quantity=isset($_POST['quantity'.$i]) ? $_POST['quantity'.$i]:'';
	$delete=isset($_POST['delete'.$i]) ? $_POST['delete'.$i]:'';
	
	if ( $delete == 1 )
	{
	  $delete = "DELETE FROM requisition_detail WHERE item = '".$itemid."'";
	  $querydelete = mysqli_query($con,$delete);  
	}
	else
	{
      $updateitem = "UPDATE requisition_detail SET item = '$itemname', requested_quantity = '$quantity' WHERE item = '".$itemname."'";
	  $updateitems = mysqli_query($con,$updateitem);
	  
	  //update requisition table
	  if($updateitems)
	  {
	  $update = "UPDATE requisition SET stage = '$stage' WHERE requisition_id='$req_id'";
	  $queryupdate = mysqli_query($con,$update);
	//  header('Location: requisition.php');
	  //exit();
	  }
	 header('Location: requisition.php');
	  //exit();
	}//close if
  }//close for for editing files
  
  
  ///add new items
  
  
  for ($i=1; $i <= $_POST['total']; $i++)
	{
		$quantity=isset($_POST['quantity'.$i]) ? $_POST['quantity'.$i]:'';
		$item=isset($_POST['item'.$i]) ? $_POST['item'.$i]:'';
	
        //insert into requisition detail table	
		$requestedItem ="INSERT INTO requisition_detail(requisition_id,item,requested_quantity,supplied_quantity,remark) VALUES('$req_id','$item','$quantity','','')";
		$queryItem = mysqli_query($con,$requestedItem);
		
		
		
		
	
	}//end of for loop
	
}
?>
