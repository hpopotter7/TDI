<?php 

//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

/* Select queries return a resultset */
if ($result = $mysqli->query("SELECT count(id_evento), DATE_FORMAT(NOW(), '%Y') FROM eventos")) {
    

    /* fetch object array */
    $filas="0";
    while ($row = $result->fetch_row()) {
        $r=$row[0]+1;
    	if($r<10){
    		$filas= $row[1]."-00".$r;	
    	}
    	else if($row[0]<100){
    		$filas= $row[1]."-0".$r;	
    	}
    	else{
             $filas= $row[1]."-".$r;
        }
    }
    echo $filas;
    /* free result set */
    $result->close();
}


$mysqli->close();
?>