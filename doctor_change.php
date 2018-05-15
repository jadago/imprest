<?php 
include('check_permission.php');
if ( isset($_POST['Submit']))
{

if($_POST['delete']==1)
{
$delete = "DELETE FROM patient WHERE userid='$_POST[id]'";
$querydelete = mysqli_query($con,$delete);
}
$date=date('Y-m-d');
  require_once('includes/db_conn.php');
  //update some patient details
  $update = "UPDATE patient SET doctor_id='$_POST[d]' WHERE userid='$_POST[id]'";
  $result = mysqli_query($con,$update);
  if($result)
  //$ok="Patient data sent to the nursing/doctor";
  {
   header('Location:patient_view.php');
   exit();
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
<script type="text/javascript">
function validateForm()
{
  return confirm("Are you sure you want to make changes?")
	 }
  
</script>
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
                <h5><i class="fa fa-warning"></i> Registration Section</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="reg" onSubmit="return validateForm()">
                <div class="panel panel-info">
                    <div class="panel-heading"><h6 class="panel-title"><a href="patient_view.php"><< Back Home</a></h6> </div>
                    <div class="panel-body">

                       <?php
	  require_once('includes/db_conn.php');
	  $today=date('Y-m-d');
	  $select="SELECT * FROM registration WHERE reg_no='$_GET[id]'";
	  $query=mysqli_query($con,$select);
	  $array=mysqli_fetch_array($query);
	  
	  
	  //check patient tabke
	  $patient = "SELECT * FROM patient WHERE reg_no='".$array['reg_no']."' AND date='$today'";
	  $queryp = mysqli_query($con,$patient);
	  $arrayp = mysqli_fetch_array($queryp);
	  ?>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Patient Name</label>
                            <div class="col-sm-4">
                                 <input type="text" class="form-control" name="a3" value=" <?php echo $array['fname']." ".$array['mname']." ".$array['lname'];?>" disabled="disabled">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Insurance #</label>
                            <div class="col-sm-4">
                               
                                <input type="text" class="form-control" name="a3" value="<?php if($arrayp['insurance_no']) echo $arrayp['insurance_no']; else echo "N/A";?>" disabled="disabled">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Phone Number</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?php echo $array['p_number'];?>" disabled="disabled">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?php echo $array['address'];?>" disabled="disabled">
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Payment Method</label>
                            <div class="col-sm-10">
                                <select  class="select1" name="method"  required>
                                    <option value="" selected="selected">N/A</option>
                                 <?php
		  require_once('includes/db_conn.php');
		  $s1= "SELECT * FROM payment_method ORDER BY id ASC";
		  $querys1=mysqli_query($con,$s1);
		  while($arrays1 = mysqli_fetch_array($querys1))
		  {
		  ?>
          <option value="<?php echo $arrays1['id'];?>"<?php if($arrays1['id']==$arrayp['payment_method']) echo "selected=\"selected\"";?>><?php echo $arrays1['name'];?></option>
          <?php
		  }
		  ?>
                                </select>
                            </div>
                        </div>
 
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Registration Fee</label>
                            <div class="col-sm-10">
                                <select  class="select1" name="amount" required>
           <?php
		  require_once('includes/db_conn.php');
		  $s= "SELECT * FROM registration_fees ORDER BY id DESC";
		  $querys=mysqli_query($con,$s);
		  while($arrays = mysqli_fetch_array($querys))
		  {
		  ?>
          <option value="<?php echo $arrays['amount'];?>"<?php if($arrays['amount']==$arrayp['consult_fees']) echo "selected=\"selected\"";?>><?php echo $arrays['amount'];?></option>
          <?php
		  }
?>
                                </select>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Doctor Name</label>
                            <div class="col-sm-10">
                                <select  class="select1" name="d" required>
                                     <option value="0" selected="selected">Doctor Name</option>
           <?php
		  require_once('includes/db_conn.php');
		  $s1= "SELECT * FROM users WHERE doctor='1' ORDER BY firstname ASC";
		  $querys1=mysqli_query($con,$s1);
		  while($arrays1 = mysqli_fetch_array($querys1))
		  {
		  ?>
          <option value="<?php echo $arrays1['userid'];?>"<?php if($arrays1['userid']==$arrayp['doctor_id']) echo "selected=\"selected\"";?>><?php echo $arrays1['firstname']." ".$arrays1['middlename']." ".$arrays1['lastname'];?></option>
          <?php
		  }
?>               </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="delete" value="1" >
                                        <font color="red">Cancel This Attendance</font>
                                    </label>
                                </div>
                                
                            </div>
                        </div>				
                        </div>
                        <div class="form-group">
			<label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="Submit" value="Make Changes" class="btn btn-primary"/>
			         <input name="patientid" type="hidden" value="<?php echo $array['reg_no'];?>" />
				 <input name="addedby" type="hidden" value="<?php echo $_SESSION['userid']; ?>"/>
                                 <input name="id" type="hidden" value="<?php echo $arrayp['userid'];?>" />
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
