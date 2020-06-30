function inicio(){    
 var t;
/*
 $.ajax({
    url:   'buscar_campo.php',
    type:  'post',
    success:  function (response) {
            $('#c_campo').html(response);   
    }
  });
*/
 $('#tabla').hide();
    $('#form_buscar').submit(function(e){
        e.preventDefault();
         var $form = $(this);
        if($form.valid()){
            var datos = $('#form_buscar').serializeArray();
            $.ajax({
                url:   'buscar_gasto.php',
                type:  'post',
                data: datos,
                success:  function (response) {
                    $('#tabla').show();
                        $('#tabla').html(response);
                        t = $('#tabla').DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'pdfHtml5',
                                    orientation: 'landscape',
                                    pageSize: 'LEGAL'
                                },
                                'excel', 'print'
                            ],
                            "searching": true,
                            "language": idioma_espaniol,
                            "columnDefs": [
                                { "width": "5%", "targets": 0 }
                            ],
                            "destroy": true,
                        });
                }
              });
        }
    });

    
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

}