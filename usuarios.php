<?php
    $tipo="";
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
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert2.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGE LEVEL STYLES -->

    <!--  <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"> -->

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
    <style>
        i{
            margin-left:5px;
        }
     table {
    transform: scale(.98);
    -webkit-transform: scale(.98);
    -webkit-transform-origin: 0 0;
    -moz-transform: scale(.98);
    -moz-transform-origin: 0 0;
    -o-transform: scale(.98);
    -o-transform-origin: 0 0;
    -ms-transform: scale(.98);
    -ms-transform-origin: 0 0;
} 
    </style>
    <link href="plugins/notification/noty.css" rel="stylesheet">
    <script src="js/sweetalert2.min.js"></script>

    
    <!-- END PAGE LEVEL STYLES --> 
</head>
<body style='background-color: rgba(0,0,0,.0) !important; font-size:12px !important;'>
    <div id="content" class="main-content" style="width: 100% !important; margin-left: 10px !important;background-color: rgba(0,0,0,.0) !important;margin-top: 20px">
        <div class="row">
            <div class="col-md-9"><h2>Usuarios</h2></div>
            <div class="col-md-2 float-right"><h2>           
            <button id='btn_nuevo' type="button" class="btn btn-primary" style='margin-left:10px'><i class="fas fa-plus"></i> Nuevo</button>
            
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
                                        <th>Nombre</th>
                                        <th>Correo</th>
                                        <th>Username</th>
                                        <th>Jefe Directo</th>
                                        <th>Ausente</th>
                                        <th>Tarjetas</th>
                                        <!-- <th>Privilegios</th> -->
                                        <th>Estatus</th>
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
                                   $usuarios_espejo="";
                                    $sql = "SELECT id_usuarios, Nombre, email, User, Jefe_Directo, pa as ausente, (select count(No_tarjeta) from tarjetas where id_usuarios=usuario and Estatus='A') as tarjetas, Estatus, Ejecutivo, Productor, Solicitante, CXP, Digitalizacion, Disenio, Directivo, cat_clientes, cat_prov, cat_facturacion FROM usuarios where email!='alaneduardosandoval@yahoo.com' order by Nombre ASC";
                                   $result = $mysqli->query("SET NAMES 'utf8'");
                                   if ($result = $mysqli->query($sql)) {
                                        while ($row = $result->fetch_assoc()) {                                            
                                            $ausente="";
                                            if($row['ausente']=="1"){
                                                $ausente='<label class="switch s-icons s-outline s-outline-secondary mr-2">
                                                <input type="checkbox" checked id="'.$row['id_usuarios'].'" class="check_ausente"><span class="slider round"></span></label>';
                                            }
                                            else{
                                                $ausente='<label class="switch s-icons s-outline s-outline-secondary mr-2">
                                                <input type="checkbox" id="'.$row['id_usuarios'].'" class="check_ausente"><span class="slider round"></span></label>';
                                            }
                                            $estatus=$row['Estatus'];
                                            
                                            if($estatus=="activo"){
                                                $estatus='<button class="btn btn-success btn_estatus" id="'.$row['id_usuarios'].'">Activo</button>';
                                                $usuarios_espejo=$usuarios_espejo."<option value='".$row['Nombre']."'>".$row['Nombre']."</option>";
                                            }
                                            else{
                                                $estatus='<button class="btn btn-danger btn_estatus" id="'.$row['id_usuarios'].'">Baja</button>';
                                            }
                                            /* $privilegios='<ul style="list-style: none;
                                            margin-left: -40px;">';
                                            if($row['Ejecutivo']=="X"){
                                                $privilegios=$privilegios.'<li><i class="fas fa-check" style="color:#429d4e;"></i> Ejecutivo</li>';
                                            }
                                            if($row['Productor']=="X"){
                                                $privilegios=$privilegios.'<li><i class="fas fa-check" style="color:#429d4e;"></i> Productor</li>';
                                            }
                                            if($row['Disenio']=="X"){
                                                $privilegios=$privilegios.'<li><i class="fas fa-check" style="color:#429d4e;"></i> Diseño</li>';
                                            }
                                            if($row['Solicitante']=="X"){
                                                $privilegios=$privilegios.'<li><i class="fas fa-check" style="color:#429d4e;"></i> Solicitante</li>';
                                            }
                                            if($row['Digitalizacion']=="X"){
                                                $privilegios=$privilegios.'<li><i class="fas fa-check" style="color:#429d4e;"></i> Digital</li>';
                                            }
                                            if($row['CXP']=="X"){
                                                $privilegios=$privilegios.'<li><i class="fas fa-check" style="color:#429d4e;"></i> Cuentas por pagar</li>';
                                            }
                                            if($row['cat_clientes']=="X"){
                                                $privilegios=$privilegios.'<li><i class="fas fa-check" style="color:#429d4e;"></i> Ver clientes</li>';
                                            }
                                            if($row['cat_prov']=="X"){
                                                $privilegios=$privilegios.'<li><i class="fas fa-check" style="color:#429d4e;"></i> Ver proveedores</li>';
                                            }
                                            if($row['cat_facturacion']=="X"){
                                                $privilegios=$privilegios.'<li><i class="fas fa-check" style="color:#429d4e;"></i> Facturacion</li>';
                                            } */
                                                 $res=$res.'<tr><td>'.$row['Nombre'].'</td><td>'.strtolower($row['email']).'</td><td>'.strtoupper($row['User']).'</td><td>'.$row['Jefe_Directo'].'</td><td>'.$ausente.'</td><td><button id="'.$row['id_usuarios'].'" class="btn btn-info btn-sm btn_ver_usuario">'.$row['tarjetas'].'</button></td><td>'.$estatus.'</td><td style="width:20%"><i id="'.$row['id_usuarios'].'" data-toggle="tooltip" data-placement="top" title="Ver usuario" class="fas fa-edit fa-2x btn_ver_usuario" style="color:#429d4e; cursor:pointer"></i><i id="'.$row['id_usuarios'].'" class="fas fa-redo-alt fa-2x btn_reset" style="color:#6422bd; cursor:pointer;" data-toggle="tooltip" data-placement="top" title="Restablecer contraseña"></i><i id="'.$row['Nombre'].'" class="fas fa-clone fa-2x btn_espejo" style="color:#3484e4; cursor:pointer;" data-toggle="tooltip" data-placement="top" title="Espejo"></i></td></tr>';
                                       }
                                       
                                       $result->close();
                                   }else{
                                       $res="<tr><td>".mysqli_error($mysqli)."</td></tr>";
                                   }
                                   //echo json_encode($data);
                                   echo $res;
                                   $mysqli->close();
                                   
                                   ?>
                                </tbody>
                               
                            </table>
                            <div id='div_espejo' style='display:none'>Selecciona un usuario: <select id='cespejo' class='form-control'><?php echo $usuarios_espejo;?></select></div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
       
    </div>
    <!--  END CONTENT AREA  -->
