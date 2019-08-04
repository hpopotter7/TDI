<?php 
$user=$_POST['user'];
$pass=$_POST['pass'];
$resultado="No existe";
//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

/* Select queries return a resultset */
if ($result = $mysqli->query("SELECT * FROM usuarios where User='".$user."' and Pass='".$pass."'")) {
    
    /* fetch object array */
    while ($row = $result->fetch_row()) {
        $resultado=$row[1]."#".$row[4];
    }
    /* free result set */
    $result->close();
}
echo $resultado;


$mysqli->close();
?>