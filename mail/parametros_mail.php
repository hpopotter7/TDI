<?php 
/*
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
$mail->Password   = "TierraERP2019";
$mail->CharSet = 'UTF-8';
$mail->Subject = $asunto;
$mail->setFrom('administracion@tierradeideas.mx', 'Sistema admin');
$mail->addBcc('alaneduardosandoval@yahoo.com', 'Alan');
*/



$headers = "From: ERP Tierradeideas.mx\r\n";
//$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
//$headers .= "CC: susan@example.com\r\n";
$headers .= "Bcc: alaneduardosandoval@yahoo.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
//$message = '<html><body>>h1>Hello, World!</h1></body></html>';

 ?>