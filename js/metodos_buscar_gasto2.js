function inicio(){    
 var t;
 var bandera=true;
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
                            "footerCallback": function(row, data, start, end, display) {
                                var api = this.api(),
                                    data; // Remove the formatting to get integer data for summation 
                                var intVal = function(i) {
                                    return typeof i === 'string' ? i.replace(/[\$,]/g, '') * 1 : typeof i === 'number' ? i : 0;
                                };
                                // Total over all pages 
                                data = api.column(4).data();
                                total = data.length ? data.reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }) : 0;
                                // Total over this page 
                                data = api.column(4, {
                                    page: 'current'
                                }).data();
                                pageTotal = data.length ? data.reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }) : 0; // Update footer 
                                var formatter = new Intl.NumberFormat('en-MX', {
                                    style: 'currency',
                                    currency: 'MXN',
                                  
                                    // These options are needed to round to whole numbers if that's what you want.
                                    //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
                                    //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
                                  });
                                  var sum=formatter.format(pageTotal);
                                  sum=sum.replace("MX","");
                                  var tot=formatter.format(total);
                                  tot=tot.replace("MX","");
                                $(api.column(4).footer()).html( sum + ' ( Total: ' + tot + ')');
                            },
                            dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'pdfHtml5',
                                    orientation: 'landscape',
                                    pageSize: 'LEGAL'
                                },
                                'excel', 'print', 'colvis'
                            ],
                           
                            "searching": true,
                            "language": idioma_espaniol,
                            "columnDefs": [
                                { "width": "5%", "targets": 0 }
                            ],
                            "destroy": true,
                            "paging": false,
                            "scrollY":  "500px",
                            "scrollCollapse": true,
                            
                        });
                        /*  var total=0;
                         var T="";
                        $('#tabla').DataTable().rows().data().each(function(el, index){
                            //Asumiendo que es la columna 5 de cada fila la que quieres agregar a la sumatoria
                            var subtotal=el[4].replace("$","");
                            subtotal=subtotal.replace(",","");
                            subtotal=parseFloat(subtotal);
                            total += subtotal;
                            
                            var formatter = new Intl.NumberFormat('en-MX', {
                                style: 'currency',
                                currency: 'MXN',
                              
                                // These options are needed to round to whole numbers if that's what you want.
                                //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
                                //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
                              });
                              T=formatter.format(total)
                              T=T.replace("MX","");
                          });
                          $('#tabla #table_total').html("<b>"+T+"</b>");  */
                          //filtro columnas
                          /* if(bandera){
                            bandera=false;
                            $('#tabla thead tr').clone(true).appendTo( '#tabla thead' );
                            $('#tabla thead tr:eq(1) th').each( function (i) {
                            var title = $(this).text();
                            $(this).html( '<input type="text" class="form-control" placeholder="Buscar '+title+'" />' );
                    
                            $( 'input', this ).on( 'keyup change', function () {

                                if ( t.column(i).search() !== this.value ) {
                                    t
                                        .column(i)
                                        .search( this.value )
                                        .draw();
                                        t.rows().data().each(function(el, index){
                                            alert(index);
                                            //Asumiendo que es la columna 5 de cada fila la que quieres agregar a la sumatoria
                                            var subtotal=el[4].replace("$","");
                                            subtotal=subtotal.replace(",","");
                                            subtotal=parseFloat(subtotal);
                                            total += subtotal;
                                            
                                            var formatter = new Intl.NumberFormat('en-MX', {
                                                style: 'currency',
                                                currency: 'MXN',
                                              
                                                // These options are needed to round to whole numbers if that's what you want.
                                                //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
                                                //maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
                                              });
                                              T=formatter.format(total)
                                              T=T.replace("MX","");
                                          }); 
                                          
                                          //$('#tabla #table_total').html("<b>"+T+"</b>");

                                }
                            } );
                        } );
                          } */
                           
                          
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
            },
            "buttons": {
                "colvis": 'Ocultar'
            }
            
            
           
    }

}


