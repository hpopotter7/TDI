<?php
$suma_facturado="no hay nada";
$COUNT=0;
$estatus0="";
$estatus1="";
$estatus2="";
$estatus3="";
$estatus4="";

$concatenados="";
$ruta = "facturas/".$evento;
$myfiles = scandir($ruta);
$array= Array();
$array_nombres= Array();
foreach($myfiles as $file){
  array_push($array_nombres,$file);
  $nombre=explode("-",$file);
  array_push($array,$nombre[0]);
  $concatenados=$concatenados.".".$nombre[0];
}

$sql2="SELECT p.id_sol_factura, ROUND(sum(p.total),2), s.Estatus, s.No_factura, s.Estatus_Factura, ANY_VALUE(p.descripcion) from partidas p, solicitud_factura s where s.id_evento=".$evento." and p.id_sol_factura=s.id_solicitud and s.Estatus='Activa' group by p.id_sol_factura order by s.No_Factura asc";
if ($result = $mysqli->query($sql2)) {
  while ($row = $result->fetch_row()) {
    $estatus0="";
$estatus1="";
$estatus2="";
$estatus3="";
$estatus4="";
$descripcion=$row[5];
    $no_factura=$row[3];
    $estatus_factura=$row[4];
    if($no_factura==null || $no_factura==""){
      $no_factura="0";
    }

    if($estatus_factura==null || $estatus_factura==""){
      $estatus0="selected='selected'";
    }
    else{
      switch($estatus_factura){
        case "PAGADO":
          $estatus1="selected='selected'";
        break;
        /*case "COBRADO":
          $estatus2="selected='selected'";
        break;
        */
        case "NOTA CREDITO":
          $estatus3="selected='selected'";
        break;
        case "POR COBRAR":
          $estatus4="selected='selected'";
        break;
      }
    }
    $COUNT++;
      $tbody=$tbody."<tr>
                <td class='text-center'>".$COUNT."</td>
                <td class='text-center td_btn_numero_factura'>";
                if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                  $tbody=$tbody."<label id=".$row[0]." class='btn btn_verde btn_success btn_numero_factura'>".$no_factura."</label>";
                }
                else{
                  $tbody=$tbody."<label class='btn btn_verde btn_success disabled'>".$no_factura."</label>";
                }
      $tbody=$tbody."
                </td>
                <td class='text-center'>";
                if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                  $tbody=$tbody."<select id='c_".$row[0]."' class='form-control c_estatus_factura'>";
                }
                else{
                  $tbody=$tbody."<select class='form-control disabled' disabled>";
                }
        $tbody=$tbody."
                <option value='vacio' ".$estatus0.">---Selecciona---</option>
                <option value='PAGADO' ".$estatus1.">PAGADO</option>
                
                <option value='NOTA CREDITO' ".$estatus3.">NOTA CREDITO</option>
                <option value='POR COBRAR' ".$estatus4.">POR COBRAR</option>
                </select></td>
                <td class='text-center'><h4><span class='label label-primary'>".moneda($row[1])."</span></h4></td>
              ";
              if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                if($descripcion=="Carga inicial"){
                  $tbody=$tbody."<td><label class='btn btn-info'><i class='fa fa-ban' aria-hidden='true'></i></label>";

                }
                else{
                  $tbody=$tbody."<td><a href='solicitud_factura.php?id=".$row[0]."' target='_blank'><label class='btn btn-info btn_descargar_facturas'><i class='fa fa-download' aria-hidden='true'></i></label></a>";
                }

                $boton_factura="<button type='file' id='".$evento."#".$no_factura."' class='btn btn-success btn_subir_factura' style='margin-left:.3em;margin-right:.3em' ><i class='fa fa-cloud-upload ' aria-hidden='true'></i></button>";

                for($r=0;$r<=count($array)-1;$r++){
                      if($array[$r]==$no_factura){
                        $boton_factura="<a href='".$ruta."/".$array_nombres[$r]."' target='_blank'><button id='".$evento."#".$array[$r]."' class='btn btn-success' style='margin-left:.3em;margin-right:.3em' ><i class='fas fa-file-pdf ' aria-hidden='true'></i></button></a>";
                      }
                      
                }
                $tbody=$tbody.$boton_factura."<a href='#' id='".$row[0]."' class='btn btn-danger btn_eliminar_factura' ><i class='fa fa-trash' aria-hidden='true'></i></a><button id='".$row[0]."' class='btn btn-warning btn_transferir_factura' style='margin-left:.3em;margin-right:.3em'><i class='fa fa-exchange' aria-hidden='true'></i></button></td>";
                 
              }
              else{
                $boton_factura="<button type='button' class='btn btn-success' style='margin-left:.3em;margin-right:.3em' ><i class='fa fa-ban fa-2x' aria-hidden='true'></i></button>";
                  for($r=0;$r<=count($array)-1;$r++){
                    if($array[$r]==$no_factura){
                      $boton_factura="<a href='".$ruta."/".$array_nombres[$r]."' target='_blank'><button id='".$evento."#".$array[$r]."' class='btn btn-success' style='margin-left:.3em;margin-right:.3em' ><i class='fas fa-file-pdf fa-2x' aria-hidden='true'></i></button></a>";
                    }
                  }

                  if($descripcion=="Carga inicial"){
                    $tbody=$tbody."<td><label class='btn btn-info' disabled='disabled'><i class='fa fa-ban fa-2x' aria-hidden='true'></i></label>".$boton_factura."</td>";
                  }
                  else{
                    $tbody=$tbody."<td><a href='solicitud_factura.php?id=".$row[0]."' target='_blank'><label class='btn btn-info btn_descargar_facturas'><i class='fa fa-download fa-2x' aria-hidden='true'></i></label></a>".$boton_factura."</td>";
                  }
                  
                }
                 $tbody=$tbody."</tr>";
              $total_facturas=$total_facturas+$row[1];
  }
}

