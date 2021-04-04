function inicio(){

  $('#btn_cerrar_evento').hide();            
/*
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
      */
     llenar_eventos_combo("0");
     function llenar_eventos_combo(anio){
      var datos={
        "anio":anio,
      };
      $.ajax({
          url:   "buscar_eventos_abiertos.php",
          type:  'post',
          data: datos,
          async:false,
          success:  function (response) {
            console.log(response);
            response="<option value='0'></option>"+response;
          $('#c_eventos').html(response);
          $('#c_eventos').chosen({allow_single_deselect: true,width: '100%'}); 
          $('#c_eventos').trigger("chosen:updated");
          },
        }); 
      }

    $("#c_eventos").chosen().change(function(){
      var evento=$('#c_eventos option:selected').text();
      ver_solicitudes_por_evento(evento);
      
    } );

      function ver_solicitudes_por_evento(evento){
        var datos={
          "evento": evento,
        }
        $.ajax({
            url:   "ver_eventos_cerrar.php",
            type:  'post',
            data: datos,
            success:  function (response) {
              console.log(response);
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
        var evento=$('#c_eventos option:selected').text();
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
              llenar_eventos_combo("0");
            }
            else if(response.includes("pendientes por aprobar")){
              swal("Advertencia", response, "warning");
            }
            else {
              swal("Error", response, "error");
            }       
          }
        });

      };
}
