<?php 
include("conexion.php");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

/* Select queries return a resultset */
$result = $mysqli->query("SET NAMES 'utf8'");
$res='<option value="vacio">Selecciona un cliente...</option>';
if ($result = $mysqli->query("SELECT id_cliente, Razon_Social FROM clientes where Numero_cliente!='0' order by Razon_Social asc")) {
    while ($row = $result->fetch_row()) {
        $res=$res."<option value='".$row[1]."'>".$row[1]."</option>";
    }
    $result->close();
}

echo $res;

$mysqli->close();
?>