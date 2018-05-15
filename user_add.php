<?php
include('check_permission.php');
$error = "";
$ok = "";
$today = date("Y-m-d");
if (isset($_POST['submit'])) {


    require_once('processors/users.php');
}
?>
<!DOCTYPE html>
<html lang="en" ng-app="myapp">
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

                <!-- Page title -->
                <div class="page-title">
                    <h5><i class="fa fa-warning"></i> Account Creation</h5>
                </div>
                <!-- /page title -->

                <!-- Form validation -->
                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title"><a href="users_view.php"> << Back Home</a></h6> </div>
                        <div class="panel-body">

                            <?php echo $ok; ?><?php echo $error; ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">First Name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="fname" ng-model="fname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="lname" ng-model="lname" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email Address</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="email" value="{{fname + '.' + lname + '@ppra.go.tz'}}" readonly="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Department</label>
                                <div class="col-sm-10">
                                    <select  class="select1" name="department" required style="width:300px;">
                                        <option value="">Select</option>
                                        <?php
                                        $department = "SELECT * FROM departments ORDER BY department_name ASC";
                                        $querydepart = mysqli_query($con, $department);
                                        while ($arraydepart = mysqli_fetch_array($querydepart)) {
                                            ?>
                                            <option value="<?php echo $arraydepart['department_id']; ?>"><?php echo $arraydepart['department_name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Designation</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="designation"  required>
                                </div>
                            </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label">Salary Scale</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="salary" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="username" value="{{fname + '.' + lname}}" readonly="" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-4">
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Account Type</label>
                                <div class="col-sm-10">
                                    <select  class="select1" name="account_type" required style="width:300px;">
                                        <option value="">Select</option>
                                        <option value="1">Normal Staff</option>
                                        <option value="2">Directors (Approver)</option>
                                        <option value="3">Finance</option>
                                        <option value="8">Cashier</option>
                                        <option value="4">CA</option>
                                        <option value="5">DCS</option>
                                        <option value="6">CEO</option>
                                        <option value="7">Administrator</option>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <br>
                        <br>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="submit" value="Register New Staff" class="btn btn-primary"/>
                                <input name="action" type="hidden" value="add" />
                                <input name="addedby" type="hidden" value="<?php echo $_SESSION['userid']; ?>"/>
                            </div>
                        </div>


                    </div>

                </form>
                <!-- /form validation -->


                <!-- Footer -->
                <div class="footer">
                    <?php include('includes/footer.php'); ?>
                </div>
                <!-- /footer -->


            </div>
            <!-- /page content -->

        </div>
        <!-- page container -->

        <script>
            function  filldata(value_id, i) {

                // alert(value_id); // or $(this).val()
                var param = 'id=' + value_id + '&i=' + i;
                // alert(param);

                $.ajax({
                    url: 'requisition_ajax.php',
                    data: param,
                    dataType: 'json',
                    cache: false,
                    type: 'GET',
                    success: function (response) {
                        // alert(response.stock);
                        $("#stock_" + response.count).val(response.stock);
                        $("#unit_" + response.count).val(response.unit);
                        // $("#unit_"+response.count).val(response.formation);


                    }
                });

            }
        </script>	
        <script>
            angular.module("myapp", [])

                    .controller("Title", function ($scope)
                    {
                        $scope.title = "Hellow Mr. Justine";
                    });
        </script>	

    </body>

</html>
