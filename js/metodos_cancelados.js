function inicio(){
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

    $.ajax({
       type : 'POST',
       url  : 'reporte_eventos_cancelados.php',
       success :  function(response){
           $('#reporte_eventos').html(response); 
           $('#reporte_eventos').DataTable({
               dom: 'Bfrtip',
               buttons: [
                   'excel', 'pdf'
                   //'excel', 'pdf',
               ],
               
               "destroy": true, 
               "sort": true,
               
               "language" : idioma_espaniol
           });            
       }
       }); 
/*
       $('#reporte_eventos').delegate('.ver_solicitudes', 'click', function(){
           
           var evento=$(this).attr('id');
           ver_solicitudes_por_evento(evento);
       });

       function ver_solicitudes_por_evento(evento){
           var datos={
             "evento": evento,
             "usuario": $('#label_user').html(),
           }
           $.ajax({
               url:   "ver_solicitudes_por_evento.php",
               type:  'post',
               data: datos,
               success:  function (response) {
                 var arr=response.split("$$$");
                 $('#resultado_solicitudes').html(arr[0]);
                 $('#espacio').show();
                // $('#tabla_resumen_solicitudes').DataTable();
                 $('#tabla_resumen_solicitudes').DataTable({
                   "searching": true,
                   "language" : idioma_espaniol,
                   //"lengthChange": false,
                   //"ordering": false,
                   "paging": false,
                   //"scrollX": false,
                   "destroy": true, 
                  //  "sort": false,
                   //"scrollX": true,
                   //"scrollCollapse": false,4
                   /*
                   "columnDefs": [
                       { "width": "3%", "targets": [-1,-2,-3] }
                   ],
                   
                   "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
                  
                }); 
               }
             });
         }
         */
}