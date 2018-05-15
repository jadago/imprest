<?php 
             require_once('includes/db_conn.php');	
			 
		     for ( $i=1; $i <= $_POST['total']; $i++)
		     {
				 // $accessid = isset($_POST['accessid'.$i]) ? $_POST['accessid'.$i]:'';
				  
			  $value = isset($_POST['department'.$i]) ? $_POST['department'.$i]:'';
				  
			   $userid = $_POST['id'];
			   
			   //check if access exists
			   $check2 = "SELECT access_id FROM associated_department WHERE department_id = '".$value."' AND user_id = '".$userid."'";
			   $querycheck2 = mysqli_query($con,$check2);
			   $rowcheck2 = mysqli_num_rows($querycheck2);
			   
			   if ( $rowcheck2 > 0 && $value == 0 )//access exists but now not selected, delete it
			   {
	             $delete = "DELETE FROM associated_department WHERE department_id = '".$value."' AND user_id = '".$userid."'";
		         $query = mysqli_query($con,$delete);
			   }
			   else if ( $rowcheck2 == 0 && $value > 0 )///access doesn't exist but it is now selected, insert it
			   {
			      $insert = "INSERT INTO associated_department ( department_id, user_id ) VALUES ( '$value', '$userid' ) ";
				  $query = mysqli_query($con,$insert);
			   }//close if ( $value > 0 )
			   }//close for
			   
?>