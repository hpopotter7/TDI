<?php
$id=$_POST["id"];
$evento=$_POST["evento"];
$doc=$_POST["doc"];
$output_dir = "comprobantes/".$evento."/";

if(!is_dir($output_dir)){
	mkdir($output_dir, 0777);
	chmod($output_dir, 0777);
}
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], $output_dir . $id."-".$_FILES['file']['name']);
        echo "Archivo ".$_FILES['file']['name']." cargado correctamente";
    }

?>