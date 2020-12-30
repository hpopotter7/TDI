<?php 
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");

$respuesta="";
$respuesta2="";
$sql="SELECT e.Numero_evento, e.Nombre_evento, e.cliente as cliente, s.id_evento, e.id_evento, s.No_Factura, s.Estatus_Factura, s.id_solicitud   
FROM eventos e, solicitud_factura s where e.id_evento=s.id_evento and e.Estatus='ABIERTO' and s.Estatus='Activa' and (s.No_Factura is null or s.Estatus_Factura is null) order by cliente asc, e.id_evento asc";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $nombre_evento="[".$row[0]."] - ".$row[1];
        if($row[5]==null){
            $respuesta=$respuesta."<li style='padding-bottom:3px;'><a id='".$row[3]."' class='btn btn-warning btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento."</a></li>";
        }
        if($row[6]==null){
            $respuesta2=$respuesta2."<li style='padding-bottom:3px;'><a id='".$row[3]."' class='btn btn-warning btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento."</a></li>";
        }
    	
    }
    $result->close();
}

if($respuesta==""){
    $respuesta="No hay sin numero de factura";
}
else{
    //si se cambia el titulo h3 se debe cambiar el javascript en el resposne del ajax
    $respuesta="<h3 style='background-color:red; color:#fff;padding:4px'>Eventos con factura sin número</h3><ul style='list-style-type:none'>".$respuesta."</ul>";
}
if($respuesta2==""){
    $respuesta2="No hay sin estatus de factura ";
}
else{
    //si se cambia el titulo h3 se debe cambiar el javascript en el resposne del ajax
    $respuesta2="<h3 style='background-color:red; color:#fff;padding:4px'>Eventos con factura sin estatus</h3><ul style='list-style-type:none'>".$respuesta2."</ul>";
}

$div="<div class='row'>
<div class='col-md-6'>".$respuesta."</div>
<div class='col-md-6'>".$respuesta2."</div>
</div>";


echo $div;

$mysqli->close();
?>