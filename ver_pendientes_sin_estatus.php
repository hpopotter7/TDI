<?php 
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$respuesta="";
$contador_estatus=0;$sql="SELECT count(s.id_evento), s.id_evento, e.Nombre_evento, e.id_evento, e.Numero_evento from solicitud_factura s, eventos e where s.id_evento=e.id_evento and e.Estatus='ABIERTO' and s.Estatus='Activa' and Estatus_Factura is null group by s.id_evento ";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $respuesta=$respuesta."<tr>"; 
        $contador_estatus=$contador_estatus+$row[0];
        $nombre_evento="[".$row[4]."] - ".$row[2];
        $respuesta=$respuesta."<td><a id='".$row[3]."' class='btn btn-warning btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento." <span class='badge'> ".$row[0]."</span></a></td>";    	
        $respuesta=$respuesta."</tr>"; 
    }
    $result->close();

}
if($respuesta==""){
    $respuesta="No hay pendientes ".$sql;
}
echo $respuesta;

$mysqli->close();
?>