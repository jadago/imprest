<?php
session_start();
header("Cache-control: private"); //IE 6 Fix;
		
 unset($_SESSION['login']);
 unset($_SESSION['userid']);
 
 header('Location: index.php');
 exit();
?>