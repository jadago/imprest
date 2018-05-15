<?php 
include('check_permission.php');
$id=isset($_GET['id']) ? $_GET['id']:'';
$select = "SELECT * FROM requisition WHERE requisition_id='$id'";
$query = mysqli_query($con,$select);
$array = mysqli_fetch_array($query);


$error="";
$ok="";
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
                <h5><i class="fa fa-warning"></i> Requisitions</h5>
            </div>
            <!-- /page title -->
                
            <!-- Form validation -->
            <form class="form-horizontal" action="requisition_edit.php" method="POST">
                <div class="panel panel-info">
                    <div class="panel-heading"><h6 class="panel-title">Register Request</h6> </div>
                    <div class="panel-body">

                       <?php echo $ok;?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Request Date</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" name="request_date" value="<?php echo $array['submitted_date'];?>" required>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-sm-2 control-label">Department</label>
                            <div class="col-sm-10">
                                <select  class="select" name="department" required style="width:320px;">
                                    <option value="">Select</option>
									<?php 
									require_once('includes/db_conn.php');
									$projects = "SELECT department_id, department_name FROM departments WHERE department_id IN ( SELECT department_id FROM associated_department WHERE user_id = '".$arraylogUser['user_id']."' ) ORDER BY department_name ASC";
									$queryprojects = mysqli_query($con,$projects);
									while ( $arrayprojects = mysqli_fetch_array($queryprojects))
									{
									?>
                                    <option value="<?php echo $arrayprojects['department_id']; ?>" <?php if ( $arrayprojects['department_id'] == $array['department']) echo "selected=\"selected\""; ?>><?php echo $arrayprojects['department_name'];?></option>
									<?php
									}
									?>
                                </select>
                            </div>
                        </div>  
						 <div class="form-group">
                            <div class="col-sm-12">
                               <table class="table table-bordered table-striped datatable-selectable" width="80%">
                                    <thead>
                                        <tr>
                                            <th width="6%">#</th>
                                            <th width="25%">Items Name</th>
                                            <th width="17%">Quantity Requested</th>
                                            <th width="17%"><label></label></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$i=1;
									$items = "SELECT * FROM requisition_detail WHERE requisition_id='".$array['requisition_id']."'";
									$queryitem = mysqli_query($con,$items);
									while($arrayitem = mysqli_fetch_array($queryitem))

  {
  ?>
                                        <tr>
                                            <td><div>
                               <?php echo $i;?>
                            </div></td>
                                            <td><div>
                                        <select name="item<?php echo $i;?>" class="select3" tabindex="2" style="width:220px;">
                                            <option value="">Select</option> 
                                            <?php
											require_once('includes/db_conn.php');
											$item = "SELECT * FROM item";
											$query2 = mysqli_query($con,$item);
											while($array2 = mysqli_fetch_array($query2))
											{
											?>
                                            <option value="<?php echo $array2['id'];?>"<?php if($array2['id'] == $arrayitem['item']) echo "selected=\"selected\"";?>><?php echo $array2['item_name'];?></option> 
                                            <?php
											}
											?> 
                                        </select>
                                    </div></td>
                                          <td><div>
                                <input type="number" class="form-control" name="quantity<?php echo $i;?>" style="width:180px;" value="<?php echo $arrayitem['requested_quantity'];?>"/>
                            </div></td>
                                          <td><input type="checkbox" name="delete<?php echo $i; ?>" id="delete" value="1"> 
                                            Delete
                                            <input name="itemid<?php echo $i; ?>" type="hidden" value="<?php echo $arrayitem['item']; ?>" /></td>
                                        </tr>
                                        <?php
										$i++;
										}
?>
                                    </tbody>
                                   <input name="itemstotal" type="hidden" value="<?php echo $i; ?>" />
                                </table>
                           </div>
						   
                       
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"><b>Add New Items</b></label>
                            <div class="col-sm-2">
              
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"># of Items</label>
                            <div class="col-sm-10">
                                <select  class="select1" onChange="loading(1,this.value);" style="width:320px;">
                                    <option value="">Select</option>
                                  <?php 
		                         for ($i=1; $i < 11; $i++)
		                             {
		                             ?>
		                          <option><?php echo $i; ?></option>
		                          <?php 
		                           }
		                          ?>
                                </select>
                            </div>
                        </div>
                        <div id="loadparts"></div>
						
						<br>
						<br>
                        
                        <div class="form-group">
						<label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10">
                                <input type="submit" name="submit" value="Submit" class="btn btn-primary">
                                 <input type="submit" name ="save" value="Draft" class="btn btn-warning">
								  <input name="action" type="hidden" value="edit" />
                                  <input name="req_id" type="hidden" value="<?php echo $id; ?>" />
								  <input name="addedby" type="hidden" value="<?php echo $_SESSION['userid']; ?>" />
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
