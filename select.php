<?php 

$txt_concepto=$_POST['concepto'];
$txt_importe=$_POST['importe'];

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="select o.evento, o.concepto, o.Importe_total, o.solicito, o.factura, o.id_odc from odc o where o.concepto like '%".$txt_concepto."%' and importe_total like '%".$txt_importe."%'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $return = Array('evento'=>$row[0],
                        'concepto'=>$row[1],
                        'importe'=>$row[2],
                        );
    }
    $result->close();
}

echo json_encode($return);

$mysqli->close();
?>