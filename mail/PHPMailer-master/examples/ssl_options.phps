<?php
/**
 * This example shows settings to use when sending over SMTP with TLS and custom connection options.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require '../PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'mail.administraciontierradeideas.mx';

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 25;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Custom connection options
$mail->SMTPOptions = array (
    'ssl' => array(
        'verify_peer'  => true,
        'verify_depth' => 3,
        'allow_self_signed' => true,
        'peer_name' => 'smtp.example.com',
        'cafile' => '/etc/ssl/ca_cert.pem',
    )
);

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "notificaciones@administraciontierradeideas.mx";

//Password to use for SMTP authentication
$mail->Password = "@ERPideas2019";

//Set who the message is to be sent from
$mail->setFrom('notificaciones@administraciontierradeideas.mx', 'Sistema admin');

//Set who the message is to be sent to
$mail->addAddress('7kaskara7@gmail.com', 'Alan');

//Set the subject line
$mail->Subject = 'PHPMailer SMTP options test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
