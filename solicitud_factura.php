
<?php
$id=$_GET['id'];  //id_sol_factura

header("Content-Type: text/html;charset=utf-8");


require('alphapdf.php');
//require('fpdf.php');
date_default_timezone_set ("America/Mexico_City");
$hoy=getdate();
$d = date("d");
$m = date("m");
$y = date("Y");
if($m<10){
    $m="0".$m;
}

//Connect to your database
include("conexion.php");

//Select the Products you want to show in your PDF file
$result = $mysqli->query("SET NAMES 'utf8'");
    
if($id==0){
        $sql="select max(id_solicitud) from solicitud_factura";
    if ($result = $mysqli->query($sql)) {
         while ($row = $result->fetch_row()) {
            $id=$row[0];
        }
    }    
} 

$cuenta="";
$forma_pago="";
$metodo_pago="";


    $sql="SELECT s.id_evento, e.cliente, s.Dias_credito, s.Num_pedido, s.Num_orden, s.Num_entrada, s.GR, s.correo1, s.correo2, s.correo3, s.correo4, s.correo5, s.Usuario_Registra, e.Nombre_evento, e.sede, DATE_FORMAT(e.inicio_evento, '%d/%m/%Y'), e.Numero_Evento, s.Observaciones, s.empresa_factura, DATE_FORMAT(s.fecha_hora_registro, '%d/%m/%Y') as empresa, e.Numero_evento from solicitud_factura s ,eventos e where e.id_evento=s.id_evento and s.id_solicitud=".$id;

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_row()) {
        //$arr_cliente=explode("&",$row[1]); // posicion 0=>id cliente, pos 1=> Nombre cliente
        
        $id_evento = $row[0];
        $cliente=$row[1];
        $dias_credito = $row[2];
        $num_pedido = $row[3];
        $num_orden = $row[4];
        $num_entrada = $row[5];
        $gr = $row[6];
        $correo1 = $row[7];
        $correo2 = $row[8];
        $correo3 = $row[9];
        $correo4 = $row[10];
        $correo5 = $row[11];
        $usuario_registra = $row[12];
        $nombre_evento = $row[13];
        $sede= $row[14];
        $fecha_evento = $row[15];
        $numero_evento = $row[16];
        $observaciones = $row[17];
        $empresa = $row[18];
        $fecha_solicitud = $row[19];
        $evento = $row[20];
    }

    $result->close();
}
else{
    echo "Error MySql: ".$mysqli->error;
    exit();
}

//otra consulta para datos de cliente
$sql="SELECT Razon_Social, rfc, Calle, num_ext, num_int, colonia, municipio, estado, cp, uso_cfdi from clientes where Razon_Social='".$cliente."'";

if ($result = $mysqli->query($sql)) {
    
    while ($row = $result->fetch_row()) {
        $razon_social = $row[0];
        $rfc = $row[1];
        $calle = $row[2];
        $num_ext = $row[3];
        $num_int = $row[4];
        $colonia = $row[5];
        $municipio = $row[6];
        $estado = $row[7];
        $cp = $row[8];
        //$metodo_pago = $row[9];
        $uso_cfdi = $row[9];
       //$uso_cfdi = $row[11];
       // $metodo_pago = $row[12];
    }

    $result->close();
}
else{
    echo "Error MySql: ".$mysqli->error;
    exit();
}

//otra consulta para partidas
/*
$arr_desc = array();
$arr_pu = array();
$arr_iva = array();
$arr_total = array();
*/
/*
$sql="SELECT * from partidas where id_sol_factura=".$id;
if ($result = $mysqli->query($sql)) {
     while ($row = $result->fetch_row()) {
        $dato=$row[1];
        array_push($arr_desc, $row[1]);
        array_push($arr_pu, $row[2]);
        array_push($arr_iva, $row[3]);
        array_push($arr_total, $row[4]);
     }
    $result->close();
}
/*
else{
    echo "Error MySql: ".$mysqli->error;
    exit();
}
*/
//header




