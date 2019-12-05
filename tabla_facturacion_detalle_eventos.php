<?php
$suma_facturado="no hay nada";
$COUNT=0;
$sql2="SELECT p.id_sol_factura, ROUND(sum(p.total),2), s.Estatus from partidas p, solicitud_factura s where s.id_evento=".$evento." and p.id_sol_factura=s.id_solicitud and s.Estatus='Activa' group by p.id_sol_factura";
if ($result = $mysqli->query($sql2)) {
  while ($row = $result->fetch_row()) {
    $COUNT++;
      $tbody=$tbody."<tr>
                <td class='text-center'>".$COUNT."</td>
                <td class='text-center td_btn_numero_factura'>";
                if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                  $tbody=$tbody."<label id=".$row[0]." class='btn btn_verde btn_success btn_numero_factura'>0</label>";
                }
                else{
                  $tbody=$tbody."<label class='btn btn_verde btn_success disabled'>0</label>";
                }
      $tbody=$tbody."
                </td>
                <td class='text-center'>";
                if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                  $tbody=$tbody."<select class='form-control'>";
                }
                else{
                  $tbody=$tbody."<select class='form-control disabled' disabled>";
                }
        $tbody=$tbody."
                <option value='vacio'> </option>
                <option value='PAGADO'>PAGADO</option>
                <option value='COBRADO'>COBRADO</option>
                <option value='NOTA CREDITO'>NOTA CREDITO</option>
                <option value='POR COBRAR'>POR COBRAR</option>
                </select></td>
                <td class='text-center'><h4><span class='label label-primary'>".moneda($row[1])."</span></h4></td>
              ";
              if($usuario=="ALAN SANDOVAL" || $usuario=="SANDRA PEÑA"){
                  $tbody=$tbody."<td><a href='solicitud_factura.php?id=".$row[0]."' target='_blank'><label class='btn btn-info btn_descargar_facturas'><i class='fa fa-download fa-2x' aria-hidden='true'></i></label></a> <a href='#' id='".$row[0]."' class='btn btn-danger btn_eliminar_factura' > <i class='fa fa-trash fa-2x' aria-hidden='true'></i></a></td>";
                }
                else{
                  $tbody=$tbody."<td><a href='solicitud_factura.php?id=".$row[0]."' target='_blank'><label class='btn btn-info btn_descargar_facturas'><i class='fa fa-download fa-2x' aria-hidden='true'></i></label></a></td>";
                }
                 $tbody=$tbody."</tr>";
              $total_facturas=$total_facturas+$row[1];
  }
}

$resultado2="";
$resultado2=$resultado2."<div></table>
<div class='row col-md-3'>
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
<div class='row col-md-3'>
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
<div class='row col-md-6'>
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
                        <th colspan='3' class='text-right'><label class='abajo'>Total:</label></th>
                        <th colspan='2' class='text-center'><h3><span class='label label-primary'>".moneda($total_facturas)."</span></h3></th>
                      </tr>
                      </tfoot>
                  </table></div>";

?>