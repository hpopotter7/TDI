
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <!-- <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    
    <link rel="stylesheet" href="css/sweetalert2.css"/>
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-select/bootstrap-select.min.css">
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/cards/cards.css" rel="stylesheet"/> -->

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/sweetalert2.css"/>
    <link href="assets/css/elements/tooltip.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    
    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-select/bootstrap-select.min.css">
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/cards/card.css" rel="stylesheet" type="text/css" />
    
    <!-- BEGIN PAGE LEVEL STYLES -->
    <style>
        i{
            margin-left:5px;
        }
    </style>
    <link href="plugins/notification/noty.css" rel="stylesheet">
    <script src="js/sweetalert2.min.js"></script>

    
    <!-- END PAGE LEVEL STYLES --> 
</head>
<body style='background-color: rgba(0,0,0,.0) !important;'>

<div id="content" class="main-content" style="margin-top:10px;width: 90% !important; margin: 0 auto !important;background-color: rgba(0,0,0,.0) ">
<div class="row">
  <div class="col-md-3"><h2>Solicitud de factura</h2></div>
  <div class="col-md-3"><h4><span id='label_titulo' class='badge badge-warning'></span></h4></div>
</div>
    <div class="row">
      <div class="col-md-6">
        <div class="form-group">
          <label for="">Cliente</label>
          <select name="c_clientes_factura" id="c_clientes_factura" class="form-control" required="required">
          <?php 
            include("conexion.php");
            if (mysqli_connect_errno()) {
                printf("Error de conexion: %s\n", mysqli_connect_error());
                exit();
            }

            $result = $mysqli->query("SET NAMES 'utf8'");
            $res='<option value="">Selecciona un cliente...</option>';
            if ($result = $mysqli->query("SELECT id_cliente, Razon_Social FROM clientes where Numero_cliente!='0' and estatus='activo' order by Razon_Social asc")) {
                while ($row = $result->fetch_row()) {
                    if($row[1]=="GASTO"){
                        if($_COOKIE['user']=="SANDRA PEÑA" || $_COOKIE['user']=="ALAN SANDOVAL"){
                            $res=$res."<option value='".$row[0]."'>".$row[1]."</option>";
                        }
                    }
                    else{
                        $res=$res."<option value='".$row[0]."'>".$row[1]."</option>";
                    }
                }
                $result->close();
            }
            echo $res;
            $mysqli->close();
            ?>
          </select>
          
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <label for="">Eventos</label>
          <select name="c_evento_cliente" id="c_evento_cliente" class="form-control" required="required"></select>
        </div>
      </div>
    </div>
    <section id='sec_datos_factura'>
    <div class="row">
      <div class="col-md-4" id='datos_cliente' style="margin-top: 15px;">
      </div>      
      <div class="col-md-8" style="margin-top: 15px;">
        <div class="row">
        <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">Días de crédito</label>
          <div class="cols-sm-12">
            <div class="input-group">
              <span class="input-group-addon"></span>
              <input type="text" id="txt_dias_credito" name="txt_dias_credito" class="form-control" required>
            </div>
          </div>
        </div>
         <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">Núm de pedido<small id="helpId" class="text-muted"><i>(Solo si aplica)</i></small></label>
          <div class="cols-sm-12">
            <div class="input-group">
              <span class="input-group-addon"></span>
              <input type="text" id="txt_num_pedido" name="txt_num_pedido" class="form-control" value='0' >
            </div>
          </div>
        </div>
         <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">Núm de entrada<small id="helpId" class="text-muted"><i>(Solo si aplica)</i></small></label>
          <div class="cols-sm-12">
            <div class="input-group">
              <span class="input-group-addon"></span>
              <input type="text" id="txt_num_entrada" name="txt_num_entrada" class="form-control" value='0' >
            </div>
          </div>
        </div>
        </div>
        <div class="row" style="margin-top: 30px;">
          <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">Orden de compra<small id="helpId" class="text-muted"><i>(Solo si aplica)</i></small></label>
          <div class="cols-sm-12">
            <div class="input-group">
              <span class="input-group-addon"></span>
              <input type="text" id="txt_orden_compra" name="txt_orden_compra" class="form-control" value='0'>
            </div>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">GR<small id="helpId" class="text-muted"><i>(Solo si aplica)</i></small></label>
          <div class="cols-sm-12">
            <div class="input-group">
              <span class="input-group-addon"></span>
              <input type="text" id="txt_gr" name="txt_gr" class="form-control" value='0'>
            </div>
          </div>
        </div>
        
          <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">Empresa que factura</label>
            <div class="cols-sm-12">
              <div class="input-group">
                <span class="input-group-addon"></span>
                <select name="c_empresa_factura" id="c_empresa_factura" class="form-control" required="required">
                <option value="TDI">TIERRA DE IDEAS</option>
                <option value="SHIATSUS">SHIATSUS</option>
                <option value="COMITIVA">COMITIVA</option>
              </select>
              </div>
            </div>
          </div>        
        </div>      
      </div>
  </div>  
    <hr>
    <h2> Partidas</h2>
    <div class="row">
      <div class="col-md-4" style='margin-left:15px'>
        <div class="form-group">
          <label for="">Concepto de servicio</label>
          <input type="text" name="txt_concepto_partida" id="txt_concepto_partida" class="form-control" placeholder="" aria-describedby="helpId">
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="">Precio unitario</label>
          <!-- <input type="text" name="" id="" class="form-control" placeholder="" aria-describedby="helpId"> -->
          
          <input id='txt_precio_unitario' name='txt_precio_unitario' type="text" class="form-control" data-toggle="tooltip" data-placement="top" title="Ingresa solo importe numérico" placeholder='0.00' />
          
        </div>
      </div>
      <div class="col-md-2">
        <div class="form-group">
          <label for="">Moneda</label>
          <select name="c_moneda" id="c_moneda" class='form-control'>
            <option value="MXN">$ MXN</option>
            <option value="USD">$ USD</option>
            <option value="EUR">Є EUR</option>
          </select>
        </div>
      </div>
      <div class="col-md-1 clearfix"></div>
      <div class="col-md-1">
          <button type="button" id="btn_add_partida" class="btn btn-primary text-center" style='margin-top:35px'><i class="fas fa-plus"></i></button>
      </div>
      <div class="col-md-1">
          <button type="button" id='btn_quitar' class="btn btn-danger text-center" style='margin-top:35px'><i class="fas fa-trash"></i></button>
      </div>
    </div>
    <div class="row col-md-12">
    <table id='tabla_partidas' class="table " style= "width:100%">
        <thead style='background-color:#ffb366'>
            <tr>
                <th>Concepto</th>
                <th>Precio Unitario</th>
                <th>IVA</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody></tbody>
         <tfoot>
            <tr style="background-color: #E8E6E6">
                <th style="text-align: right;"> Σ Totales</th>
                <th id='sumatoria_pu'>$0.00</th>
                <th id='sumatoria_iva'>$0.00</th>
                <th id='sumatoria_total'>$0.00</th>
            </tr>
        </tfoot>
      </table>
  </div>

  <div class="row">
  <div class="col-md-4" style='margin-left:15px'>
  <div class="row">
    <div class="form-group" style='width:100%'>
          <label for="">Correo para envío de factura</label>
          <input id='txt_correo_1' name='txt_correo_1' type="text" class="form-control" placeholder="Correo 1" required />
          <input id='txt_correo_2' name='txt_correo_2' type="text" class="form-control" placeholder="Correo 2" />
          <input id='txt_correo_3' name='txt_correo_3' type="text" class="form-control" placeholder="Correo 3" />
          <input id='txt_correo_4' name='txt_correo_4' type="text" class="form-control" placeholder="Correo 4" />
          <input id='txt_correo_5' name='txt_correo_5' type="text" class="form-control" placeholder="Correo 5" />
        </div>
      </div>
  </div>     
     <div class="form-group col-md-4">
      <label for="name" class="cols-sm-2 control-label">Observaciones</label>
        <div class="cols-sm-10">
        <div class="input-grsoup">
          <textarea name="area_observaciones" id="area_observaciones" class="form-control" rows="8" style='resize: none;;font-size: .9em' placeholder="Observaciones"></textarea>
        </div>
      </div>
    </div>

    <div class="form-group col-md-3" style='padding-top: 35px;'>
      <button type="submit" id="btn_solicitar_factura" class="btn btn-lg btn-success" style='width:100%'><i class="fab fa-gg"></i> Solicitar factura</button>
      <button type="button" id="btn_limpiar" class="btn btn-lg btn-info" style='margin-top: 90px;width:100%'><i class="fas fa-eraser"></i> Limpiar</button>
    </div>
  </div>
  
  </div> <!-- esto es -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="plugins/highlight/highlight.pack.js"></script>
  
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script src="plugins/notification/noty.js" type="text/javascript"></script>
    <!-- <script src="plugins/input-mask/jquery.inputmask.bundle.min.js"></script> -->
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.flash.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>

    <script src="assets/js/elements/tooltip.js"></script>
    <script src="js/accounting.js"></script>
    <!-- <script src="plugins/input-mask/input-mask.js"></script> -->
    <script src="js/facturas2.js?v=<?php echo(rand()); ?>" type="text/javascript"></script>
    <script>
    $.fn.dataTable.Api.register( 'column().data().sum()', function () {
      return this.reduce( function (a, b) {
        var x = parseFloat( a ) || 0;
        var y = parseFloat( b ) || 0;
        return x + y;
      } );
    } );
  </script> 
    <script>
        $(document).on("ready",inicio); 
    </script>
    </body>
    </html>