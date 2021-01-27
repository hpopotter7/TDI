<?php 
$mes=$_POST['mes'];
$anio=$_POST['anio'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

function moneda($value) {
    return '$' . number_format($value, 2);
  }

  function mes($mes){
    switch($mes){
        case 1:
            $mes="ENERO";
        break;
        case 2:
            $mes="FEBRERO";
        break;
        case 3:
            $mes="MARZO";
        break;
        case 4:
            $mes="ABRIL";
        break;
        case 5:
            $mes="MAYO";
        break;
        case 6:
            $mes="JUNIO";
        break;
        case 7:
            $mes="JULIO";
        break;
        case 8:
            $mes="AGOSTO";
        break;
        case 9:
            $mes="SEPTIEMBRE";
        break;
        case 10:
            $mes="OCTUBRE";
        break;
        case 11:
            $mes="NOVIEMBRE";
        break;
        case 12:
            $mes="DICIEMBRE";
        break;
    }
    return $mes;
  }

//Facturación del periodo
$result = $mysqli->query("SET NAMES 'utf8'"); 
$sql="select s.No_Factura, e.Cliente, p.Descripcion, p.Subtotal, p.Iva, p.Total, s.Estatus_Factura from solicitud_factura s left join Suma_Tabla_Partidas_x_id_sol p on s.id_solicitud=p.id_sol_factura left join eventos e on s.id_evento=e.id_evento where s.No_Factura is not null and s.id_evento=e.id_evento and DATE_FORMAT(Fecha_hora_registro, '%Y-%m') ='".$anio."-".$mes."' ";
$suma_subtotal=0;
$suma_iva=0;
$suma_total=0;
if ($result = $mysqli->query($sql)) {
   $cont=0;
    while ($row = $result->fetch_assoc()) {
        $tabla=$tabla."<tr>";
        $tabla=$tabla."<td>".$row['No_Factura']."</td>";
        $tabla=$tabla."<td>".$row['Cliente']."</td>";
        $tabla=$tabla."<td>".$row['Descripcion']."</td>";
        $tabla=$tabla."<td>".moneda($row['Subtotal'])."</td>";
        $tabla=$tabla."<td>".moneda($row['Iva'])."</td>";
        $tabla=$tabla."<td>".moneda($row['Total'])."</td>";
        $tabla=$tabla."<td>".$row['Estatus_Factura']."</td>";
        $tabla=$tabla."</tr>";
        $suma_subtotal=$suma_subtotal+$row['Subtotal'];
        $suma_iva=$suma_iva+$row['Iva'];
        $suma_total=$suma_total+$row['Total'];
    }
    $result->close();
}
//Cobranza del periodo
/*
$sql="select s.No_Factura, s.Fecha_pago, e.Cliente, p.Descripcion, p.Total, s.Estatus_Factura from solicitud_factura s left join Suma_Tabla_Partidas_x_id_sol p on s.id_solicitud=p.id_sol_factura left join eventos e on s.id_evento=e.id_evento where s.No_Factura is not null and s.id_evento=e.id_evento and s.Estatus_Factura='PAGADO' and DATE_FORMAT(Fecha_pago, '%Y-%m') ='".$anio."-".$mes."' ";
if ($result = $mysqli->query($sql)) {
   $cont=0;
    while ($row = $result->fetch_row()) {
        $res=$row[0];
    }
    $result->close();
}
*/

echo $tabla;
$mysqli->close();
?>

  