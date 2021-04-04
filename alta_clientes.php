<?php 
$id_cliente=$_POST['id_cliente'];
$cliente=$_POST['cliente'];
$nombre_comercial=$_POST['nombre_comercial'];
$rfc=$_POST['rfc'];
$dias_credito=$_POST['dias_credito'];
$tipo_persona=$_POST['tipo_persona'];
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
$nombre_contacto2=$_POST['nombre_contacto2'];
$correo_contacto2=$_POST['correo_contacto2'];
$usuario_solicita=$_POST['usuario_solicita'];
$descripcion=$_POST['descripcion'];
$uso_cfdi=$_POST['uso_cfdi'];

include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
		$respuesta="nop";
		$result = $mysqli->query("SET NAMES 'utf8'");
	if($id_cliente=="" || $id_cliente==null || $id_cliente=="0"){
		$sql="INSERT INTO clientes (Numero_cliente,	Razon_social, Nombre_comercial, rfc, Tipo_persona, cp, estado, municipio, colonia, Calle, num_ext, num_int, telefono, nombre_contacto, correo_contacto, nombre_contacto2, correo_contacto2, uso_cfdi, Usuario_solicita, Fecha_solicitud, extension, celular, Dias_credito) VALUES ('0', '".strtoupper($cliente)."', '".$nombre_comercial."', '".$rfc."', '".$tipo_persona."', '".$cp."', '".$estado."', '".$municipio."', '".$colonia."', '".$calle."', '".$ext."', '".$int."', '".$tel."', '".$nombre_contacto."', '".$correo_contacto."', '".$nombre_contacto2."', '".$correo_contacto2."', '".$uso_cfdi."', '".$usuario_solicita."', NOW(), '".$extension."', '".$celular."', '".$dias_credito."')";
		if ($mysqli->query($sql)) {
		    $respuesta= "registro correcto";
		}
		else{
			$respuesta= $sql."<br>".mysqli_error($mysqli);
		}
	}
	else{
		$sql="UPDATE clientes set Numero_cliente='C-".$id_cliente."', Razon_Social='".$cliente."', Nombre_comercial='".$nombre_comercial."', rfc='".$rfc."', Tipo_persona='".$tipo_persona."', cp='".$cp."', estado='".$estado."', municipio='".$municipio."', colonia='".$colonia."', calle='".$calle."', num_ext='".$ext."', num_int='".$int."', telefono='".$tel."', nombre_contacto='".$nombre_contacto."', correo_contacto='".$correo_contacto."', uso_cfdi='".$uso_cfdi."', extension='".$extension."', celular='".$celular."', Dias_credito='".$dias_credito."' where id_cliente=".$id_cliente;
		if ($mysqli->query($sql)) {
		    $respuesta= "Cliente guardado";
		}
		else{
			$respuesta= $sql."<br>".mysqli_error($mysqli);
		}
	}
		
		if($respuesta=="registro correcto"){			
			$id=$rfc;
			$sql="select max(id_cliente) from clientes";
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$id=$row[0]; 
					rename("clientes/".$rfc, "clientes/".$id);
					mkdir('clientes/'.$id,0777);
					$respuesta= "registro correcto#".$id;
				}
				$result->close();
			}	      
			else{
				$respuesta="cliente guardado - Error:".mysqli_error($mysqli);
			  	$mysqli->close();
			  	exit();
			}
		}
		echo $respuesta;

	$mysqli->close();
?>