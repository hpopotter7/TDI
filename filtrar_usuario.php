<?php 
if($_COOKIE['user']=="SANDRA PEÑA" || $_COOKIE['user']=="ALAN SANDOVAL" || $_COOKIE['user']=="FERNANDA CARRERA"){
    $respuesta="ADMIN";
}
else if($_COOKIE['user']=="SEBASTIAN ZUÑIGA"){
    $respuesta="SEBASTIAN";
}
else{
    include("conexion.php");
    if (mysqli_connect_errno()) {
        printf("Error de conexion: %s\n", mysqli_connect_error());
        exit();
    }
    $result = $mysqli->query("SET NAMES 'utf8'");
    
    $respuesta="";
    
    $sql="select Ejecutivo, CXP from usuarios where Nombre='".$_COOKIE['user']."'";
    
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            if($row[0]=="X"){
                $respuesta="EJECUTIVO";
            }
            else if($row[1]=="X"){
                $respuesta="CXP";
            }
            else{
                $respuesta="NINGUNO";
            }
        }
        $result->close();
    }    
    $mysqli->close();
}
echo $respuesta;

?>