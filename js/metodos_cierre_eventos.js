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
          title: "¿Deseas cerrar este evento?",
          html: "<i style='font-size:.75em'>Una vez cerrado, los usuario no podran realizar solicitudes</i>" +
              "<br>" +
              '<button type="button" class="btn btn-success SwalBtn_normal customSwalBtn">' + 'Normal' + '</button>' +
              '<button type="button" class="btn btn-warning SwalBtn_pitch customSwalBtn">' + 'Pitch' + '</button>' +
              '<button type="button" class="btn btn-danger SwalBtn_cancel customSwalBtn">' + 'Cancelar' + '</button>' ,
              type: "warning",
          showCancelButton: false,
          showConfirmButton: false
        });
      });

    $(document).on('click', '.SwalBtn_normal', function() {
      cierre_evento("CERRADO");
    });
    $(document).on('click', '.SwalBtn_pitch', function() {
      cierre_evento("PITCH");
    });
    $(document).on('click', '.SwalBtn_cancel', function() {
        swal.clickConfirm();
    });

      function cierre_evento(tipo){ 
        var evento=$("#c_eventos").val();
        var datos={
          "evento": evento,
          "tipo":tipo
        }
        $.ajax({
          url:   "cerrar_evento.php",
          type:  'post',
          data: datos,
          success:  function (response) {
            swal.clickConfirm();
            if(response.includes("cerrado")){
              swal("Exito", "Se ha cerrado el evento.", "success");
              $("#c_eventos").val('');
              $('#resultados').hide();
              $('#btn_cerrar_evento').hide();  
            }
            else {
              swal("Error", "Ocurrio un error", "error");
            }       
          }
        });

      };
}
