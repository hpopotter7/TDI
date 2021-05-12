<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap.min6.css">
  <link rel="stylesheet" href="css/chosen.css"/>
  <link rel="stylesheet" href="css/data_tables.css">
  <link rel="stylesheet" href="css/basic.css">
  <link rel="stylesheet" href="css/dropzone.css">
  <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
  <link href="plugins/notification/noty.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
  
  
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
   <script src="bootstrap/js/popper.min.js"></script>
   <script src="bootstrap/js/bootstrap.min.js"></script>
   <script src="js/chosen.jquery.js"></script>
   <!--demo-->
   <script src="js/dropzone.js"></script>
   <script src="plugins/notification/noty.js" type="text/javascript"></script>
   <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
   <!--demo-->
   <script src="js/nomina.js?v=<?php echo(rand()); ?>"></script>
   <script>
      $(document).ready(inicio);
   </script>
    
    <!-- END PAGE LEVEL STYLES -->

    
</head>
<body style='background-color: rgba(255,2552,255,0) !important;background:none !important;'>
    <div class="container">
    <h2>Recibos de nómina</h2>     
    <div class="col-md-4">
      <div class="form-group">
          <label for="my-select">Año</label>
          <select id="c_anio" class="form-control" name="">
            <option val=''>Selecciona...</option>
            <option val='2020'>2020</option>
            <option val='2021'>2021</option>
          </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
          <label for="my-select">Mes</label>
          <select id="c_mes" class="form-control" name="">
                <option val=''>Selecciona...</option>
                <option selected hidden>Mes</option> 
                <option value="01">Enero</option> 
                <option value="02">Febrero</option> 
                <option value="03">Marzo</option> 
                <option value="04">Abril</option> 
                <option value="05">Mayo</option> 
                <option value="06">Junio</option> 
                <option value="07">Julio</option> 
                <option value="08">Agosto</option> 
                <option value="09">Septiembre</option> 
                <option value="10">Octubre</option> 
                <option value="11">Noviembre</option> 
                <option value="12">Diciembre</option> 
          </select>
      </div>
    </div>
    
        <div class="col-md-12">
            <div class="col-md-12">
                <div id="file_nomina" class="dropzone" style='min-height:20px;padding:0px'>
                    <div class="dz-default dz-message">
                        <h3><label for="" class='label label-primary'>Drag & Drop</label></h3>
                    </div>
            </div>
            </div>
        </div>          
        </div>
    </div>
    <div class="container">
    <form action="index.php" method="post" enctype="multipart/form-data">
    <div class="fallback">
        <input name="file" type="file" multiple />
    </div>
    <div id="actions" class="row">
        <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
                <i class="glyphicon glyphicon-plus"></i>
                <span>Add files...</span>
            </span>
            <button type="submit" class="btn btn-primary start" style="display: none;">
                <i class="glyphicon glyphicon-upload"></i>
                <span>Start upload</span>
            </button>
            <button type="reset" class="btn btn-warning cancel" style="display: none;">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <span>Cancel upload</span>
            </button>
        </div>
 
        <div class="col-lg-5">
            <!-- The global file processing state -->
            <span class="fileupload-process">
                <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                    <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                </div>
            </span>
        </div>
    </div>
 
    <div class="table table-striped files" id="previews">
        <div id="template" class="file-row row">
            <!-- This is used as the file preview template -->
            <div class="col-xs-12 col-lg-3">
                <span class="preview" style="width:160px;height:160px;">
                    <img data-dz-thumbnail />
                </span>
                <br/>
                <button class="btn btn-primary start" style="display:none;">
                    <i class="glyphicon glyphicon-upload"></i>
                    <span>Empezar</span>
                </button>
                <button data-dz-remove class="btn btn-warning cancel">
                    <i class="icon-ban-circle fa fa-ban-circle"></i> 
                    <span>Cancelar</span>
                </button>
                <button data-dz-remove class="btn btn-danger delete">
                    <i class="icon-trash fa fa-trash"></i> 
                    <span>Eliminar</span>
                </button>
            </div>
            <div class="col-xs-12 col-lg-9">
                <p class="name" data-dz-name></p>
                <p class="size" data-dz-size></p>
                <div>
                    <strong class="error text-danger" data-dz-errormessage></strong>
                </div>
                <div>
                    <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                      <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <div class="dropzone-here">Drop files here to upload.</div>
</form>
</div>
</body>
</html>