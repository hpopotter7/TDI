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
        
            ver_eventos(periodo, "0");
        
        
        
    });
/*
    function generar_query() {
        $('#tabla').hide();
        var eventos_1="";
        var eventos_proveedores="";
        var arr = $("#c_eventos").val();
        if(arr!=null){
            for (var r = 0; r <= arr.length - 1; r++) {
                eventos_1 = eventos_1 + "'" + arr[r] + "',";
            }
            eventos_1 = eventos_1.substring(0, eventos_1.length-1);
        }
        var proveedores = $("#c_clientes").val();
        if(proveedores!=null){
            var datos = {
                "clientes": proveedores
            };
            $.ajax({
                url: "buscar_eventos_clientes.php",
                type: 'post',
                data: datos,
                async: false,
                success: function (response) {

                    eventos_proveedores = eventos_proveedores + response;

                }
            });
        }
        if(eventos_1==""){
            eventos=eventos_proveedores;
        }
        else if(eventos_proveedores==""){
            eventos=eventos_1;
        }
        else{
            eventos=eventos_1+","+eventos_proveedores;
        }
        eventos=eventos.trim();




        var sql = "";
        if (eventos == "") {
            sql = "todos";
        }
        else {
            sql = eventos;
        }

        var arr = $("#c_periodo").val();
        var periodo="";
            if(arr.length==1){
                periodo=" and (Numero_evento like '"+arr[0]+"-%')";
            } 
            else{
                periodo=" and (Numero_evento like '"+arr[0]+"-%' or Numero_evento like '"+arr[1]+"-%')";
            }       
        sql=sql+"~"+periodo;
        
        $('#area_query').val(sql);
    }
    */

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
        var eventos=$('#c_eventos').val();

        if(eventos==""){
            eventos="todos";
        }

        var datos = {
            "eventos": eventos,
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