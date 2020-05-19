<?php 

$campo=$_POST['c_campo'];
$valor=$_POST['txt_valor'];

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
/*
if($txt_concepto==""){
    $sql="select o.evento, e.Nombre_evento as nombre, o.concepto, o.Importe_total, o.solicito, o.factura, o.id_odc from odc o, eventos e where o.evento=e.Numero_evento and importe_total like '%".$txt_importe."%'";
}
else if($txt_importe==""){
    $sql="select o.evento, e.Nombre_evento as nombre, o.concepto, o.Importe_total, o.solicito, o.factura, o.id_odc from odc o, eventos e where o.evento=e.Numero_evento and o.concepto like '%".$txt_concepto."%'";
}
else{
    */
    $sql="select o.evento, e.Nombre_evento as nombre, o.concepto, o.Importe_total, o.solicito, o.factura, o.id_odc, o.a_nombre  from odc o, eventos e where o.evento=e.Numero_evento and o.".$campo." like '%".$valor."%'";
    /*
}
*/


if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $resultado = $resultado."<tr><td>".$row[6]."</td><td>[".$row[0]."] -".$row[1]."</td><td>".$row[7]."</td><td>".$row[2]."</td><td>".'$' . number_format($row[3], 2)."</td><td>".$row[4]."</td><td>".$row[5]."</td></tr>";
    }
    $result->close();
}
else{
    $resultado=" La consulta SQL contiene errores.".$mysqli->error;
}


echo " <thead>
<tr>
    <th>ID</th>
    <th>Evento</th>
    <th>Proveedor</th>
    <th>Concepto</th>
    <th>Importe</th>
    <th>Solicito</th>
    <th>Factura</th>
</tr>
</thead>
<tbody id='tbody'>".$resultado."</tbody>";
$mysqli->close();
?>