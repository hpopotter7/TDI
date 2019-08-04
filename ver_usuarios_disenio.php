<?php 
$tipo=$_POST['tipo'];
//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query("SELECT Nombre FROM usuarios where ".$tipo."='X' order by Nombre asc")) {
    
    while ($row = $result->fetch_row()) {
        echo "<option value='".$row[1]."'>".$row[1]."</option>";
    }
    //se añade freelance
    echo "<option value='freelance'>FREELANCE</option>";

    /* free result set */
    $result->close();
}


$mysqli->close();
?>