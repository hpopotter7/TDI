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
$vector_cuantos=Array();
$vector_totales=Array();
$SUMA=0;
$result = $mysqli->query("SET NAMES 'utf8'"); 
/*
$sql="select e.Cliente, count(Numero_evento) as cuantos, sum(p.Total) as Total from eventos e inner join solicitud_factura s on e.id_evento=s.id_evento inner join Suma_Tabla_Partidas_x_id_sol p on s.id_solicitud=p.id_sol_factura where s.Estatus='activa' and date_format(Fecha_hora_registro, '%Y')='".$anio."'vand (s.Estatus_Factura='PAGADO' or s.Estatus_Factura='POR COBRAR' or s.Estatus_Factura is null) and e.Estatus='ABIERTOS' or e.Estatus='CERRADO' group by Cliente order by Total desc";
*/
$sql="select e.Cliente, count(e.Numero_Evento) as cuantos, SUM(p.Total) as Total from solicitud_factura s inner join Suma_Tabla_Partidas_x_id_sol p on s.id_solicitud=p.id_sol_factura inner join eventos e on s.id_evento=e.id_evento where s.estatus='Activa' and (s.Estatus_Factura='PAGADO' or s.Estatus_Factura='POR COBRAR' or s.Estatus_Factura is null) and s.id_evento=e.id_evento and DATE_FORMAT(Fecha_hora_registro, '%Y') ='".$anio."' group by Cliente order by Total desc";

$array_totales=Array();
$array_meses=Array();
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $cliente=$row['Cliente'];
        if($cliente!="GASTO"){
            $cliente=$row['Cliente'];
            $cuantos=$row['cuantos'];
            $total=$row['Total'];
            array_push($vector_clientes,$cliente);
            array_push($vector_cuantos,$cuantos);
            array_push($vector_totales,$total);
            $SUMA=$SUMA+$total;
        }
    }
    $result->close();
}


for($r=0;$r<=count($vector_clientes)-1;$r++) {
    $respuesta=$respuesta."<tr><td>".$vector_clientes[$r]." <span class='badge badge-info' title='Numero de eventos'> ".$vector_cuantos[$r]."</span></td><td>".moneda($vector_totales[$r])."</td></tr>";
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

  