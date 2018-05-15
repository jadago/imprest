<?php 
include('check_permission.php');
if ( isset($_POST['Submit']))
{
$date=date('Y-m-d');
require_once('includes/db_conn.php');
  
  $insert="INSERT INTO clinic VALUES('','$_POST[patientid]','$_POST[cat]','$_POST[vaccination]','$date')";
  $query=mysqli_query($con,$insert);
  if($query)
  {
    for ( $i=1; $i < $_POST['totalusers']; $i++)
	{
	  if ( $_POST['user'.$i] > 0 )
	  {
	   $amount=$_POST[amount.$i];
	   $put="INSERT INTO clinic_payment (reg_no,service,amount,date) VALUES ('$_POST[patientid]','".$_POST['user'.$i]."','$amount','$date')";
	   $queryput=mysqli_query($con,$put);
	   
	  }//end if
	  }//end for loop
  header('Location:patient_view.php');
   exit();
  }
  else
  $error="Something went wrong";
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
  return confirm("Are you sure you want to save changes?")
	 }
function clinic(strone, strtwo)
{ 
xmlHttp=GetXmlHttpObjectinner91();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="load.php";
url=url+"?q=" + strone + "&r=" + strtwo; //this passes a request to open a new page while passing the ID as a requested object
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedinner91;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function stateChangedinner91() 
{ 
document.getElementById("inner91").innerHTML= "<img src='images/loader.gif' /></div>";
if (xmlHttp.readyState==4)
{ 
document.getElementById("inner91").innerHTML=xmlHttp.responseText;
}
}

function GetXmlHttpObjectinner91()
{
var xmlHttp=null;
try
  {
  // Firefox, Opera 8.0+, Safari
  xmlHttp=new XMLHttpRequest();
  }
catch (e)
  {
  // Internet Explorer
  try
    {
    xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
    }
  catch (e)
    {
    xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
return xmlHttp;
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
                <h5><i class="fa fa-warning"></i> Clinic Section</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
            <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" name="reg" onSubmit="return validateForm()">
                <div class="panel panel-info">
                    <div class="panel-heading"><h6 class="panel-title"><a href="patient_view.php">Back Home</a></h6> </div>
                    <div class="panel-body">

                       <?php
	  require_once('includes/db_conn.php');
	  $select="SELECT * FROM registration WHERE reg_no='$_GET[id]'";
	  $query=mysqli_query($con,$select);
	  $array=mysqli_fetch_array($query);
	  ?>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Patient Name</label>
                            <div class="col-sm-4">
                                 <input type="text" class="form-control" name="a3" value=" <?php echo $array['fname']." ".$array['mname']." ".$array['lname'];?>" disabled="disabled">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Age</label>
                            <div class="col-sm-4">
                               
                                <input type="text" class="form-control" name="a3" value="<?php echo $array['birth_date'];?>" disabled="disabled">
                            </div>
                          </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-10">
                                <select  class="select1" name="cat" required onchange="clinic(21, this.value)">
                                    <option value="0" selected="selected">Select Category</option>
                                    <option value="1">Vaccination</option>
                                    <option value="2">Services</option>
                                </select>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">&nbsp;</label>
                            <div class="col-sm-10">
                                <div id="inner91">&nbsp;</div>
                            </div>
                        </div>
                    				
                        </div>
                        <div class="form-group">
			<label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="Submit" value="Save Data" class="btn btn-primary">
			         <input name="patientid" type="hidden" value="<?php echo $array['reg_no'];?>" />
				 <input name="addedby" type="hidden" value="<?php echo $_SESSION['userid']; ?>"/>
                                
                            </div>
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
