<?php 
    $valor=$_POST['valor'];
    $usuario=$_POST['usuario'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    
	$result = $mysqli->query("SET NAMES 'utf8'");
		$sql="UPDATE usuarios SET pa=".$valor." where Nombre='".$usuario."'";
		if ($mysqli->query($sql)) {	
			if($valor=="1"){
				$valor="0=>1";
			}
			else{
				$valor="1=>0";
			}
			$sql="insert into bitacora(Usuario, tabla_actualizar, valor_anterior, valor_nuevo, fecha_hora_registro) values('".$_COOKIE['user']."', 'Update usuarios: ".$usuario."', 'Ausente', '".$valor."', NOW())";
			if ($mysqli->query($sql)) {
				$res= "exito";
			}
			else{
				$res= mysqli_error($mysqli);
			}
		    
		}
		else{
			$res= "Error: ".mysqli_error($mysqli);
		}
		
		
        
        echo "-".$res;

	$mysqli->close();
?>