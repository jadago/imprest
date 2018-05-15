<?php 
   include('check_permission.php');
   require_once('includes/db_conn.php');
   
   $select = "SELECT * FROM users WHERE user_id = '".$arraylogUser['user_id']."'";
   $query = mysqli_query($con,$select);
   $array = mysqli_fetch_array($query);
   
   if ( isset($_POST['Submit'])) require('processors/profile_edit.php');
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
                <h5><i class="fa fa-warning"></i> My Departments</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-8">
                 <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
                     <table class="table table-bordered table-striped datatable-selectable">
                                    <tbody>
                                        <tr>
                                            <td class="col-sm-4">Staff Name</td>
                                            <td><?php echo $array['firstname']." ".$array['lastname'];?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-4">Email</td>
                                            <td><?php echo $array['email'];?></td>
                                            
                                        </tr>
										<tr>
                                            <td colspan="4"><strong>Departments Associated</strong></td>                                            
                                        </tr>
										<?php
										$count = 1;
										$department = "SELECT * FROM departments ORDER BY department_name ASC";
										$querydepartment = mysqli_query($con,$department);
										while($result = mysqli_fetch_array($querydepartment))
										{
										$check = "SELECT access_id, department_id, user_id FROM associated_department WHERE department_id = '".$result['department_id']."' AND user_id = '".$array['user_id']."'";
		                                $querycheck = mysqli_query($con,$check);
		                                $rowcheck = mysqli_num_rows($querycheck);
										?>
										<tr>
                                            <td class="col-sm-4 text-right"><input type="checkbox" class="styled" name="department<?php echo $count;?>" value="<?php echo $result['department_id'];?>"<?php if ( $rowcheck > 0 ) echo "checked=\"checked\""; ?>
											 />
											
											</td>
                                            <td><?php echo $result['department_name'];?></td>  
                                        </tr>
                                        <?php 
										$count++;
										}
										?>
										 <tr>
                                            <td class="col-sm-4"></td>
											<input name="total" type="hidden" value="<?php echo $count; ?>" />
											<input type="hidden" name="id" id="hiddenField" value="<?php echo $array['user_id'];?>" />
                                            <td><button class="btn btn-warning" type="submit" name="Submit">Update</button></td>
                                            
                                        </tr>
										
                                    </tbody>
                                </table>
								</form>
                    <!-- /default datatable inside panel -->

                </div>
            </div>
            <!-- /form validation -->
            <!-- /modal with table -->
			<!-- Footer -->
			<br/>
			<br/>
			<br/>
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
