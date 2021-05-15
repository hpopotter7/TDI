function inicio(){

  var w=screen.width;
  var h=screen.height;
  var evento=$('#txt_evento').val();

 /*  $('body').delegate('.arriba','click',function(){
    //$("#frame").contents().scrollTop(0);
    $("#frame").contents().animate({ scrollTop: "0" });
    //$("#frame").animate({ scrollTop: 0 }, 'slow');
    alert("aus");
  }); */

  /* if(h<=768){
    $('#frame').css("height","60%");
  } */

  $('#frame').on('load', function() {
    $('.evento').css("top","0px");
  });

  if(evento!="0"){
    var url="solicitudes.php?evento="+evento;
    $("#frame").attr("src", url);
  }
  else{
    $("#menu_ver_pendientes").click();
  }

  $('#frame').change(function(){
    var iFrame = document.getElementById( 'iFrame1' );
    resizeIFrameToFitContent( iFrame );

    // or, to resize all iframes:
    var iframes = document.querySelectorAll("iframe");
    for( var i = 0; i < iframes.length; i++) {
        resizeIFrameToFitContent( iframes[i] );
    }
  });

  function resizeIFrameToFitContent( iFrame ) {

    iFrame.width  = iFrame.contentWindow.document.body.scrollWidth;
    iFrame.height = iFrame.contentWindow.document.body.scrollHeight;
}

$('.chosen').chosen();
  //previo a este se deben cargar los perfiles
  //ver_numero_notificaciones();
  ver_perfil();
  //updateReloj();
  var contador_tiempo=300;
  

  function updateReloj() {
    if (contador_tiempo == 0) {
      ver_numero_notificaciones();
      contador_tiempo=300;
    } 
    else {
      contador_tiempo -= 1;
        setTimeout(updateReloj, 1000);
    }
    //window.onload = updateReloj;
  }
  

  function ver_numero_notificaciones(){
    $.ajax({
      url:   'ver_numero_notificaciones.php',
      type:  'post',
      success:  function (response) {
        
        updateReloj();
         if(response.includes("ninguno")){
           $('.span_notificacion').hide();                     
        }
        else{ // si existen notificaciones
            
          $('.span_notificacion').show();
          $(".span_notificacion").css("display", "inline");
          $("#audio_ding")[0].play(); //debe usarse dentro del click de un boton
          new Noty({
            type: 'error',
            theme: 'nest',
            layout: 'topRight',
            progressBar : true,
            maxVisible  : 10,
            timeout     : [5000],
            text: 'Tienes notificaciones pendientes'
        }).show();
          $("#userProfileDropdown").addClass("slower wobble animated").one('animationend webkitAnimationEnd oAnimationEnd', function() {
            $("#userProfileDropdown").removeClass("slower wobble animated");
          });
        } 
      }
    });
  }

  $('#btn_mi_perfil').on('click',function(e){
    e.preventDefault();
    $('.span_notificacion').hide();
  });

  $('#btn_buzon').on('click',function(e){
    e.preventDefault();
    $("#frame").attr("src", "buzon.php");
  });

  $('#btn_mi_perfil').on('click',function(e){
    e.preventDefault();
    $("#frame").attr("src", "mi_perfil.php");
  });

  //EVENTOS 
$("#menu_crear_evento").click(function (e) { 
  e.preventDefault();  
  $('#ol_menu').html("Eventos");
  $('#ol_submenu').html("Crear evento");
  $("#frame").attr("src", "formulario_nuevo_evento.php");
});

$("#menu_modificar_evento").click(function (e) { 
  e.preventDefault();  
  $('#ol_menu').html("Eventos");
  $('#ol_submenu').html("Modificar evento");
  $("#frame").attr("src", "modificar_evento.php");
});
  
$("#menu_cerrar_evento").click(function (e) { 
  e.preventDefault();  
  $('#ol_menu').html("Eventos");
  $('#ol_submenu').html("Cerrar evento");
  $("#frame").attr("src", "cierre_eventos.html");
});

$("#menu_ver_pendientes").click(function (e) { 
  e.preventDefault();  
  $('#ol_menu').html("Eventos");
  $('#ol_submenu').html("Cerrar evento");
  $("#frame").attr("src", "pendientes.php");
});
//SOLICITUDES

$("#menu_solicitud_odc").click(function (e) { 
  e.preventDefault();  
  $('#ol_menu').html("Solicitudes");
  $('#ol_submenu').html("Solicitud de pago");
  $("#frame").attr("src", "solicitud.php?tipo=P");
});

$("#menu_solicitud_viaticos").click(function (e) { 
  e.preventDefault();  
  $('#ol_menu').html("Solicitudes");
  $('#ol_submenu').html("Solicitud de viáticos");
  $("#frame").attr("src", "solicitud.php?tipo=V");
});

$("#menu_solicitud_reembolso").click(function (e) { 
  e.preventDefault();  
  $('#ol_menu').html("Solicitudes");
  $('#ol_submenu').html("Solicitud de reembolso");
  $("#frame").attr("src", "solicitud.php?tipo=R");
});

$("#menu_vobo").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Solicitudes");
  $('#ol_submenu').html("VoBos");  
  $("#frame").attr("src", "vobo_solicitud.html");  
});

