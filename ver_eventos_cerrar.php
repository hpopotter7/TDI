<?php 
	$evento=$_POST["evento"];
	include("conexion.php");
    $arr=explode("]",$evento);
    $evento=str_replace("[", "", $arr[0]);


    function moneda($value) {
        return '$' . number_format($value, 2);
      }

	if (mysqli_connect_errno()) {
	    echo("Error: ".mysqli_connect_error());
	    exit();
	}
    $result = $mysqli->query("SET NAMES 'utf8'");
	$sql="SELECT suma from ODC_ABIERTOS where evento='".$evento."'";
$egresos=0;
	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {			
            $egresos=$row[0];
		}
		$result->close();
    }
    else{
      echo mysqli_error($mysqli);
      exit();
		}
    $sql="SELECT Importe_total from Reporte_Facturacion where Numero_evento='".$evento."'";
$factutacion=0;
	if ($result = $mysqli->query($sql)) {
		while ($row = $result->fetch_row()) {			
            $facturacion=$row[0];
		}
		$result->close();
    }
    else{
      echo mysqli_error($mysqli);
      exit();
		}
    
    $utilidad=$facturacion-$egresos;

    $tipo="label-danger";
    if($utilidad>0){
        $tipo="label-success";
    }

    $porcentaje=0;
if($facturacion>0){
  $porcentaje=($utilidad*100)/$facturacion;
}


if($utilidad>0){
  $porcentaje=round($porcentaje,2)."%";
}
if($utilidad<=0){
  $porcentaje=round($porcentaje,2)."%";
}
    
    $resultado="<table class='table table-user-information'>
    <thead style='background-color: #455F87; color: white'>
      <tr>
        <th class='text-center'>Σ Egresos</th>
        <th class='text-center'>Σ Facturación</th>
        <th class='text-center'>Utilidad</th>
        <th class='text-center'>Porcentaje</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td class='text-center'><h3><strong>".moneda($egresos)."</strong></h3></td>
        <td class='text-center'><h3><strong>".moneda($facturacion)."</strong></h3></td>
        <td class='text-center'><h3><strong class='label ".$tipo."'>".moneda($utilidad)."</strong></h3></td>
        <td class='text-center'><h3><strong class='label ".$tipo."'>".$porcentaje."</strong></h3></td>
      </tr>
    </tbody>
    </table>";

    if($utilidad>0){
      $grafica="<table class='table table-dark' ><thead style='background-color: #455F87; color: white'>
      <tr>
      <th colspan='2' class='text-center'>Gráfica</th>
      </tr>
    </thead>
    <tbody>
    <tr>
    <td colspan='2' class='text-center'>
    <center><canvas id='pie' height='200' width='250'></canvas></center>
    <script>
    var ctx = document.getElementById('pie').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: ['Egresos', 'Utilidad'],
          datasets: [{
              data: [".$egresos.", ".$utilidad."],
              backgroundColor: [
                  'rgba(215,31,31,0.7)',
                  'rgba(111,173,23,0.85)',
              ],
          }]
      },
      
      options: {
        legend: {
          position: 'top'
        },
        responsive: false,
        maintainAspectRatio: true,
         
      }
    });
    </script>
    </td>
    </tbody></table>";
    }

    echo $resultado.$grafica;
?>