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
$sql="SELECT * FROM proveedores where id_proveedor=".$id;
$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query($sql)) {

    /* fetch object array */
    while ($row = $result->fetch_row()) {
        $cobertura=$row[33];
        if($row[33]==null || $row[33]==""){
            $cobertura=",";
        }
        $return = Array(
            'nombre'=>$row[2],
            'nombre_comercial'=>$row[3],
            'rfc'=>$row[4],  
            'descripcion'=>$row[5],  
            'calle'=>$row[6],
            'num_ext'=>$row[7],
            'num_int'=>$row[8],
            'colonia'=>$row[9],
            'cp'=>$row[10],
            'estado'=>$row[11],
            'municipio'=>$row[12],
            'telefono'=>$row[13],
            'nombre_contacto'=>$row[14],
            'email_contacto'=>$row[15],
            'nombre_contacto2'=>$row[16],
            'email_contacto2'=>$row[17],
            'metodo_pago'=>$row[22],  
            'digitos'=>$row[23],  
            'cuenta'=>$row[24], 
            'clabe'=>$row[25], 
            'banco'=>$row[26], 
            'cfdi'=>$row[27],
            'sucursal'=>$row[28], 
            'tipo_persona'=>trim($row[29]), 
            'extension'=>$row[31],
            'celular'=>$row[32],
            'cobertura'=>$cobertura,           
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

