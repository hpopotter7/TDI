<?php
$nombre=$_GET["nombre"];
$cp=$_GET["cp"];
$col=$_GET['col'];

//$alan=$_POST["alan"];
include("conexion.php");

if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$array= array();
$result = $mysqli->query("SET NAMES 'utf8'");
  //$sql="select DISTINCT(nombre) from codigos_postales where cp='".$cp."' and nombre like '%".$nombre."%'";
  $sql="select DISTINCT(nombre) from codigos_postales where cp='".$cp."' order by nombre asc";
  $res="<option value=''>Selecciona...</option>";
if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
     //$return=$return.$row[0]."##";
     /* $return = Array('name'=>$row[0]);
     $array[]=$return; */
     
     if($row[0]==$col){
      $res=$res."<option value='".$row[0]."' selected>".$row[0]."</option>";
     }
     else{
      $res=$res."<option value='".$row[0]."'>".$row[0]."</option>";
     }
     
}
    $result->close();
}
else{
    $return = Array('name'=>mysqli_error($mysqli));
     $array[]=$return;
}
//echo json_encode($array);
$res=$res."<option value='0'>Otra...</option>";
echo $res;

$mysqli->close();

?>
