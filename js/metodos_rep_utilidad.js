function inicio(){

    ver_anios();
    ver_clientes();
    ver_datos("todos", "todos");
    
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

       function ver_anios(){
        $.ajax({
            url: "ver_periodos.php",
            type: 'post',
            async: false,
            beforeSend: function () {
                //$('#mensaje').show();
            },
            success: function (response) {
                response=response.replace("selected", "");
                response="<option value='todos' selected>Todos</option>"+response;
                $('#c_anio').html(response);
                $("#c_anio option").removeProp("selected");
            },
            complete: function () {
                //$('#mensaje').hide();
            },
        }); 
       }

       function ver_clientes(){
     $.ajax({
         url: "ver_clientes.php",
         type: 'post',
         async: false,
         beforeSend: function () {
             //$('#mensaje').show();
         },
         success: function (response) {
             response="<option value='todos'>Todos</option>"+response;
             $('#c_clientes').html(response);
             $("#c_clientes option[value='vacio']").remove();
         },
         complete: function () {
             //$('#mensaje').hide();
         },
     }); 
    }

    function ver_datos(cliente, anio){
        $('#reporte_utilidad').html(""); 
        alert(cliente+" - "+anio);
        var datos={"cliente": cliente, "anio": anio}
    $.ajax({
       type : 'POST',
       url  : 'reporte_utilidad.php',
       data: datos,
       success :  function(response){
           $('#reporte_utilidad').html(response); 
           $('#tabla_utilidad').DataTable({
            "searching": true,
           "scrollX": true,
           "destroy": true, 
           "sort": true,
           "language" : idioma_espaniol
       });            
       }
       }); 
       
    }
/*
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
       });
       */

       $('#c_clientes').on("change",function(){
           var cliente=$(this).val();
           var anio=$('#c_anio').val();
           $('#tabla_utilidad').DataTable().clear().destroy();
           ver_datos(cliente, anio);
          // $('#tabla_utilidad').DataTable().ajax.reload();
       });

       $('#c_anio').on("change",function(){
        var anio=$(this).val();
        var cliente=$('#c_clientes').val();
        $('#tabla_utilidad').DataTable().clear().destroy();
        ver_datos(cliente, anio);
        //$('#tabla_utilidad').DataTable().ajax.reload();
    });
    

       new Chart(document.getElementById("bar-chart-grouped"), {
        type: 'bar',
        data: {
          labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
          datasets: [
            {
              label: "2019",
              backgroundColor: "#3e95cd",
              data: [133,221,783,2478,133,221,783,2478,133,221,783,2478]
            }, {
              label: "2020",
              backgroundColor: "#8e5ea2",
              data: [408,547,675,734,408,547,675,734,408,547,675,734]
            }
          ]
        },
        options: {
          title: {
            display: true,
            text: 'Utilidad por año'
          }
        }
    });
      

     
}