function inicio(){

  ver_solicitudes_por_evento("0");

  $('#check_vobos_sol').change(function(){
    var numero_evento=$('#c_eventos_dos').val();
    if(numero_evento==null){
      numero_evento="0";
    }
    
    ver_solicitudes_por_evento(numero_evento);
  });

    function ver_solicitudes_por_evento(numero_evento){
      var check_todos="todos";
        if( $('#check_vobos_sol').is(':checked')){
          check_todos="propios";
      }
        var datos={
          "numero_evento": numero_evento,
          "check_todos":check_todos
        }
        $.ajax({
            url:   "consultar_vobos_evento.php",
            type:  'post',
            data: datos,
            success:  function (response) {
              console.log(response);
              //var arr=response.split("$$$");
              $('#resultado_solicitudes').html(response);
              
            }
          });
      }

    $('#c_eventos_dos').change(function(){
        var numero_evento=$(this).val();
        ver_solicitudes_por_evento(numero_evento);
        
    });
    var datos={
      "anio":"0",
    };
    $.ajax({
        url:   "consultar_eventos_anio.php",
        type:  'post',
        data: datos,
        async:false,
        success:  function (response) {
          response="<option value='0'></option>"+response;
        $('#c_eventos_dos').html(response);
        $('#c_eventos_dos').chosen({allow_single_deselect: true,width: '100%'}); 
        },
    }); 
    
    $('#resultado_solicitudes').delegate('.check_vobo_solicitudes' ,"click", function() {
      var envio="";
      var arr=$(this).val().split("#");
      var tipo=arr[0];
      var id=arr[1];
      if($(this).is(':checked')){
        x="1";
      }
      else{
       x="0";
      }
      vobo_solicitudes(id, x, tipo);
    });

    function vobo_solicitudes(id, x, tipo){
      var datos={
        "id": id,
        "bandera": x,
        "tipo":tipo
      };
      $.ajax({
        url:   "vobo_solicitud.php",
        type:  'post',
        data: datos,
        async:false,
        success:  function (response) {
        
         if(response.includes("completo")){
           var arr=response.split("#");
           generate('success', "El VoBo se ha actualizado");
           if(!tipo.includes("finanzas")){
             var ev=$('#c_eventos_dos').val();
            enviar_notificacion(arr[1]);
            ver_solicitudes_por_evento(ev);
           }
           else{
            ver_solicitudes_por_evento(ev);
            window.open("https://administraciontierradeideas.mx/solicitud_pago.php?id="+id, '_blank');
           }
         }
         else{
          generate('warning', "Ocurrio un error: "+response);
         }
        },
    });
    }

    function generate(type, text) {
          var n = noty({
              text        : text,
              type        : type,
              dismissQueue: true,
              layout      : 'topCenter',  //bottomLeft
              
              //closeWith   : ['button'],
              //theme       : 'defau',
              progressBar : true,
              maxVisible  : 10,
              timeout     : [3000],
              
          });
          //console.log('html: ' + n.options.id);
          return n;
      }

      function enviar_notificacion(evento){
        
        var datos={
          "evento": evento,
          "texto": "texto ",
          "usuario": "user",
          "asunto": "VoBo para solicitud de compra",
          "proveedor": "vacio",
        };
        
      $.ajax({
              url:   "mail/envio_mail.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                console.log(response);              
              }
            });

        }

        $("#resultado_solicitudes").delegate(".btn_ver_comprobante", "click", function() {    
          var arr=$(this).attr('id').split("#");
          if(arr.length==2){
            window.open("comprobantes/"+arr[1],'_blank');
          }
          else{
            var a="";
            for(var r=1;r<=arr.length-1;r++){
              a=a+"<li style='margin:.2em'><a class='btn btn-info' href='comprobantes/"+arr[r]+"' target='_blank'><b>"+arr[r]+"</b></li>";
            }
            var html="Este comprobante tiene varios archivos:<ul>"+a+"</ul>";
            noty({
              text        : html,
              width       : '400px',
              type        : 'warning',
              dismissQueue: false,
              closeWith   : ['backdrop'],
              //modal       : true,
              theme       : 'metroui',
              timeout     : false,
              layout      : 'topCenter',
               buttons: [
                {addClass: 'btn btn-success', text: 'Cerrar', onClick: function($noty) {
                  $noty.close();
                 }
               }
                ]
              }); 
          }
          /*
          for(var r=0;r<=arr.length-1;r++){
            console.log(arr[r]);
          }
          */
      });
      
      $("#resultado_solicitudes").delegate(".btn_utilidad", "click", function() {
        var evento=$(this).attr('id');
        var datos={
          "evento": evento, 
        };
        
        $.ajax({
          url: "grafica_utilidad.php",
          type:  'post',
          data: datos,
          dataType: "json",
          success: function(data){
            console.log(data);
            var util=data.utilidad;
            var ERROR=data.error;
            if(util=="NA"){
              generate("warning", "No se puede representar una gráfica de una utilidad negativa");
            }
            else if(!ERROR.includes("Error:")){              
              //var arr=data.split("|");
              var nombre="Utilidad: "+data.numero_evento+" - "+data.nombre_evento;
              var valores=data.egresos+"#"+data.utilidad;
              $( "#pie" ).attr('title',nombre);
              $( ".ui-dialog-title" ).html(nombre);
              parent.$('#modal_pie_titulo').html(nombre);
                grafica(valores);
              }
              else{
                console.log(ERROR);
                generate("warning", "No se puede representar la gráfica");
              }
              
          },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); 
            alert("Error: " + errorThrown);
            
        } 
        });
      });
