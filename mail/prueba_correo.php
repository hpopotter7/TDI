
<?php
$headers = "From: erp@administraciontierradeideas.mx\r\n";
//$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
//$headers .= "CC: susan@example.com\r\n";
//$headers .= "Bcc: alaneduardosandoval@yahoo.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";


$to="alaneduardosandoval@yahoo.com";
$asuto="Asunto de prueba";
$body="Mensaje de prueba ";
//send the message, check for errors
if (!mail($to, $asunto, $body, $headers)) {
    echo "Ocurrio un error al enviar la notificación".error_get_last()['message'];
} else {
    echo "Enviado";
}

?>