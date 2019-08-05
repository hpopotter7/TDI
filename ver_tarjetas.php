<?php
  include("conexion.php");
  if (mysqli_connect_errno()) {
      printf("Error de conexion: %s\n", mysqli_connect_error());
      exit();
  }
  $result = $mysqli->query("SET NAMES 'utf8'");
  $sql="SELECT Nombre, Sodexo FROM usuarios where sodexo!='' order by Nombre";
  if ($result = $mysqli->query($sql)) {
      $res='<option value="vacio">Selecciona...</option>';
      while ($row = $result->fetch_row()) {
          $res=$res."<option value='".$row[1]."'>".$row[0]." [".$row[1]."]</option>";
      }
      $result->close();
  }
  echo $res;
 ?>
