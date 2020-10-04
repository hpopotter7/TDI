<?php 
$id_odc=$_POST['id_odc'];
include("conexion.php");
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
	$result = $mysqli->query("SET NAMES 'utf8'");
        $respuesta="";
        
		$sql="SELECT usuario_registra from odc where id_odc='".$id_odc."'";
		$result = $mysqli->query($sql);
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_row()) {
                $registra=$row[0];
                
                if($registra==$_COOKIE["user"]){
                    $respuesta= "MISMO";
                }
                else{
                    $respuesta=$registra;
                }
            }
            $result->close();
        }
		
		echo $respuesta;

	$mysqli->close();
?>