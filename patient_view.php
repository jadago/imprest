<?php 
include('check_permission.php');
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
                <h5><i class="fa fa-warning"></i> Registered Patients</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Patient's List</h6></div>
                        <div class="datatable">
                            <table class="table">
                                <thead>
					<tr>
                                        <td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><?php echo $error;?></td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                         <td>&nbsp;</td>
                                          <td>&nbsp;</td>
				       <td align="center"><a href="patient_add.php"><span class="label label-success">Register New</span></a></td>
                                    </tr>
                                    <tr>
                                        <th>#</th>
					<th>Card #</th>
                                        <th>Patient's Name</th>
                                         <th>Gender</th>
                                        <th>Phone #</th>
                                        <th>Last Attended</th>
					<th>Next of Kin</th>
					<th>ACTION</th>
                                        <th>ACTION</th>
                                        <th>ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
      <?php
	
	
	$counter=1;
	require_once('includes/db_conn.php');
	$array="SELECT * FROM registration ORDER BY reg_no DESC";
	$query=mysqli_query($con,$array);
	while($array=mysqli_fetch_array($query))
	{
            //access the patient table to get last attended date
            $last = "SELECT * FROM patient WHERE reg_no='".$array['reg_no']."' ORDER BY reg_no ASC LIMIT 1";
            $querylast = mysqli_query($con,$last);
            $arraylast = mysqli_fetch_array($querylast);
	?>				
                                    <tr>
                                        <td><?php  echo $counter;?></td>
					<td><?php echo $array['patient_card_no'];?></td>
                                        <td><?php echo $array['fname']." ".$array['mname']." ".$array['lname']."<br>"."Age :".$array['birth_date'];?></td>
                                        <td><?php if($array['sex']==1) echo "Male"; else echo "Female";?></td>
                                        <td><?php echo $array['p_number']."<br>"."Address:".$array['address'];?></td>
					<td><?php echo $arraylast['date_attended'];?></td>
					<td><?php echo $array['kin'];?></td>
                                        <td><?php
	require_once('includes/db_conn.php');
	$today = date('Y-m-d');
	$check = "SELECT * FROM patient WHERE reg_no='".$array['reg_no']."' AND date='$today' ORDER BY userid DESC";
	$querycheck = mysqli_query($con,$check);
	$arraycheck = mysqli_fetch_array($querycheck);
	if($arraycheck['stage']==1 || $arraycheck['stage']==2 || $arraycheck['stage']==3 || $arraycheck['stage']==4 || $arraycheck['stage']==5 || $arraycheck['stage']==6 || $arraycheck['stage']==7 || $arraycheck['stage']==8)
	{
	?>
	<a href='doctor_change.php?id=<?php echo $array['reg_no'];?>'><span class="label label-success">Change Doctor</span></a>
    <?php
	}
	else
	{
        ?><a href="patient_attend.php?id=<?php echo $array['reg_no'];?>"><span class="label label-info">Attend</span></a><?php  } ?></td>
                                         <td><a href="clinic.php?id=<?php echo $array['reg_no'];?>"><span class="label label-primary">Clinic</span></a></td>
                                          <td><a href="patient_view_edit.php?id=<?php echo $array['reg_no'];?>"><span class="label label-danger">Edit</span></a></td>
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
