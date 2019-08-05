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
if ($result = $mysqli->query("SELECT id_cliente, Razon_Social FROM clientes where Numero_cliente!='0' and estatus='activo' order by Razon_Social asc")) {
    

    /* fetch object array */
    echo '<option value="vacio">Selecciona un cliente...</option>';
    while ($row = $result->fetch_row()) {
        echo "<option value='".$row[0]."&".$row[1]."'>".$row[1]."</option>";
    }

    /* free result set */
    $result->close();
}


$mysqli->close();
?>