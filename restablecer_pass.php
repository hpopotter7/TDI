<?php 
	$user=$_POST['user'];
	$id_usuario=$_POST['id_usuario'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
if($user=="" || $user==null){
	$sql="UPDATE usuarios SET Pass='tierraideas' where id_usuarios='".$id_usuario."'";
}
else{
	$sql="UPDATE usuarios SET Pass='tierraideas' where Nombre='".$user."'";
}
		if ($mysqli->query($sql)) {		    
		    echo "ok";
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}

	$mysqli->close();
?>
