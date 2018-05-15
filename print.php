<?php 
ob_start();
session_start();
$id = $_GET['id'];
$_SESSION['form_id'] = $id;
include("mpdf/mpdf.php");

include 'requisition_form.php';
$content = ob_get_clean(); // get content of the buffer and clean the buffer

$mpdf=new mPDF('c','A4'); 
$title = "Requsition Form";


$mpdf->setTitle($title);
 
$mpdf->setCreator("PPRA");

 $mpdf->setAuthor("Justine");
        
$dateTime = date('Y-m-d');
        
$mpdf->SetFooter('produced by PPRA  @ '.$dateTime);
        
$mpdf->SetHeader($title);
        
$mpdf->SetWatermarkText('Original & Approved ', 0.05);
       
$mpdf->showWatermarkText = true;
 
$mpdf->SetDisplayMode('fullpage');
$mpdf->WriteHTML($content);
$mpdf->Output(); // output as inline content
ob_end_flush();

?>