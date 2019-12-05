
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

if($titulo=="ODC"){
    $titulo="PAGO";
}

//Connect to your database
include("conexion.php");

//Select the Products you want to show in your PDF file


$result = $mysqli->query("SET NAMES 'utf8'");
    $codigo="TDITF07";
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
    $evento = "";
    $tipo="";
    $tipo_pago="";
    $ID2=0;
    
if($id==0){
        $sql="select max(id_odc) from odc";
    if ($result = $mysqli->query($sql)) {
         while ($row = $result->fetch_row()) {
            $id=$row[0];
            
        }
    }    
} 
$sql="select EVENTO from odc where id_odc=".$id;
if ($result = $mysqli->query($sql)) {
         while ($row = $result->fetch_row()) {
            
            $ID2=$row[0];
        }
    }   
$CLIENTE="";
$sql="SELECT Cliente from eventos where Numero_evento='".$ID2."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $CLIENTE=$row[0];
    }
}


if(strpos($CLIENTE, '&')){
    $arr=explode("&",$CLIENTE);
    $CLIENTE=$arr[1];
}

    $sql="SELECT o.a_nombre, o.concepto, o.servicio, o.cheque_por, o.letra, DATE_FORMAT(o.fecha_solicitud,'%d/%m/%Y'), DATE_FORMAT(o.fecha_pago, '%d/%m/%Y'), o.factura, DATE_FORMAT(o.fecha, '%d/%m/%Y'),  CONCAT('".$ID2."', ' ".$CLIENTE." - ', e.Nombre_evento), c.cuenta, c.clabe, c.banco, o.tipo, o.tipo_pago, DATE_FORMAT(e.inicio_evento ,'%d/%m/%Y'), DATE_FORMAT(e.fin_evento,'%d/%m/%Y'), o.otros, o.cfdi, o.metodo_pago, c.metodo_pago, c.nombre_contacto, c.correo_contacto, c.sucursal, c.Numero_cliente, o.solicito, o.finanzas, o.usuario_registra, o.autorizo, o.Forma_pago, o.identificador, o.no_cheque, o.Compras, o.Coordinador, o.Project, o.Tipo_tarjeta, o.No_tarjeta FROM odc o LEFT JOIN proveedores c on o.a_nombre=c.Razon_Social left join eventos e on o.evento=e.Numero_evento where o.id_odc=".$id;

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
        $tipo=$row[13];
        $tipo_pago=$row[14];
        $inicio_evento=$row[15];
        $fin_evento=$row[16];
        $otros=$row[17];
        $cfdi=$row[18];
        $metodo=$row[19];
        $metodo_pago=$row[20];
        $nombre_contacto=$row[21];
        $correo_contacto=$row[22];
        $sucursal=$row[23];
        $no_prov=$row[24];
        $solicito=$row[25];
        $finanzas=$row[26];
        $elaborado=$row[27];
        $autorizo=$row[28];
        $FORMA_DE_PAGO=$row[29];
        $identificador=$row[30];
        $no_cheque=$row[31];
        $compras=$row[32];
        $coordinador=$row[33];
        $project=$row[34];
        $tipo_tarjeta=$row[35];
        $numero_tarjeta=$row[36];
    }

    $result->close();
}
else{
    echo "Error MySql: ".$sql." ".mysqli_error($mysqli);
    exit();
}
//cortamos el nombre del evento
$pruebaevento=$evento;
if(strlen($evento)>55){
        $evento=substr($evento, 0,55);
    }

    
//Convert the Total Price to a number with (.) for thousands, and (,) for decimals.
//$total = number_format($total,',','.','.');

//Create a new PDF file
$pdf=new FPDF();
$pdf->AddPage();
$pdf->AddFont('Gotham','','Gotham-Book.php');
$pdf->AddFont('Gotham_Italic','','Gotham-BookItalic.php');
$pdf->AddFont('Gotham_M','','Gotham-Medium.php');
$pdf->SetMargins(5, 5 ,10);



