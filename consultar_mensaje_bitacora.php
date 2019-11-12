<?php 
$id=$_POST['id'];

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'"); 
$sql="select notificacion from notificaciones where id_notificaciones=".$id;
$res="";
if ($result = $mysqli->query($sql)) {
   $cont=0;
    while ($row = $result->fetch_row()) {
        $res=$row[0];
    }
    $result->close();
}

    $sql="update notificaciones set visto=1 where id_notificaciones=".$id;
    if ($mysqli->query($sql)) {		    
        
    }
    else{
        $res= $sql.mysqli_error($mysqli);
    }

echo $res;
$mysqli->close();
?>

  