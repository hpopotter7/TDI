<?php
$nombre=$_POST["nombre"];
$nombre=trim($nombre);
$doc=$_POST["doc"];
$output_dir = "archivos/".$nombre."/";

if(!is_dir($output_dir)){
	mkdir($output_dir, 0777);
	chmod($output_dir, 0777);
}
if(isset($_FILES["myfile"]))
{
	$ret = array();
	
//	This is for custom errors;	
/*	$custom_error= array();
	$custom_error['jquery-upload-file-error']="File already exists";
	echo json_encode($custom_error);
	die();
*/
	$error =$_FILES["myfile"]["error"];
	//You need to handle  both cases
	//If Any browser does not support serializing of multiple files using FormData() 
	if(!is_array($_FILES["myfile"]["name"])) //single file
	{
 	 	$fileName = $_FILES["myfile"]["name"];
 	 	$file=$output_dir.$fileName;
 	 	if(file_exists($file)) {
		    chmod($file,0755); //Change the file permissions if allowed
		    unlink($file); //remove the file
		}
 		move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$doc.$fileName);
    	$ret[]= $fileName;
	}
	else  //Multiple files, file[]
	{
	  $fileCount = count($_FILES["myfile"]["name"]);
	  for($i=0; $i < $fileCount; $i++)
	  {
	  	$fileName = $_FILES["myfile"]["name"][$i];
		move_uploaded_file($_FILES["myfile"]["tmp_name"][$i],$output_dir.$fileName);
	  	$ret[]= $fileName;
	  }
	
	}
    echo json_encode($ret);
 }
 ?>