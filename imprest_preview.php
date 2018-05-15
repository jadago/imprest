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
                <?php
                $id = isset($_GET['id']) ? $_GET['id'] : '';
                $get = "SELECT * FROM imprest WHERE imprest_id='$id'";
                $query = mysqli_query($con, $get);
                $array = mysqli_fetch_array($query);

                //get user details
                $user = "SELECT * FROM users WHERE user_id='" . $array['staff_id'] . "'";
                $queryU = mysqli_query($con, $user);
                $arrayU = mysqli_fetch_array($queryU);
                ?>
                <!-- Page title -->
                <div class="page-title">
                    <h5><i class="fa fa-warning"></i><a href="imprest_view.php"><font color="white">All Imprest</font></a></h5>
                </div>
                <p align="right"><a href="imprest_word.php?eid=<?php echo $id; ?>"> <span class="label label-success">Print in word format</span></a></p>
                <!-- /page title -->

                <!-- Form validation -->

                <div class="row">
                    <div class="col-md-6">

                        <table class="table table-bordered">


                            <tbody>
                                <tr>
                                    <td width="30%" >Activity Start Date</td>
                                    <td width="70%" bgcolor="white"><?php echo date("d M Y", strtotime($array['leaving_date'])); ?></td>

                                </tr>
                                <tr>
                                    <td>Activity End Date</td>
                                    <td bgcolor="white"><?php echo date("d M Y", strtotime($array['return_date'])); ?></td>

                                </tr>
                                <tr>
                                    <td>Expected Retire Date</td>
                                    <td bgcolor="white"><?php echo date("d M Y", strtotime($array['return_date'])); ?></td>

                                </tr>
                                <tr>
                                    <td>Purpose</td>
                                    <td bgcolor="white"><?php echo $array['purpose']; ?></td>

                                </tr>
                                <tr>
                                    <td>Outstanding Amount</td>
                                    <td bgcolor="yellow"><?php 
                                   $balance = "SELECT imprest_id,SUM(amount) AS Oamount FROM imprest_item WHERE imprest_id IN(SELECT imprest_id FROM imprest WHERE addedby='".$arraylogUser['user_id']."' AND status=5 AND stage=1)";
                                   $queryb = mysqli_query($con,$balance);
                                   $arrayb = mysqli_fetch_array($queryb);
                                   echo number_format($arrayb['Oamount'],0);
                                    
                                    
                                    ?></td>

                                </tr>
                            </tbody>
                        </table>


                    </div>

                    <div class="col-md-6">

                        <table class="table table-bordered">

                            <tbody>
                                <tr>
                                    <td width="30%">Requested By</td>
                                    <td width="70%" bgcolor="white"><?php echo $arrayU['firstname'] . " " . $arrayU['lastname']; ?></td>

                                </tr>
                                <tr>
                                    <td>Entered By</td>
                                    <td bgcolor="white"><?php echo $arrayU['firstname'] . " " . $arrayU['lastname']; ?></td>

                                </tr>
                                <tr>
                                    <td>Last updated At</td>
                                    <td bgcolor="white"><?php echo date("d M Y", strtotime($array['date_requested'])); ?></td>

                                </tr>
                                <tr>
                                    <td>Approved</td>
                                    <td bgcolor="white">
                                        <?php
                                        $ap = "SELECT * FROM imprest WHERE imprest_id='$id' AND status > 3";
                                        $query_ = mysqli_query($con,$ap);
                                        $array_ = mysqli_fetch_array($query_);
                                        if($array_['status'] > 3)
                                        {
                                        ?>
                                        <span class="label label-success">Yes</span>
                                    <?php
                                        }
 else {?>
                                    <span class="label label-danger">No</span>
                                    <?php
 }
 ?></td>

                                </tr>
                                <tr>
                                    <td>Requested Amount</td>
                                    <td bgcolor="white">
                                        <?php
                                        require_once('includes/db_conn.php');
                                        $tot = "SELECT SUM(amount) AS tot FROM imprest_item WHERE imprest_id='" . $array['imprest_id'] . "'";
                                        $queryT = mysqli_query($con, $tot);
                                        $arrayT = mysqli_fetch_array($queryT);
// echo $array['imprest_id'];
                                        echo number_format($arrayT['tot']);
                                        ?>
                                    </td>

                                </tr>

                            </tbody>
                        </table>


                    </div>


                </div>
                <br/>

                <div class="row">
                    <div class="col-md-12"> 
                        <table class="table table-bordered">
                            <thead>
                                <tr bgcolor="#3399CC">
                                    <th>S/N</th>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $counter = 1;
                                $getitem = "SELECT * FROM imprest_item WHERE imprest_id='" . $array['imprest_id'] . "'";
                                $query = mysqli_query($con, $getitem);
                                while ($result = mysqli_fetch_array($query)) {


                                    // get item name
                                    $item_name = "SELECT * FROM item_category WHERE item_id='" . $result['item_name'] . "'";
                                    $queryA = mysqli_query($con, $item_name);
                                    $arrayA = mysqli_fetch_array($queryA);
                                    ?>
                                    <tr>
                                        <td><?php echo $counter; ?></td>
                                        <td><?php echo $arrayA['name']; ?></td>
                                        <td><?php echo $result['description']; ?></td>
                                        <td><?php echo number_format($result['amount'], 0); ?></td>
                                    </tr>
                                    <?php
                                    $counter++;
                                }
                                ?>   


                            </tbody>
                        </table>
                    </div>

                </div>
                <br/>
                <br/>
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
        <script>
            angular.module("myapp", [])

                    .controller("Title", function ($scope)
                    {
                        $scope.title = "Hellow Mr. Justine";
                    });
        </script>


    </body>
</html>
