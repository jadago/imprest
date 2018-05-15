<?php 
include('check_permission.php');
header("refresh:30;");
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
                <h5><i class="fa fa-warning"></i> Lab Results</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Pending Laboratory Result</h6></div>
                        <div class="datatable">
                            <table class="table">
                                <thead>
				
                                    <tr>
                                        <th>#</th>
                                        <th>Patient's Name</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Phone #</th>
                                       
					<th>Action</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody>
        <?php
	$counter=1;
	$today=date('Y-m-d'); 
	$select="SELECT * FROM patient WHERE stage='6' AND reg_no IN (SELECT reg_no FROM registration WHERE reg_no > 0 ) ORDER BY userid DESC";
	$query=mysqli_query($con,$select);
	while($array=mysqli_fetch_array($query))
	{
	//get patient data
	$patient="SELECT * FROM registration WHERE reg_no='".$array['reg_no']."'";
	$queryPatient=mysqli_query($con,$patient);
	$arrayPatient=mysqli_fetch_array($queryPatient);
	
	//check if lab result is out already
	$select10="SELECT test_category,specimen,recommend FROM lab_payment WHERE reg_no='".$array['reg_no']."' GROUP BY test_category";
	$query10=mysqli_query($con,$select10);
	$array10=mysqli_fetch_array($query10);
	
	?>		
                                    <tr>
                                        <td><?php  echo $counter;?></td>
					<td><?php echo $arrayPatient['fname']." ".$arrayPatient['mname']." ".$arrayPatient['lname'];?></td>
                                        <td><?php if($arrayPatient['sex']==1) echo "Male"; else echo "Female";?></td>
                                        <td><?php echo $arrayPatient['birth_date'];?></td>
                                        <td><?php echo $arrayPatient['p_number'];?></td>
                                       
                                        <td><a href="pending_results_assign.php?id=<?php echo $array['userid'];?>&tarehe=<?php echo $array['date'];?>"><span class="label label-success">Send to Doctor</span></a></td>
                                        <td><a href="pending_results.php?value=1&id=<?php echo $array['userid'];?>"><span class="label label-danger">Delete</span></a></td>
					
                                        
                                        
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
             <script>
	  angular.module("myapp",[])
	  
	  .controller("Title",function($scope)
	  {
	  $scope.title="Hellow Mr. Justine";
	  });
	  </script>


</body>
</html>
