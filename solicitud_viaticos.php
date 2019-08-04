
<?php
$id=$_GET['id'];

header("Content-Type: text/html;charset=utf-8");
require('fpdf.php');
date_default_timezone_set ("America/Mexico_City");
$hoy=getdate();
$d = $hoy[mday];
$m = $hoy[mon];
$y = $hoy[year];
if($m<10){
    $m="0".$m;
}

//Connect to your database
include("conexion.php");

//Select the Products you want to show in your PDF file
$result = $mysqli->query("SET NAMES 'utf8'");
    $a_nombre = "";
    $concepto = "";
    $servicio = "";
    $importe = "";
    $letra = "";
    $fecha_sol = "";
    $fecha_pago = "";
    $factura = "";
    $fecha = "";
    $cuenta = "";
    $clabe = "";
    $banco = "";
    $nombre_solicita = "";
    $evento = "";
    $tipo="";
    $tipo_pago="";
    
if($id==0){
        $sql="select max(id_odc) from odc";
    if ($result = $mysqli->query($sql)) {
         while ($row = $result->fetch_row()) {
            $id=$row[0];
        }
    }    
}    

$sql="SELECT o.a_nombre, o.concepto, o.servicio, o.cheque_por, o.letra, 
DATE_FORMAT(o.fecha_solicitud,'%d/%m/%Y'), DATE_FORMAT(o.fecha_pago, '%d/%m/%Y'), o.factura, DATE_FORMAT(o.fecha, '%d/%m/%Y'), CONCAT(e.Numero_evento, ' ', e.Nombre_evento), c.cuenta, c.clabe, c.banco, e.solicita, o.tipo, o.tipo_pago
 FROM odc o, eventos e, clientes c where o.evento=e.id_evento and o.a_nombre=c.Nombre and o.id_odc=".$id;
if ($result = $mysqli->query($sql)) {
    

    while ($row = $result->fetch_row()) {
        $a_nombre = $row[0];
        $concepto = $row[1];
        $servicio = $row[2];
        $importe  = $row[3];
        $letra  = $row[4];
        $fecha_sol  = $row[5];
        $fecha_pago  = $row[6];
        $factura = $row[7];
        $fecha = $row[8];
        $evento = $row[9];
        $cuenta = $row[10];
        $clabe = $row[11];
        $banco = $row[12];
        $arr=explode("&",$row[13]);
        $nombre_solicita = $arr[1];
        $tipo=$row[14];
        $tipo_pago=$row[15];
    }

    $result->close();
}
else{
    echo "Error MySql: ".$mysqli->error;
    exit();
}

//exit();
//

//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.
//$total = number_format($total,',','.','.');

