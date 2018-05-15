<?php
include('check_permission.php');
$error = "";
$value = isset($_GET['value']) ? $_GET['value']:'';
if($value==1)
{
    $imprest_id = isset($_GET['id']) ? $_GET['id']:'';
    require_once('includes/db_conn.php');
    $update = "UPDATE imprest SET status = '2' WHERE imprest_id='".$imprest_id."'";
    $queryup = mysqli_query($con,$update);
    header('Location:imprest_view.php');
      exit();
}
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
                    <h5><i class="fa fa-warning"></i> Imprest List</h5>
                </div>
                <!-- /page title -->

                <!-- Form validation -->
                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" role="form">
                <div class="row">
                    <div class="col-md-12">

                        <!-- Default datatable inside panel -->
                        <div class="panel panel-info">
                            <div class="panel-heading"><h6 class="panel-title">Imprest - List</h6></div>
                            <div class="datatable">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                            <td width="13%"><?php echo $error; ?></td>
                                            <td width="10%">&nbsp;</td>
                                            <td width="11%">&nbsp;</td>
                                            <td width="21%">&nbsp;</td>
                                            <td width="11%">&nbsp;</td>
                                            <td width="6%">&nbsp;</td>
                                            <td width="10%"><a href="imprest_register.php"><span class="label label-success">Register Imprest</span></a></td>
                                        </tr>
                                        <tr>
                                            <th width="6%">#</th>
                                            <th width="12%">Staff Name</th>
                                            <th>Request Date</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Description</th>
                                            <th>Total Amount</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        $getitem = "SELECT * FROM imprest WHERE addedby='".$arraylogUser['user_id']."' AND status < 5 ORDER BY imprest_id DESC";
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
                                            ?>
                                            <tr>
                                                <td><?php echo $counter; ?></td>
                                                <td><?php echo $array1['firstname'] . " " . $array1['lastname']; ?></td>
                                                <td><?php echo date("d M Y", strtotime($result['date_requested'])); ?></td>
                                                <td><?php echo date("d M Y", strtotime($result['leaving_date'])); ?></td>
                                                <td><?php echo date("d M Y", strtotime($result['return_date'])); ?></td>
                                                <td><?php echo $result['purpose']; ?></td>
                                                <td><?php echo number_format($arrayA['tamount']); ?></td>
                                                <td><a href="imprest_preview.php?id=<?php echo $result['imprest_id'];?>"><span class="label label-primary">Preview</span></a></td>
                                                <td><?php if($result['status']==1){?><a href="imprest_view.php?value=1&id=<?php echo $result['imprest_id'];?>"><span class="label label-warning">Send to Accountant</span></a>
                                                <?php } elseif($result['status']==2) {?><span class="label label-info">Waiting for accountant</span><?php }
                                                elseif($result['status']==3){?><span class="label label-info">Waiting for approval</span></td><?php }
                                                elseif($result['status']==4){?><span class="label label-info">Voucher preparation</span></td><?php } ?>
                                               
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
