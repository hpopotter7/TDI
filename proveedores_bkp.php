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
  <link rel="stylesheet" href="css/jquery.fancybox.css" />
  <link rel="stylesheet" href="css/font-awesome.css">
  <link rel="stylesheet" href="css/animate.css"/>
  <link rel="stylesheet" href="css/sweetalert2.css"/>  
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap.min6.css">
  <link rel="stylesheet" href="css/estilos_ver_0006.css"/>
  <link rel="stylesheet" href="css/chosen.css"/>
  <link rel="stylesheet" href="css/data_tables.css">
  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
  
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  
  <script
  src="https://code.jquery.com/jquery-2.2.4.js"
  integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI="
  crossorigin="anonymous"></script>
  
  <script src="js/jquery-1.11.2.js"></script>
  <script src="js/jquery-ui-v1.11.4.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.ui.shake.js"></script>    
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.mousewheel.pack.js"></script>
  <script src="js/dataTables.js"></script>
  <script src='js/DateTables.js'></script>
  
  <script src="js/dataTables.buttons.min.js"></script>
  <script src="js/buttons.flash.min.js"></script>
  <script src="js/jszip.min.js"></script>
  <script src="js/pdfmake.min.js"></script>
  <script src="js/vfs_fonts.js"></script>
  <script src="js/buttons.html5.min.js"></script>
  <script src="js/buttons.print.min.js"></script>
  <script src="js/jspdf.min.js"></script>
  <script src="js/jquery.modal.js"></script> 
</head>
<body style='background-color: rgba(255,2552,255,0) !important;background:none !important;'>
   
    <div class="col-md-12">
            <div id='div_reporte_eventos'>
                  <div class="col-md-8 col-xs-8" class='titulo_reporte'><legend><h2>Proveedores</h2></legend></div>
                  <div class="col-md-2 col-md-2 pull-right abajo" >
                  <button id='btn_nuevo' type="button" class="btn btn-success"><i class="fas fa-plus"></i> Nuevo</button>
                  </div>
                  <div class="clearfix">
                    <p><br></p>
                    </div>
                    <hr><br></p>
                  <!-- <table id='config' class="table display nowrap dataTable" style="width:100%"> -->
                  <table id="zero-config" class="table table-hover" style="width:100%">
                  <thead>
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
                      $sql = "SELECT Razon_Social, Nombre_comercial, rfc, Nombre_contacto, Telefono, Correo_contacto FROM proveedores where Numero_cliente!='0' and Estatus='activo' order by Razon_Social ASC";
                      $result = $mysqli->query("SET NAMES 'utf8'");
                      if ($result = $mysqli->query($sql)) {
                          while ($row = $result->fetch_row()) {
                              $res=$res.'<tr><td>'.$row[0].'</td><td>'.$row[1].'</td><td>'.$row[2].'</td><td>'.$row[3].'</td><td>'.$row[4].'</td><td>'.strtolower($row[5]).'</td><td><button class="btn btn-success"><i class="fas fa-edit" style="color:#fff"></i></button></td></tr>';
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
</body>
<script>
        

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
            "pageLength": 10,
            dom: 'Bfrtip',
                  buttons: [
                      //'excel'
                      'excel', 
                      {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            }
                  ],
                  "columnDefs": [
          { "width": "15%", "targets": 2 }
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

      $("#btn_nuevo").on('click',function(){
        window.parent.$('#ol_menu').html("Catálogos");
        window.parent.$('#ol_submenu').html("Proveedores / Nuevo");
        window.parent.$("#frame").attr("src", "nuevo_cliente.html"); 
    });
    </script>
</html>



