<?php 
$tipo=$_POST['tipo'];
include("conexion.php");
$where="";
if($tipo=="" || $tipo==null){
    $where="";
}
else{
    $where="where Estatus='".$tipo."'";
}
/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query("SELECT * FROM usuarios ".$where." order by Nombre asc")) {
    echo "<option value='vacio'>Selecciona un usuario...</option>";
    while ($row = $result->fetch_row()) {
        if($row[1]!="ALAN SANDOVAL"){
            $color='style="color: black;"';
            if($row[12]!="activo"){
                $color='style="color: orange;"';
            }
            echo "<option value='".$row[1]."' ".$color.">".$row[1]."</option>";
        }
    }
    $result->close();
}
else{
    echo "Error";
}

$mysqli->close();
?>