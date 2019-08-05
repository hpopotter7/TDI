<?php
$id=$_GET['id'];
if($id==0){
        $sql="select max(id_solicitud) from solicitud_factura";
    if ($result = $mysqli->query($sql)) {
         while ($row = $result->fetch_row()) {
            $id=$row[0];
        }
    }    
} 
//require('morepagestable.php');
//include("conexion.php");
//$pdf = new PDF();
 //$pdf->SetFillColor(187,211,42);
/*
$pdf->AddFont('Gotham','','Gotham-Book.php');
$pdf->AddFont('Gotham_Italic','','Gotham-BookItalic.php');
$pdf->AddFont('Gotham_M','','Gotham-Medium.php');
$pdf->SetFont('Gotham_M','',16);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Gotham_M','',10);*/
    $pdf->Cell(105, 5, utf8_decode("Descripción"),1,0,'C',true);
    $pdf->Cell(30, 5, "Precio",1,0,'C',true);
    $pdf->Cell(25, 5, "IVA",1,0,'C',true);
    $pdf->Cell(30, 5, "Total",1,0,'C',true);
    $pdf->Ln(5);
 $pdf->SetFont('Gotham','',9);
$pdf->tablewidths = array(105, 30, 25, 30);
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT * from partidas where id_sol_factura=".$id;
$PU=0;
$IVA=0;
$TOTAL=0;
if ($result = $mysqli->query($sql)) {
     while ($row = $result->fetch_row()) {
       $pu="$".number_format($row[2],2);
       $iva="$".number_format($row[3],2);
       $total="$".number_format($row[4],2);
       $data[] = array(utf8_decode($row[1]),$pu,$iva,$total);
       $PU=$PU+$row[2];
       $IVA=$IVA+$row[3];
       $TOTAL=$TOTAL+$row[4];
     }
    $result->close();
}
	$data[] = array("TOTALES:","$".number_format($PU,2),"$".number_format($IVA,2),"$".number_format($TOTAL,2));
	$pdf->morepagestable($data);

    $pdf->Ln(5);
    $pdf->SetFont('Gotham_M','',12);
    $pdf->SetX(7);
    $pdf->Cell(40,5,utf8_decode('Observaciones:'),0,0,'C',false);
    $pdf->Ln(5);
    $pdf->SetFont('Gotham','',8);
    $observaciones="";
    $sql="SELECT Observaciones from solicitud_factura where id_solicitud=".$id;
    if ($result = $mysqli->query($sql)) {
	     while ($row = $result->fetch_row()) {
	     	$observaciones=$row[0];
	     }
	 }
	 
    $pdf->MultiCell(190, 4, utf8_decode($observaciones),1,"J");
    //$pdf->Ln(8);
    $pdf->SetFont('Gotham_M','',12);
    $pdf->Cell(70, 25, utf8_decode('Correos para envio de factura:'),1,0,'L',true);
    $pdf->SetFont('Gotham','',10);
    $pdf->Cell(120, 5, utf8_decode($correo1), 1,"J");
    $pdf->Ln(5);
    $pdf->SetX(80);
    $pdf->Cell(120, 5, utf8_decode($correo2), 1,"J");
    $pdf->Ln(5);
    $pdf->SetX(80);
    $pdf->Cell(120, 5, utf8_decode($correo3), 1,"J");
    $pdf->Ln(5);
    $pdf->SetX(80);
    $pdf->Cell(120, 5, utf8_decode($correo4), 1,"J");
    $pdf->Ln(5);
    $pdf->SetX(80);
    $pdf->Cell(120, 5, utf8_decode($correo5), 1,"J");
    $pdf->Ln(5);

    $arr_usuario=explode(" ", $usuario_registra);
    $nom=utf8_decode($arr_usuario[0]);
    $ap=utf8_decode($arr_usuario[1]);
    $startx=45;
    $starty=260;
    $pdf->SetXY($startx, $starty); 
    $pdf->MultiCell(40, 5, $nom."\n".$ap, 'B','C', false);


    $startx=135;
    $starty=260;
    $pdf->SetXY($startx, $starty); 
    $pdf->MultiCell(40, 5, utf8_decode("\n\n"), 'B','C', false);
    $pdf->Ln(0);
    $pdf->SetX(45);
    $pdf->Cell(40,10,utf8_decode('Solicitó'),0,0,'C',false);
    $pdf->SetX(135);
    $pdf->Cell(40,10,utf8_decode('Recibió SDF'),0,0,'C',false);


    
 //salto de linea
    $pdf->Ln(9);
    $pdf->SetFont('Arial','I',7);
    $pdf->SetX(7);
    $pdf->isFinished = true;
    // Número de página
    $pdf->Cell(50,10,utf8_decode('Fecha solicitud: ').$fecha_solicitud,0,0,'c', false);
    $pdf->Cell(145,10,utf8_decode('Fecha impresión: ').$d."/".$m."/".$y,0,0,'R', false);
$pdf->Output('I',$evento.".pdf",true);
?>