//Create a new PDF file
$pdf=new AlphaPDF();
$pdf->AddPage();
$pdf->AddFont('Gotham','','Gotham-Book.php');
$pdf->AddFont('Gotham_Italic','','Gotham-BookItalic.php');
$pdf->AddFont('Gotham_M','','Gotham-Medium.php');
$pdf->SetFont('Gotham_M','',16);
$pdf->SetAutoPageBreak(true, 4);
    $pdf->SetFont('Gotham_M','',16);
    // Título
    $pdf->SetAlpha(0.15);
    $pdf->SetFillColor(187,211,42);
    //$pdf->SetFillColor(219,219,219);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetAlpha(0.1);
    $pdf->Image('img/logo.png',70,110,100,0,'PNG');  
    $pdf->Image('img/logo.png',70,360,100,0,'PNG');  
    $pdf->SetAlpha(1);
    
    $pdf->SetX(10);
    $pdf->Cell(0,7,utf8_decode("SOLICITUD DE FACTURA"),1,0,'C',false);
    $pdf->SetTextColor(0,0,0);
    $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(50,7,utf8_decode('EMPRESA QUE FACTURA'),1,0,'C',true);
    $pdf->SetX(60);
    $pdf->SetFont('Gotham_M','',12);
    $pdf->Cell(140,7,utf8_decode($empresa),1,0,'C',false);
    $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Nombre de evento:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(110,7,utf8_decode($nombre_evento),1,0,'C',false);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(160);
    $pdf->Cell(20,7,utf8_decode('# evento:'),1,0,'C',true);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->SetX(180);
    $pdf->Cell(20,7,utf8_decode($numero_evento),1,0,'C',false);
    $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Nombre de cliente:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(150,7,utf8_decode($cliente),1,0,'C',false);
    $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Lugar:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(150,7,utf8_decode($sede),1,0,'C',false);
    $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Fecha del evento:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(150,7,utf8_decode($fecha_evento),1,0,'C',false);
    $pdf->Ln(7);
    $pdf->SetFont('Gotham_Italic','',10);
    $pdf->Cell(190,5,utf8_decode('Datos del cliente'),1,0,'C',true);
    $pdf->Ln(5);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Razon Social:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(150,7,utf8_decode($razon_social),1,0,'C',false);
     $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('RFC:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(150,7,utf8_decode($rfc),1,0,'C',false);
    $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Calle/Av.:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(70,7,utf8_decode($calle),1,0,'C',false);
    $pdf->SetX(120);
    $pdf->SetFont('Gotham','',8);
    $pdf->Cell(20,7,utf8_decode("# Ext:"),1,0,'C',true);
    $pdf->SetX(140);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(20,7,utf8_decode($num_ext),1,0,'C',false);
    $pdf->SetFont('Gotham','',8);
    $pdf->Cell(20,7,utf8_decode("# Int:"),1,0,'C',true);
    $pdf->SetX(180);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(20,7,utf8_decode($num_int),1,0,'C',false);
     $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Colonia:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(150,7,utf8_decode($colonia),1,0,'C',false);
    $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Alcaldía:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(150,7,utf8_decode($municipio),1,0,'C',false);
    $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Código Postal:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(80,7,utf8_decode($cp),1,0,'C',false);
    $pdf->SetX(130);
    $pdf->SetFont('Gotham','',8);
    $pdf->Cell(20,7,utf8_decode("Estado:"),1,0,'C',true);
    $pdf->SetX(150);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(50,7,utf8_decode($estado),1,0,'C',false);
     $pdf->Ln(7);
    $pdf->SetFont('Gotham_Italic','',10);
    $pdf->Cell(190,5,utf8_decode('Datos de facturación'),1,0,'C',true);
    $pdf->Ln(5);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Cuenta Bancaria:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(150,7,utf8_decode($cuenta),1,0,'C',false);
     $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Forma de Pago:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(150,7,utf8_decode($forma_pago),1,0,'C',false);
      $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Metodo de Pago:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(150,7,utf8_decode($metodo_pago),1,0,'C',false);
      $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Uso de CFDI:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(150,7,utf8_decode($uso_cfdi),1,0,'C',false);
    if($num_orden==""){
        $num_orden="NA";
    }
    if($num_entrada==""){
        $num_entrada="NA";
    }
    if($num_pedido==""){
        $num_pedido="NA";
    }
    if($gr==""){
        $gr="NA";
    }
      $pdf->Ln(7);
    
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Días de crédito:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(20,7,utf8_decode($dias_credito),1,0,'C',false);
      //$pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(70);
    $pdf->Cell(40,7,utf8_decode('Número de pedido:'),1,0,'C',true);
    $pdf->SetX(110);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(25,7,utf8_decode($num_pedido),1,0,'C',false);
      //$pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(135);
    $pdf->Cell(40,7,utf8_decode('Número de entrada:'),1,0,'C',true);
    $pdf->SetX(175);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(25,7,utf8_decode($num_entrada),1,0,'C',false);
      $pdf->Ln(7);
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(10);
    $pdf->Cell(40,7,utf8_decode('Orden de compra:'),1,0,'C',true);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(35,7,utf8_decode($num_orden),1,0,'C',false);
      
    $pdf->SetFont('Gotham','',10);
    $pdf->SetX(85);
    $pdf->Cell(40,7,utf8_decode('GR (si aplica):'),1,0,'C',true);
    $pdf->SetX(125);
    $pdf->SetFont('Gotham_M','',8);
    $pdf->Cell(35,7,utf8_decode($gr),1,0,'C',false);
     $pdf->Ln(10);
    $pdf->SetFont('Gotham_M','',12);
    $pdf->SetX(13);
    $pdf->Cell(40,10,utf8_decode('Detalle de la solicitud:'),0,0,'C',false);
    $pdf->Ln(10);
    /*
    $pdf->SetFont('Gotham','',10);
    $pdf->Cell(95, 5, "Descripcion",1,0,'C',true);
    $pdf->Cell(35, 5, "Precio Unitario",1,0,'C',true);
    $pdf->Cell(25, 5, "IVA",1,0,'C',true);
    $pdf->Cell(35, 5, "Total",1,0,'C',true);
    //empezaria el ciclo
    
    
    #x=0
    //for($r=0;r<=count($arr_pu)-1;$r++){
    /*
    $startx=10;
    $starty=164;
    $pdf->SetX($startx); 
    $nb1 = $pdf->NbLines($arr_desc[7],25); 
    echo $arr_desc.$nb1;
    exit();
    foreach ($arr_desc as $val){
        //$pdf->Ln(5);
        $nb1 = $pdf->NbLines($val,25); 

        $pdf->SetY($starty); 
        $pdf->MultiCell(95, 5, $nb1,1,'L');
         $starty=$starty+5;
        /*
        $pdf->Cell(35, 5, "$".number_format($arr_pu[$r],2),1,0,'R',false);
        $pdf->Cell(25, 5, "$".number_format($arr_iva[$r],2),1,0,'R',false);
        $pdf->Cell(35, 5, "$".number_format($arr_total[$r],2),1,0,'R',false);
        */
        /*
    }
*/
    //$startx=135;
    /*
    foreach ($arr_pu as $val){
        $pdf->SetXY($startx, $starty); 
        $pdf->MultiCell(35, 5, "$".number_format($val,2),1,"R");
        $starty=$starty+5;
    }
    $startx=140;
    $starty=164;
    foreach ($arr_iva as $val){
        $pdf->SetXY($startx, $starty); 
        $pdf->MultiCell(25, 5, "$".number_format($val,2),1,"R");
        $starty=$starty+5;
    }
    $startx=165;
    $starty=164;
    foreach ($arr_total as $val){
        $pdf->SetXY($startx, $starty); 
        $pdf->MultiCell(35, 5, "$".number_format($val,2),1,"R");
        $starty=$starty+5;
    }
    */
    include("ex.php");
    



//$pdf->Output('I',$evento.".pdf",true); // I se abre en esa pagaina el pdf; D descarga

?>
