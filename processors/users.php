<?php

if ($_POST['action'] == "add") {
    require_once('includes/db_conn.php');
    $fname = isset($_POST['fname']) ? $_POST['fname'] : '';
    $lname = isset($_POST['lname']) ? $_POST['lname'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $department = isset($_POST['department']) ? $_POST['department'] : '';
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $account_type = isset($_POST['account_type']) ? $_POST['account_type'] : '';
    $addedby = isset($_POST['addedby']) ? $_POST['addedby'] : '';
    $designation = isset($_POST['designation']) ? $_POST['designation'] : '';
    $salary = isset($_POST['salary']) ? $_POST['salary'] : '';
    //$approval = $_POST['approval'];
    $encryptpassword = md5($password);

    //check if username is exist
    $check = "SELECT * FROM users WHERE username='$username'";
    $querycheck = mysqli_query($con, $check);
    $rows = mysqli_num_rows($querycheck);
    if ($rows == 0) {
        $insert = "INSERT INTO users(firstname,lastname,email,department,username,password,status,login_status,account_type,designation,salary,addedby) VALUES('$fname','$lname','$email','$department','$username','$encryptpassword','1','1','$account_type','$designation','$salary','$addedby')";
        $query = mysqli_query($con, $insert);

        $ok = '<div class="alert alert-danger fade in widget-inner">
                            <button type="button" class="close" data-dismiss="success">×</button>
                            OK! New user has been added successfullly....
                        </div>';
    } else {
        $error = '<div class="alert alert-danger fade in widget-inner">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            ERROR! Username with this email is already exist....
                        </div>';
    }
} elseif ($_POST['action'] == "edit") {
    require_once('includes/db_conn.php');
    $fname = $_POST['efname'];
    $lname = $_POST['elname'];
    $email = $_POST['eemail'];
    $username = $_POST['eusername'];
    $cat = $_POST['ecat'];
    $status = $_POST['estatus'];
    $password = $_POST['password'];
    $newpassword = md5($password);
    $id = $_POST['id'];
    if ($password != "") {
        $update = "UPDATE users SET firstname='$fname',lastname='$lname',email='$email',username='$username',status='$status',category='$cat',password='$newpassword',login_status='1' WHERE user_id='$id'";
    } else {
        $update = "UPDATE users SET firstname='$fname',lastname='$lname',email='$email',username='$username',status='$status',category='$cat' WHERE user_id='$id'";
    }
    $query = mysqli_query($con, $update);
}
?>
