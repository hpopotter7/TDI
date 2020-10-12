<?php 


function endsWith($haystack, $needle)
{
    $length = strlen($needle);
    if ($length == 0) {
        return true;
    }

    return (substr($haystack, -$length) === $needle);
}

$bandera=$_POST["bandera_sodexo"];
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");

if($bandera=="MA. FERNANDA CARRERA HDZ"){ //ES DECIR SI ES CHEQUE
    $sql="SELECT id_usuarios, Nombre FROM usuarios where estatus='activo' and email not like '%DILIGO%' order by Nombre asc";
    if ($result = $mysqli->query($sql)) {
        echo '<option value="vacio">Selecciona un usuario...</option>';
        while ($row = $result->fetch_row()) {
            if($row[1]!="ALAN SANDOVAL"){
                $id=$row[0];
                $nombre=$row[1];
                echo "<option value='".$id."'>".$nombre."</option>";
            }   
        }
        $result->close();
    }
    else{
        echo $mysqli->error.":".$sql;
    }
}
else if($bandera=="TARJETA SODEXO"){  // SI ES TARJETA SODEXO
    $sql="SELECT t.id_tarjeta, t.No_tarjeta, u.Nombre, t.Usuario FROM tarjetas t left join usuarios u on u.id_usuarios=t.Usuario where t.Tipo='SODEXO'and u.estatus='activo' order by t.No_tarjeta asc";
    if ($result = $mysqli->query($sql)) {
        echo '<option value="vacio">Selecciona una tarjeta...</option>';
        while ($row = $result->fetch_row()) {
                $id=$row[0];
                $numero=$row[1];
                $nombre_usuario=$row[2];
                if($nombre_usuario==null){
                    echo "<option value='".$id."' disabled class='disabled' style='background-color:LightGrey;color:red'>".$numero." - [sin asignar]</option>";
                }
                else{
                    echo "<option value='".$numero."'>".$numero." - [".$nombre_usuario."]</option>";
                }
        }
        $result->close();
    }
    else{
        echo $mysqli->error.":".$sql;
    }
}
else if($bandera=="TARJETA DILIGO"){  // SI ES TARJETA DILIGO
    $sql="SELECT t.id_tarjeta, t.No_tarjeta, u.Nombre, t.Usuario FROM tarjetas t left join usuarios u on u.id_usuarios=t.Usuario where t.Tipo='DILIGO' and estatus='activo'";
    if ($result = $mysqli->query($sql)) {
        echo '<option value="vacio">Selecciona una tarjeta...</option>';
        while ($row = $result->fetch_row()) {
                $id=$row[0];
                $numero=$row[1];
                $nombre_usuario=$row[2];
                if($nombre_usuario==null){
                    echo "<option value='".$numero."' disabled class='disabled' style='background-color:LightGrey;color:red'>".$numero." - [sin asignar]</option>";
                }
                else{
                    echo "<option value='".$numero."'>".$numero." - [".$nombre_usuario."]</option>";
                }
        }
        $result->close();
    }
    else{
        echo $mysqli->error.":".$sql;
    }
}

$mysqli->close();
?>