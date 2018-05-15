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
                <h5><i class="fa fa-warning"></i> Stock Taking as of --- <?php $date = date('Y-m-d');?><?php echo date("d M Y", strtotime($date));?></h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
                
                    <!-- Default datatable inside panel -->
                    <div class="panel panel-info">
                    
                      <div class="panel-heading"><h6 class="panel-title"><a href="stock_taking_word.php" title="Export to Excel"><img src="images/word.png" width="23" height="21"></a></h6>
                      </div>
                        
                      <table class="table table-bordered " width="80%">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Description of Items</th>
                                          <th width="12%">Units</th>
                                             <th width="11%">System Count</th>
                                             <th width="37%">Status/Condition</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
                                require_once('includes/db_conn.php');
								$keepname=isset($keepname) ? $keepname:'';
                                $counter=1;
	                            $getitem = "SELECT * FROM item ORDER BY category ASC";		
                                $query = mysqli_query($con,$getitem);
                              while($result = mysqli_fetch_array($query))  
                                {
								
								  $cat = "SELECT * FROM item_category WHERE category_id='".$result['category']."'";
								  $querycat = mysqli_query($con,$cat);
								  $arraycat = mysqli_fetch_array($querycat);
								  //get unit
								  $unit = "SELECT * FROM unit WHERE unit_id = '".$result['unit']."'";
								  $queryunit = mysqli_query($con,$unit);
								  $arrayunit = mysqli_fetch_array($queryunit);
								  
								 $fullname = $arraycat['category_name'];
	                             if($fullname != $keepname)
                                  {
									
                                ?>
                                   
<tr bgcolor="#FFCCFF">
                                            <td colspan="5"><font size="+2"><?php echo $fullname;?></font></td>
                                      </tr>
                                      <?php
									  }
									  ?>
<tr>
  <td width="3%"><?php echo $counter." .";?></td>
  <td width="37%"><?php echo $result['item_name'];?></td>
  <td align="center"><?php echo $arrayunit['unit_name'];?></td>
  <td align="center"><?php echo number_format($result['stock']);?></td>
  <td><?php if($result['status']) echo $result['status']; else echo "-";?></td>
</tr>
	<?php
	$counter++;
	$keepname= trim($fullname );
	}
 ?>
                                    </tbody>
                                </table>
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

</body>
</html>
