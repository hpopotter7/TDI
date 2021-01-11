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
<div class="col-md-12" style="text-align:center"><h2>Solicitudes del día '.$fecha.'</h2></div>
<div class="col-md-12">
    <table class="table table-dark table-striped">
        <thead>
        <tr><th>#</th><th>Evento</th><th>Proveedor</th><th>Concepto</th><th>Importe</th><th>Usuario</th></tr>
        </thead>
        <tbody>';
        $cont=1;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $resultado=$resultado.'<tr>
        <td>'.$cont.'</td>
            <td>'.$row[0].'</td>
            <td>'.$row[4].'</td>
            <td>'.$row[2].'</td>
            <td>'.moneda($row[1],2).'</td>
            <td>'.$row[3].'</td>
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