<?php 

include("conexion.php");

if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

/* Select queries return a resultset */
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT p.razon_social, o.Razon_Social FROM proveedores p LEFT join proveedores_con_odc o on p.Razon_Social=o.Razon_Social order by p.Razon_Social asc";
if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_row()) {
        $activo="";
        if($row[1]==null){
            $activo="disabled";
        }
        echo "<option value='".$row[0]."' ".$activo.">".$row[0]."</option>";
    }
    

    /* free result set */
    $result->close();
}


$mysqli->close();
?>