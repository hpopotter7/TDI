<?php 
$razon=$_POST['razon'];
$razon=strtoupper($razon);
$usuario=$_POST['usuario'];
include("conexion.php");
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
		$respuesta="";

		$sql="SELECT id_cliente from clientes where Razon_Social='".$razon."'";
		$result = $mysqli->query($sql);
		if (! $result){
		echo $sql."La consulta SQL contiene errores.".mysql_error();
		}else {
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
                    $respuesta="ya existe";
                    
			    }
			    $result->close();
			}
		}
		if($respuesta==""){ // si no encuentra registrado, lo agregamos
				$sql="INSERT INTO clientes (Numero_Cliente, Razon_Social, Nombre_comercial, Usuario_Solicita, Usuario_autoriza, Fecha_solicitud ) values('0', '".$razon."', '".$razon."', '".$usuario."', 'SANDRA PEÑA', NOW())";
			if ($mysqli->query($sql)) {
			    $respuesta= "cliente agregado";
			}
			else{
				$respuesta= $sql."<br>".mysqli_error($mysqli);
            }
            if($respuesta=="cliente agregado"){
                $sql="select max(id_cliente) from clientes";
                $result = $mysqli->query($sql);
                if (! $result){
                echo $sql."La consulta SQL contiene errores.".mysql_error();
                }else {
                    if ($result = $mysqli->query($sql)) {
                        while ($row = $result->fetch_row()) {
                            $id_max=$row[0];
                        }
                        
                        $sql="update clientes set Numero_cliente='C-".$id_max."' where id_cliente=".$id_max;
                        $result = $mysqli->query($sql);
                        if (! $result){
                        echo $sql."La consulta SQL contiene errores.".mysql_error();
                        }else {
                            if ($mysqli->query($sql)) {
                                $respuesta= "cliente agregado";
                            }
                        }
                    }
                }
            }
		}
		else{ // si ya existe regresamos que ya fue ocupada
			$respuesta="ya existe";
		}
		
		echo $respuesta;

	$mysqli->close();
?>