//Create a new PDF file
$pdf=new FPDF();
$pdf->AddPage();
// Logo
    $pdf->Image('img/logo.png',20,8,20);
    // Times bold 15
    $pdf->SetFont('Times','B',25);
    // Movernos a la derecha
    $pdf->Cell(45);
    // Título
    $pdf->SetFillColor(193,220,80);
    $pdf->SetTextColor(155,155,155);
    $pdf->Cell(0,20,'SOLICITUD DE VIATICOS',0,0,'C',true);
    $pdf->SetTextColor(0,0,0);
    $pdf->Ln(22);
    $pdf->SetFont('Times','',12);
    $pdf->SetX(135);
    $pdf->Cell(0,6,'No. Folio:',0,0,'L',false);
    $pdf->SetFont('Times','B',14);
    $pdf->SetX(160);
    $pdf->Rect(155, 37,18, 0, 'D');
    $pdf->Cell(0,6,'7',0,0,'L',false);

    // Salto de línea
    $pdf->Ln(7);
    $pdf->Cell(0,7,'',0,0,'C',true); 
    
    $pdf->Ln(9);
    $pdf->SetX(60);
    $pdf->SetFont('Times','',12);
    if($tipo=="Normal"){
        $pdf->Image('img/check.png',83,47,5);  //check normal
    }
    else if($tipo=="Urgente"){
        $pdf->Image('img/check.png',147,47,5);  //check urgente
    }    
    $pdf->Cell(20,6,'Normal',0,0,'L',false);
    $pdf->Cell(10,5,'',1,0,'C');
    $pdf->SetX(123);
    $pdf->Cell(20,6,'Urgente',0,0,'L',false);
    $pdf->SetX(143);
    $pdf->Cell(10,5,'',1,0,'C');

    $pdf->Ln(7);
    $pdf->Cell(0,7,'',0,0,'C',true); 

    $pdf->Ln(10);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(60);

    $pdf->Cell(20,6,'Importe:  $',0,0,'L',false);
    $pdf->SetX(85);
    $pdf->SetFont('Times','I',12);
    //$pdf->Cell(20,6,'5,000.00',0,0,'L',false);
    $pdf->Rect(85, 71,60, 0, 'D'); // importe
    $pdf->Cell(20,6,number_format($importe, 2),0,1,'L',false);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(40);
    $pdf->Cell(20,6,"Importe con letra: ",0,0,'L',false);
    $pdf->SetFont('Times','I',8);
    $pdf->SetX(84);
    $pdf->Rect(85, 76,115, 0, 'D');// importe con letra
    $pdf->Rect(85, 83,22, 0, 'D'); // fecha solicitud
    $pdf->Rect(155, 83,22, 0, 'D'); // fecha pago
    $pdf->Rect(85, 90,115, 0, 'D'); // a nombre de
    $pdf->Rect(85, 97,115, 0, 'D'); // concepto
    $pdf->Rect(85, 104,115, 0, 'D'); // evento
    $pdf->Rect(85, 111,115, 0, 'D'); // servicio
    $pdf->Rect(85, 137,20, 0, 'D'); // docto soporte fiscal
    $pdf->Rect(143, 137,20, 0, 'D'); // fecha
    $pdf->Rect(55, 160,50, 0, 'D'); // cuenta
    $pdf->Rect(55, 168,50, 0, 'D'); // clabe
    $pdf->Rect(55, 176,100, 0, 'D'); // banco
    $pdf->Rect(55, 184,100, 0, 'D'); // a nombre de
    $pdf->Cell(20,6,$letra,0,1,'L',false);
    
    $pdf->Ln(1);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(38);
    $pdf->Cell(20,6,"Fecha de solicitud: ",0,0,'L',false);
    $pdf->SetX(115);
    $pdf->Cell(20,6,"Fecha de pago: ",0,0,'L',false);
    $pdf->SetX(85);
    $pdf->SetFont('Times','I',11);
    $pdf->Cell(20,6,$fecha_sol,0,0,'L',false);
    $pdf->SetX(155);
    $pdf->Cell(20,6,$fecha_pago,0,1,'L',false);
    $pdf->SetFont('Times','',15);
    $pdf->Ln(1);
    $pdf->SetX(49);
    $pdf->Cell(20,6,"A nombre de: ",0,0,'L',false);
    $pdf->SetX(85);
    $pdf->SetFont('Times','I',11);
    $pdf->Cell(20,6,$a_nombre,0,1,'L',false);
    $pdf->Ln(1);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(56);
    $pdf->Cell(20,6,"Concepto: ",0,0,'L',false);
    $pdf->SetFont('Times','I',11);
    $pdf->SetX(85);
    $pdf->Cell(20,6,strtoupper($concepto),0,1,'L',false);
    $pdf->Ln(1);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(61);
    $pdf->Cell(20,6,"Evento: ",0,0,'L',false);
    $pdf->SetX(85);
    $pdf->SetFont('Times','I',11);
    $pdf->Cell(20,6,strtoupper(utf8_decode($evento)),0,1,'L',false);
    $pdf->Ln(1);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(59);
    $pdf->Cell(20,6,"Servicio: ",0,0,'L',false);
    $pdf->SetX(85);
    $pdf->SetFont('Times','I',11);
    $pdf->Cell(20,6,strtoupper($servicio),0,1,'L',false);
    $pdf->Ln(7);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(40);
    $pdf->Cell(20,6,"Anticipo",0,0,'L',false);
    $pdf->SetX(80);
    $pdf->Cell(40,6,"Pago Total",0,0,'L',false);
    $pdf->SetX(125);
    $pdf->Cell(60,6,"Pago Final",0,0,'L',false);
    $pdf->SetX(85);
    $pdf->SetFont('Times','B',12);
    $pdf->SetX(61);
    $pdf->Cell(10,5,'',1,0,'C');
    $pdf->SetX(105);
    $pdf->Cell(10,5,'',1,0,'C');
    $pdf->SetX(150);
    $pdf->Cell(10,5,'',1,1,'C');
    if($tipo_pago="Anticipo"){
        $pdf->Image('img/check.png',65,119,5);  //check anticipo
    }
    else if($tipo_pago="Pago Total"){
        $pdf->Image('img/check.png',108,119,5);  //check pago total
    }
    else if($tipo_pago="Pago Final"){
        $pdf->Image('img/check.png',108,119,5);  //check pago total
    }
    //$pdf->Image('img/check.png',153,119,5);  //check pago final
    $pdf->Ln(7);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(36);
    $pdf->Cell(20,6,"Doc. soporte fiscal: ",0,0,'L',false);
    $pdf->SetX(85);
    $pdf->SetFont('Times','I',11);
    $pdf->Cell(20,6,$factura,0,0,'C',false);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(125);
    $pdf->Cell(20,6,"Fecha: ",0,0,'L',false);
    $pdf->SetFont('Times','I',11);
    $pdf->SetX(142);
    $pdf->Cell(20,6,$fecha,0,1,'C',false);
    $pdf->Ln(10);
    $pdf->SetFont('Times','B',16);
    $pdf->SetX(15);
    $pdf->Cell(20,6,"Depositar en: ",0,1,'L',false);
    $pdf->Ln(2);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(36);
    $pdf->Cell(20,6,"Cuenta: ",0,0,'L',false);
    $pdf->SetFont('Times','I',11);
    $pdf->SetX(55);
    $pdf->Cell(20,6,$cuenta,0,1,'L',false);
    $pdf->Ln(2);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(37);
    $pdf->Cell(20,6,"Clabe: ",0,0,'C',false);
    $pdf->SetFont('Times','I',11);
    $pdf->SetX(55);
    $pdf->Cell(20,6,$clabe,0,1,'L',false);
    $pdf->Ln(2);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(36);
    $pdf->Cell(20,6,"Banco: ",0,0,'C',false);
    $pdf->SetFont('Times','I',11);
    $pdf->SetX(55);
    $pdf->Cell(20,6,$banco,0,1,'L',false);
    $pdf->Ln(2);
    $pdf->SetFont('Times','',15);
    $pdf->SetX(29);
    $pdf->Cell(20,6,"A nombre de: ",0,0,'C',false);
    $pdf->SetFont('Times','I',11);
    $pdf->SetX(55);
    $pdf->Cell(20,6,$a_nombre,0,1,'L',false);
    //cuadritos de firmas
    
    $pdf->Ln(50);
    $pdf->Rect(15, 234,40, 0, 'D'); // firma solicitante
    $pdf->Rect(60, 234,40, 0, 'D'); // firma jefe inmediato
    $pdf->Rect(105, 234,40, 0, 'D'); // firma dir gral
    $pdf->Rect(150, 234,40, 0, 'D'); // firma finanzas
    $pdf->Rect(12, 205,182, 55, 'D'); // cuadro
                                    
    $pdf->SetFont('Times','',15);
    $pdf->SetX(15);
    $pdf->Cell(40,6,"Solicitante",0,0,'C', false);
    
    $pdf->SetX(60);
    $pdf->Cell(40,6,"Jefe Inmediato",0,0,'C', false);
    
    $pdf->SetX(105);
    $pdf->Cell(40,6,utf8_decode("Dirección General"),0,0,'C', false);

     $pdf->SetX(150);
    $pdf->Cell(40,6,"Finanzas",0,0,'C', false);
    
    $pdf->Ln(6);
    $pdf->SetFont('Times','I',11);
    $pdf->SetX(15);
    $pdf->MultiCell(40,6,utf8_decode($nombre_solicita),0,'C', false);
    // Posición: a 1,5 cm del final
    $pdf->SetY(265);
    $pdf->SetFont('Arial','I',7);
    $pdf->SetX(10);
    // Número de página
    $pdf->Cell(0,10,'Fecha impresion: '.$d."/".$m."/".$y,0,0,'R');
    

    //$pdf->MultiCell(101, 4, utf8_decode("Producto alimenticio de alto valor nutricional, excelente para deportistas"), 1, 'L');
    
  
$pdf->Output('D',$evento.".pdf",true);
?>
