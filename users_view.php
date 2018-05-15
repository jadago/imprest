<?php
include('check_permission.php');
$error = "";
if (isset($_POST['submit']) || isset($_POST['update'])) {

    require_once('processors/users.php');
}
?>
<!DOCTYPE html>
<html ng-app="myapp">
    <head>
        <?php include('includes/meta_description.php'); ?>
        <style>
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
        </style>
    </head>

    <body ng-controller="Title">

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
                    <h5><i class="fa fa-warning"></i> Users Management</h5>
                </div>
                <!-- /page title -->

                <!-- Form validation -->
                <div class="row">
                    <div class="col-md-12">

                        <!-- Default datatable inside panel -->
                        <div class="panel panel-info">
                            <div class="panel-heading"><h6 class="panel-title">Users List</h6></div>
                            <div class="datatable">
                                <table class="table">
                                    <thead> 
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo $error; ?></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><a href="user_add.php"><span class="label label-info">Add Staff</span></a></td>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Full Name</th>
                                            <th>Email</th>
                                            <th>Username</th>
                                            <th>Category</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        require_once('includes/db_conn.php');
                                        $counter = 1;
                                        $select = "SELECT * FROM users ORDER BY firstname ASC";
                                        $query = mysqli_query($con, $select);
                                        while ($result = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $counter; ?></td>
                                                <td><?php echo $result['firstname'] . " " . $result['lastname']; ?></td>
                                                <td><?php echo $result['email']; ?></td>
                                                <td><?php echo $result['username']; ?></td>
                                                <td><?php if ($result['account_type'] == 1)
                                            echo "Normal Staff";elseif ($result['account_type'] == 2)
                                            echo "Director";elseif ($result['account_type'] == 3)
                                            echo "Finance";
                                        elseif ($result['account_type'] == 4)
                                            echo "CA";elseif ($result['account_type'] == 5)
                                            echo "DCS";elseif ($result['account_type'] == 6)
                                            echo "CEO";
                                        else
                                            echo "Administrator";
                                            ?></td>
                                                <td><?php if ($result['status'] == 1)
                                            echo "Active";
                                        else
                                            echo "Inactive";
                                        ?></td>
                                                <td><a data-toggle="modal" role="button" href="#edit_modal?w=1" data-book-id="<?php echo $result['user_id']; ?>"><span class="label label-danger">Edit</span></a></td>
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

                <!-- Start of Addition Modal -->
                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
                    <div id="table_modal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h5 class="modal-title">New User</h5>
                                </div>

                                <div class="modal-body has-padding">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><h6 class="panel-title">Add user</h6></div>
                                        <table class="table table-bordered table-striped datatable-selectable">
                                            <tbody>
                                                <tr>
                                                    <td class="col-sm-4">First Name</td>
                                                    <td><input type="text" class="form-control" name="fname" required></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Last Name</td>
                                                    <td><input type="text" class="form-control" name="lname" required></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Email</td>
                                                    <td><input type="text" class="form-control" name="email" required></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Username</td>
                                                    <td><input type="text" class="form-control" name="username" required></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Password</td>
                                                    <td><input type="password" class="form-control" name="pass" required></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">User Role</td>
                                                    <td><select data-placeholder="Choose a category..." name="cat" class="select" ng-model="cat" required>
                                                            <option value=""></option>
                                                            <option value="1">PMU Administrator</option>
                                                            <option value="2">Authorizer</option>
                                                            <option value="3">Normal Staff</option>
                                                            <option value="5">Imprest Administrator</option>
                                                        </select></td>

                                                </tr>
                                                <tr ng-if="cat == 2">
                                                    <td class="col-sm-4">Department</td>
                                                    <td><select name="approval" class="select3">
                                                            <option value="">Choose</option>
<?php
require_once('includes/db_conn.php');
$app = "SELECT * FROM departments ORDER BY department_name ASC";
$queryapp = mysqli_query($con, $app);
while ($arrayapp = mysqli_fetch_array($queryapp)) {
    ?>
                                                                <option value="<?php echo $arrayapp['department_id']; ?>"><?php echo $arrayapp['department_name']; ?></option>
    <?php
}
?>
                                                        </select></td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit" name="submit">Add User</button>
                                    <button class="btn btn-warning" data-dismiss="modal">Close</button>
                                    <input type="hidden" name="action" value="add">
                                    <input type="hidden" id="cat_id" name="id">


                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End of details Modal -->


                <!-- Editing of users profile -->
                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
                    <div id="edit_modal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h5 class="modal-title">Updating Records</h5>
                                </div>

                                <div class="modal-body has-padding">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><h6 class="panel-title">User Update</h6></div>
                                        <table class="table table-bordered table-striped datatable-selectable">
                                            <tbody>
                                                <tr>
                                                    <td class="col-sm-4">First Name</td>
                                                    <td><input type="text" class="form-control" name="efname" id="fname_"></td>
                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Last Name</td>
                                                    <td><input type="text" class="form-control" name="elname" id="lname_"></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Email</td>
                                                    <td><input type="text" class="form-control" name="eemail" id="email_"></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Username</td>
                                                    <td><input type="text" class="form-control" name="eusername" id="username_"></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Password</td>
                                                    <td><input type="password" class="form-control" name="password"></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">User Role</td>
                                                    <td><select name="ecat" class="select" id="category_select" style="width:550px;">
                                                            <option value="1">Normal Staff</option>
                                                            <option value="2">Directors Approver)</option>
                                                            <option value="3">Finance</option>
                                                            <option value="4">CA</option>
                                                            <option value="5">DCS</option>
                                                            <option value="6">CEO</option>
                                                        </select></td>

                                                </tr>
                                                <tr>
                                                    <td class="col-sm-4">Status</td>
                                                    <td><select name="estatus"  id="status_select" class="select">
                                                            <option  value="1">Active</option>
                                                            <option  value="2">Inactive</option>
                                                        </select></td>

                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button class="btn btn-primary" type="submit" name="update">Update</button>
                                    <button class="btn btn-warning" data-dismiss="modal">Close</button>
                                    <input type="hidden" name="action" value="edit">
                                    <input type="hidden" id="user_id" name="id"> 
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- End of details Modal -->
                <!-- Footer -->
                <div class="footer">
