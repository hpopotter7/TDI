<?php 

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$res='<option value="vacio">Selecciona...</option>';
    $sql="SELECT pa, jefe_directo FROM usuarios where Nombre='ALEJANDRA PADILLA'";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            if($row[0]=="1"){
                $res=$res."<option value='PA ".$row[1]."'>ALEJANDRA PADILLA (PA ".$row[1].")</option>";
            }
            else{
                $res=$res."<option value='ALEJANDRA PADILLA'>ALEJANDRA PADILLA</option>";
            }
        }
        $result->close();
    }
    $sql="SELECT pa, jefe_directo FROM usuarios where Nombre='FERNANDA CARRERA'";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            if($row[0]=="1"){
                $res=$res."<option value='PA ".$row[1]."'>FERNANDA CARRERA (PA ".$row[1].")</option>";
            }
            else{
                $res=$res."<option value='FERNANDA CARRERA'>FERNANDA CARRERA</option>";
            }
        }
        $result->close();
    }
    $sql="SELECT pa, jefe_directo FROM usuarios where Nombre='MIGUEL POBLACION'";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            if($row[0]=="1"){
                $res=$res."<option value='PA ".$row[1]."'>MIGUEL POBLACION (PA ".$row[1].")</option>";
            }
            else{
                $res=$res."<option value='MIGUEL POBLACION'>MIGUEL POBLACION</option>";
            }
        }
        $result->close();
    }

    



//$res=$res."<option value='".$row[0]."'>".$row[0]."</option>";


echo $res;

$mysqli->close();
?>