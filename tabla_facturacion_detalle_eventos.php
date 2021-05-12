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
$array= Array();
$array_nombres= Array();
if(is_dir($ruta)){
$myfiles = scandir($ruta);
foreach($myfiles as $file){
  if(!is_dir($ruta."/".$file)){
    array_push($array_nombres,$file);
    /*
    $arr_nombre=explode(".",$file);
    $nombre="";
    for($y=0;$y<=count($arr_nombre)-1;$y++){
      $nombre=$nombre.$arr_nombre[$y].".";
    }
    $nombre=substr($nombre, 0, -1);
    */
    $nombre=str_replace(".pdf","",$file);
      array_push($array,$nombre);
    $concatenados=$concatenados.".".$nombre;
  }
}
}
$total_facturas=0;
$sql2="SELECT p.id_sol_factura, ROUND(sum(p.total),2), s.Estatus, s.No_factura, s.Estatus_Factura, ANY_VALUE(p.descripcion), ANY_VALUE(p.IVA) from partidas p, solicitud_factura s where s.id_evento=".$evento." and p.id_sol_factura=s.id_solicitud and s.Estatus='Activa' group by p.id_sol_factura order by s.No_Factura asc";
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
    $iva=$row[6];
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
    if($estatus_factura!="NOTA CREDITO"){
        $total_facturas=$total_facturas+$row[1];
    }

    /* if($estatus_factura!="'NOTA CREDITO"){
      $total_facturas=$total_facturas+$row[1];
     } */
    $COUNT++;
      $tbody=$tbody."<tr>
                <td class='text-center'>".$COUNT."</td>
                <td class='text-center td_btn_numero_factura'>";
                $boton_dividir=""; 
                if($usuario=="SEBASTIAN ZUÑIGA" && $no_factura=="0"){
                  $tbody=$tbody."<button id=".$row[0]." class='btn btn-secondary btn_numero_factura'>".$no_factura."</button>";
                }
                else if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                  $tbody=$tbody."<button id=".$row[0]." class='btn btn-secondary btn_numero_factura'>".$no_factura."</button>";
                  if($no_factura=="0"){
                    $boton_dividir="<button id='btn_dividir_solicitud' class='btn btn-secondary'><i id='".$row[0]."' class='fa fa-object-ungroup'></i></button>";
                  }
                  
                }
                else{
                  $tbody=$tbody."<button class='btn btn-success disabled'>".$no_factura."</button>";
                }
      $tbody=$tbody."
                </td>
                <td class='text-center' style='width: 25%;'>";
                $icono_moneda="";
                if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                  if($estatus_factura=="PAGADO"){
                    $tbody=$tbody."<select id='c_".$row[0]."' class='form-control c_estatus_factura'>";
                  }
                  else{
                    if($iva==0){
                      $tbody=$tbody."<select id='usd_".$row[0]."' class='form-control c_estatus_factura'>";
                      $icono_moneda="<i class='fas fa-euro-sign'> </i>";
                    }
                    else{
                      $tbody=$tbody."<select id='c_".$row[0]."' class='form-control c_estatus_factura'>";
                      $icono_moneda="";
                    }
                    
                  }
                  
                }
                else{
                  $tbody=$tbody."<select class='form-control disabled' disabled>";
                }
              $tbody=$tbody."
                <option value='vacio' ".$estatus0.">---Selecciona---</option>
                <option value='PAGADO' ".$estatus1.">PAGADO</option>
                
                <option value='NOTA CREDITO' ".$estatus3.">NOTA CREDITO</option>
                <option value='POR COBRAR' ".$estatus4.">POR COBRAR</option>
                </select></td>";
                
                if($estatus_factura=="PAGADO"){
                  $tbody=$tbody."<td class='text-center'><h4><span id='".$row[0]."' class='btn btn-primary'>".moneda($row[1])."</span> ".$boton_dividir."</h4> </td>";
                }
                else{
                  $tbody=$tbody."<td class='text-center'><h4><span id='".$row[0]."' class='btn btn-primary btn_convetir_usd'>".moneda($row[1])."</span> ".$boton_dividir."</h4> </td>";
                }
               
              /*
              $menu="<div class='dropdown'>
              <button onclick='myFunction()' class='dropbtn'><i class='fas fa-caret-down aria-hidden='true'></i> Opciones</button>
              <div id='myDropdown' class='dropdown-content'>
              <a href='".$ref1."' target='_blank'><button id='".$evento."#".$array[$r]."' class='btn btn-success' style='margin-left:.3em;margin-right:.3em' ><i class='fas fa-file-pdf ' aria-hidden='true'></i></button> Ver archivo ".$ref1."</a>
                <a href='#'><button class='btn btn-danger'><i class='fas fa-file-excel' aria-hidden='true'></i> Borrar archivo</button></a>
              </div>
            </div>";
            */
              if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                if($descripcion=="Carga inicial"){
                  $tbody=$tbody."<td><button class='btn btn-info'><i class='fa fa-ban' aria-hidden='true'></i></button>";

                }
                else{
                  //$tbody=$tbody."<td><a href='solicitud_factura.php?id=".$row[0]."' target='_blank'><button id='".$row[0]."' class='btn btn-info btn_descargar_facturas'><i class='fa fa-download' aria-hidden='true'></i></button></a>";
                  $tbody=$tbody."<td><a href='solicitud_factura.php?id=".$row[0]."' target='_blank'><button id='".$row[0]."' class='btn btn-info btn_descargar_facturas'><i class='fa fa-download' aria-hidden='true'></i></button></a>";
                }

                $boton_factura="<button type='file' id='".$evento."#".$no_factura."' class='btn btn-success btn_subir_factura' style='margin-left:.3em;margin-right:.3em' ><i class='fas fa-cloud-upload-alt' aria-hidden='true'></i></button>";
                for($t=0;$t<=count($array)-1;$t++){
                  if($array[$t]==$no_factura){
                  $referencia=$array_nombres[$t];
                      $boton_factura="<a href='".$ruta."/".$referencia."' target='_blank'><button id='".$evento."#".$array[$t]."' class='btn btn-success' style='margin-left:.3em;margin-right:.3em' ><i class='fas fa-file-pdf ' aria-hidden='true'></i></button></a>
                      <a href='#' title='Borrar archivo'><button id='".$ruta."/".$referencia."' class='btn btn-danger btn_borrar_factura'><i class='fas fa-file-excel' aria-hidden='true'></i></button></a>
                      ";
                      }                      
                }
                $tbody=$tbody.$boton_factura."<button id='".$row[0]."' class='btn btn-primary btn_transferir_factura' style='margin-left:.3em;margin-right:.3em'><i class='fas fa-exchange-alt' aria-hidden='true'></i></button><a href='#' id='".$row[0]."' class='btn btn-danger btn_eliminar_factura' ><i class='fa fa-trash' aria-hidden='true'></i></a></td>";
                 
              }
              else if($usuario="SEBASTIAN ZUÑIGA"){
                if($descripcion=="Carga inicial"){
                  $tbody=$tbody."<td><button class='btn btn-info'><i class='fa fa-ban' aria-hidden='true'></i></button>";
                }
                else{
                  $tbody=$tbody."<td><a href='solicitud_factura.php?id=".$row[0]."' target='_blank'><button id='".$row[0]."' class='btn btn-info btn_descargar_facturas'><i class='fa fa-download' aria-hidden='true'></i></button></a>";
                }

                $boton_factura="<button type='file' id='".$evento."#".$no_factura."' class='btn btn-success btn_subir_factura' style='margin-left:.3em;margin-right:.3em' ><i class='fas fa-cloud-upload-alt' aria-hidden='true'></i></button>";
                for($t=0;$t<=count($array)-1;$t++){
                  if($array[$t]==$no_factura){
                  $referencia=$array_nombres[$t];
                      $boton_factura="<a href='".$ruta."/".$referencia."' target='_blank'><button id='".$evento."#".$array[$t]."' class='btn btn-success' style='margin-left:.3em;margin-right:.3em' ><i class='fas fa-file-pdf ' aria-hidden='true'></i></button></a>";
                      }                      
                }
                $tbody=$tbody.$boton_factura."</td>";
                 
                }
              else{
                $boton_factura="<button type='button' class='btn btn-success' ><i class='fa fa-ban' aria-hidden='true'></i></button>";
                  for($r=0;$r<=count($array)-1;$r++){
                    if($array[$r]==$no_factura){
                      $boton_factura="<a href='".$ruta."/".$array_nombres[$r]."' target='_blank'><button id='".$evento."#".$array[$r]."' class='btn btn-success' ><i class='fas fa-file-pdf' aria-hidden='true'></i></button></a>";
                    }
                  }

                  if($descripcion=="Carga inicial"){
                    $tbody=$tbody."<td><button class='btn btn-info' disabled='disabled'><i class='fa fa-ban' aria-hidden='true'></i></button>".$boton_factura."</td>";
                  }
                  else{
                    $tbody=$tbody."<td><a class='btn btn-info' href='solicitud_factura.php? id=".$row[0]."' target='_blank'><i class='fa fa-download' aria-hidden='true'></i></a>".$boton_factura."</td>";
                  }
                  
                }
                 $tbody=$tbody."</tr>";
                 
             
  }
}

