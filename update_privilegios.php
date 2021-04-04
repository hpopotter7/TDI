<?php 
	$eje=$_POST['eje'];
    $pro=$_POST['pro'];
    $dis=$_POST['dis'];
    $sol=$_POST['sol'];
    $dig=$_POST['dig'];
    $cxp=$_POST['cxp'];
    $cli=$_POST['cli'];
    $prov=$_POST['prov'];
    $fac=$_POST['fac'];
    $id_usuario=$_POST['id_usuario'];

	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
    $result = $mysqli->query("SET NAMES 'utf8'");
	$sql="UPDATE usuarios SET Ejecutivo='".$eje."', Productor='".$pro."', Disenio='".$dis."', Solicitante='".$sol."', Digitalizacion='".$dig."',  CXP='".$cxp."', cat_clientes='".$cli."', cat_prov='".$prov."', cat_facturacion='".$fac."' where id_usuarios='".$id_usuario."'";
		if ($mysqli->query($sql)) {		    
		    $res= "actualizado";
		}
		else{
			$res= $sql.mysqli_error($mysqli);
		}
    echo $res;
	$mysqli->close();
?>