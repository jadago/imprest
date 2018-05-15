<?php 
include('check_permission.php');
$error="";

//get the approval name

$app  = "SELECT * FROM requisition_approval WHERE requisition_id='$_GET[id]'";
$queryapp = mysqli_query($con,$app);
$arrayapp = mysqli_fetch_array($queryapp);

//get names
$n = "SELECT * FROM users WHERE user_id='".$arrayapp['addedby']."'";
$queryn = mysqli_query($con,$n);
$arrayn = mysqli_fetch_array($queryn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('includes/meta_description.php');?>

</head>

<body>

    <!-- Navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
           <?php include('includes/header.php');?>
        </div>
    </div>
    <!-- /navbar -->


    <!-- Page header -->
     <?php include('includes/page_header.php');?>
    <!-- /page header -->


    <!-- Page container -->
    <div class="page-container container-fluid">
    	
    	<!-- Sidebar -->
       <?php include('includes/sidemenu.php');?>
        <!-- /sidebar -->

    
        <!-- Page content -->
        <div class="page-content">

            <!-- Page title -->
        	<div class="page-title">
                <h5><i class="fa fa-warning"></i> Requisition Details</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Items requested</h6></div>
                        <div class="datatable">
                            <table class="table">
                                <thead>
								<tr>
                                        <td><b><i><?php if($arrayapp['decision']==1) echo "Approver:";elseif($arrayapp['decision']==2) echo "Cancelled:";else echo "";?><br/><?php if($arrayapp['decision']==1 || $arrayapp['decision']==2) echo "Date:";?><br/>Remarks<i></b></td>
										<td><b><i><?php echo $arrayn['firstname']." ".$arrayn['lastname'];?><br/><?php echo date("d M Y", strtotime($arrayapp['timeadded']));?><br/><?php echo $arrayapp['remarks'];?></i></b></td>
										<td>&nbsp;</td>
										<td><?php echo $error;?></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td align="center"><a href="requisition.php"><span class="label label-success">View Requisitions</span></a></td>
                                    </tr>
                                    <tr>
                                        <th>#</th>
										<th>Item Name</th>
                                        <th>Category</th>
                                        <th>SubCategory</th>
                                        <th>Requested Quantity</th>
										<th>Supplied Quantity</th>
										<th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
                                require_once('includes/db_conn.php');
                                $counter=1;

								$request = "SELECT requisition_detail.*,item.*,item_category.*,subcategory.* FROM requisition_detail 
								           LEFT JOIN item ON requisition_detail.item = item.id 
										   LEFT JOIN item_category ON item.category = item_category.category_id
										   LEFT JOIN subcategory ON item.subcategory = subcategory.id
										  
								           WHERE requisition_id='$_GET[id]' ";			
                                $query = mysqli_query($con,$request);
                              while($result = mysqli_fetch_array($query))  
                                {
									
                                ?>
                                    <tr id="<?php if( $counter % 2 != 0 ) echo "1"; else echo "2"; ?>">
                                        <td><?php echo $counter;?></td>
										 <td><?php echo $result['item_name'];?></td>
                                        <td><?php echo $result['category_name'];?></td>
                                        <td><?php echo $result['subcategory_name'];?></td>
										<td align="center"><?php echo $result['requested_quantity'];?></td>
										<td align ="center"><?php echo $result['supplied_quantity'];?></td>
										<td><?php echo $result['remark'];?></td>
                                    </tr>
										<?php
									$counter++;
								    }
								?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /default datatable inside panel -->

                </div>
            </div>
            <!-- /form validation -->
			
            <!-- /modal with table -->
			<!-- Footer -->
            <div class="footer">
                <?php include('includes/footer.php');?>
            </div>
            <!-- /footer -->
                    </div>
                </div>

            <!-- /modal with table -->

</body>
</html>
