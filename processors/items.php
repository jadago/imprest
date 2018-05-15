<?php
if($_POST['action']=="add")
{
    require_once('includes/db_conn.php');
    $itemName = $_POST['item_name'];
	$category = $_POST['item_category'];
	$subCategory = $_POST['item_sub'];
	$unit = $_POST['unit'];
	$unitPrice = $_POST['unit_price'];
	$point = $_POST['unit_point'];

	
	$insert="INSERT INTO item(item_name,category,subcategory,type,unit,unit_price,reordering_point,stock,status) VALUES ('$itemName','$category','$subCategory','','$unit','$unitPrice','$point','','Good')";
	$query = mysqli_query($con,$insert);
	if($query)
	{
		$ok='<div class="alert alert-info fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            Data submitted successfully...
                        </div>';
    
	}
	else
	{
		$error = '<div class="alert alert-danger fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            ERROR! Something went wrong....
                        </div>';
	}
	
	
}
elseif($_POST['action']=="edit")
{
	 require_once('includes/db_conn.php');
	$itemName=isset($_POST['iname']) ? $_POST['iname']:'';
	$unitPrice=isset($_POST['price']) ? $_POST['price']:'';
	$point=isset($_POST['point_order']) ? $_POST['point_order']:'';
	 $stock = isset($_POST['stock']) ? $_POST['stock']:'';
	 $id = $_POST['id'];
	 
	 $update="UPDATE item SET item_name='$itemName',unit_price='$unitPrice',reordering_point='$point',stock='$stock' WHERE id='$id'"; 
	 $query = mysqli_query($con,$update);
	
}
?>
