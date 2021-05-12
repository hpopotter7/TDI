<?php 
$mes=$_POST["mes"];
$anio=$_POST["anio"];
$ruta = "nomina/".$anio."/".$mes."/";
$pos=1;
$response="";
     
    $myfiles = array_diff( scandir($ruta), array(".", "..") );
  foreach($myfiles as $file){
    if(is_dir($ruta)){
        $response=$response."<tr>
        <td>".$pos."</td>
        <td>".$anio."</td>
        <td>".$mes."</td>
        <td><button type='button' id='".$file."' class='btn btn-primary btn_comprobante'><i class='fas fa-file-pdf' aria-hidden='true'></i> ".$file."</button></td>
        </tr>";
    $pos++;
  }
}
echo $response;
?>
