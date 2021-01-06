<?php 
$anio=$_POST['anio'];
$cliente=$_POST['cliente'];
include("conexion.php");
$suma_egresos=0;
$suma_facturacion=0;
$VAR_EVENTOS="";
function moneda($value) {
    return '$' . number_format($value, 2);
  }
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    $result = $mysqli->query("SET NAMES 'utf8'"); 
    ini_set('max_execution_time', 0);

    if($anio=="todos"){
        $sql="select e.Numero_evento, e.Nombre_evento, e.cliente, replace(e.ejecutivo,',',''), o.suma as egresos, f.importe_total as facturacion from eventos e, SUMA_ODC o, Reporte_Facturacion f where e.Numero_evento=o.evento and e.numero_evento=f.numero_evento";
    }
    else{
        $sql="select e.Numero_evento, e.Nombre_evento, e.cliente, replace(e.ejecutivo,',',''), o.suma as egresos, f.importe_total as facturacion from eventos e, SUMA_ODC o, Reporte_Facturacion f where e.Numero_evento=o.evento and e.numero_evento=f.numero_evento and e.Numero_evento like '%".$anio."%'";
    }
    
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $utilidad=$row[5]-$row[4];
            $porcentaje=0;
                if($row[5]>0){
                $porcentaje=($utilidad*100)/$row[5]."%";
                }
                $color="style='background-color:rgba(133,185,124,0.37)'";
            if($utilidad<0){
                
                $color="style='background-color:rgba(231,150,155,0.37)'";
            }

            $respuesta=$respuesta."<tr ".$color."><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".moneda($row[4])."</td><td>".moneda($row[5])."</td><td>".moneda($utilidad)."</td><td>".round($porcentaje,2)."%</td></tr>";
        
        }
        $result->close();
    }
    else{
        $respuesta= "Error: ".mysqli_error($mysqli);
    }
    
    $respuesta=$respuesta;
    echo $respuesta;


	$mysqli->close();
?>