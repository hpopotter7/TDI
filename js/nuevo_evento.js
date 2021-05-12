function inicio(){

    function generate(tipo, texto){
        //mint, sunset, metroui, relax, nest, semantic, light, boostrap-v3
        var tema="mint";
        if(tipo=="success"){
            tema="nest";

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


    ver_clientes();
    /*
    ver_usuarios_combos("Ejecutivo");
    ver_usuarios_combos("Solicitante");
    ver_usuarios_combos("Productor");
    ver_usuarios_combos("Disenio");
    ver_usuarios_combos("Digitalizacion");

    */
    $('#c_solicitantes').multiselect();     
    $('#c_produccion').multiselect();
    $('#c_ejecutivos').multiselect();
    $('#c_disenio').multiselect();
    $('#c_digital').multiselect();
    $('#c_video').multiselect();
    

    $('#c_video').multiselect({
        buttonText: function(options) {
          if (options.length == 0) {
            return ' SELECCIONA...';
          }
          else if (options.length > 3) {
            return options.length + ' seleccionados  ';
          }
          else {
            var selected = [];
            options.each(function() {
              selected.push([$(this).text(), $(this).data('order')]);
            });
            
            selected.sort(function(a, b) {
              return a[1] - b[1];
            })
    
            var text = '';
            for (var i = 0; i < selected.length; i++) {
              text += selected[i][0] + ', ';
            }
    
            return text.substr(0, text.length -2) + ' ';
          }
        },
        onChange: function(option, checked) {
          if (checked) {
            orderCount++;
            $(option).data('order', orderCount);
          }
          else {
            $(option).data('order', '');
          }
        }
      });
      $( "#txt_fecha_inicio_evento").datepicker({ dateFormat: 'yy-mm-dd' });
   $( "#txt_fecha_final_evento").datepicker({ dateFormat: 'yy-mm-dd' });
    llenar_eventos_combo("0");
    metodo_limpiar_evento();

    function llenar_eventos_combo(anio){
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
            $('#c_eventos_creados').html(response);
            $('#c_eventos_creados').chosen({allow_single_deselect: true,width: '100%'}); 
            $('#c_eventos_creados').trigger("chosen:updated");
            },
          }); 
        }

    function ver_clientes(){//obtener los usuarios registrados
      
        $.ajax({
              url:   'ver_clientes.php',
              type:  'post',              
              success:  function (response) {
                $('.combo_clientes').html(response);
              }
        });
      }



    function metodo_limpiar_evento(){
       $('#form_nuevo_evento')[0].reset();  
       ver_numero_evento();   
       $('#btn_crear_evento').show();
       /* $('#c_ejecutivos').multiselect("deselectAll", false).multiselect("refresh");
       $('#c_produccion').multiselect("deselectAll", false).multiselect("refresh");
       $('#c_disenio').multiselect("deselectAll", false).multiselect("refresh");
       $('#c_digital').multiselect("deselectAll", false).multiselect("refresh");
       $('#c_video').multiselect("deselectAll", false).multiselect("refresh");
       $('#c_solicitantes').multiselect("deselectAll", false).multiselect("refresh");  */  
      
       $('#check_anio_evento').bootstrapToggle('off');
       $('#div_candado').hide();
     }

     function ver_numero_evento(){//obtener los usuarios registrados
        var datos={
          "anio":"2019",
        };
        $.ajax({
              url:   'ver_numero_evento.php',
              type:  'post',
              data: datos,
              success:  function (response) {
                  $('#txt_numero_evento').val(response);
              }
        });
      }

    /* function ver_usuarios_combos(tipo){//obtener los usuarios registrados
        $('#c_ejecutivos').multiselect('destroy');
          var datos={
            "tipo": tipo,
          };
        $.ajax({
              url:   'ver_usuarios_combos.php',
              data: datos,
              type:  'post',
              success:  function (response) {     
                           alert(response);
                var add='<option value="vacio">Selecciona...</option>';
                if(tipo=="Ejecutivo"){
                   $('#c_ejecutivos').html(response);
                  var orderCount = 0;
                    $('#c_ejecutivos').multiselect({
                      buttonText: function(options) {
                        if (options.length == 0) {
                          return ' SELECCIONA...';
                        }
                        else if (options.length > 3) {
                          return options.length + ' seleccionados  ';
                        }
                        else {
                          var selected = [];
                          options.each(function() {
                            selected.push([$(this).text(), $(this).data('order')]);
                          });
                          
                          selected.sort(function(a, b) {
                            return a[1] - b[1];
                          })
                 
                          var text = '';
                          for (var i = 0; i < selected.length; i++) {
                            text += selected[i][0] + ', ';
                          }
                 
                          return text.substr(0, text.length -2) + ' ';
                        }
                      },
                      onChange: function(option, checked) {
                        if (checked) {
                          orderCount++;
                          $(option).data('order', orderCount);
                        }
                        else {
                          $(option).data('order', '');
                        }
                      }
                    });
                }
                if(tipo=="Solicitante"){ 
                  $('#c_solicitantes').html(response);
                    var orderCount = 0;
                    $('#c_solicitantes').multiselect({
                      buttonText: function(options) {
                        if (options.length == 0) {
                          return '  SELECCIONA...';
                        }
                        else if (options.length > 3) {
                          return options.length + ' seleccionados  ';
                        }
                        else {
                          var selected = [];
                          options.each(function() {
                            selected.push([$(this).text(), $(this).data('order')]);
                          });
                          
                          selected.sort(function(a, b) {
                            return a[1] - b[1];
                          })
                 
                          var text = '';
                          for (var i = 0; i < selected.length; i++) {
                            text += selected[i][0] + ', ';
                          }
                 
                          return text.substr(0, text.length -2) + ' ';
                        }
                      },
                      onChange: function(option, checked) {
                        if (checked) {
                          orderCount++;
                          $(option).data('order', orderCount);
                        }
                        else {
                          $(option).data('order', '');
                        }
                      }
                    });
                }
                if(tipo=="Productor"){
                  $('#c_produccion').html(response);
                    var orderCount = 0;
                    $('#c_produccion').multiselect({
                      buttonText: function(options) {
                        if (options.length == 0) {
                          return '  SELECCIONA...';
                        }
                        else if (options.length > 3) {
                          return options.length + ' seleccionados  ';
                        }
                        else {
                          var selected = [];
                          options.each(function() {
                            selected.push([$(this).text(), $(this).data('order')]);
                          });
                          
                          selected.sort(function(a, b) {
                            return a[1] - b[1];
                          })
                 
                          var text = '';
                          for (var i = 0; i < selected.length; i++) {
                            text += selected[i][0] + ', ';
                          }
                 
                          return text.substr(0, text.length -2) + ' ';
                        }
                      },
                      onChange: function(option, checked) {
                        if (checked) {
                          orderCount++;
                          $(option).data('order', orderCount);
                        }
                        else {
                          $(option).data('order', '');
                        }
                      }
                    });
                  
                } 
                if(tipo=="Disenio"){
                  
                  $('#c_disenio').html(response);
                    var orderCount = 0;
                    $('#c_disenio').multiselect({
                      buttonText: function(options) {
                        if (options.length == 0) {
                          return ' SELECCIONA...';
                        }
                        else if (options.length > 3) {
                          return options.length + ' seleccionados  ';
                        }
                        else {
                          var selected = [];
                          options.each(function() {
                            selected.push([$(this).text(), $(this).data('order')]);
                          });
                          
                          selected.sort(function(a, b) {
                            return a[1] - b[1];
                          })
                 
                          var text = '';
                          for (var i = 0; i < selected.length; i++) {
                            text += selected[i][0] + ', ';
                          }
                 
                          return text.substr(0, text.length -2) + ' ';
                        }
                      },
                      onChange: function(option, checked) {
                        if (checked) {
                          orderCount++;
                          $(option).data('order', orderCount);
                        }
                        else {
                          $(option).data('order', '');
                        }
                      }
                    });
                }
                if(tipo=="Digitalizacion"){
                  $('#c_digital').html(response);
                    var orderCount = 0;
                     $('#c_digital').multiselect({
                      buttonText: function(options) {
                        if (options.length == 0) {
                          return ' SELECCIONA...';
                        }
                        else if (options.length > 3) {
                          return options.length + ' seleccionados  ';
                        }
                        else {
                          var selected = [];
                          options.each(function() {
                            selected.push([$(this).text(), $(this).data('order')]);
                          });
                          
                          selected.sort(function(a, b) {
                            return a[1] - b[1];
                          })
                 
                          var text = '';
                          for (var i = 0; i < selected.length; i++) {
                            text += selected[i][0] + ', ';
                          }
                 
                          return text.substr(0, text.length -2) + ' ';
                        }
                      },
                      onChange: function(option, checked) {
                        if (checked) {
                          orderCount++;
                          $(option).data('order', orderCount);
                        }
                        else {
                          $(option).data('order', '');
                        }
                      }
                    }); 
                }
               
              }
        });
    }
 */
    $("#limpiar_evento").on("click",function (){
        metodo_limpiar_evento();
    });

    function validar_crear_evento(){
            // Campos de texto
            var ejecu=$('#c_ejecutivos option:selected').map(function(a, item){return item.value;});
            var produc=$('#c_produccion option:selected').map(function(a, item){return item.value;});
            var disenio=$('#c_disenio option:selected').map(function(a, item){return item.value;});
            var digital=$('#c_digital option:selected').map(function(a, item){return item.value;});
            var video=$('#c_video option:selected').map(function(a, item){return item.value;});
            var solicitante=$('#c_solicitantes option:selected').map(function(a, item){return item.value;});
            if($("#c_cliente").val() == "vacio"){
            generate('info', "Debe elegir un cliente");
                return false;
            }
            if($("#txt_nombre_evento").val() == ""){
            generate('info', "Debe ingresar un nombre para el evento");
                return false;
            }
            if($("#txt_fecha_inicio_evento").val() == ""){
            generate('info', "Debe elegir la fecha de incio del evento");
                return false;
            }
            if($("#txt_fecha_final_evento").val() == ""){
            generate('info', "Debe elegir la fecha final del evento");
                return false;
            }
            if($("#txt_destino").val() == ""){
            generate('info', "Debe ingresar un destino");
                return false;
            }
            if($("#txt_sede").val() == ""){
            generate('info', "Debe ingresar una sede");
                return false;
            }
            if(disenio.length == 0){
            generate('info', "Debe elegir quien diseña el evento");
                return false;
            }
            if(produc.length == 0){
            generate('info', "Debe elegir al menos a un productor");
                return false;
            }
            if(ejecu.length == 0){
            generate('info', "Debe elegir al menos a un ejecutivo");
                return false;
            }
            if(digital.length == 0){
            generate('info', "Debe elegir al menos a un digital");
                return false;
            }
            if(video.length == 0){
             generate('info', "Debe elegir al menos a un video");
              return false;
             }
            if(solicitante.length == 0){
            generate('info', "Debe elegir al menos a un solicitante");
                return false;
            }
            if($("#c_solicito").val() == ""){
            generate('info', "Debe elegir quien solicita el evento");
                return false;
            }
            if($("#txt_facturacion").val() == ""){
            generate('info', "Debe ingresar el monto de facturación");
                return false;
            }
            if($("#txt_facturacion").val() == "$0.00"){
            generate('info', "Debe ingresar el monto de facturación");
                return false;
            }

            return true; // Si todo está correcto
        }

    $('#btn_crear_evento').click(function(event){
        event.preventDefault();
        if(validar_crear_evento()){
          // se manda ajax para insertar el evento
          var ejecu=$('#c_ejecutivos option:selected').map(function(a, item){return item.value;});
          var ejecutivos="";
          for (var r=0;r<=ejecu.length-1;r++) {
            ejecutivos=ejecutivos+","+ejecu[r];
          }
          var produc=$('#c_produccion option:selected').map(function(a, item){return item.value;});
          var productores="";
          for (var r=0;r<=produc.length-1;r++) {
            productores=productores+","+produc[r];
          }
          var disenio=$('#c_disenio option:selected').map(function(a, item){return item.value;});
          var dis="";
          for (var r=0;r<=disenio.length-1;r++) {
            dis=dis+","+disenio[r];
          }
          var digital=$('#c_digital option:selected').map(function(a, item){return item.value;});
          var dig="";
          for (var r=0;r<=digital.length-1;r++) {
            dig=dig+","+digital[r];
          }
          var solicitante=$('#c_solicitantes option:selected').map(function(a, item){return item.value;});
          var sol="";
          for (var r=0;r<=solicitante.length-1;r++) {
            sol=sol+","+solicitante[r];
          }
          var video=$('#c_video option:selected').map(function(a, item){return item.value;});
          var vid="";
          for (var r=0;r<=video.length-1;r++) {
            vid=vid+","+video[r];
          }
          var solo_numeros=$('#txt_facturacion').asNumber({ parseType: 'Float' });
          $('#txt_facturacion').val(solo_numeros);
          var datos = $('#form_nuevo_evento').serializeArray();
          datos.push({name: 'usuario_registra', value: $('#label_user').html()});
          datos.push({name: 'productores', value: productores});
          datos.push({name: 'diseñadores', value: dis});
          datos.push({name: 'digital', value: dig});
          datos.push({name: 'video', value: vid});
          datos.push({name: 'ejecutivo', value: ejecutivos});
          datos.push({name: 'solicita', value: sol});
          $.ajax({
            url:   "crear_evento.php",
            type:  'post',
            data:  datos,
            success:  function (response) {
              if(response.includes("creado correctamente")){
                $('#form_nuevo_evento')[0].reset();
                $('#c_ejecutivos').multiselect("deselectAll", false).multiselect("refresh");
                $('#c_produccion').multiselect("deselectAll", false).multiselect("refresh");
                $('#c_disenio').multiselect("deselectAll", false).multiselect("refresh");
                $('#c_digital').multiselect("deselectAll", false).multiselect("refresh");
                $('#c_video').multiselect("deselectAll", false).multiselect("refresh");
                $('#c_solicitantes').multiselect("deselectAll", false).multiselect("refresh");
                generate('success',response);
                ver_numero_evento();
              }
              else{
                console.log(response);
               generate('error', "Ocurrio un error, vea la consola para mas detalles"); 

              }
            }
          });
        }
      });

      
      $("#c_eventos_creados").chosen().change(function(){
        var evento=$(this).val();
        ver_detalle_eventos(evento);
        
      } );

      function ver_detalle_eventos(id){
          
        var datos={
            "id": id
          };
           $.ajax({
              url:   "ver_detalle_evento.php",
              type:  'post',
              data: datos,
              dataType: "json",
              success:  function (response) {
                console.log(response);
                $('#div_candado').show();
                //$('#btn_modificar_evento').show();
                $('#datos_evento').html(response.datos_evento);
                $('#btn_crear_evento').hide();
                $('#txt_numero_evento').val(response.Numero_evento);
                $('#txt_nombre_evento').val(response.Nombre_evento);
                $('#c_cliente').val(response.Cliente);
                $('#txt_nombre_evento').attr("readonly", false);
                $('#txt_fecha_inicio_evento').val(response.Inicio_evento);
                $('#txt_fecha_final_evento').val(response.Fin_evento);
                $('#txt_destino').val(response.Destino);
                $('#txt_sede').val(response.Sede);
                
                var ejecutivo=response.Ejecutivo.split(",");
                var comodin="";
                var EJE="";
                var arr_opciones=$('#c_ejecutivos').html();
                var opciones_ejecutivos = $("#c_ejecutivos>option").map(function() { return $(this).val(); });
                console.log(opciones_ejecutivos);
                for(var r=0;r<=opciones_ejecutivos.length-1;r++){
                  if(ejecutivo[1]==opciones_ejecutivos[r]){
                    
                    comodin="si";
                    break;
                  }
                  else{
                    EJE=ejecutivo[1];
                    comodin="no";
                  }
                }

                $("#c_ejecutivos").multiselect("destroy");
                var x=true;

                while(x){
                  if($('#c_ejecutivos option:first-child').attr('disabled')){
                    $('#c_ejecutivos option:first-child').remove();
                  }
                  else{
                    x=false;
                  }

                }
                $("#c_ejecutivos").children().each(function(i, opt){
                  if($(opt).attr('disabled')){
                      $(opt).remove();
                    }
              });

                if(comodin=="no"){
                  $("#label_ejecutivo").html("Ejecutivo de cuenta <i style='margin-left:3px; color:red'> Usuario inactivo</i>");
                  generate("warning", "El ejecutivo "+EJE+" esta inactivo");
                  var opcion='<option value="'+EJE+'" disabled>'+EJE+'</option>';
                  $('#c_ejecutivos').prepend(opcion);
                  var orderCount = 0;
                  $('#c_ejecutivos').multiselect({
                    buttonText: function(options) {
                      if (options.length == 0) {
                        return ' SELECCIONA...';
                      }
                      else if (options.length > 3) {
                        return options.length + ' seleccionados  ';
                      }
                      else {
                        var selected = [];
                        options.each(function() {
                          selected.push([$(this).text(), $(this).data('order')]);
                        });
                        
                        selected.sort(function(a, b) {
                          return a[1] - b[1];
                        })
               
                        var text = '';
                        for (var i = 0; i < selected.length; i++) {
                          text += selected[i][0] + ', ';
                        }
               
                        return text.substr(0, text.length -2) + ' ';
                      }
                    },
                    onChange: function(option, checked) {
                      if (checked) {
                        orderCount++;
                        $(option).data('order', orderCount);
                      }
                      else {
                        $(option).data('order', '');
                      }
                    }
                  });
                  $("#c_ejecutivos").val(EJE);
                 
                  $("#c_ejecutivos").multiselect("refresh");
                  
                }
                else{
                  var orderCount = 0;
                  $('#c_ejecutivos').multiselect({
                    buttonText: function(options) {
                      if (options.length == 0) {
                        return ' SELECCIONA...';
                      }
                      else if (options.length > 3) {
                        return options.length + ' seleccionados  ';
                      }
                      else {
                        var selected = [];
                        options.each(function() {
                          selected.push([$(this).text(), $(this).data('order')]);
                        });
                        
                        selected.sort(function(a, b) {
                          return a[1] - b[1];
                        })
               
                        var text = '';
                        for (var i = 0; i < selected.length; i++) {
                          text += selected[i][0] + ', ';
                        }
               
                        return text.substr(0, text.length -2) + ' ';
                      }
                    },
                    onChange: function(option, checked) {
                      if (checked) {
                        orderCount++;
                        $(option).data('order', orderCount);
                      }
                      else {
                        $(option).data('order', '');
                      }
                    }
                  });
                  $("#label_ejecutivo").html("Ejecutivo de cuenta");
                  $("#c_ejecutivos").val(ejecutivo);
                  
                  $("#c_ejecutivos").multiselect("refresh");
                }
                $("#c_ejecutivos").multiselect("refresh");
                


                var produc=response.Produccion.split(",");
                $("#c_produccion").val(produc);
                $("#c_produccion").multiselect("refresh");

                var dis=response.Diseno.split(",");
                $('#c_disenio').val(dis);
                $("#c_disenio").multiselect("refresh");

                var dig=response.Digital.split(",");
                $('#c_digital').val(dig);
                $("#c_digital").multiselect("refresh");

                var sol=response.Solicita.split(",");
                $('#c_solicitantes').val(sol);
                $("#c_solicitantes").multiselect("refresh");

                var vid=response.Video.split(",");
                $('#c_video').val(vid);
                $("#c_video").multiselect("refresh");
                
                
                $('#txt_facturacion').val(response.Facturacion);
                $('.moneda').formatCurrency();
                var tipo=response.Tipo;
                if(tipo=="Total"){
                  $('#check_estatus_facturacion').bootstrapToggle('on')
                }
                else{
                  $('#check_estatus_facturacion').bootstrapToggle('off')
                }
                if (response.Candado=="DESBLOQUEADO") {
                  $('#btn_bloquear_evento').html('<i class="fas fa-lock-open"></i> Desbloqueado');
                  $('#btn_bloquear_evento').removeClass("btn-danger");
                  $('#btn_bloquear_evento').addClass("btn-success");
                  candado="DESBLOQUEADO";
                }
                else{
                  $('#btn_bloquear_evento').html('<i class="fas fa-lock"></i> Bloqueado');
                  $('#btn_bloquear_evento').removeClass("btn-success");
                  $('#btn_bloquear_evento').addClass("btn-danger");
                  candado="BLOQUEADO";
                }
                if(response.Comentarios=="NINGUNO"){
                  $('#area_comentarios').val("");
                }
                else{
                  $('#area_comentarios').val(response.Comentarios);
                }
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  alert("Status: " + textStatus); 
                  alert("Error: " + errorThrown); 
                  console.log(XMLHttpRequest);
                  
              }   
            });
      }

      $('#btn_modificar_evento').click(function(e){
        e.preventDefault();
        if(validar_crear_evento()){
          // se manda ajax para insertar el evento
          var ejecu=$('#c_ejecutivos option:selected').map(function(a, item){return item.value;});
          var ejecutivos="";
          for (var r=0;r<=ejecu.length-1;r++) {
            ejecutivos=ejecutivos+","+ejecu[r];
          }
          var produc=$('#c_produccion option:selected').map(function(a, item){return item.value;});
          var productores="";
          for (var r=0;r<=produc.length-1;r++) {
            productores=productores+","+produc[r];
          }
          var disenio=$('#c_disenio option:selected').map(function(a, item){return item.value;});
          var dis="";
          for (var r=0;r<=disenio.length-1;r++) {
            dis=dis+","+disenio[r];
          }
          var digital=$('#c_digital option:selected').map(function(a, item){return item.value;});
          var dig="";
          for (var r=0;r<=digital.length-1;r++) {
            dig=dig+","+digital[r];
          }
          var solicitante=$('#c_solicitantes option:selected').map(function(a, item){return item.value;});
          var sol="";
          for (var r=0;r<=solicitante.length-1;r++) {
            sol=sol+","+solicitante[r];
          }
          var video=$('#c_video option:selected').map(function(a, item){return item.value;});
          var vid="";
          for (var r=0;r<=video.length-1;r++) {
            vid=vid+","+video[r];
          }
          
          var solo_numeros=$('#txt_facturacion').asNumber({ parseType: 'Float' });
          $('#txt_facturacion').val(solo_numeros);
          var datos = $('#form_nuevo_evento').serializeArray();
          datos.push({name: 'usuario_registra', value: $('#label_user').html()});
          datos.push({name: 'productores', value: productores});
          datos.push({name: 'diseñadores', value: dis});
          datos.push({name: 'digital', value: dig});
          datos.push({name: 'ejecutivo', value: ejecutivos});
          datos.push({name: 'solicita', value: sol});
          datos.push({name: 'video', value: vid});
          
          $.ajax({
            url:   "actualizar_evento.php",
            type:  'post',
            data:  datos,
            success:  function (response) {
              console.log(response);
              if(response.includes("evento modificado")){
                $('#btn_crear_evento').show();     
                var evento=$('#c_eventos_creados option:selected').text();
                //ver_opcion(evento);  podria enviarse email
                generate('success', "El evento se ha actualizado!");
                metodo_limpiar_evento();
                llenar_eventos_combo("0");
                //ver_numero_evento();                  
              }

              else{
                console.log(response);
               generate('error', "ocurrio un error, consulte la consola para más detalles."); 
              }
            }
          });
        }
      });

      $("#btn_cancelar_evento").click(function(){
        var id_evento=$("#c_eventos_creados option:selected" ).text();
        if(id_evento==""){
          generate("info", "Debe seleccionar un evento");
        }else{
            var n2 = new Noty({
                text: '¿Deseas cancelar este evento?',
                theme: 'mint',
                closeWith: 'button',
                layout: "center",
                modal: true,
                type: "info",
                buttons: [
                  Noty.button('Aceptar', 'btn btn-success', function () {
                    var datos={
                        "id_evento": id_evento,
                      };
                      $.ajax({
                        url:   "cancelar_evento.php",
                        type:  'post',
                        data: datos,
                        success:  function (response) {
                          
                          if(response.includes("cancelado")){
                            generate('success',"El evento ha sido cancelado correctamente!");
    //                      enviar_notificacion_solicitud(nombre_evento, titulo);
                            metodo_limpiar_evento();
                            llenar_eventos_combo("0");
                            n2.close();
                          }
                          else if(response.includes("Existen pagos")){
                            generate('warning',"El evento cuenta con SDP previas, no se puede cancelar");
                          }
                          else{
                            console.log(response);
                            generate('error',"Error: "+response);
                          }
                        }
                      });
                      $noty.close();
                  }, {id: 'button1', 'data-status': 'ok'}),
              
                  Noty.button('Cancelar', 'btn btn-danger', function () {
                      console.log('button 2 clicked');
                      n2.close();
                  })
                ]
              });
              n2.show();
        }
      });

      $('#btn_bloquear_evento').on("click",function(){
        var candado="";
        if ($(this).hasClass("active")==false) {
          $(this).html('<i class="fas fa-lock-open"></i> Desbloqueado');
          $(this).removeClass("btn-danger");
          $(this).addClass("btn-success");
          candado="DESBLOQUEADO";
        }
        else{
          $(this).html('<i class="fas fa-lock"></i> Bloqueado');
          $(this).removeClass("btn-success");
          $(this).addClass("btn-danger");
          candado="BLOQUEADO";
        }
        actualizar_candado(candado);
      });

      function actualizar_candado(valor){
        var id_evento=$('#c_eventos_creados').val();
        var datos={
          "id_evento":id_evento,
          "candado":valor,
      };
        $.ajax({
          url:   'actualizar_candado.php',
          type:  'post',
          data: datos,
          success:  function (response) {
          if(!response.includes("exito")){
            generate("warning",response);
          }
          else{
            generate("success","El evento se ha actualizado");
            alert(valor);
            
          }
          }
        });
      }

     /*  var n2 = new Noty({
        text: 'Do you want to continue? <input id="example" class="form-control" type="text">',
        theme: 'metroui',
        closeWith: 'button',
        layout: "center",
        modal: true,
        type: "info",
        buttons: [
          Noty.button('Aceptar', 'btn btn-success', function () {
              alert($('input#example').val());
          }, {id: 'button1', 'data-status': 'ok'}),
      
          Noty.button('Cancelar', 'btn btn-danger', function () {
              console.log('button 2 clicked');
              n2.close();
          })
        ]
      });
      n2.show(); */

}