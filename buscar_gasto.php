<?php 

$campo=$_POST['c_campo'];
$valor=$_POST['txt_valor'];

include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}

$result = $mysqli->query("SET NAMES 'utf8'");
    $sql="select o.evento, e.Nombre_evento as nombre, o.concepto, o.Importe_total, o.solicito, o.factura, o.id_odc, o.a_nombre, o.comprobado, o.pagado from odc o, eventos e where o.evento=e.Numero_evento and o.Cancelada='no' and  o.".$campo." like '%".$valor."%'";
    
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $comprobado=$row[8];
        $pagado=$row[9];
        $color="";
        if($pagado=="si" && $comprobado=="si"){
            $color="rgba(89,227,106,0.3)";
        }
        else if($pagado=="no" && $comprobado=="no"){
            $color="rgba(194,92,28,0.3)";
        }
        else if($pagado=="si" && $comprobado=="no"){
            $color="rgba(241,250,21,0.5)";
        }
        else if($pagado=="no" && $comprobado=="si"){
            $color="rgba(241,250,21,0.63)";
        }

        if($comprobado=="si"){
            $comprobado='<i class="fa fa-check fa-2x" style="color:green"></i>';
        }
        else{
            $comprobado='<i class="fa fa-times fa-2x" style="color:red"></i>';
        }
        if($pagado=="si"){
            $pagado='<i class="fa fa-check fa-2x" style="color:green"></i>';
        }
        else{
            $pagado='<i class="fa fa-times fa-2x" style="color:red"></i>';
        }
       
        
        $resultado = $resultado."<tr style='background-color:".$color.";'><td><h4><a href='solicitud_pago.php?id=".$row[6]."' class='label label-info' target='_blank'>".$row[6]."</a></h4></td><td>[".$row[0]."] -".$row[1]."</td><td>".$row[7]."</td><td>".$row[2]."</td><td>".'$' . number_format($row[3], 2)."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$comprobado."</td><td>".$pagado."</td></tr>";
    }
    $result->close();
}
else{
    $resultado=" La consulta SQL contiene errores.".$mysqli->error;
}
echo " <thead>
<tr>
    <th>ID</th>
    <th>Evento</th>
    <th>Proveedor</th>
    <th>Concepto</th>
    <th>Importe</th>
    <th>Solicito</th>
    <th>Factura</th>
    <th>Pag</th>
    <th>Comp</th>
</tr>
</thead>
<tbody id='tbody'>".$resultado."</tbody>";
$mysqli->close();
?>