
<?php
try {
$id=$_GET['id'];

function startsWith ($string, $startString) 
{ 
    $len = strlen($startString); 
    return (substr($string, 0, $len) === $startString); 
} 

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

    $sql="SELECT o.a_nombre, o.concepto, o.servicio, o.cheque_por, o.letra, DATE_FORMAT(o.fecha_solicitud,'%d/%m/%Y'), DATE_FORMAT(o.fecha_pago, '%d/%m/%Y'), o.factura, DATE_FORMAT(o.fecha, '%d/%m/%Y'),  CONCAT('".$ID2."', ' ".$CLIENTE." - ', e.Nombre_evento), c.cuenta, c.clabe, c.banco, o.tipo, o.tipo_pago, DATE_FORMAT(e.inicio_evento ,'%d/%m/%Y'), DATE_FORMAT(e.fin_evento,'%d/%m/%Y'), o.otros, o.cfdi, o.metodo_pago, c.metodo_pago, c.nombre_contacto, c.correo_contacto, c.sucursal, c.Numero_cliente, o.solicito, o.finanzas, o.usuario_registra, o.autorizo, o.Forma_pago, o.identificador, o.no_cheque, o.Compras, o.Coordinador, o.Project, o.Tipo_tarjeta, o.No_tarjeta, o.vobo_coordinador, o.vobo_finanzas, o.vobo_compras, o.vobo_direccion, o.vobo_project, o.vobo_solicito FROM odc o LEFT JOIN proveedores c on o.a_nombre=c.Razon_Social left join eventos e on o.evento=e.Numero_evento where o.id_odc=".$id;

if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $firma_elaborado="sin";
        $firma_solicito="sin";
        $firma_project="sin";
        $firma_director="sin";
        $firma_compras="sin";
        $firma_coordinador="sin";
        $firma_finanzas="sin";
        
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
        $compras=strtoupper($row[32]);
        $coordinador=$row[33];
        $project=$row[34];
        $tipo_tarjeta=$row[35];
        $numero_tarjeta=$row[36];
        $firma_coordinador=$row[37];
        $firma_finanzas=$row[38];
        $firma_compras=$row[39];
        $firma_director=$row[40];
        $firma_project=$row[41];
        $firma_solicito=$row[42];
        $firma_elaborado=str_replace(" ", "", $elaborado);
        $contador_firmas=0;
        if($firma_coordinador==1){
            $firma_coordinador=str_replace(" ", "", $coordinador);
            $contador_firmas++;
        }
        else{
            $firma_coordinador="sin";
        }
        if($firma_finanzas==1){
            $firma_finanzas=str_replace(" ", "", $finanzas);
            $contador_firmas++;
        }
        else{
            $firma_finanzas="sin";
        }
        if($firma_compras==1){
            $firma_compras=str_replace(" ", "", $compras);
            $contador_firmas++;
        }
        else if($firma_compras==0 && $compras=="NA"){
            $firma_compras="NA";
            $contador_firmas++;
        }
        else{
            $firma_compras="sin";
        }
        if($firma_director==1){
            $firma_director=str_replace(" ", "", $autorizo);
            $contador_firmas++;
        }
        else{
            $firma_director="sin";
        }
        if($firma_project==1){
            $firma_project=str_replace(" ", "", $project);
            $contador_firmas++;
        }
        else{
            $firma_project="sin";
        }  
        if($firma_solicito==1){
            $firma_solicito=str_replace(" ", "", $solicito);
            $contador_firmas++;
        }
        else{
            $firma_solicito="sin";
        }        
            $firma_2=str_replace(" ", "", $elaborado);  

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
ob_start();
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
    $pdf->Cell(0,1,utf8_decode('Solicitud de '.$identificador.$vobo),0,0,'C',false);
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

    // TODOS LOS NOMBRES ARRIBA Y LOS APELLIDOS ABAJO
    $arr=explode(" ", ($elaborado));
    $arr2=explode(" ", ($solicito));
    $arr3=explode(" ", ($project));
    $arr4=explode(" ", ($coordinador));
    $arr5=explode(" ", ($compras));
    $arr6=explode(" ", ($finanzas));
    $arr7=explode(" ", ($autorizo));

    if($firma_elaborado==""){
        $firma_elaborado="sin";
    }
    if($firma_solicito==""){
        $firma_solicito="sin";
    }
    if($firma_finanzas==""){
        $firma_finanzas="sin";
    }
    if($firma_elaborado==""){
        $firma_elaborado="sin";
    }
    if($firma_director==""){
        $firma_director="sin";
    }
    if($firma_compras==""){
        $firma_compras="sin";
    }
    if($firma_project==""){
        $firma_project="sin";
    }
    if($firma_coordinador==""){
        $firma_coordinador="sin";
    }
    $A1_1=$arr[0];
    $A1_2=$arr[1];

    $A2_1=$arr2[0];
    $A2_2=$arr2[1];

    $A3_1=$arr3[0];
    $A3_2=$arr3[1];

    $A4_1=$arr4[0];
    $A4_2=$arr4[1];

    $A5_1=$arr5[0];
    $A5_2=$arr5[1];

    $A6_1=$arr6[0];
    $A6_2=$arr6[1];

    $A7_1=$arr7[0];
    $A7_2=$arr7[1];
    
    if($arr2[0]=="PA"){
        $A2_1="[PA] ".$arr2[1];
        $A2_2=$arr2[2];
    }
    if($arr3[0]=="PA"){
        $A3_1="[PA] ".$arr3[1];
        $A3_2=$arr3[2];
    }
    if($arr4[0]=="PA"){
        $A4_1="[PA] ".$arr4[1];
        $A4_2=$arr4[2];
    }
    if($arr5[0]=="PA"){
        $A5_1="[PA] ".$arr5[1];
        $A5_2=$arr5[2];
    }
    if($arr6[0]=="PA"){
        $A6_1="[PA] ".$arr6[1];
        $A6_2=$arr6[2];
    }
    if($arr7[0]=="PA"){
        $A7_1="[PA] ".$arr7[1];
        $A7_2=$arr7[2];
    }

    if($elaborado=="JUAN CARLOS GARCIA"){
        $A1_1="JUAN CARLOS";
        $A1_2="GARCIA";
    }
    if($elaborado=="PA JUAN CARLOS GARCIA"){
        $A1_1="[PA] JUAN";
        $A1_2="CARLOS GARCIA";
    }
    if($solicito=="JUAN CARLOS GARCIA"){
        $A2_1="JUAN CARLOS";
        $A2_2="GARCIA";
    }
    if($solicito=="PA JUAN CARLOS GARCIA"){
        $A2_1="[PA] JUAN";
        $A2_2="CARLOS GARCIA";
    }
    if($project=="JUAN CARLOS GARCIA"){
        $A3_1="JUAN CARLOS";
        $A3_2="GARCIA";
    }
    if($project=="PA JUAN CARLOS GARCIA"){
        $A3_1="[PA] JUAN";
        $A3_2="CARLOS GARCIA";
    }
    if($coordinador=="JUAN CARLOS GARCIA"){
        $A4_1="JUAN CARLOS";
        $A4_2="GARCIA";
    }
    if($coordinador=="PA JUAN CARLOS GARCIA"){
        $A4_1="[PA] JUAN";
        $A4_2="CARLOS GARCIA";
    }

    if(startsWith($elaborado,"PA ") && $firma_elaborado!="sin"){
        $firma_elaborado=substr($firma_elaborado,3,strlen($firma_elaborado));
    }
    if(startsWith($solicito,"PA ") && $firma_solicito!="sin"){
        $firma_solicito=str_replace("PA ", "", $solicito);
        $firma_solicito=str_replace(" ", "", $firma_solicito);
    }
    if(startsWith($project,"PA ") && $firma_project!="sin"){
        $firma_project=str_replace("PA ", "", $project);
        $firma_project=str_replace(" ", "", $firma_project);
    }
    if(startsWith($coordinador,"PA ") && $firma_coordinador!="sin"){
        $firma_coordinador=str_replace("PA ", "", $coordinador);
        $firma_coordinador=str_replace(" ", "", $firma_coordinador);
    }
    if(startsWith($compras,"PA ") && $firma_compras!="sin"){
        $firma_compras=str_replace("PA ", "", $compras);
        $firma_compras=str_replace(" ", "", $firma_compras);
    }
    if(startsWith($autorizo,"PA ") && $firma_director!="sin"){
        $firma_director=str_replace("PA ", "", $autorizo);
        $firma_director=str_replace(" ", "", $firma_director);
    }
    if(startsWith($finanzas,"PA ") && $firma_finanzas!="sin"){
        $firma_finanzas=str_replace("PA ", "", $finanzas);
        $firma_finanzas=str_replace(" ", "", $firma_finanzas);
        
    }

    

    $pdf->MultiCell(42,5,utf8_decode($A1_1)."\n".utf8_decode($A1_2),'B','C',true);
    $pdf->Image('firmas/'.$firma_elaborado.'.png' , $startx ,$starty-5, 30 , 20,'png');
    $startx=$startx+47.5;
    $pdf->SetXY($startx, $starty); 
    $pdf->MultiCell(42,5,utf8_decode($A2_1)."\n".utf8_decode($A2_2),'B','C',true);
    $pdf->Image('firmas/'.$firma_solicito.'.png' , $startx ,$starty-5, 30 , 20,'png');
    $startx=$startx+47.5;
    $pdf->SetXY($startx, $starty); 
    $pdf->MultiCell(42,5,utf8_decode($A3_1)."\n".utf8_decode($A3_2),'B','C',true);
    $pdf->Image('firmas/'.$firma_project.'.png' , $startx ,$starty-5, 30 , 20,'png');
    $startx=$startx+47.5;
    $pdf->SetXY($startx, $starty); 
    $pdf->MultiCell(42,5,utf8_decode($A4_1)."\n".utf8_decode($A4_2),'B','C',true);
    $pdf->Image('firmas/'.$firma_coordinador.'.png' , $startx ,$starty-5, 30 , 20,'png');
    //salto de linea
    $firma1=$starty;
    $pdf->Ln(1);
    $pdf->SetFont('Gotham_M','',10);
    $pdf->SetX(10);
    $pdf->Cell(42,6,"Elaborado por",0,0,'C',false);
    $pdf->SetX(57);
    $pdf->Cell(42,6,utf8_decode("Solicitado por"),0,0,'C',false);
    
    $pdf->SetX(105);
    $pdf->MultiCell(42,6,utf8_decode("Ejecutivo de cuenta"),0,'C',false);
    $starty=$starty+11;
    $pdf->SetXY($startx, $starty); 
    $pdf->MultiCell(42,6,utf8_decode("Director de área"),0,'C',false);
    $firma2=$starty;
    
    //lina firms 2
    $pdf->SetFont('Gotham','',10);
    $pdf->Ln(3);
    $startx=10;
    $starty=245;
    $pdf->SetXY($startx, $starty); 
    /*
    if(count($arr5)==1){
        $vacio=" ";
    }
    else{
        $vacio=$arr5[1];
    }
    */
    
    $pdf->MultiCell(42,5,utf8_decode($A5_1)."\n".utf8_decode($A5_2),'B','C',true);
    if($compras!="NA"){
        $pdf->Image('firmas/'.$firma_compras.'.png' , $startx ,$starty-5, 30 , 20,'png');
    }
    $startx=$startx+47.5;
    $pdf->SetXY($startx, $starty); 
    $vacio="";
    /*
    if(count($arr7)==1){
        $vacio=" ";
    }
    else{
        $vacio=$arr7[1];
    }
    */
    $pdf->MultiCell(42,5,utf8_decode($A7_1)."\n".utf8_decode($A7_2),'B','C',true);
    $pdf->Image('firmas/'.$firma_director.'.png' , $startx ,$starty-5,40 , 20,'png');
    $startx=$startx+47.5;
    $pdf->SetXY($startx, $starty); 
    $vacio="";
    /*
    if(count($arr6)==1){
        $vacio=" ";
    }
    else{
        $vacio=$arr6[1];
    }
    */
    $pdf->MultiCell(42,5,utf8_decode($A6_1)."\n".utf8_decode($A6_2),'B','C',true);
    $pdf->Image('firmas/'.$firma_finanzas.'.png' , $startx ,$starty-5, 30 , 20,'png');
    $pdf->Ln(1);
    $pdf->SetFont('Gotham_M','',10);
    $pdf->SetX(10);
    $pdf->Cell(42,6,"Compras",0,0,'C',false);
    $pdf->SetX(62);
    $pdf->Cell(42,6,utf8_decode("Dirección General"),0,'C',false);
    $pdf->SetX(100);
    $pdf->Cell(52,6,utf8_decode("Finanzas"),0,0,'C',false);
    
    //salto de linea
        
    
 //salto de linea
    $pdf->Ln(13);
    $pdf->SetFont('Arial','I',7);
    $pdf->SetX(13);
    // Número de página
    $pdf->Cell(183,5,utf8_decode('Fecha impresión: ').$d."/".$m."/".$y,0,0,'R', false);
    if($contador_firmas<6){
        $pdf->Image('img/invalida.png' , 0 ,0, 200 , 320,'png');
    }
    $pdf->Output('I',$evento.".pdf",false); // I se abre en esa pagaina el pdf; D descarga
ob_end_flush();
} catch (Exception $e) {
    echo 'Excepción capturada: ',  $e->getMessage(), "\n";
}
?>