if($tipo_tarjeta=="TARJETA BANCOMER" || $tipo_tarjeta=="Tarjeta BANCOMER"){
        $banco=$a_nombre;
        $a_nombre="BBVA BANCOMER SA DE CV";
}
else if($tipo_tarjeta=="TARJETA DILIGO" || $tipo_tarjeta=="Tarjeta DILIGO"){
    $banco=$a_nombre;
    $a_nombre="TARJETA DILIGO";
}
else if($tipo_tarjeta=="TARJETA SODEXO" || $tipo_tarjeta=="Tarjeta SODEXO"){
    $banco=$a_nombre;
    $a_nombre="TARJETA SODEXO";
}
else if($tipo_tarjeta=="CHEQUE" || $tipo_tarjeta=="MA. FERNANDA CARRERA HDZ"){
    $banco=$a_nombre;
    $a_nombre="MA. FERNANDA CARRERA HDZ";
}
// Logo
    //$pdf->Image('img/logo.png',20,8,20);
    // Gotham bold 15
    $pdf->SetFont('Gotham','',25);
    // Movernos a la derecha

    // Título
    //$pdf->SetFillColor(193,220,80);
    $pdf->SetFillColor(255,230,153);
    $pdf->SetTextColor(155,155,155);
    $pdf->Cell(0,1,utf8_decode('Solicitud de '.$identificador),0,0,'C',false);
    $pdf->SetTextColor(0,0,0);
    $pdf->Ln(5);
    $pdf->SetFont('Gotham','',12);
    $pdf->Ln(4);
    $pdf->SetX(135);
    $pdf->Cell(0,7,utf8_decode('Número de solicitud:'),0,0,'L',false);
    $pdf->SetX(180);
    $pdf->Cell(0,6,'','B',0,'L',true);
    // Salto de línea
    $pdf->Ln(7);
    $pdf->SetX(5);
    $pdf->SetFillColor(193,220,80);
    $pdf->Cell(0,3,'',0,0,'C',true); 
    
    $pdf->Ln(5);
    $pdf->SetX(21.5);
    $pdf->SetFont('Gotham','',12);
    $pdf->SetFillColor(255,230,153);
    $im=number_format($importe, 2);
    $pdf->Cell(0,6,"Cheque por:",0,0,'L',false);
    $pdf->SetX(50);
    $pdf->SetFont('Arial','I',12);
    $pdf->Cell(45,5,'$ '.$im,0,0,'C',true);
    $pdf->SetX(105);
    $pdf->SetFont('Gotham','',12);
    $pdf->Cell(25,6,"Normal",0,0,'C',false);
    $pdf->SetX(162);
    $pdf->Cell(25,6,"Urgente",0,0,'C',false);
    if($tipo=="Normal"){
        $pdf->SetX(127);
        $pdf->Cell(10,5,"X",0,0,'C',true);
        $pdf->SetX(185);
        $pdf->Cell(10,5,"",0,0,'C',true);
    }
    else{
        $pdf->SetX(127);
        $pdf->Cell(10,5,"",0,0,'C',true);
        $pdf->SetX(185);
        $pdf->Cell(10,5,"X",0,0,'C',true);
    }
    
    
   //salto de linea
    $pdf->Ln(7);
    $pdf->Cell(0,6,"Importe con letra:",0,0,'L',false);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham_Italic','',8);
    $pdf->Cell(145,5,$letra,0,0,'C',true);
    $pdf->SetFont('Gotham','',12);
    //salto de linea
    $pdf->Ln(7);
    $pdf->SetX(8);
    $pdf->Cell(0,6,"Fecha de solicitud:",0,0,'L',false);
    $pdf->SetX(50);
    $pdf->Cell(45,5,$fecha_sol,0,0,'C',true);
    $pdf->SetX(110);
    $pdf->Cell(60,6,"Fecha de pago:",0,0,'L',false);
    $pdf->SetX(145);
    $pdf->Cell(50,5,$fecha_pago,0,0,'C',true);

    //salto de linea
    $pdf->Ln(7);
    $pdf->SetX(25);
    $pdf->Cell(0,6,"A nombre:",0,0,'L',false);
    $pdf->SetX(50);
    $pdf->SetFont('Gotham','',10);
    if(strlen($a_nombre)>37){
        if(strlen($a_nombre)>53){
            $a_nombre=substr($a_nombre, 0,53);
        }
        $pdf->SetFont('Gotham','',8);
    }

    $pdf->Cell(105,5,utf8_decode($a_nombre),0,0,'C',true);
    $pdf->SetFont('Gotham','',12);
    $pdf->SetX(155);
    $pdf->Cell(0,6,"No:",0,0,'L',false);
    $pdf->SetX(165);
    $pdf->Cell(30,5,$no_prov,0,0,'C',true);
    //salto de linea
    $pdf->Ln(7);
    $pdf->SetX(25.3);
    $pdf->Cell(0,6,"Concepto:",0, 0,'L',false);
    $pdf->SetX(50);
    $pdf->MultiCell(145,5,utf8_decode($concepto),0,'C',true);
    //salto de linea
    $pdf->Ln(1);
    $pdf->SetX(31);
    $pdf->Cell(0,15,"Evento:",0,0,'L',false);
    //$pdf->SetX(50);
    $pdf->SetXY(50,71);
    $pdf->MultiCell(145,5,utf8_decode($pruebaevento),0,'C', true);
    //$pdf->Cell(145,5,utf8_decode($evento),0,0,'C',true);
    //salto de linea
    $pdf->Ln(2);
    $pdf->SetX(7.5);
    $pdf->Cell(0,6,"Fechas del evento:",0,0,'L',false);
    $pdf->SetX(50);
    $pdf->Cell(145,5,utf8_decode("Inicio: ". $inicio_evento."          Término: ".$fin_evento),0,0,'C',true);
    //salto de linea
    $pdf->Ln(7);
    $pdf->SetX(29);
    $pdf->Cell(0,6,"Servicio:",0,0,'L',false);
    $pdf->SetX(50);
    $pdf->Cell(145,5,utf8_decode($servicio),0,0,'C',true);
    //salto de linea
    $pdf->Ln(7);
    $pdf->SetX(28);
    $pdf->Cell(0,6,"Anticipo:",0,0,'L',false);
    $pdf->SetX(85);
    $pdf->Cell(40,5,"Pago Total:",0,0,'C',false);
    $pdf->SetX(153);
    $pdf->Cell(40,5,"Finiquito:",0,0,'C',false);
    if ($tipo_pago=="Anticipo") {
        $pdf->SetX(50);
        $pdf->Cell(10,5,"X",0,0,'C',true);
        $pdf->SetX(120);
        $pdf->Cell(10,5," ",0,0,'C',true);
        $pdf->SetX(185);
        $pdf->Cell(10,5," ",0,0,'C',true);
    }
    elseif ($tipo_pago=="Pago Total") {
        $pdf->SetX(50);
        $pdf->Cell(10,5," ",0,0,'C',true);
        $pdf->SetX(120);
        $pdf->Cell(10,5,"X",0,0,'C',true);
        $pdf->SetX(185);
        $pdf->Cell(10,5," ",0,0,'C',true);
    }
    else{
        $pdf->SetX(50);
        $pdf->Cell(10,5," ",0,0,'C',true);
        $pdf->SetX(120);
        $pdf->Cell(10,5," ",0,0,'C',true);
        $pdf->SetX(185);
        $pdf->Cell(10,5,"X",0,0,'C',true);
    }
   
     //salto de linea
    $pdf->Ln(10);
    $pdf->SetX(5);
    $pdf->SetFont('Gotham_M','',12);
    $pdf->Cell(0,6,"Soporte Fiscal:",0,0,'L',false);
    $pdf->SetFont('Gotham','',12);
     //salto de linea
    $pdf->Ln(7);
    $pdf->SetX(29);
    $pdf->Cell(30,6,utf8_decode("Número:"),0,0,'L',false);
    $pdf->SetX(50);
    $pdf->Cell(75,5,$factura,0,0,'C',true);
    $pdf->SetX(130);
    $pdf->Cell(10,5,"Fecha:",0,0,'C',false);
    $pdf->SetX(145);
    $pdf->Cell(50,5,$fecha,0,0,'C',true);
    //salto de linea
    $pdf->SetFont('Gotham','',12);
    $pdf->Ln(7);
    $pdf->SetX(19);
    $pdf->Cell(0,6,"Uso de CFDI:",0,0,'L',false);
    $pdf->SetX(50);
    $pdf->Cell(50,5,$cfdi,0,0,'C',true);
    $pdf->SetX(105);
    $pdf->Cell(0,6,"Metodo de pago:",0,0,'L',false);
    $pdf->SetX(145);
    $pdf->Cell(50,5,$metodo,0,0,'C',true);
    //salto de linea
    $pdf->Ln(7);
    if($FORMA_DE_PAGO=="NA"){
        $FORMA_DE_PAGO=$metodo_pago;
    }
    $pdf->SetX(13);
    $pdf->Cell(0,6,"Forma de pago:",0,0,'L',false);
    $pdf->SetX(50);
    $pdf->Cell(145,5,$FORMA_DE_PAGO,0,0,'C',true);
     //salto de linea
    
     $pdf->Ln(7);
    $pdf->SetX(33);
    $pdf->Cell(0,6,"Otros: ",0,0,'L',false);
    $pdf->SetX(50);
     $pdf->Cell(145,5,utf8_decode($otros),0,0,'C',true);
     //salto de linea
    
     $pdf->Ln(7);
    $pdf->SetX(18);
    $pdf->Cell(0,6,"# de cheque: ",0,0,'L',false);
    $pdf->SetX(50);
     $pdf->Cell(40,5,$no_cheque,'B',0,'C',true);
    
     //salto de linea
    $pdf->Ln(10);
    $pdf->SetX(5);
    $pdf->SetFont('Gotham_M','',12);
    $pdf->Cell(0,6,"Enviar a:",0,0,'L',false);
    $pdf->SetFont('Gotham','',12);
    //salto de linea
    $pdf->Ln(7);
    $pdf->Cell(0,6,"Contacto proveedor:",0,0,'L',false);
    $pdf->SetX(55);
    $pdf->SetFont('Gotham','',11);
    $pdf->Cell(140,5,utf8_decode($nombre_contacto),0,0,'C',true);
    $pdf->SetFont('Gotham','',12);
    //salto de linea
    $pdf->Ln(7);
    $pdf->SetX(39);
    $pdf->Cell(0,6,"Mail:",0,0,'L',false);
    $pdf->SetX(55);
    $pdf->Cell(140,5,strtolower($correo_contacto),0,0,'C',true);

