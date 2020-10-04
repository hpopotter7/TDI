<?php 

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$array=array();
$array_pa=array();
$array_pa_user=array();
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT Nombre FROM usuarios where Solicitante='X' and estatus='activo' order by Nombre";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        if($row[0]!="ALAN SANDOVAL"){
            array_push($array,$row[0]);
        }
    }
    $result->close();
}


$sql="SELECT Nombre FROM usuarios where pa=1 and estatus='activo'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        array_push($array_pa,$row[0]);
    }
    $result->close();
}
    
foreach($array_pa as $valor){
    $x=$valor;
    $sql="SELECT jefe_directo FROM usuarios where estatus='activo' and Nombre='".$valor."'";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            array_push($array_pa_user,$row[0]);
        }
        $result->close();
    }
}

$res='<option value="vacio">Selecciona...</option>';
for($r=0;$r<=count($array)-1;$r++){
    $var="<option value='".$array[$r]."'>".$array[$r]."</option>";
    for($x=0;$x<=count($array_pa_user)-1;$x++){
        if($array[$r]==$array_pa[$x]){
            $var="<option value='PA ".$array_pa_user[$x]."'>".$array[$r]." (PA ".$array_pa_user[$x].")</option>";
            break;
        }
        
    }
    
    $res=$res.$var;
    
}

//$res=$res."<option value='".$row[0]."'>".$row[0]."</option>";


echo $res;

$mysqli->close();
?>