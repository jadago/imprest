<?php 
include('check_permission.php');
$error="";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('includes/meta_description.php');?>
<link rel="stylesheet" type="text/css" href="tcal.css" />
<script type="text/javascript" src="tcal.js"></script>
</head>

<body>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
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
                <h5><i class="fa fa-warning"></i> Approved Imprest Report</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                    
                      <div class="panel-heading">
                        <h6 class="panel-title">Approved Imprest Report</h6>
                      </div>
					    <table class="table table-bordered " width="80%">
                                    <thead>
                                        <tr>
                                            <th>From</th>
                                            <th> <div class="col-sm-4">
                                <input type="text" class="form-control tcal" name="from" >
                            </div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                               
                                   
<tr>
                                            <td><strong>To</strong></td>
                                            <td> <div class="col-sm-4">
                                <input type="text" class="form-control tcal" name="to">
                            </div></td>
                                      </tr>
<tr>
  <td>&nbsp;</td>
  <td><div class="col-sm-4">
    <select  class="select1" name="item" style="width:300px;">
      <option value="0">All Staff</option>
      <?php 
									require_once('includes/db_conn.php');
									$item = "SELECT * FROM users WHERE department= '".$arraylogUser['department']."' ORDER BY firstname ASC";
									$queryitem = mysqli_query($con,$item);
									while ( $arrayitem = mysqli_fetch_array($queryitem))
									{
									?>
      <option value="<?php echo $arrayitem['user_id']; ?>"><?php echo $arrayitem['firstname']." ".$arrayitem['lastname'];?></option>
      <?php
									}
									?>
    </select>
  </div></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
                                      
<tr>
  <td width="3%">&nbsp;</td>
  <td> <input type="submit" name="Submit" value="Generate Report" class="btn btn-primary"></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
