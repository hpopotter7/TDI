<?php 
	$Nombre=$_POST['nombre'];
    $user=$_POST['user'];
    $correo=$_POST['correo'];
    $jefes=$_POST['jefes'];
    $id_usuario=$_POST['id_usuario'];
	include("conexion.php");	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
    
    $J="";
    foreach ($jefes as $value) {
        $J=$J.$value.",";
    }

    
    $result = $mysqli->query("SET NAMES 'utf8'");
    if($id_usuario=="0"){
	$sql="INSERT INTO usuarios(Nombre, User, email, Jefe_Directo) values('".$Nombre."', '".$user."', '".$correo."', '".$J."')";
		if ($mysqli->query($sql)) {		    
		    $res= "actualizado";
		}
		else{
			$res= $sql.mysqli_error($mysqli);
		}
        $sql="select max(id_usuarios) from usuarios";
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_row()) {
                $id=$row[0];
                $res="formulario_registro_usuario.php?id=".$id;
            }
            $result->close();
        }
    }
    else{
        $sql="UPDATE usuarios set Nombre='".$Nombre."', User='".$user."', email='".$correo."', Jefe_Directo='".$J."' where id_usuarios=".$id_usuario;
		if ($mysqli->query($sql)) {		    
		    $res= "actualizado";
            $res="formulario_registro_usuario.php?id=".$id_usuario;
		}
		else{
			$res= $sql.mysqli_error($mysqli);
		}
    }
    
    echo $res;
	$mysqli->close();
?>