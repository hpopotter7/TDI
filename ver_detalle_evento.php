<?php 
$id=$_POST['id'];
include("conexion.php");

/* validar la conexion */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
/* Select queries return a resultset */
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="";
if(substr($id,0,1)==="["){
    $arr=explode("]",$id);
    $ID=str_replace("[", "", $arr[0]);
    $sql="select id_evento from eventos where Numero_evento='".$ID."'";
    
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $id=$row[0];
        }
        $result->close();
    }
}
else{
    $result->close();
     $return = Array('error'=>mysqli_error($mysqli).$sql);
    $res=$res.json_encode($return)."\n";
    echo $res;
    //echo $sql.mysqli_error($mysqli);
   exit();
}
if ($result = $mysqli->query("SELECT * FROM eventos where id_evento=".$id)) {

    /* fetch object array */
    while ($row = $result->fetch_row()) {
        $return = Array('Numero_evento'=>$row[1], 
                    	'Nombre_evento'=>$row[2], 
                    	'Inicio_evento'=>$row[3], 
                    	'Fin_evento'=>$row[4],
                    	'Cliente'=>$row[5],
                    	'Destino'=>$row[6],
                    	'Sede'=>$row[7],
                    	'Diseno'=>$row[8],
                    	'Produccion'=>$row[9],
                    	'Facturacion'=>$row[10],
                    	'Solicita'=>$row[11],
                    	'Tipo'=>$row[12],
                    	'Comentarios'=>$row[13],
                        'Ejecutivo'=>$row[17],
                        'Digital'=>$row[18]
        	);
    }

    /* cerramos la conexion */
    $result->close();
    $res=$res.json_encode($return)."\n";
    echo $res;
}
else{
    $result->close();
     $return = Array('error'=>mysqli_error($mysqli).$sql);
    $res=$res.json_encode($return)."\n";
    echo $res;
    //echo $sql.mysqli_error($mysqli);
   exit();
}


$mysqli->close();
?>

