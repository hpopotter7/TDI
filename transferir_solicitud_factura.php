<?php
    

	$ID=$_POST['ID'];
	$evento=$_POST['evento'];
	include("conexion.php");
	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}
    $result = $mysqli->query("SET NAMES 'utf8'");
    $sql="SELECT id_evento from solicitud_factura where id_solicitud=".$ID;
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $evento_anterior=$row[0];
        }
        $result->close();
    }
    else{
        $res= mysqli_error($mysqli)."<p>".$sql;
    }

    
    $sql="update solicitud_factura set id_evento='".$evento."' where id_solicitud=".$ID;
    if ($mysqli->query($sql)) {
        $res= "transferida";
    }
    else{
        $res= mysqli_error($mysqli)."<p>".$sql;
    }

    if($res=="transferida"){
        //se debe mover el archivo en caso de que haya factura a otra carpeta
        $numero_factura="";
        $sql="SELECT No_factura from solicitud_factura where id_solicitud=".$ID;
            if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_row()) {
                    $numero_factura=$row[0];
                }
                $result->close();
            }
            else{
                $res= mysqli_error($mysqli)."<p>".$sql;
            }
            /*
            echo "num factura: ".$numero_factura;
            echo "evento anterior: ".$evento_anterior;
            exit();
            */
        if($numero_factura!=""){
            $lista = scandir("facturas/".$evento_anterior."/");
            $lista_carpetas = array_diff($lista, array('.','..'));
            foreach($lista_carpetas as $archivos){
                    $arr=explode("-",$archivos);
                    $empieza=$arr[0];
                    if($empieza==$numero_factura){
                        $archivo_old="facturas/".$evento_anterior."/".$archivos;
                        $archivo_new="facturas/".$evento."/".$archivos;
                        
                        if(!is_dir("facturas/".$evento."/")){
                            mkdir("facturas/".$evento."/", 0777);
                            chmod("facturas/".$evento."/", 0777);
                        }
                        
                        
                        if(file_exists($archivo_old)){
                            echo "archivo anterior: ".$archivo_old;
                            echo "archivo nuevo: ".$archivo_new;
                            rename($archivo_old, $archivo_new);                                                       
                           // move_uploaded_file
                            $res= "transferida, archivo";
                        }
                        
                    }
            }
        }
        
    }
			
	echo $res;
	$mysqli->close();
?>