$("#menu_ver_formatos").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Solicitudes");
  $('#ol_submenu').html("Ver solicitudes");  
  $("#frame").attr("src", "solicitudes.php");  
});

//CATALOGOS
/* 
$("#menu_prealta").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Catálogos");
  $('#ol_submenu').html("Pre alta");    
  $("#frame").attr("src", "pre_alta.html");    
});
 */
/* $("#menu_bloqueo_prov").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Catálogos");
  $('#ol_submenu').html("Bloqueo Clientes-Proveedores");
  $("#frame").attr("src", "bloqueo_proveedores.html");
}); */

$("#menu_solicitud_cliente").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Catálogos");
  $('#ol_submenu').html("Clientes");
  $("#frame").attr("src", "clientes.php?tipo=A");
  //$("#frame").attr("src", "clientes.html");
});

$("#menu_solicitud_prov").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Catálogos");
  $('#ol_submenu').html("Proveedores");
  $("#frame").attr("src", "proveedores.php");
});

$("#menu_usuarios").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Catálogos");
  $('#ol_submenu').html("Usuarios");
  $("#frame").attr("src", "usuarios.php");
});

//CxP
$("#menu_tarjetas").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("CxP");
  $('#ol_submenu').html("Tarjetas");  
  $("#frame").attr("src", "tarjetas.php");
});

$("#menu_calendario").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("CxP");
  $('#ol_submenu').html("Calendario");  
  $("#frame").attr("src", "calendar2.html");
});

//Bases de datos

//Desaparece para meterlo en catalogos


//FACTURACION

$("#menu_solicitud_facturas").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Reportes");
  $('#ol_submenu').html("Eventos Pitch");  
  $("#frame").attr("src", "solicitud_facturas.php");  
});

//CXC
$("#menu_facturacion_pendiente").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("CxC");
  $('#ol_submenu').html("Facturación por cobrar");  
  $("#frame").attr("src", "reporte_facturacion.php");  
});

$("#menu_facturacion_calendario").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("CxC");
  $('#ol_submenu').html("Calendario");
  $("#frame").attr("src", "calendar_facturacion2.html");
});

$("#reporte_facturacion").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("CxC");
  $('#ol_submenu').html("Reportes de facturación");  
  $("#frame").attr("src", "reportes_fac.html");
});

//REPORTES

$("#menu_rep_eventos").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Reportes");
  $('#ol_submenu').html("Eventos Cerrados");  
  $("#frame").attr("src", "reporte_eventos.php");  
});

$("#btn_rep_historicos").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Reportes");
  $('#ol_submenu').html("Eventos Cerrados");  
  $("#frame").attr("src", "eventos_historicos3.html");  
});

$("#btn_rep_pitch").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Reportes");
  $('#ol_submenu').html("Eventos Pitch");  
  $("#frame").attr("src", "eventos_pitch2.html");  
});

$("#btn_rep_cancelados").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Reportes");
  $('#ol_submenu').html("Eventos Cancelados");  
  $("#frame").attr("src", "eventos_cancelados.html");  
});
$("#btn_rep_gastos").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Reportes");
  $('#ol_submenu').html("Facturación");  
  $("#frame").attr("src", "grafica_gastos.html");  
});

$("#menu_buscar_odc").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Reportes");
  $('#ol_submenu').html("Buscar Gastos");  
  $("#frame").attr("src", "buscar_gastos.php");  
});

$("#btn_rep_renta").click(function (e) { 
  e.preventDefault();
  $('#ol_menu').html("Reportes");
  $('#ol_submenu').html("Facturación");  
  $("#frame").attr("src", "rentabilidad.php");  
});



