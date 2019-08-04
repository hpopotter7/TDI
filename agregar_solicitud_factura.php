<?php 
$evento=$_POST['c_evento_cliente'];
$dias_credito=$_POST['txt_dias_credito'];
$num_pedido=$_POST['txt_num_pedido'];
$num_orden=$_POST['txt_orden_compra'];
$num_entrada=$_POST['txt_num_entrada'];
$gr=$_POST['txt_gr'];
$correo1=$_POST['txt_correo_1'];
$correo2=$_POST['txt_correo_2'];
$correo3=$_POST['txt_correo_3'];
$correo4=$_POST['txt_correo_4'];
$correo5=$_POST['txt_correo_5'];
$user_registra=$_POST['usuario_registra'];
$observaciones=$_POST['area_observaciones'];
$empresa_factura=$_POST['c_empresa_factura'];
$partidas_descripcion=$_POST['partidas_descripcion'];
$partidas_pu=$_POST['partidas_pu'];
$partidas_iva=$_POST['partidas_iva'];
$partidas_total=$_POST['partidas_total'];
$largo=$_POST['largo'];

$id=explode('&', $evento);
$id_evento=$id[0];
$arr_descripcion=explode('#',$partidas_descripcion);
$arr_pu=explode('#',$partidas_pu);
$arr_iva=explode('#',$partidas_iva);
$arr_total=explode('#',$partidas_total);

$formatter = new NumberFormatter('es_MX', NumberFormatter::CURRENCY);
/*
$sub=$formatter->parseCurrency($subtotal, $curr);
$iva=$formatter->parseCurrency($iva, $curr);
$total=$formatter->parseCurrency($total, $curr);
*/

include("conexion.php");
	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
	}
		$respuesta="nop";



		$sql="INSERT INTO solicitud_factura (id_evento, Dias_credito, Num_pedido, Num_orden, Num_entrada, GR, correo1, correo2, correo3, correo4, correo5, Fecha_hora_registro, Usuario_registra, Observaciones, empresa_factura) VALUES ('".$id_evento."', '".$dias_credito."', '".$num_pedido."', '".$num_orden."', '".$num_entrada."', '".$gr."', '".$correo1."', '".$correo2."', '".$correo3."', '".$correo4."', '".$correo5."', NOW(), '".$user_registra."', '".$observaciones."', '".$empresa_factura."')";
		$result = $mysqli->query("SET NAMES 'utf8'");
		if ($mysqli->query($sql)) {
		    $respuesta= "solicitud agregada";
		   
		}
		else{
			$respuesta= $sql."<br>".mysqli_error($mysqli);
		}
		 $sql="SELECT MAX( id_solicitud ) FROM solicitud_factura";
		    $id_max;
			if ($result = $mysqli->query($sql)) {
				 while ($row = $result->fetch_row()) {
					$id_max=$row[0];
				}
			}
			echo $largo;
		    for($r=0;$r<=$largo;$r++){
	    		$sql="INSERT INTO partidas(descripcion, pu, iva, total, id_sol_factura) values('".$arr_descripcion[$r]."', '".$formatter->parseCurrency($arr_pu[$r], $curr)."', '".$formatter->parseCurrency($arr_iva[$r], $curr)."', '".$formatter->parseCurrency($arr_total[$r], $curr)."', '".$id_max."')";
	    		
	    		
		    	if ($mysqli->query($sql)) {
		    		$respuesta= "solicitud agregada";
		    	}
		    	
			}
			
		echo $respuesta;

	$mysqli->close();
?>
