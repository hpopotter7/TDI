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
$sql="select date_format(s.Fecha_hora_registro, '%m') as mes, sum(p.Subtotal) as Total from solicitud_factura s left join Suma_Tabla_Partidas_x_id_sol p on s.id_solicitud=p.id_sol_factura where s.No_Factura is not null and DATE_FORMAT(Fecha_hora_registro, '%Y') ='".$anio."' group by mes order by mes asc";
$array_totales=Array();
$array_meses=Array();
if ($result = $mysqli->query($sql)) {
   $cont=0;
    while ($row = $result->fetch_assoc()) {
       $mes=$row['mes'];
       $total=$row['Total'];
       $mes=mes($mes);
       array_push($array_meses,$mes);
       array_push($array_totales,$total);
    }
    $result->close();
}
$sql="select date_format(s.Fecha_pago, '%m') as mes, sum(p.Subtotal) as Total from solicitud_factura s left join Suma_Tabla_Partidas_x_id_sol p on s.id_solicitud=p.id_sol_factura where s.No_Factura is not null and DATE_FORMAT(Fecha_pago, '%Y') ='".$anio."' and s.Estatus_Factura='PAGADO' group by mes order by mes asc";
$array_cobrado=Array();
if ($result = $mysqli->query($sql)) {
   $cont=0;
    while ($row = $result->fetch_assoc()) {
       //$mes=$row['mes'];
       $total=$row['Total'];
       //$mes=mes($mes);
       array_push($array_cobrado,$total);
    }
    $result->close();
}
$respuesta="";
for($r=0;$r<=count($array_meses)-1;$r++) {
    $respuesta=$respuesta."<tr><td>".$array_meses[$r]."</td><td>".moneda($array_totales[$r])."</td><td>".moneda($array_cobrado[$r])."</td></tr>";
}
echo $respuesta;
$mysqli->close();
?>

  