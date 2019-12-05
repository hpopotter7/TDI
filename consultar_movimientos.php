<?php 
$tarjeta=$_POST["tarjeta"];
include("conexion.php");
if ($mysqli->connect_error) {
    die('Error de conexión: ' . mysqli_error($mysqli));
    exit();
}
function moneda($value) {
    return '$' . number_format($value, 2);
  }
$res="<label>Movimientos de la tarjeta: ".$tarjeta."</label><table class='table'><thead><tr><th>Fecha</th><th>Evento</th><th>Concepto</th><th>Cargo</th><th>Sobrante</th><th>VoBo</th></tr></thead><tbody>";
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="select DATE_FORMAT(o.fecha_solicitud,'%d/%m/%Y') as fecha_solicitud, concat('[',e.Numero_evento,'] ', e.Nombre_evento)as evento, o.concepto, importe, tipo_movimiento, m.fecha_afectacion from movimientos m join odc o on m.id_solicitud=o.id_odc join eventos e on o.evento=e.Numero_evento where m.No_tarjeta=".$tarjeta;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $fecha_sol=$row['fecha_solicitud'];
        $evento=$row['evento'];
        $concepto=$row['concepto'];
        $importe=$row['importe'];
        $tipo_movimiento=$row['tipo_movimiento'];
        $fecha_afectacion=$row['fecha_afectacion'];
        $cargo="-";
        $devolucion="-";
        $vobo="";
        if($tipo_movimiento=="CARGO"){
            $cargo=moneda($importe);
        }
        else{
            $devolucion=moneda($importe);
        }
        if($fecha_afectacion==null || $fecha_afectacion==""){
            $vobo='<i class="fa fa-question-circle fa-2x" style="color:orange" aria-hidden="true"></i>';
        }
        else{
            $vobo='<i class="fa fa-check-circle fa-2x" style="color:green"aria-hidden="true"></i>';
        }

        $res=$res."<tr>
        <td>".$fecha_sol."</td>
        <td>".$evento."</td>
        <td>".$concepto."</td>
        <td>".$cargo."</td>
        <td>".$devolucion."</td>
        <td>".$vobo."</td>
        </tr>";
    }
    $result->close();
}
else{
    $res =mysqli_error($mysqli);
  }
  $res=$res."</tbody>";
echo $res;
$mysqli->close();
?>