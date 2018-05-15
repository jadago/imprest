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
                        <div class="panel-heading"><h6 class="panel-title">Procedural Patient's</h6></div>
                         <table class="table table-bordered">
    <thead>
      <tr>
        <th><a href="nursing_view.php"><span class="label label-default"><< Back Home</span></a></th>
        <th>Services</th>
        <th>Date</th>
      </tr>
    </thead>
    <tbody>
         <?php
	$counter=1;
        $keepmodal="";
	$today=date('Y-m-d');
	$select1="SELECT direct_sales_services.*, services.name AS serviceName FROM direct_sales_services LEFT JOIN services ON service = services.id WHERE date='$today' ORDER BY direct_sales_services.id DESC";
	$query1=mysqli_query($con,$select1);
	while($array1=mysqli_fetch_array($query1))
	{
		$modalname = $array1['Patient_name'];
	   if($modalname != $keepmodal)
  {
	
	?>
        <tr>
        <td colspan="3"><font size="+1">Patient Name: <?php echo $modalname;?></font></td>
        </tr>
      <?php
  }
  ?>
      <tr>
        <td>&nbsp;</td>
        <td><?php echo $array1['serviceName'];?></td>
        <td><?php echo $array1['date'];?></td>
      </tr>
      <?php
	$counter++;
	$keepmodal= trim($modalname);
	}
	?>
    </tbody>
  </table>
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
