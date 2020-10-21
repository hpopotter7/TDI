<?php 
$cliente=$_POST['cliente'];
set_time_limit(900);
include("conexion.php");
if ($mysqli->connect_error) {
    die('Error de conexión: ' . mysqli_error($mysqli));
    exit();
}
function moneda($value) {
    return '$' . number_format($value, 2);
}




$result = $mysqli->query("SET NAMES 'utf8'");

$tabla="";

$sql="select e.id_evento, e.Numero_evento, e.Nombre_evento, s.id_solicitud, DATE_FORMAT(Fecha_Hora_registro, '%d/%m/%Y') as Fecha, No_Factura, (select sum(total) from partidas where id_sol_factura=s.id_solicitud) as Total from eventos e, solicitud_factura s where e.id_evento=s.id_evento and e.cliente='".$cliente."' and e.estatus='ABIERTO' and s.Estatus='activa' and s.Estatus_Factura='POR COBRAR' order by e.Numero_evento";
$suma_total=0;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $id_evento=$row['id_evento'];
        $numero_evento=$row['Numero_evento'];
        $nombre_evento=$row['Nombre_evento'];
        $id_solicitud=$row['id_solicitud'];
        $fecha=$row['Fecha'];
        $num_factura=$row['No_Factura'];
        $total=$row['Total'];
        $tabla=$tabla."<tr><td>[".$numero_evento."] - ".$nombre_evento."</td><td>".$num_factura."</td><td>".$id_solicitud."</td><td>Descripcion</td><td>".$fecha."</td><td>".moneda($total)."</td></tr>";
        $suma_total=$suma_total+$total;
    }
        $result->close();
    }
else{
    echo mysqli_error($mysqli);
    exit();
}

if($tabla==""){
    $tabla=$sql;
}
else{
    $tabla=$tabla."<tr><td colspan='5' style='background-color:rgba(181,197,114,1.9);text-align:right'><b>IMPORTE TOTAL:</b></td><td style='background-color:rgba(181,197,114,1.9);'><b>".moneda($suma_total)."</b></td></tr>";
}

echo $tabla;
$mysqli->close();
?>