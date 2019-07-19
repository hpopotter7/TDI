<?php 


function moneda($value) {
  return '$' . number_format($value, 2);
}
//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* check connection */
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

/* Select queries return a resultset */

if ($result = $mysqli->query("SELECT o.evento, o.a_nombre, o.cheque_por, o.id_odc, e.Nombre_evento FROM odc o, eventos e where o.evento= e.id_evento and o.Factura='0' order by o.Evento asc")) {
    
    /* fetch object array 
    $resultado='<thead class="thead-inverse">
                    <tr>
                      <th >Evento</th>
                      <th >Proveedor</th>
                      <th >Total</th>
                      
                    </tr>
                  </thead>';*/
                  $resultado='<div class="col-md-3 col-sm-3 treinta"><h3>EVENTO</h3></div><div class="col-md-3 col-sm-3 treinta"><h3>PROVEEDOR</h3></div><div class="col-md-4 col-sm-4 treinta"><h3 class="">TOTAL</h3></div>';
    while ($row = $result->fetch_row()) {
      $resultado=$resultado."<div class='row'>";
        //$resultado=$row[1]."#".$row[4];
        $resultado=$resultado."<div class='col-md-4 col-sm-4'><label id='".$row[3]."' class='btn btn_verde btn_success'>".$row[4]."</label></div>"."<div class='col-md-5 col-sm-5'>".$row[1]."</div>"."<div class='center col-md-3 col-sm-3'>".moneda($row[2])."</div>";
        $resultado=$resultado."</div><hr>";
    }
    /* free result set */
    $result->close();
}
echo $resultado;


$mysqli->close();
?>