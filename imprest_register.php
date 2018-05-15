<?php
include('check_permission.php');
$error = "";
$ok = "";
if (isset($_POST['Submit'])) {

  require_once('processors/imprest.php');
   // var_dump($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('includes/meta_description.php'); ?>
        <script type="text/javascript" src="ajax_inner.js"></script>
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
        </style>
        <style>
            .select3 {
                border: 1px solid #DDD;
                border-radius: 5px;
                box-shadow: 0 0 0px #888;
                color: #666;
                float: left;
                padding: 8px 5px 5px 10px;
                width: 32%;
                outline: none;
            }
            .remove{
                background: #C76868;
                color: #FFF;
                font-weight: bold;
                font-size: 21px;
                border: 0;
                cursor: pointer;
                display: inline-block;
                padding: 4px 9px;
                vertical-align: top;
                line-height: 100%;   
            }
            .addfields{
                background: green;
                color: #FFF;
                font-weight: bold;
                font-size: 21px;
                border: 0;
                cursor: pointer;
                display: inline-block;
                padding: 4px 9px;
                vertical-align: top;
                line-height: 100%;   
            }
        </style>
        <link rel="stylesheet" type="text/css" href="tcal.css" />
        <script type="text/javascript" src="tcal.js"></script>
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
                    <h5><i class="fa fa-warning"></i> Imprest Record</h5>
                </div>
                <!-- /page title -->

                <!-- Form validation -->
                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title">Register Imprest</h6></div>
                        <div class="panel-body">

                            <?php echo $error; ?><?php echo $ok; ?>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Staff Name</label>
                                <div class="col-sm-10">
                                    <select  class="select"  name="staff_name" onChange="district(2, this.value)" style="width:320px;" required>
                                        <option value="">Select</option>
                                        <?php
                                        require_once('includes/db_conn.php');
                                        $select = "SELECT * FROM users ORDER BY firstname ASC";
                                        $result = mysqli_query($con, $select);
                                        while ($arraycategory = mysqli_fetch_array($result)) {
                                            ?>
                                            <option value="<?php echo $arraycategory['user_id']; ?>"><?php echo $arraycategory['firstname'] . " " . $arraycategory['lastname']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="inner"></div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Subsistence Allowance rate</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control tcal" name="rate" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Purpose of Imprest</label>
                                <div class="col-sm-4">
                                    <textarea name="purpose" class="limited form-control" cols="45" rows="5" placeholder="Purpose of imprest"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Date of Leaving the station</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control tcal" name="leaving_date" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Date of returning</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control tcal" name="return_date" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Place to be visited</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" name="place" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Number of Nights</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control" name="night" style="width:80px;" required>
                                </div>
                            </div>
                            <div ng-app="myapp" ng-controller="MainCtrl"> 
                                <fieldset  ng-repeat="column in columns">
                                    <div class="row" >
                                        <div class="col-md-12">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <select  class="select1" name="items[]" style="width:300px;" ng-model="item">
                                                        <option value="">-- Select Item--</option>
                                                        <?php
                                                        $p = "SELECT * FROM item_category ORDER BY item_id ASC";
                                                        $queryp = mysqli_query($con, $p);
                                                        while ($arrayp = mysqli_fetch_array($queryp)) {
                                                            ?>
                                                            <option value="<?php echo $arrayp['item_id']; ?>"><?php echo $arrayp['name']; ?></option>
                                                            <?php
                                                        }
                                                        ?>

                                                    </select>
                                                    <br/>
                                                    <br/>
                                                    <div ng-if="item == 8">
                                                        <input type="text" class="form-control" name="item_other[]" placeholder="Specify other" style="width:150px;">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="description[]" placeholder="Description">
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="amount[]" placeholder="Total Amount">
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="addfields" ng-click="addNewColumn()">+</button>
                                                <button type="button" class="remove"  ng-click="removeColumn($index)">x</button>
                                            </div>         
                                        </div>
                                    </div>

                                </fieldset>
                            </div>


                            <br>
                            <br>
                            <div class="form-group">
                                <label class="col-sm-2 control-label"></label>
                                <div class="col-sm-10">
                                    <input type="submit" value="Register Imprest" class="btn btn-primary" name="Submit">
                                    <input name="addedby" type="hidden" value="<?php echo $arraylogUser['user_id']; ?>" />
                                    <input name="action" type="hidden" value="add" />
                                </div>
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

        <script type="text/javascript">
            $(function ()
            {
                $(document).on('click', '.btn-add', function (e)
                {
                    e.preventDefault();

                    var controlForm = $(this).closest('table'),
                            currentEntry = $(this).parents('tr:first'),
                            newEntry = $(currentEntry.clone()).appendTo(controlForm);

                    newEntry.find('input').val('');
                    controlForm.find('tr:not(:last) .btn-add')
                            .removeClass('btn-add').addClass('btn-remove')
                            .removeClass('btn-success').addClass('btn-danger')
                            .html('<span class="glyphicon glyphicon-minus gs"></span>');
                }).on('click', '.btn-remove', function (e)
                {
                    $(this).parents('tr:first').remove();

                    e.preventDefault();
                    return false;
                });
            });

        </script>

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




    </body>

</html>
