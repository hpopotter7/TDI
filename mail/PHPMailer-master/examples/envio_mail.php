<?php
//$rfc=$_POST['rfc'];
$asunto=$_POST['asunto'];
$evento=$_POST['evento'];
$usuario=$_POST['usuario'];
$texto=$_POST['texto'];
require '/PHPMailerAutoload.php';
include("parametros_mail.php");
//Set who the message is to be sent from
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
//$mail->addAddress('7kaskara7@gmail.com', 'Alan');
//Set the subject line

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment($rfc);

include("cuerpo.php");
$mail->MsgHTML($body);

//send the message, check for errors
if (!$mail->send()) {
    echo "Error: " . $mail->ErrorInfo;
} else {
    echo "Enviado";
}
?>