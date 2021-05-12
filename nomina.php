<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <!--<link rel="stylesheet" href="css/sweetalert2.css"/>-->
    <!-- <link href="plugins/notification/noty.css" rel="stylesheet"> -->
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />

    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    
<!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"> -->
<link rel="stylesheet" href="css/styles.css">
<!-- <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" /> -->

<!-- <script src="https://code.jquery.com/jquery-3.2.1.js"></script> -->
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="js/dropzone.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="plugins/sweetalerts/sweetalert2.min.js"></script>
<script src="js/nomina.js?v=<?php echo(rand()); ?>"></script>
<script>
     $(document).on("ready",inicio);  
    </script>
</head>
<body class='normal' style='background-color: rgba(255,255,255,.3) !important;background:none !important;font-size:12px !important;overflow:auto'>
<div class="container">
    <h1>Carga de comprobantes de nómina</h1>
    <h2 class="lead">Subir archivos</h2>
    <div class="row">
    <div class="col-md-4">
      <div class="form-group">
          <label for="my-select">Año</label>
          <select id="c_anio" class="form-control" name="">
            <option value=''>Selecciona...</option>
            <option value='2020'>2020</option>
            <option value='2021'>2021</option>
          </select>
      </div>
    </div>
    <div class="col-md-4">
      <div class="form-group">
          <label for="my-select">Mes</label>
          <select id="c_mes" class="form-control" name="">
                <option value=''>Selecciona...</option>
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
    </div>
    <div class="row">
    
    <div class="col-md-6">
    <div class="row">
        <div id="contents" class="col-md-12">
<form action="index.php" method="post" enctype="multipart/form-data">
    <div class="fallback">
        <input name="file" type="file" multiple />
    </div>
    <div id="actions" class="row">
        <div class="col-lg-7">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
                <i class="fas fa-plus"></i>
                <span>Añadir archivos...</span>
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

    <div class="table table-striped files" id="previews" style="border: 1px dashed !important;">
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

    <div class="dropzone-here">Arrastra aqui los archivos</div>
</form>  
        </div>
    </div>
    </div>
    <div class="col-md-6">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Año</th>
                    <th>Mes</th>
                    <th>Descarga</th>
                </tr>
            </thead>
            <tbody id='body_nomina'>
               
            </tbody>
        </table>
    </div>
    </div>
    
    
</div>

</body>
</html>
