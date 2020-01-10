<?php 
    $usuario=$_GET["usuario"];
    $like=$_GET["like"];
	$anio=$_GET["anio"];
	$resultado="";

	if($anio=="0"){
		$anio="and (e.Numero_evento like '%2020-%' or e.Numero_evento like '%2019-%')";
	}
	else{
		$anio="and e.Numero_evento like '%2020%'";
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

	if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA" || $usuario=="ANDRES EMANUELLI" || $usuario=="FERNANDA CARRERA" || $usuario=="SANAYN MARTINEZ"){
			$valida='CXP';
	}
	
	if($valida=='CXP'){
	
		$sql="SELECT e.id_evento, e.Numero_evento, e.Nombre_evento, e.Cliente, c.id_cliente, c.Razon_Social FROM eventos e, clientes c where e.Cliente=CONCAT(c.id_cliente,'&',c.Razon_Social) and e.Estatus='ABIERTO' ".$anio." order by c.Razon_Social, e.Numero_evento";
		
	}
	else{
		$sql="SELECT e.id_evento, e.Numero_evento, e.Nombre_evento, e.Cliente, c.id_cliente, c.Razon_Social FROM eventos e, clientes c where e.Cliente=CONCAT(c.id_cliente,'&',c.Razon_Social) and (e.Produccion like '%".$usuario."%' or e.Disenio like '%".$usuario."%' or e.Ejecutivo like '%".$usuario."%' or Digital like '%".$usuario."%' or Solicita like '%".$usuario."%') and e.Estatus='ABIERTO' ".$anio." order by c.Razon_Social, e.Numero_evento";
	}
	$resultado="";
    $array= array();
	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {
			$clien=explode("&",$row[3]);
			$name_cliente=$clien[1];
			if(count($clien)==3){
					$name_cliente=$clien[1]."&".$clien[2];
				
			}
			if(count($clien)==4){
					$name_cliente=$clien[1]."&".$clien[2]."&".$clien[3];;
				
			}
            $resultado=$resultado."<option value='".$row[0]."'>[".$row[1]."] ".$name_cliente." - ".$row[2]."</option>";
            $return = Array('name'=>"[".$row[1]."] ".$name_cliente." - ".$row[2],
                            'id'=>$row[0]
                            );
            $array[]=$return;
		}
		$result->close();
	}
	else{
		$return = Array('error'=>mysqli_error($mysqli));
        $array[]=$return;
	}
	echo json_encode($array);
	
	$mysqli->close();
	

?>