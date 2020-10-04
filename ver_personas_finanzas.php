<?php 

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$res='';
    $sql="SELECT pa, jefe_directo FROM usuarios where Nombre='RITA VELEZ'";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            if($row[0]=="1"){
                $res=$res."<option value='PA ".$row[1]."'>RITA VELEZ (PA ".$row[1].")</option>";
            }
            else{
                $res=$res."<option value='RITA VELEZ'>RITA VELEZ</option>";
            }
        }
        $result->close();
    }
    

echo $res;

$mysqli->close();
?>