function ver_perfil(){
  
  $.ajax({
          url:   'ver_perfil.php',
          type:  'post',
          dataType: "json",
          success:  function (response) {
              contador_tiempo=300;
              updateReloj();
              registro_bitacora_login(response.usuario);
              if(response.cxc==""){
                if(response.usuario=="ALAN SANDOVAL" || response.usuario=="SANDRA PEÑA" || response.usuario=="FERNANDA CARRERA"){
                 
                }
                else{
                  $('#menu_cxp').remove();
                }
              }
              if(response.usuario=="ALAN SANDOVAL" || response.usuario=="SANDRA PEÑA" || response.usuario=="FERNANDA CARRERA"){
                if(response.usuario=="ALAN SANDOVAL" || response.usuario=="SANDRA PEÑA"){
                 
                }
                else{
                  $('#reporte_facturacion').remove();
                  $('#menu_cerrar_evento').remove();
                }
               }
               else{
                $('#menu_cxc').remove();
                $('#menu_cerrar_evento').remove();
                $('#btn_rep_renta').remove();
               }


               if(response.cat_cli==""){
                $('#menu_solicitud_cliente').remove();
               }

               if(response.cat_prov==""){
                $('#menu_solicitud_prov').remove();
               }

               if(response.cat_usu==""){
                $('#menu_usuarios').remove();
               }

               if(response.cat_fact==""){
                $('#menu_facturacion').remove();
               }


              ver_numero_notificaciones();
                /* $("#div_login").fadeOut("swing", function() {
               }); */
               //consultar_bitacora();
               /*  $('#load').show();
                $('.nav').show();
                $('#entrar').html("Entrar"); */
                //var nombre_usuario=response.usuario;
               //crear bitacora de ingresos
               
                //console.log(nombre_usuario);
                /* $('#label_user').html(nombre_usuario);
                $('#input_oculto').val(response.usuario); //nombre de usuario */
                
                /* $('#tipo_perfil').html("<ul>"); */
                
                
                /* if(response.eje.length>0){
                  $('#tipo_perfil').append('<li><i class="fas fa-caret-square-right" aria-hidden="true"></i> '+response.eje+'</li>');
                }
                if(response.sol.length>0){
                  $('#tipo_perfil').append('<li><i class="fas fa-caret-square-right" aria-hidden="true"></i> '+response.sol+'</li>');
                }
                if(response.cxc.length>0){
                  $('#tipo_perfil').append('<li><i class="fas fa-caret-square-right" aria-hidden="true"></i> '+response.cxc+'</li>');
                }
                if(response.dig.length>0){
                  $('#tipo_perfil').append('<li><i class="fas fa-caret-square-right" aria-hidden="true"></i> '+response.dig+'</li>');
                }
                if(response.pro.length>0){
                  $('#tipo_perfil').append('<li><i class="fas fa-caret-square-right" aria-hidden="true"></i> '+response.pro+'</li>');
                }
                if(response.dis.length>0){
                  $('#tipo_perfil').append('<li><i class="fas fa-caret-square-right" aria-hidden="true"></i> '+response.dis+'</li>');
                }
                if(response.dire.length>0){
                  $('#tipo_perfil').append('<li><i class="fas fa-caret-square-right" aria-hidden="true"></i> '+response.dire+'</li>');
                }
                $('#tipo_perfil').append("</ul>"); */
                //validar perfiles
                //validar_perfiles(response); 
                /* if(response.usuario.includes("SANDRA PEÑA")){
                  $('#btn_sin_factura').click();
                }
                else if(response.eje.includes("cuenta")){
                  $('#btn_sin_factura').click();
                }
                else if(response.cxc.includes("Cuentas por pagar")){
                  $('#btn_sin_factura').click();
                } */

          }
    });
}

