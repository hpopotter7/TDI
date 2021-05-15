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
  <link rel="stylesheet" href="css/estilos_ver_0006.css"/>
  <link rel="stylesheet" href="css/chosen.css"/>
  <link rel="stylesheet" href="css/dataTables.css"/>
  
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css"/>
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css"> -->

  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
  
  <script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
  
  <script src="js/jquery-ui-v1.11.4.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/core.js"></script>
  <script src="js/animate.js"></script>
  <script src="js/jquery_validator.js"></script>
  <script src="js/noty/packaged/jquery.noty.packaged.js"></script>
  <script src="js/jquery.mousewheel.pack.js"></script> 
  <script src="js/chosen.jquery.js" ></script>
  <script src="js/sweetalert2.min.js"></script>
  <!-- <script src="js/dataTables.js" ></script> -->
  <script src="https://kit.fontawesome.com/9b26aa506d.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
  <!-- <script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script> -->
  
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
  
  <script src="js/metodos_buscar_gasto2.js?v=<?php echo(rand()); ?>"></script>
    <script>
     $(document).on("ready",inicio);  
    </script>

</head>
<body style='background-color: rgba(255,2552,255,0) !important;background:none !important;'>
    <div class="container" style='width: 95%;'>
            <h2>Busqueda de gastos</h2>
            <form id='form_buscar' method="POST" action="buscar_gasto.php">
            <div class="col-md-4">
            <label class="cols-sm-2 control-label">Campo a buscar</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <select id="c_campo" name='c_campo' class="form-control">
                    <option value="vacio">Selecciona un campo...</option>
                    <option value="evento">Numero de evento</option>
                    <option value="fecha_solicitud">Fecha de solicitud</option>
                    <option value="a_nombre">Proveedor</option>
                    <option value="concepto">Concepto</option>
                    <option value="servicio">Servicio</option>
                    <option value="otros">Otros</option>
                    <option value="Factura">Factura</option>
                    <option value="solicito">Solicita</option>
                    <option value="Importe_total">Importe total</option>
                    </select>
                <!--<input type="text" name="txt_campo" id="txt_campo" class="form-control">-->
            </div>
            </div>
            <div class="col-md-4">
            <label class="cols-sm-2 control-label">Valor a buscar</label>
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                <input type="text" name="txt_valor" id="txt_valor" class="form-control">
            </div>
            </div>

            <div class="col-md-2">
                <label class="cols-sm-2 control-label">Filtro</label>
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                    <select id="c_filtro" name='c_filtro' class="form-control">
                        <option value="Todos">Todos</option>
                        <option value="Listos">Listos</option>
                        <option value="Pagados">Pagados</option>
                        <option value="Comprobados">Comprobados</option>
                        <option value="np">No Pagados</option>
                        <option value="nc">No Comprobados</option>
                        <option value="Pendientes">Pendientes</option>
                        </select>
                </div>
            </div>
            <div class="col-md-1">
                <p></p><br>
                <button type="submit" class="btn btn-success float-right">Buscar</button>
            </div>


            <p><br></p>
            <!-- <div class="col-md-12">
                <div class="col-md-2 float-right pull-right">
                    <p></p><br><p></p><label class="cols-sm-2 control-label">Filtro</label>
                    <button type="submit" class="btn btn-success float-right">Buscar</button>
                    <p><br></p>
                </div>
            </div> -->
            </form>
            <div class="row"></div>
            <div class="clearfix">
                <div class="float-left">
                    
                </div>
                <div class="float-right">
                    
                </div>
            </div>
            <div class='row col-md-11'>
                <table class='table' id='tabla'>
                   
                            
                </table>
            </div>
            
        </div>
</body>
</html>



