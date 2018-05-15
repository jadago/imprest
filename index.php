<?php
$error="";
if(isset($_POST['Submit']))
{
$username = $_POST['username'];
$password = $_POST['password'];
if($username == "" || $password == "")
{
	$error='<div class="alert alert-danger fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <p align="center">Fill Both username and Password</p>
                        </div>';
}
else
{
	//header('Location:home.php');
    include('login.php');
}
	
}
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
			 <div align="center"><h1>Imprest Management System</h1></div>
                <form action="index.php" method="POST">
                

                    <div class="panel panel-info">
                        <div class="panel-heading"><h6 class="panel-title"><i class="fa fa-user"></i> User login</h6></div>
                        <div class="panel-body">
						<?php echo $error;?>
                            <div class="form-group has-feedback">
                                <label>Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Username">
                                <i class="fa fa-user form-control-feedback"></i>
                            </div>

                            <div class="form-group has-feedback">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Password">
                                <i class="fa fa-lock form-control-feedback"></i>
                            </div>

                            <div class="row form-actions">
							<div class="col-xs-6">
                                    <button type="submit" class="btn btn-info pull-left" name="Submit"><i class="fa fa-bars"></i> Sign in</button>
                                </div>                                
                            </div>
							<div class="row form-actions">
							<div class="col-xs-12">
                                    <a href="">Create account</a> |  <a href="">Forgot Password</a>
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
  <p align="center">&copy; Copyright <?php echo $today;?>. All rights reserved <a href="#" title="">PPRA</a></p>
            </div>
            <!-- /footer -->
        
        </div>
        <!-- /page content -->

    </div>
    <!-- page container -->

</body>
</html>
