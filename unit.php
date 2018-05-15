<?php
include('check_permission.php');

$error="";
$ok="";
if(isset($_POST['Submit']) || isset($_POST['update']))
{
    require_once('processors/unit.php');
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
                <h5><i class="fa fa-warning"></i> Unit Administration</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-6">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Unit of Measure</h6></div>
                        <div class="datatable">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Unit Name</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                require_once('includes/db_conn.php');
                                $counter=1;
                                $getcategory = "SELECT * FROM unit ORDER BY unit_name ASC";
                                $query = mysqli_query($con,$getcategory);
                              while($result = mysqli_fetch_array($query))  
                                {
                                ?>
                                    <tr id="<?php if( $counter % 2 != 0 ) echo "1"; else echo "2"; ?>">
                                        <td><?php echo $counter;?></td>
                                        <td><?php echo $result['unit_name'];?></td>
                                        <td><?php if($result['status']==1) echo "Active";else echo "Inactive";?></td>
										<td><a data-toggle="modal" role="button" href="#edit_modal" data-book-id="<?php echo $result['unit_id'];?>"><span class="label label-danger">Edit</span></a></td>
                                        
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
				<div class="col-md-6">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-success">
                        <div class="panel-heading"><h6 class="panel-title">Unit Add</h6></div>
						
                        <!-- Form validation -->
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
                
                    
                    <div class="panel-body">
                            <?php echo $error;?><?php echo $ok;?>
                        <div class="form-group">
                            <label class="col-sm-4 control-label">Unit Name:</label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="uname" id="uname" required>
                            </div>
                        </div>
                        <br/>
                        <br/>
                        <br/>
                        <br/>

                        <div class="form-group">
						<label class="col-sm-4 control-label"></label>
                            <div class="col-sm-6">
                                <input type="submit" value="Submit form" class="btn btn-primary" name="Submit">
                                 <input name="action" type="hidden" value="add" />
                            </div>
                        </div>

                    </div>
                    
               
            </form>
                    </div>
                    <!-- /default datatable inside panel -->

                </div>
            </div>
            <!-- /form validation -->
 <!-- Details Modal with table -->
				<!-- End of details Modal -->
				
				 <!-- Start of editing Modal -->
		 <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
            <div id="edit_modal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title">Update Modal</h5>
                        </div>

                        <div class="modal-body has-padding">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h6 class="panel-title">Unit Detail</h6></div>
                                <table class="table table-bordered table-striped datatable-selectable">
                                    <tbody>
                                        <tr>
                                            <td class="col-sm-4">Unit Name</td>
                                            <td><input type="text" class="form-control" id="name_edit" name="uedit"></td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-4">Status</td>
                                            <td><input type="text" class="form-control" id="status_edit" name="sedit"></td>
                                            
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
						  <div class="modal-footer">
						  <button class="btn btn-primary" type="submit" name="update">Update</button>
                           <button class="btn btn-warning" data-dismiss="modal">Close</button>
						   <input type="hidden" name="action" value="edit">
						   <input type="hidden" id="unit_id" name="id">
							
                            
                        </div>
                    </div>
                </div>
				</div>
				</form>
				<!-- End of details Modal -->

            <!-- Footer -->
            <div class="footer">
                <?php include('includes/footer.php');?>
            </div>
            <!-- /footer -->

        
        </div>
        <!-- /page content -->

    </div>
    <!-- page container -->
	<script>

//Editing Modal script
	$('#edit_modal').on('show.bs.modal', function(e) {
    var bookId = $(e.relatedTarget).data('book-id'); //this capture the row id
	//alert(bookId);
	var param = 'unit_id=' +bookId;
	//alert(param);
	
	//alert(param);
    $.ajax({
                
                url: 'unit_ajax.php',
                data: param,
                dataType: 'json',
                cache: false,
                type: 'GET',
                success: function(response){
					//display data to the modal
                    $("#name_edit").val(response.name);	
                    $("#status_edit").val(response.status);	
                    $("#unit_id").val(response.unit_id);						
            }
            });
   
    //$(e.currentTarget).find('input[name="bookId"]').val(bookId);
});
	</script>
</body>
</html>
