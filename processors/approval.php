<?php
if($_POST['action']=="add")
{
    require_once('includes/db_conn.php');
    $decision = $_POST['approve'];
	$remarks = $_POST['remarks'];
	$requisition_id = $_POST['id'];
	$addedby = $_POST['user_id'];
	//$requisition_id = $_GET['id'];
	//$addedby = $_SESSION['user_id'];
	
    $insert="INSERT INTO requisition_approval(requisition_id,remarks,decision,addedby) VALUES('$requisition_id','$remarks','$decision','$addedby')";
    $query = mysqli_query($con,$insert);
    if($query)
    {
      //change the status of the requisition to pmu
	  if($decision==1)
	  {
	  $update = "UPDATE requisition SET stage='3' WHERE requisition_id='$requisition_id'";
	  }
	  else{
		  $update = "UPDATE requisition SET status='2',stage='0' WHERE requisition_id='$requisition_id'";
	  }
	  $queryupdate = mysqli_query($con,$update);
	  
	  header('Location: requisition_approval.php');
	  exit();
	  
    }
    else {
        $error = '<div class="alert alert-info fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            Something went wrong
                        </div>';
    }
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
