<?php 
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
//$mail->isSMTP();
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
$mail->Host       = "smtp.office365.com";
$mail->Port       = 587;
$mail->SMTPAuth   = true;
$mail->SMTPSecure = 'tls';
$mail->IsHTML(true);
$mail->Username   = "administracion@tierradeideas.mx";
$mail->Password   = "Tierra5deas18";
$mail->CharSet = 'UTF-8';
$mail->Subject = $asunto;
$mail->setFrom('administracion@tierradeideas.mx', 'Sistema admin');
$mail->addBcc('alaneduardosandoval@yahoo.com', 'Alan');


 ?>