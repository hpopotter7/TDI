<?php 
	$titulo=$_POST['titulo'];
	$evento=$_POST['evento'];
	$tipo=$_POST['tipo'];
	$f_sol=$_POST['f_sol'];
	$f_pago=$_POST['f_pago'];
	$odc_cheque_por=$_POST['odc_cheque_por'];
	$letra=$_POST['letra'];
	$a_nombre=$_POST['a_nombre'];
	$txt_concepto=$_POST['txt_concepto'];
	$txt_servicios=$_POST['txt_servicios'];
	$txt_otros=$_POST['txt_otros'];
	$txt_docto_soporte=$_POST['txt_docto_soporte'];
	$odc_fecha=$_POST['odc_fecha'];
	$tipo_pago=$_POST['tipo_pago'];   
	$cfdi=$_POST['cfdi'];
	$metodo_pago=$_POST['metodo_pago'];             
	$user=$_POST['user'];
	$SOLICITO=$_POST['SOLICITO'];
	$FINANZAS=$_POST['FINANZAS'];
	$DIRECTIVO=$_POST['DIRECTIVO'];
	$forma_pago=$_POST['forma_pago'];
	$no_cheque=$_POST['no_cheque'];
	$compras=$_POST['compras'];
	$coordinador=$_POST['coordinador'];
	$project=$_POST['project'];
	$tipo_reembolso=$_POST['tipo_reembolso'];
	$num_tarjeta=$_POST["num_tarjeta"];
	$id_usuario=$a_nombre;

	
		$arr=explode("]",$evento);
    	$evento=str_replace("[", "", $arr[0]);

	include("conexion.php");
		$mysqli->query("SET NAMES 'utf8'");
		if ($mysqli->connect_error) {
			die('Error de conexión: ' . mysqli_error($mysqli));
			exit();
		}


		$sql="insert into odc (evento, tipo, fecha_solicitud, fecha_pago, cheque_por, letra, a_nombre, concepto, servicio, otros, tipo_pago, cfdi, metodo_pago, factura, fecha, usuario_registra, fecha_hora_registro, identificador, solicito, finanzas, autorizo, Forma_pago, no_cheque, Compras, Coordinador, Project, Tipo_tarjeta, No_Tarjeta) values('".$evento."', '".$tipo."', NOW(), '".$f_pago."', '".$odc_cheque_por."', '".$letra."', '".$a_nombre."', '".$txt_concepto."', '".$txt_servicios."', '".$txt_otros."', '".$tipo_pago."', '".$cfdi."', '".$metodo_pago."', '".$txt_docto_soporte."', '".$odc_fecha."', '".$user."', NOW(), '".$titulo."', '".$SOLICITO."', '".$FINANZAS."', '".$DIRECTIVO."', '".$forma_pago."', '".$no_cheque."', '".$compras."', '".$coordinador."', '".$project."', '".$tipo_reembolso."', '".$num_tarjeta."')";
		if ($mysqli->query($sql)) {
		    
		    $RES="registro odc correcto";
		}
		else{
			$RES= mysqli_error($mysqli);
		}
		
		if($RES=="registro odc correcto"){
			
			if ($tipo_reembolso=='TARJETA SODEXO' || $tipo_reembolso=='TARJETA DILIGO' || $tipo_reembolso=='Tarjeta BANCOMER') {
				$sql="insert into movimientos(id_solicitud, No_tarjeta, importe, Tipo_movimiento) 
				values((select max(id_odc) from odc), '".$num_tarjeta."', '".$odc_cheque_por."', 'CARGO')";
				if ($mysqli->query($sql)) {
					$RES="registro odc correcto";
				}
				else{
					$RES= mysqli_error($mysqli);
				}
			}
		}
		
	echo $RES;
$mysqli->close();
?>