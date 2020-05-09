function inicio(){
  $('#btn_cerrar_evento').hide();            

    var op_mis_eventos = {
        url: function(phrase) {
          return "buscar_eventos_abiertos.php?like="+phrase+"&anio=0";
        },
        getValue: function(element) {
          return element.name;
        },
        theme: "plate-dark",
        list: {
          maxNumberOfElements: 20,
          match: {
            enabled: true
          },
          onClickEvent: function() {
            var evento = $("#c_eventos").getSelectedItemData().name;
            ver_solicitudes_por_evento(evento); //mostrar los resultados
        },
        },
        
      };
      $("#c_eventos").easyAutocomplete(op_mis_eventos);


      function ver_solicitudes_por_evento(evento){
        var datos={
          "evento": evento,
        }
        $.ajax({
            url:   "ver_eventos_cerrar.php",
            type:  'post',
            data: datos,
            success:  function (response) {
              $('#resultados').html(response);  
              $('#btn_cerrar_evento').show();            
            }
          });
      }

      $('#btn_cerrar_evento').click(function(){
        swal({
          title: "¿Realmente deseas Cerrar este evento?",
          text: "Una vez cerrado, los usuario no podran realizar solicitudes",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            var evento=$("#c_eventos").val();
            var datos={
              "evento": evento,
            }
            $.ajax({
              url:   "cerrar_evento.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                if(response.includes("cerrado")){
                  swal("El evento ha sido cerrado", {
                    icon: "success",
                  });
                  $("#c_eventos").val('');
                  $('#resultados').hide();
                  $('#btn_cerrar_evento').hide();  
                }
                else {
                  swal("Ocurrio un error"+response, {
                    icon: "error",
                  });
                }       
              }
            });
            
          } 
        });
      });
}
