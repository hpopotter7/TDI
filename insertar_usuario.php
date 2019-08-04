<?php 
	$nombre=$_POST['txt_nombre_usuario'];
	$user=$_POST['txt_username'];
	$sodexo=$_POST['txt_sodexo'];
	$pass='tierraideas';
	$email=$_POST['txt_email_usuario'];
	$Xejecutivo=$_POST['Xejecutivo'];
	$Xsolicitante=$_POST['Xsolicitante'];
	$Xdigital=$_POST['Xdigital'];
	
	$Xcxp=$_POST['Xcxp'];
	$Xproductor=$_POST['Xproductor'];
	$Xdisenio=$_POST['Xdisenio'];
	$Xdirectivo=$_POST['Xdirectivo'];

	$XClientes=$_POST['XClientes'];
	$XProveedores=$_POST['XProveedores'];
	$XUsuarios=$_POST['XUsuarios'];
	$XFacturacion=$_POST['XFacturacion'];
	include("conexion.php");

	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
	$sql="select * from usuarios where User='".$user."' and estatus='activo'" ;
	$existe="";
	if ($result=$mysqli->query($sql)) {
		 while ($row = $result->fetch_row()) {
	        $existe=$row[1];
	    }
	    $result->close();
	}

	if($existe==""){
		$sql="insert into usuarios (Nombre, email, User, Pass, Ejecutivo, Solicitante, CXP, Digitalizacion, Productor, Disenio, Directivo, Estatus, cat_clientes, cat_prov, cat_usuarios, sodexo, cat_facturacion) values('".$nombre."', '".$email."', '".$user."', '".$pass."', '".$Xejecutivo."','".$Xsolicitante."','".$Xcxp."','".$Xdigital."','".$Xproductor."','".$Xdisenio."', '".$Xdirectivo."', 'activo', '".$XClientes."', '".$XProveedores."', '".$XUsuarios."', '".$sodexo."', '".$XFacturacion."')";
		if ($mysqli->query($sql)) {
		    echo "registro correcto";
		}
		else{
			echo mysqli_error($mysqli).$sql;
		}
	}
	else{
		echo "ya existe ese username";
	}
	$mysqli->close();
?>