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
$res="<label>Movimientos de la tarjeta: ".$tarjeta." </label><button class='btn btn-info disabled pull-right' disabled='disabled'>PDF</button> <table class='table'><thead><tr><th>Fecha</th><th>Evento</th><th>Concepto</th><th>Cargo</th><th>Abono</th><th>Saldo</th><th>VoBo</th></tr></thead><tbody>";
$result = $mysqli->query("SET NAMES 'utf8'");


$saldo=0;
$mes=0;
  
$sql="select DATE_FORMAT(fecha_afectacion,'%d/%m/%Y'), importe from movimientos where Comentarios='Saldo inicial de la tarjeta' and no_tarjeta=".$tarjeta;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        
        if($mes==0){
            $mes=7;
            $res=$res."<tr style='background-color:#01384e;color:white'><th colspan='7' >JULIO</th></tr>";
        }
        
        $saldo=$saldo+$row[1];
        $res=$res."<tr><td>".$row[0]."</td><td>-</td><td>SALDO INICIAL</td><td>-</td><td>".moneda($row[1])."</td><td>".moneda($saldo)."</td><td></td></tr>";
        
    }
}
else{
    $res =mysqli_error($mysqli);
  }
$sql="select DATE_FORMAT(o.fecha_solicitud,'%d/%m/%Y') as fecha_solicitud, concat('[',e.Numero_evento,'] ', e.Nombre_evento)as evento, o.concepto, importe, tipo_movimiento, m.fecha_afectacion, DATE_FORMAT(o.fecha_solicitud,'%c') as mes from movimientos m join odc o on m.id_solicitud=o.id_odc join eventos e on o.evento=e.Numero_evento where m.No_tarjeta=".$tarjeta." order by m.fecha_creacion asc";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        if($mes!=$row['mes']){
            $mes=$row['mes'];
            $res=$res."<tr style='background-color:#01384e;color:white'><th colspan='7'>".mes($mes)."</th></tr>";
        }
        $fecha_sol=$row['fecha_solicitud'];
        $evento=$row['evento'];
        $concepto=$row['concepto'];
        $importe=$row['importe'];
        $tipo_movimiento=$row['tipo_movimiento'];
        $fecha_afectacion=$row['fecha_afectacion'];
        $cargo="-";
        $abono="-";
        $devolucion="-";
        $vobo="";
        if($tipo_movimiento=="CARGO"){
            $abono=$importe;
            $saldo=$saldo+$importe;
        }
        else if($tipo_movimiento=="GASTO"){
            $cargo=$importe;
            $saldo=$saldo-$importe;
        }
        $mes=$row['mes'];

        
        /*
        else{
            $devolucion=moneda($importe);
        }
        */
        if($fecha_afectacion==null || $fecha_afectacion==""){
            $vobo='<i class="fa fa-question-circle fa-2x" style="color:orange" aria-hidden="true"></i>';
        }
        else{
            $vobo='<i class="fa fa-check-circle fa-2x" style="color:green"aria-hidden="true"></i>';
        }

        if($cargo==0){
            $cargo="-";
        }
        else{
            $cargo=moneda($cargo);
        }
        if($abono==0){
            $abono="-";
        }
        else{
            $abono=moneda($abono);
        }

        $res=$res."<tr>
        <td>".$fecha_sol."</td>
        <td>".$evento."</td>
        <td>".$concepto."</td>
        <td>".$cargo."</td>
        <td>".$abono."</td>
        <td>".moneda($saldo)."</td>
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