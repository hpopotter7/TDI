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
	$tarjeta=$_POST['tarjeta'];
	$id_usuario=$a_nombre;
/*
		$formatter = new NumberFormatter('es_MX', NumberFormatter::CURRENCY);
		if(strpos($odc_cheque_por,"$")){  
			$odc_cheque_por=$formatter->parseCurrency($odc_cheque_por, $curr);
		}*/
		$arr=explode("]",$evento);
    	$evento=str_replace("[", "", $arr[0]);

	
	//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
	include("conexion.php");
	//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");
		$mysqli->query("SET NAMES 'utf8'");
	/* check connection */
	if (mysqli_connect_errno()) {
	    printf("Error de conexion: %s\n", mysqli_connect_error());
	    exit();
	}
	if($tarjeta!="TARJETA SODEXO"){
		$sql="select Nombre from usuarios where id_usuarios=".$id_usuario;
			if ($result = $mysqli->query($sql)) {
				while ($row = $result->fetch_row()) {
					$a_nombre=$row[0];
				}
			}
			
	}
	if($tarjeta=="TARJETA SODEXO"){
		$sql="select u.Nombre, t.No_tarjeta from usuarios u, tarjetas t where u.id_usuarios=t.Usuario and t.id_tarjeta=".$id_usuario;
		if ($result = $mysqli->query($sql)) {
			while ($row = $result->fetch_row()) {
				$a_nombre=$row[0]."-".$row[1]."##";
			}
		}
		
	}
		$sql="insert into odc (evento, tipo, fecha_solicitud, fecha_pago, cheque_por, letra, a_nombre, concepto, servicio, otros, tipo_pago, cfdi, metodo_pago, factura, fecha, usuario_registra, fecha_hora_registro, identificador, solicito, finanzas, autorizo, Forma_pago, no_cheque, Compras, Coordinador, Project) values('".$evento."', '".$tipo."', NOW(), '".$f_pago."', '".$odc_cheque_por."', '".$letra."', '".$a_nombre."', '".$txt_concepto."', '".$txt_servicios."', '".$txt_otros."', '".$tipo_pago."', '".$cfdi."', '".$metodo_pago."', '".$txt_docto_soporte."', '".$odc_fecha."', '".$user."', NOW(), '".$titulo."', '".$SOLICITO."', '".$FINANZAS."', '".$DIRECTIVO."', '".$forma_pago."', '".$no_cheque."', '".$compras."', '".$coordinador."', '".$project."')";
		if ($mysqli->query($sql)) {
		    
		    /* fetch object array */
		    $RES="registro odc correcto";
		    /* free result set */
		}
		else{
			echo $mysqli->error.":".$sql;
		}

		if($tarjeta=="TARJETA SODEXO"){
			$arr_usuario=explode("-",$a_nombre);
			$num_tarjeta=$arr_usuario[1];
			$num_tarjeta=str_replace("##", "", $num_tarjeta);
			$sql="insert into movimientos(id_solicitud, No_tarjeta, Importe_solicitado) 
			values((select max(id_odc) from odc), '".$num_tarjeta."', '".$odc_cheque_por."')";
			if ($mysqli->query($sql)) {
		    
		    /* fetch object array */
		    $RES="registro odc correcto";
		    /* free result set */
		}
		else{
			echo $mysqli->error.":".$sql;
		}

		}


	

echo $RES;
$mysqli->close();
?>