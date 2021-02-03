<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/PHPMailer/src/Exception.php';
require 'vendor/PHPMailer/src/PHPMailer.php';
require 'vendor/PHPMailer/src/SMTP.php';

// Load Composer's autoloader
require 'vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer();
// Set PHPMailer to use the sendmail transport
$mail->isSendmail();
//Set who the message is to be sent from
$mail->setFrom('erp@administraciontierradeideas.mx', 'Sistema ERP');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('7kaskara7@gmail.com', 'Alan Sandoval');
//Set the subject line
$mail->Subject = 'PHPMailer sendmail test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
$mail->msgHTML('<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf8">
    <title></title>
    <meta charset="utf-8">
    <link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2&display=swap" rel="stylesheet">
</head>
<body aria-readonly="false">&nbsp;&nbsp;<img alt="" src="https://administraciontierradeideas.mx/img/logo_chico.png" style="float:left" /><br />
&nbsp;<p>
<hr /><p><br />La siguiente solicitud del evento <b>[2019-001] - ".$nombre_evento.</b> esta pendiente de ser autorizada:<br>
&nbsp;<br />tabla resumen
&nbsp;<br />
<div class="row"></div>
<div>Puedes atender dicha solcitud <i></i><a class="btn btn-info btn_atender" id="id_boton" href="close-modal" >Aqui</a></div><p>
<div>
<i><strong>NOTA: Sin tu VoBo no se podr&aacute; autorizar las siguientes etapas</strong></i></div><p>
<span style="font-size:10px"><span style="font-family:verdana,geneva,sans-serif"><em>&nbsp;Este es un mensaje autom&aacute;tico creado por el sistema ERP.&nbsp; Favor de no responder.</em></span></span><br />
&nbsp;</body>
</html>');
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message sent!';
}
?>//