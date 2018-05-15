<?php 
include('check_permission.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('includes/meta_description.php');?>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<style>
#container {
	min-width: 320px;
	max-width: 600px;
	margin: 0 auto;
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
                <h5><i class="fa fa-bars"></i> Dashboard <small>Welcome, <?php echo $arraylogUser['firstname'];?></small></h5>
                <div class="btn-group">
                    <a href="#" class="btn btn-link btn-lg btn-icon dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cogs"></i><span class="caret"></span></a>
                </div>
            </div>
            <!-- /page title -->

           
            <!-- Statistics -->
            <?php
            //paid imprest
            $paid = "SELECT status,addedby,COUNT(imprest_id) AS imprest_paid FROM imprest WHERE status=5 AND addedby='".$arraylogUser['user_id']."'";
            $querypaid = mysqli_query($con,$paid);
            $arraypaid = mysqli_fetch_array($querypaid);
           
            
            //imprest retired
            $retired = "SELECT COUNT(imprest_id) AS imprest_retired FROM imprest WHERE stage=4 AND addedby='".$arraylogUser['user_id']."'";
            $queryretired = mysqli_query($con,$retired);
            $arrayretired = mysqli_fetch_array($queryretired);
            //unretired imprest
            $u= "SELECT COUNT(imprest_id) AS imprest_unretired FROM imprest WHERE status=5 AND stage < 4 AND addedby='".$arraylogUser['user_id']."'";
            $queryu = mysqli_query($con,$u);
            $arrayu = mysqli_fetch_array($queryu);
            
            ?>
            <ul class="row stats">
                <li class="col-xs-4"><a href="#" class="btn btn-default"><?php if($arraypaid['imprest_paid']) echo $arraypaid['imprest_paid'];else echo "0";?></a> <span># of Imprest Paid</span></li>
                <li class="col-xs-4"><a href="#" class="btn btn-default"><?php if($arrayretired['imprest_retired']) echo $arrayretired['imprest_retired'];else echo "0";?></a><span># of Imprest Retired</span></li>
                <li class="col-xs-4"><a href="#" class="btn btn-default"><?php if($arrayu['imprest_unretired']) echo $arrayu['imprest_unretired'];else echo "0";?></a><span># of Un-retired Imprest</span></li>
              
            </ul>
            <!-- /statistics -->
            
            
           
             
           
            <!-- Simple chart -->
           
              <!-- Simple chart -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h6 class="panel-title">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</h6>
                </div>
                <div class="panel-body">
                    <div id="graph-standard"><div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div></div> 
            
                </div>
            </div>
            <!-- /simple chart -->
            
            
                    <!-- /default datatable inside panel -->

                </div>
            </div>
         <!-- Footer -->
            <div class="footer">
			<?php include('includes/footer.php');?>
            </div>
            <!-- /footer -->
   
   
  <?php include('admin_graph.php');?>  
</body>
</html>
