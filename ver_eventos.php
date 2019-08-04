<?php 
//$usuario=$_POST['usuario'];
$usuario='ALAN SANDOVAL';
//$mysqli = new mysqli("localhost", "tierra_ideas", "adminadmin", "tierra_ideas");
include("conexion.php");
//$mysqli = new mysqli("localhost", "tierrad9_admin", "Quick2215!", "tierrad9_admin");

/* check connection */
if (mysqli_connect_errno()) {
    echo("Error: ", mysqli_connect_error());
    exit();
}

/* Select queries return a resultset */

/*  Todos solos usuarios pueden ver todos los eventos---se quitara el boton de modificar
$sql="SELECT id_evento, Numero_evento, Nombre_evento FROM eventos where Estatus='ABIERTO' and(diseño like '%".$usuario."%' or produccion like '%".$usuario."%' or solicita like '%".$usuario."%' or usuario_registra='".$usuario."') order by id_evento asc";
*/

$sql="SELECT id_evento, Numero_evento, Nombre_evento FROM eventos where Estatus='ABIERTO' order by id_evento asc";


if ($result = $mysqli->query($sql)) {
	while ($row = $result->fetch_row()) {
        echo "<option value='".$row[0]."'>".$row[1]."-".$row[2]."</option>";
    }

    /* cerrar el resultset */
    $result->close();
}

/* cerrar la conexión */
$mysqli->close();

/*echo '<option value="vacio">Selecciona un evento...</option>';
    while ($row = $result->fetch_row()) {
        echo "<option value='".$row[0]."'>".$row[1]."-".$row[2]."</option>";
    }*/
?>s