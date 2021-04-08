<?php 
$cliente=$_POST['cliente'];
set_time_limit(900);
include("conexion.php");
if ($mysqli->connect_error) {
    die('Error de conexión: ' . mysqli_error($mysqli));
    exit();
}
function moneda($value) {
    return '$' . number_format($value, 2);
}

function convertir_mes($mes){
    $string="";
    switch($mes){
        case "01":
            $string="ENERO";
        break;
        case "02":
            $string="FEBRERO";
        break;
        case "03":
            $string="MARZO";
        break;
        case "04":
            $string="ABRIL";
        break;
        case "05":
            $string="MAYO";
        break;
        case "06":
            $string="JUNIO";
        break;
        case "07":
            $string="JULIO";
        break;
        case "08":
            $string="AGOSTO";
        break;
        case "09":
            $string="SEPTIEMBRE";
        break;
        case "10":
            $string="OCTUBRE";
        break;
        case "11":
            $string="NOVIEMBRE";
        break;
        case "12":
            $string="DICIEMBRE";
        break;
    }
    return $string;
}

$result = $mysqli->query("SET NAMES 'utf8'");

$tabla="";
$tabla="<table id='tabla_detalle' class='table dataTable'>
          <thead class='thead-dark'>
            <tr style='background-color:rgba(218,165,92,1)'>
            <th style='width: 30%;'>Evento</th>
            <th style='width: 5%;'>Factura</th>
            <th style='width: 5%;'>Solicitud</th>
            <th style='width: 40%;'>Descripción</th>
            <th style='width: 10%;'>Fecha facturacion</th>
            <th style='width: 10%;'>Total</th>
            </tr></thead>
            <tbody id='tabla_detalle_body'>";

$sql="select e.id_evento, e.Numero_evento, e.Nombre_evento, s.id_solicitud, DATE_FORMAT(Fecha_Hora_registro, '%d/%m/%Y') as Fecha, No_Factura, (select sum(total) from partidas where id_sol_factura=s.id_solicitud) as Total, (select Descripcion from partidas where id_sol_factura=s.id_solicitud order by id_partida desc limit 0,1) as Descripcion from eventos e, solicitud_factura s where e.id_evento=s.id_evento and e.cliente='".$cliente."' and e.estatus='ABIERTO' and s.Estatus='Activa' and s.Estatus_Factura='POR COBRAR' order by Fecha_Hora_registro asc";
$suma_total=0;
$comodin_mes="";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {

        $id_evento=$row['id_evento'];
        $numero_evento=$row['Numero_evento'];
        $nombre_evento=$row['Nombre_evento'];
        $id_solicitud=$row['id_solicitud'];
        $fecha=$row['Fecha'];
        $arr_mes=explode("/", $fecha);
        $mes=$arr_mes[1];
        $mes_letra=convertir_mes($mes);
        if($mes_letra!=$comodin_mes){
            $tabla=$tabla."<tr style='background-color:rgba(19,25,65,1); color:white'><td colspan='6'>".$mes_letra."/".$arr_mes[2]."</td></tr>";
            $comodin_mes=$mes_letra;
        }
        $num_factura=$row['No_Factura'];
        $total=$row['Total'];
        $descripcion=$row['Descripcion'];
        $tabla=$tabla."<tr><td><button id='".$id_evento."' class='btn btn-success btn_evento'>[".$numero_evento."]</button> - ".$nombre_evento."</td><td><a id='facturas/".$id_evento."/".$num_factura.".pdf' class='btn btn-warning btn_factura'>".$num_factura."</a></td><td><a class='btn btn-info btn_solicitud' id='".$id_solicitud."'>".$id_solicitud."</a></td><td>".$descripcion."</td><td>".$fecha."</td><td>".moneda($total)."</td></tr>";
        $suma_total=$suma_total+$total;
        /* <a data-fancybox data-type="iframe" data-src="http://codepen.io/fancyapps/full/jyEGGG/" href="javascript:;">
            Webpage
        </a> */
        
    }
        $result->close();
    }
else{
    echo mysqli_error($mysqli);
    exit();
}

if($tabla==""){
    $tabla=$sql;
}
else{
    $tabla=$tabla."<tr><td colspan='5' style='background-color:rgba(181,197,114,1.9);text-align:right'><b>IMPORTE TOTAL:</b></td><td style='background-color:rgba(181,197,114,1.9);'><b>".moneda($suma_total)."</b></td></tr>";
}

echo $tabla."</tbody>
</table>";
$mysqli->close();
?>