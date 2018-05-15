<?php 
include('check_permission.php');
$ok="";
$error = "";
if ( isset($_POST['Submit']))
{
    $weight = isset($_POST['a1']) ? $_POST['a1']:'';
    $height = isset($_POST['a2']) ? $_POST['a2']:'';
    $sy = isset($_POST['a3']) ? $_POST['a3']:'';
    $dy = isset($_POST['a4']) ? $_POST['a4']:'';
    $pr = isset($_POST['a5']) ? $_POST['a5']:'';
    $temp = isset($_POST['a6']) ? $_POST['a6']:'';
    $patientid = isset($_POST['patientid']) ? $_POST['patientid']:'';
 $today=date('Y-m-d');
 $insert="INSERT INTO nursing VALUES('','$patientid','$weight','$height','$sy','$dy','$pr','$temp','$today')";
 $query=mysqli_query($con,$insert);
 if($query)
 {
  //update stages from patient's registered today
  $update="UPDATE patient SET stage='3' WHERE reg_no='".$_POST['patientid']."' AND date='$today' ";
  $queryupdate=mysqli_query($con,$update);
  header('Location:nursing_view.php');
  exit();
 }
 else
 {
 $error="Something went wrong";
 }
}
?>
<!DOCTYPE html>
<html lang="en" ng-app="myapp">
<head>
<?php include('includes/meta_description.php');?>
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
           <?php include('includes/header.php');?>
        </div>
    </div>
    <!-- /navbar -->


    <!-- Page header -->
    <?php include('includes/page_header.php');?>
    <!-- /page header -->


    <!-- Page container -->
    <div class="page-container container-fluid">
    	
    	<!-- Sidebar -->
       <?php include('includes/sidemenu.php');?>
        <!-- /sidebar -->

    
        <!-- Page content -->
        <div class="page-content">

            <!-- Page title -->
        	<div class="page-title">
                <h5><i class="fa fa-warning"></i> Nursing Section</h5>
            </div>
            <!-- /page title -->
           
            <!-- Form validation -->
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                <div class="panel panel-info">
                    <div class="panel-heading"><h6 class="panel-title"><a href="nursing_view.php"><< Back Home</a></h6> </div>
                    <div class="panel-body">
                             <?php
	  $id = isset($_GET['id']) ? $_GET['id']:'';
	  $select="SELECT * FROM registration WHERE reg_no='$id'";
	  $query=mysqli_query($con,$select);
	  $array=mysqli_fetch_array($query);
	  ?>

                       <?php echo $ok;?>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Patient Name</label>
                            <div class="col-sm-4">
                               <?php echo $array['fname']." ".$array['mname']." ".$array['lname'];?>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Age</label>
                            <div class="col-sm-4">
                                <?php echo $array['birth_date'];?>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Weight</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="a1">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Height</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="a2" >
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">BP Systolic</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="a3">
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-sm-2 control-label">BP Diastolic</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="a4">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">PR</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="a5">
                            </div>
                        </div> 
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Temperature</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="a6">
                            </div>
                        </div> 				
                        </div>
				
						
						<br>
						<br>
                        <div class="form-group">
						<label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="Submit" value="Send to Doctor" class="btn btn-primary"/>
			         <input name="patientid" type="hidden" value="<?php echo $array['reg_no'];?>" />
				 <input name="addedby" type="hidden" value="<?php echo $_SESSION['userid']; ?>"/>
                            </div>
                        </div>
						

                    </div>
                    
            </form>
            <!-- /form validation -->


            <!-- Footer -->
            <div class="footer">
                <?php include('includes/footer.php');?>
            </div>
            <!-- /footer -->

        
        </div>
        <!-- /page content -->

    </div>
    <!-- page container -->
	
<script>
function  filldata(value_id,i){

 // alert(value_id); // or $(this).val()
  var param = 'id=' + value_id+ '&i=' + i;
 // alert(param);
   
    $.ajax({
                
                url: 'requisition_ajax.php',
                data: param,
                dataType: 'json',
                cache: false,
                type: 'GET',
                success: function(response){
                    // alert(response.stock);
                    $("#stock_"+response.count).val(response.stock);
					 $("#unit_"+response.count).val(response.unit);
					// $("#unit_"+response.count).val(response.formation);
                     
               
            }
            });
   
}
</script>	
<script>
	  angular.module("myapp",[])
	  
	  .controller("Title",function($scope)
	  {
	  $scope.title="Hellow Mr. Justine";
	  });
	  </script>	

</body>

</html>
