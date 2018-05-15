<?php 
include('check_permission.php');
$error="";
if(isset($_POST['submit']))
{

	  require_once('processors/issuing.php');
}
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
                <h5><i class="fa fa-warning"></i> Issuing Items</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Issuing Items</h6></div>
						 <form class="form-horizontal" action="stock_issuing_detail.php" method="POST">
                        <table class="table table-bordered table-striped datatable-selectable">
                                    <thead>
									  <tr>
                                            <td colspan="8" align="right"><a href="stock_issuing.php">View Requests List</a></td>
                                        </tr>
                                        <tr>
                                            <th width="6%">#</th>
                                            <th width="27%">Item Name</th>
                                            <th width="11%">Category</th>
                                            <th width="13%">SubCategory</th>
											<th width="12%">Requested Qty</th>
                                            <th width="11%">Available Qty</th>
                                            <th width="20%">Supplied Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
                               // require_once('includes/db_conn.php');
                                $counter=1;
								$getID = isset($_GET['id']) ? $_GET['id']:'';

								$request = "SELECT requisition_detail.*,item.*,item_category.*,subcategory.* FROM requisition_detail 
								           LEFT JOIN item ON requisition_detail.item = item.id 
										   LEFT JOIN item_category ON item.category = item_category.category_id
										   LEFT JOIN subcategory ON item.subcategory = subcategory.id
								           WHERE requisition_id='$getID' ";			
                                $query = mysqli_query($con,$request);
                              while($result = mysqli_fetch_array($query))  
                                {
									
                                ?>
                                        <tr id="<?php if( $counter % 2 != 0 ) echo "1."; else echo "2."; ?>">
                                            <td align="center"><label>
                                              <input type="checkbox" name="user<?php echo $counter; ?>" value="<?php echo $result['item'];?>"<?php if($result['requisition_id'] > 0) echo "checked=\"checked\""; ?>>
                                            </label></td>
                                           <td><?php echo $result['item_name'];?></td>
                                           <td><?php echo $result['category_name'];?></td>
                                           <td><?php echo $result['subcategory_name'];?></td>
										   <td align="center"><?php echo $result['requested_quantity'];?></td>
                                           <td align="center"><?php echo $result['stock'];?></td>
                                           <td align="center"><label>
                                              <input type="number" class="form-control" name="quantity<?php echo $counter; ?>" required>
                                           </label></td>
                                        </tr>
										<?php
										$counter++;
								}
								?>
                                 <input name="totalusers" type="hidden" value="<?php echo $counter; ?>" />
                                       
										<tr bgcolor="white">
                                            <td colspan="8">Approved By:<?php 
											//get the approval name

                                        $app  = "SELECT * FROM requisition_approval WHERE requisition_id='$getID'";
                                        $queryapp = mysqli_query($con,$app);
                                        $arrayapp = mysqli_fetch_array($queryapp);

                                        //get names
                                        $n = "SELECT * FROM users WHERE user_id='".$arrayapp['addedby']."'";
                                        $queryn = mysqli_query($con,$n);
                                        $arrayn = mysqli_fetch_array($queryn);
										
											
											?><b><i><?php echo $arrayn['firstname']." ".$arrayn['lastname']." ---";?></i></b> <?php echo date("d M Y", strtotime($arrayapp['timeadded']));?></td>
                                        </tr>
										  <tr>
                                            <td>Remarks</td>
                                            <td colspan="2"><textarea name="remarks" class="limited form-control" cols="45" rows="5" placeholder="Add any remark"></textarea></td>
                                        </tr>
										  <tr>
										    <td>&nbsp;</td>
										    <td colspan="6"><button class="btn btn-warning" name="submit" type="submit">Issuing</button>
											<input name="action" type="hidden" value="add" />
                                            <input name="requisition_id" type="hidden" value="<?php echo $getID; ?>" />
											<input name="addedby" type="hidden" value="<?php echo $arraylogUser['user_id']; ?>" /></td>
								      </tr>
										  <tr>
										    <td>&nbsp;</td>
										    <td colspan="6">&nbsp;</td>
								      </tr>
                                    </tbody>
                                </table>
					  </form>
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
