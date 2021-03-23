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
  <link rel="stylesheet" href="css/animate.css"/>
  <link rel="stylesheet" href="css/bootstrap.toogle.min_v001.css" >
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap.min6.css">
  <link rel="stylesheet" href="css/estilos_ver_0006.css"/>
  <link rel="stylesheet" href="css/bootstrap-multiselect_001.css"/>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="css/sweetalert2.css"/>
  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
  <link rel="stylesheet" href="css/chosen.css"/>
  <link href="plugins/notification/noty.css" rel="stylesheet">
  <script src="plugins/notification/noty.js" type="text/javascript"></script>

  <!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> -->
  <script src="js/jquery-1.11.2.js"></script>
  <script src="js/jquery-ui-v1.11.4.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.ui.shake.js"></script>    
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery_validator.js"></script>
  <script src="js/bootstrap-toogle.min.js"></script>
  <script src="js/datepicker.js"></script>
  <script src="js/noty/packaged/jquery.noty.packaged.js"></script>
  <script src="js/jquery.mousewheel.pack.js"></script>
  <script src="js/jquery.formatCurrency.js"></script>
  <script src="js/tooltipster.bundle.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/bootstrap-multiselect.js"></script>
  <script src="js/sweetalert2.min.js"></script>
  <script src="js/chosen.jquery.js" ></script>
  <script src="js/nuevo_evento.js"></script>
  <script>
        $(document).on("ready",inicio); 
    </script>  
