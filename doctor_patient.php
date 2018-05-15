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
                <h5><i class="fa fa-warning"></i> Doctors against Patient</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Doctors Vs Patients</h6></div>
                        <div class="datatable">
                            <table class="table">
                                <thead>
				
                                    <tr>
                                        <th>#</th>
                                        <th>Patient's Name</th>
                                         <th>Gender</th>
                                          <th>Age</th>
                                        <th>Phone #</th>
                                        <th>Doctor Name</th>
					<th>Status</th>

                                    </tr>
                                </thead>
                                <tbody>
      <?php
	$counter=1;
	$today=date('Y-m-d');
	//if($_POST['d'] > 0) $view="AND doctor_id IN(SELECT userid FROM users WHERE userid='".$_POST['d']."')"; else $view="";
	
	$select="SELECT * FROM patient WHERE userid > 0 AND date='$today' ORDER BY userid DESC";
	$query=mysqli_query($con,$select);
	while($array=mysqli_fetch_array($query))
	{
	//get patient names
	$patient="SELECT * FROM registration WHERE reg_no='".$array['reg_no']."'";
	$queryPatient=mysqli_query($con,$patient);
	$arrayPatient=mysqli_fetch_array($queryPatient);
	
	//check if lab result is out already
	$select10="SELECT test_category,specimen,recommend FROM lab_payment WHERE reg_no='".$array['reg_no']."' GROUP BY test_category";
	$query10=mysqli_query($con,$select10);
	$array10=mysqli_fetch_array($query10);
	
	//get doctors
	$doc1 = "SELECT * FROM users WHERE userid='".$array['doctor_id']."'";
	$querydoc1 = mysqli_query($con,$doc1);
	$arraydoc1 = mysqli_fetch_array($querydoc1);
	
	?>				
                                    <tr>
                                        <td><?php  echo $counter;?></td>
					<td><?php echo $arrayPatient['fname']." ".$arrayPatient['mname']." ".$arrayPatient['lname'];?></td>
                                        <td><?php if($arrayPatient['sex']==1) echo "Male"; else echo "Female";?></td>
                                        <td><?php echo $arrayPatient['birth_date'];?></td>
                                        <td><?php echo $arrayPatient['p_number'];?></td>
                                        <td><b><?php echo $arraydoc1['firstname']." ".$arraydoc1['lastname'];?></b></td>
					<td><span class="label label-danger"><?php if($array['stage']==2) echo "Nursing Section";
                                         elseif($array['stage']==3) echo "Doctor Section";
                                         elseif($array['stage']==4) echo "Billing Section";
                                         elseif($array['stage']==5) echo "Laboratory Section";
                                         elseif($array['stage']==6) echo "Laboratory Section";
                                         elseif($array['stage']==7) echo "Doctor Section";
                                         elseif($array['stage']==8) echo "Billing Section";
                                         elseif($array['stage']==9) echo "Pharmacy Section";
                                         elseif($array['stage'] > 9) echo "Already attended";
                                            
                                            ?></span></td>
					
                                        
                                        
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
