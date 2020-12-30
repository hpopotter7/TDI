<?php 
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");

$respuesta="";
$sql="SELECT e.Numero_evento, e.Nombre_evento, e.cliente as cliente, o.suma, f.Importe_Total, e.id_evento  FROM eventos e, ODC_ABIERTOS o, Reporte_Facturacion f where e.Numero_evento=o.evento and e.Numero_evento=f.Numero_evento and e.Estatus='ABIERTO' and e.cliente!='GASTO' and f.Importe_Total is null and Ejecutivo like '%".$_COOKIE['user']."%' order by cliente asc, e.id_evento asc ";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $nombre_evento="[".$row[0]."] - ".$row[1];
    	$respuesta=$respuesta."<li style='padding-bottom:3px;'><a id='".$row[5]."' class='btn btn-warning btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento."</a></li>";
    }
    $result->close();
}

if($respuesta==""){
    $respuesta="No hay sin factura";
}
else{
    //si se cambia el titulo h3 se debe cambiar el javascript en el resposne del ajax
    $respuesta="<h3 style='background-color:red; color:#fff;padding:4px'>Eventos con SDP -SIN FACTURAR-</h3><ul style='list-style-type:none'>".$respuesta."</ul>";
}

$respuesta2="";
$sql="SELECT e.Numero_evento, e.Nombre_evento, e.cliente as cliente, o.suma, f.Importe_Total, e.id_evento  FROM eventos e, ODC_ABIERTOS o, Reporte_Facturacion f where e.Numero_evento=o.evento and e.Numero_evento=f.Numero_evento and e.Estatus='ABIERTO' and e.cliente!='GASTO' and f.Importe_Total is not null and Ejecutivo like '%".$_COOKIE['user']."%' order by cliente asc, e.id_evento asc ";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $nombre_evento="[".$row[0]."] - ".$row[1];
        if($row[4]<$row[3]){
            $respuesta2=$respuesta2."<li style='padding-bottom:3px;'><a id='".$row[5]."' class='btn btn-danger btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento."</a></li>";
        }
        else{
            $respuesta2=$respuesta2."<li style='padding-bottom:3px;'><a id='".$row[5]."' class='btn btn-success btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento."</a></li>";
        }
    	
    }
    $result->close();
}

if($respuesta2==""){
    $respuesta2="No hay abiertos";
}
else{
    //si se cambia el titulo h3 se debe cambiar el javascript en el resposne del ajax
    $respuesta2="<h3 style='background-color:red; color:#fff;padding:4px'>Eventos pendientes por Cerrar</h3><ul style='list-style-type:none'>".$respuesta2."</ul>";
}

$div="<div class='row'>
<div class='col-md-6'>".$respuesta."</div>
<div class='col-md-6'>".$respuesta2."</div>
</div>";


echo $div;

$mysqli->close();
?>