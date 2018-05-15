<?php
include('check_permission.php');
if (isset($_POST['Submit'])) {
    $reg_no = isset($_POST['reg_no']) ? $_POST['reg_no'] : '';
    $patient_id = isset($_POST['patient_id']) ? $_POST['patient_id'] : '';
    $a1 = isset($_POST['a1']) ? $_POST['a1'] : '';
    $a2 = isset($_POST['a2']) ? $_POST['a2'] : '';
    $a3 = isset($_POST['a3']) ? $_POST['a3'] : '';
    $a4 = isset($_POST['a4']) ? $_POST['a4'] : '';
    $a5 = isset($_POST['a5']) ? $_POST['a5'] : '';
    $a6 = isset($_POST['a6']) ? $_POST['a6'] : '';
    $a7 = isset($_POST['a7']) ? $_POST['a7'] : '';
    $a8 = isset($_POST['a8']) ? $_POST['a8'] : '';
    $addedby = isset($_POST['addedby']) ? $_POST['addedby'] : '';
    $a9 = isset($_POST['a9']) ? $_POST['a9'] : '';
    $a10 = isset($_POST['a10']) ? $_POST['a10'] : '';
    $a11 = isset($_POST['a11']) ? $_POST['a11'] : '';
    $billing = isset($_POST['billing']) ? $_POST['billing'] : '';

    $today = date('Y-m-d');

    $check = "SELECT COUNT(*) AS exist FROM doctor_attend WHERE reg_no = '$reg_no' AND patient_id='$patient_id' AND date='$today'";
    $querycheck = mysqli_query($con, $check);
    $arraycheck = mysqli_fetch_array($querycheck);
    if ($arraycheck['exist'] > 0) {
        $insert = "INSERT INTO doctor_attend VALUES('','$reg_no','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$today','$addedby','$a9','$a10','$a11','2','$patient_id')";
    } else if ($arraycheck['exist'] == 0) {
        $insert = "INSERT INTO doctor_attend VALUES('','$reg_no','$a1','$a2','$a3','$a4','$a5','$a6','$a7','$a8','$today','$addedby','$a9','$a10','$a11','2','$patient_id')";
    }
    $query = mysqli_query($con, $insert);

//start working with angular data
    $datas = isset($_POST['proc']) ? $_POST['proc'] : '';
//print_r($_POST);

    foreach ($datas as $data) {
        $insert_data = "INSERT INTO investigations(procedure_name,reg_no,patient_id,date) VALUES('$data','$reg_no','$patient_id','$today')";
        $querydata = mysqli_query($con, $insert_data);
    }
    if ($query) {

        if ($billing == 1) {
            //update stages from patient's registered today
            $update = "UPDATE patient SET stage='4' WHERE reg_no='$reg_no' AND userid='$patient_id' AND date='$today' ";
            $queryupdate = mysqli_query($con, $update);
            // echo $queryupdate;
        }//end if billing is 1
        elseif ($billing == 2) {
            //update stages from patient's registered today
            $update = "UPDATE patient SET stage='40' WHERE reg_no='$reg_no' AND userid='$patient_id' AND date='$today' ";
            $queryupdate = mysqli_query($con, $update);
        }//end if billing is 1
        // $ok="Send the Patient to the Billing Office/Prescribe";
        header('Location: patient_doctor_view.php');
        exit();
    } else {
        $error = "Something went wrong";
    }
}
?>
<!DOCTYPE html>
<html lang="en" >
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
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="page-content">

<?php
$today = date('Y-m-d');
$id = isset($_GET['id']) ? $_GET['id'] : '';
$select = "SELECT * FROM registration WHERE reg_no='$id'";
$query = mysqli_query($con, $select);
$array = mysqli_fetch_array($query);

//getting past encounter
$last = "SELECT * FROM doctor_attend WHERE reg_no='$id' AND date = '$today' ORDER BY id DESC LIMIT 1";
$querylast = mysqli_query($con, $last);
$arraylast = mysqli_fetch_array($querylast);

