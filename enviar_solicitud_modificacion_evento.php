<?php

$texto=$_POST['texto']; 
$evento=$_POST['evento']; 
$usuario=$_POST['usuario']; 
$id=$_POST['id']; 


include("conexion.php");

$respuesta="";
//revisar si el usuario es el solicitante
$result = $mysqli->query("SET NAMES 'utf8'");
$sql2="SELECT Ejecutivo FROM eventos where id_evento=".$id;
if ($result = $mysqli->query($sql2)) {
    
    while ($row = $result->fetch_row()) {
      if($usuario!=$row[0]){
        $respuesta="problema usuario".$usuario.$row[0];
      }
    }
    $result->close();
}


echo $respuesta.$sql2;

?>