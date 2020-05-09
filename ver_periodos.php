<?php 

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$sql="select substring_index(Numero_evento,'-',1), count(Numero_evento) from eventos group by substring_index(Numero_evento,'-',1)";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        echo "<option value='".$row[0]."' selected>".$row[0]."</option>";
    }
    
    $result->close();
}
$mysqli->close();
?>