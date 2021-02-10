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
$sql="SELECT e.Numero_evento, e.Nombre_evento, e.cliente as cliente, o.suma, f.Importe_Total, e.id_evento  FROM eventos e, ODC_ABIERTOS o, Reporte_Facturacion f where e.Numero_evento=o.evento and e.Numero_evento=f.Numero_evento and e.Estatus='ABIERTO' and e.cliente!='GASTO' and f.Importe_Total is null and Ejecutivo like '%".$_COOKIE['user']."%' order by cliente asc, e.id_evento asc ";
$bandera_ejecutivo=true;
if($_COOKIE['user']=="SANDRA PEÑA" || $_COOKIE['user']=="ALAN SANDOVAL" || $_COOKIE['user']=="FERNANDA CARRERA"){
    $sql="SELECT e.Numero_evento, e.Nombre_evento, e.cliente as cliente, o.suma, f.Importe_Total, e.id_evento, REPLACE(e.Ejecutivo, ',','')  FROM eventos e, ODC_ABIERTOS o, Reporte_Facturacion f where e.Numero_evento=o.evento and e.Numero_evento=f.Numero_evento and e.Estatus='ABIERTO' and e.cliente!='GASTO' and f.Importe_Total is null order by Ejecutivo asc, cliente asc, e.id_evento asc ";
    $bandera_ejecutivo=false;
}
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $respuesta=$respuesta."<tr>";
        $nombre_evento="[".$row[0]."] ".$row[2]." - ".$row[1];
        if($bandera_ejecutivo){
            $respuesta=$respuesta."<td><a id='".$row[5]."' class='btn btn-warning btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento."</a></td>";
        }
        else{
            $respuesta=$respuesta."<td><a id='".$row[5]."' class='btn btn-warning btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento." <b><i>(".$row[6].")</i></b></a></td>";
        }
    	$respuesta=$respuesta."</tr>";
    }
    $result->close();
}

if($respuesta==""){
    $respuesta="<tr><td>No hay sin numero de factura</td></tr>";
}


echo $respuesta."</tbody>";

$mysqli->close();
?>