<?php 
    $usuario=$_COOKIE['user'];
    //$like=$_GET["like"];
	$anio=$_POST["anio"];
	$resultado="";

	if($anio=="0"){
		$anio="and (Numero_evento like '%2020-%' or Numero_evento like '%2019-%') ";
	}
	else{
		$anio="and Numero_evento like '%2020%'";
	}
	include("conexion.php");

	if (mysqli_connect_errno()) {
	    echo("Error: ".mysqli_connect_error());
	    exit();
	}
	$valida="";
	$result = $mysqli->query("SET NAMES 'utf8'");
	$sql="select CXP from usuarios where Nombre='".$usuario."'";
	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {
			if($row[0]=='X'){
		     	 $valida='CXP';
		    }
		}
		$result->close();
	}

	if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA" || $usuario=="ANDRES EMANUELLI" || $usuario=="FERNANDA CARRERA"){
			$valida='CXP';
	}

	
	if($valida=='CXP'){
	
		$sql="SELECT id_evento, Numero_evento, Nombre_evento, Cliente FROM eventos WHERE Estatus='ABIERTO' ".$anio." and Numero_evento order by cliente, Numero_evento";
		
	}
	else{
		$sql="SELECT id_evento, Numero_evento, Nombre_evento, Cliente FROM eventos where (Produccion like '%".$usuario."%' or Disenio like '%".$usuario."%' or Ejecutivo like '%".$usuario."%' or Digital like '%".$usuario."%' or Solicita like '%".$usuario."%') and Estatus='ABIERTO' ".$anio." order by cliente, Numero_evento";
	}
	$resultado="";
    $array= array();
	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {
			/*
			$clien=explode("&",$row[3]);
			$name_cliente=$clien[1];
			if(count($clien)==3){
					$name_cliente=$clien[1]."&".$clien[2];
				
			}
			if(count($clien)==4){
					$name_cliente=$clien[1]."&".$clien[2]."&".$clien[3];;
				
			}
			*/
            $resultado=$resultado."<option value='".$row[0]."'>[".$row[1]."] ".$row[3]." - ".$row[2]."</option>";
            /*$return = Array('name'=>"[".$row[1]."] ".$$row[3]." - ".$row[2],
                            'id'=>$row[0]
                            );
			$array[]=$return;
			*/
		}
		$result->close();
	}
	else{
		/*$return = Array('name'=>mysqli_error($mysqli));
		$array[]=$return;*/
		$resultado=mysqli_error($mysqli);
	}
	/*echo json_encode($array);*/
	echo $resultado;
	$mysqli->close();
	

?>