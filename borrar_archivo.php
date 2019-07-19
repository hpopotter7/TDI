<?php 
$nombre=$_GET["nombre"];
$carpeta=$_GET["carpeta"];
$nombre="archivos/".$carpeta."/".$nombre;
unlink($nombre);
 ?>