<?php 
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");

$respuesta="";
$contador_numero=0;
$bandera_ejecutivo=true;
$sql="SELECT e.Numero_evento, e.Nombre_evento, e.cliente as cliente, o.suma, f.Importe_Total, e.id_evento  FROM eventos e, ODC_ABIERTOS o, Reporte_Facturacion f where e.Numero_evento=o.evento and e.Numero_evento=f.Numero_evento and e.Estatus='ABIERTO' and e.cliente!='GASTO' and f.Importe_Total is not null and Ejecutivo like '%".$_COOKIE['user']."%' order by cliente asc, e.id_evento asc ";

if($_COOKIE['user']=="SANDRA PEÑA" || $_COOKIE['user']=="ALAN SANDOVAL" || $_COOKIE['user']=="FERNANDA CARRERA"){
    $sql="SELECT e.Numero_evento, e.Nombre_evento, e.cliente as cliente, o.suma, f.Importe_Total, e.id_evento, REPLACE(e.Ejecutivo, ',','')  FROM eventos e, ODC_ABIERTOS o, Reporte_Facturacion f where e.Numero_evento=o.evento and e.Numero_evento=f.Numero_evento and e.Estatus='ABIERTO' and e.cliente!='GASTO' and f.Importe_Total is not null order by cliente asc, e.id_evento asc ";
    $bandera_ejecutivo=false;
}

if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $nombre_evento="[".$row[0]."] - ".$row[1];
        if($bandera_ejecutivo){
            if($row[4]<$row[3]){
                $respuesta=$respuesta."<li style='padding-bottom:3px;'><a id='".$row[5]."' class='btn btn-danger btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento."</a></li>";
            }
            else{
                $respuesta=$respuesta."<li style='padding-bottom:3px;'><a id='".$row[5]."' class='btn btn-success btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento."</a></li>";
            }
        }
        else{
            if($row[4]<$row[3]){
                $respuesta=$respuesta."<li style='padding-bottom:3px;'><a id='".$row[5]."' class='btn btn-danger btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento." <b><i>(".$row[6].")</i></b></a></li>";
            }
            else{
                $respuesta=$respuesta."<li style='padding-bottom:3px;'><a id='".$row[5]."' class='btn btn-success btn_evento_pendiente' href='#' title='".$row[2]."'>".$nombre_evento." <b><i>(".$row[6].")</i></b></a></li>";
            }
        }
        
    	
    }
    $result->close();
}

if($respuesta==""){
    $respuesta="No hay sin numero de factura";
}


echo "<ul>".$respuesta."</ul>";

$mysqli->close();
?>