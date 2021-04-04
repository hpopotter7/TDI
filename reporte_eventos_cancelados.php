<?php
include("conexion.php");
$mysqli2=$mysqli;
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
function asmoneda($value) {
  return '$' . number_format($value, 2);
}

$result = $mysqli->query("SET NAMES 'utf8'");

$res='<thead>
        <tr>
            <th>Número evento</th>
            <th>Nombre</th>
            <th>Cliente</th>
            <th>Ejecutivo</th>
        </tr>
    </thead><tbody>';
$sql = "SELECT Numero_evento, Nombre_evento, Cliente, REPLACE(Ejecutivo, ',','') as Ejecutivo, id_evento  FROM eventos where Estatus='CANCELADO' and (Ejecutivo like '%".$_COOKIE['user']."%') order by Numero_evento ";

if($_COOKIE['user']=="SANDRA PEÑA" || $_COOKIE['user']=="FERNANDA CARRERA" || $_COOKIE['user']=="ALAN SANDOVAL"){
    $sql = "SELECT Numero_evento, Nombre_evento, Cliente, REPLACE(Ejecutivo, ',','') as Ejecutivo, id_evento  FROM eventos where Estatus='CANCELADO' order by Numero_evento ";
}

if ($result = $mysqli->query($sql)) {
     while ($row = $result->fetch_assoc()) {
        $evento=$row['Numero_evento'];
        $nombre=$row['Nombre_evento'];
        $cliente=$row['Cliente'];
        $ejecutivo=$row['Ejecutivo'];
        $res=$res.'<tr><td>'.$evento.'</td><td>'.$nombre.'</td><td>'.$cliente.'</td><td>'.$ejecutivo.'</td></tr>';
    }
   
  

    $result->close();
}

$res=$res.'</tbody>';
//echo json_encode($data);
echo $res;
$mysqli->close();

?>



