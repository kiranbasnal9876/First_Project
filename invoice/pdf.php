<?php

//  echo phpinfo();die;
require_once '../assetes/vendor/autoload.php';
$mr = '3px';
$mpdf = new \Mpdf\Mpdf();
// $mpdf->showImageErrors = true;
ob_start();
include "pdf_html.php";
// Write some HTML content
$html = ob_get_clean();

$mpdf->WriteHTML($html);

// Output the PDF
// if($invoice_no.".pdf");
$file='C:\xampp\htdocs\First_Project\invoice_files/'.$invoice_no.'.pdf';

$mpdf->Output($file,'I');



?>
