<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['send_to'])){
    $to=$_POST['send_to'];
    $subject=$_POST['subject'];
    $content=$_POST['content'];
    // $attch_pdf=$_FILES['invoice_pdf']['name'];
    $invoice_no=$_POST['pdf_invoice'];
    send_mail($to,$subject,$content,$invoice_no);
}

function send_mail($to, $subject, $content,$invoice_no)
{
    require_once '../assetes/vendor/autoload.php';
 
    $mail = new PHPMailer(true);
    $error="";
    $success="";
    try {
                   
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'dimpalbasnal0@gmail.com';
        $mail->Password   = 'lehk fctt zjvc ytsf';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;
        //T
        //Recipients
        $mail->setFrom('dimpalbasnal0@gmail.com', 'kiran Basnal');
        $mail->addAddress($to, 'php mail');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');
        // $mail->addCC('cc@example.com');
        // $mail->addBCC('bcc@example.com');

        //Attachments
        $mail->addAttachment('../invoice_files/'.$invoice_no.'.pdf');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        $mail->isHTML(true);                                 
        $mail->Subject = $subject;
        $mail->Body    = $content;
     

        $mail->send();
        $success= 'Message has been sent';
    } catch (Exception $e) {
        $error= "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    echo json_encode(['success'=>$success,'error'=>$error]);
}
