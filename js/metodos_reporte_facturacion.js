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
           var id_evento=$(this).attr('id');

           var datos={
            "id_evento": id_evento,
          }
          $.ajax({
              url:   "guardar_cookie.php",
              type:  'post',
              data: datos,
              success:  function (response) {
              }
            });
           
           window.setTimeout(function(){
            window.parent.$('#menu_ver_formatos').click();
          }, 1000);
           
           /*
           window.parent.$("#div_cortina").animate({top: '0px'}, 1100);
           window.parent.$('#div_formatos').fadeIn();
           alert(id_evento);
           window.parent.$('#c_mis_eventos').val(id_evento);
           window.parent.$('#c_mis_eventos').trigger("chosen:updated");
           */
           
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

        /*  $.fancybox.open({
                  src  : "../solicitud_factura.php?id=797",
                  type : 'iframe',
                  opts : {
                    afterShow : function( instance, current ) {
                      //console.info( 'done!' );
                      alert("asd");
                    }
                  }
                }) */

                $('#reporte_facturacion').delegate('.btn_solicitud', 'click', function(){
                    var num_factura=$(this).attr('id');
                    $(".btn_solicitud" ).fancybox({
                        //maxWidth	: 800,
                        //maxHeight	: 600,
                        fitToView	: true,
                        width		: '90%',
                        height		: '90%',
                        autoSize	: false,
                        closeClick	: false,
                        openEffect	: 'none',
                        closeEffect	: 'none',
                        'type'      : 'iframe',
                        'href'      : "solicitud_factura.php?id="+num_factura,
                    });
               });

               $('#reporte_facturacion').delegate('.btn_factura', 'click', function(e){
                   e.preventDefault();
                var href=$(this).attr('id');                
                $(".btn_factura" ).fancybox({
                    //maxWidth	: 800,
                    //maxHeight	: 600,
                    fitToView	: true,
                    width		: '90%',
                    height		: '90%',
                    autoSize	: false,
                    closeClick	: false,
                    openEffect	: 'none',
                    closeEffect	: 'none',
                    'type'      : 'iframe',
                    'href'      : href,
                });
           });

                
}