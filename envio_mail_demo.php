<?php

$to = 'alaneduardosandoval@yahoo.com';

$subject = 'Website Change Request';

$headers = "From: erp@administraciontierradeideas.mx\r\n";
//$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
//$headers .= "CC: susan@example.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

$message = '<html><body>>h1>Hello, World!</h1></body></html>';



if (mail($to, $subject, $message, $headers)) {
    echo 'Your message has been sent.';
  } else {
    echo 'There was a problem sending the email.';
  }

?>