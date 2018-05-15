<?php
if($_POST['action']=="add")
{
    require_once('includes/db_conn.php');
	$receiving_date = $_POST['receiving_date'];
    $itemName = $_POST['item_name'];
	$quantity = $_POST['quantity'];
	$tender = $_POST['tender'];
	$detail = $_POST['detail'];
	$supplier = $_POST['supplier'];

    // getting the value of category and subcategory from items table 
	$cat = "SELECT * FROM item WHERE id='".$itemName."'";
	$querycat = mysqli_query($con,$cat);
	$arraycat = mysqli_fetch_array($querycat);
	
	$category = $arraycat['category'];
	$subcategory = $arraycat['subcategory'];
	
	
	$insert="INSERT INTO stock_item VALUES ('','$category','$subcategory','$itemName','$quantity','$receiving_date','$tender','$detail','$supplier')";
	$query = mysqli_query($con,$insert);
	if($query)
	{
		//capture the last stock entry and update items table on stock column
		$get="SELECT * FROM stock_item ORDER BY id DESC";
		$queryget = mysqli_query($con,$get);
		$arrayget = mysqli_fetch_array($queryget);
		
		$itemID = $arrayget['item'];
		
		//get available stock from item table
		$available = "SELECT * FROM item WHERE id='$itemID'";
		$queryavailable = mysqli_query($con,$available);
		$arrayavailable = mysqli_fetch_array($queryavailable);
		
		$stockavailable = $arrayavailable['stock'];
		
		//add new quantity and existing one
		$newstock = $stockavailable + $quantity;
		//update the table now
		$update = "UPDATE item SET stock='$newstock' WHERE id='$itemID' ";
		$query = mysqli_query($con,$update);
		
		
		$ok='<div class="alert alert-info fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            Stock Data submitted successfully...
                        </div>';
    
	}
	else
	{
		$error = '<div class="alert alert-danger fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            ERROR! Username already exist....
                        </div>';
	}
	
	
}
elseif($_POST['action']=="edit")
{
	 require_once('includes/db_conn.php');
     $fname = $_POST['efname'];
	 $lname = $_POST['elname'];
	 $email = $_POST['eemail'];
	 $username = $_POST['eusername'];
	 $cat = $_POST['ecat'];
	 $status = $_POST['estatus'];
	 $password = $_POST['password'];
	 $newpassword = md5($password);
	 $id = $_POST['id'];
	 if($password != "")
	 {
	 $update="UPDATE users SET firstname='$fname',lastname='$lname',email='$email',username='$username',status='$status',category='$cat',password='$newpassword',login_status='1' WHERE user_id='$id'"; 
	 }
	 else{
	 $update="UPDATE users SET firstname='$fname',lastname='$lname',email='$email',username='$username',status='$status',category='$cat' WHERE user_id='$id'";
	 }
	 $query = mysqli_query($con,$update);
	
}
?>
