<?php 
$id=$_POST['id'];
$cliente=$_POST['cliente'];
$nombre_comercial=$_POST['nombre_comercial'];
$metodo=$_POST['metodo'];
$rfc=$_POST['rfc'];
$digitos=$_POST['digitos'];
$calle=$_POST['calle'];
$ext=$_POST['ext'];
$int=$_POST['int'];
$colonia=$_POST['colonia'];
$cp=$_POST['cp'];
$tel=$_POST['tel'];
$extension=$_POST['extension'];
$celular=$_POST['celular'];
$estado=$_POST['estado'];
$municipio=$_POST['municipio'];
$nombre_contacto=$_POST['nombre_contacto'];
$correo_contacto=$_POST['correo_contacto'];
$usuario_solicita=$_POST['usuario_solicita'];
$cuenta=$_POST['cuenta'];
$clabe=$_POST['clabe'];
$banco=$_POST['banco'];
$titulo=$_POST['titulo'];
$sucursal=$_POST['sucursal'];
$uso_cfdi=$_POST['uso_cfdi'];
$tipo=$_POST['tipo'];
$descripcion=$_POST['descripcion'];
$cobertura=$_POST['cobertura'];
$bandera_descargar="";
include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");

		$respuesta="nop";
		/*
		$sql="INSERT INTO clientes (Numero_cliente,	Nombre,	Calle, num_ext, num_int, colonia, cp, estado,	municipio, telefono, metodo_pago, rfc, digitos, nombre_contacto, correo_contacto, Usuario_solicita) VALUES ('0', '".strtoupper($cliente)."', '".strtoupper($calle)."', '".$ext."', '".$int."', '".strtoupper($colonia)."', '".$cp."', '".$estado."', '".strtoupper($municipio)."', '".$tel."', '".$metodo."', '".$rfc."', '".$digitos."', '".strtoupper($nombre_contacto)."', '".$correo_contacto."', '".$usuario_solicita."')";
		*/
    $ID="";
    if($tipo==="clientes"){
      $ID="id_cliente";
      $LETRA="C";
      $sql="UPDATE ".$tipo." SET Numero_cliente='".$LETRA."-0".$id."' , Razon_Social='".strtoupper($cliente)."', Nombre_comercial='".$nombre_comercial."', Calle='".strtoupper($calle)."', num_ext='".$ext."', num_int='".$int."', colonia='".strtoupper($colonia)."', cp='".$cp."', estado='".$estado."', municipio='".strtoupper($municipio)."', telefono='".$tel."', rfc='".$rfc."', digitos='".$digitos."', nombre_contacto='".strtoupper($nombre_contacto)."', correo_contacto='".strtoupper($correo_contacto)."', Usuario_autoriza='".$usuario_solicita."', uso_cfdi='".$uso_cfdi."', extension='".$extension."', celular='".$celular."' WHERE ".$ID."=".$id;
    }
    else{
      $ID="id_proveedor";
      $LETRA="P";
      $sql="UPDATE ".$tipo." SET Numero_cliente='".$LETRA."-0".$id."' , Razon_Social='".strtoupper($cliente)."', Nombre_comercial='".$nombre_comercial."', Calle='".strtoupper($calle)."', num_ext='".$ext."', num_int='".$int."', colonia='".strtoupper($colonia)."', cp='".$cp."', estado='".$estado."', municipio='".strtoupper($municipio)."', telefono='".$tel."', metodo_pago='".$metodo."', rfc='".$rfc."', digitos='".$digitos."', nombre_contacto='".strtoupper($nombre_contacto)."', correo_contacto='".strtoupper($correo_contacto)."', Usuario_autoriza='".$usuario_solicita."', cuenta='".$cuenta."', clabe='".$clabe."', banco='".$banco."', sucursal='".$sucursal."', uso_cfdi='".$uso_cfdi."', Descripcion='".$descripcion."', extension='".$extension."', celular='".$celular."', Cobertura='".$cobertura."' WHERE ".$ID."=".$id;
    }

		
		if ($mysqli->query($sql)) {
		    $respuesta= "cliente actualizado";
		}
		else{
			$respuesta= $sql."<br>".mysqli_error($mysqli);
		}
    $num_cliente="0";
		$sql="SELECT u.email, c.Usuario_solicita, u.Nombre, c.Numero_cliente FROM ".$tipo." c, usuarios u WHERE c.Usuario_solicita=u.Nombre and c.".$ID."=".$id;
		if ($result = $mysqli->query($sql)) {
			while ($row = $result->fetch_row()) {
				$correo=$row[0];
        $nombre_usuario=$row[2];
        $num_cliente=$row[3];
			}
		}
		else{
			$respuesta= $sql."<br>".mysqli_error($mysqli);
		}
    if($num_cliente!="0"){
      $sql="UPDATE ".$tipo." SET Fecha_Autorizacion=NOW() WHERE ".$ID."=".$id;
      if ($mysqli->query($sql)) {
        $bandera_descargar="DESCARGAR";
      }
    }
    $mysqli->close();
// envio de confirmacion
    /*if($num_cliente!="0"){
      
    	require ('PHPMailer-master/PHPMailerAutoload.php');
      $mail = new PHPMailer();
      //Tell PHPMailer to use SMTP
      //$mail->isSMTP();
      //Enable SMTP debugging
      // 0 = off (for production use)
      // 1 = client messages
      // 2 = client and server messages
      $mail->SMTPDebug = 0;
      //Ask for HTML-friendly debug output
      $mail->Debugoutput = 'html';
      //Set the hostname of the mail server
      //$mail->Host       = "handcraft.com.mx";
      $mail->Host       = "mail.administraciontierradeideas.mx";
      //Set the SMTP port number - likely to be 25, 465 or 587
      $mail->Port       = 26;
      //Whether to use SMTP authentication
      $mail->SMTPAuth   = true;
      $mail->SMTPSecure = 'ssl';
       $mail->IsHTML(true);
      //Username to use for SMTP authentication
      $mail->Username   = "notificaciones@administraciontierradeideas.mx";
      //Password to use for SMTP authentication
      $mail->Password   = "@ERPideas2019";
      //Set who the message is to be sent from
      $mail->setFrom('notificaciones@administraciontierradeideas.mx', 'Sistema admin');
      //Set an alternative reply-to address
      $mail->addAddress($correo, $nombre_usuario); 
      $mail->addBCC('7kaskara7@gmail.com', 'Alan');

      //Set who the message is to be sent to
      $mail->addCC('sandrap@tierradeideas.mx', 'Sandra Peña');
      //Set the subject line
      if($titulo=="Solicitud de alta de proveedor"){
      	$tipo="proveedor";
      }
      else{
      	 $tipo="cliente";
      }
      $mail->Subject = 'Confirmación de alta de'.$tipo;
      $mail->CharSet = 'UTF-8';
      //Read an HTML message body from an external file, convert referenced images to embedded,
      //convert HTML into a basic plain-text alternative body
       $body='<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
      <html>
      <head>
        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
      </head>
      <body>
      <div style="width: 640px; font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
        
        Se ha autorizado el '.$tipo.': <b>'.$cliente.'</b>, con el No. <b>'.$id.'</b><br><p>

      </div>
      </body>
      </html>
      ';
      $mail->MsgHTML($body);
      if (!$mail->send()) {
          $respuesta=$respuesta+"Mailer Error: " . $mail->ErrorInfo;
      } else {
      	  $respuesta= "cliente actualizado";
          
      }
      
    }*/
    
		echo $respuesta."-".$bandera_descargar;

	
?>