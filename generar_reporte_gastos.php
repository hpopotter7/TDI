<?php 
$EVENTOS=$_POST['eventos'];
include("conexion.php");
$suma_presupuestos=0;
$suma_egresos=0;
$suma_utilidades=0;
function moneda($value) {
    return '$' . number_format($value, 2);
  }
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    $result = $mysqli->query("SET NAMES 'utf8'"); 
    ini_set('max_execution_time', 0);
    //$arr_query=explode("~",$query);
   // $eventos=$arr_query[0];
    //$periodo=$arr_query[1];
    $VAR_EVENTOS="";
    for($r=0;$r<=count($EVENTOS)-1;$r++){
        $VAR_EVENTOS=$VAR_EVENTOS.$EVENTOS[$r].",";
    }
    
    $VAR_EVENTOS=str_replace(",", "','", $VAR_EVENTOS);

    $VAR_EVENTOS=substr($VAR_EVENTOS, 0, -2);  // abcd
    $VAR_EVENTOS="'".$VAR_EVENTOS;  // abcd
    $sql="";

    if($EVENTOS=="todos"){
        /*$periodo=str_replace('and', 'where', $periodo);*/
        $sql="select Numero_evento, Nombre_evento from eventos";
    }
    else{
        $sql="select Numero_evento, Nombre_evento from eventos where Numero_evento in (".$VAR_EVENTOS.")";
    }
    $respuesta="";
    
    $eventos=array();
    $vec1=array();
    $vec2=array();
    $vec3=array();
    $vec_facturacion=array();
    $vec_egresos=array();
    $vec4=array();
    $vec5=array();
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $numero_evento=$row[0];
            $nombre_evento=$row[1];
            array_push($vec1,"<td>".$numero_evento."</td><td><label id='evento_".$numero_evento."' href='#' class='btn btn-info'>".$nombre_evento."</label></td>");
            array_push($eventos, $numero_evento);
        
        }
        $result->close();
    }
    else{
        $respuesta= "Error1: ".mysqli_error($mysqli);
    }

    for($r=0;$r<=count($eventos)-1;$r++){
        //$sql="select Importe_total from Reporte_Facturacion where Numero_evento='".$eventos[$r]."'";
        $sql="select s.Estatus_Factura, p.total from solicitud_factura s, eventos e, partidas p where s.id_evento=e.id_evento and p.id_sol_factura=s.id_solicitud and s.Estatus='Activa' and e.Numero_evento='".$eventos[$r]."'";
        
         
        if ($result = $mysqli->query($sql)) {
            $facturacion_pagada=0;        
        $facturacion_pendiente=0; 
            while ($row = $result->fetch_row()) {
                $estatus=$row[0];
                $total=$row[1];
                if($estatus=="PAGADO"){
                    $facturacion_pagada=$facturacion_pagada+$total;
                }
                else{
                    $facturacion_pendiente=$facturacion_pendiente+$total;
                }
            }
            $SUMA=$facturacion_pendiente+$facturacion_pagada;
            array_push($vec2,"<td>".moneda($facturacion_pendiente)."</td><td>".moneda($facturacion_pagada)."</td><td>".moneda($SUMA)."</td>");
            array_push($vec_facturacion,$facturacion);
            $result->close();
        }
        else{
            $respuesta= "Error2: ".mysqli_error($mysqli);
        }
        
    }
    for($r=0;$r<=count($eventos)-1;$r++){
        $sql="select suma from ODC_ABIERTOS where evento='".$eventos[$r]."'";
        $egresos=0;     
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_row()) {
                $egresos=$row[0];
            }
            array_push($vec3,"<td>".moneda($egresos)."</td>");
            array_push($vec_egresos,$egresos);
            $result->close();
        }
        else{
            $respuesta= "Error3: ".mysqli_error($mysqli);
        }
        
    }
/*
    for($r=0;$r<=count($eventos)-1;$r++){
        $sql="select s.Estatus_Factura from solicitud_factura s, eventos e where s.id_evento=e.id_evento and e.Numero_evento='".$eventos[$r]."'";
        
        $facturacion_pagada=0;        
        $facturacion_pendiente=0;        
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_row()) {
                $facturacion=$row[0];
            }
            array_push($vec2,"<td>".moneda($facturacion)."</td>");
            array_push($vec_facturacion,$facturacion);
            $result->close();
        }
        else{
            $respuesta= "Error: ".mysqli_error($mysqli);
        }
        
    }
    */

    
    for($r=0;$r<=count($vec1)-1;$r++){
        $fac=$vec_facturacion[$r];
        $utilidad=$fac-$vec_egresos[$r];
        $u="";
        $p="<td><i>NA</i></td>";
        if($utilidad<0){
            $u="<td><h4><label class='label label-danger'>".moneda($utilidad)."</label></h4></td>";
        }
        else{
            $u="<td><h4><label class='label label-success'>".moneda($utilidad)."</label></h4></td>";
            $p="<td>".round((($utilidad*100)/$fac),2)."%</td>";
            
        }
        
        $respuesta=$respuesta."<tr>".$vec1[$r].$vec2[$r].$vec3[$r].$u.$p."</tr>";
    }


    $header="<thead><tr><th>No.</th><th>Nombre de evento</th><th>Facturación (POR COBRAR)</th><th>Facturación (PAGADA)</th><th>Facturación TOTAL</th><th>Egresos</th><th>Diferencia</th><th>Utilidad</th></tr></thead><tbody>";
    $respuesta=$header.$respuesta."</tbody>";
    echo $respuesta;


	$mysqli->close();
?>