//salto de linea
    $pdf->Ln(10);
    $pdf->SetX(5);
    $pdf->SetFont('Gotham_M','',12);
    $pdf->Cell(0,6,"Datos deposito:",0,0,'L',false);
    $pdf->SetFont('Gotham','',12);
    //salto de linea
    $pdf->Ln(7);
    $pdf->SetX(26);
    $pdf->Cell(0,6,"A nombre:",0,0,'L',false);
    $pdf->SetX(55);

    $pdf->Cell(140,5,utf8_decode($banco),0,0,'C',true);
    //salto de linea
    if($numero_tarjeta!="0"){
    $pdf->Ln(7);
    $pdf->SetX(24);
    $pdf->Cell(0,6,"No. Tarjeta:",0,0,'L',false);
    $pdf->SetX(55);
    $pdf->Cell(140,5,$numero_tarjeta,0,0,'C',true);
    }
    
    
if($identificador=="Pago" && $tipo_tarjeta=="PAGO NORMAL"){
//salto de linea
    $pdf->Ln(7);
    $pdf->SetX(29);
    $pdf->Cell(0,6,"Sucursal:",0,0,'L',false);
    $pdf->SetX(55);
    $pdf->Cell(140,5,utf8_decode($sucursal),0,0,'C',true);
    //salto de linea
    $pdf->Ln(7);
    $pdf->SetX(32);
    $pdf->Cell(0,6,"Cuenta:",0,0,'L',false);
    $pdf->SetX(55);
    $pdf->Cell(140,5,$cuenta,0,0,'C',true);
    //salto de linea
    $pdf->Ln(7);
    $pdf->SetX(6);
    $pdf->Cell(0,6,"Clabe interbancaria:",0,0,'L',false);
    $pdf->SetX(55);
    $pdf->Cell(140,5,$clabe,0,0,'C',true);
    }
    //salto de linea
    $pdf->SetFont('Gotham','',10);
    $startx=10;
    $starty=220;
    $pdf->SetXY($startx, $starty); 


