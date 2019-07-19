<?php 

$bandera=$_POST["bandera_sodexo"];
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

/* Select queries return a resultset */
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT Nombre FROM usuarios  order by Nombre asc";
if($bandera=="con"){
	$sql="SELECT Nombre, sodexo FROM usuarios where sodexo!='' order by Nombre asc";
}
else if($bandera=="sin"){
    $sql="SELECT Nombre, sodexo FROM usuarios where sodexo=='' order by Nombre asc";
}
else {
    $sql="SELECT Nombre FROM usuarios  order by Nombre asc";
}

if ($result = $mysqli->query($sql)) {
    

    /* fetch object array */
    echo '<option value="vacio">Selecciona un usuario...</option>';
    while ($row = $result->fetch_row()) {
       if($bandera=="si"){
             echo "<option value='".$row[0]."-".$row[1]."'>".$row[0]."-".$row[1]."</option>";
        }
        else{
            echo "<option value='".$row[0]."'>".$row[0]."</option>";
        }
    }
    
echo $sql;
    /* free result set */
    $result->close();
}
else{
    echo $mysqli->error.":".$sql;
}


$mysqli->close();
?>