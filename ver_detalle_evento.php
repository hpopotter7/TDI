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
/*
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
*/

if ($result = $mysqli->query("SELECT * FROM eventos where id_evento=".$id)) {

    /* fetch object array */
    while ($row = $result->fetch_assoc()) {
        $return = Array('Numero_evento'=>$row['Numero_evento'], 
                    	'Nombre_evento'=>$row['Nombre_evento'], 
                    	'Inicio_evento'=>$row['Inicio_evento'], 
                    	'Fin_evento'=>$row['Fin_evento'],
                    	'Cliente'=>$row['Cliente'],
                    	'Destino'=>$row['Destino'],
                    	'Sede'=>$row['Sede'],
                    	'Diseno'=>$row['Disenio'],
                    	'Produccion'=>$row['Produccion'],
                    	'Facturacion'=>$row['Facturacion'],
                    	'Solicita'=>$row['Solicita'],
                    	'Tipo'=>$row['Tipo'],
                    	'Comentarios'=>$row['Comentarios'],
                        'Ejecutivo'=>$row['Ejecutivo'],
                        'Digital'=>$row['Digital'],
                        'Video'=>$row['Video']
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

