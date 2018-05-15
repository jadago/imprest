<?php
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
//require 'vendor/autoload.php';

$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'ssl://mail.ppra.go.tz';                    // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'jastine.govela@ppra.go.tz';                 // SMTP username
    $mail->Password = 'ppra2021';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('jastine.govela@ppra.go.tz');
    $mail->addAddress('jastine.govela@ppra.go.tz');     // Add a recipient              // Name is optional
    //$mail->addReplyTo('info@example.com');
   // $mail->addCC('fanuel.yengayenga@ppra.go.tz');
    //$mail->addBCC('bcc@example.com');

    //Attachments
   // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
  //$mail->addAttachment('images/ppra_logo.jpg', 'ppra_logo.jpg');    // Optional name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Imprest Status - February';
    $mail->Body="
<html>
<head>
<title>Untitled Document</title>
</head>

<body>
<table>
  <tr>
    <td><img src='http://iwijicontractors.co.tz/sample/ppra_logo.jpg'/></td>
  </tr>
  <tr>
    <td><p>You have outstanding imprest of Tsh. 13,000,000. Please retire as soon as possible</p>
    <p>Regards,</p>
    <p>PPRA</p></td>
  </tr>
</table>

</body>
</html>
";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    //echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
}
?>