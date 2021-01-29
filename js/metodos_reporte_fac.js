function inicio(){

  $('.ocultar').hide();

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
    "destroy": true,
          "scrollY":        "500px",
          "scrollX":        true,
          "scrollCollapse": true,
          "paging":         false,
          "columnDefs": [
            { "width": "8%", "targets": [0,3,4,5,6]}
          ],
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

var table3 = $('#tabla_cliente').DataTable({
  dom: 'Bfrtip',
  buttons: [
      'excel', 'pdf'
  ],
  "scrollX": true,
  "destroy": true, 
  "sort": false,
  "paging": true,
  "pageLength": 15,
  "searching": false,
  "language" : idioma_espaniol,
  "columnDefs": [
    { "width": "25%", "targets": [1]}
  ],
}); 

var table4 = $('#tabla_cob_x_mes').DataTable({
  dom: 'Bfrtip',
  buttons: [
      'excel', 'pdf'
  ],
  "scrollX": true,
  "destroy": true, 
  "sort": false,
  "paging": true,
  "pageLength": 15,
  "searching": false,
  "language" : idioma_espaniol,
  "columnDefs": [
    { "width": "25%", "targets": [1]}
  ],
});

  function generar_reporte_cob_x_mes(mes, anio){
    $('#tabla_cob_x_mes_body').html("");
    table4.destroy();
    var datos={
        "mes":mes,
        "anio":anio
  };
    $.ajax({
    type : 'POST',
    url  : 'reporte_cobranza_mes.php',
    data: datos,
    success :  function(response){
      $(".fa-spin").hide();
      $('#tabla_cob_x_mes_body').html(response);   
              
      table4 = $('#tabla_cob_x_mes').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL'
            },
            'excel'
        ],
      "destroy": true,
      "scrollY":        "500px",
      "scrollX":        true,
      "scrollCollapse": true,
      "paging":         false,
      "language" : idioma_espaniol,
      "columnDefs": [
        { "width": "8%", "targets": [0,1,,4,5,6]}
      ],
      });
  },
  error: function( jqXHR, textStatus, errorThrown ) {
      alert("Error: "+jqXHR.responseText+ " - "+textStatus);
  }
  }); 
}

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
          "destroy": true,
          "scrollY":        "500px",
          "scrollX":        true,
          "scrollCollapse": true,
          "paging":         false,
          "language" : idioma_espaniol,
          "columnDefs": [
            { "width": "8%", "targets": [0,3,4,5,6]}
          ],
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
        ver_grafica(table2, "chart");
        
       },
       error: function( jqXHR, textStatus, errorThrown ) {
           console.log(jqXHR);
           alert("Error: "+jqXHR.responseText+ " - "+textStatus);
       }
       }); 
    }

    function generar_reporte_cliente(anio){
      $('#tabla_cliente').html("");
       table3.destroy();
       var datos={
           "anio":anio,
      };
       $.ajax({
       type : 'POST',
       url  : 'reporte_fac_cliente.php',
       data: datos,
       success :  function(response){
          $(".fa-spin").hide();
          $('#tabla_cliente').html(response);            
          table3 = $('#tabla_cliente').DataTable({
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
           "paging": true,
           "pageLength": 15,
           "language" : idioma_espaniol,
           "columnDefs": [
            { "width": "25%", "targets": [1]}
          ],
       });
       ver_grafica_barra("chart_cliente");
       
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
          case "":
                $('.ocultar').hide();
                break;
            case "Fac_x_mes":
              $('.ocultar').hide();
              $('#div_reporte1').show();
              $('.mes').show();
              $('#div_boton').show();
              $('#mes').show();
              $('#anio').show();
              break;
            case "Fac_x_anio":
              $('.ocultar').hide();
                $('#div_reporte1').show();
                $('#div_boton').show();
                $('#anio').show();
                break;
            case "Cob_x_mes":
              $('.ocultar').hide();
              $('#div_reporte3').show();
              $('.mes').show();
              $('#div_boton').show();
              $('#mes').show();
              $('#anio').show();
                break;
            case "Fac_vs_Cob":
              $('.ocultar').hide();
                $('#div_reporte2').show();
                $('#div_boton').show();
                $('#anio').show();
                break;
            case "Cli_anio":
                  $('.ocultar').hide();
                  $('#div_reporte_cliente').show();
                  $('#div_boton').show();
                  $('#anio').show();
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
            case "Fac_x_anio":
                var mes="0";
                var anio=$('#c_anio').val();
                generar_reporte(mes, anio);
                break;
            case "Cob_x_mes":
                var mes=$('#c_mes').val();
                var anio=$('#c_anio').val();
                generar_reporte_cob_x_mes(mes, anio);
                break;
            case "Fac_vs_Cob":
                var anio=$('#c_anio').val();
                generar_reporte_fac_vs_cob(anio);
                break;
            case "Cli_anio":
                var anio=$('#c_anio').val();
                $('#chart_cliente').html("");
                generar_reporte_cliente(anio);
                break;
            default:
                alert("No esta configurado el reporte");
        }
    });


function ver_grafica(tabla, canvas){
    const tableData = getTableData(tabla);
    console.log(tableData);
    var anio=$('#c_anio').val();
    createHighcharts(tableData, anio, canvas);
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

    function createHighcharts(data, anio, canvas) {
        Highcharts.setOptions({
          lang: {
            thousandsSep: ","
          },chart: {
            backgroundColor: {
                linearGradient: [0, 0, 500, 500],
                stops: [
                    [0, 'rgb(255, 255, 255)'],
                    [1, 'rgb(240, 240, 255)']
                ]
            },
            borderWidth: 2,
            plotBackgroundColor: 'rgba(255,255,255, .9)',
            plotShadow: true,
            plotBorderWidth: 1,
            plotAreaHeight: 700
        }
        });
       
        Highcharts.chart(canvas, {
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
              },
              //tickInterval: 50
            }
          ],
          yAxis: [
            {
              // first yaxis
              labels: {
                formatter: function() {
                    return ((this.value)/1000000)+" M";
                }
            },
              title: {
                text: "Facturacion"
              },
              tickInterval: 4000000
            },
            {
              // secondary yaxis
              labels: {
                formatter: function() {
                    //return '$ '+ (this.value);
                    return ((this.value)/1000000)+" M";
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
              //type: "column",
              data: data[2],
              tooltip: {
                valuePrefix: "$ "
              },
              //yAxis: 1
            }
          ],
          
          tooltip: {
            shared: false
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

      function ver_grafica_barra(canvas){
        var tableData = getTableData2(table3);
        var anio=$('#c_anio').val();
        createHighcharts_barra(tableData, anio, canvas);
        //setTableEvents(table);
    }
    function getTableData2(table) {
      var dataArray = [];
      var countryArray = [];
     
      // loop table rows
      table.rows({ search: "applied" }).every(function() {
        var data = this.data();
        countryArray.push(data[0]);
        var fac=data[1].replace("$","");
        
        var feed = {name: data[0], y: parseFloat(fac.replace(/\,/g, ""))};
        dataArray.push(feed);
      });
      return dataArray;
    }

    function createHighcharts_barra(datos, anio, canvas) {
      /*
      Highcharts.setOptions({
        colors: Highcharts.map(Highcharts.getOptions().colors, function (color) {
            return {
                radialGradient: {
                    cx: 0.5,
                    cy: 0.3,
                    r: 0.7
                },
                stops: [
                    [0, color],
                    [1, Highcharts.color(color).brighten(-0.3).get('rgb')] // darken
                ]
            };
        })
    });;
    */
     
      Highcharts.chart(canvas, {
        chart: {
          plotBackgroundColor: null,
          plotBorderWidth: null,
          plotShadow: false,
          type: 'pie'
        },
        title: {
          text: "Reporte de Facturación"
        },
        subtitle: {
          text: "Facturación por Cliente "+anio
        },
        series: [
          {
            name: "Monto",
            data: datos,
            tooltip: {
              valuePrefix: "$ "
            }
          },
        ],
        
        tooltip: {
          pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
          pie: {
              allowPointSelect: true,
              cursor: 'pointer',
              dataLabels: {
                  enabled: true,
                  format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                  connectorColor: 'silver'
              }
          }
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
      }).redraw();
      
    }

}