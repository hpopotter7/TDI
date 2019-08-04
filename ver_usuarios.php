<?php 

//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

/* Select queries return a resultset */
$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query("SELECT * FROM usuarios where Estatus='activo' order by Nombre asc")) {
    

    /* fetch object array */
    echo "0#<option value='vacio'>Selecciona un usuario...</option>";
    while ($row = $result->fetch_row()) {
        echo "<option value='".$row[1]."'>".$row[1]."</option>";
    }

    /* free result set */
    $result->close();
}


$mysqli->close();
?>