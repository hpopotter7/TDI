<?php 
include("conexion.php");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query("SELECT * FROM usuarios where Tipo like '%SOL%' order by Nombre asc")) {
    

    /* fetch object array */
    echo "<option value='vacio'>Selecciona un usuario...</option>";
    echo "<option value='NA'>NA</option>";
    while ($row = $result->fetch_row()) {
        echo "<option value='".$row[1]."'>".$row[1]."</option>";
    }

    /* free result set */
    $result->close();
}


$mysqli->close();
?>