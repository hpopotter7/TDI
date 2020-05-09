<?php
$num_evento=$_POST['evento'];
$resultado="<option selected='selected' disabled >Selecciona una solicitud</option>";
include("conexion.php");	
	if (mysqli_connect_error()) {
	    echo "Error de conexion: %s\n", mysqli_connect_error();
	    exit();
    }
    $usuario=$_COOKIE['user'];
    $sql="select s.id_odc, CONCAT('[',e.Numero_evento, '] - ' , e.Nombre_evento) as evento, s.Concepto, s.cheque_por from eventos e, odc s where e.Numero_evento=s.evento and (COMPRAS='".$usuario."' and s.vobo_compras=0) or (s.Project='".$usuario."' and s.vobo_project=0) or (s.Coordinador='".$usuario."' and s.vobo_coordinador=0) or (s.finanzas='".$usuario."' and s.vobo_finanzas=0) or (s.autorizo='".$usuario."' and s.vobo_direccion=0) and e.Numero_evento='".$num_evento."' order by evento asc ";
    $evento_anterior="";
    $result = $mysqli->query("SET NAMES 'utf8'"); 
    
    if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
            $id=$row[0];
            $evento_nuevo=$row[1];
            $concepto=$row[2];
            $importe=$row[3];  
            if($evento_anterior!=$evento_nuevo){
                
                if($evento_anterior!=""){
                    $resultado=$resultado."</optgroup>";            
                }
                $resultado=$resultado."<optgroup label='".$evento_nuevo."'>";
                $evento_anterior=$evento_nuevo;
            }
            else{
                
                $resultado=$resultado."<option value='".$id."'>".$concepto." - ".$importe."</option>";
            }
                    
        }
      }
      else{
        $resultado= "Error: ".$sql.mysqli_error($mysqli);
    }
      echo $sql;
?>