<?php 

$clien=$_POST["clien"];
$usuario=$_POST["usuario"];
include("conexion.php");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$ban=0;
/* Select queries return a resultset */
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="";
if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
$sql="SELECT id_evento, CONCAT(Numero_evento, ' ', Nombre_evento) FROM eventos where Cliente='".$clien."' and Estatus='ABIERTO'";
}
else{
$sql="SELECT id_evento, CONCAT(Numero_evento, ' ', Nombre_evento) FROM eventos where (Ejecutivo like '%".$usuario."%' or Disenio like '%".$usuario."%' or Digital like '%".$usuario."%' or Solicita like '%".$usuario."%' or Produccion like '%".$usuario."%') and Cliente='".$clien."' and Estatus='ABIERTO'";
}
if ($result = $mysqli->query($sql)) {
    /* fetch object array */
    $resultado= '<option value="vacio">Selecciona un evento...</option>';
    while ($row = $result->fetch_row()) {
    	$ban=1;
        $resultado=$resultado."<option value='".$row[0]."'>".$row[1]."</option>";
    }

    /* free result set */
    $result->close();
}
else{
    $result->close();
        $resultado=$sql." La consulta SQL contiene errores.".mysql_error();
    }
if($ban==0){
	$resultado='<option value="vacio">No hay eventos para ese cliente</option>'.$sql;
}
echo $resultado.$sql;

$mysqli->close();
?>