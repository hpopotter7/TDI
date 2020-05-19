<?php

date_default_timezone_set('America/Mexico_City');

//$rfc=$_POST['rfc'];
$asunto=$_POST['asunto'];
$evento=$_POST['evento'];
$usuario=$_POST['usuario'];
$texto=$_POST['texto'];
$proveedor=$_POST['proveedor'];

if($usuario==""){
	$usuario=$_COOKIE['user'];
}

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
	case "VoBo para solicitud de compra":
			include("../conexion.php");
			if (mysqli_connect_error()) {
				echo "Error de conexion: %s\n", mysqli_connect_error();
				exit();
			}
			$result = $mysqli->query("SET NAMES 'utf8'");
			$sql="";
			if($evento==""){
				$sql="select evento, vobo_solicito, vobo_project, vobo_coordinador, vobo_compras, vobo_direccion, vobo_finanzas, solicito, project, coordinador, compras, autorizo, finanzas, a_nombre, concepto, Importe_total from odc where id_odc=(SELECT max(id_odc) from odc)";
			}
			else{
				$sql="select evento, vobo_solicito, vobo_project, vobo_coordinador, vobo_compras, vobo_direccion, vobo_finanzas, solicito, project, coordinador, compras, autorizo, finanzas, a_nombre, concepto, Importe_total from odc where id_odc=".$evento;
			}
			
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$evento=$row[0];
					$vobo_solicito=$row[1];
					$vobo_project=$row[2];
					$vobo_coordinador=$row[3];
					$vobo_compras=$row[4];
					$vobo_direccion=$row[5];
					$vobo_finanzas=$row[6];
					$solicito=$row[7];
					$project=$row[8];
					$cordinador=$row[9];
					$compras=$row[10];
					$autorizo=$row[11];
					$finanzas=$row[12];
					$a_nombre=$row[13];
					$concepto=$row[14];
					$importe=$row[15];
					$bandera="";
					//orden solicito, ejecutivo, coordinador, compras, direccion, finanzas
					if($vobo_solicito=="0"){
						$bandera=$solicito;
					}
					else if($vobo_project=="0"){
						$bandera=$project;
					}
					else if($vobo_coordinador=="0"){
						$bandera=$cordinador;
					}
					else if($vobo_compras=="0"){
						$bandera=$compras;
					}
					else if($vobo_direccion=="0"){
						$bandera=$autorizo;
					}	
					else if($vobo_finanzas=="0"){
						$bandera=$finanzas;
					}
					else{
						$bandera="";
					}
				}
				$result->close();
			}
			else{
				$evento= "<br>".mysqli_error($mysqli);
			}
			$sql="select email from usuarios where Nombre='".$bandera."'";
			$usuario="";
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$to=$row[0].";sandrap@tierradeideas.mx;";
				}
				$result->close();
			}
			else{
				$evento= "<br>".mysqli_error($mysqli);
			}
			$sql="select Nombre_evento from eventos where Numero_evento='".$evento."'";
			$nombre_evento="";
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$nombre_evento=$row[0];
				}
				$result->close();
			}
			else{
				$evento= "<br>".mysqli_error($mysqli);
			}
			
			$resumen="<div class='col-md-10'><table class='table' border='1'><thead  style='background-color: rgb(49, 177, 60);'><tr><th>Proveedor</th><th>Concepto</th><th>Importe</th></tr></thead><tr>";
			$resumen=$resumen."<td>".$a_nombre."</td>";
			$resumen=$resumen."<td>".$concepto."</td>";
			$resumen=$resumen."<td>".'$'.number_format($importe, 2)."</td>";			
			$resumen=$resumen."</tr></table></div>";
			$tipo_letra="'Baloo Chettan 2'";
		$body='<html>
		<head>
			<title></title>
			<meta charset="utf-8">
			<link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
			<link href="https://fonts.googleapis.com/css2?family=Baloo+Chettan+2&display=swap" rel="stylesheet">
		</head>
		<body aria-readonly="false" style="font-family: '.$tipo_letra.', cursive;">&nbsp;&nbsp;<img alt="" src="https://administraciontierradeideas.mx/img/logo_chico.png" style="float:left" /><br />
		&nbsp;<p>
		<hr /><p><br />La siguiente solicitud del evento <b>['.$evento."] - ".$nombre_evento.'</b> esta pendiente de ser autorizada:<br>
		&nbsp;<br />'.$resumen.'
		&nbsp;<br />
		<i><strong>NOTA: Sin tu VoBo no se podrá autorizar las siguientes etapas</strong></i><p>
		<span style="font-size:10px"><span style="font-family:verdana,geneva,sans-serif"><em>&nbsp;Este es un mensaje autom&aacute;tico creado por el sistema ERP.&nbsp; Favor de no responder.</em></span></span><br />
		&nbsp;</body>
		</html>
		';
		
	break;
	/* case "Notificacion de solicitud":
			include("../conexion.php");
			if (mysqli_connect_error()) {
				echo "Error de conexion: %s\n", mysqli_connect_error();
				exit();
			}
			$result = $mysqli->query("SET NAMES 'utf8'");

			$sql="select e.Numero_evento, e.Nombre_evento, o.finanzas, o.autorizo, o.compras, o.coordinador, o.project, o.solicito from eventos e join odc o where e.Numero_evento=o.evento and o.id_odc=(select MAX(id_odc) from odc)";
			$evt="";
			$evento="";
			$solicito="";
			$array=array();
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$evento=$row[0];
					$evt=$row[1];
					
					array_push($array, $row[2]);
					array_push($array, $row[3]);
					array_push($array, $row[4]);
					array_push($array, $row[5]);
					array_push($array, $row[6]);
					$solicito=$row[7];
				}
				$result->close();
			}
			else{
				$evt= $sql."<br>".mysqli_error($mysqli);
			}
			for($r=0;$r<=count($array)-1;$r++){
				$sql="select email from usuarios where Nombre='".$array[$r]."'";
				if ($result = $mysqli->query($sql)) {
					while ($row = $result->fetch_row()) {
						$to=$to.$row[0].";";
					}
					$result->close();
				}
				else{
					$evt= $sql."<br>".mysqli_error($mysqli);
				}
			}
			$usuario=$solicito;
			$body='<html>
			<head>
				<title></title>
				<link href="https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css" rel="stylesheet" type="text/css" />
			</head>
			<body aria-readonly="false">&nbsp;&nbsp;<img alt="" src="https://administraciontierradeideas.mx/img/logo_chico.png" style="float:left" /><br />
			&nbsp;<br />
			&nbsp;<br />
			&nbsp;<p><br>
			<hr /><p><br />Se te ha agregado una solicitud del evento <b>'.$evento.' - '.$evt.'</b><br>
			&nbsp;<br />
			&nbsp;<br />
			<span style="font-size:10px"><span style="font-family:verdana,geneva,sans-serif"><em>&nbsp;Este es un mensaje autom&aacute;tico creado por el sistema ERP.&nbsp; Favor de no responder.</em></span></span><br />
			&nbsp;</body>
			</html>
			';
	break; */

}

include("../conexion.php");
if (mysqli_connect_error()) {
	echo "Error de conexion: %s\n", mysqli_connect_error();
	exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$link='<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">';

$body_mysql = str_replace($link,"", $body);
$body_mysql = $mysqli->real_escape_string($body_mysql);
$sql="INSERT INTO notificaciones (Asunto, Notificacion,	Fecha_hora,	Quien_hizo,	Visto,Para_quien) values('".$asunto."', '".$body_mysql."', NOW(), '".$usuario."', '0', '".$to."')";
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
    echo "Ocurrio un error al enviar la notificación".error_get_last()['message'];
} else {
    echo "Enviado".$respuesta;
}


?>