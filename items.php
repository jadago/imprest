<?php 
include('check_permission.php');
$error="";
if(isset($_POST['update']))
{

	  require_once('processors/items.php');
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
                <h5><i class="fa fa-warning"></i> Items Details</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Items - Administration</h6></div>
                        <div class="datatable">
                            <table class="table">
                                <thead>
								<tr>
                                        <td colspan="2"><a href="upload.php"><span class="label label-danger">Upload Stock Taking</span></a></td>
										<td><?php echo $error;?></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td><a href="items_add.php"><span class="label label-success">Register New Item</span></a></td>
                                    </tr>
                                    <tr>
                                        <th>#</th>
										<th>Item Name</th>
                                        <th>Category</th>
                                        <th>Sub category</th>
                                        <th>Unit</th>
										<th>Unit Price</th>
										<th>Available Stock</th>
										<th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
                                require_once('includes/db_conn.php');
                                $counter=1;
                                $getitem = "SELECT item.*,item.id AS itemid, item_category.*,subcategory.*,unit.* FROM item  
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
										<td align="center"><a data-toggle="modal" role="button" href="#edit_modal" data-book-id="<?php echo $result['itemid'];?>"><span class="label label-danger">Edit</span></a></td>
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
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
            <div id="edit_modal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title">Updating Records</h5>
                        </div>

                        <div class="modal-body has-padding">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h6 class="panel-title">Items Update</h6></div>
                                <table class="table table-bordered table-striped datatable-selectable">
                                    <tbody>
                                        <tr>
                                            <td class="col-sm-4">Item Name</td>
                                            <td><input type="text" class="form-control" name="iname" id="itemname_"></td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-4">Unit Price</td>
                                            <td><input type="text" class="form-control" name="price" id="price_"></td>
                                            
                                        </tr>
										<tr>
                                            <td class="col-sm-4">Re-ordering Level</td>
                                            <td><input type="text" class="form-control" name="point_order" id="order_"></td>
                                   
                                        </tr>
										<tr>
                                            <td class="col-sm-4">Available Stock</td>
                                            <td><input type="text" class="form-control" name="stock" id="stock_"></td>
                                   
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
						  <div class="modal-footer">
						  <button class="btn btn-primary" type="submit" name="update">Update</button>
                           <button class="btn btn-warning" data-dismiss="modal">Close</button>
						   <input type="hidden" name="action" value="edit">
						   <input type="hidden" id="item_id" name="id"> 
                        </div>
                    </div>
                </div>
				</div>
				</form>
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
    <script>
	//Editing Modal script
	$('#edit_modal').on('show.bs.modal', function(e) {
    var bookId = $(e.relatedTarget).data('book-id'); //this capture the row id
	//alert(bookId);
	var param = 'item_id=' +bookId;
	
	//alert(param);
    $.ajax({
                
                url: 'item_ajax.php',
                data: param,
                dataType: 'json',
                cache: false,
                type: 'GET',
                success: function(response){
					//display data to the modal
                    $("#itemname_").val(response.itemname);
                    $("#price_").val(response.price);	
                    $("#order_").val(response.order);
                    $("#stock_").val(response.stock);	
					$("#item_id").val(response.item_id);				
			
			

		
            }
            });
   
    //$(e.currentTarget).find('input[name="bookId"]').val(bookId);
});


	</script>

</body>
</html>
