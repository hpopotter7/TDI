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
        if($numero_factura!=""){
            /* $directorio = 'facturas/'.$evento_anterior;
            $lista = scandir($directorio);
            foreach($lista as $archivos){
                if(!is_dir($directorio."/".$file)){
                echo "<li><a class='btn btn-success' target='_blank' href='".$directorio."/".$file."'>".$file."</a></li>";
                $bandera_files=true;
                }
            } */

            $ruta = 'facturas/'.$evento_anterior;
            $lista = scandir($ruta);
            foreach($lista as $archivos){
                if(!is_dir($ruta."/".$archivos)){
                    $arr=explode(".",$archivos);
                    $empieza=$arr[0];
                    if($empieza==$numero_factura){
                        $archivo_old="facturas/".$evento_anterior."/".$archivos;
                        $archivo_new="facturas/".$evento."/".$archivos;
                        if(!is_dir("facturas/".$evento."/")){
                            mkdir("facturas/".$evento."/", 0777);
                            chmod("facturas/".$evento."/", 0777);
                        }                       
                            //echo "archivo anterior: ".$archivo_old;
                            //echo "archivo nuevo: ".$archivo_new;
                            if(rename($archivo_old, $archivo_new)){
                                $res="transferida, archivo";
                            }
                            else{
                                $res=$archivo_old." se mueve hacia ".$archivo_new;
                            }
                           // move_uploaded_file
                            //$res= "transferida, archivo";                        
                    }
                }
            }
        }
        
    }
			
	echo $res;
	$mysqli->close();
?>
