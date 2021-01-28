<?php 
$anio=$_POST['anio'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

function moneda($value) {
    return "$ ".number_format($value, 2);
  }

//Facturación del periodo
$vector_clientes=Array();
$vector_totales=Array();
$SUMA=0;
$result = $mysqli->query("SET NAMES 'utf8'"); 
$sql="select e.Cliente, sum(p.Subtotal) as Total from eventos e left join solicitud_factura s on e.id_evento=s.id_evento left join Suma_Tabla_Partidas_x_id_sol p on s.id_solicitud=p.id_sol_factura where s.Estatus='ACTIVA' and date_format(Fecha_hora_registro, '%Y')='".$anio."' and s.No_Factura is not null group by Cliente order by Total desc";
$array_totales=Array();
$array_meses=Array();
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $cliente=$row['Cliente'];
        $total=$row['Total'];
        array_push($vector_clientes,$cliente);
        array_push($vector_totales,$total);
        $SUMA=$SUMA+$total;
    }
    $result->close();
}


for($r=0;$r<=count($vector_clientes)-1;$r++) {
    $respuesta=$respuesta."<tr><td>".$vector_clientes[$r]."</td><td>".moneda($vector_totales[$r])."</td></tr>";
}
//$respuesta=$respuesta."<tr><td>SUMA</td><td>".moneda($SUMA)."</td></tr>";

$respuesta="<thead>
            <tr>
                <th>Cliente</th>
                <th>Monto</th>
            </tr>
            </thead>
            <tbody id='tabla_cliente_body'>".$respuesta."
            </tbody>
            <tfoot>
            <tr>
            <th>SUMA</th><th>".moneda($SUMA)."</th>
            </tr></tfoot>";
echo $respuesta;
$mysqli->close();
?>

  