function inicio() {

    var eventos = "";

    var t;
    $('#loader_buscar').hide();
    $('#area').hide();

    var idioma_espaniol = {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }

    ver_eventos("0"); 

    function ver_eventos(periodo){
        $('#c_eventos').html("");
        
    $.ajax({
        url: "ver_eventos_reporte_gastos.php",
        type: 'GET',
        data: "periodo="+periodo,
        beforeSend: function () {
            $('#mensaje').show();
        },
        success: function (response) {
            console.log(response);
            if(response.includes("Error")){
                alert(response);
            }
            else{
                $('#c_eventos').html(response);
                $('#c_eventos').multiselect({
                    enableCaseInsensitiveFiltering:false,
                    enableClickableOptGroups: true,
                    enableCollapsibleOptGroups: true,
                    enableFiltering: true,
                    includeSelectAllOption: false,
                    collapseOptGroupsByDefault: true
                });
                $('#c_eventos').multiselect('selectAll', true);
                
                
            }
            $('#mensaje').hide();
        },
        complete: function () {
           // $('#mensaje').hide();
        },
    });
}

    $.ajax({
        url: "ver_periodos.php",
        type: 'post',
        async: false,
        beforeSend: function () {
            $('#mensaje').show();
        },
        success: function (response) {
            $('#c_periodo').html(response);
            $("#c_periodo option[value='vacio']").remove();
            $("#c_periodo").chosen({ allow_single_deselect:false });
        },
        complete: function () {
            //$('#mensaje').hide();
        },
    });

/*
    $('#c_clientes').on('change', function (evt, params) {
        generar_query();
    });
    */

    $('#c_eventos').on('change', function (evt, params) {
        //generar_query();
    });

    $('#c_periodo').on('change', function (evt, params) {
       // $('#c_eventos').multiselect("destroy");
        var periodo=$('#c_periodo').val();
        if(periodo==null){
            generate('warning', "Debe seleccionar al menos un periodo");
            $('#c_periodo').val("2019").trigger('chosen:updated');
        }        
        $('#c_eventos').multiselect('destroy');
            ver_eventos(periodo);
        
    });


   


    function generate(type, text) {
        var n = noty({
            text: text,
            type: type,
            dismissQueue: true,
            layout: 'topCenter',  //bottomLeft
            progressBar: true,
            maxVisible: 10,
            timeout: [3000],

        });
        return n;
    }

    
    
    $('#btn_buscar').click(function () {
        var periodo=$('#c_periodo').val();
        var eventos=$('#c_eventos').val();
        
        if(eventos=="" || eventos==null){
            eventos="todos";
        }
        var periodo="";
        $("#c_periodo :selected").each(function() {
            periodo=periodo+$(this).attr('value')+",";
          });
        
        var datos = {
            "eventos": eventos,
            "periodo":periodo,
        };

        $.ajax({
            url: "generar_reporte_gastos.php",
            type: 'post',
            data: datos,
            beforeSend: function (e) {
                $('#loader_buscar').show();
            },
            success: function (response) {
                $('#tabla').show();
                $('#loader_buscar').hide();
                if (response.includes("Error:")) {
                    generate("error", "Ocurrio un error<p>" + response);
                }
                else {
                    $('#tabla_reporte').html(response);
                    t = $('#tabla_reporte').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv', 'excel', 'pdf', 'print'
                        ],
                        "searching": true,
                        "language": idioma_espaniol,
                        "lengthChange": false,
                        "destroy": true,
                        "ordering": true,
                        //"scrollX": true,
                        "scrollCollapse": true,
                        "columnDefs": [
                            { "width": "10%", "targets": 0 }
                        ],
                        "lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
                        "paging": true,
                        
                    });
                }
            }
        });
        
    });

    

    
}