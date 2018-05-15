<?php
include('check_permission.php');
$value = isset($_GET['value']) ? $_GET['value'] : '';
if ($value == 1) {
    $reg_no = isset($_GET['regno']) ? $_GET['regno'] : '';
    $patients_id = isset($_GET['patients_id']) ? $_GET['patients_id'] : '';
    $item_id = isset($_GET['pre_id']) ? $_GET['pre_id'] : '';
//return the saved patient data to the normal stages
    $update1 = "DELETE FROM prescription WHERE id='$item_id'";
    $query2000 = mysqli_query($con, $update1);
    header("Location: prescription.php?id=$reg_no&patient_id=$patients_id");
    exit();
}

if (isset($_POST['Submit'])) {

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $pid = isset($_POST['patient_id']) ? $_POST['patient_id'] : '';
    $today = date('Y-m-d');
    $drug = isset($_POST['drug']) ? $_POST['drug'] : '';
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : '';
    $unit = isset($_POST['unit']) ? $_POST['unit'] : '';
    $take = isset($_POST['take']) ? $_POST['take'] : '';
    $frequency = isset($_POST['frequency']) ? $_POST['frequency'] : '';
    $days = isset($_POST['days']) ? $_POST['days'] : '';
    $addedby = isset($_POST['addedby']) ? $_POST['addedby'] : '';

    //select stock in table to identify the form of the drugs eg;suspensin or tablet.if its not tablet do not include frequency total should be one 
    $select = "SELECT * FROM stock_out WHERE stockout_id='" . $drug . "'";
    $query = mysqli_query($con, $select);
    $array = mysqli_fetch_array($query);

    //select from stock in to know the form values
    //$in = "SELECT * FROM stock_in WHERE stock_id='".$array['stockin_id']."'";
    //$queryin = mysql_query($in);
    //$arrayin = mysql_fetch_array($queryin);
    //if($arrayin['form']==2)
    //{
    //$total = $take * $frequency * $days;
    //}
    //else
    //{
    //	$total = 1;
    //}

    $payment = "INSERT INTO prescription(reg_no,drug_name,quantity,unit,take,frequency,days,addedby,date,total_drug,amount,payment_method,patient_id) VALUES('$id','$drug','$quantity','$unit','$take','$frequency','$days','$addedby','$today','$quantity','','','$pid')";
    $querypayment = mysqli_query($con, $payment);

    //update stages from patient's registered today
    //$update="UPDATE patient SET stage='7' WHERE reg_no='".$_POST['patientid']."' AND date='$today' AND userid ='".$_POST['pid']."' ";
    //$queryupdate=mysql_query($update);
    //$ok="Send the patient to the Billing station!";



    header("Location:prescription.php?id=$id&patient_id=$pid");
    exit();
}//

if ( isset($_POST['Billing']))
{
    $id = isset($_POST['reg_number']) ? $_POST['reg_number'] : '';
    $pid = isset($_POST['p_id']) ? $_POST['p_id'] : '';
    $today = date('Y-m-d');
		 //update stages from patient's registered today
  $update="UPDATE patient SET stage='7' WHERE reg_no='$id' AND date='$today' AND userid ='$pid'";
  $queryupdate=mysqli_query($con,$update);
		
		//$ok="Send the patient to the Billing station!";
		
		
	
	header('Location:patient_doctor_view.php');
	exit();
}//
?>
<!DOCTYPE html>
<html lang="en"  ng-app="myapp">
    <head>
        <?php include('includes/meta_description.php'); ?>
           <style>
            .entry:not(:first-of-type)
            {
                margin-top: 10px;
            }

            .glyphicon
            {
                font-size: 12px;
            }

            td {
                padding:2px;   
            }
            .select3 {
                border: 1px solid #DDD;
                border-radius: 5px;
                box-shadow: 0 0 0px #888;
                color: #666;
                float: left;
                padding: 8px 5px 5px 10px;
                width: 80%;
                outline: none;
            }
            .select1 {
                border: 1px solid #DDD;
                border-radius: 5px;
                box-shadow: 0 0 0px #888;
                color: #666;
                float: left;
                padding: 8px 5px 5px 10px;
                width: 38%;
                outline: none;
            }

        </style>

    </head>

    <body>

        <!-- Navbar -->
        <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container-fluid">
                <?php include('includes/header.php'); ?>
            </div>
        </div>
        <!-- /navbar -->


        <!-- Page header -->
        <?php include('includes/page_header.php'); ?>
        <!-- /page header -->


        <!-- Page container -->
        <div class="page-container container-fluid">

            <!-- Sidebar -->
            <?php include('includes/sidemenu.php'); ?>
            <!-- /sidebar -->


            <!-- Page content -->
            <div class="page-content">
                <?php
                $pid = isset($_GET['patient_id']) ? $_GET['patient_id'] : '';
                $id = isset($_GET['id']) ? $_GET['id'] : '';
                $select = "SELECT * FROM registration WHERE reg_no='$id'";
                $query = mysqli_query($con, $select);
                $array = mysqli_fetch_array($query);