</tr>
                                    </tbody>
                      </table>
                      <?php
								
					  if(isset($_POST['Submit']))
		{
		?>
                        
                      <table class="table table-bordered table-striped datatable-selectable" width="80%">
                                    <thead>
                                        <tr>
                                        <td colspan="8" align="right"><a href="#">Export to Excel</a></th>                                        </tr>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Staff Name</th>
                                          <th width="11%">Request Date</th>
                                             <th width="12%">Start Date</th>
                                             <th width="14%"> End Date</th>
                                             <th width="11%">Description</th>
                                             <th width="15%">Total Amount</th>
                                             <th width="13%">Approved Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                               // require_once('includes/db_conn.php');
                                $counter=1;
								$total=0;
								$getID = isset($_GET['id']) ? $_GET['id']:'';
                                if($_POST['from'] && $_POST['to'] !="") $date="AND imprest_id IN(SELECT imprest_id FROM imprest_approval WHERE approval_date between '".$_POST['from']."' AND '".$_POST['to']."')"; else $date="";	
								if($_POST['item'] > 0) $staff = "AND addedby='".$_POST['item']."'"; else $staff="";
								
								
								 if($arraylogUser['department']==1)
                                        {
                                        $getitem = "SELECT * FROM imprest WHERE status > 3 AND addedby IN(SELECT user_id FROM users WHERE department=1)".$date."".$staff." ORDER BY imprest_id DESC";
                                        }
                                        elseif($arraylogUser['department']==2)
                                        {
                                         $getitem = "SELECT * FROM imprest WHERE status > 3 AND addedby IN(SELECT user_id FROM users WHERE department=2)".$date."".$staff." ORDER BY imprest_id DESC";  
                                        }
                                        elseif($arraylogUser['department']==3)
                                        {
                                         $getitem = "SELECT * FROM imprest WHERE status > 3 AND addedby IN(SELECT user_id FROM users WHERE department=3)".$date."".$staff." ORDER BY imprest_id DESC";  
                                        }
                                            elseif($arraylogUser['department']==4)
                                        {
                                         $getitem = "SELECT * FROM imprest WHERE status > 3 AND addedby IN(SELECT user_id FROM users WHERE department=4)".$date."".$staff." ORDER BY imprest_id DESC";  
                                        }
                                            elseif($arraylogUser['department']==5)
                                        {
                                         $getitem = "SELECT * FROM imprest WHERE status > 3 AND addedby IN(SELECT user_id FROM users WHERE department=5)".$date."".$staff." ORDER BY imprest_id DESC";  
                                        }
                                            elseif($arraylogUser['department']==6)
                                        {
                                         $getitem = "SELECT * FROM imprest WHERE status > 3 AND addedby IN(SELECT user_id FROM users WHERE department=6)".$date."".$staff." ORDER BY imprest_id DESC";  
                                        }
                                        $query = mysqli_query($con, $getitem);
                                        while ($result = mysqli_fetch_array($query)) {
                                            //get users
                                            $users = "SELECT * FROM users WHERE user_id='".$result['staff_id']."'";
                                            $query1 = mysqli_query($con,$users);
                                            $array1 = mysqli_fetch_array($query1);
                                            
                                           // get total amount
                                            $amount = "SELECT SUM(amount) AS tamount FROM imprest_item WHERE imprest_id='".$result['imprest_id']."'";
                                            $queryA = mysqli_query($con,$amount);
                                            $arrayA = mysqli_fetch_array($queryA);
											
											//get approved date
											$d = "SELECT * FROM imprest_approval WHERE imprest_id='".$result['imprest_id']."'";
											$arrayd = mysqli_fetch_array(mysqli_query($con,$d));
                                ?>
                                   
<tr>
 <td><?php echo $counter; ?></td>
                                                <td><?php echo $array1['firstname'] . " " . $array1['lastname']; ?></td>
                                                <td><?php echo date("d M Y", strtotime($result['date_requested'])); ?></td>
                                                <td><?php echo date("d M Y", strtotime($result['leaving_date'])); ?></td>
                                                <td><?php echo date("d M Y", strtotime($result['return_date'])); ?></td>
                                                <td><?php echo $result['purpose']; ?></td>
                                                <td><?php echo number_format($arrayA['tamount']); ?></td>
                                                <td><?php echo date("d M Y", strtotime($arrayd['approval_date'])); ?></td>
</tr>
<?php
$total = $total + $arrayA['tamount'];
										$counter++;
								}
								?>
<tr>
  <td colspan="6" align="right"><b>Total Approved Amount</b></td>
  <td><b><?php echo number_format($total);?></b></td>
  <td>&nbsp;</td>
</tr>
                                    </tbody>
                                </table>
                      <?php
								}
								?>
                  </div>
                    <!-- /default datatable inside panel -->

                </div>
            </div>
            <!-- /form validation -->
			
			            <!-- Modal with table -->
            <div id="table_modal" class="modal fade" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h5 class="modal-title">Modal with table</h5>
                        </div>

                        <div class="modal-body has-padding">
                            <div class="panel panel-default">
                                <div class="panel-heading"><h6 class="panel-title">Table inside modal</h6></div>
                                <table class="table table-bordered table-striped datatable-selectable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Username</th>
											<th>Pass</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Mark</td>
                                            <td>Otto</td>
                                            <td>@mdo</td>
											 <td>@mdo</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Jacob</td>
                                            <td>Thornton</td>
                                            <td>@fat</td>
											 <td>@fat</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Larry</td>
                                            <td>the Bird</td>
                                            <td>@twitter</td>
											 <td>@twitter</td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                

                        <div class="modal-footer">
                            <button class="btn btn-warning" data-dismiss="modal">Close</button>
							<button class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /modal with table -->
			<!-- Footer -->
            <div class="footer">
                <?php include('includes/footer.php');?>
            </div>
            <!-- /footer -->
                    </div>
                </div>

            <!-- /modal with table -->


            

    
        <!-- /page content -->

    <!-- page container -->
</form>
</body>
</html>
