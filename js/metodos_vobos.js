function inicio(){


    function ver_solicitudes_por_evento(numero_evento){
        var datos={
          "numero_evento": numero_evento,
          "usuario": $('#label_user').html(),
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

    $.ajax({
        url:   "consultar_eventos_anio.php",
        type:  'post',
        async:false,
        success:  function (response) {
            
        $('#c_eventos_dos').html(response);
        $('#c_eventos_dos').chosen(); 
        },
    }); 
    
}