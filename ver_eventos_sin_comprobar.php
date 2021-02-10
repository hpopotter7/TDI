<?php 
$titulo=$_POST['titulo'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");

$respuesta="<thead><tr><td>Pendientes</td></tr></thead><tbody><tr style='background-color: rgba(155,175,55,.7)';><th>".$titulo."</th></tr>";
$contador_numero=0;

$sql="SELECT count(o.evento), o.evento, e.Nombre_evento, e.id_evento, e.cliente from odc o, eventos e where o.evento=e.Numero_evento and e.Estatus='ABIERTO' and comprobado='no' and Cancelada='no' group by evento ";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $contador=$contador+$row[0];
        $nombre_evento="[".$row[1]."] ".$row[4]." - ".$row[2];
            $respuesta=$respuesta."<tr><td><a id='".$row[3]."' class='btn btn-warning btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento." <span class='badge'> ".$row[0]."</span></td></tr></a></li>";    	
    }
    $result->close();
}

if($respuesta==""){
    $respuesta="<tr><td>No hay pendientes</td></tr>";
}

echo $respuesta."</tbody>";

$mysqli->close();
?>