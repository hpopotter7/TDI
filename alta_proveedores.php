<?php 
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
$tipo=$_POST['tipo'];
$sucursal=$_POST['sucursal'];
$tipo_persona=$_POST['tipo_persona'];
$descripcion=$_POST['descripcion'];
$uso_cfdi=$_POST['uso_cfdi'];
$cobertura=$_POST['cobertura'];

include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
		$respuesta="nop";

		$sql="INSERT INTO proveedores (Numero_cliente,	Razon_Social, Nombre_comercial, rfc, Descripcion, Calle, num_ext, num_int, colonia, cp, estado, municipio, telefono, metodo_pago, digitos, nombre_contacto, correo_contacto, Usuario_solicita, cuenta, clabe, banco, sucursal, Tipo_persona, uso_cfdi, Fecha_solicitud, extension, celular, cobertura) VALUES ('0', '".strtoupper($cliente)."', '".$nombre_comercial."', '".$rfc."', '".$descripcion."', '".strtoupper($calle)."', '".$ext."', '".$int."', '".strtoupper($colonia)."', '".$cp."', '".$estado."', '".strtoupper($municipio)."', '".$tel."', '".$metodo."', '".$digitos."', '".strtoupper($nombre_contacto)."', '".$correo_contacto."', '".$usuario_solicita."', '".$cuenta."', '".$clabe."', '".$banco."', '".$sucursal."', '".$tipo_persona."', '".$uso_cfdi."', NOW(), '".$extension."', '".$celular."', '".$cobertura."')";
		$result = $mysqli->query("SET NAMES 'utf8'");
		if ($mysqli->query($sql)) {
		    //$respuesta= "solicitud enviada";
		    $respuesta= "registro correcto";
		}
		else{
			$respuesta= $sql."<br>".mysqli_error($mysqli);
		}
		if($respuesta=="registro correcto"){
			$id=$rfc;
			$sql="select max(id_proveedor) from proveedores";
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$id=$row[0]; 
					rename("proveedores/".$rfc, "proveedores/".$id);
					$respuesta= "registro correcto";
				}
				$result->close();
			}	      
			else{
				$respuesta="proveedores guardado - Error:".mysqli_error($mysqli);
			  	$mysqli->close();
			  	exit();
			}
		}
		echo $respuesta;

	$mysqli->close();
?>