//caputure nusring measurement
$date = date('Y-m-d');
$nurse = "SELECT * FROM nursing WHERE reg_no='" . $array['reg_no'] . "' AND date='$date'";
$querynurse = mysqli_query($con, $nurse);
$arraynurse = mysqli_fetch_array($querynurse);
?>
                    <div class="page-title">
                        <h5><i class="fa fa-warning"></i> Doctors against Patient</h5>
                    </div>
                    <!-- /page title -->

                    <!-- Form validation -->
                    <div class="row">
                        <div class="col-md-12">

                            <!-- Default datatable inside panel -->
                            <div class="panel panel-info">
                                <div class="panel-heading"><h6 class="panel-title"><a href="patient_doctor_view.php"> << Back Home</a></h6></div>
                                <br/>
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#home">Demographic Data</a></li>
                                    <li><a data-toggle="tab" href="#menu1">Vitals</a></li>
                                    <li><a data-toggle="tab" href="#menu2">History</a></li>
                                    <li><a data-toggle="tab" href="#menu3">Examination</a></li>
                                    <li><a data-toggle="tab" href="#menu5">Diagnosis</a></li>
                                    <li><a data-toggle="tab" href="#menu4">Investigation</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                        <!-- DEMOGRAPHIC DATA -->
                                        <table class="table table-striped" style="width:500px;">
                                            <tbody>
                                                <tr>
                                                    <td width="43%">Patient Name</td>
                                                    <td width="57%"><?php echo $array['fname'] . " " . $array['mname'] . " " . $array['lname']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Gender</td>
                                                    <td><?php if ($array['sex'] == 1) echo "Male";elseif ($array['sex'] == 2) echo "Female";
                    else echo ""; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Age</td>
                                                    <td><?php echo $array['birth_date']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Phone #</td>
                                                    <td><?php echo $array['p_number']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Address</td>
                                                    <td><?php echo $array['address']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- END OF DEMO DATA -->
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                        <!-- VITALS DATA -->
                                        <table class="table table-striped" style="width:500px;">
                                            <tbody>
                                                <tr>
                                                    <td width="43%">Height</td>
                                                    <td width="57%"><?php echo $arraynurse['height']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Weight</td>
                                                    <td><?php echo $arraynurse['weight']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Temperature</td>
                                                    <td><?php echo $arraynurse['temperature']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>BP Systolic</td>
                                                    <td><?php echo $arraynurse['BP_S']; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>BP Diastolic</td>
                                                    <td><?php echo $arraynurse['BP_D']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <!-- END OF DEMO DATA -->
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
<?php include('history_tab.php'); ?>
                                    </div>
                                    <div id="menu3" class="tab-pane fade">
<?php include('examination_tab.php'); ?>
                                    </div>
                                    <div id="menu5" class="tab-pane fade">
<?php include('diagnosis_tab.php'); ?>
                                    </div>
                                    <div id="menu4" class="tab-pane fade">
<?php include('investigation_tab.php'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /default datatable inside panel -->

                    </div>
                </div>
            </form>
            <!-- /form validation -->

            <!-- /modal with table -->
            <!-- Footer -->
            <div class="footer">
<?php include('includes/footer.php'); ?>
            </div>
            <!-- /footer -->
        </div>



        <!-- /modal with table -->
        <script>
            angular.module("myapp", [])

                    .controller("MainCtrl", function ($scope)
                    {
                        //$scope.title = "Hellow Mr. Justine";

                        $scope.columns = [{colId: 'col1'}];
                        $scope.addNewColumn = function () {
                            var newItemNo = $scope.columns.length + 1;
                            $scope.columns.push({'colId': 'col' + newItemNo});
                        };
                        //to remove
                        $scope.removeColumn = function (index) {
                            // remove the row specified in index
                            $scope.columns.splice(index, 1);
                            // if no rows left in the array create a blank array
                            if ($scope.columns.length() === 0 || $scope.columns.length() == null) {
                                alert('no rec');
                                $scope.columns.push = [{"colId": "col1"}];
                            }


                        };
                        //end of removal function
                    });
           
        </script>
        
        
       
        


        <!-- Bootstrap JavaScript -->



    </body>
</html>
