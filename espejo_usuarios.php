<?php 
$usuario_origen=$_POST['usuario_origen'];
$usuario_destino=$_POST['usuario_destino'];
include("conexion.php");
if (mysqli_connect_error()) {
    echo "Error de conexion: %s\n", mysqli_connect_error();
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$respuesta="";
// fecha de vobos 2020-03-14
$sql="update eventos set solicita=REPLACE(solicita, '".$usuario_origen."', '".$usuario_destino."') where Estatus='ABIERTO' ";
    if (!$mysqli->query($sql)) {
        $respuesta= "Error al actualizar los solicitantes: ".mysqli_error($mysqli);
        echo $respuesta;
        exit();
    }
    else{
        $respuesta="updates listos";
    }

    

    if($respuesta==="updates listos"){
        $bandera="no";
        $sql="select Ejecutivo from usuarios where Nombre='".$usuario_origen."'";
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_row()) {
                if($row[0]=="X"){
                    $bandera="ejecutivo";
                }
            }   
            $result->close();
        }
        else{
           $respuesta="Error al buscar el ejecutivo".mysqli_error($mysqli);
           echo $respuesta;
           exit();
        }
        
        if($bandera==="ejecutivo"){

            //==primero se guardan todos los eventos en la bitacora==
            //Se seleccionan los eventos del ejecutivo origen
            $array_eventos=array();
            $sql="select Numero_evento from eventos where Estatus='ABIERTO' and Ejecutivo=',".$usuario_origen."'";
            if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_row()) {
                        array_push($array_eventos,$row[0]);
                }   
                $result->close();
            }
            $eventos="";
            foreach($array_eventos as $valor){
                $eventos=$eventos.$valor."/";
            }
            echo "Eventos: ".$eventos;
            foreach($array_eventos as $valor){
                $sql="insert into bitacora(Usuario, tabla_actualizar, valor_anterior, valor_nuevo, fecha_hora_registro) values('".$_COOKIE['user']."', 'Espejo Ejecutivos', 'Ejecutivo nuevo:".$usuario_destino.";Ejecutivo anterior: ".$usuario_origen."', 'Evento: ".$valor."', NOW())";
                if ($mysqli->query($sql)) {
                    $res= "exito";
                }
                else{
                    $res= mysqli_error($mysqli);
                }
            }


            $sql="update eventos set Ejecutivo=',".$usuario_destino."' where Estatus='ABIERTO' and Ejecutivo=',".$usuario_origen."'";
            if (!$mysqli->query($sql)) {
                $respuesta= "Error al actualizar los eventos: ".mysqli_error($mysqli);
                echo $respuesta;
                exit();
            }
            else{
                $respuesta="updates listos";
            }
           
            $sql="update usuarios set Ejecutivo='X' where Nombre='".$usuario_destino."'";
            if (!$mysqli->query($sql)) {
                $respuesta= "Error al actualizar el check: ".mysqli_error($mysqli);
                echo $respuesta;
                exit();
            }
            else{
                $respuesta="updates listos";
            }

        }   
    }

    if($respuesta=="updates listos"){
        $sql="update odc set solicito='".$usuario_destino."' where vobo_solicito=0 and Fecha_hora_registro>='2020-03-14' and solicito='".$usuario_origen."';";
        $sql.="update odc set project='".$usuario_destino."' where vobo_project=0 and Fecha_hora_registro>='2020-03-14' and project='".$usuario_origen."';";
        $sql.="update odc set coordinador='".$usuario_destino."' where vobo_coordinador=0 and Fecha_hora_registro>='2020-03-14' and coordinador='".$usuario_origen."';";
        $sql.="update odc set compras='".$usuario_destino."' where vobo_compras=0 and Fecha_hora_registro>='2020-03-14' and compras='".$usuario_origen."';";
        $sql.="update odc set autorizo='".$usuario_destino."' where vobo_direccion=0 and Fecha_hora_registro>='2020-03-14' and autorizo='".$usuario_origen."';";
        $sql.="update odc set finanzas='".$usuario_destino."' where vobo_finanzas=0 and Fecha_hora_registro>='2020-03-14' and finanzas='".$usuario_origen."';";

        if (!$mysqli->multi_query($sql)) {
            $respuesta= "Error en la multiconsulta: (" . $mysqli->errno . ") " . $mysqli->error;
            echo $respuesta;
            exit();
        }
        else{
            $respuesta="updates listos";
        }   
    }


echo $respuesta;

$mysqli->close();
?>