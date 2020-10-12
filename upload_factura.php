<?php
$evento=$_POST["evento"];
$nombre=$_POST["nombre"];
$output_dir = "facturas/".$evento."/";

if(!is_dir($output_dir)){
    $oldmask = umask(0);
    mkdir($output_dir, 0777,true);
    umask($oldmask);
    chmod($output_dir, 0777, true);
    
}
if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
    move_uploaded_file($_FILES['file']['tmp_name'], $output_dir.$nombre."-".$_FILES['file']['name']);
    echo 'La factura se ha subido correctamente';
}

?>