/*
      $("#pie").dialog(
        {
         bgiframe: true,
         autoOpen: true,
         height: 100,
         modal: true
        }
 );

*/
 
 function grafica(data){
   var arr=data.split("#");
   var egresos=arr[0];
   var utilidad=arr[1];
    var ctx = parent.document.getElementById('pie').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'pie',
      data: {
          labels: ['Egresos', 'Ingresos'],
          datasets: [{
              data: [egresos, utilidad],
              backgroundColor: [
                  'rgba(215,31,31,0.7)',
                  'rgba(111,173,23,0.85)',
              ],
          }]
      },
      
      options: {
        tooltips: {
          callbacks: {
            title: function(tooltipItem, data) {
              return data['labels'][tooltipItem[0]['index']];
            },
            label: function(tooltipItem, data) {
              //; 
              var cantidad=data['datasets'][0]['data'][tooltipItem['index']];
              cantidad=parseFloat(cantidad).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')
              return "$"+cantidad;
            },
            /*
            afterLabel: function(tooltipItem, data) {
              var dataset = data['datasets'][0];
              var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][0]['total']) * 100)
              return '(' + percent + '%)';
            }
            */
          },
          backgroundColor: '#FFF',
          titleFontSize: 22,
          titleFontColor: '#0066ff',
          bodyFontColor: '#000',
          bodyFontSize: 20,
          displayColors: false,
          xPadding:16,
          yPadding:16,
        },
        plugins: {
          labels: {
            render: 'percentage',
            fontSize: 28,
            fontColor: '#000',
              precision: 2
          }
        },
        legend: {
          labels: {
            fontColor: 'black',
            fontSize: 20,
          },
          position: 'top',
        },
        responsive: false,
        maintainAspectRatio: true,
          
      },
      
    });



    /* parent.$("#pie").dialog(
      {
        width: 'auto', // overcomes width:'auto' and maxWidth bug
        maxWidth: 300,
        height: 'auto',
        modal: true,
        fluid: true, //new option
        resizable: false,
        bgiframe: true,
        autoOpen: true,
      }
    ); */

parent.$("#modal_pie").modal();

}


}