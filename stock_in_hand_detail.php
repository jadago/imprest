<?php 
include('check_permission.php');
$error="";
require_once('includes/db_conn.php');

$item = "SELECT * FROM item WHERE id='$_GET[itemid]'";
$queryitem = mysqli_query($con,$item);
$arrayitem = mysqli_fetch_array($queryitem);
//select category
$cat="SELECT * FROM item_category WHERE category_id='".$arrayitem['category']."'";
$querycat = mysqli_query($con,$cat);
$arraycat = mysqli_fetch_array($querycat);

//select sub category
$sub="SELECT * FROM subcategory WHERE id='".$arrayitem['subcategory']."'";
$querysub = mysqli_query($con,$sub);
$arraysub = mysqli_fetch_array($querysub);

//find unit
$unit = "SELECT * FROM unit WHERE unit_id='".$arrayitem['unit']."'";
$queryunit = mysqli_query($con,$unit);
$arrayunit = mysqli_fetch_array($queryunit);


//items
$r = '$_GET[itemid]';


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
                <h5><i class="fa fa-warning"></i> Stock Details</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
                        <div class="row">
                <div class="col-md-12">
				<table class="table table-bordered table-striped datatable-selectable">
				<tbody>
				<tr>
                <td colspan="4" align="right"><a href="stock_in_hand.php"><span class="label label-success">View Stock inHand</span></a></td>                                            
                </tr>
				</tbody>
				</table>
                
                    <!-- Justified tabs -->
                                     
                                        <div class="well widget">
                                            <div class="tabbable">
                                                <ul class="nav nav-tabs nav-justified">
                                                    <li class="active"><a href="#justified-tab1" data-toggle="tab">General</a></li>
                                                    <li><a href="#justified-tab2" data-toggle="tab">Receiving History</a></li>
													<li><a href="#justified-tab3" data-toggle="tab">Issuing History</a></li>
                                                   
                                                </ul>

                                                <div class="tab-content has-padding">
                                                    <div class="tab-pane fade in active" id="justified-tab1">
                                                         <table class="table table-bordered table-striped datatable-selectable">
                                    <tbody>
                                        <tr>
                                            <td class="col-sm-2">Item Name</td>
                                            <td><?php echo $arrayitem['item_name'];?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-sm-2">Category</td>
                                            <td><?php echo $arraycat['category_name'];?></td> 
                                        </tr>
                                             <tr>
                                            <td class="col-sm-2">Subcategory</td>
                                            <td><?php echo $arraysub['subcategory_name'];?></td> 
                                        </tr>
                                        <tr>
                                            <td class="col-sm-2">Unit</td>
                                            <td><?php echo $arrayunit['unit_name'];?></td> 
                                        </tr>
                                         <tr>
                                            <td class="col-sm-2">Unit Price</td>
                                            <td><?php echo $arrayitem['unit_price'];?></</td> 
                                        </tr>
 <tr>
                                            <td class="col-sm-2">Re-ordering Level</td>
                                            <td><?php echo $arrayitem['reordering_point'];?></</td> 
                                        </tr>
 <tr>
                                            <td class="col-sm-2">inStock</td>
                                            <td><?php echo $arrayitem['stock'];?></</td> 
                                        </tr>										
                                    </tbody>
                                </table>
                                                    </div>

                                                    <div class="tab-pane fade" id="justified-tab2">
                                                         <div class="datatable">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th>Sub category</th>
										<th>Quantity</th>
										<th>Received Date</th>
										<th>Reference Tender</th>
										<th>Description</th
                                    ></tr>
                                </thead>
                                <tbody>
								<?php
                                require_once('includes/db_conn.php');
                                $counter=1;
                                $getitem = "SELECT stock_item.*, item_category.*,subcategory.* FROM stock_item  
                                            INNER JOIN item_category ON stock_item.category = item_category.category_id
											INNER JOIN subcategory ON stock_item.subcategory = subcategory.id

								            WHERE stock_item.item ='$_GET[itemid]' ";
                                $query = mysqli_query($con,$getitem);
							
                              while($result = mysqli_fetch_array($query))  
                                {
									
                                ?>
                                    <tr id="<?php if( $counter % 2 != 0 ) echo "1"; else echo "2"; ?>">
                                        <td><?php echo $counter;?></td>
                                        <td><?php echo $result['category_name'];?></td>
                                        <td><?php echo $result['subcategory_name'];?></td>
										<td><?php echo $result['quantity'];?></td>
										<td><?php echo date("d M Y", strtotime($result['received_date']));?></td>
										<td><?php echo $result['reference_tender'];?></td>
										<td><?php echo $result['description'];?></td>
                                    </tr>
									<?php
									$counter++;
								    }
								?>   
                                </tbody>
                            </table>
                        </div>
                                                    </div>
													<div class="tab-pane fade" id="justified-tab3">
                                                        <div class="datatable">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Requested Quantity</th>
                                        <th>Supplied Quantity</th>
                                        <th>Remarks</th>
										<th>Date Issued</th>
										<th>Department</th>
                                    </tr>
                                </thead>
                                <tbody>
								<?php
                              require_once('includes/db_conn.php');
                                $counter1=1;
                                $select = "SELECT * FROM requisition_detail WHERE item ='$_GET[itemid]'";
                                $queryselect = mysqli_query($con,$select);
                              while($array = mysqli_fetch_array($queryselect))  
                                {
									//get date issue
									
									$issue = "SELECT * FROM  issuing_items WHERE item_id='".$array['item']."'";
									$queryissue = mysqli_query($con,$issue);
									$arrayissue = mysqli_fetch_array($queryissue);
									
									//$orderID = $arrayissue['requisition_id'];
									
									$req = "SELECT * FROM requisition WHERE requisition_id='".$array['requisition_id']."'";
									$queryreq = mysqli_query($con,$req);
									$arrayreq = mysqli_fetch_array($queryreq);
									
									//choose department
									$department = "SELECT * FROM departments WHERE department_id = '".$arrayreq['department']."'";
									$querydepartment = mysqli_query($con,$department);
									$arraydepartment = mysqli_fetch_array($querydepartment);
								
									
                                ?>
                                    <tr id="<?php if( $counter1 % 2 != 0 ) echo "1"; else echo "2"; ?>">
                                        <td align="center"><?php echo $array['requested_quantity'];?></td>
                                        <td align="center"><?php echo $array['supplied_quantity'];?></td>
                                        <td><?php echo $arrayissue['remarks'];?></td>
										<td><?php echo date("d M Y", strtotime($arrayissue['timeadded']));?></td>
										<td><?php echo $arraydepartment['department_name'];?></td>
                                    </tr>
									<?php
									$counter1++;
								    }
								?>   
                                </tbody>
                            </table>
                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                </div>
            </div>
            <!-- /form validation -->
			
			            <!-- Modal with table -->
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
