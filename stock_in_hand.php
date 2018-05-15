<?php 
include('check_permission.php');
$error="";
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
                <h5><i class="fa fa-warning"></i> Stock Details</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Stock in Hand</h6></div>
                        <div class="datatable">
                            <table class="table">
                                <thead>
								<tr>
                                        <td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><?php echo $error;?></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <th>#</th>
										<th>Item Name</th>
                                        <th>Category</th>
                                        <th>Sub category</th>
                                        <th>Unit</th>
										<th>Unit Price</th>
										<th>inStock</th>
										<th>Reordering</th>
										<th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
                                require_once('includes/db_conn.php');
                                $counter=1;
                                $getitem = "SELECT item.*, item_category.*,subcategory.id AS subID,subcategory.subcategory_name,subcategory.category,unit.* FROM item  
                                            INNER JOIN item_category ON item.category = item_category.category_id
											INNER JOIN subcategory ON item.subcategory = subcategory.id
											INNER JOIN unit ON item.unit = unit.unit_id 

								            ORDER BY item_name ASC";
                                $query = mysqli_query($con,$getitem);
                              while($result = mysqli_fetch_array($query))  
                                {
									
                                ?>
                                    <tr id="<?php if( $counter % 2 != 0 ) echo "1"; else echo "2"; ?>">
                                        <td><?php echo $counter;?></td>
                                        <td><?php echo $result['item_name'];?></td>
                                        <td><?php echo $result['category_name'];?></td>
                                        <td><?php echo $result['subcategory_name'];?></td>
										<td><?php echo $result['unit_name'];?></td>
										<td><?php echo $result['unit_price'];?></td>
										<td align="center"><?php echo $result['stock'];?></td>
										<td align="center"><?php echo $result['reordering_point'];?></td>
										<td align="center"><a href="stock_in_hand_detail.php?itemid=<?php echo $result['id'];?>"><span class="label label-success">View</span></a></td>
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
			
			            <!-- Modal with table -->
            <div id="table_modal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title">Modal with table</h5>
                        </div>

                        <div class="modal-body has-padding">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h6 class="panel-title">Table inside modal</h6></div>
                                <table class="table table-bordered table-striped datatable-selectable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
											<th>Pass</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
											 <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
											 <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
											 <td>@twitter</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                

                        <div class="modal-footer">
                            <button class="btn btn-warning" data-dismiss="modal">Close</button>
							<button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /modal with table -->
			<!-- Footer -->
            <div class="footer">
                <?php include('includes/footer.php');?>
            </div>
            <!-- /footer -->
                    </div>
                </div>

            <!-- /modal with table -->


            

    
        <!-- /page content -->

    <!-- page container -->

</body>
</html>
