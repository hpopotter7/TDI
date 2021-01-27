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
    
  var table = $('#tabla_reporte').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'excel', 'pdf'
    ],
    "scrollX": true,
    "destroy": true, 
    "sort": true,
    "paging": true,
    "language" : idioma_espaniol
});  

var table2 = $('#Tabla_Fac_vs_Cob').DataTable({
    dom: 'Bfrtip',
    buttons: [
        'excel', 'pdf'
    ],
    "scrollX": true,
    "destroy": true, 
    "sort": false,
    "paging": false,
    "searching": false,
    "language" : idioma_espaniol
});    


    function generar_reporte(mes, anio){
        $('#tabla_reporte_body').html("");
        table.destroy();
        var datos={
            "mes":mes,
            "anio":anio
       };
        $.ajax({
        type : 'POST',
        url  : 'reporte_facturacion_mes.php',
        data: datos,
        success :  function(response){
           $(".fa-spin").hide();
           $('#tabla_reporte_body').html(response);            
           table = $('#tabla_reporte').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                'excel'
            ],
            
            "scrollX": true,
            "destroy": true, 
            "sort": true,
            "paging": true,
            "language" : idioma_espaniol
        });
       },
       error: function( jqXHR, textStatus, errorThrown ) {
           alert("Error: "+jqXHR.responseText+ " - "+textStatus);
       }
       }); 
    }
    function generar_reporte_fac_vs_cob(anio){
       $('#Tabla_Fac_vs_Cob_body').html("");
        table2.destroy();
        var datos={
            "anio":anio,
       };
        $.ajax({
        type : 'POST',
        url  : 'reporte_fac_vs_cob.php',
        data: datos,
        success :  function(response){
           $(".fa-spin").hide();
           $('#Tabla_Fac_vs_Cob_body').html(response);            
           table2 = $('#Tabla_Fac_vs_Cob').DataTable({
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                'excel'
            ],
            "searching": false,
            "scrollX": true,
            "destroy": true, 
            "sort": false,
            "paging": false,
            "language" : idioma_espaniol
        });
        ver_grafica();
        
       },
       error: function( jqXHR, textStatus, errorThrown ) {
           console.log(jqXHR);
           alert("Error: "+jqXHR.responseText+ " - "+textStatus);
       }
       }); 
    }

    $('#c_reporte').change(function(){
        var reporte=$('#c_reporte').val();
        switch(reporte){
            case "Fac_x_mes":
                $('#div_reporte1').show();
                $('#div_reporte2').hide();
                $('.mes').show();
                break;
            case "Fac_vs_Cob":
                $('#div_reporte1').hide();
                $('#div_reporte2').show();
                $('.mes').hide();
                break;
            default:
                alert("No esta configurado el reporte");
        }
    });

    //switch de reportes

    $('#btn_generar_reporte').on('click', function(){
        var reporte=$('#c_reporte').val();
        switch(reporte){
            case "Fac_x_mes":
                var mes=$('#c_mes').val();
                var anio=$('#c_anio').val();
                generar_reporte(mes, anio);
                break;
            case "Fac_vs_Cob":
                var anio=$('#c_anio').val();
                generar_reporte_fac_vs_cob(anio);
                //ver_grafica();
                break;
            default:
                alert("No esta configurado el reporte");
        }
    });


function ver_grafica(){
    
    const tableData = getTableData(table2);
    console.log(tableData);
    var anio=$('#c_anio').val();
    createHighcharts(tableData, anio);
    //setTableEvents(table);
}


    function getTableData(table) {
        const dataArray = [],
          countryArray = [],
          populationArray = [],
          densityArray = [];
       
        // loop table rows
        table.rows({ search: "applied" }).every(function() {
          const data = this.data();
          countryArray.push(data[0]);
          var fac=data[1].replace("$","");
          var cob=data[2].replace("$","");
          populationArray.push(parseFloat(fac.replace(/\,/g, "")));
          densityArray.push(parseFloat(cob.replace(/\,/g, "")));
        });
       
        // store all data in dataArray
        dataArray.push(countryArray, populationArray, densityArray);
       
        return dataArray;
      }

    function createHighcharts(data, anio) {
        Highcharts.setOptions({
          lang: {
            thousandsSep: ","
          }
        });
       
        Highcharts.chart("chart", {
          title: {
            text: "Reporte de Facturación"
          },
          subtitle: {
            text: "Facturación y cobranza "+anio
          },
          xAxis: [
            {
              categories: data[0],
              labels: {
                rotation: -45
              }
            }
          ],
          yAxis: [
            {
              // first yaxis
              labels: {
                formatter: function() {
                    return '$ '+ (this.value);
                }
            },
              title: {
                text: "Facturacion"
              }
            },
            {
              // secondary yaxis
              labels: {
                formatter: function() {
                    return '$ '+ (this.value);
                }
            },
              title: {
                text: "Cobranza"
              },
              min: 0,
              opposite: true
            }
          ],
          series: [
            {
              name: "Facturacion",
              color: "#0071A7",
              type: "column",
              data: data[1],
              tooltip: {
                valuePrefix: "$ "
              }
            },
            {
              name: "Cobranza",
              color: "#FF404E",
              type: "spline",
              data: data[2],
              tooltip: {
                valuePrefix: "$ "
              },
              yAxis: 1
            }
          ],
          
          tooltip: {
            shared: true
          },
          
          legend: {
            backgroundColor: "#ececec",
            shadow: true
          },
          credits: {
            enabled: false
          },
          noData: {
            style: {
              fontSize: "16px"
            }
          }
        });
      }


}