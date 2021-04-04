<?php 
include("conexion.php");
$usuario=$_COOKIE['user'];
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$email="";

$result = $mysqli->query("SET NAMES 'utf8'"); 
$sql="select email from usuarios where Nombre='".$usuario."' ";
$email="";
if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
    $email=$row[0];
  }
}


$res="ninguno";
$cont=0;
$para="";
$sql="SELECT Asunto, Para_quien from notificaciones where Visto='1' and Para_quien='".$email."' order by Fecha_hora asc";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $para=$row[1];
        //if(strpos($para, $email) !== false ){
            $res="";
            $cont++;
       // }
    }
    $result->close();
}
echo $res.$sql.$cont;
?>