function registro_bitacora_login(usuario){
  var parametros = {
                    "usuario": usuario,
            };
        $.ajax({
          data: parametros,
          url:   'registro_bitacora.php',
          type:  'post',
          success:  function (response) {
            //console.log(response);
          }
        });
  }
  //$('#alert_error').hide();
  $('#btn_transferir').on('click', function(e){
    e.preventDefault();
    var ID=$('#txt_solicitud').val();
    var evento_actual=$('#evento_actual').val();
    var evento_nuevo=$('#c_eventos_transferir').val();
    if(evento_actual==evento_nuevo){
        //generate("warning",'No es posible transferir al mismo evento');
        $('#alert_error').html('<div class="alert alert-warning alert-dismissible fade show" role="alert">No es posible transferir al mismo evento<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    else{
      $('#alert_error').html("<label> Transfiriendo... <img src='img/puntos.gif'></label>");
        transferir_factura(ID, evento_nuevo, evento_actual);
    }
  });

  function transferir_factura(ID, evento, evento_actual){
    var parametros = {
      "ID": ID,
      "evento": evento,                  
        };
        $.ajax({
          data: parametros,
          url:   'transferir_solicitud_factura.php',
          type:  'post',
          success:  function (response) {
            if(response.includes("transferida")){
              $('.close').click();
              $('#alert_error').html('');
              if(response.includes("archivo")){
                
                Swal.fire({
                  type: 'success',                  
                  html: 'La solicitud y archivo(s) han sido transferidos',
                })
              }
              else{
                Swal.fire({
                  type: 'success',
                  html: 'La solicitud ha sido transferida',
                });
                //swal("success", "La solicitud ha sido transferida!!");
              }
              /* var evento=$('#c_mis_eventos').val();
              ver_solicitudes_por_evento(evento,"todos"); */
              $("#frame").attr("src", "solicitudes.php?evento="+evento_actual);
            }
            else{
              $('#alert_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: '+response+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
              
            }
          }
        });
  }

  $('#btn_subir_comprobante').on('click', function(e){
    e.preventDefault();
    var evento=$('#txt_evento').val();
    var id=$('#txt_solicitud').val();
    if($('#files').val() == ''){
      $('.alert_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Se debe seleccionar un archivo<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
    }
    else{
      var inp = document.getElementById('files');
      var contador=inp.files.length;
      if(contador>10){
        $('.alert_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Solo se pueden subir máximo 10 documentos<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
      }
      else{
        for (var i = 0; i < inp.files.length; ++i) {
          var file_data = $('#files').prop('files')[i];   
          var form_data = new FormData();       
          form_data.append('file', file_data);
          form_data.append('evento', evento);
          form_data.append('id', id);
          alert("Evento: "+evento);
          alert("id: "+id);
          $.ajax({
              url: 'upload_comprobante.php', // point to server-side PHP script 
              dataType: 'text',  // what to expect back from the PHP script, if anything
              cache: false,
              contentType: false,
              processData: false,
              data: form_data,                         
              type: 'post',
              success: function(response){
                if(response.includes("Error")){
                  $('.alert_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: '+response+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                }
                else{
                  $('.close').click();
                  Swal.fire({
                    type: 'success',
                    html: response,
                  });
                  $("#frame").attr("src", "solicitudes.php?evento="+evento);
                }
              }
          });
        }
      }
    }
  
  });
  
  $('#btn_cambiar_estatus_factura').on('click', function(e){
    var evento=$('#txt_evento_solicitud').val();
    var fecha_pago=$('#fecha_pago_factura').val();
    var valor_cambio=$('#txt_divisa').val();
    var usd=$('#txt_usd').val();
    var id=$('#id_solicitud_factura').val();
      if(fecha_pago==null || fecha_pago==""){
        $('.alert_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">La fecha de pago esta vacia<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');                             
      }
      if(usd=="usd"){
        if(valor_cambio=="" || valor_cambio==null){
          $('.alert_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Ingresa el valor de cambio de divisa<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); 
        }
        else{
          actualizar_estatus_factura(id, "PAGADO",fecha_pago, valor_cambio, evento);
          $('.close').click();
        }
      }
      else{
        actualizar_estatus_factura(id, "PAGADO",fecha_pago, "0", evento);
        $('.close').click();
      }
  });

  function actualizar_estatus_factura(id,estatus,fecha_pago,divisa,evento){
    alert("Evento: "+evento);
    var datos={
      "id":id,
      "estatus":estatus,
      "fecha_pago":fecha_pago,
      "divisa": divisa,
    }
    $.ajax({
      url:   'modificar_estatus_factura.php',
      type:  'post', 
      data:   datos,
      success:  function (response) {
          if (response.includes("modificada")) {
                 swal({
                    type: 'success',
                    title: 'Modificado',
                    html: 'El estatus se ha modificado!'
                  });
                  $("#frame").attr("src", "solicitudes.php?evento="+evento);
          }
          else{
            $('.alert_error').html('<div class="alert alert-danger alert-dismissible fade show" role="alert">Error: '+response+'<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
          }
      }
    });

  }
 
}