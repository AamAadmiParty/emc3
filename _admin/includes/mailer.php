<?php
require '../includes/phpmailer/class.phpmailer.php';
function sendmail($from,$fromname,$to,$subject,$body)
{
//SMTP Mail start
	
$mail = new PHPMailer();  
 
$mail->IsSMTP();  // telling the class to use SMTP
$mail->Mailer = "smtp";

$mail->Host = "smtp.mandrillapp.com";
$mail->Port = 587;
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "dummy"; // SMTP username
$mail->Password = "dummy"; // SMTP password
    
$mail->IsHTML(true);
$mail->From = $from;
$mail->FromName = $fromname;
$mail->addAddress($to, $to);  // Add a recipient
$mail->addReplyTo($from, $fromname);

$mail->Subject = $subject;
$mail->Body    = $body;

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
//SMTP Mail End	
} 

?>