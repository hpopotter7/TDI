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
$sql="SELECT Razon_Social, rfc, digitos, tipo_persona, nombre_comercial, calle, num_ext, num_int, colonia, cp, telefono, estado, municipio, nombre_contacto, correo_contacto, uso_cfdi, extension, celular FROM clientes where id_cliente=".$id;
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
            'extension'=>$row[16],
            'celular'=>$row[17],
            'cobertura'=>"",
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

