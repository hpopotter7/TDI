<?php 
	$user=$_COOKIE['nombre'];
	$pass=$_POST['pass'];
	$mysqli = new mysqli("209.59.139.52:3306", "admini27_demo", "@ERPideas2019", "admini27_demo");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}

		$sql="UPDATE usuarios SET pass='".$pass."' where user='".$user."'";
		if ($mysqli->query($sql)) {		    
			setcookie("user", "Modificada");
			header('Location:index.php');
			
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}

	$mysqli->close();
?>