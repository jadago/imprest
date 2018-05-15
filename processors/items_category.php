<?php
if($_POST['action']=="add")
{
    require_once('includes/db_conn.php');
    $categoryname = $_POST['cname'];
    $insert="INSERT INTO item_category(category_name,status) VALUES('$categoryname','1')";
    $query = mysqli_query($con,$insert);
    if($query)
    {
        $ok='<div class="alert alert-info fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            Data submitted successfully...
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
     $categoryname = $_POST['cedit'];
	 $status = $_POST['sedit'];
	 $id = $_POST['id'];
	 $update="UPDATE item_category SET category_name='$categoryname',status='$status' WHERE category_id='$id'";
	 $query = mysqli_query($con,$update);
	
}
?>
