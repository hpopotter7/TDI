<?php
$tipo="";
    if(isset($_GET['tipo'])){
        $tipo=$_GET['tipo'];
    }
    else{
        header('Location:solicitud.php?tipo=P');        
    }
    if($tipo=="P"){
        $titulo="pago";
    }
    else if($tipo=="V"){
        $titulo="viáticos";
    }
    else if($tipo=="R"){
        $titulo="reembolso";
    }    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/sweetalert2.css"/>
    <link href="plugins/notification/noty.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-select/bootstrap-select.min.css">
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />    
    
    <link rel="stylesheet" href="css/chosen.css"/>    
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/jquery-ui_theme_green.css"/>
    <link rel="stylesheet" href="css/jquery-ui_green.css"/>

    
    <!-- BEGIN PAGE LEVEL STYLES -->
    <!--  <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"> -->

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">-->
    <script src="js/sweetalert2.min.js"></script>

    
    <!-- END PAGE LEVEL STYLES --> 
</head>
<body style='background-color: rgba(255,255,255,.6) !important;'>
    <div id="content" class="main-content" style="margin-top:10px;width: 90% !important; margin-left: 10px !important;background-color: rgba(255,255,255,.0) !important;">
    <input type="hidden" id='tipo_odc' value='<?php echo $tipo;?>'>
        <div class="row">
            <div class="col-md-9"><h2>Solicitud de <?php echo $titulo;?> </h2></div>
        </div> 

          <div class="row">
            <div class="form-group col-md-8 ">
              <label for="name" class="cols-sm-2 control-label">Evento</label>
                  <select name="" id="c_numero_evento" class='form-control' >
                  </select>
            </div>
            <div class="form-group col-md-2 ">
            <label for="name" class="cols-sm-2 control-label">Monto máximo</label>
            <span id='badge_monto' class='badge badge-success' style='display:none'><h4 id='label_maximo_odc' style='color:white;'></h4></span>
            </div>
            <div class="form-group col-md-1">
              <!-- <div class="checkbox">
                <label>
                  <input id='check_tipo_sol' name='check_tipo_sol' type="checkbox" data-toggle="toggle" data-height="50" data-width="100" data-onstyle="success" data-on="Normal" data-off="Urgente" data-offstyle="warning">
                </label>
              </div> -->
              <div class="form-group">
                <label for="">Tipo</label>
                <select class="selectpicker" name="c_tipo" id="c_tipo">
                  <option value='Normal'>Normal</option>
                  <option value='Urgente'>Urgente</option>
                </select>
              </div>
            </div>
             <!-- <div class="form-group col-md-1">
              <div class="checkbox">
                <label>Normal</label>
              </div>
            </div> -->
          </div>    

          <div class="row">
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Fecha de solicitud</label>
                <input type="text" id="f_solicitud" class="form-control fecha" readonly="" disabled="">
            </div>
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Fecha de pago</label>
                <input type="text" id="f_pago" class="form-control fecha" readonly="">
            </div>
             <div class="form-group col-md-4 ">
              <label for="name" class="cols-sm-2 control-label" >Importe <small>(Solo importe numérico)</small><img id="puntos_gif" src="img/puntos.gif" alt=""></label>
                  <input id='odc_cheque_por' data-toggle="tooltips" data-placement="top" title="Ingresa solo importe numérico" placeholder='0.00' type="textbox" class='form-control moneda'/>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-12">
                <label for="username" id='odc_label_letra' class="cols-sm-2 control-label text-right float-right"></label>
             </div>
          </div>

          <div class="row">
             <div id='div_tipo_reembolso' class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Tipo</label>
                  <select name="" id="c_tipo_reembolso" class='form-control' >
                    <option value="MA. FERNANDA CARRERA HDZ">Cheque</option>
                    <option value="TARJETA SODEXO">Tarjeta SODEXO</option>
                    <option value="TARJETA DILIGO">Tarjeta DILIGO</option>
                  </select>
            </div>
            <div class="form-group col-md-8" id='div_mensaje' style='margin-top:27px !important;'>
                  <span id="txt_nota" class="badge badge-secondary"><h5 style='color:#fff;padding:0px 70px'>El cheque saldrá a nombre de Ma. Fernanda Carrera</h5></span>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label id='label_a_nombre' for="username" class="cols-sm-2 control-label">A nombre</label>
                  <select name="" id="c_a_nombre" class='form-control' >

                  </select>
               <div class="row user_proveedor" style="display: none;padding: 0.2em 1em;color: white;"><i><span id="usuario_proveedor" class='badge badge-secondary'></span></i>
                <input type="hidden" id='id_usuario_proveedor' value='0'>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Concepto</label>
                  <input type="text" id="txt_concepto" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Servicio</label>
                  <input type="text" id="txt_servicios" class="form-control">
            </div>
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Otros</label>
                  <input type="text" id="txt_otros" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-2" style='margin-top: 30px;'>
              <!-- <div class="radio">
                <label>
                  <input type="radio" name="check_tipo_pago" class="tipo_pago fas fa-o fa-2x" value="Anticipo">
                  <span class="label_check ">Anticipo</span>
                </label>
              </div> -->
            <div class="custom-control custom-radio" >
                <input type="radio" id="customRadio1" name="check_tipo_pago" value="Anticipo" class="tipo_pago custom-control-input">
                <label class="custom-control-label" for="customRadio1"><h3>Anticipo</h3></label>
            </div>
            </div>
            <div class="form-group col-md-3" style='margin-top: 30px;'>
              <!-- <div class="radio">
                <label>
                  <input type="radio" name="check_tipo_pago" class="tipo_pago fa fa-o fa-2x" value="Pago Total">
                  <span class="label_check ">Pago Total</span>
                </label>
              </div> -->
                <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio3" name="check_tipo_pago" value="Pago Total" class="tipo_pago custom-control-input">
                    <label class="custom-control-label" for="customRadio3"><h3>Pago Total</h3></label>
                </div>
            </div>
            <div class="form-group col-md-3" style='margin-top: 30px;'>
              <!-- <div class="radio">
                <label>
                  <input type="radio" name="check_tipo_pago" class="tipo_pago fa fa-o fa-2x" value="Pago Final">
                  <span class="label_check ">Pago Final</span>
                </label>
              </div> -->
              <div class="custom-control custom-radio">
                    <input type="radio" id="customRadio2" name="check_tipo_pago" value="Pago Final" class="tipo_pago custom-control-input">
                    <label class="custom-control-label" for="customRadio2"><h3>Pago Final</h3></label>
                </div>
            </div>
            <div class="form-group col-md-4" id='div_forma_pago'>
              <label for="username" class="cols-sm-2 control-label">Forma de pago</label>
                  <select name="" id="c_forma_de_pago" class='form-control' >
                  </select>
            </div>
          </div>

          <div class="row">
             <div class="form-group col-md-3">
              <label for="username" class="cols-sm-2 control-label">Uso de CFDI</label>
                  <select name="" id="c_CFDI" class='form-control' >
                    <option value="vacio">Selecciona...</option>
                    <option value='G01'>Adquisición de mercancias</option>
                    <option value='G02'>Devoluciones, descuentos o bonificaciones</option>
                    <option value='G03'>Gastos en general</option>
                    <option value='I03'>Equipo de transporte</option>
                    <option value='I04'>Equipo de computo y accesorios</option>
                    <option value='I08'>Otra maquinaria y equipo</option>
                    <option value='D04'>Donativos.</option>
                    <option value='P01'>Por definir</option>
                  </select>
            </div>
            <div class="form-group col-md-3">
              <label for="username" class="cols-sm-2 control-label">Metodo de Pago</label>
                  <select class='form-control' id ='combo_metodo_pago' name="combo_metodo_pago">
                    <option value="vacio">Selecciona...</option>
                    <option value='PPD'>Pago en parcialidades o diferido</option>
                    <option value='PUE'>Pago en una sola exhibición</option>
                  </select>
            </div>
            <div class="form-group col-md-3">
              <label for="username" class="cols-sm-2 control-label">#Factura</label>
                  <input type="text" id="txt_docto_soporte" class="form-control">
            </div>
            <div class="form-group col-md-3">
              <label for="username" class="cols-sm-2 control-label">Fecha</label>
                  <input type="text" id="odc_fecha" class="form-control">
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Solicitante</label>
                  <select  id="c_user_solicita" name="c_user_solicita" class="form-control" ></select>
            </div>
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Ejecutivo de cuenta</label>
                  <select name="txt_project" id="txt_project" class='form-control'></select>
            </div>
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Director de área</label>
                  <select id="c_coordinador" name="c_coordinador" class="form-control" >
                  </select>
            </div>
          </div>

          <div class="row">
            <div class="form-group col-md-4">
              <label class="cols-sm-2 control-label">Vo.Bo. Compras/RH</label>
                  <select name="txt_vobo_compras" id="txt_vobo_compras" class='form-control'>                    
                  </select>
            </div>
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Dirección</label>
                  <select  id="c_autorizo" name="c_autorizo" class="form-control" >
                  </select>
            </div>
            
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Finanzas</label>
                  <select  id="c_finanzas" name="c_finanzas" class="form-control disabled" disabled="disabled" >
                  </select>
          </div>  
        
          <div class="form-row mb-4 " style='width:100%; margin-bottom:30px'>
            <div class="col-6">
                <button type="button" id="enviar_odc" class="btn btn-lg btn-success float-right"><i class="fas fa-envelope" aria-hidden="true"></i> Enviar Solicitud</button>
            </div>
            <div class="col">
            <button type="button" id="limpiar_cliente" class="abajo btn btn-lg btn-info"><i class="i_espacio fa fa-eraser" aria-hidden="true"></i> Limpiar</button>
            </div>
          </div>
          <div class="row"><p><br></p></div>
        
       
    
    <!--  END CONTENT AREA  -->

<!-- END MAIN CONTAINER -->
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
<script src="js/jquery-1.11.2.js"></script>
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
    <script src="plugins/notification/noty.js"></script>
    <script src="js/chosen.jquery.js" ></script>
    <script src="js/jquery.formatCurrency.js"></script>
    <script src="js/cantidad_letra.js"></script>
    <script src="js/datepicker.js"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="assets/js/scrollspyNav.js"></script>
    
    <script src="js/solicitudes.js"></script>
    <script>
         $(document).on("ready",inicio); 
    </script>
    
</body>
</html>