$resultado2="<p><br>";
$utilidad=$total_facturas-$suma_solicitudes;
$util="";
if($utilidad>0){
  $util="<h3><label class='label label-success'><i class='fas fa-angle-double-up' aria-hidden='true'> ".moneda($utilidad)."</i></label></h3>";
}
if($utilidad<=0){
  $util="<h3><label class='label label-danger'><i class='fas fa-angle-double-down' aria-hidden='true'> ".moneda($utilidad)."</i></label></h3>";
}
/*
$SUMA=$suma_solicitudes+$total_facturas;
$por_facturas=($suma_solicitudes/$SUMA)*100;
$por_egresos=($total_facturas/$SUMA)*100;
*/

//$porcentaje=(($total_facturas/$suma_solicitudes)*100)-100;
$porcentaje=0;
if($total_facturas>0){
  $porcentaje=($utilidad*100)/$total_facturas;
}


if($utilidad>0){
  $porcentaje="<h3><label class='label label-success'><i class='fas fa-angle-double-up' aria-hidden='true'> ".round($porcentaje,2)."%</i></label></h3>";
}
if($utilidad<=0){
  $porcentaje="<h3><label class='label label-danger'><i class='fas fa-angle-double-down' aria-hidden='true'> ".round($porcentaje,2)."%</i></label></h3>";
}

$variable="<thead style='background-color: #455F87; color: white'>
<tr>
<th colspan='2' class='text-center'>Gráfica</th>
</tr>
</thead>
<tbody>
<tr>
<td colspan='2' class='text-center'>
<i>No es posible representar utilidad negativa</i></td>
</tr></tbody>";

if($utilidad>0){
  $variable="<thead style='background-color: #455F87; color: white'>
  <tr>
  <th colspan='2' class='text-center'>Gráfica</th>
  </tr>
</thead>
<tbody>
<tr>
<td colspan='2' class='text-center'>
<center><canvas id='pie' height='200' width='250'></canvas></center>
<script>
var ctx = document.getElementById('pie').getContext('2d');
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
      labels: ['Egresos', 'Utilidad'],
      datasets: [{
          data: [".$suma_solicitudes.", ".$utilidad."],
          backgroundColor: [
              'rgba(215,31,31,0.7)',
              'rgba(111,173,23,0.85)',
          ],
      }]
  },
  
  options: {
    legend: {
      position: 'top'
    },
    responsive: false,
    maintainAspectRatio: true,
     
  },
  plugins: {
    labels: {
      render: 'percentage',
      fontColor: '#000',
        precision: 2
    }
  }
});
</script>
</td>
</tbody>";
}


