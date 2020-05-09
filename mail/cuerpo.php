<?php 
$body="";
switch($asunto){
	case "Solicitud de modificación":
	//$mail->addAddress('sandrap@tierradeideas.mx', 'Sandra Peña');
	$to = 'sandrap@tierradeideas.mx';
	$body='<html>
		<head><meta http-equiv="Content-Type" content="text/html; charset=gb18030">
			<title></title>
			<link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
		</head>
		<body aria-readonly="false">&nbsp;&nbsp;<img alt="" src="https://administraciontierradeideas.mx/img/logo_chico.png" style="float:left" /><br />
		&nbsp;<br />
		&nbsp;<br />
		&nbsp;<p>
		<hr /><p><br />El usuario <b>'.$usuario.'</b> a solicitado una modificación para el evento <b>'.$evento.'</b>:<p><br> 
		'.$texto.'
		<br />
		&nbsp;<br />
		&nbsp;<br />
		<span style="font-size:10px"><span style="font-family:verdana,geneva,sans-serif"><em>&nbsp;Este es un mensaje autom&aacute;tico creado por el sistema ERP.&nbsp; Favor de no responder.</em></span></span><br />
		&nbsp;</body>
		</html>
		';
	break;
	case "Solicitud de proveedor":
	//$mail->addAddress('mich@tierradeideas.mx', 'MIGUEL POBLACION');
	$to = 'mich@tierradeideas.mx';
	$body='<html>
		<head>
			<title></title>
			<link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
		</head>
		<body aria-readonly="false">&nbsp;&nbsp;<img alt="" src="https://administraciontierradeideas.mx/img/logo_chico.png" style="float:left" /><br />
		&nbsp;<br />
		&nbsp;<br />
		&nbsp;<p><br>
		<hr /><p><br />El usuario <b>'.$usuario.'</b> a solicitado el alta del proveedor: <p><b>'.$proveedor.'</b><br>
		&nbsp;<br />
		&nbsp;<br />
		<span style="font-size:10px"><span style="font-family:verdana,geneva,sans-serif"><em>&nbsp;Este es un mensaje autom&aacute;tico creado por el sistema ERP.&nbsp; Favor de no responder.</em></span></span><br />
		&nbsp;</body>
		</html>
		';
	break;
	case "Solicitud de cliente":
	//$mail->addAddress('sandrap@tierradeideas.mx', 'Sandra Peña');
	$to = 'sandrap@tierradeideas.mx';
	$body='<html>
		<head>
			<title></title>
			<link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
		</head>
		<body aria-readonly="false">&nbsp;&nbsp;<img alt="" src="https://administraciontierradeideas.mx/img/logo_chico.png" style="float:left" /><br />
		&nbsp;<br />
		&nbsp;<br />
		&nbsp;<p><br>
		<hr /><p><br />El usuario <b>'.$usuario.'</b> a solicitado el alta del cliente: <p><b>'.$proveedor.'</b><br>
		&nbsp;<br />
		&nbsp;<br />
		<span style="font-size:10px"><span style="font-family:verdana,geneva,sans-serif"><em>&nbsp;Este es un mensaje autom&aacute;tico creado por el sistema ERP.&nbsp; Favor de no responder.</em></span></span><br />
		&nbsp;</body>
		</html>
		';
	break;
	case "Notificacion de limite":
		
		// $mail->addAddress('sandrap@tierradeideas.mx', 'Sandra Peña');
		// $mail->AddCC('fcarrera@tierradeideas.mx', 'Fernanda Carrera');
		// $mail->AddCC('andresemanuelli@tierradeideas.mx', 'Andres Emanuelli');
		$to = 'sandrap@tierradeideas.mx, fcarrera@tierradeideas.mx, andresemanuelli@tierradeideas.mx';
		$body='<html>
		<head>
			<title></title>
			<link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
		</head>
		<body aria-readonly="false">&nbsp;&nbsp;<img alt="" src="https://administraciontierradeideas.mx/img/logo_chico.png" style="float:left" /><br />
		&nbsp;<br />
		&nbsp;<br />
		&nbsp;<p><br>
		<hr /><p><br />El usuario <b>'.$usuario.'</b> a realizado una solicitud para el evento: <p><b>'.$evento.'</b>, la cual esta llegando al límite de lo presupuestado.
		&nbsp;<br />
		&nbsp;<br />
		<span style="font-size:10px"><span style="font-family:verdana,geneva,sans-serif"><em>&nbsp;Este es un mensaje autom&aacute;tico creado por el sistema ERP.&nbsp; Favor de no responder.</em></span></span><br />
		&nbsp;</body>
		</html>
		';
	break;

}
 
 ?>