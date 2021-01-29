<?php     

$user=$_POST['user'];
$pass=$_POST['pass'];
$res="No existe";
$mysqli = new mysqli("209.59.139.52:3306", "admini27_demo", "@ERPideas2019", "admini27_demo");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    printf("Error de conexion: %s\n", mysqli_error());
    
    exit();
}
    $result = $mysqli->query("SET NAMES 'utf8'");
    $sql="SELECT Nombre FROM usuarios where User='".$user."' and Pass='".$pass."' and Estatus='activo'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        if($pass=="tierraideas"){
            $res="Cambio de pass";
            setcookie("nombre", $user);
        }
        else{
            $res=$row[0];
           
        }
    }
    $result->close();
}
    setcookie("user", $res);
            setcookie("start", time());
$mysqli->close();


if ($res=="No existe"){
    header('Location:index.php');
}
else if ($res=="Cambio de pass"){
            
    header('Location:index.php');
}
else if($res!=""){
    header('Location:home.php');
}
else{
    header('Location:index.php');
 }


?>