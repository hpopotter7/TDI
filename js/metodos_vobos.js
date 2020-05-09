function inicio(){

  $('#buscando').hide();

    function ver_solicitudes_por_evento(numero_evento){
      
        var datos={
          "numero_evento": numero_evento,
          "usuario": $('#label_user').html(),
        }
        $.ajax({
            url:   "consultar_vobos_evento.php",
            type:  'post',
            data: datos,
            beforeSend: function(){
              $('#buscando').show();
            },
            success:  function (response) {
              
              $('#resultado_solicitudes').html(response);
              
            },
            complete: function(data) {
              $('#buscando').hide();
            }

          });
      }
    

    

    $('#c_eventos_dos').change(function(){
        var numero_evento=$(this).val();
        $('#resultado_solicitudes').html('');
        ver_solicitudes_por_evento(numero_evento);
        
    });

    $.ajax({
        url:   "consultar_eventos_anio.php",
        type:  'post',
        async:false,
        success:  function (response) {
            response="<option selected checked disabled>Selecciona un evento...</option>"+response;
        $('#c_eventos_dos').html(response);
        $('#c_eventos_dos').chosen(); 
        },
    }); 
    

    /* 
  var table = $('#tabla_vobos').DataTable({
    "scrollX": true,
    "destroy": true, 
     "sort": true,
    "language" : idioma_espaniol
 }); */
}