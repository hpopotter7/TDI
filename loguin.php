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
    $sql="SELECT Nombre, email, Pass, id_usuarios FROM usuarios where User='".$user."' and Pass='".$pass."' and Estatus='activo'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        if($pass=="tierraideas"){
            $res="Cambio de pass";
            setcookie("nombre", $user);
        }
        else{
            $res=$row[0];
            $email=$row[1];
            $pass=$row[2];
            $id=$row[3];
           
        }
    }
    $result->close();

    $pass=bin2hex($pass);

}
    setcookie("id", $id);
    setcookie("user", $res);
    setcookie("email", $email);
    setcookie("pass", $pass);
    setcookie("start", time());
$mysqli->close();


if ($res=="No existe"){
    header('Location:inicio.php');
}
else if ($res=="Cambio de pass"){
            
    header('Location:inicio.php');
}
else if($res!=""){
    header('Location:home.php');
}
else{
    header('Location:index.php');
 }


?>