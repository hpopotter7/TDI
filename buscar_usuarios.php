<?php 
$user=$_POST['user'];

//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

/* Select queries return a resultset */
if ($result = $mysqli->query("SELECT * FROM usuarios")) {
    

    /* fetch object array */
    while ($row = $result->fetch_row()) {
        echo $row[1];
    }

    /* free result set */
    $result->close();
}


$mysqli->close();
?>