<?php 
$cp=$_POST['cp'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'"); 
$sql="select municipio, estado from  codigos_postales where CP='".$cp."' ";
$res="";
if ($result = $mysqli->query($sql)) {
   $cont=0;
    while ($row = $result->fetch_row()) {
        $return = Array('municipio'=>$row[0],
                        'estado'=>$row[1],
                        'error'=>'nada',
                        'sql'=>''
                            );
    }
    $result->close();
}
else{
    $return = Array('error'=>"Error", 
                    'sql'=>mysqli_error($mysqli));
}
$res=$res.json_encode($return);
echo $res;
$mysqli->close();
?>

  