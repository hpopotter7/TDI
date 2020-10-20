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
$tipo_persona=$_POST['tipo_persona'];
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

  $columnas=Array();
  $razon_social_old="";
  $datos="";
  $CLIENTE="";
  $sql="SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'admini27_erp' AND TABLE_NAME = '".$tipo."'";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
          array_push($columnas,$row[0]);
        }
        $result->close();
    }
    else{
			echo "Error:".mysqli_error($mysqli);
			$mysqli->close();
			exit();
    }
    
    $sql="select Razon_social from clientes WHERE id_cliente=".$id;
    if ($result = $mysqli->query($sql)) {
      while ($row = $result->fetch_row()) {        
          $CLIENTE=$row[0];
        }
          $result->close();
      }	      
      else{
        echo "Error:".mysqli_error($mysqli);
        $mysqli->close();
        exit();
      }



   
    if($tipo==="clientes"){
      $sql="select * from clientes WHERE id_cliente=".$id;
    }
    else{
      $sql="select * from proveedores WHERE id_proveedor=".$id;
    }


      if ($result = $mysqli->query($sql)) {
          while ($row = $result->fetch_row()) {
            for($r=0;$r<=count($columnas)-1;$r++){
              $razon_social_old=$row[2]; // en ambas tablas la razon social es la tercera posicion
              $datos=$datos."[".$columnas[$r].": ".$row[$r]."]";
            }
          }
          $result->close();
      }	      
      else{
        echo "Error:".mysqli_error($mysqli);
        $mysqli->close();
        exit();
      }
     
    $ID="";
    if($tipo==="clientes"){
      $ID="id_cliente";
      $LETRA="C";
      $sql="UPDATE ".$tipo." SET Numero_cliente='".$LETRA."-0".$id."' , Razon_Social='".strtoupper($cliente)."', Nombre_comercial='".$nombre_comercial."', Calle='".strtoupper($calle)."', num_ext='".$ext."', num_int='".$int."', colonia='".strtoupper($colonia)."', cp='".$cp."', estado='".$estado."', municipio='".strtoupper($municipio)."', telefono='".$tel."', rfc='".$rfc."', digitos='".$digitos."', Tipo_persona='".$tipo_persona."', nombre_contacto='".strtoupper($nombre_contacto)."', correo_contacto='".strtoupper($correo_contacto)."', Usuario_autoriza='".$usuario_solicita."', uso_cfdi='".$uso_cfdi."', extension='".$extension."', celular='".$celular."' WHERE ".$ID."=".$id;
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


    if($respuesta==="cliente actualizado"){
			$sql="insert into bitacora(Usuario, tabla_actualizar, valor_anterior, valor_nuevo, fecha_hora_registro) values('".$_COOKIE['user']."', 'Update ".$tipo." ID: ".$id."', '".$datos."', 'actual tabla clientes', NOW())";
			if ($mysqli->query($sql)) {
				$respuesta= "cliente actualizado";
			}
			else{
				$respuesta= mysqli_error($mysqli);
			}
    }
    
    if($respuesta==="cliente actualizado"){
      $nombre_cliente=strtoupper($cliente);
      $sql="update eventos set Cliente='".$nombre_cliente."' where Cliente='".$CLIENTE."'";
      if ($mysqli->query($sql)) {
        //$respuesta= "ERROR: ".$sql;
        $respuesta= "cliente actualizado";
		}
    }
    

    $mysqli->close();
    
    echo $respuesta."-".$bandera_descargar;
    

	
?>