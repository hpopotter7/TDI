function inicio(){

    function generate(tipo, texto){
        //mint, sunset, metroui, relax, nest, semantic, light, boostrap-v3
        var tema="mint";
        if(tipo=="success"){
            tema="nest";

        }
        if(tipo=="warning"){
            tema="metroui";

        }
     var n= new Noty({
              text: texto,
              type: tipo,
              theme: tema,
              layout: "top",
              timeout: 4000,
              animation: {
                  open : 'animated fadeInRight',
                  close: 'animated fadeOutRight'
              }
          }).show();
      return n;
    }

    llenar_combo_eventos_modificar("0");
    function llenar_combo_eventos_modificar(anio){
        var datos={
          "anio":anio,
        };
        $.ajax({
            url:   "buscar_evento.php",
            type:  'post',
            data: datos,
            async:false,
            success:  function (response) {
              response="<option value='0'></option>"+response;
            $('#c_eventos_modificar').html(response);
            $('#c_eventos_modificar').chosen({allow_single_deselect: true,width: '100%',placeholder_text_single: "Selecciona...",no_results_text: "No hay coincidencias para"}); 
            $('#c_eventos_modificar').trigger("chosen:updated");
            },
          }); 
        }

        $('#btn_enviar').on('click', function(){
            if($('#c_eventos_modificar').val()=="" || $('#area_modificaciones').val()==""){
                generate('warning', "Debe seleccionar un evento y escribir alguna modificación");
             }
             else{
               var evento=$('#c_eventos_modificar option:selected').text();
               var datos={
                   "evento": evento,
                   "texto": $('#area_modificaciones').val(),
                   "asunto": "Solicitud de modificación",
                   "proveedor": "vacio",
                 };
                 
                $.ajax({
                       url:   "mail/envio_mail.php",
                       type:  'post',
                       data: datos,
                       beforeSend: function(){
                         $('#btn_enviar').html("<img src='img/fancybox_loading.gif'> Enviando...");
                        },
                       success:  function (response) {                      
                        if(response.includes("Enviado")){
                         generate('success', "Se ha enviado la petición al administrador.");
                         $('#btn_enviar').html('<i class="fa fa-envelope" aria-hidden="true"></i> Solicitar cambios');  
                         $('#area_modificaciones').val("");  
                          $('#response').fadeIn().append('<div class="alert alert-success alert-dismissible fade show" role="alert"> Tu solicitud se ha enviado al administrador!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); 
                         remove_alert();
                         llenar_combo_eventos_modificar("0");
                        }
                        else if(response.includes("problema usuario")){
                           generate('info', "El usuario actual no tiene privilegios para solicitar modificaciones a este evento<br>Contacte al Ejecutivo de cuenta"); 
                         }
                        else{
                         generate('error', "Ocurrio un error. Ver la consola para más detalles");
                        }
                       }
                     });
             }
        });

        function remove_alert(){
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
            }, 5000); 
        }
}