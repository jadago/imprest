<?php
require_once('includes/db_conn.php');
$check = "SELECT access_id FROM associated_department WHERE department_id=1 AND user_id=1";
			   $querycheck = mysqli_query($con,$check);
			   $rowcheck = mysqli_num_rows($querycheck);
			   
			   echo $rowcheck;
			   ?>