<?php 
	$user=$_POST['user'];
	$pass=$_POST['pass'];
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}

		$sql="UPDATE usuarios SET pass='".$pass."' where user='".$user."'";
		if ($mysqli->query($sql)) {		    
		    echo "password modificado";
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}

	$mysqli->close();
?>