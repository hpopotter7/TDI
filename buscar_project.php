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

    
    $ARR=explode(",",$resultado);
    $tamaño=count($ARR);
    
	for ($i=1; $i <= $tamaño-1; $i++) { 
     $res=$res."<option value='".$ARR[$i]."'>".$ARR[$i]."</option>";
    }
echo $res;

$mysqli->close();
?>