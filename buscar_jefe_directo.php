<?php 

$solicita=$_POST['solicita'];

function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
}

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT Jefe_directo FROM usuarios where Nombre='".$solicita."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $jefe_directo=$row[0];
    }
    $result->close();
}

if(startsWith($solicita, "PA ")){
    $solicita=substr($solicita,3,strlen($solicita));
 echo $solicita;
 exit();
}

$sql="SELECT pa FROM usuarios where Nombre='".$jefe_directo."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        if($row[0]=="1"){
            $res="pa";
        }      
    }
    $result->close();
}

if($res=="pa"){
    $sql="SELECT Jefe_directo FROM usuarios where Nombre='".$jefe_directo."'";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $res="PA ".$row[0];
        }
        $result->close();
    }
}
else{
    $res=$jefe_directo;
}
echo $res;

$mysqli->close();
?>