function inicio(){

    ver_solicitudes_por_evento("0");

    function ver_solicitudes_por_evento(numero_evento){
        var datos={
          "numero_evento": numero_evento,
        }
        $.ajax({
            url:   "consultar_vobos_evento.php",
            type:  'post',
            data: datos,
            success:  function (response) {
              var arr=response.split("$$$");
              $('#resultado_solicitudes').html(arr[0]);
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
      vobo_solicitudes(id, x, tipo,);
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
          ver_solicitudes_por_evento($('#c_eventos_dos').val());
           var arr=response.split("#");
           //var id=arr[1];
           generate('success', "El VoBo se ha actualizado");
           if(!tipo.includes("finanzas")){
            enviar_notificacion($('#c_eventos_dos').val());
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
}