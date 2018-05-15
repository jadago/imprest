<?php
require_once('includes/db_conn.php');


$select = "SELECT * FROM users WHERE firstname LIKE 'fanuel%' LIMIT 1";
$query = mysqli_query($con,$select);
//print_r($query);
while($array = mysqli_fetch_array($query))
{
$name = "Shilla";
$phone = "255752280787";


// You have phone numbers then send messages 
       $message = "Dear ".$name.", you are reminded to retire your imprest, PPRA:";
       $username="ipsdemo";
	   $password = "ips**?ips2013";
	   $sender = "INSURANCE";
	   $fullname = "Justine";
	   send_sms($phone,$sender,$username,$password,$message,$fullname);
}


	function send_sms($phone,$sender,$username,$password,$message,$fullname){
	if ($phone !='') {
   if ($message !='') {
       //example
/*****
http://api.infobip.com/api/v3/sendsms/plain?user=ipsdemo&password=ips**?ips2013&sender=IPSAPP&SMSText=Justtesting&GSM=255689553614&type=longSMS
***/
	   $company=$sender;
       $url = 'http://api.infobip.com/api/v3/sendsms/plain?user='.$username.'&password='.$password.'&sender='.$company.'&SMSText='.$message.'
&GSM='.$phone.'&type=longSMS';
$xmlinfo = simplexml_load_file($url);

$status = $xmlinfo->result->status;
if($status == 0){
echo "Message Sent to ".$fullname;
}else{
echo "Error: Message not sent to ".$fullname."! API Code: ".$status." Contact API provider:";
}

      //echo $x;
   }
   else {
      echo "ERROR : Message not sent to ".$fullname."!-- Text parameter is missing!\r\n";
   }
}
else {
   echo "ERROR : Message not sent to ".$fullname."! -- Phone parameter is missing!\r\n";
}

echo "</br>";
	}
	
?>
