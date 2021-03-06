<?php
include('check_permission.php');
$error="";
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
                    <h5><i class="fa fa-warning"></i> Un-retired Imprest List</h5>
                </div>
                <!-- /page title -->

                <!-- Form validation -->
                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
                <div class="row">
                    <div class="col-md-12">

                        <!-- Default datatable inside panel -->
                        <div class="panel panel-info">
                            <div class="panel-heading"><h6 class="panel-title">Un-retired Imprest - List</h6></div>
                            <div class="datatable">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td colspan="2"><a href="unretired_user_report_excel.php"><span class="label label-primary">Export to Excel</span></a></td>
                                            <td width="14%"><?php echo $error; ?></td>
                                          <td width="11%">&nbsp;</td>
                                          <td width="21%">&nbsp;</td>
                                          <td width="12%">&nbsp;</td>
                                          <td width="9%">&nbsp;</td>
                                          <td width="13%">&nbsp;</td>
                                         
                                      </tr>
                                        <tr>
                                            <th width="7%">#</th>
                                          <th width="13%">Staff Name</th>
                                          <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Description</th>
                                            <th>Paid Amount</th>
                                            <th>File #</th>
                                            <th>Payment Date</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        $getitem = "SELECT * FROM imprest WHERE addedby='".$arraylogUser['user_id']."' AND status=5 AND stage < 3";
                                        $query = mysqli_query($con, $getitem);
                                        while ($result = mysqli_fetch_array($query)) {
                                            //get users
                                            $users = "SELECT * FROM users WHERE user_id='".$result['staff_id']."'";
                                            $query1 = mysqli_query($con,$users);
                                            $array1 = mysqli_fetch_array($query1);
                                            
                                           // get total amount
                                            $amount = "SELECT SUM(amount) AS tamount FROM imprest_item WHERE imprest_id='".$result['imprest_id']."'";
                                            $queryA = mysqli_query($con,$amount);
                                            $arrayA = mysqli_fetch_array($queryA);
                                            
                                            //get voucher details
                                            $v = "SELECT * FROM imprest_voucher WHERE imprest_id='".$result['imprest_id']."'";
                                            $queryv = mysqli_query($con,$v);
                                            $arrayv = mysqli_fetch_array($queryv);
                                            ?>
                                            <tr>
                                                <td><?php echo $counter; ?></td>
                                                <td><?php echo $array1['firstname'] . " " . $array1['lastname']; ?></td>
                                                <td><?php echo date("d M Y", strtotime($result['leaving_date'])); ?></td>
                                                <td><?php echo date("d M Y", strtotime($result['return_date'])); ?></td>
                                                <td><?php echo $result['purpose']; ?></td>
                                                <td><?php echo number_format($arrayA['tamount']); ?></td>
                                                <td><?php echo $arrayv['file_name'];?></td>
                                                <td><?php echo $arrayv['date'];?></td>
                                              
                                               
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
                </form>
                <!-- /form validation -->

                <!-- Modal with table -->
               
                <!-- /modal with table -->
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
                var param = 'item_id=' + bookId;

                //alert(param);
                $.ajax({
                    url: 'item_ajax.php',
                    data: param,
                    dataType: 'json',
                    cache: false,
                    type: 'GET',
                    success: function (response) {
                        //display data to the modal
                        $("#itemname_").val(response.itemname);
                        $("#price_").val(response.price);
                        $("#order_").val(response.order);
                        $("#status_").val(response.status);
                        $("#item_id").val(response.item_id);




                    }
                });

                //$(e.currentTarget).find('input[name="bookId"]').val(bookId);
            });


        </script>

    </body>
</html>
