<?php 
$mes=$_GET['mes'];
$anio=$_GET['anio'];

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

function moneda($value) {
    return '$' . number_format($value, 2);
  }

$result = $mysqli->query("SET NAMES 'utf8'"); 

$sql="select sum(importe_total) as title, count(importe_total) as count, fecha_pago from odc where DATE_FORMAT(fecha_pago, '%Y')='".$anio."' and pagado='no' group by fecha_pago ORDER BY fecha_pago ASC";
/*
$dbdata = array();
		while ( $row = $result->fetch_assoc())  {
			$dbdata[]=$row;
          }
   */      
  
$result = $mysqli->query($sql);
while ( $row = $result->fetch_assoc())  {
    $comodin="ICON     ".moneda($row["title"]); 
    $data[] = array(
    //'id'   => $row["id"],
    'title'   => $comodin,
    'start'   => $row["fecha_pago"],
    'description' => $row['count']
    //'end'   => $row["end_event"]
    );
    
}

echo json_encode($data);
$mysqli->close();
?>