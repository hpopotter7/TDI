<?php 
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");

$respuesta="";
$respuesta2="";
$contador=0;
$sql="SELECT count(o.evento), o.evento, e.Nombre_evento, e.id_evento from odc o, eventos e where o.evento=e.Numero_evento and e.Estatus='ABIERTO' and pagado='no' and Cancelada='no' group by evento ";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $contador=$contador+$row[0];
        $nombre_evento="[".$row[1]."] - ".$row[2];
            $respuesta=$respuesta."<li style='padding-bottom:3px;'><a id='".$row[3]."' class='btn btn-warning btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento." <span class='badge'> ".$row[0]."</span></a></li>";    	
    }
    $result->close();
}

if($respuesta==""){
    $respuesta="No hay sin pagado";
}
else{
    //si se cambia el titulo h3 se debe cambiar el javascript en el resposne del ajax
    $respuesta="<h3 style='background-color:red; color:#fff;padding:4px'>Eventos con solicitudes sin pagar</h3><ul style='list-style-type:none'>".$respuesta."</ul>";
}

$sql="SELECT count(o.evento), o.evento, e.Nombre_evento, e.id_evento from odc o, eventos e where o.evento=e.Numero_evento and e.Estatus='ABIERTO' and comprobado='no' and Cancelada='no' group by evento ";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $contador=$contador+$row[0];
        $nombre_evento="[".$row[1]."] - ".$row[2];
            $respuesta2=$respuesta2."<li style='padding-bottom:3px;'><a id='".$row[3]."' class='btn btn-warning btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento." <span class='badge'> ".$row[0]."</span></a></li>";    	
    }
    $result->close();
}


if($respuesta2==""){
    $respuesta2="No hay sin comprobado ";
}
else{
    //si se cambia el titulo h3 se debe cambiar el javascript en el resposne del ajax
    $respuesta2="<h3 style='background-color:red; color:#fff;padding:4px'>Eventos con solicitudes sin comprobar</h3><ul style='list-style-type:none'>".$respuesta2."</ul>";
}

$div="<div class='row'>
<div class='col-md-6'>".$respuesta."</div>
<div class='col-md-6'>".$respuesta2."</div>
</div>";


echo $div;

$mysqli->close();
?>