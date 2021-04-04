<?php
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="select * from notificaciones where para_quien=(select email from usuarios where Nombre='".$_COOKIE['user']."' )";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_assoc()) {
        $Asunto=$row['Asunto'];
        $fecha=$row['Fecha_hora'];
        $mensaje=$row['Notificacion'];
        $de=$row['Quien_hizo'];
        $visto=$row['Visto'];
        $atendido="";
        $tipo="";
        if($visto=="0"){
            $tipo="todo-task-done";
            $atendido="checked";
        }
        $mensaje= htmlspecialchars($mensaje, ENT_QUOTES);        
        echo '<div class="todo-item all-list '.$tipo.'">';
        echo ' <div class="todo-item-inner"><div class="n-chk text-center">
        <label class="new-control new-checkbox checkbox-primary">
            <input type="checkbox" class="new-control-input inbox-chkbox" '.$atendido.'>
            <span class="new-control-indicator"></span>
        </label>
    </div>
    <div class="todo-content" style="max-width: calc(100vw - 525px) !important;">
    <h5 class="todo-heading" data-todoHeading="'.$Asunto.'"> '.$Asunto.'</h5>
    <p class="meta-date">'.$fecha.'</p>'.$mensaje.'
    
        </div>
        </div>
    </div>';
    }
    $result->close();
}
else{
    echo mysqli_error($mysqli);
    }    
$mysqli->close();
?>