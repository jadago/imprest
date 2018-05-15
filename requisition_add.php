<?php 
include('check_permission.php');
$error="";
$ok="";
$today = date("Y-m-d");
if ( isset($_POST['save']) || isset($_POST['submit']) )
{
    require_once('processors/requisition.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('includes/meta_description.php');?>
<script type="text/javascript">
 function loading(strone, strtwo)
{ 
xmlHttp=GetXmlHttpObjectloadparts();
if (xmlHttp==null)
  {
  alert ("Your browser does not support AJAX!");
  return;
  } 

var url="load.php";
url=url+"?q=" + strone + "&r=" + strtwo; //this passes a request to open a new page while passing the ID as a requested object
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChangedloadparts;
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function stateChangedloadparts() 
{ 
document.getElementById("loadparts").innerHTML= "<img src='images/loader.gif' /></div>";
if (xmlHttp.readyState==4)
{ 
document.getElementById("loadparts").innerHTML=xmlHttp.responseText;
$(".select3").select2(); 
}
}

function GetXmlHttpObjectloadparts()
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
                <h5><i class="fa fa-warning"></i> Registration</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
            <form class="form-horizontal" action="requisition_add.php" method="POST">
                <div class="panel panel-info">
                    <div class="panel-heading"><h6 class="panel-title">Register Patient</h6> </div>
                    <div class="panel-body">

                       <?php echo $ok;?>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">First Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="request_date" required>
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Middle Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="request_date">
                            </div>
                        </div>
                          <div class="form-group">
                            <label class="col-sm-2 control-label">Last Name</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="request_date" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Address</label>
                            <div class="col-sm-4">
                                <textarea rows="5" cols="5" class="limited form-control" placeholder="Limited to 100 characters" name="detail"></textarea>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Phone Number</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="request_date" required>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-sm-2 control-label">Sex</label>
                            <div class="col-sm-10">
                                <select  class="select1" name="department" required>
                                    <option value="">Select</option>
									
                                    <option value="1">Male</option>
                                    <option value="2">FeMale</option>
									
                                </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Birth date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="request_date" required>
                            </div>
                        </div> 
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Next of Kin</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="request_date" required>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Next of Kin Phone</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="request_date" required>
                            </div>
                        </div>
						  <div class="form-group">
                            <label class="col-sm-2 control-label">Insurance Company</label>
                            <div class="col-sm-10">
                                <select  class="select1" name="cat" required>
                                 <option value="">Select</option>
                                    <option value="1">NHIF</option>
								     <option value="2">ARR</option>
                                </select>
                            </div>
                        </div>
						 
							
                        </div>
				
						
						<br>
						<br>
                        <div class="form-group">
						<label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
								 <input type="submit" name ="save" value="Draft" class="btn btn-warning">
								  <input name="action" type="hidden" value="add" />
								  <input name="addedby" type="hidden" value="" />
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
	

</body>

</html>
