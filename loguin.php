<?php     
session_start();
$user=$_POST['user'];
$pass=$_POST['pass'];
$usuario="No existe";
$res="";
include("conexion.php");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
    $result = $mysqli->query("SET NAMES 'utf8'");
    $sql="SELECT Nombre FROM usuarios where User='".$user."' and Pass='".$pass."' and Estatus='activo'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
            $_SESSION['luser'] = $row[0];
            $_SESSION['start'] = time(); // Taking now logged in time.
            // Ending a session in 30 minutes from the starting time.
            $res=$row[0];
    }
    $result->close();
}

$mysqli->close();
if (isset($_SESSION['luser']) ){
    header('Location:home.php');
}

?>