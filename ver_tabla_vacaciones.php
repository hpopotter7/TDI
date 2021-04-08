<?php
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$respuesta="";
$sql="SELECT id_vacaciones, Estatus, Jefe_Directo, DATE_FORMAT(Fecha_Inicio, '%d/%m/%Y') as Fecha_Inicio, DATE_FORMAT(Fecha_Fin, '%d/%m/%Y') as Fecha_Fin, Dias, DATE_FORMAT(Fecha_regreso, '%d/%m/%Y') as Fecha_regreso FROM vacaciones where id_usuario='".$_COOKIE['id']."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $estatus=$row['Estatus'];
        if($estatus=="P"){
            $ESTATUS='<span class="shadow-none badge outline-badge-danger">Pendiente</span>';
            $OPCIONES='<i id="'.$row['id_vacaciones'].'" class="btn_editar far fa-edit fa-2x text-primary"></i> <i id="'.$row['id_vacaciones'].'" class="far fa-trash-alt fa-2x text-danger btn_borrar"></i> <a href="solicitud_vacaciones.php?id='.$row['id_vacaciones'].'" target="_blank"><i class="far fa-file-pdf fa-2x btn_descargar text-secondary"></i></a>';
        }
        else{
            $ESTATUS='<span class="shadow-none badge outline-badge-success">Autorizado</span>';
            $OPCIONES='<a href="solicitud_vacaciones.php?id='.$row['id_vacaciones'].'" target="_blank"><i class="far fa-file-pdf fa-2x btn_descargar text-secondary"></i></a>';
        }
        $respuesta=$respuesta."<tr><td>Del: ".$row['Fecha_Inicio']." Al: ".$row['Fecha_Fin']."</td><td>".$row['Jefe_Directo']."</td><td>".$row['Dias']."</td><td>".$ESTATUS."</td><td>".$OPCIONES."</td></tr>";
    }
    $result->close();
}
echo $respuesta;
$mysqli->close();
?>   