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
       url  : 'reporte_demo.php',
       success :  function(response){
           $('#reporte_facturacion').html(response); 
           $('#reporte_facturacion').DataTable({
               dom: 'Bfrtip',
               buttons: [
                   'excel', 'pdf'
                   //'excel', 'pdf',
               ],
               "scrollX": true,
               "destroy": true, 
               "sort": false,
               "language" : idioma_espaniol
           });            
       }
       }); 


       $('#reporte_facturacion').delegate('.btn_detalle', 'click', function(){
           var cliente=$(this).attr('id');           
            $(".tr").css({"background-color": "white"});
           $(this).parent().parent().css({"background-color": "rgba(208,208,208,1)"});
           ver_detalle_cliente(cliente);
       });

       function ver_detalle_cliente(cliente){
           var datos={
             "cliente": cliente,
           }
           $.ajax({
               url:   "ver_detalle_cliente.php",
               type:  'post',
               data: datos,
               success:  function (response) {
                 $('#resultado').html(response);
                // $('#tabla_resumen_solicitudes').DataTable();
                 $('#resultado').DataTable({
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
                   */
                   //"lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
                  
                }); 
               }
             });
         }
}