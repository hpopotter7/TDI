<?php 
	$numero_evento=$_POST['txt_numero_evento'];
	$nombre_evento=$_POST['txt_nombre_evento'];
	$inicio_evento=$_POST['txt_fecha_inicio_evento'];
	$fin_evento=$_POST['txt_fecha_final_evento'];
	$cliente=$_POST['c_cliente'];
	$destino=$_POST['txt_destino'];
	$sede=$_POST['txt_sede'];
	//$disenio=$_POST['c_disenio'];
	//$produccion=$_POST['c_produccion'];
	$facturacion=$_POST['txt_facturacion'];
	//$solicita=$_POST['c_solicitantes'];
	$tipo=$_POST['check_estatus_facturacion'];
	$comentarios=$_POST['area_comentarios'];
	$usuario_registra=$_POST['usuario_registra'];
	//$ejecutivo=$_POST['c_ejecutivos'];
	//$digital=$_POST['c_digital'];
	$produccion=$_POST['productores'];
	$disenio=$_POST['diseñadores'];
	$digital=$_POST['digital'];
	$ejecutivo=$_POST['ejecutivo'];
	$solicita=$_POST['solicita'];
	$video=$_POST['video'];
	if($tipo==null){
		$tipo="Aprox";
	}
	else{
		$tipo="Total";	
	}
	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$comentarios = $mysqli->real_escape_string($comentarios);
		$sql="UPDATE eventos SET Nombre_evento='".$nombre_evento."', Inicio_evento='".$inicio_evento."', Fin_evento='".$fin_evento."', Cliente='".$cliente."', Destino='".$destino."', Sede='".$sede."', Disenio='".$disenio."', Produccion='".$produccion."', Facturacion='".$facturacion."', Solicita='".$solicita."', Tipo='".$tipo."', Comentarios='".$comentarios."', Ejecutivo='".$ejecutivo."', Digital='".$digital."', video='".$video."' where Numero_evento='".$numero_evento."'";
		$result = $mysqli->query("SET NAMES 'utf8'");
		if ($mysqli->query($sql)) {		    
		    echo "evento modificado";
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}

	$mysqli->close();
?>