<?php 
	$user=$_COOKIE['nombre'];
	$pass=$_POST['pass'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}

		$sql="UPDATE usuarios SET pass='".$pass."' where user='".$user."'";
		if ($mysqli->query($sql)) {		    
			setcookie("user", "Modificada");
			header('Location:inicio.php');
			
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}

	$mysqli->close();
?>