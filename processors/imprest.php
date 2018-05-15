<?php

if($_POST['action']=="add")
{
 require_once('includes/db_conn.php');

         $date_requested=date('Y-m-d');
         $staffID = isset($_POST['staff_name']) ? $_POST['staff_name']:'';
	 $rate = isset($_POST['rate']) ? $_POST['rate']:'';
	 $purpose = isset($_POST['purpose']) ? $_POST['purpose']:'';
	 $leaving_date = isset($_POST['leaving_date']) ? $_POST['leaving_date']:'';
	 $return_date = isset($_POST['return_date']) ? $_POST['return_date']:'';
	 $place = isset($_POST['place']) ? $_POST['place']:'';
	 $night = isset($_POST['night']) ? $_POST['night']:'';
	 $addedby = isset($_POST['addedby']) ? $_POST['addedby']:'';
         //array data
         $items = isset($_POST['items']) ? $_POST['items'] : '';
         $other = isset($_POST['item_other']) ? $_POST['item_other'] : '';
         $description = isset($_POST['description']) ? $_POST['description'] : '';
         $amount = isset($_POST['amount']) ? $_POST['amount'] : '';
         
	
	 //insert data into databases
	 $insert = "INSERT INTO imprest(date_requested,staff_id,rate,purpose,leaving_date,return_date,place,night,addedby,status,stage) VALUES('$date_requested','$staffID','$rate','$purpose','$leaving_date','$return_date','$place','$night','$addedby','1','1')";
	 $query = mysqli_query($con,$insert);
	 if($query)
	 {
             //get the last imprest number
             $last_id = $con->insert_id;
          $number = count($items); 
          if($number > 0)
          {
              for($i=0; $i<$number; $i++)  
      {  
           if(trim($items[$i] != ''))  
           {   
        $insert_data = "INSERT INTO imprest_item(imprest_id,item_name,description,amount,other) VALUES('$last_id','$items[$i]','$description[$i]','$amount[$i]','$other[$i]')";
        $querydata = mysqli_query($con, $insert_data); 
           } 
              
          }//end of for
          }//end of if number > 0

		 header("Location: imprest_view.php");
		 exit();
	 }
	
}
?>