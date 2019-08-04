<?php 
$carpeta    = $_POST["carpeta"];
$directorio = 'archivos/'.$carpeta."/";
if (!file_exists($directorio)) {
	echo "no";
}
else{
	$gestor_dir = opendir($directorio);
while (false !== ($nombre_fichero = readdir($gestor_dir))) {
    $ficheros[] = $nombre_fichero;
}
sort($ficheros);
 
//print_r($files);
$separado_por_comas = implode("#", $ficheros);
echo $separado_por_comas;
}
 ?>
