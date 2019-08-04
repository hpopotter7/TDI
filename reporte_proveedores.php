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
        </tr>
    </thead><tbody>';
$sql = "SELECT Razon_Social, Nombre_comercial, rfc, Nombre_contacto, Telefono, Correo_contacto FROM proveedores where Numero_cliente!='0' order by Razon_Social ASC";
$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query($sql)) {
     while ($row = $result->fetch_row()) {
        /*
        $arr_cliente=explode('&', $row[2]);
        $money=asmoneda($row[10]);
        $dis=$row[8];
        if($dis=="vacio"){
            $dis="";
        }
        $productor=$row[9];
        $ar_productor=explode(",",$row[9]);
        $pro="<ul>";
        for($r=1;$r<=count($ar_productor)-1;$r++){
            $pro=$pro."<li>".$ar_productor[$r]."</li>";
        }
        $pro=$pro."</ul>";
        */
        $res=$res.'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td></tr>';
 
    }
    $result->close();
}
$res=$res.'</tbody>';
//echo json_encode($data);
echo $res;
$mysqli->close();

?>
