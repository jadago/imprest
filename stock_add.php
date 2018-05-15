<?php 
include('check_permission.php');
$error="";
$ok="";
if(isset($_POST['Submit']))
{
    require_once('processors/stock.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('includes/meta_description.php');?>
<script type="text/javascript" src="ajax_inner.js"></script>
<style>
.entry:not(:first-of-type)
{
    margin-top: 10px;
}

.glyphicon
{
    font-size: 12px;
}

td {
 padding:2px;   
}
</style>
<style>
.select3 {
    border: 1px solid #DDD;
    border-radius: 5px;
    box-shadow: 0 0 0px #888;
    color: #666;
    float: left;
    padding: 8px 5px 5px 10px;
    width: 34%;
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
                <h5><i class="fa fa-warning"></i> Stock Receiving</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="panel panel-info">
                    <div class="panel-heading"><h6 class="panel-title">Register Stock Items</h6></div>
                    <div class="panel-body">

                       <?php echo $error;?><?php echo $ok;?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Receiving Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="receiving_date" required>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-sm-2 control-label">Item Name</label>
                            <div class="col-sm-10">
                                <select  class="select3"  name="item_name" required>
                                    <option value="">Select</option>
									<?php 
									require_once('includes/db_conn.php');
									$select = "SELECT * FROM item ORDER BY item_name ASC";
		                            $result = mysqli_query($con,$select);
									while ( $arraycategory = mysqli_fetch_array($result))
									{
									?>
                                    <option value="<?php echo $arraycategory['id']; ?>"><?php echo $arraycategory['item_name'];?></option>
									<?php
									}
									?>
                                </select>
								
                            </div>
                        </div>  
						<div class="form-group">
                            <label class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" name="quantity" required>
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 control-label">Reference Tender</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="tender">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Supplier Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="supplier">
                            </div>
                        </div>
						<div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-4">
                                <textarea rows="5" cols="5" class="limited form-control" placeholder="Limited to 100 characters" name="detail"></textarea>
                            </div>
                        </div>
						
						<br>
						<br>
                        <div class="form-group">
						<label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" value="Submit" class="btn btn-primary" name="Submit">
								 <input type="submit" value="Cancel" class="btn btn-warning">
								  <input name="action" type="hidden" value="add" />
                            </div>
                        </div>
						

                    </div>
                    
                </div>
            </form>
            <!-- /form validation -->


            <!-- Footer -->
            <div class="footer">
                <?php include('includes/footer.php');?>
            </div>
            <!-- /footer -->

        
        </div>
        <!-- /page content -->

    </div>
    <!-- page container -->
	
<script type="text/javascript">
$(function()
{
    $(document).on('click', '.btn-add', function(e)
    {
        e.preventDefault();

        var controlForm = $(this).closest('table'),
            currentEntry = $(this).parents('tr:first'),
            newEntry = $(currentEntry.clone()).appendTo(controlForm);

        newEntry.find('input').val('');
        controlForm.find('tr:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="glyphicon glyphicon-minus gs"></span>');
    }).on('click', '.btn-remove', function(e)
    {
		$(this).parents('tr:first').remove();

		e.preventDefault();
		return false;
	});
});

	</script>	
	

</body>

</html>
