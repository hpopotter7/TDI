
<?php 
$evento=$_POST['evento'];
include("conexion.php");

if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$nombre_evento="";
$error="";
$result = $mysqli->query("SET NAMES 'utf8'"); 
$sql="SELECT sum(Importe_total) from odc where evento='".$evento."' and Cancelada='no'";
$egresos=0;
$utilidad=0;
$facturacion=0;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $egresos=$row[0];
    }
}
else{
    $error="Error:<br>".mysqli_error($mysqli);
}


$sql="SELECT id_evento, Nombre_evento from eventos where Numero_evento='".$evento."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $id_evento=$row[0];
        $nombre_evento=$row[1];
    }
}
else{
    $error="Error:<br>".mysqli_error($mysqli);
}


$sql="SELECT id_solicitud from solicitud_factura where  id_evento='".$id_evento."' and Estatus='Activa'";
$solicitudes="";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $solicitudes=$solicitudes.$row[0].",";
    }
}
else{
    $error="Error:<br>".mysqli_error($mysqli);
}

$solicitudes=substr($solicitudes, 0, (strlen($solicitudes)-1));
$sql="SELECT sum(total) from partidas where id_sol_factura in(".$solicitudes.")";
$solicitudes="";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $facturacion=$row[0];
    }
}
else{
    $error="Error:<br>".mysqli_error($mysqli);
}


$utilidad=($facturacion)-($egresos);
if($utilidad<0){
    $utilidad="NA";
}


$return = Array('egresos'=>$egresos,
                'utilidad'=>$utilidad,
                'numero_evento'=>$evento,
                'nombre_evento'=>$nombre_evento,
                'error'=>$error,
                );



//$resultado=$egresos."#".$utilidad."|Utilidad: ".$evento." - ".$nombre_evento;


echo json_encode($return);
//echo $egresos."-".$utilidad."-".$evento."-".$nombre_evento;
//echo $return;
$mysqli->close();

?>
