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
                <h5><i class="fa fa-warning"></i> Approval Detail</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Requisitions List</h6></div>
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
										<td align="center">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <th>#</th>
										<th>Requester</th>
                                        <th>Request Date</th>
                                        <th>Department</th>
                                        <th>Status</th>
										<th>Stage</th>
										<th>OPTION</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
                                require_once('includes/db_conn.php');
                                $counter=1;

								$request = "SELECT requisition.*,requisition.status AS sample, users.*,departments.* FROM requisition 
								            LEFT JOIN users ON requisition.addedby = users.user_id
											LEFT JOIN departments ON requisition.department = departments.department_id  WHERE requisition.department = '".$_SESSION['approve']."' AND stage > 1 ORDER BY requisition.requisition_id DESC ";			
                                $query = mysqli_query($con,$request);
                              while($result = mysqli_fetch_array($query))  
                                {
									
                                ?>
                                    <tr id="<?php if( $counter % 2 != 0 ) echo "1"; else echo "2"; ?>">
                                        <td><?php echo $counter;?></td>
										 <td><?php echo $result['firstname']." ".$result['lastname'];?></td>
                                        <td><?php echo date("d M Y", strtotime($result['submitted_date']));?></td>
                                        <td><?php echo $result['department_name'];?></td>
										<td><?php if($result['sample']==1) echo "Active"; else echo "Cancelled";?></td>
										<td><?php if($result['stage']==1) echo "Draft";elseif($result['stage']==2) echo "Approval";elseif($result['stage']==3) echo "PMU";elseif($result['stage']==4) echo "Issued";?></td>
										<td><?php if($result['stage']==2){?>
										<a href="requisition_approval_preview.php?id=<?php echo $result['requisition_id'];?>" ><span class="label label-info">Approve</span></a>
										<?php
										}
										elseif($result['stage'] > 2)
										{
											?>
											<a href="approved_preview.php?id=<?php echo $result['requisition_id'];?>" ><span class="label label-danger">Preview</span></a>
											<?php
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

</body>
</html>
