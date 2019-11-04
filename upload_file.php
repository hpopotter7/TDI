<?php
$nombre=$_POST["nombre"];
$doc=$_POST["doc"];
$output_dir = "archivos/".$nombre."/";

if(!is_dir($output_dir)){
	mkdir($output_dir, 0777);
	chmod($output_dir, 0777);
}
    if ( 0 < $_FILES['file']['error'] ) {
        echo 'Error: ' . $_FILES['file']['error'] . '<br>';
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], $output_dir . $doc."-".$_FILES['file']['name']);
        echo $nombre;
    }

?>