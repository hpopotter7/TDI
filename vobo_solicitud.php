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

	

	//comprobar si el usuario tiene más checks por dar, se asignan en 1 en automatico

	
	$sql="select solicito, project, coordinador, compras, autorizo, finanzas from odc where id_odc=".$id;
	$result = $mysqli->query("SET NAMES 'utf8'");

	if ($result = $mysqli->query($sql)) {
	while ($row = $result->fetch_row()) {
		$solicita=$row[0];
		$ejecutivo=$row[1];
		$coordinador=$row[2];
		$compras=$row[3];
		$direccion=$row[4];
		$finanzas=$row[5];
	}
		$result->close();
	}
	else{
	$return =mysqli_error($mysqli);
	}

	

	/*
	vobo_solicito
	vobo_project
	vobo_coordinador
	vobo_compras
	vobo_direccion
	vobo_finanzas
	*/ 

	$usuario=$_COOKIE["user"];

	if($solicita==$usuario){
		$tipo="vobo_solicito";
		$sql="UPDATE odc SET ".$tipo."='".$bandera."' where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
			$resultado="actualizado";
		}
		else{
			$resultado= mysqli_error($mysqli);
		}
	}
	if($ejecutivo==$usuario){
		$tipo="vobo_project";
		$sql="UPDATE odc SET ".$tipo."='".$bandera."' where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
			$resultado="actualizado";
		}
		else{
			$resultado= mysqli_error($mysqli);
		}
	}
	if($coordinador==$usuario){
		$tipo="vobo_coordinador";
		$sql="UPDATE odc SET ".$tipo."='".$bandera."' where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
			$resultado="actualizado";
		}
		else{
			$resultado= mysqli_error($mysqli);
		}
	}
	if($compras==$usuario){
		$tipo="vobo_compras";
		$sql="UPDATE odc SET ".$tipo."='".$bandera."' where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
			$resultado="actualizado";
		}
		else{
			$resultado= mysqli_error($mysqli);
		}
	}
	if($direccion==$usuario){
		$tipo="vobo_direccion";
		$sql="UPDATE odc SET ".$tipo."='".$bandera."' where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
			$resultado="actualizado";
		}
		else{
			$resultado= mysqli_error($mysqli);
		}
	}
	if($finanzas==$usuario){
		$tipo="vobo_finanzas";
		$sql="UPDATE odc SET ".$tipo."='".$bandera."' where id_odc='".$id."'";
		if ($mysqli->query($sql)) {
			$resultado="actualizado";
		}
		else{
			$resultado= mysqli_error($mysqli);
		}
	}
	
	if($resultado=="actualizado"){
		$sql="insert into bitacora(Usuario, tabla_actualizar, valor_anterior, valor_nuevo, fecha_hora_registro) values('".$_COOKIE['user']."', 'Update Vobo id_odc: ".$id."', '".$tipo."', '0=>1', NOW())";
		if ($mysqli->query($sql)) {
			$resultado="completo#".$id;
		}
		else{
			$resultado= mysqli_error($mysqli);
		}
	}

        echo $resultado;
	$mysqli->close();
?>