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
                <h5><i class="fa fa-warning"></i> Nursing Station</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Patient's Clinical Procedures</h6></div>
                        <div class="datatable">
                            <table class="table">
                                <thead>
                                    <tr>
                                        
					<td colspan="2"><a href="nursing_view.php"><span class="label label-default"><< Back Home</span></a></td>
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
                                        <th>Procedures</th>
                                    </tr>
                                </thead>
                                <tbody>
     <?php
	$counter=1;
	$today=date('Y-m-d');
	$select="SELECT * FROM clinic WHERE service_type='2' AND date='$today' ORDER BY id ASC";
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
                                        <td><?php
                                        $cost = "SELECT * FROM clinic_payment WHERE reg_no='".$array['reg_no']."'";
                                        $querycost = mysqli_query($con,$cost);
                                        while($arraycost = mysqli_fetch_array($querycost))
                                        {
                                            //get service names 
                                            $service = "SELECT * FROM clinic_service WHERE id='".$arraycost['service']."'";
                                            $querys = mysqli_query($con,$service);
                                            $arrays = mysqli_fetch_array($querys );
                                            
                                            
                                            echo "* ".$arrays['name']."<br/>";
                                        }
                                        
                                        ?></td>
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
