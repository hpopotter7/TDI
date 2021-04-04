<?php
$tipo="A";
if(isset($_GET['tipo'])){
    $tipo=$_GET['tipo'];
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

    <script src="js/sweetalert2.min.js"></script>
    <style>
    table {
    transform: scale(.88);
    -webkit-transform: scale(.88);
    -webkit-transform-origin: 0 0;
    -moz-transform: scale(.88);
    -moz-transform-origin: 0 0;
    -o-transform: scale(.88);
    -o-transform-origin: 0 0;
    -ms-transform: scale(.88);
    -ms-transform-origin: 0 0;
}
    </style>
    <!-- END PAGE LEVEL STYLES --> 
</head>
<body style='background-color: rgba(0,0,0,.0) !important; font-size:12px !important'>
    <div id="content" class="main-content" style="margin-top:10px;width: 100% !important; margin-left: 10px !important;background-color: rgba(0,0,0,.0) !important;">
        <div class="row">
            <div class="col-md-8"><h2>Proveedores</h2></div>
            <div class="col-md-4"><h2>
            <?php
            if($_COOKIE['user']=="ALAN SANDOVAL" || $_COOKIE['user']=="SANDRA PEÑA" || $_COOKIE['user']=="MIGUEL POBLACION"){
                echo '<button id="btn_bloq" type="button" class="btn btn-primary"><i class="fas fa-lock"></i> Bloqueados</button>';
            }
                if($tipo=="A"){
                    echo '<button id="btn_pendientes" type="button" class="btn btn-primary"><i class="far fa-square"></i> Por autorizar</button>';
                }
                else{
                    echo '<button id="btn_autorizados" type="button" class="btn btn-primary"><i class="fas fa-check-square"></i> Autorizados</button>';
                }
            ?>
            
            <button id='btn_nuevo' type="button" class="btn btn-primary"><i class="fas fa-plus"></i> Nuevo</button>
            
        </h2></div>
        </div>
                  
        
        <div class="layout-px-spacing">
            <div class="row layout-top-spacing">
                <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                    <div class="widget-content widget-content-area br-6">
                        <div class="table-responsive mb-4 mt-4">
                            <table id="zero-config" class="table table-hover table-bordered table-sm" style="width:100%">
                                <thead style='background-color: rgba(155,175,55,.9) !important;'>
                                    <tr>
                                        <th>Razón social</th>
                                        <th>Nombre comercial</th>
                                        <th>RFC</th>
                                        <th>Nombre contacto</th>
                                        <th>Teléfono</th>
                                        <th>Correo contacto</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php
                                   include("conexion.php");
                                   if (mysqli_connect_errno()) {
                                       printf("Error de conexion: %s\n", mysqli_connect_error());
                                       exit();
                                   }
                                   function asmoneda($value) {
                                     return '$' . number_format($value, 2);
                                   }
                                   $res='';
                                   $where="";
                                   if($tipo=="A"){
                                    $sql = "SELECT Razon_Social, Nombre_comercial, rfc, Nombre_contacto, Telefono, Correo_contacto, id_proveedor FROM proveedores where Numero_cliente!='0' and Estatus='activo' order by Razon_Social ASC";
                                   }
                                   if($tipo=="B"){
                                    $sql = "SELECT Razon_Social, Nombre_comercial, rfc, Nombre_contacto, Telefono, Correo_contacto, id_proveedor FROM proveedores where Estatus='Bloqueado' or Estatus='borrado' order by Razon_Social ASC";
                                   }
                                   if($tipo=="P"){
                                    $sql = "SELECT Razon_Social, Nombre_comercial, rfc, Nombre_contacto, Telefono, Correo_contacto, id_proveedor FROM proveedores where Numero_cliente='0' and Estatus='activo' order by Razon_Social ASC";
                                   }
                                   
                                   $result = $mysqli->query("SET NAMES 'utf8'");
                                   if ($result = $mysqli->query($sql)) {
                                        while ($row = $result->fetch_row()) {
                                            if($tipo=="A"){
                                                if($_COOKIE['user']=="ALAN SANDOVAL" || $_COOKIE['user']=="SANDRA PEÑA" || $_COOKIE['user']=="MIGUEL POBLACION"){
                                                 $res=$res.'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td><i id="'.$row[6].'" data-toggle="tooltip" data-placement="top" title="Ver proveedor" class="fas fa-edit fa-2x btn_ver_proveedor" style="color:green; cursor:pointer"></i><i id="'.$row[6].'" data-toggle="tooltip" data-placement="top" title="Bloquear proveedor" class="fas fa-ban fa-2x btn_bloquear" style="color:#f64;cursor:pointer"></i></td></tr>';
                                                }
                                                else{
                                                    $res=$res.'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td><i id="'.$row[6].'" data-toggle="tooltip" data-placement="top" title="Ver proveedor" class="fas fa-edit fa-2x btn_ver_proveedor" style="color:green; cursor:pointer"></i></td></tr>';
                                                }
                                            }
                                            if($tipo=="B"){

                                                $res=$res.'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td><i id="'.$row[6].'" data-toggle="tooltip" data-placement="top" title="Desbloquear proveedor" class="fas fa-unlock fa-2x btn_desbloquear" style="color:DarkGoldenRod; cursor:pointer"></i></td></tr>';
                                           }
                                           if($tipo=="P"){
                                                $res=$res.'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.$row[5].'</td><td><i id="'.$row[6].'" data-toggle="tooltip" data-placement="top" title="Ver proveedor" class="fas fa-eye fa-2x btn_ver_proveedor" style="color:blue; cursor:pointer"></i></td></tr>';
                                            }
                                       }
                                       $result->close();
                                   }
                                   
                                   //echo json_encode($data);
                                   echo $res;
                                   $mysqli->close();
                                   
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
    <script>
         $('[data-toggle="tooltip"]').tooltip();

        var table = $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Mostrando pagina _PAGE_ de _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Buscar...",
               "sLengthMenu": "Resutlados :  _MENU_",
            },
            "stripeClasses": [],
            //"lengthMenu": [7, 10, 20, 50],
            "pageLength": 5,
            dom: 'Bfrtip',
                  buttons: [
                      //'excel'
                      'excel', 'pdf',
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

        $("#btn_nuevo").on('click',function(){
            location.href="registro_proveedor.php"; 
        });

        $("#btn_pendientes").on('click',function(){
            location.href="proveedores.php?tipo=P";
        });
        $("#btn_autorizados").on('click',function(){
            location.href="proveedores.php?tipo=A"; 
        });
        $("#btn_bloq").on('click',function(){
            location.href="proveedores.php?tipo=B";
        });

        
        $("#zero-config").delegate('.btn_desbloquear','click',function(){
            var id_cliente=$(this).attr("id");
            var n2 = new Noty({
                text: '¿Desea desbloquear al proveedor?',
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


        $("#zero-config").delegate('.btn_ver_proveedor','click',function(){
            var id_cliente=$(this).attr("id");
            location.href="registro_proveedor.php?id="+id_cliente; 
        });

        $("#zero-config").delegate('.btn_bloquear','click',function(){
            var id_cliente=$(this).attr("id");
            var n2 = new Noty({
                text: '¿Desea bloquear al proveedor?',
                theme: 'mint',
                closeWith: 'button',
                layout: "center",
                modal: true,
                type: "info",
                buttons: [
                Noty.button('Aceptar', 'btn btn-success', function () {
                    //alert($('input#example').val());
                    cambiar_estatus_cliente(id_cliente, "Bloqueado", n2);
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
                    "tabla":"proveedores",
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
        
    </script>


</body>
</html>