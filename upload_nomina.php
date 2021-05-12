<?php
$anio=$_POST['anio'];
$mes=$_POST['mes'];
//echo $mes;
//echo $anio;

 $ruta="nomina/".$anio."/".$mes."/";
/*
if(file_exists($ruta) === false ){
    if( is_dir($ruta) === false ){
        mkdir($ruta,0777,true);
    }
} */

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $ruta.$_FILES['file']['name'])) {
        echo 'si';
    } else {
        echo 'no';
    }
?>