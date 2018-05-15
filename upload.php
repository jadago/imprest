<?php 
include('check_permission.php');
$error="";
$ok="";
if(isset($_POST['Submit']))
{
	include 'db.php';
	
	echo $filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0)
		 {

		  	$file = fopen($filename, "r");
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {
	    
	          //It wiil insert a row to our subject table from our csv file`
	          // $sql = "INSERT into infoma (`pe`, `tender`, `details`, `method_of_procurement`,supplier, `amount`, `award_date`,published_date) 
	            //	values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]','$emapData[5]','$emapData[6]','$date')";
			
			  $sql = "UPDATE item SET stock = '$emapData[4]',status='$emapData[6]' WHERE id='$emapData[0]'";
	         //we are using mysql_query function. it returns a resource on true else False on error
	          $result = mysql_query( $sql, $conn );
				if(! $result )
				{
					echo "<script type=\"text/javascript\">
							alert(\"Invalid File:Please Upload CSV File.\");
							window.location = \"items.php\"
						</script>";
				
				}

	         }
	         fclose($file);
	         //throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location = \"items.php\"
					</script>";
	        
			 

			 //close of connection
			mysql_close($conn); 
				
		 	
			
		 }
    
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
                <h5><i class="fa fa-warning"></i> Uploading stock taking CSV file</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
                <div class="panel panel-info">
                    <div class="panel-heading"><h6 class="panel-title">Uploading</h6></div>
                    <div class="panel-body">

                       <?php echo $error;?><?php echo $ok;?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Upload the CSV File</label>
                            <div class="col-sm-4">
                                <input type="file" name="file" id="file" class="form-control">
                            </div>
                        </div>

                        
						
						
						<br>
						<br>
                        <div class="form-group">
						<label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                              
								 <input type="submit" value="Upload" class="btn btn-warning" name="Submit" >
								
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