//caputure nusring measurement
                $date = date('Y-m-d');
                $nurse = "SELECT * FROM nursing WHERE reg_no='" . $array['reg_no'] . "' AND date='$date'";
                $querynurse = mysqli_query($con, $nurse);
                $arraynurse = mysqli_fetch_array($querynurse);
                ?>

                <!-- Page title -->
                <div class="page-title">
                    <h5><i class="fa fa-warning"></i>Prescription</h5>
                </div>
                <!-- /page title -->

                <!-- Form validation -->

                <div class="row">
                    <div class="col-md-2">

                        <table class="table table-bordered">
                            <tbody style="background-color: #666666">
                                <tr>
                                    <td><font color="white"><b>Patient: <?php echo $array['fname'] . " " . $array['mname'] . " " . $array['lname']; ?></b></font></td>
                                </tr>
                                <tr>
                                    <td><font color="white"><b>Weight: <?php echo $arraynurse['weight']; ?></b></font></td>
                                </tr>
                                <tr>
                                    <td><font color="white"><b>Temperature: <?php echo $arraynurse['temperature']; ?></b></font></td>
                                </tr>
                                <tr>
                                    <td><font color="white"><b>BP Systolic: <?php echo $arraynurse['BP_S']; ?></b></font></td>
                                </tr>
                                <tr>
                                    <td><font color="white"><b>BP Diastolic: <?php echo $arraynurse['BP_D']; ?></b></font></td>
                                </tr>

                            </tbody>
                        </table>


                    </div>

                    <div class="col-md-10">

                        <!-- Default datatable inside panel -->
                        <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
                            <div class="panel panel-info">
                                <div class="panel-heading"><h6 class="panel-title"><a href="patient_doctor_view.php"><< Back Home</a></h6></div>
                                <div class="datatable">
                                    <table class="table">
                                        <thead>
                                            <tr>

                                                <td colspan="2">&nbsp;</td>
                                                <td width="14%">&nbsp;</td>
                                                <td width="9%">&nbsp;</td>
                                                <td width="18%">&nbsp;</td>
                                                <td width="18%">&nbsp;</td>
                                                <td width="18%">&nbsp;</td>
                                                <td width="18%">&nbsp;</td>
                                                <td align="center"><a data-toggle="modal" role="button" href="#edit_modal" data-book-id="?id=<?php echo $id; ?>&patient_id=<?php echo $pid; ?>"><span class="label label-success">Add Medicine</span></a></td>
                                            </tr>

                                            <tr>
                                                <th width="8%">#</th>
                                                <th width="30%">Drug Name</th>
                                                <th>Quantity</th>
                                                <th>Dose</th>
                                                <th>Total Drugs</th>
                                                <th>Available</th>
                                                <th>Price/Item</th>
                                                <th>Amount to Pay</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //retrieve prescription table which consist with drugs as specified by doctor
                                            $counter = 1;
                                            $zote=0;
                                            $date = date('Y-m-d');
                                            $lab = "SELECT * FROM prescription WHERE reg_no='" . $array['reg_no'] . "' AND date='$date' AND patient_id='$pid'";
                                            $querylab = mysqli_query($con, $lab);
                                            while ($arraylab = mysqli_fetch_array($querylab)) {

                                                //select drugs name from stockout table
                                                $drug = "SELECT *  FROM stock_out WHERE stockout_id='" . $arraylab['drug_name'] . "'";
                                                $querydrug = mysqli_query($con, $drug);
                                                $arraydrug = mysqli_fetch_array($querydrug);

                                                //access stockin to get trade name
                                                $stock = "SELECT * FROM stock_in WHERE stock_id='" . $arraydrug['stockin_id'] . "'";
                                                $querystock = mysqli_query($con, $stock);
                                                $arraystock = mysqli_fetch_array($querystock);

                                                //generic name
                                                //select generic name
                                                $generic = "SELECT * FROM medicine_generic WHERE medicine_id='" . $arraystock['generic_name'] . "'";
                                                $querygeneric = mysqli_query($con, $generic);
                                                $arraygeneric = mysqli_fetch_array($querygeneric);
                                                ?>	
                                                <tr>
                                                    <td><?php echo $counter; ?></td>
                                                    <td><?php echo $arraystock['trade_name'] . " || " . $arraygeneric['name']; ?></td>
                                                    <td><?php echo $arraylab['quantity'] . " " . $arraylab['unit']; ?></td>
                                                    <td><?php echo $arraylab['take'] . " x" . $arraylab['frequency'] . " x" . $arraylab['days']; ?></td>
                                                    <td bgcolor="#FFFF00"><strong><?php echo $arraylab['total_drug']; ?></strong></td>
                                                    <td <?php if ($arraydrug['amount'] < $arraylab['total_drug'])
                                                echo "bgcolor=\"red\"";
                                            else
                                                echo "bgcolor=\"yellow\"";
                                                ?>><strong><?php echo $arraydrug['amount']; ?></strong></td>
                                                    <td bgcolor="yellow"><strong><?php echo number_format($arraydrug['price']); ?></strong></td>
                                                    <td><?php $all = $arraylab['total_drug'] * $arraydrug['price'];
                                                    echo $all; ?></td>
                                                    <td><a href="prescription.php?value=1&regno=<?php echo $id; ?>&patients_id=<?php echo $pid; ?>&pre_id=<?php echo $arraylab['id']; ?>"><span class="label label-danger">Remove</span></a></td>
                                                </tr>
                                                <?php
                                                
                                                $zote = $zote + $all;
                                                $counter++;
                                            }
                                          
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div align="right"> <font size="+2"><b>Total Cost: <?php echo number_format($zote,0);?></b></font>&nbsp;&nbsp;<button class="btn btn-warning" type="submit" name="Billing">Send to Billing</button>
                             <input type="hidden" name="p_id" value="<?php echo $pid; ?>">
                             <input type="hidden"  name="reg_number" value="<?php echo $id; ?>"></div>
                            <br/>
                            <br/>
                        </form>
                        <!-- /default datatable inside panel -->

                    </div>
                </div>
                <!-- /form validation -->
                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
                    <div id="edit_modal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h5 class="modal-title">Prescription</h5>
                                </div>

                                <div class="modal-body has-padding">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><h6 class="panel-title">Choose Medicine</h6></div>
                                        <table class="table table-bordered table-striped datatable-selectable">
                                            <tbody>
                                                <tr>
                                                    <td class="col-sm-4">Price Category</td>
                                                    <td><select  class="select1" name="cat" style="width:350px;"  required>
                                                            <option value="">Select</option>
                                                            <?php
                                                            $s9 = "SELECT * FROM price_category ORDER BY id ASC";
                                                            $querys9 = mysqli_query($con, $s9);
                                                            while ($arrays9 = mysqli_fetch_array($querys9)) {
                                                                ?>
                                                                <option value="<?php echo $arrays9['id']; ?>"><?php echo $arrays9['name']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Drug Name</td>
                                                    <td><select  class="select1" name="drug" style="width:350px;" onchange="filldata(this.value)" required>
                                                            <option value="">Select Drug</option>
                                                            <?php
// $select="SELECT * FROM stock_out WHERE amount > 0 AND stockin_id IN (SELECT * FROM stock_in ORDER BY trade_name ASC)";
                                                            $select = "SELECT stock_out.*, stock_in.stock_id,stock_in.trade_name,stock_in.quantity FROM stock_out LEFT JOIN stock_in ON stock_out.stockin_id=stock_in.stock_id WHERE stock_out.amount > 0 ORDER BY stock_in.trade_name ASC";
                                                            $query = mysqli_query($con, $select);
                                                            while ($array = mysqli_fetch_array($query)) {
                                                                //select trade name
                                                                $trade = "SELECT * FROM stock_in WHERE stock_id='" . $array['stockin_id'] . "'";
                                                                $querytrade = mysqli_query($con, $trade);
                                                                $arraytrade = mysqli_fetch_array($querytrade);

                                                                //select generic name
                                                                $generic = "SELECT * FROM medicine_generic WHERE medicine_id='" . $arraytrade['generic_name'] . "'";
                                                                $querygeneric = mysqli_query($con, $generic);
                                                                $arraygeneric = mysqli_fetch_array($querygeneric);

                                                                //units
                                                                $unit = "SELECT * FROM units WHERE id='" . $arraytrade['units'] . "'";
                                                                $queryunit = mysqli_query($con, $unit);
                                                                $arrayunit = mysqli_fetch_array($queryunit);
                                                                ?>
                                                                <option value="<?php echo $array['stockout_id']; ?>"><?php echo $array['trade_name'] . " || " . $arraygeneric['name'] . " || " . $array['quantity'] . "" . $arrayunit['name'] . " || " . $array['amount']; ?></option>
                                                                <?php
                                                            }
                                                            ?>
                                                        </select></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Form</td>
                                                    <td><input type="text" class="form-control" id ="unit_" name="unit" readonly="readonly"></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Take</td>
                                                    <td><input type="number" class="form-control" name="take" ng-model="n1"></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Frequency</td>
                                                    <td><input type="number" class="form-control" name="frequency" ng-model="n2"></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4"># of days</td>
                                                    <td><input type="number" class="form-control" name="days" ng-model="n3"></td>

                                                </tr>
                                                 <tr>
                                                    <td class="col-sm-4">Quantity</td>
                                                    <td><input type="number" class="form-control" name="quantity" value="{{n1*n2*n3}}" readonly="readonly"></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Unit Price</td>
                                                    <td><input type="number" class="form-control" id ="price_" readonly="readonly"></td>

                                                </tr>
                                           



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit" name="Submit">Save</button>
                                    <button class="btn btn-warning" data-dismiss="modal">Close</button>
                                    <input name="addedby" type="hidden" value="<?php echo $_SESSION['userid']; ?>" />
                                    <input type="hidden" name="patient_id" value="<?php echo $pid; ?>">
                                    <input type="hidden"  name="id" value="<?php echo $id; ?>"> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- /modal with table -->
                <!-- Footer -->
                <div class="footer">
<?php include('includes/footer.php'); ?>
                </div>
                <!-- /footer -->
            </div>
        </div>

        <!-- /modal with table -->
        <script>
            angular.module("myapp", [])

                    .controller("Title", function ($scope)
                    {
                        $scope.title = "Hellow Mr. Justine";
                    });
        </script>

        <script>
            function  filldata(value_id) {
//alert(value_id); // or $(this).val()
                //var param = 'stockout_id=' + value_id+ '&i=' + i;
                var param = 'stockout_id=' + value_id;
                jQuery(function ($) {
                    $.ajax({
                        url: 'ajax.php',
                        data: param,
                        dataType: 'json',
                        cache: false,
                        type: 'GET',
                        success: function (response) {
                            //alert(response.price);
                            // $("#quantity_"+response.count).val(response.quantity);
                            $("#unit_").val(response.formation);
                            $("#price_").val(response.price);


                        }
                    });
                });
            }
        </script>


    </body>
</html>