<?php include('includes/footer.php'); ?>
                </div>
                <!-- /footer -->
            </div>
        </div>

        <!-- /modal with table -->





        <!-- /page content -->

        <!-- page container -->
        <script>
                    //Editing Modal script
                    $('#edit_modal').on('show.bs.modal', function (e) {
                        var bookId = $(e.relatedTarget).data('book-id'); //this capture the row id
                        //alert(bookId);
                        var param = 'user_id=' + bookId;

                        //alert(param);
                        $.ajax({
                            url: 'users_ajax.php',
                            data: param,
                            dataType: 'json',
                            cache: false,
                            type: 'GET',
                            success: function (response) {
                                //display data to the modal
                                $("#fname_").val(response.fname);
                                $("#lname_").val(response.lname);
                                $("#email_").val(response.email);
                                $("#username_").val(response.username);
                                $("#status_edit").val(response.status);
                                $("#user_id").val(response.user_id);
                                $("#cat_").val(response.category);
                                //update category
                                //loop to all options in class cat_select and set selected value
                                //alert(response.status);

                                //$('#status_id option[value="2"]').prop({selected: true});
                                // $('#status_id option:contains(' + val + ')').prop({selected: true});


                                // $('select[name="ecat"]').find('option[value="1"]').attr("selected",true);
                                //set the value to the selected status select list	  
                                var selectedValue = response.status;
                                var catselected = response.category;
                                $('#status_select option').map(function () {
                                    if ($(this).val() == selectedValue)
                                        return this;
                                }).attr('selected', 'selected');
                                //end of status list

                                //category
                                $('#category_select option').map(function () {
                                    if ($(this).val() == catselected)
                                        return this;
                                }).attr('selected', 'selected');



                            }
                        });

                        //$(e.currentTarget).find('input[name="bookId"]').val(bookId);
                    });


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
