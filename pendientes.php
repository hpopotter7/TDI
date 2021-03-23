<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Tabs | CORK - Multipurpose Bootstrap Dashboard Template </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!--  BEGIN CUSTOM STYLE FILE  -->
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/sweetalert2.css"/>
    <link href="plugins/notification/noty.css" rel="stylesheet">
    <link href="assets/css/components/tabs-accordian/custom-tabs.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
    <!--  END CUSTOM STYLE FILE  -->
    <style>
        .nav-link {
            background-color:transparent;
        }
        .nav-link .active{
            background-color:#6610f2 !important;
        }
    </style>
    <script src="js/sweetalert2.min.js"></script>
</head>
<body style='background-color: rgba(255,2552,255,0) !important;background:none !important;'>
	<div style="width:100% !important;;margin: auto;">
    <h2>Eventos Pendientes</h2>
<div class="row mb-4 mt-3">
    <div class="col-sm-3 col-12">
    
        <div class="nav flex-column nav-pills mb-sm-0 mb-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <a href='ver_facturas_pendientes.php' id="btn_sin_numero" class="btn btn-danger largo btn-block">Eventos con factura sin número</a>
          <a href='ver_pendientes_sin_estatus.php' id="btn_sin_estatus" class="btn btn-danger largo btn-block">Eventos con factura sin estatus</a>
          <a href='ver_egresos_sin_facturar.php' id="btn_sin_facturar" class="btn btn-danger largo btn-block">Eventos con egresos sin facturar</a>
          <a href='ver_eventos_sin_cerrar.php' id="btn_sin_cerrar" class="btn btn-danger largo btn-block">Eventos pendiente por cerrar</a>
          <a href='ver_eventos_sin_pagar.php' id="btn_sin_pagar" class="btn btn-danger largo btn-block">Eventos con solicitudes sin pagar</a>
          <a href='ver_eventos_sin_comprobar.php' id="btn_sin_comprobar" class="btn btn-danger largo btn-block">Eventos con solicitudes sin comprobar</a>
          <a href='ver_eventos_vacios.php' id="btn_vacios" class="btn btn-danger largo btn-block">Eventos vacios</a>
        </div>
    </div>
    <div class="col-sm-8 col-12" >
        <span id='loading_pendientes'></span>
          <div class="table-responsive">
                <table id='tabla_pendientes' class="table table-bordered" style='background-color:rgba(255,255,255,.5)'>
                    
                    
                </table>
            </div>
    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<!--<script src="assets/js/libs/jquery-3.1.1.min.js"></script>-->
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/notification/noty.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.flash.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="js/jspdf.min.js"></script>
    <script>
        var idioma_espaniol = {
    "sProcessing":     "Procesando...",
    "sLengthMenu":     "Mostrar _MENU_ registros",
    "sZeroRecords":    "No se encontraron resultados",
    "sEmptyTable":     "Ningún dato disponible en esta tabla",
    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
    "sInfoPostFix":    "",
    "sSearch":         "Buscar:",
    "sUrl":            "",
    "sInfoThousands":  ",",
    "sLoadingRecords": "Cargando...",
    "oPaginate": {
        "sFirst":    "Primero",
        "sLast":     "Último",
        "sNext":     "Siguiente",
        "sPrevious": "Anterior"
    },
    "oAria": {
        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
    }
    }
    ver_botones();

     /* $('#tabla_pendientes').DataTable({
                
                "destroy":        true,
                "scrollCollapse": true,
                "scrollY":        true,
                
                "paging": true,
                "pageLength": 5,
                "language" : idioma_espaniol,
                dom: 'Bfrtip',
                buttons: [
                    'pdf', 'excel'
                ],
            });  */

    function ver_botones(){
        $.ajax({
            url:   'filtrar_usuario.php',
            type:  'post',
            beforeSend: function(){
                $('#loading_pendientes').html("<p>Buscando <img src='img/puntos.gif'>");
            },
            success:  function (response) {
                $('#loading_pendientes').html("");
                if(response.includes("ADMIN")){
                    llenar_tabla_pendientes("ver_facturas_pendientes.php", "Eventos con factura sin número");
                   
                }
                else if(response.includes("EJECUTIVO")){
                    $('#btn_sin_numero').remove();
                    $('#btn_sin_estatus').remove();
                    $('#btn_sin_pagar').remove();
                    $('#btn_sin_comprobar').remove();
                    llenar_tabla_pendientes("ver_egresos_sin_facturar.php", "Eventos con egresos sin facturar");
                    
                }
                else if(response.includes("CXP")){
                    $('#btn_sin_numero').remove();
                    $('#btn_sin_estatus').remove();
                    $('#btn_sin_facturar').remove();
                    $('#btn_sin_cerrar').remove();
                    $('#btn_vacios').remove();
                    llenar_tabla_pendientes("ver_eventos_sin_pagar.php", "Eventos con solicitudes sin pagar");
                    
                }
            }
            });
    }

        $('.btn').on('click', function(e){
            e.preventDefault();
            var titulo=$(this).html();
            var pagina=$(this).attr('href');
            $('#titulo').html(titulo);
            llenar_tabla_pendientes(pagina,titulo);
        });

        function llenar_tabla_pendientes(pagina, titulo){
            var datos={
            "titulo": titulo,
            };
            $.ajax({
            url:  pagina,
            type:  'post',
            data: datos,
            success:  function (response) {
            $('#tabla_pendientes').html(response);
             $('#tabla_pendientes').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'pdf', 'excel'
                ],
                "destroy":        true,
                "scrollY":        true,
                "scrollCollapse": true,
                "paging": true,
                "pageLength": 10,
                "sort":           false,
                "language" : idioma_espaniol,
            }); 
            }
            });
        }

        $("#tabla_pendientes").delegate(".btn_evento_pendiente", "click", function(e) {
            var id=$(this).attr('id');
            var url="solicitudes.php?evento="+id;
            parent.location.href="home.php?sol="+id; 
            //parent.$('.principal_content').css('margin-top','160px');
            //parent.$('#content').css('height','840px');
            //parent.$("#frame").attr("src", "modificar_evento.php");
        });
    </script>
   </body>
</html>