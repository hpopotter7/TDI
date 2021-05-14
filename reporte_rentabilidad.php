<?php 
$like=$_POST['like'];
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

function moneda($value) {
    return '$' . number_format($value, 2);
  }
  


//Facturación del periodo
$result = $mysqli->query("SET NAMES 'utf8'"); 

$sql="select Cliente, Numero_evento, Nombre_Evento, id_evento from eventos where cliente!='GASTO' and Estatus!='CANCELADO' and (".$like. ") order by Cliente asc";
$suma_subtotal=0;
$suma_iva=0;
$suma_total=0;
$tabla="";
$comodin_cliente="";
$tabla_interna="";
$suma_pagada=0;
$suma_pendiente=0;
$suma_e_total=0;
$cont=0;
$primera=0;
if ($result = $mysqli->query($sql)) {
   $cont=0;
    while ($row = $result->fetch_assoc()) {
        $numero_evento=$row['Numero_evento'];
        $nombre_evento=$row['Nombre_Evento'];
        $id_evento=$row['id_evento'];
        $cliente=$row['Cliente'];
        
        if($comodin_cliente==""){
            $comodin_cliente=$cliente;
        }       


        if($comodin_cliente!=$cliente){
            $clase=str_replace(" ", "", $comodin_cliente);
            $clase=str_replace(",", "", $clase);
            $clase=str_replace(".", "", $clase);
            $tabla=$tabla."<tr style='background-color:#dcf1b6'>";
            $tabla=$tabla."<td><button id='".$clase."' class='btn btn-info btn_cliente'>".$comodin_cliente."  <span class='badge badge-dark'>".$cont."</span></button><textarea class='oculto ".$clase."'>".$tabla_interna."</textarea></td>";
            $tabla=$tabla."<td><b>".moneda($suma_pagada)."</b></td>";
            $tabla=$tabla."<td><b>".moneda($suma_pendiente)."</b></td>";
            $tabla=$tabla."<td><b>".moneda($suma_pagada+$suma_pendiente)."</b></td>";
            $tabla=$tabla."<td><b>".moneda($suma_e_total)."</b></td>";
            $diferencia=($suma_pagada+$suma_pendiente)-$suma_e_total;
            if($diferencia>=0){
                $span2="<span class='badge badge-success'>".moneda($diferencia)."</span>";
            }
            else{
                $span2="<span class='badge badge-danger'>".moneda($diferencia)."</span>";
            }
            $tabla=$tabla."<td>".$span2."</td>";
            $porcentaje=0;
            if($diferencia*100>($suma_pagada+$suma_pendiente)){
                $porcentaje=($diferencia*100)/($suma_pagada+$suma_pendiente);
            }

            
            $tabla=$tabla."<td>".round($porcentaje,3)."%</td>";
            $tabla=$tabla."</tr>";
            //$tabla=$tabla.$tabla_interna;
            //$tabla=$tabla."<tr class='oculto' style='display:none'><td><textarea class='".$clase."'>".$tabla_interna."</textarea></td><td>2</td><td>3</td><td>4</td><td>5</td><td>6</td><td>7</td></tr>";
            $comodin_cliente=$cliente;
            $tabla_interna="";
            $suma_pagada=0;
            $suma_pendiente=0;
            $suma_e_total=0;
            $cont=0;
        }
        
            $total_pendiente=0;
            $total_pagado=0;
            $cont++;
            $sql2="select s.id_solicitud, s.Estatus_factura, sum(partidas.total) as total from solicitud_factura s, partidas where s.id_evento='".$id_evento."' and partidas.id_sol_factura=s.id_solicitud and s.Estatus='Activa' group by s.id_solicitud";
            if ($result2 = $mysqli->query($sql2)) {
                while ($row2 = $result2->fetch_assoc()){
                    $id_sdf=$row2['id_solicitud'];
                    $estatus=$row2['Estatus_factura'];
                    $total=$row2['total'];
                    if($estatus==null || $estatus==""){
                        $estatus="PENDIENTE";
                    }
                    if($estatus=="PAGADO"){
                        $total_pagado=$total_pagado+$total;
                        $suma_pagada=$suma_pagada+$total;
                    }
                    else{
                        $total_pendiente=$total_pendiente+$total;
                        $suma_pendiente=$suma_pendiente+$total;
                    }
                }
            }        

            $suma_ip=0;
            $sql2="select importe_total from odc where Cancelada='no' and evento='".$row['Numero_evento']."'";
            if ($result2 = $mysqli->query($sql2)) {
                while ($row2 = $result2->fetch_assoc()){
                    $it=$row2['importe_total'];
                    $suma_ip=$suma_ip+$it;
                    $suma_e_total=$suma_e_total+$it;
                   
                }
            }        
            $clase=str_replace(" ", "", $comodin_cliente);
            $clase=str_replace(",", "", $clase);
            $clase=str_replace(".", "", $clase);
            $tabla_interna=$tabla_interna."<tr class='oculto ".$clase."'>";
            $tabla_interna=$tabla_interna."<td>[".$numero_evento."] - ".$nombre_evento."</td>";
            $tabla_interna=$tabla_interna."<td>".moneda($total_pagado)."</td>";
            $tabla_interna=$tabla_interna."<td>".moneda($total_pendiente)."</td>";
            $tabla_interna=$tabla_interna."<td>".moneda($total_pendiente+$total_pagado)."</td>";
            $tabla_interna=$tabla_interna."<td>".moneda($suma_ip)."</td>";
            $diferencia=($total_pendiente+$total_pagado)-$suma_ip;
            if($diferencia>=0){
                $span="<span class='badge badge-success'>".moneda($diferencia)."</span>";
            }
            else{
                $span="<span class='badge badge-danger'>".moneda($diferencia)."</span>";
            }
            $tabla_interna=$tabla_interna."<td>".$span."</td>";
            $porcentaje=0;
            if($diferencia*100>($total_pendiente+$total_pagado)){
                $porcentaje=($diferencia*100)/($total_pendiente+$total_pagado);
            }

            
            $tabla_interna=$tabla_interna."<td>".round($porcentaje,3)."%</td>";
            $tabla_interna=$tabla_interna."</tr>";             
            
        
    }
    $result->close();
}
else{
    $tabla= "<tr><td>".$sql.mysqli_error($mysqli)."</td></tr>";
}
//Cobranza del periodo


$tabla="<table class='table'><thead>
            <tr>
                <th>Cliente</th>
                <th>Facturación Pagada</th>
                <th>Facturación Pendiente</th>
                <th>Facturación Total</th>
                <th>Egresos</th>
                <th>Diferencia</th>
                <th>%</th>
            </tr>
            </thead>
            <tbody>".$tabla."
            </tbody>
           </table>";

echo $tabla;
$mysqli->close();
?>

  