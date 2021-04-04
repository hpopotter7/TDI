<?php
$evento="0";
if(isset($_GET['evento'])){
  $evento=$_GET['evento'];
}
if(strpos($evento, "-")){
  include("conexion.php");
if (mysqli_connect_errno()) {
    printf("Error de conexion: %s\n", mysqli_connect_error());
    exit();
}
$result = $mysqli->query("SET NAMES 'utf8'");
$sql="SELECT id_evento FROM eventos where Numero_evento='".$evento."'";
if ($result = $mysqli->query($sql)) {
    while ($row = $result->fetch_row()) {
        $evento=$row[0];
    }
    $result->close();
}
$mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <title>ERP Tierra de ideas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <!--<link rel="stylesheet" href="css/sweetalert2.css"/>-->
    <link href="plugins/notification/noty.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-select/bootstrap-select.min.css">
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />    
    <link rel="stylesheet" href="css/chosen.css"/>      
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">

    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
    
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
 <style>
   .table tbody tr td{
     font-size: 11px !important;
   }   
     .normal {
    transform: scale(1);
    -webkit-transform: scale(1);
    -webkit-transform-origin: 0 0;
    -moz-transform: scale(1);
    -moz-transform-origin: 0 0;
    -o-transform: scale(1);
    -o-transform-origin: 0 0;
    -ms-transform: scale(1);
    -ms-transform-origin: 0 0;
}
  .z95 {
    transform: scale(.95);
    -webkit-transform: scale(.95);
    -webkit-transform-origin: 0 0;
    -moz-transform: scale(.95);
    -moz-transform-origin: 0 0;
    -o-transform: scale(.95);
    -o-transform-origin: 0 0;
    -ms-transform: scale(.95);
    -ms-transform-origin: 0 0;
}
  .z90 {
    transform: scale(.90);
    -webkit-transform: scale(.90);
    -webkit-transform-origin: 0 0;
    -moz-transform: scale(.90);
    -moz-transform-origin: 0 0;
    -o-transform: scale(.90);
    -o-transform-origin: 0 0;
    -ms-transform: scale(.90);
    -ms-transform-origin: 0 0;
} 
.z85 {
    transform: scale(.85);
    -webkit-transform: scale(.85);
    -webkit-transform-origin: 0 0;
    -moz-transform: scale(.85);
    -moz-transform-origin: 0 0;
    -o-transform: scale(.85);
    -o-transform-origin: 0 0;
    -ms-transform: scale(.85);
    -ms-transform-origin: 0 0;
} 
.z80 {
    transform: scale(.80);
    -webkit-transform: scale(.80);
    -webkit-transform-origin: 0 0;
    -moz-transform: scale(.80);
    -moz-transform-origin: 0 0;
    -o-transform: scale(.80);
    -o-transform-origin: 0 0;
    -ms-transform: scale(.80);
    -ms-transform-origin: 0 0;
}

</style>
</head>

<body class='normal' style='background-color: rgba(255,255,255,.3) !important;background:none !important;font-size:12px !important;overflow:auto'>

<input type="hidden" id='txt_evento' value='<?php echo $evento;?>'>
	<div style="width:100% !important;;margin: auto;">
       <!--  <section style="padding:10px; top:0;position: fixed;width: 99%;background: white; z-index: 20; min-height:100px;border-bottom: 3px black dotted;"> -->
        <!-- <section style="width: 99%;background: rgba(255,255,255,.3);"> -->
            <h2>Ver solicitudes por evento</h2>
           <!--  <button id='btn_zoom'>zoom</button> -->
            <div class="row">
                <div class="form-group col-md-8">
                <label for="">Evento</label>
                <select name="c_mis_eventos" id="c_mis_eventos" class="form-control" placeholder='Ingresa un evento'></select>
                </div>
                <div class="form-group col-md-3" style='margin-top:32px'>
                <div class="btn-group">
                    <button type="button" class=" form-control btn btn-lg btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acciones <i class="fas fa-caret-down    "></i>
                    </button>
                    <div class="dropdown-menu">
                        <button type='button' class="dropdown-item class" id='btn_sin_factura'> <i style='color:#e2a03f' class="fas fa-exclamation-circle"></i> Eventos pendientes</button>
                        <button type='button' class="dropdown-item" id='btn_transferir'> <i style='color:#1b55e2' class="fas fa-exchange-alt"></i> Transferir</button>
                        <button type='button' class="dropdown-item" id='btn_borrar_sdp'> <i style='color:#e7515a' class="fas fa-trash"></i> Borrar</button>
                                                 <!-- <button type='button' class="dropdown-item" id='btn_zoom'> <i style='color:#a045f3' class="fas fa-search-plus"></i> Ajustar zoom</button> -->
                        <small id="helpId" class="text-muted">Ajustar zoom <output id='range_valor'> 100%</output></small>
                        <input type="range" id='zoom' step="0.5" min="8" max="10" value='10' class="form-control-range">
                    </div>
                    </div>
                </div>
            </div>
        <div class="row">
        <div id="div_filtro_solicitudes" class="form-group col-md-3" >
                  <label for="">Filtro</label>
                  <select name="c_filtro_solicitudes" id="c_filtro_solicitudes" class='selectpicker' >
                  <option value='0'>Todos</option>
                  <option value='Pagados'>No pagados</option>
                  <option value='Comprobados'>No comprobados</option>
                  </select>
                  <img id="puntos_gif" src="img/puntos.gif" alt="">
            </div>
        </div>
       <!--  </section> -->
        <div class="row normal" id='resultado_solicitudes' style='background-color:rgba(255,255,255,.3);width:96%;margin-left:5px'> 
        </div>
        <!-- <div class="row" id='espacio' >
            <canvas id="myChart" height="75" width="75"></canvas>
            <span></span>
        </div> -->
	</div>

    <!-- <div id="modal_demo" class="modal">
  <div contenteditable="true" id='mensaje_demo'>
   
  </div>
</div> -->

<div id="modal_demo" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Archivos</h5>
        <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id='mensaje_demo'>
      </div>
    </div>
  </div>
</div>


    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!--<script src="assets/js/libs/jquery-3.1.1.min.js"></script>-->
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script> -->
    <!-- <script src="assets/js/custom.js"></script> -->
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <!-- 
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js"></script>
    
    <script src="js/buttons.flash.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="js/jspdf.min.js"></script> -->
    <!-- <script src='https://code.jquery.com/jquery-3.5.1.js'></script> -->
    
    <script src='https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js'></script>
    <script src='https://cdn.datatables.net/buttons/1.7.0/js/buttons.colVis.min.js'></script>
    <script src="js/buttons.flash.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="js/jspdf.min.js"></script>

    <script src="plugins/notification/noty.js"></script>
    <script src="js/chosen.jquery.js" ></script>
    <script src="js/jquery.formatCurrency.js"></script>
    <script src="js/cantidad_letra.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="js/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/emn178/chartjs-plugin-labels/src/chartjs-plugin-labels.js"></script>
    <script src="js/ver_solicitudes.js?v=<?php echo(rand()); ?>"></script>
    <script>
         $(document).on("ready",inicio); 
    </script>
	</body>
</htm>