<?php
include('check_permission.php');
$error = "";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('includes/meta_description.php'); ?>
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
                    <h5><i class="fa fa-warning"></i> Registered Patients</h5>
                </div>
                <!-- /page title -->

                <!-- Form validation -->
                <div class="row">
                    <div class="col-md-12">

                        <!-- Default datatable inside panel -->
                        <div class="panel panel-info">
                            <div class="panel-heading"><h6 class="panel-title">Patient's List</h6></div>
                            <div class="datatable">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td><?php echo $error; ?></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                            <td align="center"><a href="requisition_add.php"><span class="label label-success">Add New</span></a></td>
                                        </tr>
                                        <tr>
                                            <th>#</th>
                                            <th>Card #</th>
                                            <th>Patient's Name</th>
                                            <th>Phone #</th>
                                            <th>Address</th>
                                            <th>Next of Kin</th>
                                            <th>OPTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <tr id="<?php if ($counter % 2 != 0) echo "1";
            else echo "2"; ?>">
                                            <td>1</td>
                                            <td>2017/001</td>
                                            <td>Justine Govella</td>
                                            <td>0652309698</td>
                                            <td>Mwanza</td>
                                            <td>Emmanuel Mwakajinga</td>
                                            <td><span class="label label-danger">Edit</span>&nbsp;<span class="label label-info">Delete</span></td>
                                        </tr>
                                        <tr id="<?php if ($counter % 2 != 0) echo "1";
            else echo "2"; ?>">
                                            <td>2</td>
                                            <td>2017/001</td>
                                            <td>Joseph Mhozi</td>
                                            <td>0763158517</td>
                                            <td>Dar</td>
                                            <td>Haule Michael</td>
                                            <td><span class="label label-danger">Edit</span>&nbsp;<span class="label label-info">Delete</span></td>
                                        </tr>

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
<?php include('includes/footer.php'); ?>
                </div>
                <!-- /footer -->
            </div>
        </div>

        <!-- /modal with table -->

    </body>
</html>
