<?php 
$rfc=$_POST['rfc'];
$tipo=$_POST['tipo'];
//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");
$resultado="no";
/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
/* Select queries return a resultset */
$sql="";
if($tipo=="clientes"){
$sql="SELECT RFC, Razon_Social from clientes where rfc='".$rfc."'";
}
else{
	$sql="SELECT RFC, Razon_Social from proveedores where rfc='".$rfc."'";
}
if ($result = $mysqli->query($sql)) {
    

    /* fetch object array */
    while ($row = $result->fetch_row()) {
    	$resultado="ya existe#".$row[1];
    }
    /* free result set */
    $result->close();
}
echo $resultado;


$mysqli->close();
?>