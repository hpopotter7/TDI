<?php 
	$usuario=$_POST["usuario"];
	//$con = mysql_connect("localhost","tierrad9_admin","Quick2215!");
	$con = mysql_connect("localhost","superroot","S73mpr3s1");
	
	
	mysql_query("SET NAMES 'utf8'");
	if (!$con){die('ERROR DE CONEXION CON MYSQL: ' . mysql_error());}
	/* ********************************************** */
	/********* CONECTA CON LA BASE DE DATOS  **************** */
	$database = mysql_select_db("handcraf_admin",$con);
	//$database = mysql_select_db("hmasq685_prov",$con);
	//$database = mysql_select_db("sandylan_prueba",$con);
	if (!$database){die('ERROR CONEXION CON BD: '.mysql_error());}

	/* ********************************************** */

	$sql="SELECT id_evento, Numero_evento, Nombre_evento FROM eventos where Estatus='ABIERTO' and(diseño like '%".$usuario."%' or produccion like '%".$usuario."%' or solicita like '%".$usuario."%' or usuario_registra='".$usuario."') order by id_evento asc";

	$result = mysql_query ($sql);
	
	// verificamos que no haya error
	if (! $result){
	echo $sql." La consulta SQL contiene errores.".mysql_error();
	}else {
	//obtenemos los datos resultado de la consulta
	while ($row = mysql_fetch_row($result)){
			echo "<option value='".$row[2]."'>".$row[1]." ".$row[2]."</option>";;
	}
	}

?>