$resultado2="";
$utilidad=$total_facturas-$suma_solicitudes;
$util="";
if($utilidad>0){
  $util="<span class='badge badge-success'><h4 style='color:#fff'><i class='fas fa-angle-double-up' aria-hidden='true'> ".moneda($utilidad)."</i></h4></span>";
}
if($utilidad<=0){
  $util="<span class='badge badge-danger'><h4 style='color:#fff'><i class='fas fa-angle-double-down' aria-hidden='true'> ".moneda($utilidad)."</i></h4></span>";
}
/*
$SUMA=$suma_solicitudes+$total_facturas;
$por_facturas=($suma_solicitudes/$SUMA)*100;
$por_egresos=($total_facturas/$SUMA)*100;
*/

//$porcentaje=(($total_facturas/$suma_solicitudes)*100)-100;
$porcentaje=0;
$por_egresos=0;
$por_facturas=0;

if($total_facturas>0){
  $porcentaje=($utilidad*100)/$total_facturas;
}


if($utilidad>0){
  $porcentaje="<span class='badge badge-success'><h4 style='color:#fff'><i class='fas fa-angle-double-up' aria-hidden='true'> ".round($porcentaje,2)."%</i></h4></span>";
}
if($utilidad<=0){
  $porcentaje="<label class='badge badge-danger'><h4 style='color:#fff'><i class='fas fa-angle-double-down' aria-hidden='true'> ".round($porcentaje,2)."%</i></h4></span>";
}

