<?php 
$bandera=$_POST['bandera'];
$usuario=$_POST["usuario"];
include("conexion.php");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$sql="";
if($bandera=="false"){
    $sql="SELECT id_proveedor, Razon_Social, Numero_cliente, 1 FROM proveedores where Numero_cliente !='0' and estatus='activo' order by Razon_Social asc";
}
else{
    if($usuario=="SANAYN MARTINEZ" || $usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
        $sql="SELECT id_proveedor, Razon_Social, Numero_cliente, 1 FROM proveedores where Numero_cliente ='0' and Estatus='activo' order by Razon_Social asc";
    }
    else{
        $sql="SELECT id_proveedor, Razon_Social, Numero_cliente, DATE_FORMAT(fecha_solicitud, '%d-%m-%Y %H:%i') FROM proveedores where Numero_cliente ='0' and Estatus='activo' and Usuario_solicita='".$usuario."' order by Razon_Social asc";
    }
}

$result = $mysqli->query("SET NAMES 'utf8'");
$resultado="";
if ($result = $mysqli->query($sql)) {

           $resultado='<option value="vacio">Selecciona un proveedor...</option>';
   
    while ($row = $result->fetch_row()) {
        if($row[3]=="1"){
            $var="";
        }
        else{
            $var="  <i>[".$row[3]."]</i>";
        }
        $resultado=$resultado."<option value='".$row[0]."&".$row[1]."'><b>".$row[1]."</b>".$var."</option>";
    }

    /* free result set */
    $result->close();
}
else{
    echo $sql;
}
echo $resultado;

$mysqli->close();
?>