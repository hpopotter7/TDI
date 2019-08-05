function inicio(){
  function generate(type, text) {

            var n = noty({
                text        : text,
                type        : type,
                dismissQueue: true,
                layout      : 'top',
                //closeWith   : ['button'],
                theme       : 'metroui',
                progressBar : true,
                maxVisible  : 5,
                timeout     : [2500],
                animation   : {
                    open  : 'animated slideInDown',
                    close : 'animated slideOutUp',
                    easing: 'swing',
                    speed : 100
                }
            });
            //console.log('html: ' + n.options.id);
            return n;
        }

	var user= parent.$('#label_user').html();
  //var user= 'ALAN SANDOVAL';
  
	
	var datos={
		"usuario": user,
	};
	 $.ajax({
              url:   "ver_eventos2.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                console.log(response);
               $('#c_eventos_creados').html(response);
              }
            });

   $('#enviar_cambios_evento').click(function(){
    if($('#c_eventos_creados').val()=="" || $('#area_modificaciones').val()==""){
       generate('warning', "Debe seleccionar un evento y escribir alguna modificación");
    }
    else
      var datos={
          "evento": $('#c_eventos_creados option:selected').text(),
          "texto": $('#area_modificaciones').val(),
          "usuario": parent.$('#label_user').html(),
        };
       $.ajax({
              url:   "enviar_solicitud_modificacion_evento.php",
              type:  'post',
              data: datos,
              success:  function (response) {
               if(response.includes("Enviado")){
                generate('success', "Se ha enviado la petición al administrador.");
                //close fancy
                
               }
               else{
                generate('error', "Ocurrio un error. Ver la consola para más detalles");
                console.log(response);
               }
              }
            });


   });
}
