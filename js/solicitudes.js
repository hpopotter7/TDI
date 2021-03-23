function inicio(){

    llenar_eventos_ver_solicitudes("0");
    if($('#tipo_odc').val()=="P"){
        $("#div_tipo_reembolso").hide();
        $('#div_mensaje').hide();
        ver_proveedores();
        var valores='<option value="03 TRANSFERENCIA ELECTRONICA DE FONDOS">03 TRANSFERENCIA ELECTRONICA DE FONDOS</option>';
             $('#c_forma_de_pago').html(valores);
    }
    else{
        $("#div_tipo_reembolso").show();
        $('#div_mensaje').show();
        ver_proveedores_usuarios("MA. FERNANDA CARRERA HDZ");
        var valores='<option value="02 CHEQUE NOMINATIVO"> 02 CHEQUE NOMINATIVO</option>';
             $('#c_forma_de_pago').html(valores);
    }
    
    $('#puntos_gif').hide();
    ver_personas();
    $("#f_solicitud").datepicker({
        dateFormat: 'dd/mm/yy',
        firstDay: 1
    }).datepicker("setDate", new Date());
    
      $("#f_pago").datepicker({
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
         minDate: 0,
    });
      $("#odc_fecha").datepicker({
        dateFormat: 'dd/mm/yy',
        firstDay: 1,
         minDate: -11,
    });

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

    function llenar_eventos_ver_solicitudes(anio){
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
            $('#c_numero_evento').html(response);
            $('#c_numero_evento').chosen({allow_single_deselect: true,width: '100%'}); 
            $('#c_numero_evento').trigger("chosen:updated");
            },
          }); 
        }

        function ver_proveedores(){
            $.ajax({
              url:   "ver_proveedores.php",
              type:  'post',
              success:  function (response) {
                $('#c_a_nombre').html(response);
              }
            });
        }

        function ver_proveedores_usuarios(bandera_sodexo){
            var datos={
                "bandera_sodexo": bandera_sodexo, 
              }
              $.ajax({
                url:   "ver_proveedores_usuarios.php",
                type:  'post',
                data: datos,
                success:  function (response) {
                  //console.log(response);
                  $('#c_a_nombre').html(response);
                }
              });
          }
        
        $('#odc_cheque_por').focusout(function(){
            var numero=$('#odc_cheque_por').asNumber({ parseType: 'Float' });
            $('#odc_label_letra').html(NumeroALetras(numero));
            $('#puntos_gif').hide();
              var VAL=ver_suma_sdp($('#c_numero_evento').val());
              var maximo=$('#label_maximo_odc').asNumber({ parseType: 'Float' });
              var odc=$(this).asNumber({ parseType: 'Float' });
              if(odc>maximo){
                $('#odc_cheque_por').val('');
                generate('warning','Lo sentimos<br>El mónto máximo permitido es '+$('#label_maximo_odc').html());
              }
          });
          $('#odc_cheque_por').focusin(function(){
            $('#odc_label_letra').html("");
            $('#puntos_gif').show();
          });

          function ver_personas(){
            $.ajax({
                url:   "ver_personas.php",
                type:  'post',
                async: false,
                success:  function (response) {
                  if(response.includes("</option>")){
                    $('#c_user_solicita').html(response);
                  }
                  else{
                    console.log(response);
                    generate('warning', "Ocurrio un error. Vea la consola para mas detalles."); 
                  }
                }
              });
  
              //combo compras
              $.ajax({
                url:   "ver_personas_compras.php",
                type:  'post',
                async: false,
                success:  function (response) {
                  if(response.includes("</option>")){
                    $('#txt_vobo_compras').html(response);
                  }
                  else{
                    console.log(response);
                    generate('warning', "Ocurrio un error. Vea la consola para mas detalles."); 
                  }
                }
              });
              // combo direccion
              $.ajax({
                url:   "ver_personas_direccion.php",
                type:  'post',
                async: false,
                success:  function (response) {
                  if(response.includes("</option>")){
                    $('#c_autorizo').html(response);
                  }
                  else{
                    console.log(response);
                    generate('warning', "Ocurrio un error. Vea la consola para mas detalles."); 
                  }
                }
              });
              //combo finanzas
              $.ajax({
                url:   "ver_personas_finanzas.php",
                type:  'post',
                async: false,
                success:  function (response) {
                  if(response.includes("</option>")){
                    $('#c_finanzas').html(response);
                  }
                  else{
                    console.log(response);
                    generate('warning', "Ocurrio un error. Vea la consola para mas detalles."); 
                  }
                }
              });
              
          }

          $('#c_tipo_reembolso').change(function(){
            var valor=$(this).val();
            var nota="";
            if(valor=="MA. FERNANDA CARRERA HDZ"){ // si es cheche el valor es MA FERNANDA CARREA
              nota="El cheque saldrá a nombre de Ma. Fernanda Carrera";
              var valores='<option value="02 CHEQUE NOMINATIVO"> 02 CHEQUE NOMINATIVO</option>';
              $('#c_forma_de_pago').html(valores);
            }
            else if(valor=="TARJETA SODEXO"){ // si es cheche el valor es MA FERNANDA CARREA
              nota="El depósito será directamente a una tarjeta SODEXO";
              var valores='<option value="03 TRANSFERENCIA ELECTRONICA DE FONDOS">03 TRANSFERENCIA ELECTRONICA DE FONDOS</option>';
              $('#c_forma_de_pago').html(valores);
            }
            else if(valor=="TARJETA DILIGO"){ // si es cheche el valor es MA FERNANDA CARREA
              nota="El depósito será directamente a una tarjeta DILIGO";
              var valores='<option value="03 TRANSFERENCIA ELECTRONICA DE FONDOS">03 TRANSFERENCIA ELECTRONICA DE FONDOS</option>';
              $('#c_forma_de_pago').html(valores);
            }
            
            $('#txt_nota').val(nota);
            ver_proveedores_usuarios(valor);
          });

          $('#c_user_solicita').change(function(){
            var solicita=$(this).val();
            var datos={
              "solicita":solicita,
            };
            $.ajax({
              url:   'buscar_jefe_directo.php',
              type:  'post',
              data: datos,
              success:  function (response) {
                
                  var opciones="";
                  //$('#txt_coordinador').val(response);
                  if(response.includes(",")){
                    var arr=response.split(",");
                    for(var r=0;r<=arr.length-1;r++){
                      opciones=opciones+"<option value='"+arr[r]+"'>"+arr[r]+"</option>";
                    }
                  }
                  else{
                    opciones="<option value='"+response+"'>"+response+"</option>";
                  }
                 $('#c_coordinador').html(opciones);
              }
            });
            var evento=$('#c_numero_evento option:selected').text();
            var datos={
              "evento":evento,
            };    
            $.ajax({
              url:   'buscar_project.php',
              type:  'post',
              data: datos,
              success:  function (response) {
                  $('#txt_project').html(response);
              }
            });
          });

          $("#c_numero_evento").chosen().change(function(){
            var valor=$(this).val();
            ver_suma_sdp(valor);
            if(!ver_caducidad_evento(valor)){
              generate("warning", "Este evento ya esta vencido, no es posible hacer solicitudes");
            }         
          });

          function ver_suma_sdp(id) {
            var suma="";
            //var importe=$('#odc_cheque_por').asNumber({ parseType: 'Float' });
            var datos={
              'id': id,
              //'importe': importe,
            }
             $.ajax({
                url:   "ver_suma_sdp.php",
                type:  'post',
                data: datos,
                //async: false,
                success:  function (response) {
                    
                  var arr=response.split("&");
                  var ejecutivo=arr[0];
                  var monto=Number(arr[1].replace(/[^0-9.-]+/g,""));
                  
                  $('#badge_monto').show();
                  if(monto<=0){
                    $('#label_maximo_odc').html("$0.00");
                    $('#label_maximo_odc').removeClass('label-success');
                    $('#label_maximo_odc').addClass('label-danger');
                    
                  }
                  else{
                    $('#label_maximo_odc').html(arr[1]);
                    $('#label_maximo_odc').removeClass('label-danger');
                    $('#label_maximo_odc').addClass('label-success');
                  }
                }
              });
             //return suma;
          }

          function ver_caducidad_evento(valor){
            var respuesta=true;
            var datos={"valor":valor};
            $.ajax({
              url:   'eventos_vencidos.php',
              type:  'post',
              data: datos,
              async: false,
              success:  function (response) {
                if(response.includes("vencido")){
                  respuesta=false;
                }
              }
            });
            return respuesta;
          }

          $("#limpiar_cliente").on('click', function(){
            location.reload();
          });

          $('#enviar_odc').click(function(){
            var id_evento=$('#c_numero_evento').val();
            if(id_evento="" || id_evento=="vacio" || id_evento=="0"){
                generate("info", "Debe seleccionar un evento");
            }
            else if(!ver_caducidad_evento(id_evento)){
              generate("info", "Este evento ya esta vencido, no es posible hacer solicitudes");
            }
            else{
              enviar_solicitud_SDP();
            }                 
          });

          $('#c_a_nombre').change(function(){
            var proveedor=$(this).val();
            if(proveedor.includes("BBVA BANCOMER")){
              ver_usuarios_bancomer();
            }
            else{
              $('.user_proveedor').hide();
              $('#id_usuario_proveedor').val("0");
            }
          });

          function ver_usuarios_bancomer(){
            $.ajax({
                url:   'ver_usuarios_bancomer.php',
                type:  'post',
                
                success:  function (response) {
                    var n2 = new Noty({
                        text: "Selecciona un usuario de BBVA BANCOMER<p>"+response,
                        theme: 'mint',
                        closeWith: 'button',
                        layout: "center",
                        modal: true,
                        type: "info",
                        buttons: [
                        Noty.button('Aceptar', 'btn btn-success', function () {
                            var usuario=$('select#c_user_bancomer').val();
                            var nombre_usuario=$('select#c_user_bancomer option:selected').text();
                            if(usuario==""){
                                generate("warning", "Debe seleccionar un usuario");
                              }
                              else{                                
                                $('#usuario_proveedor').html(nombre_usuario);
                                $('#id_usuario_proveedor').val(usuario);                      
                                $('.user_proveedor').fadeIn();
                                n2.close();
                              }
                            
                        }, {id: 'button1', 'data-status': 'ok'}),
                    
                        Noty.button('Cancelar', 'btn btn-danger', function () {
                            n2.close();
                        })
                        ]
                    });
                    n2.show();
                    
                }
              });
          }

          function enviar_solicitud_SDP(SOLICITO, FINANZAS){
            var id_usuario_proveedor=$('#id_usuario_proveedor').val();
            var titulo=$('#tipo_odc').val();
            var evento=$('#c_numero_evento').val();            
            var f_sol=$('#f_solicitud').val();
            var f_pago=$('#f_pago').val();
            var odc_cheque_por=$('#odc_cheque_por').val();
            var letra=$('#odc_label_letra').html();
            var tipo_reembolso="";
            var a_nombre=$('#c_a_nombre').val();
            var num_tarjeta="0";
            //if(!titulo.includes("pago")){
            if($('#tipo_odc').val()!="P"){
              num_tarjeta=a_nombre;
              var tipo_reembolso=$('#c_tipo_reembolso').val();
              if(tipo_reembolso.includes("TARJETA")){ // si es con tarjeta
                a_nombre=$('#c_a_nombre option:selected').text();
                var res= a_nombre.split("[");
                a_nombre=res[1];
                a_nombre=a_nombre.substr(0,a_nombre.length-1);
              }
              else if(tipo_reembolso.includes("MA. FERNANDA CARRERA HDZ")){ // si es cheque
                a_nombre=$('#c_a_nombre option:selected').text();
                tipo_reembolso="CHEQUE";
                num_tarjeta="0";
              }
            }    
            else{ // si la odc es de pago se valida bancomer
              tipo_reembolso="PAGO NORMAL";
              if(a_nombre.includes("BBVA BANCOMER")){
                tipo_reembolso="Tarjeta BANCOMER";
                var user_bancomer=$('#usuario_proveedor').html().split(" - ");
                a_nombre=user_bancomer[0]; // [%%] --> bancomer
                num_tarjeta=user_bancomer[1];
                tipo_reembolso="Tarjeta BANCOMER";
              }
            }                               
            var txt_concepto=$('#txt_concepto').val();
            var txt_servicios=$('#txt_servicios').val();
            var txt_otros=$('#txt_otros').val();
            var tipo_pago=$(".tipo_pago:checked").val();
            var forma_pago=$("#c_forma_de_pago").val();            
            var cfdi=$('#c_CFDI').val();
            var metodo_pago=$('#combo_metodo_pago').val();
            var txt_docto_soporte=$('#txt_docto_soporte').val();
            var odc_fecha=$('#odc_fecha').val();
            var no_cheque=$('#txt_no_cheque').val();7
            var compras=$('#txt_vobo_compras').val();
            var coordinador=$('#c_coordinador').val();
            var project=$('#txt_project').val();
            var user=$("#input_oculto").val();
            var arr_sol=f_sol.split("/");
            f_sol=arr_sol[2]+"-"+arr_sol[1]+"-"+arr_sol[0];
            var arr_pago=f_pago.split("/");
            f_pago=arr_pago[2]+"-"+arr_pago[1]+"-"+arr_pago[0];
            var solicita=$("#c_user_solicita").val();
            var ejecutivo=$("#txt_project").val();
            var direccion=$("#c_autorizo").val();
            var finanzas=$("#c_finanzas").val();            
            if(odc_fecha!=""){
                var arr_odc=odc_fecha.split("/");
                odc_fecha=arr_odc[2]+"-"+arr_odc[1]+"-"+arr_odc[0];
            }
            if(evento=="vacio"){
            generate('warning',"Debe seleccionar un evento");
            }
            else if(SOLICITO==""){
              generate('warning',"El solicitante no puede ir vacio");
            }
            else if(FINANZAS==""){
              generate('warning',"La persona de finanzas no puede ir vacia");
            }
            else if($('#f_solicitud').val()==""){
              generate('warning',"La fecha de solicitud no puede ir vacia");
            }
            else if($('#f_pago').val()==""){
              generate('warning',"La fecha de pago no puede ir vacia");
            }
            else if($('#odc_cheque_por').val()==""){
              generate('warning',"El importe no puede ir vacio");
            }
            else if($('#c_a_nombre').val()=="vacio" || $('#c_a_nombre').val()==""){
              generate('warning',"Debe seleccionar a un proveedor");
            }
            else if(a_nombre=="BBVA BANCOMER" && (id_usuario_proveedor=="0" || id_usuario_proveedor==0)){
              generate('warning',"No ha seleccionado a un usuario con tarjeta Bancomer");
            }
            else if($('#txt_concepto').val()==""){
              generate('warning',"El concepto no puede ir vacio");
            }
            else if($('#txt_servicios').val()==""){
              generate('warning',"Los servicios no pueden ir vacios");
            }
            else if($(".tipo_pago:checked").val()=="" || $(".tipo_pago:checked").val()==null){
              generate('warning',"Debe seleccionar un tipo de pago");
            }
            else if(forma_pago=="vacio"){
              generate('warning',"Debe seleccionar una forma de pago");
            }
            else if(cfdi=="vacio"){
              generate('warning',"Debe seleccionar un uso de CFDI");
            }
            else if(metodo_pago=="vacio"){
              generate('warning',"Debe seleccionar un metodo de pago");
            }
            else if(solicita=="vacio"){
              generate('warning',"Debe seleccionar al solicitante");
            }
             else if(direccion=="vacio"){
              generate('warning',"Debe seleccionar un director");
            }
            else if(compras=="vacio"){
              generate('warning',"Debe ingresar un Vo.Bo de Compras");
            }
            else if(ejecutivo=="vacio"){
              generate('warning',"Debe seleccionar a un Ejecutivo");
            }
            else if(coordinador==""){
              generate('warning',"Debe ingresar un Coordinador de área");
            }
            else if(project==""){
              generate('warning',"Debe ingresar un Project Manager");
            }
            else{
              odc_cheque_por=$('#odc_cheque_por').asNumber({ parseType: 'Float' });
              $('#odc_cheque_por').val(odc_cheque_por);
              var VAL=ver_suma_sdp(evento);
              var maximo=$('#label_maximo_odc').asNumber({ parseType: 'Float' });
              if(odc_cheque_por<maximo){
                if(titulo.includes("P")){
                    titulo="Pago";
                }
                else if(titulo.includes("V")){
                    titulo="Viáticos";
                }
                else if(titulo.includes("R")){
                    titulo="Reembolso";
                }
                var evento=$('#c_numero_evento option:selected').text();
                var tipo=$('#c_tipo').val();

                /* if( $('#check_tipo_sol').is(':checked')){
                    tipo="Normal";
                }
                else{
                    tipo="Urgente";
                }  */                       
                $('#c_numero_evento').val();
                    var datos={
                    "titulo": titulo,
                    "evento": evento,
                    "f_sol": f_sol,
                    "f_pago": f_pago,
                    "odc_cheque_por": odc_cheque_por,
                    "letra": letra,
                    "tipo": tipo,
                    "cfdi": cfdi,
                    "metodo_pago": metodo_pago,
                    "a_nombre": a_nombre,
                    "tipo_reembolso": tipo_reembolso,
                    "txt_concepto": txt_concepto,
                    "txt_servicios": txt_servicios,
                    "txt_otros": txt_otros,
                    "txt_docto_soporte": txt_docto_soporte,
                    "odc_fecha": odc_fecha,
                    "tipo_pago": tipo_pago,
                    "user": user,
                    "SOLICITO":solicita,
                    "FINANZAS":finanzas,
                    "DIRECTIVO":direccion,
                    "forma_pago": forma_pago,
                    "no_cheque":no_cheque,
                    "compras": compras,
                    "coordinador": coordinador,
                    "project": project,
                    "num_tarjeta":num_tarjeta
                    };
                    $.ajax({
                    url:   "insertar_odc.php",
                    type:  'post',
                    data: datos,
                    success:  function (response) {
                        if(response.includes("registro odc correcto")){
                        generate('success',"<htm>La <a href='solicitud_pago.php?id=0' class='btn btn-info' target='_blank'><strong style='color:black;'>solicitud</strong></a> se ha guardado correctamente</htm>");
                        //enviar_notificacion_solicitud("","texto","user","VoBo para solicitud de compra","vacio");
                        //window.open("solicitud_pago.php?id=0",'_blank');
                        window.setTimeout(function() {
                            location.reload();
                        }, 3000); 
                        }
                        else{                                
                        generate('error',"Ocurrio un error al guardar la solicitud: "+response);
                        }
                    }
                    });                         
              }
              else{
                $('#odc_cheque_por').val('');
                generate('warning','Lo sentimos<br>El mónto máximo permitido es '+$('#label_maximo_odc').html());
              }
            }
      }
}