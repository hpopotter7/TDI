<?php 
include("conexion.php");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query("SELECT id_usuarios, Nombre FROM usuarios where Ejecutivo='X' order by Nombre asc")) {
    
    while ($row = $result->fetch_row()) {
        if($row[1]!="ALAN SANDOVAL"){
            echo "<option value='".$row[0]."'>".$row[1]."</option>";
        }
        
    }
    $result->close();
}
else{
    echo mysqli_error($mysqli);
}


$mysqli->close();
?>