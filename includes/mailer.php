<?php
require 'phpmailer/class.phpmailer.php';
function sendmail($from,$fromname,$to,$subject,$body)
{
//SMTP Mail start

$mail = new PHPMailer();
//$mail->IsSendmail();
$mail->IsSMTP();  // telling the class to use SMTP
$mail->Mailer = "smtp";
$mail->Host = "localhost";
$mail->Port = 25;

$mail->IsHTML(true);
$mail->From = 'dummy';
$mail->FromName = 'dummy';
$mail->addAddress($to, $to);  // Add a recipient
if (($from != '') && ($fromname != ''))
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

