<?php 
$titulo=$_POST['titulo'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");

$respuesta="<thead><tr><th id='titulo'>".$titulo."</th></tr></thead><tbody>";
$contador_numero=0;

$sql="SELECT e.Numero_evento, e.Nombre_evento, e.cliente, e.id_evento, REPLACE(e.Ejecutivo, ',', '') from eventos e left join odc o on e.Numero_evento=o.evento left join solicitud_factura s on e.id_evento=s.id_evento where o.evento is null and s.id_evento is null and e.Estatus='ABIERTO' and Ejecutivo like '%".$_COOKIE['user']."%' order by e.Numero_evento asc";

if($_COOKIE['user']=="SANDRA PEÑA" || $_COOKIE['user']=="ALAN SANDOVAL" || $_COOKIE['user']=="FERNANDA CARRERA"){
    $sql="SELECT e.Numero_evento, e.Nombre_evento, e.cliente, e.id_evento, REPLACE(e.Ejecutivo, ',', '') from eventos e left join odc o on e.Numero_evento=o.evento left join solicitud_factura s on e.id_evento=s.id_evento where o.evento is null and s.id_evento is null and e.Estatus='ABIERTO' order by e.Numero_evento asc";
}
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $nombre_evento="[".$row[0]."] ".$row[2]." - ".$row[1];
            $respuesta=$respuesta."<tr><td><a id='".$row[3]."' class='btn btn-warning btn_evento_pendiente' href='#' title='".$row[1]."'>".$nombre_evento." (".$row[4].")</a></td></tr>";    	
    }
    $result->close();
}

if($respuesta==""){
    $respuesta="<tr><td>No hay pendeintes</td></tr>";
}

echo $respuesta."</tbody>";

$mysqli->close();
?>