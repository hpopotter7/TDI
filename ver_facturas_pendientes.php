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
$sql="SELECT count(s.id_evento), s.id_evento, e.Nombre_evento, e.id_evento, e.Numero_evento, e.cliente from solicitud_factura s, eventos e where s.id_evento=e.id_evento and e.Estatus='ABIERTO' and s.Estatus='Activa' and No_factura is null group by s.id_evento ";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $respuesta=$respuesta."<tr>"; 
        $contador_numero=$contador_numero+$row[0];
        $nombre_evento="[".$row[4]."] ".$row[5]." - ".$row[2];
           $respuesta=$respuesta."<td><a id='".$row[3]."' class='btn btn-warning btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento." <span class='badge'> ".$row[0]."</span></a></td>";    	
           $respuesta=$respuesta."</tr>"; 
    }
    $result->close();
}


if($respuesta==""){
    $respuesta="No hay sin numero de factura";
}


echo $respuesta."</tbody>";

$mysqli->close();
?>