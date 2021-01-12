<?php 
/*
$mes=$_GET['mes'];
$anio=$_GET['anio'];
*/

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

function moneda($value) {
    return '$' . number_format($value, 2);
  }

$result = $mysqli->query("SET NAMES 'utf8'"); 


//ANY_VALUE(id_solicitud), ANY_VALUE(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d')), 

$sql="select COUNT(s.id_evento) AS cuantos, sum(p.importe_total) as total, DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY) as 'Fecha' from solicitud_factura s, `TOTAL_PARTIDAS_X_SOLCITUD` p where s.id_solicitud=p.id_solicitud and s.estatus='Activa' and s.Estatus_Factura='POR COBRAR' group by DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY) asc ORDER BY `Fecha` ASC";
//$sql="select sum(importe_total) as title, count(importe_total) as count, fecha_pago from odc where DATE_FORMAT(fecha_pago, '%Y')='".$anio."' and pagado='no' group by fecha_pago ORDER BY fecha_pago ASC";
/*
$dbdata = array();
		while ( $row = $result->fetch_assoc())  {
			$dbdata[]=$row;
          }
   */      
  
$result = $mysqli->query($sql);
while ( $row = $result->fetch_assoc())  {
    $comodin="ICON     ".moneda($row["total"]); 
    $data[] = array(
    //'id'   => $row["id"],
    'title'   => $comodin,
    'start'   => $row["Fecha"],
    'description' => $row['cuantos']
    //'end'   => $row["end_event"]
    );
    
}


echo json_encode($data);
$mysqli->close();
?>