<?php

 
require_once '../assetes/vendor/autoload.php';
$mr = '3px';
$mpdf = new \Mpdf\Mpdf();
// $mpdf->showImageErrors = true;
ob_start();
include "pdf_html.php" ;
// Write some HTML content
$html = ob_get_clean();

$mpdf->WriteHTML($html);

// Output the PDF
$file='C:\xampp\htdocs\First_Project\invoice_files/'.time().'.pdf';

$mpdf->Output($file,'I');



?>
