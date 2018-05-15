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
                                        <th>&nbsp;</th>
					<th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>

                                    </tr>
                                </thead>
                                <tbody>
       <?php
	$counter=1;
	require_once('includes/db_conn.php');
	$today=date('Y-m-d');
	$select="SELECT * FROM patient WHERE (stage > 2 AND stage < 42) AND date='$today' AND doctor_id='".$arraylogUser['userid']."' ORDER BY userid DESC";
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
                                        <td><?php if($array['stage'] == 3 ){?><a href="doctor_attend.php?id=<?php echo $arrayPatient['reg_no'];?>&patient_id=<?php echo $array['userid'];?>"><b>Attend</b></a><?php }else { echo "<b>Already attended</b>";}?></td>
                                        <td><?php if($array['stage'] == 6 && $array10['test_category']==1){?><a href="lab_result.php?id=<?php echo $arrayPatient['reg_no'];?>&patient_id=<?php echo $array['userid'];?>"><b>Lab/imaging results</b></a><?php } elseif($array['stage'] == 5) { echo "<b>Results waiting</b>"; } elseif($array['stage'] > 6 && $array['stage'] < 10 && $array10['test_category']==1) { echo "<b>Result already done</b>"; } elseif($array['stage'] == 15) { echo "";} else { echo ""; }?></td>
					<td><?php if($array['stage'] == 6 && $array10['test_category']==2){?>
                                            <a href="imaging_result.php?id=<?php echo $arrayPatient['reg_no'];?>&patient_id=<?php echo $array['userid'];?>"><b>Imaging</b></a>
                                         <?php } elseif($array['stage'] == 5 && $array10['test_category']==2) { echo "<b>Imaging result waiting</b>"; } elseif($array['stage'] > 6 && $array['stage'] < 10 && $array10['test_category']==2) { echo "<b>Imaging result already done</b>"; } else { echo "";}?></td>
                                        <td><?php if($array['stage'] < 7 || $array['stage'] ==10 || $array['stage'] ==15 || $array['stage'] ==40){?><a href="prescription.php?id=<?php echo $arrayPatient['reg_no'];?>&patient_id=<?php echo $array['userid'];?>"><b>Prescription</b></a><?php }?></td>
                                        <td><?php if($array['stage'] == 17){?>
                                            <a href="prescription_edit.php?id=<?php echo $arrayPatient['reg_no'];?>&patient_id=<?php echo $array['userid'];?>"><b>Prescription</b></a>
                                        <?php }?></td>
                                        <td><a href="history.php?id=<?php echo $array['reg_no'];?>"><b>History</b></a></td>
                                        <td><a href="patient_doctor_view.php?value=1&id=<?php echo $array['userid'];?>"><?php if($array['stage'] == 40) {?>Reset<?php }?></a></td>
                                        
                                        
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
