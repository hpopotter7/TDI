<?php 
$tipo=$_POST['tipo'];
//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

if($tipo!="Ejecutivo"){
        echo "<option value='NA'>NA</option>";
    }
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT Nombre FROM usuarios where ".$tipo."='X' and Estatus='activo' order by Nombre asc";
if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_row()) {
        if($row[0]!="ALAN SANDOVAL"){
            echo "<option value='".$row[0]."'>".$row[0]."</option>";
        }
        
    }
    //se añade freelance
    if($tipo=="Productor" || $tipo=="Disenio"){
		echo "<option value='freelance'>FREELANCE</option>";
    }
    
    

    /* free result set */
    $result->close();
}


$mysqli->close();
?>