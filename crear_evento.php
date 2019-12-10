<?php 
	$anio=$_POST["anio"];
	$numero_evento=$_POST['txt_numero_evento'];
	$nombre_evento=$_POST['txt_nombre_evento'];
	$inicio_evento=$_POST['txt_fecha_inicio_evento'];
	$fin_evento=$_POST['txt_fecha_final_evento'];
	$cliente=$_POST['c_cliente'];
	$destino=$_POST['txt_destino'];
	$sede=$_POST['txt_sede'];
	$disenio=$_POST['c_disenio'];
	$produccion=$_POST['c_produccion'];
	$facturacion=$_POST['txt_facturacion'];
	//$solicita=$_POST['c_solicitantes'];
	//$ejecutivo=$_POST['c_ejecutivos'];
	//$digital=$_POST['c_digital'];
	$tipo=$_POST['check_estatus_facturacion'];
	$comentarios=$_POST['area_comentarios'];
	$usuario_registra=$_POST['usuario_registra'];
	$productores=$_POST['productores'];
	$diseñadores=$_POST['diseñadores'];
	$digital=$_POST['digital'];
	$ejecutivo=$_POST['ejecutivo'];
	$solicita=$_POST['solicita'];
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
	
	$result = $mysqli->query("SET NAMES 'utf8'");
	//include("ver_numero_evento.php");
	$sql="SELECT count(id_evento), DATE_FORMAT(NOW(), '%Y') FROM eventos where numero_evento like '".$anio."%'";
	if ($result = $mysqli->query($sql)) {
		$filas="0";
		$r=0;
		while ($row = $result->fetch_row()) {
			$r=$row[0];
		}
		$r++;
		if($r<10){
			$filas= $anio."-00".$r;	
		}
		else if($r<100){
			$filas= $anio."-0".$r;	
		}
		else{
			 $filas= $anio."-".$r;
		}
    
}

	$comentarios = $mysqli->real_escape_string($comentarios);
		$sql="INSERT INTO eventos (Numero_evento, Nombre_evento,  Inicio_evento, Fin_evento, Cliente, Destino, Sede, Disenio, Produccion, Facturacion, Solicita, Tipo, Comentarios, Fecha_registro, Usuario_Registra, Estatus, ejecutivo, digital) VALUES ('".$filas."', '".strtoupper($nombre_evento)."', '".$inicio_evento."', '".$fin_evento."', '".$cliente."', '".$destino."', '".$sede."', '".$diseñadores."', '".$productores."', '".$facturacion."', '".$solicita."', '".$tipo."', '".$comentarios."', NOW(), '".$usuario_registra."', 'ABIERTO', '".$ejecutivo."', '".$digital."' )";
		if ($mysqli->query($sql)) {		    
		    echo "Evento ".$filas." creado correctamente";
		}
		else{
			echo $sql.mysqli_error($mysqli);
		}
		
	$mysqli->close();
?>