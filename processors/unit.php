<?php
if($_POST['action']=="add")
{
    require_once('includes/db_conn.php');
    $unitname = $_POST['uname'];
    $insert="INSERT INTO unit(unit_name,status) VALUES('$unitname','1')";
    $query = mysqli_query($con,$insert);
    if($query)
    {
        $ok='<div class="alert alert-info fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            Unit Name submitted successfully...
                        </div>';
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
