<?php
	$motivo=$_POST['motivo'];
	$id=$_POST['id'];
	include("conexion.php");
	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}
	function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 

	$result = $mysqli->query("SET NAMES 'utf8'");

			$sql="update solicitud_factura set Estatus='Cancelada', No_Factura=NULL, Motivo_cancelacion='".$motivo."' where id_solicitud=".$id;
			if ($mysqli->query($sql)) {
			    $res= "cancelada";
			}
			else{
				$res= mysqli_error($mysqli)."<p>".$sql;
			}

			if($res=="cancelada"){
					$respuesta="";
					$sql="SELECT id_evento, No_factura from solicitud_factura where id_solicitud='".$id."'";
					$result = $mysqli->query($sql);
					if ($result = $mysqli->query($sql)) {
						while ($row = $result->fetch_row()) {
							$id_evento=$row[0];
							$no_factura=$row[1];
						}
						$result->close();
					}
					$directorio = 'facturas/'.$id_evento;
					$ficheros1  = scandir($directorio);
					$name_file="";
					foreach($directorio as $nombre){
						if(startsWith($nombre, $no_factura)){
							$name_file=$nombre;
						}
					}
				$archivo="facturas/".$id_evento."/".$name_file;

				// Use unlink() function to delete a file 
				if (!unlink($archivo)) { 
					echo ("Error: $archivo no se puede borrar"); 
				} 
				else { 
					echo ("$archivo ha sido borrado"); 
				} 
			}
			
	echo $res;
	$mysqli->close();
?>