$variable="<thead style='background-color: rgba(155,175,55,.9); color: white'>
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
  $variable="<thead style='background-color: rgba(155,175,55,.9); color: white'>
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
</tr>
</tbody>";
}


$resultado2=$resultado2."<div class='row' id='div_facturacion'></div>
<div class='row col-md-5' style='margin-left: 20px;height: 10px;'></table>
<div class='row col-md-6'>
<table class='table table-user-information table-sm'>
                    <thead style='background-color: rgba(155,175,55,.9); color: white'>
                    <tr>
                      <th class='text-center'>Suma solicitudes</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class='text-center'><h5><span class='label label-primary'>".moneda($suma_solicitudes)."</span></h5></td>
                      </tr>
                    </tbody>
                    </table>
</div>
<div class='row col-md-6'>
<table class='table table-user-information table-sm'>
                    <thead style='background-color: rgba(155,175,55,.9); color: white'>
                    <tr>
                      <th class='text-center'>Presupuesto</th>
                    </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class='text-center'><h5><span class='label label-primary'>".moneda($facturacion)."</span></h5></td>
                      </tr>
                    </tbody>
                    </table>
</div>
<div class='row col-md-12'>
<table class='table table-user-information table-sm'>
                  <thead style='background-color: rgba(155,175,55,.9); color: white'>
                  <tr >
                    <th colspan='2' class='text-center'>Cierre del evento</th>
                  </tr>
                  </thead>
                  <thead style='background-color: rgba(155,175,55,.9); color: white'>
                    <tr>
                      <th class='text-center'>Σ Egresos</th>
                      <th class='text-center'>Σ Facturación</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class='text-center'><h5><strong>".moneda($suma_solicitudes)."</strong></h3></td>
                      <td class='text-center'><h5><strong>".moneda($total_facturas)."</strong></h3></td>
                    </tr>
                  </tbody>
                  <thead style='background-color: rgba(155,175,55,.9); color: white'>
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
                    <thead style='background-color: rgba(155,175,55,.9); color: white'>
                    <tr >
                      <th colspan='5' class='text-center'>Facturación</th>
                    </tr>
                    </thead>
                    <thead style='background-color: rgba(155,175,55,.9); color: white'>
                      <tr>
                        <th class='text-center'>#</th>
                        <th class='text-center'>Factura</th>
                        <th class='text-center' style='width: 25%;' >Estatus</th>
                        <th class='text-center'>Monto</th>
                        <th class='text-center'>Opciones</th>
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
                        </th> 
                        <th>Total: </th><th><h3><span class='label label-primary'>".moneda($total_facturas)."</span></h3></th>
                      </tr>
                      </tfoot>
                  </table>
                  </div>$$$".$utilidad."$$$".$suma_solicitudes;

?>