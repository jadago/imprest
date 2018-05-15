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
                    <h5><i class="fa fa-warning"></i>Nursing Station</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
            
                        <div class="row">
                             <div class="col-md-2">
                
                    <table class="table table-bordered">
                  <tbody>
                   <tr>
                 <td><a href="clinical_procedures.php">Clinical Procedures <i class="fa fa-chevron-right"></i></a></td>
                 </tr>
                  <tr>
                   <td><a href="procedural_patient.php">Procedural Patients<i class="fa fa-chevron-right"></i></a></td>
                </tr>
   
             </tbody>
              </table>
  

                </div>
                            
                <div class="col-md-10">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Patient's List</h6></div>
                        <div class="datatable">
                            <table class="table">
                                <thead>
                                    <tr>
                                        
					<td colspan="2">&nbsp;</td>
					<td width="14%">&nbsp;</td>
                                      <td width="9%">&nbsp;</td>
                                      <td width="18%">&nbsp;</td>
				       <td width="21%">&nbsp;</td>
                                  </tr>
				
                                    <tr>
                                        <th width="8%">#</th>
                                        <th width="30%">Patient's Name</th>
                                        <th>Gender</th>
                                        <th>Age</th>
                                        <th>Phone #</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
     <?php
	$counter=1;
	$today=date('Y-m-d');
	$select="SELECT * FROM patient WHERE stage='2' AND date='$today' ORDER BY userid DESC";
	$query=mysqli_query($con,$select);
	while($array=mysqli_fetch_array($query))
	{
	//get patient data
	$patient="SELECT * FROM registration WHERE reg_no='".$array['reg_no']."'";
	$queryPatient=mysqli_query($con,$patient);
	$arrayPatient=mysqli_fetch_array($queryPatient);
	?>		
                                    <tr>
                                        <td><?php  echo $counter;?></td>
					<td><?php echo $arrayPatient['fname']." ".$arrayPatient['mname']." ".$arrayPatient['lname'];?></td>
                                        <td><?php if($arrayPatient['sex']==1) echo "Male"; else echo "Female";?></td>
                                        <td><?php echo $arrayPatient['birth_date'];?></td>
                                        <td><?php echo $arrayPatient['p_number'];?></td>
                                        <td><a href="nursing_register.php?id=<?php echo $arrayPatient['reg_no'];?>"><span class="label label-success">Attend Patient</span></a></td>
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
