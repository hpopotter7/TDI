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
       url  : 'reporte_facturas_pendientes.php',
       success :  function(response){
           $(".fa-spin").hide();
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

       $('#reporte_facturacion').delegate('.btn_evento', 'click', function(){
           var evento=$(this).attr('id');
           alert(evento);
       });


       $('#reporte_facturacion').delegate('.btn_detalle', 'click', function(){
            $(".td_ocultar").hide();
           var cliente=$(this).attr('id');  
           var arr=cliente.split("#");
           var contador=arr[0];
           cliente=arr[1];
           $(".tr").css({"background-color": "white"});
           $(this).parent().parent().css({"background-color": "rgba(208,208,208,1)"});
           $('#subtitulo').html(cliente);
           ver_detalle_cliente(cliente, contador);
       });

       function ver_detalle_cliente(cliente, contador){
           var datos={
             "cliente": cliente,
           }
           $.ajax({
               url:   "ver_detalle_facturas_cliente.php",
               type:  'post',
               data: datos,
               success:  function (response) {
                   var fila=$('#td_'+contador);
                   fila.show();
                 //$('#tabla_detalle_body').html(response);
                 fila.html(response);
               
                
               }
             });
         }
}