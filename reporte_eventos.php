<?php
$tipo="";
$titulo="";
    if(isset($_GET['tipo'])){
        $tipo=$_GET['tipo'];
    }
    if($tipo=="T"){
        $titulo="Todos los eventos";
    }
    if($tipo=="A"){
        $titulo="Eventos abiertos";
    }
    else if($tipo=="H"){
        $titulo="Eventos cerrados";
    }
    else if($tipo=="P"){
        $titulo="Eventos pitch";
    }
    else if($tipo=="C"){
        $titulo="Eventos cerrados";
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
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link href="plugins/notification/noty.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert2.css"/>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <!--  <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"> -->

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />-->
    <link rel="stylesheet" href="css/fancybox.css">
    
    <style>
        /* table {
        transform: scale(.92);
        -webkit-transform: scale(.92);
        -webkit-transform-origin: 0 0;
        -moz-transform: scale(.92);
        -moz-transform-origin: 0 0;
        -o-transform: scale(.92);
        -o-transform-origin: 0 0;
        -ms-transform: scale(.92);
        -ms-transform-origin: 0 0;
    } */
    </style>

    <script src="js/sweetalert2.min.js"></script>

    
    <!-- END PAGE LEVEL STYLES --> 
</head>
<body style='background-color: rgba(0,0,0,.0) !important;'>
    <div id="content" class="main-content" style="margin-top:10px;width: 100% !important; margin-left: 10px !important;background-color: rgba(0,0,0,.0) !important;">
        <div class="row">
            <div class="col-md-8"><h2 id='titulo'> <?php echo $titulo;?></h2></div>
            <div class="col-md-4"><h2>
            <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-dark btn-outline-dark" <?php if($tipo=="T"){echo "active";}?>>
                    <input type="radio" name="options" id="btn_todos" autocomplete="on" <?php if($tipo=="T"){echo "checked";}?>> Todos
                </label>
                <label class="btn btn-succes btn-outline-success" <?php if($tipo=="A"){echo "active";}?>>
                    <input type="radio" name="options" id="btn_abiertos" autocomplete="on" <?php if($tipo=="A"){echo "checked";}?>> Abiertos
                </label>
                <label class="btn btn-secondary btn-outline-secondary" <?php if($tipo=="H"){echo "active";}?>>
                    <input type="radio" name="options" id="btn_cerrados" autocomplete="off" <?php if($tipo=="H"){echo "checked";}?>> Historicos
                </label>
                <label class="btn btn-warning btn-outline-warning" <?php if($tipo=="P"){echo "active";}?>>
                    <input type="radio" name="options" id="btn_pitch" autocomplete="off" <?php if($tipo=="P"){echo "checked";}?>> Pitch
                </label>
                <label class="btn btn-danger btn-outline-danger" <?php if($tipo=="C"){echo "active";}?>>
                    <input type="radio" name="options" id="btn_cancelados" autocomplete="off" <?php if($tipo=="C"){echo "checked";}?>> Cancelados <i id="loader" class="fas fa-spinner fa-spin" aria-hidden="true"></i>
                </label>
            </div>
                       
        </h2></div>
        </div>
                  
        
        <div class="layout-px-spacing" id="div_contenido" style='display:none'>
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover table-bordered table-sm" style="width:100%">
                                <thead style='background-color: rgba(155,175,55,.9) !important;'>
                                    <tr>
                                        <th>Número evento</th>
                                        <th>Nombre</th>
                                        <th>Cliente</th>
                                        <th>Egresos</th>
                                        <th>Ingresos</th>
                                        <th>Utilidad</th>
                                        <th>Porcentaje</th>
                                        <th>Ejecutivo</th>
                                        <!--<th>Opciones</th>-->
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                if($tipo!=null || $tipo!=""){
                                if($tipo=="T"){
                                    $where_con="AND Estatus in('ABIERTO','CERRADO','CANCELADO','PITCH')";
                                    $where_sin="where Estatus in('ABIERTO','CERRADO','CANCELADO','PITCH')";
                                    $boton="btn_todos";
                                }
                                else if($tipo=="A"){
                                    $where_con="AND Estatus='ABIERTO'";
                                    $where_sin="where Estatus='ABIERTO'";
                                    $boton="btn_abiertos";
                                }
                                else if($tipo=="H"){
                                    $where_con="AND Estatus='CERRADO'";
                                    $where_sin="where Estatus='CERRADO'";
                                    $boton="btn_cerrados";
                                }
                                else if($tipo=="P"){
                                    $where_con="AND Estatus='PITCH'";
                                    $where_sin="where Estatus='PITCH'";
                                    $boton="btn_pitch";
                                }
                                else if($tipo=="C"){
                                    $where_con="AND Estatus='CANCELADO'";
                                    $where_sin="where Estatus='CANCELADO'";
                                    $boton="btn_cancelados";
                                }
                                    include("conexion.php");
                                    $mysqli2=$mysqli;
                                    if (mysqli_connect_errno()) {
                                        printf("Error de conexion: %s\n", mysqli_connect_error());
                                        exit();
                                    }
                                    function asmoneda($value) {
                                    return '$' . number_format($value, 2);
                                    }
                                    $result = $mysqli->query("SET NAMES 'utf8'");
                                    $arr_eventos=array();
                                    $arr_ids=array();
                                    $arr_nombres=array();
                                    $arr_clientes=array();
                                    $arr_ejecutivos=array();
                                    $arr_egresos=array();
                                    $arr_ingresos=array();
                                    $arr_utilidad=array();
                                    $arr_porcentaje=array();
                                    $arr_estatus=array();
                                    $res='';
                                    $sql = "SELECT Numero_evento, Nombre_evento, Cliente, REPLACE(Ejecutivo,',','') as Ejecutivo, id_evento, Estatus  FROM eventos where (Ejecutivo like '%".$_COOKIE['user']."%') ".$where_con." order by Numero_evento ";
                                    if($_COOKIE['user']=="SANDRA PEÑA" || $_COOKIE['user']=="FERNANDA CARRERA" || $_COOKIE['user']=="ALAN SANDOVAL" || $_COOKIE['user']=="RITA VELEZ" || $_COOKIE['user']=="MIGUEL POBLACION"){
                                        $sql = "SELECT Numero_evento, Nombre_evento, Cliente, REPLACE(Ejecutivo,',','') as Ejecutivo, id_evento, Estatus  FROM eventos ".$where_sin." order by Numero_evento ";
                                    }
                                    
                                    if ($result = $mysqli->query($sql)) {
                                        while ($row = $result->fetch_row()) {
                                            $CLIENTE=$row[2];
                                            array_push($arr_clientes,$CLIENTE);
                                            $EJE=$row['3'];
                                            array_push($arr_ejecutivos,$EJE);
                                            array_push($arr_nombres,$row[1]);                                        
                                            array_push($arr_eventos,$row[0]);
                                            array_push($arr_ids,$row[4]);
                                            array_push($arr_estatus,$row[5]);
                                        }
                                        for($r=0;$r<=count($arr_eventos)-1;$r++){
                                            $egresos="0";
                                            $sql = "select sum(importe_total) from odc where Cancelada='no' and  evento='".$arr_eventos[$r]."'";
                                            if ($result = $mysqli->query($sql)) {
                                            while ($row = $result->fetch_row()) {
                                                $egresos=$row[0];
                                                array_push($arr_egresos,$egresos);
                                                }
                                            }
                                        }
                                        for($r=0;$r<=count($arr_eventos)-1;$r++){
                                            $ingresos="0";
                                            $sql = "select s.id_evento, sum(p.total) from solicitud_factura s, partidas p where s.id_solicitud=p.id_sol_factura and Estatus='Activa' and s.id_evento='".$arr_ids[$r]."' GROUP by s.id_evento";
                                            if ($result = $mysqli->query($sql)) {
                                            while ($row = $result->fetch_row()) {
                                                $ingresos=$row[1];
                                                
                                                }
                                            }
                                            array_push($arr_ingresos,$ingresos);
                                        }
                                        for($r=0;$r<=count($arr_egresos)-1;$r++){
                                            $utilidad=$arr_ingresos[$r]-$arr_egresos[$r];
                                        
                                            array_push($arr_utilidad,$utilidad);
                                        }

                                        for($r=0;$r<=count($arr_eventos)-1;$r++){
                                            if($arr_ingresos[$r]>0){
                                                $p=($arr_utilidad[$r]*100)/$arr_ingresos[$r];
                                                $porcentaje='<span class="badge badge-success">'.round($p,2).' % </span>';
                                            }
                                            else{
                                                $porcentaje='<span class="badge badge-danger">NA</span>';
                                            }
                                            array_push($arr_porcentaje,$porcentaje);
                                        }

                                        $result->close();
                                    }
                                    else{
                                        echo "Error: ".$sql.mysqli_error($mysqli);
                                    }
                                    for($r=0;$r<=count($arr_eventos)-1;$r++){
                                        $class='class="badge badge-success"';
                                        if($arr_utilidad[$r]<=0){
                                            $class='class="badge badge-danger"';
                                        }
                                        $boton=$arr_estatus[$r];
                                        $color="";
                                        switch($boton){
                                            case "ABIERTO":
                                                $color="success";
                                                $color2="#a3c66f";
                                                break;
                                            case "CANCELADO":
                                                $color="danger";
                                                $color2="#e7515a";
                                                break;
                                            case "PITCH":
                                                $color="warning";
                                                $color2="#e2a03f";
                                                break;
                                            case "CERRADO":
                                                $color="secondary";
                                                $color2="#944fce";
                                                break;
                                        }
                                        if($_COOKIE['user']=="SANDRA PEÑA" || $_COOKIE['user']=="ALAN SANDOVAL"){
                                            if($arr_estatus[$r]=="CANCELADO" || $arr_estatus[$r]=="PITCH" || $arr_estatus[$r]=="CERRADO" ){
                                                /* $boton="<button class='btn btn-secondary btn-sm' data-toggle='tooltip' data-placement='top' title='Revivir evento'><i id='".$arr_eventos[$r]."' style='color:white;' class='fas fa-level-up-alt fa-2x btn_revivir'></i></button>"; */
                                                $boton="<a class='dropdown-item btn_revivir' id='".$arr_eventos[$r]."' href='#'><i style='color:white;' class='fas fa-unlock '></i> Revivir evento</a>"; 
                                                /* $boton=""; */
                                            }
                                            else if($arr_estatus[$r]=="ABIERTO"){
                                                /* $boton="<button class='btn btn-secondary btn-sm' data-toggle='tooltip' data-placement='top' title='Cerrar evento'>Cerrar evento</button>"; */
                                                 $boton="<a class='dropdown-item' id='".$arr_ids[$r]."' href='#'><i style='color:white;' class='fas fa-lock btn_cerrar'></i> Cerrar evento</a>";
                                                /* $boton=""; */
                                            }                                            
                                        }
                                        $dropdown='
                                        <div class="btn-group dropright">
                                        <button type="button" class="btn btn-'.$color.'">
                                        '.$arr_eventos[$r].'
                                        </button>
                                        <button type="button" class="btn btn-'.$color.' dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-chevron-right"></i>
                                        </button>
                                        <div class="dropdown-menu" style="background-color:'.$color2.'">
                                        <a class="dropdown-item btn_ver_solicitudes" id="'.$arr_ids[$r].'" href="#">Ver solicitudes</a>
                                        <a class="dropdown-item btn_ir_evento" id="'.$arr_ids[$r].'" href="#">Ir al evento</a>
                                        '.$boton.'
                                        </div>
                                        </div>';
                                        $res=$res.'<tr><td>'.$dropdown.'</td><td>'.$arr_nombres[$r].'</td><td>'.$arr_clientes[$r].'</td><td><h4><span class="badge badge-warning">'.asmoneda($arr_egresos[$r]).'</span></h4></td><td><h4><span class="badge badge-success">'.asmoneda($arr_ingresos[$r]).'</span></h4></td><td><h4><span '.$class.'>'.asmoneda($arr_utilidad[$r]).'</span></h4></td><td><h4>'.$arr_porcentaje[$r].'</h4></td><td>'.$arr_ejecutivos[$r].'</td></tr>';
                                    }
                                    $res=$res;
                                    //echo json_encode($data);
                                    echo $res;
                                    $mysqli->close();
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
       
    </div>
    <!--  END CONTENT AREA  -->
</div>

<div id="modal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-fluid modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id='modal_titulo'>Buscando eventos...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Buscando eventos <img id="puntos_gif" src="img/puntos.gif" alt=""></p>
      </div>
    </div>
  </div>
</div>
<!-- END MAIN CONTAINER -->
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
    <script src="plugins/notification/noty.js" type="text/javascript"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.flash.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="js/jspdf.min.js"></script>
    <script src="js/fancy.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script> -->
    <script>
        
        $('#div_contenido').show();
         $('[data-toggle="tooltip"]').tooltip();

         $('.btn_ir_evento').on('click',function(e){
            e.preventDefault();
            var evento=$(this).attr('id');
            parent.$("#frame").attr("src", "solicitudes.php?evento="+evento);
         });

         $('#btn_cerrar_evento').click(function(e){
             e.preventDefault();
             var evento=$(this).attr('href');
        swal({
          title: "¿Deseas cerrar el evento "+evento+"?",
          html: "<i style='font-size:.75em'>Una vez cerrado, los usuario no podran realizar solicitudes</i>" +
              "<br>" +
              '<button type="button" id="'+evento+'" class="btn btn-success SwalBtn_normal customSwalBtn">' + 'Normal' + '</button>' +
              '<button type="button" id="'+evento+'" class="btn btn-warning SwalBtn_pitch customSwalBtn">' + 'Pitch' + '</button>' +
              '<button type="button" id="'+evento+'" class="btn btn-danger SwalBtn_cancel customSwalBtn">' + 'Cancelar' + '</button>' ,
              type: "warning",
          showCancelButton: false,
          showConfirmButton: false
        });
      });

      $(document).on('click', '.SwalBtn_normal', function() {
        var evento=$(this).attr('id');
      cierre_evento(evento, "CERRADO");
    });
    $(document).on('click', '.SwalBtn_pitch', function() {
        var evento=$(this).attr('id');
      cierre_evento(evento, "PITCH");
    });
    $(document).on('click', '.SwalBtn_cancel', function() {
        swal.clickConfirm();
    });

    function cierre_evento(evento, tipo){ 
       // var evento=$('#c_eventos option:selected').text();
        var datos={
          "evento": evento,
          "tipo":tipo
        }
        $.ajax({
          url:   "cerrar_evento.php",
          type:  'post',
          data: datos,
          success:  function (response) {
            swal.clickConfirm();
            if(response.includes("cerrado")){
              swal("Exito", "Se ha cerrado el evento.", "success");
              /* $("#c_eventos").val('');
              $('#resultados').hide();
              $('#btn_cerrar_evento').hide();  
              llenar_eventos_combo("0"); */
            }
            else if(response.includes("pendientes por aprobar")){
              swal("Advertencia", response, "warning");
            }
            else {
              swal("Error", response, "error");
            }       
          }
        });

      };

          $('.btn_ver_solicitudes').on('click',function(e){
            e.preventDefault();
              var evento=$(this).attr('id');
              /* var datos={
                    "evento":evento,
                    "filtro":"todos",
                }; */
                var datos={
                    "evento":evento,
                    //"filtro":"todos",
                };
                $.ajax({
                url:   "ver_detalle_solicitudes.php",
                type:  'post',
                data: datos,
                success:  function (response) {
                     /*$.fancybox.open({
                  src  : "ver_solicitudes_por_evento.php",
                  type : 'iframe',
                 
                  opts : {
                    afterShow : function( instance, current ) {
                      //console.info( 'done!' );
                    }
                  }
                })*/
            $.fancybox.open({
                /* href: "ver_solicitudes_por_evento.php",
                type: "ajax",
                ajax: {
                    type: "POST",
                    data: datos,
                } 
                 type: "iframe",
                src: "ver_detalle_solicitudes.php?evento="+evento,
                width:400,
                height:300,
                autoSize : true, */

                content  : response,
                autoSize : false,
                width    : "auto",
                height   : "80%",
                modal: false,
            });
            }
        });
    });
                
/* 
              
              $('#modal_titulo').html("Solicitudes el evento");
              var datos={
                    "evento":evento,
                    "filtro":"todos",
                };
                $.ajax({
                url:   "ver_solicitudes_por_evento.php",
                type:  'post',
                data: datos,
                success:  function (response) {
                   /*  $.fancybox.open({
                  src  : "ver_solicitudes_por_evento.php",
                  type : 'iframe',
                 
                  opts : {
                    afterShow : function( instance, current ) {
                      //console.info( 'done!' );
                    }
                  }
                }); */
                
                /* 
                  $('#puntos_gif').hide();
                  var arr=response.split("$$$");
                  $('.modal-body').html(arr[0]);
                  $('#modal').modal(); */
                  /* $('#resultado_solicitudes').fadeIn();
                  $('#tabla_resumen_solicitudes').addClass("chico");
                  $('#tabla_resumen_solicitudes').DataTable({
                    "searching": true,
                    "language" : idioma_espaniol,
                    "ordering": true,
                    "paging": false,
                    "destroy": true, 
                    "sort": true,
                    //"scrollX": true,
                    dom: 'Bfrtip',
                    buttons: [
                      {
                        extend: 'colvis',
                        collectionLayout: 'fixed two-column'
                    },
                        'excel',// 'colvis'
                        //'excel', 'pdf',
                    ],
                 });  
                }
              });
          }); */


         $('#btn_todos').on('click',function(){
            $("#modal").modal({backdrop: 'static', keyboard: false});
            $('.table-responsive').hide();
            $('#titulo').html('Buscando eventos <img id="puntos_gif" src="img/puntos.gif" alt="">');
            window.setTimeout(function() {
                location.href="reporte_eventos.php?tipo=T";
            }, 1500);
             
         });

         $('#btn_abiertos').on('click',function(){
            $("#modal").modal({backdrop: 'static', keyboard: false});
            $('.table-responsive').hide();
            $('#titulo').html('Buscando eventos <img id="puntos_gif" src="img/puntos.gif" alt="">');
            window.setTimeout(function() {
                location.href="reporte_eventos.php?tipo=A";
            }, 1500);
             
         });
         
         $('#btn_abiertos').on('click',function(){
            $("#modal").modal({backdrop: 'static', keyboard: false});
            $('.table-responsive').hide();
            $('#titulo').html('Buscando eventos <img id="puntos_gif" src="img/puntos.gif" alt="">');
            window.setTimeout(function() {
                location.href="reporte_eventos.php?tipo=A";
            }, 1500);
             
         });
         $('#btn_cerrados').on('click',function(){
            $("#modal").modal({backdrop: 'static', keyboard: false});
            $('.table-responsive').hide();
            $('#titulo').html('Buscando eventos <img id="puntos_gif" src="img/puntos.gif" alt="">');
            window.setTimeout(function() {
                location.href="reporte_eventos.php?tipo=H";
            }, 1500);
         });
         $('#btn_pitch').on('click',function(){
            $("#modal").modal({backdrop: 'static', keyboard: false});
            $('.table-responsive').hide();
            $('#titulo').html('Buscando eventos <img id="puntos_gif" src="img/puntos.gif" alt="">');
            window.setTimeout(function() {
             location.href="reporte_eventos.php?tipo=P";
            }, 1500);
             
         });
         $('#btn_cancelados').on('click',function(){
            $("#modal").modal({backdrop: 'static', keyboard: false});
            $('.table-responsive').hide();
            $('#titulo').html('Buscando eventos <img id="puntos_gif" src="img/puntos.gif" alt="">');
            window.setTimeout(function() {
                location.href="reporte_eventos.php?tipo=C";
            }, 1200);   
             
         });

        
         $('#loader').hide();

        var table = $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Mostrando pagina _PAGE_ de _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Buscar...",
               "sLengthMenu": "Resutlados :  _MENU_",
               "sZeroRecords": "No hay datos disponibles",
               "sInfoEmpty": "Ningun resultado",
            },
            "stripeClasses": [],
            //"lengthMenu": [7, 10, 20, 50],
            "pageLength": 10,
            dom: 'Bfrtip',
                  buttons: [
                      //'excel'
                      {
                                    extend: 'pdfHtml5',
                                    orientation: 'landscape',
                                    pageSize: 'LEGAL'
                                },
                      'excel', 
                  ],
            //"language" : idioma_espaniol,
        });

        $('#zero-config thead tr').clone(true).appendTo( '#zero-config thead' );
        $('#zero-config thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();
        $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );
 /*
    var table = $('#example').DataTable( {
        orderCellsTop: true,
        fixedHeader: true
    } );*/
    </script>
    <script>
        function generate(tipo, texto){
    //mint, sunset, metroui, relax, nest, semantic, light, boostrap-v3
    var tema="mint";
    if(tipo=="success"){
        tema="nest";

    }
    if(tipo=="warning"){
        tema="metroui";

    }
   var n= new Noty({
          text: texto,
          type: tipo,
          theme: tema,
          layout: "top",
          timeout: 4000,
          animation: {
              open : 'animated fadeInRight',
              close: 'animated fadeOutRight'
          }
      }).show();
  return n;
}
        $("#btn_pre").on('click',function(){
            location.href="pre_alta.html"; 
        });

        $("#btn_nuevo").on('click',function(){
            location.href="registro_cliente.php"; 
        });

        $("#btn_pendientes").on('click',function(){
            location.href="clientes.php?tipo=P";
        });
        $("#btn_autorizados").on('click',function(){
            location.href="clientes.php?tipo=A"; 
        });
        $("#btn_bloq").on('click',function(){
            location.href="clientes.php?tipo=B";
        });

        
        $("#zero-config").delegate('.btn_desbloquear','click',function(){
            var id_cliente=$(this).attr("id");
            var n2 = new Noty({
                text: '¿Desea desbloquear al cliente?',
                theme: 'mint',
                closeWith: 'button',
                layout: "center",
                modal: true,
                type: "info",
                buttons: [
                Noty.button('Aceptar', 'btn btn-success', function () {
                    //alert($('input#example').val());
                    cambiar_estatus_cliente(id_cliente, "activo", n2);
                }, {id: 'button1', 'data-status': 'ok'}),
            
                Noty.button('Cancelar', 'btn btn-danger', function () {
                    n2.close();
                })
                ]
            });
            n2.show(); 
        });


        $("#zero-config").delegate('.btn_ver_cliente','click',function(){
            var id_cliente=$(this).attr("id");
            window.parent.$("#frame").attr("src", "registro_cliente.php?id="+id_cliente); 
        });

        $("#zero-config").delegate('.btn_bloquear','click',function(){
            var id_cliente=$(this).attr("id");
            var n2 = new Noty({
                text: '¿Desea bloquear al cliente?',
                theme: 'mint',
                closeWith: 'button',
                layout: "center",
                modal: true,
                type: "info",
                buttons: [
                Noty.button('Aceptar', 'btn btn-success', function () {
                    //alert($('input#example').val());
                    cambiar_estatus_cliente(id_cliente, "bloquear", n2);
                }, {id: 'button1', 'data-status': 'ok'}),
            
                Noty.button('Cancelar', 'btn btn-danger', function () {
                    n2.close();
                })
                ]
            });
            n2.show(); 
        });

        function cambiar_estatus_cliente(id_cliente, estatus, n2){
            var datos={
                    "id_cliente":id_cliente,
                    "estatus": estatus,
                };
                $.ajax({
                    url:   'bloquear_cliente.php',
                    type:  'post',
                    data: datos,
                    async: false,
                    success:  function (response){                        
                        if(response.includes("ok")){
                            var r="bloqueado";
                            if(estatus=="activo"){
                                r="activado";
                            }
                            generate("success","El cliente ha sido "+r);
                            n2.close();
                            window.setTimeout(function() {
                                location.reload();
                            }, 2000); 
                        }
                        else{
                            generate('info', response);
                            n2.close();
                        }
                    }
            });
        }
        $("#div_contenido").delegate('.btn_revivir', 'click',function(e){
        //$(".btn_revivir").on('click',function(e){
            e.preventDefault();
            var numero_evento=$(this).attr("id");
            //var numero_evento=$(this).attr("href");
            swal({
            /* title: "Add Note",
            input: "textarea", */
            text: "¿Realmente deseas revivir el evento "+numero_evento+"?",
            title: "Advertencia",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#1FAB45",
            confirmButtonText: "Aceptar",
            cancelButtonColor: "#ec5a5a",
            cancelButtonText: "Cancelar",
            buttonsStyling: true
        }).then(function () {       
            $.ajax({
                type: "POST",
                url: "revivir_evento.php",
                data: { 'numero_evento': numero_evento},
                cache: false,
                success: function(response) {
                    swal(
                    "Éxito!",
                    "El evento ha sido revivido",
                    "success"
                    )
                },
                failure: function (response) {
                    swal(
                    "Error",
                    response, // had a missing comma
                    "error"
                    )
                }
            });
        }, 
        function (dismiss) {
        if (dismiss === "cancel") {
            /* swal(
            "Cancelled",
                "Canceled Note",
            "error"
            ) */
        }
        });
        //$("#zero-config").delegate('.btn_revivir','click',function(){
            /* var evento=$(this).attr("id");
            var n2 = new Noty({
                text: '¿Desea revivir el evento '+evento+'?',
                theme: 'mint',
                closeWith: 'button',
                layout: "center",
                modal: true,
                type: "info",
                buttons: [
                Noty.button('Aceptar', 'btn btn-success', function () {
                    //alert($('input#example').val());
                    revivir_evento(evento, n2);
                }, {id: 'button1', 'data-status': 'ok'}),
            
                Noty.button('Cancelar', 'btn btn-danger', function () {
                    n2.close();
                })
                ]
            });
            n2.show();  */
        });

        function revivir_evento(numero_evento, n2){
            var parametros={
                "numero_evento": numero_evento
              }
               $.ajax({
                  url:   "revivir_evento.php",
                  type:  'post',
                  data: parametros,
                  success:  function (response) {
                    if(response.includes("evento abierto")){
                      generate("success","El evento ha revivido!!");
                      n2.close();
                    }
                    else{
                      generate('error', "Error: "+response);
                    }
                  }
                });
        }
        
    </script>


</body>
</html>