/*
    echo $coordinador;
    exit();
*/

    // TODOS LOS NOMBRES ARRIBA Y LOS APELLIDOS ABAJO
    $arr=explode(" ", ($elaborado));
    $arr2=explode(" ", ($solicito));
    $arr3=explode(" ", ($finanzas));
    $arr4=explode(" ", ($autorizo));
    $arr5=explode(" ", ($compras));
    $arr6=explode(" ", ($coordinador));
    $arr7=explode(" ", ($project));

    $pdf->MultiCell(42,5,utf8_decode($arr[0])."\n".utf8_decode($arr[1]),'B','C',true);
    $startx=$startx+47.5;
    $pdf->SetXY($startx, $starty); 
    $pdf->MultiCell(42,5,utf8_decode($arr2[0])."\n".utf8_decode($arr2[1]),'B','C',true);
    $startx=$startx+47.5;
    $pdf->SetXY($startx, $starty); 
    $pdf->MultiCell(42,5,utf8_decode($arr3[0])."\n".utf8_decode($arr3[1]),'B','C',true);
    $startx=$startx+47.5;
    $pdf->SetXY($startx, $starty); 
    $pdf->MultiCell(42,5,utf8_decode($arr4[0])."\n".utf8_decode($arr4[1]),'B','C',true);
    //salto de linea
    $pdf->Ln(1);
    $pdf->SetFont('Gotham_M','',10);
    $pdf->SetX(10);
    $pdf->Cell(42,6,"Elaborado por",0,0,'C',false);
    $pdf->SetX(57);
    $pdf->Cell(42,6,utf8_decode("Solicitado por"),0,0,'C',false);
    $pdf->SetX(105);
    $pdf->MultiCell(42,6,utf8_decode("Finanzas"),0,'C',false);
    $starty=$starty+11;
    $pdf->SetXY($startx, $starty); 
    $pdf->MultiCell(42,6,utf8_decode("Dirección General"),0,'C',false);
    
    
    //lina firms 2
    $pdf->SetFont('Gotham','',10);
    $pdf->Ln(3);
    $startx=10;
    $starty=245;
    $pdf->SetXY($startx, $starty); 
    if(count($arr5)==1){
        $vacio=" ";
    }
    else{
        $vacio=$arr5[1];
    }
    $pdf->MultiCell(42,5,utf8_decode($arr5[0])."\n".utf8_decode($vacio),'B','C',true);
    $startx=$startx+47.5;
    $pdf->SetXY($startx, $starty); 
    $vacio="";
    if(count($arr7)==1){
        $vacio=" ";
    }
    else{
        $vacio=$arr7[1];
    }
    $pdf->MultiCell(42,5,utf8_decode($arr7[0])."\n".utf8_decode($vacio),'B','C',true);
    $startx=$startx+47.5;
    $pdf->SetXY($startx, $starty); 
    $vacio="";
    if(count($arr6)==1){
        $vacio=" ";
    }
    else{
        $vacio=$arr6[1];
    }
    $pdf->MultiCell(58,5,utf8_decode($arr6[0])."\n".utf8_decode($vacio),'B','C',true);
    $pdf->Ln(1);
    $pdf->SetFont('Gotham_M','',10);
    $pdf->SetX(10);
    $pdf->Cell(42,6,"Vo.Bo. Compras",0,0,'C',false);
    $pdf->SetX(63);
    $pdf->Cell(42,6,utf8_decode("Project Manager"),0,'C',false);
    $pdf->SetX(109);
    $pdf->Cell(50,6,utf8_decode("Director/Coordinador de area"),0,0,'C',false);
    
    //salto de linea
    
 //salto de linea
    $pdf->Ln(13);
    $pdf->SetFont('Arial','I',7);
    $pdf->SetX(13);
    // Número de página
    $pdf->Cell(183,5,utf8_decode('Fecha impresión: ').$d."/".$m."/".$y,0,0,'R', false);


$pdf->Output('I',$evento.".pdf",true); // I se abre en esa pagaina el pdf; D descarga
?>
