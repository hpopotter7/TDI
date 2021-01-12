<?php 
$fecha=$_GET['fecha'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
function moneda($value) {
    return '$' . number_format($value, 2);
  }

$result = $mysqli->query("SET NAMES 'utf8'"); 

$sql="select evento, importe_total, concepto, usuario_registra, a_nombre from odc where fecha_pago='".$fecha."' and cancelada='no' and pagado='no'";

//$sql="select ANY_VALUE((select Numero_evento from eventos where id_evento=s.id_evento)), ANY_VALUE((select cliente from eventos where id_evento=s.id_evento)), sum(p.total), ANY_VALUE(s.usuario_registra) from solicitud_factura s, partidas p where s.id_solicitud=p.id_sol_factura and s.estatus='Activa' and s.Estatus_Factura='POR COBRAR' and DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY)='".$fecha."'";

$sql="select (select Numero_evento from eventos e where e.id_evento=s.id_evento), (select Cliente from eventos e where e.id_evento=s.id_evento), p.importe_total, s.No_Factura, s.Usuario_registra, DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY) as 'Fecha', s.id_solicitud from solicitud_factura s, `TOTAL_PARTIDAS_X_SOLCITUD` p where s.id_solicitud=p.id_solicitud and s.estatus='Activa' and s.Estatus_Factura='POR COBRAR' and DATE_ADD(DATE_FORMAT(s.Fecha_Hora_registro, '%Y-%m-%d'), INTERVAL s.dias_credito DAY)='".$fecha."'";
$resultado='<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<style>
body{
    background: rgba(174,252,116,0.52);
}
</style>
</head>

<body>
<div class="row">
<div class="col-md-12" style="text-align:center"><h2>Facturas que vencen el día '.$fecha.'</h2></div>
<div class="col-md-12">
    <table class="table table-dark table-striped">
        <thead>
        <tr><th>#</th><th>Evento</th><th>Cliente</th><th>Importe</th><th># Factura</th><th>Usuario</th></tr>
        </thead>
        <tbody>';
        $cont=1;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $resultado=$resultado.'<tr>
        <td>'.$cont.'</td>
            <td>'.$row[0].'</td> 
            <td>'.$row[1].'</td>
            <td>'.moneda($row[2],2).'</td>
            <td><a class="btn btn-info" href="https://administraciontierradeideas.mx/solicitud_factura.php?id='.$row[6].'" target="_blank">'.$row[3].'</a></td>
            <td>'.$row[4].'</td>
            </tr>';
            $cont++;
}
}
else{
    $resultado= "Error: ".mysqli_error($mysqli);
}
$resultado=$resultado.'</tbody>
</table>
</div>
</div>
</body>
</html>';
echo $resultado;
$mysqli->close();
?>