</head>
<body style='background-color: rgba(255,2552,255,0) !important;background:none !important;'>
<div class="container">
    <div class="row main">
      <div class="main-login main-center"> 
        
        <div class="row">
          <legend><h2>Crear Evento</h2></legend>
         
        </div>       
        <div class="clearfix"></div>
        
        <form id='form_nuevo_evento' action="">
          <div class="row">
            <div class="form-group col-md-3">
             <label for="name" class="cols-sm-2 control-label"># Evento</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                  <input id='txt_numero_evento' name='txt_numero_evento' type="text" class="form-control" readonly="" />
                </div>
              </div>
            </div>
            <div id='existentes' class="form-group col-md-9">
              <label for="email" class="cols-sm-2 control-label">Evento existente</label>
              <div class="cols-sm-10">
                <div id="step1" class="input-group" data-step="1" data-intro='Al escribir se buscaran los primeros 15 eventos que coincidan '  data-disable-interaction="1">
                  <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                  
                  <select name="c_eventos_creados" id="c_eventos_creados" class='form-control' placeholder='Ingresa un evento' >
                  </select>
                 <!--  <input type="text" name="c_eventos_creados" id="c_eventos_creados" class="form-control" placeholder='Ingresa un evento' pattern="" title=""> -->
                </div>
              </div>
            </div>            
          </div> 
          <div class="row">
            <div class="form-group col-md-6">
              <label for="name" class="cols-sm-2 control-label">Cliente</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                  <select name="c_cliente" id="c_cliente" class='form-control combo_clientes' >
                    
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
            <span class="bubble" title="Solo el nombre del evento (SIN Cliente)">
              <label for="email" class="cols-sm-2 control-label">Nombre del evento</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                  
                  <input id='txt_nombre_evento' name='txt_nombre_evento' type="text" class="form-control" placeholder="Nombre del evento"/>
                </div>
              </div>
            </div>
          </div>   
          <div class="row">
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Fecha de inicio del evento</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar fa" aria-hidden="true"></i></span>
                  <input id='txt_fecha_inicio_evento' name='txt_fecha_inicio_evento' type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Fecha de término del evento</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar fa" aria-hidden="true"></i></span>
                  <input id='txt_fecha_final_evento' name='txt_fecha_final_evento' type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
          </div> 
          <div class="row">
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Destino</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-globe fa" aria-hidden="true"></i></span>
                  <input id='txt_destino' name='txt_destino' type="text" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Sede</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker fa" aria-hidden="true"></i></span>
                  <input id='txt_sede' name='txt_sede' type="text" class="form-control">
                </div>
              </div>
            </div>
          </div>     
          <div class="row">
            <div class="form-group col-md-6">
              <label id='label_ejecutivo' class="cols-sm-2 control-label">Ejecutivo de cuenta</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                  <select name="c_ejecutivos" id="c_ejecutivos" class='form-control'>
                  <?php
                  include("conexion.php");
                  if (mysqli_connect_errno()) {
                      printf("Error de conexion: %s\n", mysqli_connect_error());
                      exit();
                  }
                  $result = $mysqli->query("SET NAMES 'utf8'");
                  $sql="SELECT Nombre FROM usuarios where Ejecutivo='X' and Estatus='activo' order by Nombre asc";
                  if ($result = $mysqli->query($sql)) {    
                      while ($row = $result->fetch_row()) {
                          if($row[0]!="ALAN SANDOVAL"){
                                  echo "<option value='".$row[0]."'>".$row[0]."</option>";
                          }
                      }                      
                      $result->close();
                  }
                  $mysqli->close();
                  ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="password" class="cols-sm-2 control-label">Producción</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                  <select name="c_produccion" id="c_produccion" class='form-control' multiple="multiple" >
                  <?php
                  include("conexion.php");
                  if (mysqli_connect_errno()) {
                      printf("Error de conexion: %s\n", mysqli_connect_error());
                      exit();
                  }
                  $result = $mysqli->query("SET NAMES 'utf8'");
                  echo "<option value='NA'>NA</option>";
                  $sql="SELECT Nombre FROM usuarios where Productor='X' and Estatus='activo' order by Nombre asc";
                  if ($result = $mysqli->query($sql)) {    
                      while ($row = $result->fetch_row()) {
                          if($row[0]!="ALAN SANDOVAL"){
                                  echo "<option value='".$row[0]."'>".$row[0]."</option>";
                          }
                      }                      
                      $result->close();
                  }
                  $mysqli->close();
                  echo "<option value='freelance'>FREELANCE</option>";
                  ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Diseño</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <select name="c_disenio" id="c_disenio" class='form-control' multiple="multiple" >
                  <?php
                  include("conexion.php");
                  if (mysqli_connect_errno()) {
                      printf("Error de conexion: %s\n", mysqli_connect_error());
                      exit();
                  }
                  $result = $mysqli->query("SET NAMES 'utf8'");
                  echo "<option value='NA'>NA</option>";
                  $sql="SELECT Nombre FROM usuarios where Disenio='X' and Estatus='activo' order by Nombre asc";
                  if ($result = $mysqli->query($sql)) {    
                      while ($row = $result->fetch_row()) {
                          if($row[0]!="ALAN SANDOVAL"){
                                  echo "<option value='".$row[0]."'>".$row[0]."</option>";
                          }
                      }                      
                      $result->close();
                  }
                  $mysqli->close();
                  echo "<option value='freelance'>FREELANCE</option>";
                  ?>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="confirm" class="cols-sm-2 control-label">Solicitante</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                  <select name="c_solicitantes" id="c_solicitantes" class='form-control' multiple="multiple">
                  <?php
                  include("conexion.php");
                  if (mysqli_connect_errno()) {
                      printf("Error de conexion: %s\n", mysqli_connect_error());
                      exit();
                  }
                  $result = $mysqli->query("SET NAMES 'utf8'");
                  $sql="SELECT Nombre FROM usuarios where Solicitante='X' and Estatus='activo' order by Nombre asc";
                  if ($result = $mysqli->query($sql)) {    
                      while ($row = $result->fetch_row()) {
                          if($row[0]!="ALAN SANDOVAL"){
                                  echo "<option value='".$row[0]."'>".$row[0]."</option>";
                          }
                      }                      
                      $result->close();
                  }
                  $mysqli->close();
                  ?>
                  </select>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            
            <div class="form-group col-md-6">
              <label for="confirm" class="cols-sm-2 control-label">Digital</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                  <select name="c_digital" id="c_digital" class='form-control' multiple="multiple">
                  <?php
                  include("conexion.php");
                  if (mysqli_connect_errno()) {
                      printf("Error de conexion: %s\n", mysqli_connect_error());
                      exit();
                  }
                  $result = $mysqli->query("SET NAMES 'utf8'");
                  echo "<option value='NA'>NA</option>";
                  $sql="SELECT Nombre FROM usuarios where Digitalizacion='X' and Estatus='activo' order by Nombre asc";
                  if ($result = $mysqli->query($sql)) {    
                      while ($row = $result->fetch_row()) {
                          if($row[0]!="ALAN SANDOVAL"){
                                  echo "<option value='".$row[0]."'>".$row[0]."</option>";
                          }
                      }                      
                      $result->close();
                  }
                  $mysqli->close();
                  ?>
                  </select>
                </div>
              </div>
            </div>
           
            <div class="form-group col-md-4">
              <label for="confirm" class="cols-sm-2 control-label">Facturación <i class='nota'>  *Incluyendo IVA</i></label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                  <span class="bubble" title="El monto de facturación debe ser numérico">
                  <input name='txt_facturacion' id='txt_facturacion' placeholder="123.45" type="textbox" class='form-control moneda'  value=''/>
                  </span>
                </div>
              </div>
            </div>  
            </div>
            <div class="row">
            <div class="form-group col-md-6">
              <label for="confirm" class="cols-sm-2 control-label">Video</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-video fa-lg" aria-hidden="true"></i></span>
                  <select name="c_video" id="c_video" class='form-control' multiple="multiple">
                  <option value="NA">NA</option>
                  <option value="JORGE CALDERON">JORGE CALDERON</option>
                  <option value="MIGUEL POBLACION">MIGUEL POBLACION</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-2">
              <label for="confirm" class="cols-sm-2 control-label"></label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <input id='check_estatus_facturacion' name='check_estatus_facturacion' type="checkbox" data-toggle="toggle" data-height="50"  data-width="100" data-onstyle="success" data-on="Total" data-off="Aprox" data-offstyle="warning">
                </div>
              </div>
            </div> 
            <?php
            if($_COOKIE['user']=="ALAN SANDOVAL" || $_COOKIE['user']=="SANDRA PEÑA"){
              echo '<div class="form-group col-md-2" id="div_candado">
                <label for="confirm" class="cols-sm-2 control-label"></label>
                <div class="cols-sm-10">
                  <div class="input-group">
                  <button type="button" id="btn_bloquear_evento" class="btn btn-danger" data-toggle="button" aria-pressed="false" autocomplete="off" style="padding:12px"><i class="fas fa-lock"></i> Bloqueado</button>
                  </div>
                </div>
              </div>';
            }?>

          </div>
            
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="username" class="cols-sm-2 control-label">Comentarios</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-commenting-o" aria-hidden="true"></i></span>
                  <textarea name="area_comentarios" id="area_comentarios" class="form-control" rows="4"></textarea>
                </div>
              </div>
            </div>            
          </div>
          <div class="row col-md-12">
            <button type="button" id="btn_crear_evento" class="btn_verde btn btn-lg btn-primary "><i class="fa fa-plus" aria-hidden="true"></i> Crear evento</button>
            <?php
            if($_COOKIE['user']=="ALAN SANDOVAL" || $_COOKIE['user']=="SANDRA PEÑA"){
              echo '<button type="button" id="btn_modificar_evento" class="btn_verde btn btn-lg btn-primary"><i class="fas fa-edit" aria-hidden="true"></i> Modificar evento</button>';
            }
            ?>
           
            <button type="button" id="limpiar_evento" class="btn btn-lg btn-info pull-right"><i class="i_espacio fa fa-eraser" aria-hidden="true"></i>Limpiar</button>
            <?php
            if($_COOKIE['user']=="ALAN SANDOVAL" || $_COOKIE['user']=="SANDRA PEÑA"){
              echo '<button type="button" id="btn_cancelar_evento" class="btn btn-lg btn-danger pull-right" style="margin-right: .5em"><i class="fa fa-trash" aria-hidden="true"></i> Cancelar evento</button>';
            }
            ?>
            
            
          </div>
          <div class='row'>
            <div class="col-md-12"></div>
          </div>
        </form>      
      </div>
    </div>
  </div>
  </body>
  </html>