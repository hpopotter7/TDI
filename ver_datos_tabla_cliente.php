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
$sql="SELECT Razon_Social, Nombre_comercial, rfc FROM clientes where id_cliente=".$id;
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $respuesta=$respuesta.'<div class="col-md-12" style="border-radius: 16px;">
                  <div class="well profile col-md-12">
                      <div class="lg-12 col-md-12 text-center">
                          <h5><strong id="user-name">'.$row[0].'</strong></h5>
                          <p>'.$row[1].'</p>
                          <p>'.$row[2].'</p>
                          ';
        $cliente=$id."&".$row[0];
    }

    /* free result set */
    $result->close();
}
else{
    echo $sql.mysqli_error($mysqli);
   exit();
}
$sql="select COUNT(id_evento) from eventos where Cliente='".$cliente."'";
if ($result = $mysqli->query($sql)) {
while ($row = $result->fetch_row()) {
			$respuesta=$respuesta.'
                          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 divider text-center"></div>
                          <h4><p style="text-align: center;"><strong>'.$row[0].'</strong></p></h4>   
                          <label class="label label-success" style="font-size:1.1em">Eventos</label>
                      </div>
                  </div>
              </div>';
	}
}
else{
    echo $sql.mysqli_error($mysqli);
   exit();
}
echo $respuesta;

$mysqli->close();
?>