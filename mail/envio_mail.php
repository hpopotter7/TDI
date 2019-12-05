<?php

date_default_timezone_set('America/Mexico_City');

//$rfc=$_POST['rfc'];
$asunto=$_POST['asunto'];
$evento=$_POST['evento'];
$usuario=$_POST['usuario'];
$texto=$_POST['texto'];
$proveedor=$_POST['proveedor'];


$body="";
switch($asunto){
    case "Solicitud de modificación":
        $asunto="Solicitud de modificacion";
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
	//$mail->addAddress('smartinez@tierradeideas.mx', 'SANAYN MARTINEZ');
	$to = 'smartinez@tierradeideas.mx';
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
		include("../conexion.php");
if (mysqli_connect_errno()) {
			printf("Error de conexion: %s\n", mysqli_connect_error());
			exit();
		}
		$result = $mysqli->query("SET NAMES 'utf8'");
		$arr=explode("]",$evento);
    	$ID=str_replace("[", "", $arr[0]);
		$sql="select Disenio, Ejecutivo, Produccion, Solicita, Ejecutivo, Digital from eventos where Numero_evento='".$ID."'";
		$to="";
		if ($result = $mysqli->query($sql)) {
			while ($row = $result->fetch_row()) {
				$valor1=$row[0];
				if($valor1==",NA"){
					$valor1="";
				}
				$valor2=$row[1];
				if($valor2==",NA"){
					$valor2="";
				}
				$valor3=$row[2];
				if($valor3==",NA"){
					$valor3="";
				}
				$valor4=$row[3];
				if($valor4==",NA"){
					$valor4="";
				}
				$valor5=$row[4];
				if($valor5==",NA"){
					$valor5="";
				}
				$to=$to.$valor1.$valor2.$valor3.$valor4.$valor5.",";
			}
			$result->close();
		}
		$result = $mysqli->query("SET NAMES 'utf8'");
		$usuarios=explode(",",$to);
		$resultado = array_unique($usuarios);
		$to="";
		for ($i=0; $i<sizeof($resultado); $i++) {
			$sql="select email from usuarios where Nombre='".$resultado[$i]."'";
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$to=$to.$row[0].", ";
				}
				$result->close();
			}
		}
			$to=substr($to, 0,strlen($to)-1);
			$to=strtolower($to);
		$mysqli->close();
		$to = $to.', sandrap@tierradeideas.mx, fcarrera@tierradeideas.mx, andresemanuelli@tierradeideas.mx';
		$body='<html>
		<head>
			<title></title>
			<link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
		</head>
		<body aria-readonly="false">&nbsp;&nbsp;<img alt="" src="https://administraciontierradeideas.mx/img/logo_chico.png" style="float:left" /><br />
		&nbsp;<br />
		&nbsp;<br />
		&nbsp;<p><br>
		<hr /><p><br />El usuario <b>'.$usuario.'</b> a realizado una solicitud para el evento: <p><b>'.$evento.'</b>, la cual esta llegando al l&iacute;mite de lo presupuestado.
		&nbsp;<br />
		&nbsp;<br />
		<span style="font-size:10px"><span style="font-family:verdana,geneva,sans-serif"><em>&nbsp;Este es un mensaje autom&aacute;tico creado por el sistema ERP.&nbsp; Favor de no responder.</em></span></span><br />
		&nbsp;</body>
		</html>
		';
	break;

}

include("../conexion.php");
if (mysqli_connect_error()) {
	echo "Error de conexion: %s\n", mysqli_connect_error();
	exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="INSERT INTO notificaciones (Asunto, Notificacion,	Fecha_hora,	Quien_hizo,	Visto,	Para_quien) values('".$asunto."', '".$body."', NOW(), '".$usuario."', '0', '".$to."')";
if ($mysqli->query($sql)) {
	$respuesta= "Registro guardado";
}
else{
	$respuesta= $sql."<br>".mysqli_error($mysqli);
}

$headers = "From: ERP@Tierradeideas.mx\r\n";
//$headers .= "Reply-To: ". strip_tags($_POST['req-email']) . "\r\n";
//$headers .= "CC: susan@example.com\r\n";
$headers .= "Bcc: alaneduardosandoval@yahoo.com\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";



//send the message, check for errors
if (!mail($to, $asunto, $body, $headers)) {
    echo "Ocurrio un error al enviar la notificación".error_get_last()['message'];;
} else {
    echo "Enviado".$respuesta;
}


?>