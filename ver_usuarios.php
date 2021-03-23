<?php 
$tipo=$_POST['tipo'];
$id_usuario=$_POST['id_usuario'];
include("conexion.php");
$where="";
if($tipo=="" || $tipo==null){
    $where="";
}
else{
    $where="where Estatus='".$tipo."'";
}
/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");

if($id_usuario!="" || $id_usuario!=null){
    if ($result = $mysqli->query("SELECT Jefe_Directo FROM usuarios where id_usuarios=".$id_usuario)) {        
        while ($row = $result->fetch_row()) {
                $jefes=$row[0];
        }
        $result->close();
    }
}

$pos = strpos($jefes, ",");
if($pos === false){
    $jefes=$jefes.",";
}
$arr=explode(",",$jefes);

    if ($result = $mysqli->query("SELECT * FROM usuarios ".$where." order by Nombre asc")) {
        echo "<option value='vacio'>Selecciona un usuario...</option>";
        while ($row = $result->fetch_row()) {
            if($row[1]!="ALAN SANDOVAL"){
                $color='style="color: black;"';
                if($row[12]!="activo"){
                    $color=' disabled style="color: orange;"';
                }
                $seleccion="";
                foreach ($arr as $value) {
                   if($value==$row[1]){
                    $seleccion="selected";
                    break;
                   }
                }
                echo "<option value='".$row[1]."' ".$color."' ".$seleccion.">".$row[1]."</option>";
            }
        }
        $result->close();
    }
    else{
        echo "Error";
    }


$mysqli->close();
?>