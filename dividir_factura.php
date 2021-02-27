<?php 
    $arreglo=$_POST['arreglo'];
    $id_sol_factura=$_POST['id_sol_factura'];

	include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }

    mysqli_autocommit($mysqli, FALSE);    
	$result = $mysqli->query("SET NAMES 'utf8'");
    /*
    $sql="SELECT Total FROM Suma_Tabla_Partidas_x_id_sol where id_sol_factura=".$id;
    if ($result = $mysqli->query($sql)) {
        $total=0;
        while ($row = $result->fetch_row()) {
            $total=$row[0];
        }
        $result->close();
    }
    else{
        $res= "Error: ".mysqli_error($mysqli);
    }

    if($total<$valor){
        echo "El nuevo importe no puede ser mayor al monto total actual ".$total;
        exit();
    }

    $sql="select id_partida, total from partidas where id_sol_factura=".$id." limit 0,1";
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $id_partida= $row[0];
            $total=$row[1];
        }
    }
    else{
        $res= "Error: ".mysqli_error($mysqli);
    }
    */
    
    //Se obtienen los valores de la solcitud a copiar
    $sql="select id_evento, Dias_credito, Num_pedido, Num_orden, Num_entrada, GR, Correo1, correo2, correo3, correo4, correo5, Observaciones, empresa_factura from solicitud_factura where id_solicitud=".$id_sol_factura;
            if ($result = $mysqli->query($sql)) {
                while ( $row = $result->fetch_row())  {
                    $ID_EVENTO=$row[0];
                    $DIAS=$row[1];
                    $NUM_PEDIDO=$row[2];
                    $NUM_ORDEN=$row[3];
                    $NUM_ENTRADA=$row[4];
                    $GR=$row[5];
                    $CORREO1=$row[6];
                    $CORREO2=$row[7];
                    $CORREO3=$row[8];
                    $CORREO4=$row[9];
                    $CORREO5=$row[10];
                    $OBSERVACIONES=$row[11];
                    $EMPRESA=$row[12];
                  }
            }
            //Se inserta una solicitud nueva con los datos anteriores
            $sql_insert_sol="insert into solicitud_factura(id_evento, Dias_credito, Num_pedido, Num_orden, Num_entrada, GR, Correo1, correo2, correo3, correo4, correo5, Fecha_hora_registro, Usuario_registra, Observaciones, empresa_factura) 
            values('".$ID_EVENTO."', '".$DIAS."', '".$NUM_PEDIDO."', '".$NUM_ORDEN."', '".$NUM_ENTRADA."', '".$GR."', '".$CORREO1."', '".$CORREO2."', '".$CORREO3."', '".$CORREO4."', '".$CORREO5."', NOW(), '".$_COOKIE['user']."', 'Dividida de ".$id."', '".$EMPRESA."')";
            if (mysqli_query($mysqli, $sql_insert_sol)) {
                $res="exito";
            }
            else{
                $res= mysqli_error($mysqli);
            }
            
            //Se obtiene el id de solicitud para actualizar la partida
            $sql="select max(id_solicitud) from solicitud_factura";
                if ($result = $mysqli->query($sql)) {
                    while ($row = $result->fetch_row()) {
                        $ultimo_id= $row[0];
                    }
                }
                else{
                    $res= "Error: ".mysqli_error($mysqli);
                }
            //se actualiza la(s) partida(s) del arreglo del front
            foreach ($arreglo as $id) {
                $sql_update="update partidas set id_sol_factura='".$ultimo_id."' where id_partida=".$id;
                if (mysqli_query($mysqli, $sql_update)) {
                    $res="exito";
                }
                else{
                    $res= mysqli_error($mysqli);
                }
            }
    //==
/*
    if($id_partida>0){
        $nuevo_sub=$total-$valor;

        
        $subtotal=($nuevo_sub/1.16);
        $iva=$subtotal*.16;
        $total=$subtotal+$iva;


        $sql_update="update partidas set pu='".$subtotal."', iva='".$iva."', total='".$total."' where id_partida=".$id_partida;
        if (mysqli_query($mysqli, $sql_update)) {
            $res="exito";
        }
        else{
            $res= mysqli_error($mysqli);
            mysqli_rollback($mysqli);
        }

        if($res=="exito"){
            $sql="select id_evento, Dias_credito, Num_pedido, Num_orden, Num_entrada, GR, Correo1, correo2, correo3, correo4, correo5, Observaciones, empresa_factura from solicitud_factura where id_solicitud=".$id;
            if ($result = $mysqli->query($sql)) {
                while ( $row = $result->fetch_row())  {
                    $ID_EVENTO=$row[0];
                    $DIAS=$row[1];
                    $NUM_PEDIDO=$row[2];
                    $NUM_ORDEN=$row[3];
                    $NUM_ENTRADA=$row[4];
                    $GR=$row[5];
                    $CORREO1=$row[6];
                    $CORREO2=$row[7];
                    $CORREO3=$row[8];
                    $CORREO4=$row[9];
                    $CORREO5=$row[10];
                    $OBSERVACIONES=$row[11];
                    $EMPRESA=$row[12];
                  }
            }
            $sql_insert_sol="insert into solicitud_factura(id_evento, Dias_credito, Num_pedido, Num_orden, Num_entrada, GR, Correo1, correo2, correo3, correo4, correo5, Fecha_hora_registro, Usuario_registra, Observaciones, empresa_factura) 
            values('".$ID_EVENTO."', '".$DIAS."', '".$NUM_PEDIDO."', '".$NUM_ORDEN."', '".$NUM_ENTRADA."', '".$GR."', '".$CORREO1."', '".$CORREO2."', '".$CORREO3."', '".$CORREO4."', '".$CORREO5."', NOW(), '".$_COOKIE['user']."', 'Dividida de ".$id."', '".$EMPRESA."')";
            if (mysqli_query($mysqli, $sql_insert_sol)) {
                $res="exito";
            }
            else{
                $res= mysqli_error($mysqli);
                mysqli_rollback($mysqli);
            }
            if($res=="exito"){
                $sql="select max(id_solicitud) from solicitud_factura";
                if ($result = $mysqli->query($sql)) {
                    while ($row = $result->fetch_row()) {
                        $ultimo_id= $row[0];
                    }
                }
                else{
                    $res= "Error: ".mysqli_error($mysqli);
                }
                $iva=$valor*1.16;
                $total=$valor+$iva;
                $sql_insert_partida="insert into partidas(descripcion, pu, iva, total, id_sol_factura) values('".$concepto."', '".$valor."', '".$iva."', '".$total."', '".$ultimo_id."')";
                if (mysqli_query($mysqli, $sql_insert_partida)) {
                    $res="exito";
                }
                else{
                    $res= mysqli_error($mysqli);
                    mysqli_rollback($mysqli);
                }
            }
            
        }
    }
    */
/*
    mysqli_autocommit($mysqli, FALSE);
    mysqli_query($mysqli, $sql_update);
    mysqli_query($mysqli, $sql_insert_sol);
    mysqli_query($mysqli, $sql_insert_partida);
    
    **/
    if($res=="exito"){
        mysqli_commit($mysqli);
    }
    else{
        mysqli_rollback($mysqli);
    }
    


    echo $res;

	$mysqli->close();
?>