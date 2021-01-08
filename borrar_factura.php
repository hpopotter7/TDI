<?php
$archivo=$_POST["archivo"];

$borrado = unlink($archivo);

    echo 'borrado';


?>