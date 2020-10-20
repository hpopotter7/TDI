<!DOCTYPE html>
<html lang="es">
<head>
  <title>ERP Tierra de ideas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="stylesheet" href="css/jquery.fancybox.css" />
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/animate.css"/>
  <link rel="stylesheet" href="css/sweetalert2.css"/>  
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap.min6.css">
  <link rel="stylesheet" href="css/estilos_ver_0005.css"/>
  <link rel="stylesheet" href="css/bootstrap-multiselect_001.css"/>
  <link rel="stylesheet" href="css/chosen.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="js/jquery-ui-v1.11.4.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/core.js"></script>
  <script src="js/sweetalert2.min.js"></script>
  <script src="js/animate.js"></script>
  <script src="js/noty/packaged/jquery.noty.packaged.js"></script>
  <script src="js/jquery.mousewheel.pack.js"></script> 
  <script src="js/bootstrap-multiselect.js"></script>
  <script src="js/DateTables.js" ></script>
  <script src="js/chosen.jquery.js" ></script>
  <script src="https://kit.fontawesome.com/9b26aa506d.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  
  <script src="js/dataTables.buttons.min.js"></script>
  <script src="js/buttons.flash.min.js"></script>
  <script src="js/jszip.min.js"></script>
  <script src="js/pdfmake.min.js"></script>
  <script src="js/vfs_fonts.js"></script>
  <script src="js/buttons.html5.min.js"></script>
  <script src="js/buttons.print.min.js"></script>
  <script src="js/jspdf.min.js"></script>
  <script src="js/jquery.modal.js"></script>
  
  <script src="js/metodos_gastos.js"></script>
    <script>
     $(document).on("ready",inicio);  
    </script>

</head>
<body style='background-color: rgba(255,2552,255,0) !important;background:none !important;'>
    <div class="container" style="width:98%; margin-left: 30px !important;">
        <h2>Reporte de facturación</h2>
        <hr>
        <div class="row">
        <?php 
        set_time_limit(900);
            include("conexion.php");
            if ($mysqli->connect_error) {
                die('Error de conexión: ' . mysqli_error($mysqli));
                exit();
            }
            function moneda($value) {
                return '$' . number_format($value, 2);
            }


            $tabla="<table class='table table-bordered'>
            <thead class='thead-dark'>
            <tr>
            <th>ID</th>
            <th># Factura</th>
            <th>Cliente</th>
            <th>Descripción</th>
            <th>Fecha facturacion</th>
            <th>Monto total</th>
            </tr></thead><tbody>";

           
            $arreglo_cliente=Array();

            $result = $mysqli->query("SET NAMES 'utf8'");
            $sql="select id_cliente, Razon_Social from clientes where estatus='activo' order by Razon_social";

            if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $id_cliente=$row['id_cliente'];
                    $nombre_cliente=$row['Razon_Social'];
                    $cliente=$id_cliente."&".$nombre_cliente;
                    array_push($arreglo_cliente,$cliente);
                }
                    $result->close();
                }
            else{
                echo mysqli_error($mysqli);
                exit();
            }

            $eventos_cliente=Array();
            
            for($r=0;$r<=count($arreglo_cliente)-1;$r++){
                $sql="select id_evento from eventos where cliente='".$arreglo_cliente[$r]."' and estatus='ABIERTO'";
                if ($result = $mysqli->query($sql)) {
                    while ($row = $result->fetch_assoc()) {
                        $id_evento=$row['id_evento'];
                        array_push($eventos_cliente,$id_evento);
                    }
                        $result->close();
                    }
                else{
                    echo mysqli_error($mysqli);
                    exit();
                }
                $solicitudes_cliente=Array();
                for($t=0;$t<=count($eventos_cliente)-1;$t++){
                    $sql="select id_solicitud, id_evento, No_factura, DATE_FORMAT(Fecha_hora_registro, '%d/%m/%Y') as Fecha from solicitud_factura where estatus='Activa' and Estatus_factura!='PAGADO' and id_evento=".$eventos_cliente[$t];
                    if ($result = $mysqli->query($sql)) {
                        while ($row = $result->fetch_assoc()) {
                            $id_solicitud=$row['id_solicitud'];
                            $num_factura=$row['No_factura'];
                            $fecha=$row['Fecha'];
                            $tabla=$tabla."<tr><td>".$num_factura."</td><td>".$$arreglo_cliente[$r]."</td><td>Descripcion</td><td>".$fecha."</td><td>$total</td></tr>";
                        }
                            $result->close();
                        }
                    else{
                        echo mysqli_error($mysqli);
                        exit();
                    }
                }


            }





           
/*
            if ($result = $mysqli->query($sql)) {
                while ($row = $result->fetch_assoc()) {
                    $id_solicitud=$row['id_solicitud'];
                    $id_evento=$row['id_evento'];
                    $numero_evento=$row['Numero_evento'];
                    $nombre_evento=$row['nombre_evento'];
                    $num_factura=$row['No_factura'];
                    $cliente=$row['cliente'];
                    $descripcion=$row['descripcion'];
                    $total=$row['total'];
                    $fecha_factura=$row['Fecha_factura'];
                   
                    if($bandera_cliente!=$cliente){
                        if($cont==0){
                            $cont=1;
                        }
                        else{
                            $tabla=$tabla."<tr style='background-color:rgba(77,118,85,0.33)'><th colspan='5' style='text-align:right;'>Importe total:</th><th>".moneda($importe_total)."</th></tr>";
                        }
                        $tabla=$tabla."<tr style='background-color:rgba(77,118,85,0.63)'><th colspan='6'>".$cliente."</th></tr>";     
                        $importe_total=0;                   
                    }
                    $importe_total=$importe_total+$total;
                    $tabla=$tabla."<tr><td>".$id_solicitud."</td><td>".$num_factura."</td><td>".$cliente."</td><td>".$descripcion."</td><td>".$fecha_factura."</td><td>".moneda($total)."</td></tr>";
                    $bandera_cliente=$cliente;
                    }
                $result->close();
                }
            else{
                $res =mysqli_error($mysqli);
            }*/        




            $tabla=$tabla."</tbody>";
            echo $tabla;
            $mysqli->close();
            ?>
    </div>
</div>

</body>
</html>