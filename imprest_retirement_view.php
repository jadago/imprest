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
                                            <td width="20%">&nbsp;</td>
                                          <td width="12%">&nbsp;</td>
                                          <td width="9%">&nbsp;</td>
                                          <td width="9%">&nbsp;</td>
                                          <td width="9%">&nbsp;</td>
                                      </tr>
                                        <tr>
                                            <th width="6%">#</th>
                                            <th width="12%">Staff Name</th>
                                            <th>Start Date</th>
                                            <th>End Date</th>
                                            <th>Description</th>
                                            <th>Paid Amount</th>
                                            <th>File #</th>
                                            <th>Payment Date</th>
                                            <th>&nbsp;</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $counter = 1;
                                        $getitem = "SELECT * FROM imprest WHERE addedby='".$arraylogUser['user_id']."' AND status=5";
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
                                                <td><?php if ($result['stage']==1){?> <a href="imprest_retirement_preview.php?id=<?php echo $result['imprest_id'];?>"><span class="label label-success">Retirement</span></a><?php }
                                                elseif($result['stage']==2){?><a href="imprest_retirement_preview_item.php?id=<?php echo $result['imprest_id'];?>"><span class="label label-warning">Preview & Submit</span></a><?php }
                                                elseif($result['stage']==3){?><a href="imprest_retirement_waiting.php?id=<?php echo $result['imprest_id'];?>"><span class="label label-success">Waiting approval</span></a><?php }
                                                elseif($result['stage']>3){?><span class="label label-default">Retired</span><?php }?>
                                                </td>
                                               
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
