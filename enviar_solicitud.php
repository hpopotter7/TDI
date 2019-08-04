<?php 
    $numero_cliente=$_POST['txt_nombre_cliente'];
    $metodo_pago=$_POST['c_metodo_pago'];
    $rfc=$_POST['txt_rfc'];
    $digitos=$_POST['digitos'];
    $calle=$_POST['txt_calle'];
    $num_ex=$_POST['txt_num_ext'];
    $num_int=$_POST['txt_num_int'];
    $colonia=$_POST['txt_colonia'];
    $cp=$_POST['txt_cp'];
    $telefono=$_POST['txt_telefono'];
    $estado=$_POST['c_estado'];
    $municipio=$_POST['txt_municipio'];
   

    //$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
    include("conexion.php");
    //$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

    
    if (mysqli_connect_error()) {
        echo "Error de conexion: %s\n", mysqli_connect_error();
        exit();
    }

        $sql="INSERT INTO eventos (Numero_evento, Nombre_evento, Inicio_evento, Fin_evento, Cliente, Destino, Sede, Diseño, Produccion, Facturacion, Solicita, Tipo, Comentarios, Fecha_registro, Usuario_Regsitra) VALUES ('".$numero_evento."', '".$nombre_evento."', '".$inicio_evento."', '".$fin_evento."', '".$cliente."', '".$destino."', '".$sede."', '".$disenio."', '".$produccion."', '".$facturacion."', '".$solicita."', '".$tipo."', '".$comentarios."', NOW(), '".$usuario_registra."')";
        if ($mysqli->query($sql)) {
            
            
            echo "registro correcto";
            
        }
        else{
            echo $sql.mysqli_error($mysqli);
        }
        
    


    $mysqli->close();
?>