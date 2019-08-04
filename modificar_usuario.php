<?php
	$nombre1=$_POST['c_usuarios']; 
	$nombre=$_POST['txt_nombre_usuario'];
	$user=$_POST['txt_username'];
	$pass=$_POST['txt_password'];
	$sodexo=$_POST['txt_sodexo'];

	$sol=$_POST['Xsolicitante'];
	$eje=$_POST['Xejecutivo'];
	$dig=$_POST['Xdigital'];
	$cxp=$_POST['Xcxp'];
	$pro=$_POST['Xproductor'];
	$dis=$_POST['Xdiseño'];
	$dire=$_POST['Xdirectivo'];

	$XClientes=$_POST['XClientes'];
	$XProveedores=$_POST['XProveedores'];
	$XUsuarios=$_POST['XUsuarios'];
	$XFacturacion=$_POST['XFacturacion'];

	include("conexion.php");

	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}

		$sql="update usuarios set Nombre='".$nombre."' , User='".$user."', Ejecutivo='".$eje."', Solicitante='".$sol."', CXP='".$cxp."', Digitalizacion='".$dig."', Productor='".$pro."', Disenio='".$dis."', Directivo='".$dire."', cat_clientes='".$XClientes."', cat_prov='".$XProveedores."', cat_usuarios='".$XUsuarios."', sodexo='".$sodexo."', cat_facturacion='".$XFacturacion."' where Nombre='".$nombre1."'";
		if ($mysqli->query($sql)) {
		    echo "usuario modificado".$sql;
		    
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}


	$mysqli->close();
?>