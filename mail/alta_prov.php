<?php
$asunto=$_POST['asunto'];
$evento=$_POST['evento'];
$usuario=$_POST['usuario'];
$texto=$_POST['texto'];
$proveedor=$_POST['proveedor'];
require 'PHPMailer-master/PHPMailerAutoload.php';
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
$mail->Subject = 'Solicitud de proveedor';
$mail->setFrom('administracion@tierradeideas.mx', 'Sistema admin');
$mail->addBcc('alaneduardosandoval@yahoo.com', 'Alan');

$mail->addAddress('smartinez@tierradeideas.mx', 'SANAYN MARTINEZ');
	$body='<html>
		<head>
			<title></title>
			<link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
		</head>
		<body aria-readonly="false">&nbsp;&nbsp;<img alt="" src="https://administraciontierradeideas.mx/img/logo.png" style="float:left; height:70px; margin:2px; width:90px" /><br />
		&nbsp;<br />
		&nbsp;<br />
		&nbsp;<p><br>
		<hr /><p><br />El usuario <b>SANDRA PEÑA</b> a solicitado el alta del proveedor: <p><b>SPARKLAB SAPI DE CV</b><br>
		&nbsp;<br />
		&nbsp;<br />
		<span style="font-size:10px"><span style="font-family:verdana,geneva,sans-serif"><em>&nbsp;Este es un mensaje autom&aacute;tico creado por el sistema ERP.&nbsp; Favor de no responder.</em></span></span><br />
		&nbsp;</body>
		</html>
		';
$mail->MsgHTML($body);

//send the message, check for errors
if (!$mail->send()) {
    echo "Error: " . $mail->ErrorInfo;
} else {
    echo "Enviado";
}
?>