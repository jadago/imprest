<?php 
ob_start();
session_start();

header("Cache-control: private");
$error="";
//$firstlogin = $_POST[firstlogin];
if(isset($_POST['firstlogin']))
{
$username = $_POST['username'];
$password = $_POST['password'];
$yourpassword = $_POST['yourpassword'];
$confirmpassword = $_POST['confirmpassword'];

if ($username== "" || $password == "" || $yourpassword =="" || $confirmpassword =="") 
{ 
$error='<div class="alert alert-danger fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p align="center">Fill all fields</p>
                        </div>';
}

else if ( $yourpassword != $confirmpassword) 
{ 
$error ='<div class="alert alert-danger fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p align="center">Your password and confirmed password 	DO NOT match!</p>
                        </div>';
}

else{
include('login.php');
}

}//end if for isset login

?>

<!DOCTYPE html>
<html lang="en">
<head>
<?php include('includes/meta_description.php');?>

</head>

<body class="full-width">

    <!-- Navbar -->
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
        </div>
    </div>
    <!-- /navbar -->


    <!-- Page container -->
    <div class="page-container container-fluid">
    
        <!-- Page content -->
        <div class="page-content">


            <!-- Login wrapper -->
            <div class="login-wrapper">
                <form action="firstlogin.php" method="POST">

                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title"><i class="fa fa-user"></i> First Login: Change Password</h6></div>
                        <div class="panel-body">
						<?php echo $error;?>
                            <div class="form-group has-feedback">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Username">
                                <i class="fa fa-user form-control-feedback"></i>
                            </div>

                            <div class="form-group has-feedback">
                                <label>Registered Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <i class="fa fa-lock form-control-feedback"></i>
                            </div>
							<div class="form-group has-feedback">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="yourpassword" placeholder="Password">
                                <i class="fa fa-lock form-control-feedback"></i>
                            </div>
							<div class="form-group has-feedback">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="confirmpassword" placeholder="Password">
                                <i class="fa fa-lock form-control-feedback"></i>
                            </div>

                            <div class="row form-actions">
							<div class="col-xs-6">
                                    <button type="submit" class="btn btn-info pull-left" name="firstlogin"><i class="fa fa-bars"></i> Sign in</button>
									<input type="hidden" name="loginfrom" id="hiddenField" value="firstlog"/>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </form>
            </div>  
            <!-- /login wrapper -->      
           <!-- Footer -->
            <div class="footer">
			<?php
 $today= date('Y'); ?>
  <p align="center">&copy; Copyright <?php echo $today;?>. All rights reserved <a href="http://www.ppra.go.tz" title="">PPRA</a></p>
            </div>
            <!-- /footer -->
        
        </div>
        <!-- /page content -->

    </div>
    <!-- page container -->

</body>
</html>
