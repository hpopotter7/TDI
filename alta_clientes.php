<?php 
$cliente=$_POST['cliente'];
$nombre_comercial=$_POST['nombre_comercial'];
//$metodo=$_POST['metodo'];
$rfc=$_POST['rfc'];
$digitos=$_POST['digitos'];
$tipo_persona=$_POST['tipo_persona'];
$calle=$_POST['calle'];
$ext=$_POST['ext'];
$int=$_POST['int'];
$colonia=$_POST['colonia'];
$cp=$_POST['cp'];
$tel=$_POST['tel'];
$estado=$_POST['estado'];
$municipio=$_POST['municipio'];
$nombre_contacto=$_POST['nombre_contacto'];
$correo_contacto=$_POST['correo_contacto'];
$nombre_contacto2=$_POST['nombre_contacto2'];
$correo_contacto2=$_POST['correo_contacto2'];
$usuario_solicita=$_POST['usuario_solicita'];
$descripcion=$_POST['descripcion'];
$uso_cfdi=$_POST['uso_cfdi'];
$respuesta="";
include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");

	$sql="select Razon_social from clientes where Razon_social='".strtoupper($cliente)."'";
	if ($result = $mysqli->query($sql)) {
	  while ($row = $result->fetch_row()) {
	      $respuesta='ya existe';
	  }
	}
	else{
		$respuesta= mysqli_error($mysqli)."<br>".$sql;
	}
	if($respuesta!="ya existe"){
		$respuesta="nop";

		$sql="INSERT INTO clientes (Numero_cliente,	Razon_social, Nombre_comercial, rfc, digitos, Tipo_persona, cp, estado, municipio, colonia, Calle, num_ext, num_int, telefono, nombre_contacto, correo_contacto, nombre_contacto2, correo_contacto2, uso_cfdi, Usuario_solicita, Fecha_solicitud) VALUES ('0', '".strtoupper($cliente)."', '".$nombre_comercial."', '".$rfc."', '".$digitos."', '".$tipo_persona."', '".$cp."', '".$estado."', '".$municipio."', '".$colonia."', '".$calle."', '".$ext."', '".$int."', '".$tel."', '".$nombre_contacto."', '".$correo_contacto."', '".$nombre_contacto2."', '".$correo_contacto2."', '".$uso_cfdi."', '".$usuario_solicita."', NOW())";
		$result = $mysqli->query("SET NAMES 'utf8'");
		if ($mysqli->query($sql)) {
		    //$respuesta= "solicitud enviada";
		    $respuesta= "registro correcto";
		}
		else{
			$respuesta= $sql."<br>".mysqli_error($mysqli);
		}
	}
		echo $respuesta;

	$mysqli->close();
?>