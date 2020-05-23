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
        url  : 'reporte_eventos_pitch.php',
        success :  function(response){
            $('#reporte_eventos').html(response); 
            $('#reporte_eventos').DataTable({
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
}