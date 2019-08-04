<?php 
$id=$_POST['id'];
$importe=$_POST['importe'];

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
        $arr=explode("]",$id);
        $ev=str_replace("[", "", $arr[0]);
$sql="select id_evento from eventos where Numero_evento='".$ev."'";
    
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $id=$row[0];
        }
        $result->close();
    }
$res="vacio";
$suma=0;
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT cheque_por FROM odc where evento=".$id;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $suma=$suma+$row[0];
    }
    $result->close();
}
$ed=$sql;
$suma=$suma+$importe;
$sql="SELECT Facturacion FROM eventos where id_evento=".$id;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $costo=$row[0];
    }
    $result->close();
}

$porcentaje=$costo*.2;
$costo=$costo-$porcentaje;
if($suma<$costo){
	$res="verde";
}
else if($suma>=$costo && $suma<($costo+$porcentaje)){
	$res="amarillo";
}
else if($suma>=($costo+$porcentaje)){
	$res="rojo";
}
echo $res.$suma;
//echo $costo."#".$porcentaje."#".$suma;

$mysqli->close();
?>