<?php

require '../includes/phpmailer/class.phpmailer.php';
function sendmail($from,$fromname,$to,$subject,$body)
{
//SMTP Mail start

$mail = new PHPMailer();
//$mail->IsSendmail();
$mail->IsSMTP();  // telling the class to use SMTP
$mail->Mailer = "smtp";
$mail->Host = "smtp.mandrillapp.com";
$mail->Port = 587;
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "dummy"; // SMTP username
$mail->Password = "dummy"; // SMTP password

$mail->IsHTML(true);
$mail->From = 'dummy'; // Sender email ID
if ($from != '')
    $mail->From = $from;
$mail->FromName = 'dummy'; // Sender name
if ($fromname != '')
    $mail->FromName = $fromname;
$mail->addAddress($to, $to);  // Add a recipient
if (($from != '') && ($fromname != ''))
    $mail->addReplyTo($from, $fromname);

$mail->Subject = $subject;
$mail->Body    = preg_replace('#(\\\r\\\n)#', '<br/>', $body);

if(!$mail->send()) {
   echo 'Message could not be sent.';
   echo 'Mailer Error: ' . $mail->ErrorInfo;
   exit;
}
//SMTP Mail End
}

?>

