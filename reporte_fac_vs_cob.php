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

  function mes_string($mes){
    switch($mes){
        case "01":
            $mes="ENERO";
        break;
        case "02":
            $mes="FEBRERO";
        break;
        case "03":
            $mes="MARZO";
        break;
        case "04":
            $mes="ABRIL";
        break;
        case "05":
            $mes="MAYO";
        break;
        case "06":
            $mes="JUNIO";
        break;
        case "07":
            $mes="JULIO";
        break;
        case "08":
            $mes="AGOSTO";
        break;
        case "09":
            $mes="SEPTIEMBRE";
        break;
        case "10":
            $mes="OCTUBRE";
        break;
        case "11":
            $mes="NOVIEMBRE";
        break;
        case "12":
            $mes="DICIEMBRE";
        break;
    }
    return $mes;
  }

  $vector_meses=Array("01","02","03","04","05","06","07","08","09","10","11","12");
  $vector_totales=Array(0,0,0,0,0,0,0,0,0,0,0,0);
  $vector_cobrado=Array(0,0,0,0,0,0,0,0,0,0,0,0);
//Facturación del periodo

$result = $mysqli->query("SET NAMES 'utf8'"); 
$sql="select date_format(s.Fecha_hora_registro, '%m') as mes, sum(p.Subtotal) as Total from solicitud_factura s left join Suma_Tabla_Partidas_x_id_sol p on s.id_solicitud=p.id_sol_factura where s.No_Factura is not null and DATE_FORMAT(Fecha_hora_registro, '%Y') ='".$anio."' group by mes order by mes asc";
$array_totales=Array();
$array_meses=Array();
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $total=$row['Total'];
        $pos=0;
        for($r=0;$r<=count($vector_meses)-1;$r++){
            if($vector_meses[$r]==$row['mes']){
                $pos=$r;
                break;
            }
        }
            array_splice($vector_totales,$pos,1,$total);
    }
    $result->close();
}

$sql="select date_format(s.Fecha_pago, '%m') as mes, sum(p.Subtotal) as Total from solicitud_factura s left join Suma_Tabla_Partidas_x_id_sol p on s.id_solicitud=p.id_sol_factura where s.No_Factura is not null and DATE_FORMAT(Fecha_pago, '%Y') ='".$anio."' and s.Estatus_Factura='PAGADO' group by mes order by mes asc";
$array_cobrado=Array();
if ($result = $mysqli->query($sql)) {
   $cont=0;
    while ($row = $result->fetch_assoc()) {
       $total=$row['Total'];
        $pos=0;
        for($r=0;$r<=count($vector_meses)-1;$r++){
            if($vector_meses[$r]==$row['mes']){
                $pos=$r;
                break;
            }
        }
            array_splice($vector_cobrado,$pos,1,$total);
    }
    $result->close();
}
$respuesta="";

for($r=0;$r<=count($vector_meses)-1;$r++) {
    $respuesta=$respuesta."<tr><td>".mes_string($vector_meses[$r])."</td><td>".moneda($vector_totales[$r])."</td><td>".moneda($vector_cobrado[$r])."</td></tr>";
}
echo $respuesta;
$mysqli->close();
?>

  