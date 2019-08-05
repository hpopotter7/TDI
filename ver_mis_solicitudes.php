<?php 
	$usuario=$_POST["usuario"];
	$evento=$_POST["evento"];
	$con = mysql_connect("localhost","tierrad9_admin","Quick2215!");
	
	mysql_query("SET NAMES 'utf8'");
	if (!$con){die('ERROR DE CONEXION CON MYSQL: ' . mysql_error());}
	/* ********************************************** */
	/********* CONECTA CON LA BASE DE DATOS  **************** */
	$database = mysql_select_db("tierrad9_admin",$con);
	//$database = mysql_select_db("hmasq685_prov",$con);
	//$database = mysql_select_db("sandylan_prueba",$con);
	if (!$database){die('ERROR CONEXION CON BD: '.mysql_error());}

	/* ********************************************** */

	$sql="SELECT id_odc, a_nombre, cheque_por from odc where usuario_registra='".$usuario."' and evento='".$evento."' ";
echo $sql;
	$result = mysql_query ($sql);
	
	// verificamos que no haya error
	if (! $result){
	echo $sql." La consulta SQL contiene errores.".mysql_error();
	}else {
	//obtenemos los datos resultado de la consulta
	while ($row = mysql_fetch_row($result)){
			echo "<option value='".$row[0]."'>".$row[1]."  -  $".$row[2]."</option>";
	}
	}
	

?>