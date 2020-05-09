<?php 
include("conexion.php");
$usuario=$_POST['usuario'];
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'"); 
$sql="select email from usuarios where Nombre='".$usuario."' ";
$email="";
if ($result = $mysqli->query($sql)) {
  while ($row = $result->fetch_row()) {
    $email=$row[0];
  }
}
 

$sql="select id_notificaciones, Quien_hizo, DATE_FORMAT(Fecha_hora, '%d/%m/%Y %l:%i %p') Fecha, Asunto, Para_quien from notificaciones where visto='0' ";
$res="";
$para="";
if ($result = $mysqli->query($sql)) {
   $cont=0;
    while ($row = $result->fetch_assoc()) {
      $para=$row["Para_quien"];
      if(strpos($para, $email) !== false ){
        $res=$res.'<div class="row" style="background-color:white">
        <aside class="dropdown-item dropdown-notification">
           <div class="col-md-12" style="text-align: left;">
             <span id="'.$row["id_notificaciones"].'" class="btn btn-primary btn_notificacion" >'.$row["Asunto"].'</span><br>
             <span style="color:black">
               <i class="fa fa-user" aria-hidden="true"></i> Solicita: '.$row["Quien_hizo"].'
             </span>
             <br>
             <span style="color:black">
               <i class="fa fa-clock-o" aria-hidden="true"></i> Fecha: '.$row["Fecha"].'
             </span>
           </div>
         </aside>
           </div>
          <hr>';
        $res=$res.$row[1];
        $cont++;
      }
    }
    
    
    $result->close();
}
if($res==""){
  $res='<div class="row" style="background-color:white">
        <aside class="dropdown-item dropdown-notification">
           <div class="col-md-12" style="text-align: left;">
             <span style="color:black; font-size:.9em;"><i>Por el momento no hay ninguna notificación nueva.</i></span>
           </div>
         </aside>
           </div>';
}
/*
$res='<label id="" style="text-align: left; color:black; font-size:1.7em;">Bitácora de notificaciones</label>
<a id="btn_notificaciones" href="#" class="pull-right">
      <i class="fa fa-bell fa-2x" style="color:black"></i>      
<span class="label label-danger" style="font-size:95%; vertical-align:top;">'.$cont.'</span></a>
<a id="btn_cerrar_bitacora" href="#" class="pull-right">
      <i class="fa fa-close fa-2x" style="color:black"></i>      
</a>'.$res;
*/
echo $res;
$mysqli->close();
?>

  