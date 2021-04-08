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
  
  <link rel="stylesheet" href="css/animate.css"/>
  <link rel="stylesheet" href="css/sweetalert2.css"/>  
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap.min6.css">
  <link rel="stylesheet" href="css/estilos_ver_0006.css"/>
  <link rel="stylesheet" href="css/chosen.css"/>
  <link rel="stylesheet" href="css/dataTables.css"/>
  <link rel="stylesheet" href="css/data_tables.css">

  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
  
  <script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
  
  <script src="js/jquery-1.11.2.js"></script>
  <script src="js/jquery-ui-v1.11.4.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.ui.shake.js"></script>    
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.mousewheel.pack.js"></script>
  <script src="js/dataTables.js"></script>
  <script src='js/DateTables.js'></script>
  <script src="js/jquery.fancybox.js"></script>
  
  <script src="js/dataTables.buttons.min.js"></script>
  <script src="js/buttons.flash.min.js"></script>
  <script src="js/jszip.min.js"></script>
  <script src="js/pdfmake.min.js"></script>
  <script src="js/vfs_fonts.js"></script>
  <script src="js/buttons.html5.min.js"></script>
  <script src="js/buttons.print.min.js"></script>
  <script src="js/jspdf.min.js"></script>
  <script src="js/jquery.modal.js"></script>
  <script src="https://kit.fontawesome.com/9b26aa506d.js" crossorigin="anonymous"></script>
  <script src="js/sweetalert2.min.js"></script>
  <script src="js/metodos_reporte_facturacion.js?v=<?php echo(rand()); ?>"></script>
  <script>
      $(document).on("ready",inicio); 
  </script>

</head>
<body style='background-color: rgba(255,2552,255,0) !important;background:none !important;'>
   
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div id='div_reporte_eventos'>
                  <div class="col-md-12" class='titulo_reporte'><legend><h2><i class="fas fa-hand-holding-usd"></i> CxC - Reporte de facturas pendientes por cobrar <i class="fas fa-spinner fa-spin"></i></h2></legend></div>
                  <hr>
                  <div class="clearfix">
                    <p><br></p>
                    </div>
                    <p><br></p>
                  <table id='reporte_facturacion' class="table dataTable">
                  </table>
              </div>
        </div>
    </div>
    
    
</body>
</html>



