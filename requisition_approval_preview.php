<?php 
include('check_permission.php');
$error="";
if(isset($_POST['submit']))
{

	  require_once('processors/approval.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('includes/meta_description.php');?>
<style>
.select1 {
    border: 1px solid #DDD;
    border-radius: 5px;
    box-shadow: 0 0 0px #888;
    color: #666;
    float: left;
    padding: 8px 5px 5px 10px;
    width: 38%;
    outline: none;
}
</style>
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
                <h5><i class="fa fa-warning"></i> Approval Stage</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Items List</h6></div>
						 <form class="form-horizontal" action="requisition_approval_preview.php" method="POST">
                        <table class="table table-bordered table-striped datatable-selectable">
                                    <thead>
									  <tr>
                                            <td colspan="6" align="right"><a href="">View Approval List</a></td>
                                        </tr>
                                        <tr>
                                            <th width="8%">#</th>
                                            <th width="29%">Item Name</th>
                                            <th width="17%">Category</th>
                                            <th width="22%">SubCategory</th>
											<th width="24%">Requested Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
                                require_once('includes/db_conn.php');
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
                                            <td><?php echo $counter;?></td>
                                           <td><?php echo $result['item_name'];?></td>
                                           <td><?php echo $result['category_name'];?></td>
                                           <td><?php echo $result['subcategory_name'];?></td>
										   <td align="center"><?php echo $result['requested_quantity'];?></td>
                                        </tr>
										<?php
										$counter++;
								}
								?>
                                        <tr bgcolor="black">
                                            <td colspan="6"><font color="white">Approval Section</font></td>
                                        </tr>
										<tr bgcolor="white">
                                            <td colspan="6"></td>
                                        </tr>
                                        <tr>
                                            <td>Approval</td>
                                            <td colspan="4"><select name="approve" class="select1" required>
                                                <option value="">Select</option>
                                                <option value="1">Yes</option>
                                                  <option value="2">No</option>
                                </select></td>
                                        </tr>
										  <tr>
                                            <td>Remarks</td>
                                            <td colspan="4"><label>
                                              <textarea name="remarks" class="limited form-control" cols="45" rows="5" placeholder="Add any remark"></textarea>
                                            </label></td>
                                        </tr>
										  <tr>
										    <td>&nbsp;</td>
										    <td colspan="4"><button class="btn btn-warning" name="submit" type="submit">Submit</button>
											<input name="action" type="hidden" value="add" />
											<input name="id" type="hidden" value="<?php echo $getID;?>"/>
											<input name="user_id" type="hidden" value="<?php echo $arraylogUser['user_id'];?>"/>
											</td>
								      </tr>
										  <tr>
										    <td>&nbsp;</td>
										    <td colspan="4">&nbsp;</td>
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
