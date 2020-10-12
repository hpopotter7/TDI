<?php 

$evento=$_POST['evento'];
$arr=explode("]",$evento);
$evento=str_replace("[", "", $arr[0]);

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT Ejecutivo FROM eventos where Numero_evento='".$evento."'";
$res="";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $resultado=$row[0];
        
    }
    $result->close();
}    

    $jefe_directo=substr($resultado,1,strlen($resultado));
    

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

echo "<option value='".$res."'>".$res."</option>";

$mysqli->close();
?>