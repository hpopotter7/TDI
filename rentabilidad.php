
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert2.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/chosen.css"/>
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-select/bootstrap-select.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
    
    <style>
        i{
            margin-left:5px;
        }
    </style>
    <link href="plugins/notification/noty.css" rel="stylesheet">
    <script src="js/sweetalert2.min.js"></script>

    
    <!-- END PAGE LEVEL STYLES --> 
</head>
<body>
<div id="content" class="main-content" style="margin-top:10px;width: 80% !important; margin: 20px auto !important;background-color: rgba(0,0,0,.0) !important;">
    <div class="row">
      <div class="col-md-12"><h2>Reporte de rentabilidad por cliente</h2></div>     
  </div>
  <div class="form-group">
    <label >Selecciona un periodo: </label>
    <select data-placeholder="(Seleccione al menos un periodo)" id="c_periodos" class='form-control' multiple='multiple'>
  </select>
</div> 
<div class="row"><button type="button" id='btn_buscar' class="btn btn-primary">Buscar</button>
<div id='spin' style='display:none' ><i  class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> Buscando datos...</div></div>
<div class="row col-md-12" id='tarjetas_resultado'> </div>

    </div>


  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
  <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!--
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    -->

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
    <script src="js/chosen.jquery.js"></script>
    <script src="plugins/notification/noty.js" type="text/javascript"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
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

    //$("#c_periodos").chosen();

    $.ajax({
        url: "ver_periodos.php",
        type: 'post',
        async: false,
        beforeSend: function () {
            $('#mensaje').show();
        },
        success: function (response) {
            $('#c_periodos').html(response);
            $("#c_periodos option[value='vacio']").remove();
            $("#c_periodos").chosen({ allow_single_deselect:false });
        },
        complete: function () {
            //$('#mensaje').hide();
        },
    });
    
      
    $('#btn_buscar').on('click', function(){
        var periodos=$('#c_periodos').val();
        $('#tarjetas_resultado').html("");
        
        if(periodos==null){
            swal('Oops','Debe seleccionar al menos un periodo','warning');
        }
        else{
            var like="";
            for(var r=0;r<=periodos.length-1;r++){
                like=like+" Numero_Evento LIKE  '"+periodos[r]+"-%' or";
            }
            var largo=like.length;
            like=like.substr(0,largo-3);
            var datos={
                "like":like
            };
            
            $.ajax({
                url: "reporte_rentabilidad.php",
                type: 'post',
                data: datos,
                beforeSend: function () {
                    $('#spin').show();
                },
                success: function (response) {
                    $('#spin').hide();
                    $('#tarjetas_resultado').html(response);
                    $('body .oculto').hide();
                    $('#tarjetas_resultado table').dataTable({
                        "searching": true,
                        "language" : idioma_espaniol,
                        "lengthChange": false,
                        "ordering": false,
                        dom: 'Bfrtip',
                        buttons: [
                            {
                                extend: 'excelHtml5',
                                title: 'Rentabilidad por cliente'
                            },
                        ]
                        });
                },error: function (xhr, ajaxOptions, thrownError) {
                    alert("Ocurrio un error");
                    console.log(xhr.responseText);
                    console.log(thrownError);
            }
                
            });
        }
        
    });

    
    
    </script>
</body>
</html>