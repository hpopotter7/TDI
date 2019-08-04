<?php

require 'PHPMailer-master/PHPMailerAutoload.php';
include "parametros_mail.php";
//Create a new PHPMailer instance

  $mail = new PHPMailer();
  //Tell PHPMailer to use SMTP
  //$mail->isSMTP();
  //Enable SMTP debugging
  // 0 = off (for production use)
  // 1 = client messages
  // 2 = client and server messages
  $mail->SMTPDebug = 0;
  //Ask for HTML-friendly debug output
  $mail->Debugoutput = 'html';
  //Set the hostname of the mail server
  //$mail->Host       = "handcraft.com.mx";
  $mail->Host       = $HOST;
  //Set the SMTP port number - likely to be 25, 465 or 587
  $mail->Port       = $PORT;
  //Whether to use SMTP authentication
  $mail->SMTPAuth   = true;
  $mail->SMTPSecure = 'ssl';
   $mail->IsHTML(true);
  //Username to use for SMTP authentication
  $mail->Username   = $USERNAME;
  //Password to use for SMTP authentication
  $mail->Password   = $PASSWORD;
  //Set who the message is to be sent from
  $mail->setFrom($USERNAME, 'Sistema admin');
  //Set an alternative reply-to address
  $mail->addAddress('7kaskara7@gmail.com', 'Alan');
  //Set who the message is to be sent to
  $mail->addAddress('sandrap@tierradeideas.mx', 'Sandra Peña');
//Set the subject line
$mail->Subject = $ASUNTO;
$mail->CharSet = 'UTF-8';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$body=$CUERPO;
$mail->MsgHTML($body);
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment($tmp_archivo, $name);

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Enviado ";
}

?>