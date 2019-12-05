<?php 
$id=$_POST["id"];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT comprobado FROM odc where id_odc=".$id;
if ($result = $mysqli->query($sql)) {
    $res='';
    while ($row = $result->fetch_row()) {
        if($row[0]=="no"){
            $res="";
        }
        else{
            $res="comprobado";
        }
    }
    $result->close();
}
echo $res;

$mysqli->close();
?>