<?php
$id_clientes="";
$id_proveedor="";
$tipo=$_GET['tipo'];
$ds          = DIRECTORY_SEPARATOR;  //1

if(isset($_GET['id_cliente'])){
$id=$_GET['id_cliente'];
$folder="clientes";
}
else{
    $id=$_GET['id_proveedor'];
    $folder="proveedores";
}
 
$storeFolder = $folder.'/'.$id;   //2
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
    $nombre=explode(".",$_FILES['file']['name']);
    $tamaño=count($nombre);
    $ext=$nombre[$tamaño-1];
    $targetFile =  $targetPath.$tipo.".".$ext;//. $_FILES['file']['name'];  //5
 
    move_uploaded_file($tempFile,$targetFile); //6

    echo $_FILES['file']['name'];
     
}
?> 