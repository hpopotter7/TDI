<?php 
// PHP program to delete a file named gfg.txt 
// using unlike() function 
//$nombre=substr($_POST["nombre_archivo"], 1);
$nombre_archivo=$_POST["nombre_archivo"];
$archivo="comprobantes/".$nombre_archivo;

// Use unlink() function to delete a file 
if (!unlink($archivo)) { 
	echo ("Error: $archivo no se puede borrar"); 
} 
else { 
	echo ("$archivo ha sido borrado"); 
} 

?> 
