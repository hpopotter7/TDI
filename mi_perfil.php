<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    
    <link href="assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/tables/table-basic.css" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="css/jquery-ui_theme_green.css"/> -->
    <link rel="stylesheet" href="css/jquery-ui_green.css"/>
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <!-- <link href="assets/css/apps/scrumboard.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/forms/theme-checkbox-radio.css" rel="stylesheet" type="text/css"> -->
    <!--  END CUSTOM STYLE FILE  -->
    <script src="plugins/sweetalerts/sweetalert2.min.js"></script>
    <style>
        i{
            cursor: pointer;
        }
    </style>
</head>
<!-- <body data-spy="scroll" data-target="#navSection" data-offset="100"> -->
<body style='background-color: rgba(0,0,0,.0) !important; font-size:14px !important'>
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
<!-- 
        <div class="overlay"></div>
        <div class="search-overlay"></div>
 -->
        

        <!--  BEGIN CONTENT AREA  -->
        <!-- <div id="content" class="main-content"> -->
        <div id="content" class="main-content" style="margin-top:10px;width: 100% !important; margin-left: 10px !important;background-color: rgba(0,0,0,.0) !important;">
                <div class="container" style="max-width: 90% !important;width: 90%;">                    
                    <div class="row">
                        <div id="tabsIcons" class="col-lg-12 col-12 layout-spacing">
                            <div class="statbox widget box box-shadow">
                                <div class="widget-header">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h3 style='margin: 1em 0px 0px 0px!important'>Mi Perfil</h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="widget-content widget-content-area icon-tab"> -->
                                <div class="widget-content widget-content-area tab-justify-centered" style='padding: 0px 20px 0px 36px !important; min-height:500px'>
                                    
                                    <!-- <ul class="nav nav-tabs  mb-3 mt-3" id="iconTab" role="tablist"> -->
                                    <ul class="nav nav-tabs  mb-3 mt-3 justify-content-center" id="justifyCenterTab" role="tablist">

                                        <li class="nav-item">
                                            <a class="nav-link active" id="tab_vacaciones" data-toggle="tab" href="#vacaciones" role="tab" aria-controls="vacaciones" aria-selected="true">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="umbrella-beach" class="svg-inline--fa fa-umbrella-beach fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" style='vertical-align:sub'><path fill="currentColor" d="M115.38 136.9l102.11 37.18c35.19-81.54 86.21-144.29 139-173.7-95.88-4.89-188.78 36.96-248.53 111.8-6.69 8.4-2.66 21.05 7.42 24.72zm132.25 48.16l238.48 86.83c35.76-121.38 18.7-231.66-42.63-253.98-7.4-2.7-15.13-4-23.09-4-58.02.01-128.27 69.17-172.76 171.15zM521.48 60.5c6.22 16.3 10.83 34.6 13.2 55.19 5.74 49.89-1.42 108.23-18.95 166.98l102.62 37.36c10.09 3.67 21.31-3.43 21.57-14.17 2.32-95.69-41.91-187.44-118.44-245.36zM560 447.98H321.06L386 269.5l-60.14-21.9-72.9 200.37H16c-8.84 0-16 7.16-16 16.01v32.01C0 504.83 7.16 512 16 512h544c8.84 0 16-7.17 16-16.01v-32.01c0-8.84-7.16-16-16-16z"></path></svg> Vacaciones</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab_permisos" data-toggle="tab" href="#permisos" role="tab" aria-controls="permisos" aria-selected="true"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="" style='display:none'><path ></path></svg> <i class="fas fa-birthday-cake"></i> Permisos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab_activo_fijo" data-toggle="tab" href="#activo_fijo" role="tab" aria-controls="activo_fijo" aria-selected="false"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone" style='display:none'><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg><i class="fas fa-laptop"></i> Activo Fijo</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="tab_recibos" data-toggle="tab" href="#recibos" role="tab" aria-controls="recibos" aria-selected="true">
                                            <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="money-check-alt" class="svg-inline--fa fa-money-check-alt fa-w-20" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" style='vertical-align:sub'><path fill="currentColor" d="M608 32H32C14.33 32 0 46.33 0 64v384c0 17.67 14.33 32 32 32h576c17.67 0 32-14.33 32-32V64c0-17.67-14.33-32-32-32zM176 327.88V344c0 4.42-3.58 8-8 8h-16c-4.42 0-8-3.58-8-8v-16.29c-11.29-.58-22.27-4.52-31.37-11.35-3.9-2.93-4.1-8.77-.57-12.14l11.75-11.21c2.77-2.64 6.89-2.76 10.13-.73 3.87 2.42 8.26 3.72 12.82 3.72h28.11c6.5 0 11.8-5.92 11.8-13.19 0-5.95-3.61-11.19-8.77-12.73l-45-13.5c-18.59-5.58-31.58-23.42-31.58-43.39 0-24.52 19.05-44.44 42.67-45.07V152c0-4.42 3.58-8 8-8h16c4.42 0 8 3.58 8 8v16.29c11.29.58 22.27 4.51 31.37 11.35 3.9 2.93 4.1 8.77.57 12.14l-11.75 11.21c-2.77 2.64-6.89 2.76-10.13.73-3.87-2.43-8.26-3.72-12.82-3.72h-28.11c-6.5 0-11.8 5.92-11.8 13.19 0 5.95 3.61 11.19 8.77 12.73l45 13.5c18.59 5.58 31.58 23.42 31.58 43.39 0 24.53-19.05 44.44-42.67 45.07zM416 312c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h112c4.42 0 8 3.58 8 8v16zm160 0c0 4.42-3.58 8-8 8h-80c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h80c4.42 0 8 3.58 8 8v16zm0-96c0 4.42-3.58 8-8 8H296c-4.42 0-8-3.58-8-8v-16c0-4.42 3.58-8 8-8h272c4.42 0 8 3.58 8 8v16z"></path></svg> Recibos de Nómina</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="iconTabContent-1">
                                        <div class="tab-pane fade show active" id="vacaciones" role="tabpanel" aria-labelledby="tab_vacaciones">
                                            <div class="row">
                                        <div class="col-md-4">
                                            <div class="card-body">
                                                <div class="task-header">
                                                    <div class="row">
                                                        <h4 class="" data-tasktitle="Creating a new Portfolio on Dribble" style="display: inline;">Fecha de ingreso: 
                                                        <strong id='strong_fecha_ingreso'>
                                                            <?php 
                                                            include("conexion.php");
                                                            if (mysqli_connect_errno()) {
                                                                printf("Error de conexion: %s\n", mysqli_connect_error());
                                                                exit();
                                                            }
                                                            $result = $mysqli->query("SET NAMES 'utf8'");
                                                            $sql="SELECT DATE_FORMAT(Fecha_ingreso, '%d/%m/%Y') FROM usuarios where id_usuarios='".$_COOKIE['id']."'";
                                                            if ($result = $mysqli->query($sql)) {
                                                                while ($row = $result->fetch_row()) {
                                                                    echo $row[0];
                                                                }
                                                                $result->close();
                                                            }
                                                            $mysqli->close();
                                                            ?>
                                                        </strong></h4> 
                                                    </div>
                                                    <div class="row">
                                                        <h4 class="" data-tasktitle="Creating a new Portfolio on Dribble" style="display: inline;">Antigüedad: <strong id='antigüedad'></strong></h4>
                                                    </div>
                                                    <div class="row">
                                                        <h4 class="" data-tasktitle="Creating a new Portfolio on Dribble" style="display: inline;">Días correspondientes: <strong id='dias_correspondientes'>12</strong></h4>
                                                    </div>
                                                    <div class="row">
                                                        <h4 class="" data-tasktitle="Creating a new Portfolio on Dribble" style="display: inline;">Días restantes: <strong id="dias_restantes"></strong></h4>
                                                    </div>
                                                </div>
                                                <div class="task-body">
                                                <div class="task-bottom">
                                                    <div class="tb-section-1 row">
                                                    <button type="button" id='btn_solicitar' class="btn btn-secondary btn-lg"> <i class="fas fa-plus    "></i> Solicitar </button>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-8" style='border-left: 1px solid black'>
                                        <table class="table table-hover table-inverse">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>Periodo</th>
                                                    <th>JEFE DIRECTO</th>
                                                    <th>Días</th>
                                                    <th>Estatus</th>
                                                    <th>Opciones</th>
                                                </tr>
                                                </thead>
                                                <tbody id='body_vacaciones'>  
                                                                                           
                                                    <!-- <tr>
                                                        <td scope="row">Del: 1-Abril-2021 Al: 15-Abril-2021</td>
                                                        <td>Juan Carlos García</td>
                                                        <td>6</td>
                                                        <td><span class="shadow-none badge outline-badge-danger">Pendiente</span></td>
                                                        <td><i class="btn_editar far fa-edit fa-2x text-primary"></i> <i class="fas fa-trash fa-2x text-danger btn_borrar"></i> <i class="far fa-file-pdf fa-2x btn_descargar text-secondary"></i></td>
                                                    </tr>
                                                    <tr>
                                                        <td scope="row">Del: 1-Abril-2021 Al: 15-Abril-2021</td>
                                                        <td>Juan Carlos García</td>
                                                        <td>6</td>
                                                        <td><span class="shadow-none badge outline-badge-success">Autorizado</span></td>
                                                        <td><i class="far fa-file-pdf fa-2x btn_descargar text-secondary"></i></td>
                                                    </tr> -->
                                                </tbody>
                                        </table>
                                        </div>
                                        </div>
                                        </div>
                                        <div class="tab-pane fade" id="permisos" role="tabpanel" aria-labelledby="tab_permisos">
                                            <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                <input type="hidden" id='txt_id_permiso' value='0'>
                                                    <label for="my-select">Tipo de ausencia </label><small id='btn_limpiar' class="text-mute float-right"> <i class="fas fa-eraser fa-2x" style='color:#7734d9;font-size:1.3em'> Limpiar </i> </small>
                                                    <select id="c_tipo_permiso" class="form-control" name="">
                                                        <option value=''>Selecciona...</option>
                                                        <option value='Dia de cumpleaños'>Día de cumpleaños</option>
                                                        <option value='Junta/Evento'>Junta/Evento</option>
                                                        <option value='Enfermedad'>Enfermedad (médico particular)</option>
                                                        <option value='Incapacidad'>Incapacidad IMSS</option>
                                                        <option value='Love Days'>Love Days</option>
                                                        <option value='Home Office'>Home Office</option>
                                                        <option value='Permiso sin goce'>Permiso sin goce de sueldo</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="my-select">De:</label>
                                                    <input type="text" class='form-control fecha_permiso' id='fecha_inicio_permiso'>
                                                </div>
                                                <div class="form-group">
                                                    <label for="my-select">Hasta:</label>
                                                    <input type="text" class='form-control fecha_permiso' id='fecha_fin_permiso'>
                                                </div>
                                                <div class="form-group">
                                                    <label for="my-select">Días</label>
                                                    <input type="text" readonly class='form-control' id='txt_dias_permiso'>
                                                    <small id="error_permiso" class="text-danger"></small>
                                                </div>
                                                <button id='btn_solicitar_permiso' class='btn btn-secondary btn-lg float-right'><i class="fas fa-plus"></i> Solicitar</button>
                                                </div>
                                                <div class="col-md-8" style='border-left: 1px solid black'>
                                                <table class="table table-hover table-inverse">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>Periodos</th>
                                                    <th>Tipo de permiso</th>
                                                    <th>JEFE DIRECTO</th>
                                                    <th>Días</th>
                                                    <th>Estatus</th>
                                                    <th>Opciones</th>
                                                </tr>
                                                </thead>
                                                <tbody id='body_permisos'>                                                
                                                                                               
                                                </tbody>
                                                </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="activo_fijo" role="tabpanel" aria-labelledby="tab_activo_fijo">
                                        <table class="table table-hover table-inverse">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Marca</th>
                                                    <th>Modelo</th>
                                                    <th>Descripción</th>
                                                    <th>Tipo de activo</th>
                                                </tr>
                                                </thead>
                                                <tbody id='body_activo'>                                                
                                                </tbody>
                                                </table>
                                        </div>
                                        <div class="tab-pane fade" id="recibos" role="tabpanel" aria-labelledby="tab_recibos">
                                            <div class="row">
                                            <table class="table table-hover table-inverse">
                                            <thead class="thead-inverse">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Año</th>
                                                    <th>Mes</th>
                                                    <th>Descarga</th>
                                                </tr>
                                                </thead>
                                                <tbody id='body_activo'>       
                                                                                         
                                                </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <!--  END CONTENT AREA  -->
    </div>
    <!-- END MAIN CONTAINER -->

    <div class="modal fade" id="modal_vacaciones" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Solicitud de vacaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" id='txt_id_vacaciones' value='0'>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="">Fecha inicio:</label>
                    <input type="text" class='fecha form-control fechas_vacaciones' name="" id="fecha_inicio" class="form-control" placeholder="" aria-describedby="helpId">                  
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="">Fecha fin:</label>
                    <input type="text" class='fecha form-control fechas_vacaciones' name="" id="fecha_fin" class="form-control" placeholder="" aria-describedby="helpId">                  
                    </div>
                </div>
            </div>
            <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Días solicitados</label>
                    <input type="text" disabled='disabled' readonly name="" id="txt_dias" class="form-control" placeholder="" aria-describedby="helpId">  
                    <small id="modal_error" class="text-danger"></small>                
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Regresando el día:</label>
                    <input type="text" disabled='disabled' readonly name="" id="fecha_regreso" class="form-control" placeholder="" aria-describedby="helpId">  
                    <small id="modal_error" class="text-danger"></small>                
                </div>
            </div>
            </div>
               
            </div>
            <div class="modal-footer">
                <button type="button" id='btn_aceptar' class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
</div>
    
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script> -->
    <!-- <script src="plugins/highlight/highlight.pack.js"></script> -->
    <!-- <script src="assets/js/custom.js"></script> -->
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- <script src="assets/js/ie11fix/fn.fix-padStart.js"></script> -->
    <!-- <script src="assets/js/apps/scrumboard.js"></script> -->
    <!-- <script src="assets/js/scrollspyNav.js"></script> -->
    <script src="js/datepicker.js"></script>
    <script src="js/mi_perfil.js?v=<?php echo(rand()); ?>"></script>
    <script>
        $(document).on("ready",inicio); 
    </script>  
</body>
</html>