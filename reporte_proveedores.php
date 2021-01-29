<?php
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
function asmoneda($value) {
  return '$' . number_format($value, 2);
}

$res='<thead>
        <tr>
            <th>Razon Social</th>
            <th>Nombre comercial</th>
            <th>RFC</th>
            <th>Contacto</th>
            <th>Teléfono</th>
            <th>Correo de contacto</th>
            <th>Descripción</th>
            <th>CP</th>
            <th>Estado</th>
        </tr>
    </thead><tbody>';
$sql = "SELECT Razon_Social, Nombre_comercial, rfc, Nombre_contacto, Telefono, Correo_contacto, Descripcion, cp, Estado FROM proveedores where Numero_cliente!='0' and Estatus='activo' order by Razon_Social ASC";
$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query($sql)) {
     while ($row = $result->fetch_row()) {
        $res=$res.'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td><td>'.$row[7].'</td><td>'.$row[8].'</td></tr>';
 
    }
    $result->close();
}
$res=$res.'</tbody>';
//echo json_encode($data);
echo $res;
$mysqli->close();

?>
