<?php 
$usuario=$_POST['usuario'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$res="";
if ($result = $mysqli->query("SELECT tipo, No_tarjeta, id_tarjeta FROM tarjetas where usuario=(select id_usuarios from usuarios where Nombre='".$usuario."')")) {
    
    while ($row = $result->fetch_row()) {
    	$res=$res."<tr><td>".$row[0]."</td><td>".$row[1]."</td><td><a id='".$row[2]."' class='borrar_tarjeta' style='color:red; text-decoration:none;' href='#'><i class='fa fa-trash fa-2x' aria-hidden='true'></i></a></td></tr>";
    }
    $result->close();
}
if($res==""){
	$res="<tr><td colspan='3'>El usuario ".$usuario." no tiene registrada ninguna tarjeta</td></tr>";
}
echo $res;
$mysqli->close();
?>