<?php 
$id=$_POST['id'];
//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* validar la conexion */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
/* Select queries return a resultset */
$sql="SELECT c.Razon_Social, c.rfc, c.digitos, c.tipo_persona, c.nombre_comercial, c.calle, c.num_ext, c.num_int, c.colonia, c.cp, c.telefono, c.estado, c.municipio, c.nombre_contacto, c.correo_contacto, c.uso_cfdi, p.identificacion  FROM clientes c, paises p where c.pais=p.Nombre and id_cliente=".$id;
$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query($sql)) {

    /* fetch object array */
    while ($row = $result->fetch_row()) {
        $return = Array('nombre'=>$row[0],
            'rfc'=>$row[1],  
            'digitos'=>$row[2],  
        	'tipo_persona'=>$row[3], 
        	'nombre_comercial'=>$row[4], 
        	'calle'=>$row[5],
        	'num_ext'=>$row[6],
        	'num_int'=>$row[7],
        	'colonia'=>$row[8],
        	'cp'=>$row[9],
        	'telefono'=>$row[10],
        	'estado'=>$row[11],
        	'municipio'=>$row[12],
        	'nombre_contacto'=>$row[13],
        	'email_contacto'=>$row[14],
            'cfdi'=>$row[15],
            'pais'=>$row[16],
            'error'=>'nada',
            'sql'=>''
        	);
    }
    /* cerramos la conexion */
    $result->close();
}
else{
    $return = Array('error'=>"Error", 
                    'sql'=>mysqli_error($mysqli));
}
$res=$res.json_encode($return);

echo $res;

$mysqli->close();
?>

