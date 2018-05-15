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
                <h5><i class="fa fa-warning"></i> Stock Taking as of --- <?php $date = date('Y-m-d');?><?php echo date("d M Y", strtotime($date));?></h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                    
                      <div class="panel-heading"><h6 class="panel-title">Items Issuing Report</h6>
                      </div>
					    <table class="table table-bordered " width="80%">
                                    <thead>
                                        <tr>
                                            <th>From</th>
                                            <th> <div class="col-sm-4">
                                <input type="text" class="form-control tcal" name="from" style="width:200px;" >
                            </div></th>
                                            <th><div class="col-sm-4">
                                              <select  class="select1" name="department" style="width:300px;">
                                                <option value="0">Select Department</option>
                                                <?php 
									require_once('includes/db_conn.php');
									$projects = "SELECT department_id, department_name FROM departments WHERE department_id IN ( SELECT department_id FROM associated_department WHERE user_id = '".$arraylogUser['user_id']."' ) ORDER BY department_name ASC";
									$queryprojects = mysqli_query($con,$projects);
									while ( $arrayprojects = mysqli_fetch_array($queryprojects))
									{
									?>
                                                <option value="<?php echo $arrayprojects['department_id']; ?>"><?php echo $arrayprojects['department_name'];?></option>
                                                <?php
									}
									?>
                                              </select>
                                            </div></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                               
                                   
<tr>
                                            <td><strong>To</strong></td>
                                            <td> <div class="col-sm-4">
                                <input type="text" class="form-control tcal" name="to" style="width:200px;">
                            </div></td>
                                            <td><div class="col-sm-4">
                                              <select  class="select1" name="item" style="width:300px;">
                                                <option value="0">Select Items</option>
                                                <?php 
									require_once('includes/db_conn.php');
									$item = "SELECT * FROM item ORDER BY item_name ASC";
									$queryitem = mysqli_query($con,$item);
									while ( $arrayitem = mysqli_fetch_array($queryitem))
									{
									?>
                                                <option value="<?php echo $arrayitem['id']; ?>"><?php echo $arrayitem['item_name'];?></option>
                                                <?php
									}
									?>
                                              </select>
                                            </div></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="2">&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="2">&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="2">&nbsp;</td>
</tr>
                                      
<tr>
  <td width="3%">&nbsp;</td>
  <td colspan="2"> <input type="submit" name="Submit" value="Generate Report" class="btn btn-primary"></td>
  </tr>
<tr>
  <td>&nbsp;</td>
  <td colspan="2">&nbsp;</td>
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
                                        <td colspan="8" align="right"><a href="issued_word.php?from=<?php echo $_POST['from']; ?>&to=<?php echo $_POST['to']; ?>&item=<?php echo $_POST['item'];?>&department=<?php echo $_POST['department'];?>">Export to Word</a></th>                                        </tr>
                                        <tr>
                                            <th>&nbsp;</th>
                                            <th>Item Name</th>
                                          <th width="11%">Category</th>
                                             <th width="12%">Sub Category</th>
                                             <th width="14%">Requested Qty</th>
                                             <th width="11%">Supplied Qty</th>
                                             <th width="13%">Issued Date</th>
                                             <th width="15%">Requester</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                               // require_once('includes/db_conn.php');
                                $counter=1;
								$getID = isset($_GET['id']) ? $_GET['id']:'';
								if($_POST['department'] > 0) $department = "AND requisition.department IN(SELECT department_id FROM departments WHERE department_id='".$_POST['department']."')"; else $department="";
								if($_POST['from'] && $_POST['to'] !="") $date="AND (issuing_items.timeadded between '".$_POST['from']."' AND '".$_POST['to']."')"; else $date="";
								
								if($_POST['item'] > 0) $item_issued = "AND issuing_items.item_id IN(SELECT id FROM item WHERE id='".$_POST['item']."')"; else $item_issued="";
								
								
								
								

								$request = "SELECT issuing_items.*,requisition.*,requisition.addedby AS requester FROM issuing_items 
								
								LEFT JOIN requisition ON issuing_items.requisition_id = requisition.requisition_id WHERE issuing_items.issuing_id > 0 ".$department."".$date."".$item_issued."";			
                                $query = mysqli_query($con,$request);
                              while($result = mysqli_fetch_array($query))  
                                {
								 //get Items name
								 $item = "SELECT * FROM item WHERE id='".$result['item_id']."'";
								 $queryitem = mysqli_query($con,$item);
								 $arrayitem = mysqli_fetch_array($queryitem);
								 //category
								 $cat = "SELECT * FROM item_category WHERE category_id='".$arrayitem['category']."'";
								 $querycat = mysqli_query($con,$cat);
								 $arraycat = mysqli_fetch_array($querycat);
								 
								 //subcategory
								 $cat1 = "SELECT * FROM subcategory WHERE id='".$arrayitem['subcategory']."'";
								 $querycat1 = mysqli_query($con,$cat1);
								 $arraycat1 = mysqli_fetch_array($querycat1);
								 
								 //detail				 
								 $detail = "SELECT * FROM requisition_detail WHERE item ='".$arrayitem['id']."' AND requisition_id = '".$result['requisition_id']."'";
								 $querydetail = mysqli_query($con,$detail);
								 $arraydetail = mysqli_fetch_array($querydetail);
								
								 //reqiusiition			 
								 //$detail1 = "SELECT * FROM requisition WHERE requisition_id = '".$result['requisition_id']."'";
								// $querydetail1 = mysqli_query($con,$detail1);
								 //$arraydetail1 = mysqli_fetch_array($querydetail1);
								 
								 $names = "SELECT * FROM users WHERE user_id='".$result['requester']."'";
								 $querynames = mysqli_query($con,$names);
								 $arraynames = mysqli_fetch_array($querynames);
									
                                ?>
                                   
<tr id="<?php if( $counter % 2 != 0 ) echo "1."; else echo "2."; ?>">
  <td width="5%"><?php echo $counter." .";?></td>
  <td width="19%"><?php echo $arrayitem['item_name'];?></td>
  <td><?php echo $arraycat['category_name'];?></td>
  <td><?php echo $arraycat1['subcategory_name'];?></td>
  <td align="center"><?php echo  $arraydetail['requested_quantity'];?></td>
  <td align="center"><?php echo  $arraydetail['supplied_quantity'];?></td>
  <td><?php echo date("d M Y", strtotime($result['timeadded']));?></td>
  <td><?php echo $arraynames['firstname']." ".$arraynames['lastname'];?></td>
</tr>
<?php
										$counter++;
								}
								?>
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
