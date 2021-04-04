<?php 
$id_proveedor=$_POST['id_proveedor'];
$proveedor=$_POST['proveedor'];
$rfc=$_POST['rfc'];
$nombre_comercial=$_POST['nombre_comercial'];
$tipo_persona=$_POST['tipo_persona'];
$descripcion=$_POST['descripcion'];
$cobertura=$_POST['cobertura'];
$cp=$_POST['cp'];
$estado=$_POST['estado'];
$municipio=$_POST['municipio'];
$colonia=$_POST['colonia'];
$calle=$_POST['calle'];
$ext=$_POST['ext'];
$int=$_POST['int'];
$tel=$_POST['tel'];
$extension=$_POST['extension'];
$celular=$_POST['celular'];
$nombre_contacto=$_POST['nombre_contacto'];
$correo_contacto=$_POST['correo_contacto'];
$uso_cfdi=$_POST['uso_cfdi'];
$usuario_solicita=$_COOKIE['user'];
$cuenta=$_POST['cuenta'];
$clabe=$_POST['clabe'];
$forma_pago=$_POST['forma_pago'];
$banco=$_POST['banco'];
$sucursal=$_POST['sucursal'];

$COB="";
    foreach ($cobertura as $value) {
        $COB=$COB.$value.",";
    }

include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$respuesta="nop";
	$result = $mysqli->query("SET NAMES 'utf8'");
	if($id_proveedor=="" || $id_proveedor==null || $id_proveedor=="0"){
		$sql="INSERT INTO proveedores (Numero_cliente,	Razon_Social, Nombre_comercial, rfc, Descripcion, Calle, num_ext, num_int, colonia, cp, estado, municipio, telefono, metodo_pago, nombre_contacto, correo_contacto, Usuario_solicita, cuenta, clabe, banco, sucursal, Tipo_persona, uso_cfdi, Fecha_solicitud, extension, celular, cobertura) VALUES ('0', '".strtoupper($proveedor)."', '".$nombre_comercial."', '".$rfc."', '".$descripcion."', '".strtoupper($calle)."', '".$ext."', '".$int."', '".strtoupper($colonia)."', '".$cp."', '".$estado."', '".strtoupper($municipio)."', '".$tel."', '".$forma_pago."', '".strtoupper($nombre_contacto)."', '".$correo_contacto."', '".$usuario_solicita."', '".$cuenta."', '".$clabe."', '".$banco."', '".$sucursal."', '".$tipo_persona."', '".$uso_cfdi."', NOW(), '".$extension."', '".$celular."', '".$COB."')";
		
		if ($mysqli->query($sql)) {
		    //$respuesta= "solicitud enviada";
		    $respuesta= "registro correcto";
		}
		else{
			$respuesta= $sql."<br>".mysqli_error($mysqli);
		}
	}
	else{
		$sql="UPDATE proveedores set Numero_cliente='P-".$id_proveedor."', Razon_Social='".$proveedor."', Nombre_comercial='".$nombre_comercial."', rfc='".$rfc."', Tipo_persona='".$tipo_persona."', cp='".$cp."', estado='".$estado."', municipio='".$municipio."', colonia='".$colonia."', calle='".$calle."', num_ext='".$ext."', num_int='".$int."', telefono='".$tel."', nombre_contacto='".$nombre_contacto."', correo_contacto='".$correo_contacto."', uso_cfdi='".$uso_cfdi."', extension='".$extension."', celular='".$celular."', cobertura='".$COB."', descripcion='".$descripcion."', metodo_pago='".$forma_pago."', cuenta='".$cuenta."', clabe='".$clabe."', banco='".$banco."', sucursal='".$sucursal."', Usuario_autoriza='".$usuario_solicita."', fecha_autorizacion=NOW()  where id_proveedor=".$id_proveedor;
		if ($mysqli->query($sql)) {
		    $respuesta= "Proveedor guardado";
		}
		else{
			$respuesta= $sql."<br>".mysqli_error($mysqli);
		}
	}
		if($respuesta=="registro correcto"){
			$id=$rfc;
			$sql="select max(id_proveedor) from proveedores";
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$id=$row[0]; 
					rename("proveedores/".$rfc, "proveedores/".$id);
					mkdir('proveedores/'.$id,0777);
					$respuesta= "registro correcto#".$id;
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