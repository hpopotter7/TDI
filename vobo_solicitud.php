<?php 
	$id=$_POST['id'];
    $bandera=$_POST['bandera'];	
    $tipo=$_POST['tipo'];
	include("conexion.php");
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    $resultado="";
    $result = $mysqli->query("SET NAMES 'utf8'"); 
		$sql="UPDATE odc SET ".$tipo."='".$bandera."' where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
		    $resultado="actualizado";
		}
		else{
			$resultado= mysqli_error($mysqli);
        }
        $sql="select o.vobo_finanzas, o.vobo_compras, o.vobo_direccion, o.vobo_project, o.vobo_coordinador from odc o where id_odc='".$id."'";
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_row()) {
                if($row[0]=="1" && $row[2]=="1" && $row[3]=="1" && $row[4]=="1"){
                    $resultado="completo#".$id;
                }
            }
            $result->close();
		}
		else{
			$resultado= mysqli_error($mysqli);
        }
        echo $resultado;
	$mysqli->close();
?>