$resultado2=$resultado2."<div class='row col-md-5'></table>
<div class='row col-md-5'>
<table class='table table-user-information table-sm'>
                    <thead style='background-color: #455F87; color: white'>
                    <tr>
                      <th class='text-center'>Suma solicitudes</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class='text-center'><h3><span class='label label-primary'>".moneda($suma_solicitudes)."</span></h3></td>
                      </tr>
                    </tbody>
                    </table>
</div>
<div class='row col-md-5'>
<table class='table table-user-information table-sm'>
                    <thead style='background-color: #455F87; color: white'>
                    <tr>
                      <th class='text-center'>Presupuesto</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class='text-center'><h3><span class='label label-primary'>".moneda($facturacion)."</span></h3></td>
                      </tr>
                    </tbody>
                    </table>
</div>
<div class='row col-md-12'>
<table class='table table-user-information table-sm'>
                  <thead style='background-color: #455F87; color: white'>
                  <tr >
                    <th colspan='2' class='text-center'>Cierre del evento</th>
                  </tr>
                  </thead>
                  <thead style='background-color: #455F87; color: white'>
                    <tr>
                      <th class='text-center'>Σ Egresos</th>
                      <th class='text-center'>Σ Facturación</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class='text-center'><h3><strong>".moneda($suma_solicitudes)."</strong></h3></td>
                      <td class='text-center'><h3><strong>".moneda($total_facturas)."</strong></h3></td>
                    </tr>
                  </tbody>
                  <thead style='background-color: #455F87; color: white'>
                    <tr>
                    <th colspan='2' class='text-center'>Utilidad</th>
                    </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td class='text-center'>".$util."</td>
                    <td class='text-center'>
                    <div><h4><strong>".$porcentaje."</strong></h4></div>
                    <!--
                    <div class='progress' style='height: 40px !important'>
                    <div class='progress-bar progress-bar-success' role='progressbar' style='height:40px;width:".$por_egresos."%'>
                      <h4>".round($por_egresos,2)."%</h4>
                    </div>
                    <div class='progress-bar progress-bar-danger' role='progressbar' style='height:40px;width:".$por_facturas."%'>
                    <h4>".round($por_facturas,2)."%</h4>
                    </div>
                    -->
                    
                  </div></td>
                  </tr>
                  </tbody>
                  ".$variable."
                  </table> </div>
</div>
<div class='row col-md-7'>
<table class='table table-user-information table-sm'>
                    <thead style='background-color: #455F87; color: white'>
                    <tr >
                      <th colspan='5' class='text-center'>Facturación</th>
                    </tr>
                    </thead>
                    <thead style='background-color: #455F87; color: white'>
                      <tr>
                        <th class='text-center'>#</th>
                        <th class='text-center'>Factura</th>
                        <th class='text-center'>Estatus</th>
                        <th class='text-center'>Monto</th>
                        <th class='text-center'>descargar</th>
                      </tr>
                    </thead>
                    <tbody>
                      ".$tbody."
                    </tbody>
                    <tfoot>
                        <tr>

                        <th colspan='3'>
                        <div class='col-md-1'>";
                        
                        if($_COOKIE['user']=="ALAN SANDOVAL" || $_COOKIE['user']=="SANDRA PEÑA"){
                          $resultado2=$resultado2."<button class='btn btn-success btn-agregar-factura'><i class='fas fa-plus'></i></button>";
                        }
                        $resultado2=$resultado2."</div>
                        <div class='col-md-3 pull-right'>
                        <label class='abajo text-right'>Total:</label>
                        </div>
                        </th>
                        <th colspan='2' class='text-center'><h3><span class='label label-primary'>".moneda($total_facturas)."</span></h3></th>
                      </tr>
                      </tfoot>
                  </table>
                  </div>$$$".$utilidad."$$$".$suma_solicitudes;

?>