</div>
<!-- END MAIN CONTAINER -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script> -->
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
    <script src="js/sweetalert2.min.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.flash.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="js/jspdf.min.js"></script>
    <script src="plugins/notification/noty.js" type="text/javascript"></script>
    <script>
        

        $('[data-toggle="tooltip"]').tooltip();
        
        var table = $('#zero-config').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Mostrando pagina _PAGE_ de _PAGES_",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Buscar...",
               "sLengthMenu": "Resultados :  _MENU_",
            },
            //"stripeClasses": [],
            "lengthMenu": [5, 10, 15],
            "pageLength": 5,
            "paging": true,
            "scrollX": true,
             "columnDefs": [
                { "width": "15%", "targets": [0,3,6] },
                //{ "width": "50%", "targets": [0,8] }
            ], 
            /* dom: 'Bfrtip',
                  buttons: [
                      //'excel'
                      'excel', 'pdf',
                  ], */
            //"language" : idioma_espaniol,*/
                });

        /* $('#zero-config thead tr').clone(true).appendTo( '#zero-config thead' );
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
    } ); */
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
            window.parent.$('#ol_menu').html("Catálogos");
            window.parent.$('#ol_submenu').html("Usuarios / Nuevo");
            window.parent.$("#frame").attr("src", "formulario_registro_usuario.php"); 
        });
        
        $("#zero-config").delegate('.btn_ver_usuario','click',function(){            
            var id_usuario=$(this).attr("id");
            window.parent.$("#frame").attr("src", "formulario_registro_usuario.php?id="+id_usuario); 
        });

        $("#zero-config").delegate('.btn_estatus','click',function(){            
            var id_usuario=$(this).attr("id");
            var estatus=$(this).html();
            if(estatus=="Activo"){
                estatus="baja"
            }else{
                estatus="activo"
            }
            var datos={
                    "id_usuario":id_usuario,
                    "estatus": estatus,
                };
                $.ajax({
                    url:   'cambiar_estatus_usuario.php',
                    type:  'post',
                    data: datos,
                    async: false,
                    success:  function (response) {
                        if(response.includes("ok")){
                            generate("success","El usuario se ha actualizado");
                            window.setTimeout(function() {
                            location.reload();
                        }, 2900); 
                        }
                        else{
                            generate('info', response);
                        }
                    }
            });
        });

        $("#zero-config").delegate('.btn_reset','click',function(){ 
            var id_usuario=$(this).attr("id");
            var n2 = new Noty({
                text: '¿Desea restablecer la contraseña?',
                theme: 'mint',
                closeWith: 'button',
                layout: "center",
                modal: true,
                type: "info",
                buttons: [
                Noty.button('Aceptar', 'btn btn-success', function () {
                    //alert($('input#example').val());
                    var datos={
                        "id_usuario":id_usuario,
                    };
                    $.ajax({
                        url:   'restablecer_pass.php',
                        type:  'post',
                        data: datos,
                        async: false,
                        success:  function (response) {
                            if(response.includes("ok")){
                                generate("success","La contraseña se ha restablecido");
                                n2.close();
                            }
                            else{
                                generate('info', response);
                                n2.close();
                            }
                        }
                });
                }, {id: 'button1', 'data-status': 'ok'}),
            
                Noty.button('Cancelar', 'btn btn-danger', function () {
                    n2.close();
                })
                ]
            });
            n2.show();
        });

        $("#zero-config").delegate('.check_ausente','change',function(){ 
            var id_usuario=$(this).attr("id");
            var pa="0";
            if ($(this).is(':checked')) {
                pa="1";
            }
            //alert($('input#example').val());
            var datos={
                "id_usuario":id_usuario,
                "pa": pa,
            };
            $.ajax({
            url:   'usuario_ausente.php',
            type:  'post',
            data: datos,
            async: false,
            success:  function (response) {
                if(response.includes("ok")){
                    generate("success","el usuario se ha actualizado");
                }
                else{
                    generate('info', response);
                }
            }
            });
        });

        $("#zero-config").delegate('.btn_espejo','click',function(){
            var usuario_origen=$(this).attr("id");
            var n2 = new Noty({
                text: $('#div_espejo').html(),
                theme: 'mint',
                closeWith: 'button',
                layout: "center",
                modal: true,
                type: "info",
                buttons: [
                Noty.button('Aceptar', 'btn btn-success', function () {
                    var usuario_destino=$('select#c_espejo').val();
                    var datos={
                        "usuario_origen":usuario_origen,
                        "usuario_destino":usuario_destino,
                    };
                    $.ajax({
                        url:   'espejo_usuarios.php',
                        type:  'post',
                        data: datos,
                        async: false,
                        success:  function (response) {
                            if(response.includes("updates listos")){
                                generate("success","El usuario ha sido clonado");
                                n2.close();
                            }
                            else{
                                generate('info', response);
                                n2.close();
                            }
                        }
                });
                }, {id: 'button1', 'data-status': 'ok'}),
            
                Noty.button('Cancelar', 'btn btn-danger', function () {
                    n2.close();
                })
                ]
            });
            n2.show();
        });
        
        
    </script>


</body>
</html>