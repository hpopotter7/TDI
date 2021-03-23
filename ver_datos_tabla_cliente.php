<?php 

$id=$_POST["id"];
include("conexion.php");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

/* Select queries return a resultset */
$result = $mysqli->query("SET NAMES 'utf8'");

$respuesta="";

$cliente="";
$razon_social="";
$rfc="";
$sql="SELECT Razon_Social, Nombre_comercial, rfc FROM clientes where Razon_Social='".$id."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $razon_social=$row[0];
        $rfc=$row[2];
        /* $respuesta=$respuesta.'<div class="col-md-12" style="border-radius: 16px;">
                  <div class="well profile col-md-12">
                      <div class="lg-12 col-md-12 text-center">
                          <h5><strong id="user-name">'.$row[0].'</strong></h5>
                          <p>'.$row[1].'</p>
                          <p>'.$row[2].'</p>
                          '; */
        $cliente=$row[0];
    }

    /* free result set */
    $result->close();
}
else{
    echo $sql.mysqli_error($mysqli);
   exit();
}
$todos=0;
$sql="select COUNT(id_evento) from eventos where Estatus!='CANCELADO'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $todos=$row[0];
    }
    $result->close();
}
$rank=0;
$sql="select COUNT(id_evento) from eventos where Cliente='".$cliente."' and estatus!='CANCELADO'";
if ($result = $mysqli->query($sql)) {
while ($row = $result->fetch_row()) {
    if($row[0]>0){
        $rank=$row[0]/$todos; //far empty
    }            
    $f1="far";
    $f2="far";
    $f3="far";
    $f4="far";
    $f5="far";
     if($row[0]>0 && $row[0]<25){
        $f1="fas";
    } 
    if($row[0]>25){
        $f1="fas";
        $f2="fas";
    }
    if($row[0]>50){
        $f1="fas";
        $f3="fas";
    }
    if($row[0]>100){
        $f1="fas";
        $f4="fas";
    }
    if($row[0]>150){
        $f1="fas";
        $f5="fas";
    }
			$respuesta=$respuesta.'<div class="card component-card_3" style="box-shadow: 5px 6px 10px 4px #2c3339 !important;">
            <div class="card-body">
                <!-- <img src="assets/img/90x90.jpg" class="card-img-top" alt="..."> -->
                <h5 class="card-user_name">'.$razon_social.'</h5>
                <p class="card-user_occupation">'.$rfc.'</p>
                 <div class="card-star_rating">
                    <i class="'.$f1.' fa-star" style="color:#f7eb09"></i> 
                    <i class="'.$f2.' fa-star" style="color:#f7eb09"></i>
                    <i class="'.$f3.' fa-star" style="color:#f7eb09"></i>
                    <i class="'.$f4.' fa-star" style="color:#f7eb09"></i>
                    <i class="'.$f4.' fa-star" style="color:#f7eb09"></i>
                </div>
                <!--
                <div class="progress br-30">
                  <div class="progress-bar bg-info" role="progressbar" style="width: 80%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">25</div>
              </div> --><h1 class="card-user_name" style="color:#fff"><strong>'.$row[0].'</strong><p style="color:#fff">Eventos</p> </h1>
            </div>
        </div>';
                          /*<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 divider text-center"></div>
                          <h4><p style="text-align: center;"><strong>'.$row[0].'</strong></p></h4>   
                          <label class="label label-success" style="font-size:1.1em">Eventos</label>
                      </div>
                  </div>
              </div>';*/
	}
}
else{
    echo $sql.mysqli_error($mysqli);
   exit();
}
echo $respuesta;

$mysqli->close();
?>