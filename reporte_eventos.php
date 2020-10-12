<?php
include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
function asmoneda($value) {
  return '$' . number_format($value, 2);
}

$res='<thead>
        <tr>
            <th>Número evento</th>
            <th>Nombre</th>
            <th>Cliente</th>
            <th>Inicio del evento</th>
            <th>Fin del evento</th>
            <th>Destino</th>
            <th>Sede</th>
            <th>Ejecutivo</th>
            <th>Diseño</th>
            <th>Productor</th>
            <th>Presupuesto</th>
        </tr>
    </thead><tbody>';
$sql = "SELECT Numero_evento, Nombre_evento, Cliente, DATE_FORMAT(Inicio_evento, '%d/%m/%Y'), DATE_FORMAT(Fin_evento, '%d/%m/%Y'), Destino, Sede, Ejecutivo, Disenio, Produccion, Facturacion, Estatus  FROM eventos order by Numero_evento ";
$result = $mysqli->query("SET NAMES 'utf8'");
if ($result = $mysqli->query($sql)) {
     while ($row = $result->fetch_row()) {

        $arr_cliente=explode('&', $row[2]);
        $CLIENTE=$arr_cliente[1];
        if($arr_cliente[2]!=""){
            $CLIENTE=$CLIENTE."&".$arr_cliente[2];
        }
        if($arr_cliente[3]!=""){
            $CLIENTE=$CLIENTE."&".$arr_cliente[3];
        }
        $money="Revisar monto de facturacion";
        if($row[10]=="NA"){
            $money="Revisar monto de facturacion";
        }
        else if($row[10]=="0.1"){
            $money="POR DEFINIR";
        }
        else{
            $money=asmoneda($row[10]);
        }

        $ARR_EJECUTIVO=explode(",",$row[7]);
        $EJE="<ul>";
        for($r=1;$r<=count($ARR_EJECUTIVO)-1;$r++){
            $EJE=$EJE."<li>".$ARR_EJECUTIVO[$r]."</li>";
        }
        $EJE=$EJE."</ul>";
        
        $ARR_DISENIO=explode(",",$row[8]);
        $DISE="<ul>";
        for($r=1;$r<=count($ARR_DISENIO)-1;$r++){
            $DISE=$DISE."<li>".$ARR_DISENIO[$r]."</li>";
        }
        $DISE=$DISE."</ul>";
        
        $ar_productor=explode(",",$row[9]);
        $pro="<ul>";
        for($r=1;$r<=count($ar_productor)-1;$r++){
            $pro=$pro."<li>".$ar_productor[$r]."</li>";
        }
        $pro=$pro."</ul>";
        $estatus=$row[11];
        if($estatus=="ABIERTO"){
            $res=$res.'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$CLIENTE.'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td><td>'.$EJE.'</td><td>'.$DISE.'</td><td>'.$pro.'</td><td>'.$money.'</td></tr>';
        }
        else if($estatus=="CERRADO"){
            $res=$res.'<tr style="background-color: #BBD32A;color: black;"><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$CLIENTE.'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td><td>'.$EJE.'</td><td>'.$DISE.'</td><td>'.$pro.'</td><td>'.$money.'</td></tr>';
        }
        else if($estatus=="PITCH"){
            $res=$res.'<tr style="background-color: #fbd257;color: black;"><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$CLIENTE.'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td><td>'.$EJE.'</td><td>'.$DISE.'</td><td>'.$pro.'</td><td>'.$money.'</td></tr>';
        }
        else{
            $res=$res.'<tr style="
    background-color: #C1C1C1;color: #c50404;"><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$CLIENTE.'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td>'.$row[6].'</td><td>'.$EJE.'</td><td>'.$DISE.'</td><td>'.$pro.'</td><td>'.$money.'</td></tr>';
        }
        
    
    }
    $result->close();
}
$res=$res.'</tbody>';
//echo json_encode($data);
echo $res;
$mysqli->close();

?>
