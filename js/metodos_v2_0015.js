function inicio(){

  
  var bandera_menu=false;
  $('#resultado_bitacora').hide();
 
$(".collapsed").click(function(e){
  e.preventDefault();
});

$('#nav_verde').mouseover(function(){
  if(bandera_menu==false){
      $('#sidenav01').css("left","0px");
      bandera_menu=true;
  }
});
  
  $(".navbar").mouseleave(function(){
    if(bandera_menu==true){
      $('#sidenav01').css("left","-250px");
      bandera_menu=false;
  }
  });
  
  ver_personas();

  var contador_tiempo=-1;
  //ver_numero_notificaciones();

  var ids_odc="";// cadena para transeferir eventos
  var BANCOS="";
  var bandera_menu_activo="";

  var csf=false;
  var ine=false;
  var edo=false;
  var comp=false;
  var acta=false;

var idioma_espaniol = {
"sProcessing":     "Procesando...",
"sLengthMenu":     "Mostrar _MENU_ registros",
"sZeroRecords":    "No se encontraron resultados",
"sEmptyTable":     "Ningún dato disponible en esta tabla",
"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
"sInfoPostFix":    "",
"sSearch":         "Buscar:",
"sUrl":            "",
"sInfoThousands":  ",",
"sLoadingRecords": "Cargando...",
"oPaginate": {
    "sFirst":    "Primero",
    "sLast":     "Último",
    "sNext":     "Siguiente",
    "sPrevious": "Anterior"
},
"oAria": {
    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
}
}

   var t = $('#tabla_partidas').DataTable({
      
      "searching": false,
      "language" : idioma_espaniol,
       "lengthChange": false,
       "ordering": false,
       //"scrollX": true,
       "scrollCollapse": true,
       "columnDefs": [
          { "width": "55%", "targets": 0 }
       ],
       "paging": false

    });



  var sumatoria_pu=0;
  var sumatoria_iva=0;
  var sumatoria_total=0;

  $('.dropdown-submenu a.test').on("mouseenter", function(e){
    $(this).next('ul').toggle();
    e.stopPropagation();
    e.preventDefault();
  });

  $('.bubble').tooltipster();
  



  $('#label_fernanda').hide();
  $('#sec_datos_factura').hide();
  $('#div_clientes_registrados').show();

   $("#user").focus();

  $("input[type=text]").focusout(function(){
    $(this).val($(this).val().toUpperCase());
  });
  $("textarea").focusout(function(){
    $(this).val($(this).val().toUpperCase());
  });
  $("#txt_sede").focusin(function(){
    $(this).val("");
  });
  $("#txt_destino").focusin(function(){
    $(this).val("");
  });

  var bandera_click=true;
  var bandera_activo="no";
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
   $('#notificaciones').hide();
   $('#btn_cerrar_bitacora').hide();

   
   $('#notificaciones').mouseover(function(e){
    e.preventDefault();
    $('#notificaciones').css("right","0px");
   });
   $('#notificaciones').mouseout(function(e){
    e.preventDefault();
    $('#notificaciones').css("right","-350px");
   });

   $('#btn_notificaciones').click(function(e){
    e.preventDefault();
    $('#btn_notificaciones').hide();
    $('#btn_cerrar_bitacora').show();
    consultar_bitacora();
   });

   $('#btn_cerrar_bitacora').click(function(e){
    e.preventDefault();
    $('#btn_notificaciones').show();
    $('#btn_cerrar_bitacora').hide();
    $('#resultado_bitacora').html("");
    $('#resultado_bitacora').fadeOut();
   });

   $('.buttonText:eq(0)').html('CSF');
   $('.buttonText:eq(1)').html('INE');
   $('.buttonText:eq(2)').html('ACTA');
   $('.buttonText:eq(3)').html('EDO. CTA.');
   $('.buttonText:eq(4)').html('DOMICILIO');

   //$('#s').hide();
   //$('#enviar_solicitud_cliente').hide();
   $('.lis').show();
   $("#div_sodexo").hide();
   $('#c_eventos_creados2').hide();
   $('#check_tipo_sol').bootstrapToggle('on');
   
  ver_usuarios_registrados();

  ver_usuarios_combos("Ejecutivo");
  ver_usuarios_combos("Solicitante");
  ver_usuarios_combos("Digitalizacion");
  ver_usuarios_combos("Productor");
  ver_usuarios_combos("Disenio");
  
  ver_clientes();
  ver_solicitudes_clientes("true", "cliente");
  ver_numero_evento(); // count # eventos creados

  var expRegEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
  var pat_clabe=/^[0-9]{18}$/;
  ver_bancos();


  $('.container').hide();
  $('#espacio').hide();
  $('#div_login').show();
  $('#btn_transferir').hide();
  $('#btn_borrar_sdp').hide();
  
  $('#btn_bloquear').hide();

  $("#file_rfc").filestyle('buttonText', 'RFC de la empresa');


   $('#puntos_gif').hide();
   $( "#txt_fecha_inicio_evento").datepicker({ dateFormat: 'yy-mm-dd' });
   $( "#txt_fecha_final_evento").datepicker({ dateFormat: 'yy-mm-dd' });
   $( "#f_solicitud").datepicker({ dateFormat: 'yy-mm-dd' });
   $( "#f_pago").datepicker({ dateFormat: 'yy-mm-dd' });
   $( "#odc_fecha").datepicker({dateFormat: 'yy-mm-dd'});
   $( ".fecha").datepicker({ dateFormat: 'dd-mm-yyyy' });
  var cliente="";

 /* function ocultar(nombre){
    //$('.container').hide()
    $('.container').addClass('animated zoomOutDown').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $('.container').hide();
        nombre.removeClass('animated zoomOutDown').addClass('animated zoomInUp').show();  
    });    
    
            
  }*/

  function generate(type, text) {
    if(type=="error" || type=='warning'){
      $("#audio_error")[0].play();
    }

            var n = noty({
                text        : text,
                type        : type,
                dismissQueue: true,
                layout      : 'topCenter',  //bottomLeft
                
                //closeWith   : ['button'],
                //theme       : 'defau',
                progressBar : true,
                maxVisible  : 10,
                timeout     : [3000],
                
            });
            //console.log('html: ' + n.options.id);
            return n;
        }

       
  $('#load2').hide();
  $('#load_prov').hide();
  $('.nav').hide();
  $('#prueba').hide();
  /*
  $('#nav').hide();
  $('#div_nuevo_evento').hide();

  $('#div_odc').hide();*/
  $('#borrar_usuario').hide();


ver_perfil();


  function ver_perfil(){
          $.ajax({
                  url:   'ver_perfil.php',
                  type:  'post',
                  dataType: "json",
                  success:  function (response) {
                      contador_tiempo=120;
                      updateReloj();
                        $("#div_login").fadeOut("swing", function() {
                       });
                       //consultar_bitacora();
                        $('#load').show();
                        $('.nav').show();
                        $('#entrar').html("Entrar");
                        var nombre_usuario=response.usuario;
                       //crear bitacora de ingresos
                       registro_bitacora_login(response.usuario);
                        //console.log(nombre_usuario);
                        $('#label_user').html(nombre_usuario);
                        $('#input_oculto').val(response.usuario); //nombre de usuario
                        
                        $('#tipo_perfil').html("<ul>");
                        ver_numero_notificaciones();
                        
                        if(response.eje.length>0){
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
                        $('#tipo_perfil').append("</ul>");
                        //validar perfiles
                        validar_perfiles(response); 
                    
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

  function actualizar_contraseña(user, pass){
    var parametros = {
                  "user": user,
                  "pass": pass,
          };
      $.ajax({
        data: parametros,
        url:   'modificar_password.php',
        type:  'post',
        success:  function (response) {
          if(response.includes("password modificado")){
            $('#pass').val("");
            swal({
              type: 'success',
              title: 'La contraseña se ha cambiado',
              text: 'Inicia sesión de nuevo',
            });
          }
          else{
            swal({
              type: 'error',
              title: 'Ocurrio un error',
              text: 'Vea la consola para mas detalles',
            });
          }
        }
      });
    
  }

  $('#txt_fecha_inicio_evento').datepicker()
    .on("input change", function (e) {
      $('#txt_fecha_final_evento').datepicker('setDate', e.target.value);
    
});

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

    /*$('#menevento_crear').click(function(e){
      e.preventDefault();
      $('#div_nuevo_evento').fadeIn();
      $('#div_odc').fadeOut();
    });

    $('#sol_odc').click(function(e){
      e.preventDefault();
      $('#div_nuevo_evento').fadeOut();
      $('#div_odc').fadeIn();
    });*/

    

    function ver_usuarios_combos(tipo){//obtener los usuarios registrados
        var datos={
          "tipo": tipo,
        };
      $.ajax({
            url:   'ver_usuarios_combos.php',
            data: datos,
            type:  'post',
            success:  function (response) {
              
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
                /*
                response=add+response;
                response="<option value='NA'>NA</option>"+response;
                $('#c_disenio').html(response);
                */
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
                /*
                response=add+response;
                response=response+"<option value='NA'>NA</option>";
                $('#c_digital').html(response);
                */
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

    function ver_usuarios_registrados(){//obtener los usuarios registrados

    $.ajax({
          url:   'ver_usuarios.php',
          type:  'post',
          success:  function (response) {
             
              $('.combo_usuarios').html(response);
          }
    });
  }

  function ver_clientes(){//obtener los usuarios registrados
      
    $.ajax({
          url:   'ver_clientes.php',
          type:  'post',
          
          success:  function (response) {
             //var arr=response.split("#");
             //console.log(response);
             
              $('.combo_clientes').html(response);
          }
    });
  }
  function ver_solicitudes_clientes(ban, tipo){//obtener los usuarios registrados
    
    var link="";
    if(tipo.includes("clien")){
      link='ver_solicitud_clientes.php';
    }
    else{
      link='ver_solicitud_proveedores.php'
    }
    var usuario=$("#input_oculto").val();
    
    var parametros = {
                  "bandera": ban,
                  "usuario": usuario,
          };
    $.ajax({
          url:   link,
          type:  'post',
          data:  parametros,
          success:  function (response) {
              $('#c_clientes_alta').html(response);
          }
    });
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

  $("#c_usuarios").change(function(){
       $('#check_eje').prop('checked', false);
       $('#check_sol').prop('checked', false);
       $('#check_dig').prop('checked', false);
       $('#check_dis').prop('checked', false);
       $('#check_cxp').prop('checked', false);
       $('#check_pro').prop('checked', false);
       $('#check_dir').prop('checked', false);

       $('#check_sol_cat').prop('checked', false);
       $('#check_eje_cat').prop('checked', false);
       $('#check_dig_cat').prop('checked', false);
       $('#check_fac_cat').prop('checked', false);
      if($(this).val()!="vacio"){
        var valor=$(this).val();
        $('#borrar_usuario').show();
        var parametros={
          "valor": valor,
        }
        $.ajax({
            url:   'ver_detalle_usuarios.php',
            type:  'post',
            data: parametros,
            dataType: "json",
            success:  function (response) {
              
              var err=response.error;
              if(err.includes("Error")){
                generate('warning',response.sql);
              }
              else{
                $('#agregar_usuario').html('<i class="i_espacio fa fa-save" aria-hidden="true"></i>Modificar Usuario');
                $('#txt_nombre_usuario').val(response.nombre);
                $('#txt_username').val(response.user);
                $('#txt_email_usuario').val(response.email);
                
                $('#c_tarjeta_sodexo').val(response.sodexo);
                if(response.eje=="X"){
                  $('#check_eje').prop('checked', true);
                }
                if(response.sol=="X"){
                  $('#check_sol').prop('checked', true);
                }
                if(response.dig=="X"){
                  $('#check_dig').prop('checked', true);
                }
                if(response.dis=="X"){
                  $('#check_dis').prop('checked', true);
                }
                if(response.cxp=="X"){
                  $('#check_cxp').prop('checked', true);
                }
                if(response.pro=="X"){
                  $('#check_pro').prop('checked', true);
                }
                if(response.dire=="X"){
                  $('#check_dir').prop('checked', true);
                }
                if(response.cat_cli=="X"){
                  $('#check_sol_cat').prop('checked', true);
                }
                if(response.cat_prov=="X"){
                  $('#check_eje_cat').prop('checked', true);
                }
                if(response.cat_usu=="X"){
                  $('#check_dig_cat').prop('checked', true);
                }
                
                if(response.cat_fact=="X"){
                  $('#check_fac_cat').prop('checked', true);
                }
                llenar_combo_tarjetas();
               }
             
          },
          error: function (xhr, ajaxOptions, thrownError) {
            generate("error","Ocurrio un error con los perfiles.Revise la consola para mas detalles");
        console.log(xhr.responseText);

        console.log(thrownError);
      }
        });
      }
      else{
         limpiar();
      }
  });

         $('#limpiar').click(function(){
          limpiar();
         });

         function limpiar(){
           $('#agregar_usuario').html('<i class="i_espacio fa fa-plus" aria-hidden="true"></i>Agregar Usuario');
          //$('#txt_nombre_usuario').val("");
          //$('#txt_username').val("");
          //$('#txt_password').val("");
          $('#borrar_usuario').hide();
          //$('#c_tipo_usuario option:nth(0)').prop("selected","selected");
         // $('#c_usuarios option:nth(0)').prop("selected","selected");
          $("#form_usuarios").trigger('reset');
          $('#toggle-trigger').prop('checked', false).change();
         }

        
         function validaForm(){
            // Campos de texto
            if($("#txt_nombre_usuario").val() == ""){
            generate('warning', "El nombre del usuario no puede ir vacio");
            
             // Esta función coloca el foco de escritura del usuario en el campo Nombre directamente.
                return false;
            }
            if($("#txt_username").val() == ""){
            generate('warning', "El username no puede ir vacio");
                return false;
            }
            if($("#txt_password").val() == ""){
            generate('warning', "El password no puede ir vacio");
                return false;
            }
            if($("#c_tipo_usuario").val() == ""){
            generate('warning', "El tipo de usuario no se ha seleccionado");
                return false;
            }

            return true; // Si todo está correcto
        }


        $('#agregar_usuario').click(function(){
          var boton=$(this).html();
          if(validaForm()){
            var link="";
          if(boton.includes("Agregar")){
            link="insertar_usuario.php";
          }
          else{
            link="modificar_usuario.php";
          }
             $.ajax({
              url:   link,
              type:  'post',
              data: $('#form_usuarios').serialize(),
              success:  function (response) {
                if(response.includes("registro correcto")){
                  limpiar();
                  ver_usuarios_registrados();
                  generate('success', "El usuario se ha creado correctamente.");
                }
                else if(response.includes("ya existe ese username")){
                  generate('warning', "Ese username ya existe. <br />Por favor elija otro username");
                }
                else if(response.includes("usuario modificado")){
                  
                   limpiar();
                  ver_usuarios_registrados();
                    var user=$('#user').val();
                    var pass=$('#pass').val();
                    if(user=="" || pass==""){
                      generate('warning', "El usuario o contraseña no deben ir vacios");
                    }
                    else{
                    log(user, pass);
                    }
                  generate('success', "El usuario se ha modificado correctamente.");
                }
                else if(response.includes("Duplicate ")){
                  generate('warning', "Ese email ya esta registrado.");
                }
                else{
                  console.log(response);
                  generate('error', "Ocurrio un error en el proceso. Vea la consola para más detalles");
                }
              }
            });

         }
       });

        $('#borrar_usuario').click(function(){
          noty({
            text: '¿Realmente deseas eliminar al usuario?',
            type        : 'warning',
            dismissQueue: false,
            theme       : 'metroui',
            layout      : 'topCenter',  //bottomLeft
            buttons: [
              {addClass: 'btn btn-success', text: 'Si, eliminar', onClick: function($noty) {
                  // this = button element
                  // $noty = $noty element
                  //console.log($noty.$bar.find('input#example').val());
                  //ajax borrar user
                    var nombre=$('#c_usuarios').val();
                    var parametros={
                      "nombre": nombre
                    }
                     $.ajax({
                        url:   "borrar_usuario.php",
                        type:  'post',
                        data: parametros,
                        success:  function (response) {
                          //console.log(response);
                          if(response.includes("usuario eliminado")){
                            limpiar();
                            ver_usuarios_registrados();
                            $noty.close();
                            generate("success","El usuario ha sido eliminado!!");
                          }
                          else{
                            $noty.close();
                            generate('error', "Ocurrio un error en el proceso. Vea la consola para más detalles");
                          }
                        }
                      });


                  //
                  
                }
              },
              {addClass: 'btn btn-danger', text: 'Cancel', onClick: function($noty) {
                  $noty.close();
                 
                }
              }
            ]
          });
        });

        function validar_crear_evento(){
            // Campos de texto
            var ejecu=$('#c_ejecutivos option:selected').map(function(a, item){return item.value;});
            var produc=$('#c_produccion option:selected').map(function(a, item){return item.value;});
            var disenio=$('#c_disenio option:selected').map(function(a, item){return item.value;});
            var digital=$('#c_digital option:selected').map(function(a, item){return item.value;});
            var solicitante=$('#c_solicitantes option:selected').map(function(a, item){return item.value;});
            if($("#c_cliente").val() == "vacio"){
            generate('warning', "Debe elegir un cliente");
                return false;
            }
            if($("#txt_nombre_evento").val() == ""){
            generate('warning', "Debe ingresar un nombre para el evento");
                return false;
            }
            if($("#txt_fecha_inicio_evento").val() == ""){
            generate('warning', "Debe elegir la fecha de incio del evento");
                return false;
            }
            if($("#txt_fecha_final_evento").val() == ""){
            generate('warning', "Debe elegir la fecha final del evento");
                return false;
            }
            if($("#txt_destino").val() == ""){
            generate('warning', "Debe ingresar un destino");
                return false;
            }
            if($("#txt_sede").val() == ""){
            generate('warning', "Debe ingresar una sede");
                return false;
            }
            if(disenio.length == 0){
            generate('warning', "Debe elegir quien diseña el evento");
                return false;
            }
            if(produc.length == 0){
            generate('warning', "Debe elegir al menos a un productor");
                return false;
            }
            if(ejecu.length == 0){
            generate('warning', "Debe elegir al menos a un ejecutivo");
                return false;
            }
            if(digital.length == 0){
            generate('warning', "Debe elegir al menos a un digital");
                return false;
            }
            if(solicitante.length == 0){
            generate('warning', "Debe elegir al menos a un digital");
                return false;
            }
            if($("#c_solicito").val() == ""){
            generate('warning', "Debe elegir quien solicita el evento");
                return false;
            }
            if($("#txt_facturacion").val() == ""){
            generate('warning', "Debe ingresar el monto de facturación");
                return false;
            }
            if($("#txt_facturacion").val() == "$0.00"){
            generate('warning', "Debe ingresar el monto de facturación");
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
            var solo_numeros=$('#txt_facturacion').asNumber({ parseType: 'Float' });
            $('#txt_facturacion').val(solo_numeros);
            var datos = $('#form_nuevo_evento').serializeArray();
            var anio="2020";
            /*
              if($('#check_anio_evento').prop('checked')){
                anio="2020";
              }
              */
            datos.push({name: 'anio', value: anio});
            datos.push({name: 'usuario_registra', value: $('#label_user').html()});
            datos.push({name: 'productores', value: productores});
            datos.push({name: 'diseñadores', value: dis});
            datos.push({name: 'digital', value: dig});
            datos.push({name: 'ejecutivo', value: sol});
            datos.push({name: 'solicita', value: ejecutivos});
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

        //menu de whats
       /* $(".item_menu").click(function(){
          if(bandera_click){
            ver_notificaciones();
          }
            else{
              if(bandera_activo=="no"){
              ver_notificaciones2();
              }
          }
          
        });

        function ver_notificaciones(){ // si se abre por primera vez
          //ajax para revisar mensajes para mi sin leer
          if(true){ 
            $('#notificaciones').fadeIn();
            $("#notificaciones").addClass('animated slideInRight');
            bandera_click=false;
            bandera_activo="si";
          }
        }
        function ver_notificaciones2(){ //si previamente ya se abrio
          //ajax para revisar mensajes para mi sin leer
          if(true){ 
            $('#notificaciones').hide();
            $("#notificaciones").removeClass('slideOutRight'); 
              setTimeout(function(){
                $('#notificaciones').fadeIn();
                $("#notificaciones").addClass('slideInRight');
              },1);  
          }
        }
        */

        $('#menu_crear_evento').click(function(e){
           e.preventDefault();
           
           /*
           $("#div_cortina").animate({top: '0px'}, 1100); 
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_modificar_evento').fadeOut();
           $('#div_nuevo_evento').fadeIn();   
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
*/
            limpiar_cortinas();
            $("#div_cortina").animate({top: '0px'}, 1100);
            $('#div_nuevo_evento').fadeIn();
            
            
        });

        $('#menu_modificar_evento').click(function(e){
           e.preventDefault();
            limpiar_cortinas();
            $("#div_cortina").animate({top: '0px'}, 1100);
            $('#div_modificar_evento').fadeIn();
            
           /*
           ver_eventos($('#c_eventos_modificar'));
           $("#div_cortina").animate({top: '0px'}, 1100); 
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_nuevo_evento').fadeOut();           
           $('#div_modificar_evento').fadeIn();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */
        });

        $('#menu_cerrar_evento').click(function(e){
           e.preventDefault();
           /*
           $("#div_cortina").animate({top: '0px'}, 1100); 
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_nuevo_evento').fadeOut();           
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeIn();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */
        });        

        $('#menu_solicitud_odc').click(function(e){ 
          e.preventDefault();  
          /*
           $("#div_sodexo").hide();
           $("#div_cortina").animate({top: '0px'}, 1100);           
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeIn();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();            
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
*/
            limpiar_cortinas();
            $("#div_cortina").animate({top: '0px'}, 1100);
            $('#div_odc').fadeIn();

            $('#titulin').html("Solicitud de pago");
            $("#div_tipo_reembolso").hide();
            $('#div_mensaje').fadeOut();
            $('#label_fernanda').hide();
            $('#label_a_nombre').html("A nombre de");
            $('#label_fernanda').html("A nombre de: FERNANDA CARRERA");
            //$("#combo_metodo_pago option[value='PPD']").removeAttr('disabled');
            $("#check_sodexo:checked").prop('checked', false);
            
            ver_proveedores();
            var valores='<option value="03 TRANSFERENCIA ELECTRONICA DE FONDOS">03 TRANSFERENCIA ELECTRONICA DE FONDOS</option>';
             $('#c_forma_de_pago').html(valores);
        });

        $('#menu_solicitud_viaticos').click(function(e){
          e.preventDefault();
          /*
           $("#div_sodexo").show();
           $("#div_cortina").animate({top: '0px'}, 1100); 
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeIn();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */
           limpiar_cortinas();
            $("#div_cortina").animate({top: '0px'}, 1100);
            $('#div_odc').fadeIn();

           $('#titulin').html("Solicitud de viáticos");
           //$("#combo_metodo_pago option[value='PPD']").attr('disabled','disabled');
           $('#label_a_nombre').html("Se depositará a");
           $('#label_fernanda').show();
           $("#check_sodexo:checked").prop('checked', false);
           $("#div_tipo_reembolso").show();
           $('#label_fernanda').html("A nombre de: FERNANDA CARRERA");
           $('#div_mensaje').fadeIn();
           ver_proveedores_usuarios("MA. FERNANDA CARRERA HDZ");
           $("#c_tipo_reembolso").val("MA. FERNANDA CARRERA HDZ");
           $('#txt_nota').val('El cheque saldrá a nombre de Ma. Fernanda Carrera');
           var valores='<option value="02 CHEQUE NOMINATIVO"> 02 CHEQUE NOMINATIVO</option>';
             $('#c_forma_de_pago').html(valores);
        });

        $('#menu_solicitud_reembolso').click(function(e){
          e.preventDefault();
          /*
           $("#div_sodexo").show();
          $("#div_cortina").animate({top: '0px'}, 1100); 
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeIn();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */
           limpiar_cortinas();
            $("#div_cortina").animate({top: '0px'}, 1100);
            $('#div_odc').fadeIn();

           $('#titulin').html("Solicitud de reembolso");
           $('#label_a_nombre').html("Se depositará a");
           $('#label_fernanda').show();
           //$("#combo_metodo_pago option[value='PPD']").removeAttr('disabled');
           $("#check_sodexo:checked").prop('checked', false);
           $("#div_tipo_reembolso").show();
           $('#label_fernanda').html("A nombre de: FERNANDA CARRERA");
            $("#c_tipo_reembolso").val("MA. FERNANDA CARRERA HDZ");
            $('#txt_nota').val('El cheque saldrá a nombre de Ma. Fernanda Carrera');
            
            ver_proveedores_usuarios("MA. FERNANDA CARRERA HDZ");
           $('#div_mensaje').fadeIn();
           var valores='<option value="02 CHEQUE NOMINATIVO"> 02 CHEQUE NOMINATIVO</option>';
           $('#c_forma_de_pago').html(valores);
           
        });
        /*
        menu_solicitud_odc' href
        menu_solicitud_viaticos'
        menu_solicitud_reembolso
        menu_solicutid_cliente' 
        menu_solicitud_prov' hre
        */
        
        function ver_bancos(){
            $.ajax({
              url:   "ver_bancos.php",
              type:  'post',
              success:  function (response) {
                $('#c_bancos').html(response);
                BANCOS=response;
              }
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

         $('#menu_solicitud_prov').click(function(e){
           e.preventDefault();
           var usuario=$('#input_oculto').val();
           if(usuario=="ALAN SANDOVAL" || usuario=="SANDRA PEÑA" || usuario=="HAYDEE JAEN"){
              $('#check_pendientes').show();
           }
           else{
              //$('#check_pendientes').hide();
           }
           
           
           
           //$('#fieldset_documentos').hide();
           //$('#enviar_solicitud_cliente').hide();
           /*
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeIn();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */

           limpiar_cortinas();
            $("#div_cortina").animate({top: '0px'}, 1100);
            $('#div_alta_cliente').fadeIn();

          limpiar_cliente();
           $('#seccion_datos').fadeIn();
           $('#l_cli').html("Proveedores registrados");
           $('#l_razon').html("Razón social del proveedor");
           $('#guardar_cliente').html("<i class='i_espacio fa fa-save' aria-hidden='true'></i>Guardar proveedor");
           $('#txt_cuenta_bancaria').val("");
           $('#txt_clabe').val("");
           $('#titulo_alta').html("Solicitud de alta de proveedor");
           $("#check_solicitud_pendientes:checked").prop('checked', false);
           $('#form_alta_proveedores').show();
           $('#div_area_descripcion').show();
           ver_bancos();
           ver_solicitudes_clientes("false", "proveedores");
           $('#div_tipo_persona').show();
           /*
           if($('#input_oculto').val()=="ALAN SANDOVAL" || 
            $('#input_oculto').val()=="HAYDEE JAEN" ||
            $('#input_oculto').val()=="SANDRA PEÑA"){
              $('#guardar_cliente').show();
           }
           else{
              $('#guardar_cliente').hide();
           }
           */
           $('#files2').show();
           $('#files3').show();
           $('#files4').show();
           $('#files5').show();           
        });

          $('#menu_solicitud_cliente').click(function(e){
          e.preventDefault();
          limpiar_cliente();
          
           /*
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeIn();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */

           limpiar_cortinas();
           $("#div_cortina").animate({top: '0px'}, 1100);
           $('#div_alta_cliente').fadeIn();
           ver_bancos();
           $('#div_tipo_persona').show();
           $('#form_alta_proveedores').hide();
           $('#div_area_descripcion').hide();
           $('#l_cli').html("Clientes registrados");
           $('#l_razon').html("Razón social del cliente");
           $('#guardar_cliente').html("<i class='i_espacio fa fa-save' aria-hidden='true'></i>Guardar cliente");
           $('#txt_cuenta_bancaria').val("0");
           $('#txt_clabe').val("0");
           $('#titulo_alta').html("Solicitud de alta de cliente");
           $("#check_solicitud_pendientes:checked").prop('checked', false);
           ver_solicitudes_clientes("false", "clientes");
           /*
           if($('#input_oculto').val()=="ALAN SANDOVAL" || 
            $('#input_oculto').val()=="SANDRA PEÑA"){
              $('#guardar_cliente').show();
           }
           else{
              $('#guardar_cliente').hide();
           }*/
           $('#files2').hide();
           $('#files3').hide();
           $('#files4').hide();
           $('#files5').hide();
           $('#c_paises').val("RFC");
        });

          $('#menu_ver_formatos').click(function(e){
           e.preventDefault();
           /*
           $("#div_cortina").animate({top: '0px'}, 1100); 
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeIn();
           $('#div_solicitudes').fadeOut();
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */
           limpiar_cortinas();
           $("#div_cortina").animate({top: '0px'}, 1100);
           $('#div_formatos').fadeIn();
           //ver_mis_eventos();
        });

          //catlogos
          $('#usuarios').click(function(e){
           e.preventDefault();
           $("#form_usuarios").trigger('reset');
           limpiar_cortinas();
           $("#div_cortina").animate({top: '0px'}, 1100);
           $('#div_usuarios').fadeIn();
           /*
           $('#borrar_usuario').fadeOut();
           $("#div_cortina").animate({top: '0px'}, 1100); 
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeIn();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */

           ver_usuarios_registrados();
           llenar_combo_tarjetas();
        });

          $('#clientes').click(function(e){
           e.preventDefault();
           /*
           $("#div_cortina").animate({top: '0px'}, 1100); 
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeIn();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */
           limpiar_cortinas();
           $("#div_cortina").animate({top: '0px'}, 1100);
           $('#div_alta_cliente').fadeIn();
        });

          $('#proveedores').click(function(e){
           e.preventDefault();
           /*
           $("#div_cortina").animate({top: '0px'}, 1100); 
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeIn();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */
           limpiar_cortinas();
           $("#div_cortina").animate({top: '0px'}, 1100);
           $('#div_alta_proveedores').fadeIn();
        });

           $('#solicitudes').click(function(e){
           e.preventDefault();
           /*
           $("#div_cortina").animate({top: '0px'}, 1100); 
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeIn();
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */
           limpiar_cortinas();
           $("#div_cortina").animate({top: '0px'}, 1100);
           $('#div_solicitudes').fadeIn();
        });


        $('#check_solicitud_pendientes').click(function(e){
          
         check_pendientes_click();   
          
        });

        function check_pendientes_click(){
          limpiar_cliente();
           var tipo="";
          if($('#titulo_alta').html().includes("cliente")){
            tipo="clientes";
          }
          else{
            tipo="proveedores"
          }
          if($('#check_solicitud_pendientes').is(':checked')){
            ver_solicitudes_clientes("true", tipo);  

          }
          else{
            ver_solicitudes_clientes("false", tipo);    
          }       
        }

      

        $("#enviar_solicitud_cliente").click(function(e){
          //envio_mail_solicitud(); // envio de correo de solicitud cliente/proveedor
          validar_form_clientes_proveedores()
          
        });

       
        function envio_mail_solicitud(){
          var proveedor=$('#txt_nombre_cliente').val();
          var nombre_rfc=$('#txt_rfc').val();
          var nombre_contacto=$('#txt_nombre_contacto').val();
          var email_contacto=$('#txt_correo_contacto').val();
          var usuario=$('#input_oculto').val();
          //var tipo=$('#combo_tipo_persona').val();
          var tipo=$('#titulo_alta').html();
          if(tipo.includes("cliente")){
            tipo="cliente";
          }
          else{
            tipo="proveedor";
          }
           var datos={
              "proveedor": proveedor,
              "usuario": usuario,
              "asunto": "Solicitud de "+tipo,
              "texto":"vacio",
              "evento": "evento",
            };
            
           $.ajax({
                  url:   "mail/envio_mail.php",
                  type:  'post',
                  data: datos,
                  success:  function (response) {
                    if(response.includes("Enviado")){
                      generate("success", "El "+tipo+" ha sido solicitado");
                    }
                    else{
                      generate("error", response);
                    }
                  }
                });
            }

        /*function enviar_mail_adjuntos(nombre_cliente, nombre_rfc, nombre_contacto, email_contacto, usuario_solicita, tipo){
          var data = new FormData();
          var rfc = document.getElementById('rfc');
          var file1 = rfc.files[0];
          data.append('archivo1',file1);
          if(tipo=="proveedores"){
             var ine = document.getElementById('ine');
            var file2 = ine.files[0];
            var acta = document.getElementById('acta');
            var file3 = acta.files[0];
            var estado = document.getElementById('estado');
            var file4 = estado.files[0];
            var domicilio = document.getElementById('domicilio');
            var file5 = domicilio.files[0];
            data.append('archivo2',file2);
            data.append('archivo3',file3);
            data.append('archivo4',file4);
            data.append('archivo5',file5);
          }
          data.append('nombre_cliente',nombre_cliente);
          data.append('nombre_rfc',nombre_rfc);
          data.append('nombre_contacto',nombre_contacto);
          data.append('email_contacto',email_contacto);
          data.append('usuario_solicita',usuario_solicita);
          data.append('tipo',tipo);
          
          $.ajax({
              url: 'enviar_mail_adjuntos.php',
              //url: 'upload.php',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
                 beforeSend: function(){
                $('#enviar_solicitud_cliente').html("<img src='img/fancybox_loading.gif'>Enviando...");
               },
              success:  function (response) {
                 console.log(response);
                if(response.includes("Enviado")){
                  $('#enviar_solicitud_cliente').html("<i class='i_espacio fa fa-envelope-o' aria-hidden='true'></i>Enviar Solicitud");
                  limpiar_cliente();
                  generate('success',"Se ha enviado la petición al administrador");
                }
                else{
                  console.log(response);
                  generate('warning',"Ocurrio un error al enviar la notificación por correo");
                }
              },
              error: function (xhr, ajaxOptions, thrownError) {
                generate("error","Ocurrio un error tipo XHR");
                console.log(xhr.responseText);
                console.log(thrownError);
              }
            });
        }*/


        $('#limpiar_cliente').click(function(){
          limpiar_cliente();
        });

        function limpiar_cliente(){
          $('#c_clientes_alta').val('vacio');
          $('#txt_nombre_cliente').val('');
          $('#txt_nombre_comercial').val('');
          $('#c_metodo_pago :nth-child(1)').prop('selected', true);
          $('#txt_rfc').val('');
          $('#digitos').val('');
          $("#combo_tipo_persona").val('vacio');
          $('#area_descripcion').val('');
          $('#txt_calle').val('');
          $('#txt_num_ext').val('');
          $('#txt_num_int').val('');
          $('#txt_colonia').val('');
          $('#txt_cp').val('');
          $('#txt_telefono').val('');
          
          $('#txt_estado').val("");
          $('#txt_municipio').val("");
          $('#c_colonia').val("");
          
          $('#txt_nombre_contacto').val('');
          $('#txt_correo_contacto').val('');
          $("#rfc").filestyle('clear');
          $("#ine").filestyle('clear');
          $("#acta").filestyle('clear');
          $("#estado").filestyle('clear');
          $("#domicilio").filestyle('clear');
          $('#txt_cuenta_bancaria').val('');
          $('#txt_clabe').val('');
          $('#c_bancos').val('vacio');
          $('#txt_sucursal').val('');
          $('#c_CFDI_CLIENTE option[value="vacio"]').prop('selected', true);
          //$('#fieldset_documentos').hide();
           //$('#enviar_solicitud_cliente').hide();
           $('#seccion_datos').fadeIn();
           //$('#btn_validar_clientes').fadeIn();
           $('#btn_bloquear').hide();
           desactivar_btn_file($('#span_file_csf'), $('#file_csf'));
          desactivar_btn_file($('#span_file_ine'), $('#file_ine'));
          desactivar_btn_file($('#span_file_edo'), $('#file_edo'));
          desactivar_btn_file($('#span_file_comp'), $('#file_comp'));
          desactivar_btn_file($('#span_file_acta'), $('#file_acta'));
          csf=false;
          ine=false;
          edo=false;
          comp=false;
          acta=false;
          ver_archivos('ca');
        }
       

      

        function ver_solicitudes_por_evento(evento){
          var datos={
            "evento": evento,
            "usuario": $('#label_user').html(),
          }
          $.ajax({
              url:   "ver_solicitudes_por_evento.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                var arr=response.split("$$$");
                $('#resultado_solicitudes').html(arr[0]);
                $('#espacio').show();
                var ctx = document.getElementById('myChart').getContext('2d');
                var chart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    datasets: [{
                      data: [
                        arr[2],
                        arr[1],
                      ],
                      backgroundColor: [
                        window.chartColors.red,
                        'rgba(2, 149, 39, 0.8)',
                      ],
                      label: 'Dataset 1'
                    }],
                    /*
                    labels: [
                      
                      'Egresos',
                      'Utilidad',
                    ]
                    */
                  },
                  options: {
                    responsive: false,
                    legend: {
                      position: 'top',
                    },
                    title: {
                      display: false,
                      text: 'Porcentaje de utilidad'
                    },
                    animation: {
                      animateScale: true,
                      animateRotate: true
                    },
                    tooltips: {
                      callbacks: {
                        label: function(tooltipItem, data) {
                          var dataset = data.datasets[tooltipItem.datasetIndex];
                          var meta = dataset._meta[Object.keys(dataset._meta)[0]];
                          var total = meta.total;
                          var currentValue = dataset.data[tooltipItem.index];
                          var percentage = parseFloat((currentValue/total*100).toFixed(1));
                          return currentValue + ' (' + percentage + '%)';
                          //return ' '+percentage + '%';
                        },
                      }
                    }
                  }
                });
              }
            });
        }

           $("#resultado_solicitudes").delegate(".check_pagado", "click", function() {
            //if($('#input_oculto').val()=="CXP"){
              if($('#tipo_perfil').html().includes("Cuentas por pagar")){
              var x=null;
              var id=$(this).val();
              var evento=$('#c_mis_eventos').val();
                  if($(this).is(':checked')){
                    x="si";
                  }
                  else{
                   x="no";
                  }
                  guardar_pagos(id, x, evento);
              }
            });

            function valida_comprobado(id){
              var bandera=false;
              var datos={
                "id":id
              }
              $.ajax({
                url:   'validacion_comprobado.php',
                type:  'post', 
                data:   datos,
                async: false,
                success:  function (response) {
                  console.log(response);
                  if(response.includes("comprobado")){
                    bandera=false;
                  }
                  else{
                    bandera=true;
                  }
                  
                }
              });
              return bandera;
            }

            $("#resultado_solicitudes").delegate(".c_estatus_factura", "change", function() {
              var arr=$(this).attr('id').split("_");
              var estatus=$(this).val();
              var id=arr[1];
              var datos={
                "id":id,
                "estatus":estatus
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
                            })                        
                    }
                    else{
                      generate("error", "Ocurrio un error<br>"+response);
                    }
                }
              });
            });

           $("#resultado_solicitudes").delegate(".btn_factura", "click", function() {
            var id=$(this).attr('id');
             
           if(valida_comprobado(id)){
            
            //alert(id);
            var evento=$('#c_mis_eventos').val();
            //var id=this.id;
            swal({
              title: "Ingresa el # de la factura",
              text: "Si son varias, separalas con una coma (,)",
              input: "text",
              showCancelButton: true,
              animation: "slide-from-top",
              inputPlaceholder: "No. Factura",
              showCancelButton: true,
              confirmButtonText: 'Enviar',
              showLoaderOnConfirm: true,
              cancelButtonText: "Cancelar",
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#5E9008",
              cancelButtonColor: "#C20F0F",
              preConfirm: function (numero, res) {
                return new Promise(function (resolve, reject) {
                  setTimeout(function() {
                    var datos={
                        "numero": numero,
                        "id": id,
                    };
                    $.ajax({
                            url:   'registrar_factura.php',
                            type:  'post', 
                            data:   datos,
                            async: false,
                            success:  function (response) {
                              //console.log(response);
                                if (numero === response) {
                                  reject('La factura '+numero+' ya fue registrada');
                                } else {
                                    resolve();
                                     if(response.includes("factura registrada")){
                                      ver_solicitudes_por_evento(evento);
                                        setTimeout(function() {
                                          ver_solicitudes_por_evento(evento);
                                             swal({
                                                type: 'success',
                                                title: 'Listo',
                                                html: 'Factura modificada: ' + numero
                                              })
                                            }, 200)
                                        }
                                        else if(response.includes("ya existe")){
                                      ver_solicitudes_por_evento(evento);
                                        setTimeout(function() {
                                          ver_solicitudes_por_evento(evento);
                                             swal({
                                                type: 'warning',
                                                title: 'Advertencia',
                                                html: 'Esta factura ya existe para ese proveedor'
                                              })
                                            }, 200)
                                        }
                                        else{
                                            setTimeout(function() {
                                            swal({
                                            type: 'warning',
                                            title: 'Error',
                                            html: 'Ocurrio un error:'+response
                                          })
                                             }, 200)
                                        }
                                }
                                
                              }
                          });
                          

                        }, 2000)
                      })
                    },
                    allowOutsideClick: false
                  }).then(function (numero) {
                      //ver_solicitudes_pendientes();
                  })
                }
                else{
                  generate("warning", "Lo sentimos, esta solicitud ya fue comprobada");
                }
              });

           function guardar_pagos(id, bandera, evento){
            var datos={
              "id": id,
              "bandera":bandera
            }
            $.ajax({
                url:   "guardar_pagos.php",
                type:  'post',
                data: datos,
                success:  function (response) {
                  if(response.includes("orden modificada")){
                    generate('success',"La solicitud ha sido actualizada!!");
                  }
                  else{
                    
                    generate('error',"Ocurrio un error. Vea la consola para mas detalles");
                  }
                  ver_solicitudes_por_evento(evento)
                }
              });
           }

            $("#resultado_solicitudes").delegate(".check_comp", "click", function() {
              //if($('#input_oculto').val()=="CXP"){
                if($('#tipo_perfil').html().includes("Cuentas por pagar")){
                var x=null;
                var id=$(this).val();
                var evento=$('#c_mis_eventos').val();
                    if($(this).is(':checked')){
                      x="si";
                    }
                    else{
                     x="no";
                    }
                    guardar_comprobaciones(id, x, evento);
              }
            });

            function guardar_comprobaciones(id, bandera, evento){
            var datos={
              "id": id,
              "bandera":bandera
            }
            $.ajax({
                url:   "guardar_comprobaciones.php",
                type:  'post',
                data: datos,
                success:  function (response) {
                  if(response.includes("orden modificada")){
                    generate('success',"La solicitud ha sido actualizada!!");
                  }
                  else{
                    
                    generate('error',"Ocurrio un error. "+response);
                  }
                  ver_solicitudes_por_evento(evento)
                }
              });
           }

        function ver_mis_solicitudes(evento, usuario){
          var evento=$('#c_mis_eventos').val();
          var usuario=$('#label_user').html();
          var datos={
            "evento": evento,
            "usuario": usuario,
          }
          $.ajax({
              url:   "ver_mis_solicitudes.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                
                var option='<option value="vacio">Selecciona una solicitud...</option>';
                $('#c_mis_solicitudes').html(option+response);
              }
            });
        }

        

        ////////////////////FIN/7/////////////
      


        /*
       $('#c_mis_solicitudes').change(function(){
        if($('#c_mis_solicitudes').val()=="vacio"){
          $('#btn_descargar').fadeOut();
        }
        else{
          $('#btn_descargar').fadeIn();
        }
        });
*/
/*
        $('#c_mis_eventos').change(function(){
          var evento=$('#c_mis_eventos').val();
          var usuario=$('#label_user').html();
          if(evento=="vacio"){
          }
          else{
            //ver_mis_solicitudes();
            ver_solicitudes_por_evento(evento);
            //$('#div_mis_solicitudes').fadeIn();
          }
        });
        */


        $('#c_clientes_alta').change(function(){
          var arr=$(this).val().split("&");
          var id=arr[0];
          if(arr.length==2){
            carpeta=arr[1];
          }
          else if(arr.length==3){
            carpeta=arr[1]+"&"+arr[2];
          }
          else if(arr.length==4){
            carpeta=arr[1]+"&"+arr[2]+"&"+arr[3];
          }
          
          if(id=="vacio"){

          }
          else{
            if($('#titulo_alta').html().includes("cliente")){
              ver_datos_clientes(id, "ver_datos_clientes.php");
            }
            else{
              ver_datos_clientes(id, "ver_datos_proveedores.php");
            }

            if ($('#check_solicitud_pendientes').is(':checked')) {
              $('#btn_bloquear').show();
              ver_archivos(carpeta);
              $('#btn_bloquear').removeAttr("disabled");
              $('#btn_bloquear').removeClass("disabled");
            }
            else{
              ver_archivos(carpeta);
              $('#btn_bloquear').attr("disabled", true);
              $('#btn_bloquear').addClass("disabled");
              
            }
            
          }
        });

        function ver_datos_clientes(id, url){
          var datos={
            "id": id,
          }
          $.ajax({
              url:   url,
              type:  'post',
              data: datos,
              dataType: "json",
              success:  function (response) {
                 //var data = JSON.parse(response);
                 console.log(url);
                console.log(response);
                $('#txt_nombre_cliente').val(response.nombre);
                $('#txt_nombre_comercial').val(response.nombre_comercial);
                $('#c_metodo_pago').val(response.metodo_pago);
                $('#txt_rfc').val(response.rfc);
                $('#digitos').val(response.digitos);
                $('#txt_calle').val(response.calle);
                $('#txt_num_ext').val(response.num_ext);
                $('#txt_num_int').val(response.num_int);
                $('#txt_cp').val(response.cp);
                $('#c_colonia').val(response.colonia);
                //evento_cp(response.cp);
                /*
                var colo=$.trim(response.colonia);
                if($('#identificador_rfc').html()=='RFC'){
                  $('#c_colonia').editableSelect('destroy');
                  ver_datos_cps(response.cp, colo);
                }
                else{
                  $('#c_colonia').editableSelect();

                }
                */
                //$('#c_colonia').val(response.colonia);
                $('#txt_telefono').val(response.telefono);
                $('#txt_municipio').val(response.municipio);
                $('#area_descripcion').val(response.descripcion);
                $('#txt_sucursal').val(response.sucursal);
                $('#combo_tipo_persona').val(response.tipo_persona);
                change_tipo_persona(response.tipo_persona);
                $('#txt_estado').val(response.estado);
                $('#txt_nombre_contacto').val(response.nombre_contacto);
                $('#txt_correo_contacto').val(response.email_contacto);
                $('#c_CFDI_CLIENTE').val(response.cfdi);
                $('#txt_cuenta_bancaria').val(response.cuenta);
                $('#txt_clabe').val(response.clabe);
                $('#c_bancos').val(response.banco);
                if(response.cuenta!=""){
                  var tam=response.cuenta.length;
                  var CUENTA = response.cuenta.substring(tam-4,tam);
                  $('#digitos').val(CUENTA);
                }

                if($('#input_oculto').val()=="ALAN SANDOVAL" || $('#input_oculto').val()=="SANDRA PEÑA" ||
                   $('#input_oculto').val()=="HAYDEE JAEN"){
                $('#btn_bloquear').show();
                }
                 
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); 
                    alert("Error: " + errorThrown);
                    
                }  
            });
        }


             $("#a_btn_pendientes").fancybox({
                fitToView   : true,
                frameWidth  : '85%',
                frameHeight : 150,
                autoSize    : false,
                title: "<h2>Solicitudes pendientes por comprobar</h2>",          
                scrolling:"no",
                closeClick  : false,
                 helpers:  {
                    title : {
                        type : 'outside',
                        position : 'top'
                    },
                    overlay : {
                        showEarly : true
                    }
                }

              }); 



       
        $('#c_eventos_creados2').on("change", function(){
          var id= $('#c_eventos_creados').val();
          if(id=="vacio"){
            $('#form_nuevo_evento')[0].reset();  
            $('#c_ejecutivos').multiselect("deselectAll", false).multiselect("refresh");
            $('#c_produccion').multiselect("deselectAll", false).multiselect("refresh");
            $('#c_disenio').multiselect("deselectAll", false).multiselect("refresh");
            $('#c_digital').multiselect("deselectAll", false).multiselect("refresh");
            $('#c_solicitantes').multiselect("deselectAll", false).multiselect("refresh");
            ver_numero_evento();   
            $('#btn_crear_evento').show();     
            //$('#btn_modificar_evento').hide();  
          }
          else{
            ver_detalle_eventos(id);
         }
        });

        $('#enviar_odc').click(function(){

          enviar_solicitud_SDP();
            
        });

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
                  //console.log(response.error);
                  //$('#btn_modificar_evento').show();
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
                  $("#c_ejecutivos").val(ejecutivo);
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
                  
                  
                  $('#txt_facturacion').val(response.Facturacion);
                  $('.moneda').formatCurrency();
                  var tipo=response.Tipo;
                  if(tipo=="Total"){
                    $('#check_estatus_facturacion').bootstrapToggle('on')
                  }
                  else{
                    $('#check_estatus_facturacion').bootstrapToggle('off')
                  }
                  if(response.Comentarios=="NINGUNO"){
                    $('#area_comentarios').val("");
                  }
                  else{
                    $('#area_comentarios').val(response.Comentarios);
                  }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    console.log(response.error);
                }   
              });
        }

        function enviar_solicitud_SDP(SOLICITO, FINANZAS){
              var id_usuario_proveedor=$('#id_usuario_proveedor').val();

              var titulo=$('#titulin').html();
              var evento=$('#c_numero_evento').val();
              
              var f_sol=$('#f_solicitud').val();
              var f_pago=$('#f_pago').val();
              var odc_cheque_por=$('#odc_cheque_por').val();
              var letra=$('#odc_label_letra').html();

              var tipo_reembolso="";
              var a_nombre=$('#c_a_nombre').val();
              var num_tarjeta="0";
              if(!titulo.includes("pago")){
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
                           
              
              /*
              if($('#check_sodexo').is(':checked')){
                tarjeta="TARJETA SODEXO";
              }
              else{
                tarjeta="MA. FERNANDA CARRERA HDZ";
              }
              */
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
              var coordinador=$('#txt_coordinador').val();
              var project=$('#txt_project').val();

              var user=$("#input_oculto").val();
              var arr_sol=f_sol.split("/");
              f_sol=arr_sol[2]+"-"+arr_sol[1]+"-"+arr_sol[0];
              var arr_pago=f_pago.split("/");
              f_pago=arr_pago[2]+"-"+arr_pago[1]+"-"+arr_pago[0];
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
              else if($('#c_a_nombre').val()=="vacio"){
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
              else if(compras==""){
                generate('warning',"Debe ingresar un Vo.Bo de Compras");
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
                //odc_cheque_por=$('#odc_cheque_por').val();
                //validacion de utilidad 20% 
                //Se toma en cuenta el importe de esta solicitud mas las existentes
                //var cheque_por=$('#odc_cheque_por').asNumber({ parseType: 'Float' });
                
                
                
                //ver_personas();
                var VAL=ver_suma_sdp(evento);
                var maximo=$('#label_maximo_odc').asNumber({ parseType: 'Float' });
                if(odc_cheque_por<maximo){
                  ver_personas();
                  noty({
                  text        : $('#d-none').html(),
                  width       : '400px',
                  type        : 'warning',
                  dismissQueue: false,
                  closeWith   : ['button'],
                  theme       : 'metroui',
                  timeout     : false,
                  layout      : 'topCenter',
                   buttons: [
                    {addClass: 'btn btn-success', text: 'Aceptar', onClick: function($noty) {
                       if($noty.$bar.find('select#c_user_solicita').val() == 'vacio'){
                          generate('warning', 'Debe seleccionar a un solicitante válido');
                        }
                         else if($noty.$bar.find('select#c_finanzas').val() == 'vacio'){
                          generate('warning', 'Debe seleccionar a un usuario de finanzas válido');
                        }
                        else if($noty.$bar.find('select#c_autorizo').val() == 'vacio'){
                          generate('warning', 'Debe seleccionar a un usuario de autorización');
                        }
                        else{
                                    if(titulo.includes("pago")){
                                      titulo="Pago";
                                    }
                                    else if(titulo.includes("icos")){
                                      titulo="Viáticos";
                                    }
                                    else if(titulo.includes("bolso")){
                                      titulo="Reembolso";
                                    }
                                    var evento=$('#c_numero_evento').val();
                                    var nombre_evento=$('#c_numero_evento option:selected').text();
                                    var tipo="";
                                    var SOLICITO=$noty.$bar.find('select#c_user_solicita').val();
                                    var FINANZAS=$noty.$bar.find('select#c_finanzas').val();
                                    var DIRECTIVO=$noty.$bar.find('select#c_autorizo').val();
                                    if( $('#check_tipo_sol').is(':checked')){
                                      tipo="Normal";
                                    }
                                    else{
                                      tipo="Urgente";
                                    }
                                    
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
                                        "SOLICITO":SOLICITO,
                                        "FINANZAS":FINANZAS,
                                        "DIRECTIVO":DIRECTIVO,
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
                                            generate('success',"La solicitud se ha guardado correctamente");
                                            //enviar_notificacion_solicitud(nombre_evento, titulo);
                                            window.open("solicitud_pago.php?id=0",'_blank');
                                            limpiar_odc();
                                          }
                                          else{
                                            
                                            generate('error',"Ocurrio un error al guardar la solicitud: "+response);
                                          }
                                        }
                                      });
                                      $noty.close();
                                  }
                      }
                    },
                    {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function($noty) {
                       $noty.close();
                      }
                    }
                   ]
                  });
                }
                
                else{
                  $('#odc_cheque_por').val('');
                  generate('warning','Lo sentimos<br>El mónto máximo permitido es '+$('#label_maximo_odc').html());
                }
              }
        }

        function enviar_notificacion_llegando_limite(evento){
          var usuario=$('#input_oculto').val();
          var datos={
            "evento": evento,
            "asunto": "Notificacion de limite",
            "usuario": usuario,
            "texto": "texto",
            "proveedor": "prov",
          };
          console.log(datos);
          
          $.ajax({
                  url:   "mail/envio_mail.php",
                  type:  'post',
                  data: datos,
                  success:  function (response) {
                    if(response.includes("Enviado")){
                      console.log("Se ha enviado la notificación del limite");
                    }
                    else{
                      generate("error", response);
                    }
                  }
                });

        }

        function ver_personas(){
          $.ajax({
              url:   "ver_personas.php",
              type:  'post',
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
        }

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
                var monto=Number(response.replace(/[^0-9.-]+/g,""));
                console.log(monto);
                if(monto<=0){
                  $('#label_maximo_odc').html("$0.00");
                  $('#label_maximo_odc').removeClass('label-success');
                  $('#label_maximo_odc').addClass('label-danger');
                  
                }
                else{
                  $('#label_maximo_odc').html(response);
                  $('#label_maximo_odc').removeClass('label-danger');
                  $('#label_maximo_odc').addClass('label-success');
                }
              }
            });
           //return suma;
        }

       

        function enviar_notificacion_solicitud(nombre_eventos, tipo_solicitud){
          
          var nombre_evento=$('#c_numero_evento').val();
          //alert(nombre_evento);
          var usuario=$('#input_oculto').val();
          var datos={
            "usuario": usuario,
            "nombre_evento": nombre_evento,
            "tipo_solicitud": tipo_solicitud,
          }
          $.ajax({
              url:   "enviar_notificacion_solicitud.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                if(response.includes("Enviado")){
                  generate('success',"La notificación ha sido enviada");
                }
                else{
                  generate('warning', "Ocurrio un error al enviar la notificación. Consulte la consola para mas detalles."); 
                }
              }
            });
        }
        

        $('#limpiar_odc').click(function(){
          limpiar_odc();
        });



        function limpiar_odc(){
            //$('#f_solicitud').val("");
            $('#c_numero_evento').val("");
            $('#label_maximo_odc').html("");
            $('#f_pago').val("");
            $('#odc_cheque_por').val("");
            $('#odc_label_letra').html("");
            $('#c_a_nombre').val("vacio");
            $('#txt_concepto').val("");
            $('#txt_servicios').val("");
            $('#txt_otros').val("");
            $('#txt_docto_soporte').val("");
            $('#odc_fecha').val("");
            $(".tipo_pago:checked").prop('checked', false);
            $('#c_CFDI').val("vacio");
            $('#combo_metodo_pago').val("vacio");
            $('#combo_metodo_pago').val("");
            $('#txt_no_cheque').val("");
            $('#txt_coordinador').val("");
            $('#txt_project').val("");
            $('.user_proveedor').hide();
            $('#id_usuario_proveedor').val("0");
        }
        //modificar evento
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
            
            var solo_numeros=$('#txt_facturacion').asNumber({ parseType: 'Float' });
            $('#txt_facturacion').val(solo_numeros);
            var datos = $('#form_nuevo_evento').serializeArray();
            datos.push({name: 'usuario_registra', value: $('#label_user').html()});
            datos.push({name: 'productores', value: productores});
            datos.push({name: 'diseñadores', value: dis});
            datos.push({name: 'digital', value: dig});
            datos.push({name: 'ejecutivo', value: ejecutivos});
            datos.push({name: 'solicita', value: sol});
            
            $.ajax({
              url:   "actualizar_evento.php",
              type:  'post',
              data:  datos,
              success:  function (response) {
                console.log(response);
                if(response.includes("evento modificado")){

                  
                  $('#btn_crear_evento').show();     
                  var evento=$('#c_eventos_creados option:selected').text();
                  ver_opcion(evento);
                  metodo_limpiar_evento();
                  ver_numero_evento();
                  
                  
                }

                else{
                  console.log(response);
                 generate('error', "ocurrio un error, consulte la consola para más detalles."); 
                }
              }
            });
          }
        });

        function ver_opcion(evento){
          noty({
            type        : 'success',
            layout      : 'bottomLeft',
            theme       : 'metroui',
            progressBar : true,
            maxVisible  : 10,
            timeout     : [10000],
            text: 'Los cambios se han realizados.<p> ¿Deseas notificar al creador del evento?',
            buttons: [
              {addClass: 'btn btn-primary', text: 'Si', onClick: function($noty) {
                  // this = button element
                  // $noty = $noty element

                  //console.log($noty.$bar.find('input#example').val());
                  //enviar_mail_modificacion(evento);
                  $noty.close();
                  //noty({text: 'You clicked "Ok" button', type: 'success'});
                }
              },
              {addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {
                  $noty.close();
                  //noty({text: 'You clicked "Cancel" button', type: 'error'});
                }
              }
            ]
          });
        }

        function enviar_mail_modificacion(evento){
          
          //var evento=$('#c_eventos_creados option:selected').text();
          var datos={
            "evento": evento,
          }
          $.ajax({
              url:   "enviar_mail_modificacion.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                if(response.includes("Envio realizado!!")){
                  generate('success',response);
                }
                else{
                  
                  generate('warning', "Ocurrio un error. Consulte la consola para mas detalles."); 
                }
                
              }
            });
        }


        //else if(!expRegEmail.exec(correo_contacto)){

      $('.main_alta_proveedores').css({ 'height': 350 + "px" });

      

     
      $('#btn_add_banco').click(function(e){
        e.preventDefault();
        swal({
             title: "Agregar banco",
          text: "Ingresa el nombre de la institución bancaria",
          input: "text",
          showCancelButton: true,
          animation: "slide-from-bottom",
          inputPlaceholder: "Nombre de la institución bancaria",
              showCancelButton: true,
              confirmButtonText: 'Enviar',
              showLoaderOnConfirm: true,
              cancelButtonText: "Cancelar",
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#5E9008",
              cancelButtonColor: "#C20F0F",
              preConfirm: function (nombre, res) {
                return new Promise(function (resolve, reject) {
                  setTimeout(function() {
                    var datos={
                        "nombre": nombre,
                    };
                    $.ajax({
                            url:   'agregar_banco.php',
                            type:  'post', 
                            data:   datos,
                            async: false,
                            success:  function (response) {
                              
                                if (nombre === response) {
                                  reject('el banco '+nombre+' ya esta registrado');
                                } else {
                                    resolve();
                                     if(response.includes("Banco agregado")){
                                        setTimeout(function() {
                                             swal({
                                                type: 'success',
                                                title: 'Listo',
                                                html: 'El banco ha sido agregado'
                                              })
                                            }, 200)
                                        }
                                        else if(response.includes("ya existe")){
                                        setTimeout(function() {
                                             swal({
                                                type: 'warning',
                                                title: 'Error',
                                                html: 'El banco ya esta registrado'
                                              })
                                            }, 200)
                                        }
                                        else{
                                            setTimeout(function() {
                                            swal({
                                            type: 'warning',
                                            title: 'Error',
                                            html: 'El banco no pudo ser registrado.<br> Revise la consola para mas detalles'
                                          })
                                            
                                             }, 200)
                                        }
                                  
                                }
                                
                            }
                    });
                    

                  }, 1000)
                })
              },
              allowOutsideClick: false
            }).then(function (numero) {
                ver_bancos();
            })
      });

      
      $('#guardar_cliente').click(function(){
        // update todos los datos de cliente
         var titulo=$('#titulo_alta').html();
         var pasa=false;
         var id=$('#c_clientes_alta').val();
          var cliente=$('#txt_nombre_cliente').val();
          var nombre_comercial=$('#txt_nombre_comercial').val();
          var metodo=$('#c_metodo_pago').val();
          var rfc=$('#txt_rfc').val();
          var digitos=$('#digitos').val();
          var descripcion=$('#area_descripcion').val();
          var tipo_persona=$('#combo_tipo_persona').val();
          var calle=$('#txt_calle').val();
          var ext=$('#txt_num_ext').val();
          var int=$('#txt_num_int').val();
          var colonia=$('#c_colonia').val();
          var cp=$('#txt_cp').val();
          var tel=$('#txt_telefono').val();
          var estado=$('#txt_estado').val();
          var municipio=$('#txt_municipio').val();
          var nombre_contacto=$('#txt_nombre_contacto').val();
          var correo_contacto=$('#txt_correo_contacto').val();
          var uso_cfdi=$('#c_CFDI_CLIENTE').val();
          var usuario_solicita=$('#label_user').html();
          var archivo1=$('#rfc').val();
          var cuenta=$('#txt_cuenta_bancaria').val();
          var clabe=$('#txt_clabe').val();
          var banco=$('#c_bancos').val();
          var sucursal=$('#txt_sucursal').val();
          if(titulo.includes("clien")){
            tipo="clientes";
            cuenta = "0";
            clabe  = "00000000000000000";
            banco  = "NA";
            descripcion="NA";
            tipo_persona="NA";
            sucursal="NA";

            }
            else{
              tipo="proveedores";
            }
          if(id=="vacio"){
              generate('warning', "Debe seleccionar a un cliente de la lista");
                pasa=false;
          }
          else if(cliente == ""){
            generate('warning', "Debe ingresar un cliente");
                pasa=false;
          }
          else if(nombre_comercial == ""){
            generate('warning', "Debe ingresar un nombre comercial");
                pasa=false;
          }
          else if(metodo == "vacio"){
            generate('warning', "Debe selecciona un metodo de pago");
                pasa=false;
          }
          else if(rfc == ""){
            generate('warning', "Debe ingresar un RFC");
                pasa=false;
          }
          else if(digitos == ""){
            generate('warning', "Debe ingresar los 4 últimos dígitos de la cuenta");
                pasa=false;
          }
          else if(tipo_persona == "vacio"){
            generate('warning', "Debe sleccionar un tipo de persona");
                pasa=false;
          }
          else if(calle == ""){
            generate('warning', "Debe ingresar el nombre de la calle");
                pasa=false;
          }
          else if(ext == ""){
            generate('warning', "Debe ingresar el número del domicilio");
                pasa=false;
          }
          else if(colonia == "vacio"){
            generate('warning', "Debe seleccionar el nombre de la colonia");
                pasa=false;
          }
          else if(cp == ""){
            generate('warning', "Debe ingrear el código postal");
                pasa=false;
          }
          else if(tel == ""){
            generate('warning', "Debe ingresar un teléfono");
                pasa=false;
          }
          else if(estado == "vacio"){
            generate('warning', "Debe seleccionar un estado");
                pasa=false;
          }
          else if(municipio == ""){
            generate('warning', "Debe ingresar un municipio");
                pasa=false;
          }
          else if(nombre_contacto == ""){
            generate('warning', "Debe ingresar un nombre de contacto");
                pasa=false;
          }
          else if(!expRegEmail.exec(correo_contacto)){
            generate('warning', "Debe ingresar un correo válido de contacto");
                pasa=false;
          }
          else if(uso_cfdi == "vacio"){
            generate('warning', "Debe seleccionar un uso de CFDI");
                pasa=false;
          }
          else if(cuenta == ""){
            generate('warning', "Debe ingresar un No. de cuenta");
                    pasa=false;
          }
          else if(clabe == ""){
            generate('warning', "Debe ingresar un CLABE");
                    pasa=false;
          }
          else if(banco == "vacio"){
            generate('warning', "Debe seleccionar un banco");
                    pasa=false;
          }
          else if(sucursal == ""){
            generate('warning', "Debe ingresar una sucursal");
                    pasa=false;
          }
          /*
          else if(archivo1 == "" ){
            generate('warning', "Debe ingresar un archivo del RFC válido");
                pasa=false;
          }
          */
          else {
            pasa=true;
          }
          if(pasa==true){ // si todos los campos son correctos, se manda a php
               var arr=id.split("&");
             var datos = {
              "id": arr[0],
              "cliente": cliente,
              "nombre_comercial": nombre_comercial,
              "metodo": metodo,
              "rfc": rfc,
              "digitos": digitos,
              "descripcion": descripcion,
              "tipo_persona":tipo_persona,
              "calle": calle,
              "ext": ext,
              "int": int,
              "colonia": colonia,
              "cp": cp,
              "tel": tel,
              "estado": estado,
              "municipio": municipio,
              "nombre_contacto": nombre_contacto,
              "correo_contacto": correo_contacto,
              "usuario_solicita": usuario_solicita,
              "cuenta": cuenta,
              "clabe": clabe,
              "banco": banco,
              "titulo": titulo,
              "sucursal": sucursal,
              "uso_cfdi":uso_cfdi,
              "tipo":tipo
            };
            $.ajax({
              url:   "update_cliente.php",
              type:  'post',
              data:  datos,
               beforeSend: function(){
                $('#guardar_cliente').html("<img src='img/puntos.gif'>");
               },
              success:  function (response) {
                
                if(response.includes("cliente actualizado")){
                  ////$('#div_siguiente').show();
                  if(response.includes("DESCARGAR")){
                    var cliente=$('#txt_nombre_cliente').val();
                  }
                  $('#guardar_cliente').html("<i class='i_espacio fa fa-save' aria-hidden='true'></i>Guardar Cliente");
                  limpiar_cliente();                 
                 check_pendientes_click();
                  if(titulo.includes("clien")){
                    generate('success', "El cliente ha sido agregado<br>"); 
                  }
                  else{
                    generate('success', "El proveedor ha sido agregado<br>"); 
                  }
                  //descargar_zip(cliente);
                  
                }
                else{
                  console.log(response);
                 generate('error', "Error: "+response); 
                 //$('#div_siguiente').show();
                }
              }
            });
          }
      });


 $('#enviar_cambios_evento').click(function(){
  
    if($('#c_eventos_modificar').val()=="" || $('#area_modificaciones').val()==""){
       generate('warning', "Debe seleccionar un evento y escribir alguna modificación");
    }
    else{
      var evento=$('#c_eventos_modificar').val();
      var usuario=$('#input_oculto').val();
      var datos={
          "evento": evento,
          "texto": $('#area_modificaciones').val(),
          "usuario": usuario,
          "asunto": "Solicitud de modificación",
          "proveedor": "vacio",
        };
        
       $.ajax({
              url:   "mail/envio_mail.php",
              type:  'post',
              data: datos,
              beforeSend: function(){
                $('#enviar_cambios_evento').html("<img src='img/fancybox_loading.gif'> Enviando...");
               },
              success:  function (response) {
                console.log(response);
               $('#enviar_cambios_evento').html('<i class="fa fa-envelope" aria-hidden="true"></i> Solicitar cambios');
               
               if(response.includes("Enviado")){
                generate('success', "Se ha enviado la petición al administrador.");  
                $('#area_modificaciones').val("");              
               }
               else if(response.includes("problema usuario")){
                  generate('warning', "El usuario actual no tiene privilegios para solicitar modificaciones a este evento<br>Contacte al Ejecutivo de cuenta"); 
                }
               else{
                console.log(response);
                generate('error', "Ocurrio un error. Ver la consola para más detalles");
                
               }
              }
            });
    }
    
   });
      

      $('#txt_rfc').focusout(function(){
        var rfc=$(this).val();
        // patron del RFC, persona moral
       // var _rfc_pattern_pm = "/^([A-ZÑ&]{3}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/";
         // patron del RFC, persona fisica
       //  var _rfc_pattern_pf = "/^([A-ZÑ&]{4}) ?(?:- ?)?(\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])) ?(?:- ?)?([A-Z\d]{2})([A\d])$/";
       
        if (!ValidaRfc(rfc)){
            generate('warning', "La estructura del de RFC no es valida");
           $('#txt_rfc').val('');
           $('#txt_rfc').css('border','2px solid red');
        }
        else{
          //Validar que ese RFC no exista en la BD PENDIENTE
          evitar_rfc_duplicado();
        }
      });

      $('#txt_rfc').focusin(function(){
          $('#txt_rfc').css('border','1px solid #ccc');
        });

      $('#btn_reestablecer_pass').click(function(){
        if($('#c_usuarios').val()=="vacio"){
          generate('warning','Debe seleccionar un usuario');
        }
        else{
          var user=$('#c_usuarios').val();
          var datos={
            'user':user
          }
          $.ajax({
              url:   "restablecer_pass.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                if(response.includes("ok")){
                  generate('success', 'Se ha restablecido la contraseña' );
                }
                else{
                  console.log(response);
                  generate('error', 'Ocurrio un error. Vea la consola para mas detalles' );
                }
              }
            });
        }
      });

      $('#limpiar_evento').click(function(){
        metodo_limpiar_evento();
      });
      function metodo_limpiar_evento(){
         $('#form_nuevo_evento')[0].reset();  
        ver_numero_evento();   
        $('#btn_crear_evento').show();
        $('#c_ejecutivos').multiselect("deselectAll", false).multiselect("refresh");
        $('#c_produccion').multiselect("deselectAll", false).multiselect("refresh");
        $('#c_disenio').multiselect("deselectAll", false).multiselect("refresh");
        $('#c_digital').multiselect("deselectAll", false).multiselect("refresh");
        $('#c_solicitantes').multiselect("deselectAll", false).multiselect("refresh");        
        $('#check_anio_evento').bootstrapToggle('off');
      }

       $('.moneda').blur(function(){
        if(!$(this).val().includes('$')){
            $('.moneda').formatCurrency();
        }
        
       });

       function evitar_rfc_duplicado(){
        var rfc=$('#txt_rfc').val();
        
        var datos={
          'rfc': rfc,
        }
         $.ajax({
              url:   "validar_rfc.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                
                if(response.includes("ya existe")){
                  var arr=response.split("#");
                  $('#txt_rfc').css('border','2px solid red');
                  generate('warning', 'Este RFC ya esta haciendo usado por otro '+arr[1] );
                  $('#txt_rfc').val("");
                }
                else if(response.includes("bloqueado")){
                  limpiar_cliente();
                  $('#txt_rfc').val('');
                  generate('warning', 'Este RFC esta bloqueado, para más información consultar a HAYDEE JAEN');
                }
              }
            });
        }
        function validar_rfc(tipo){
        var rfc=$('#txt_rfc').val();
        var resp="";
        var datos={
          'rfc': rfc,
          "tipo": tipo
        }
         $.ajax({
              url:   "validar_rfc.php",
              type:  'post',
              data: datos,
               async: false,
              success:  function (response) {
                console.log(response);
                if(response.includes("ya existe")){
                  resp= response.replace("ya existe#","");
                }
                else{
                  resp="true";
                }
              }
            });
         return resp;
        }
       
                    //SME 11 03 04 M96

                    function ValidaRfc(rfcStr) {
                      var strCorrecta;
                      strCorrecta = rfcStr; 
                      if (rfcStr.length == 12){
                      var valid = '^(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
                      }else{
                      var valid = '^(([A-Z]|[a-z]|\s){1})(([A-Z]|[a-z]){3})([0-9]{6})((([A-Z]|[a-z]|[0-9]){3}))';
                      }
                      var validRfc=new RegExp(valid);
                      var matchArray=strCorrecta.match(validRfc);
                      if (matchArray==null) {

                        return false;
                      }
                      else
                      {
                        return true;
                      }
                      
                    }

      function rfcValido(rfc, aceptarGenerico = true) {
          const re       = "^(([ÑA-Z|ña-z|&amp;]{3}|[A-Z|a-z]{4})\d{2}((0[1-9]|1[012])(0[1-9]|1\d|2[0-8])|(0[13456789]|1[012])(29|30)|(0[13578]|1[02])31)(\w{2})([A|a|0-9]{1}))$|^(([ÑA-Z|ña-z|&amp;]{3}|[A-Z|a-z]{4})([02468][048]|[13579][26])0229)(\w{2})([A|a|0-9]{1})$";
          var   validado = rfc.match(re);

          if (!validado)  //Coincide con el formato general del regex?
              return false;

          //Separar el dígito verificador del resto del RFC
          const digitoVerificador = validado.pop(),
                rfcSinDigito      = validado.slice(1).join(''),
                len               = rfcSinDigito.length,

          //Obtener el digito esperado
                diccionario       = "0123456789ABCDEFGHIJKLMN&OPQRSTUVWXYZ Ñ",
                indice            = len + 1;
          var   suma,
                digitoEsperado;

          if (len == 12) suma = 0
          else suma = 481; //Ajuste para persona moral

          for(var i=0; i<len; i++)
              suma += diccionario.indexOf(rfcSinDigito.charAt(i)) * (indice - i);
          digitoEsperado = 11 - suma % 11;
          if (digitoEsperado == 11) digitoEsperado = 0;
          else if (digitoEsperado == 10) digitoEsperado = "A";

          //El dígito verificador coincide con el esperado?
          // o es un RFC Genérico (ventas a público general)?
          if ((digitoVerificador != digitoEsperado)
           && (!aceptarGenerico || rfcSinDigito + digitoVerificador != "XAXX010101000"))
              return false;
          else if (!aceptarGenerico && rfcSinDigito + digitoVerificador == "XEXX010101000")
              return false;
          return rfcSinDigito + digitoVerificador;
      }


//Handler para el evento cuando cambia el input
// -Lleva la RFC a mayúsculas para validarlo
// -Elimina los espacios que pueda tener antes o después
function validarInput() {
  
    var rfc         = $('#txt_rfc').val(),
        valido=false;
        
    var rfcCorrecto = rfcValido(rfc);   // ⬅️ Acá se comprueba
  
    if (rfcCorrecto) {
      valido = true;
    } else {
      valido = false;
    }
     return valido;
}

  $('#solicitud_facturas').click(function(e){
    e.preventDefault();
          ver_clientes();
          /*
           $("#div_cortina").animate({top: '0px'}, 1100); 
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeIn();
           $('#div_reporte_eventos').fadeOut();
           $('#div_reporte_clientes').fadeOut();
           $('#div_reporte_proveedores').fadeOut();
           */
           limpiar_cortinas();
           $("#div_cortina").animate({top: '0px'}, 1100);
           $('#div_solicitud_factura').fadeIn();
           
  });

  $('#c_clientes_factura').change(function(){
    var clien=$(this).val();
    var usuario=$('#input_oculto').val();
    if(clien==null){

    }
    else{
    var datos={
          'clien': clien,
          'usuario': usuario,
        }
         $.ajax({
              url:   "ver_eventos_por_cliente.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                console.log(response);
                if(response.includes("datos faltantes")){
                  generate("warning", "Al cliente le faltan datos fiscales");
                }
                else{
                  response=response.replace("datos faltantes", "");
                  $('#c_evento_cliente').html(response);  
                }
                
                /*
                if(response=="<option value='vacio'>Selecciona un evento...</option>"){
                  generate("warning","No se han encontrado eventos del cliente seleccionado");
                }*/

                
              }
            });
       }
  });

  $('#c_evento_cliente').change(function(){
    var clien=$('#c_clientes_factura').val();
    var arr=clien.split("&");
    var id=arr[0];
    if($('#c_evento_cliente').val()==null){
    }
    else{
      //$('#sec_datos_factura').removeClass('hidden');
      $('#sec_datos_factura').fadeIn();
    var datos={
          'id': id,
        }
         $.ajax({
              url:   "ver_datos_tabla_cliente.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                $('#datos_cliente').html(response);
              }
            });
       }
  });

  $('#txt_subtotal').focusout(function(){
     if(!$(this).val().includes('$')){
      var sub=$(this).val();
      var iva=sub*.16;
      var total=sub*1.16;
      $('#txt_iva').val(iva);
      $('#txt_total').val(total);
    }
  });


       
  $('#form_solicitud_factura').submit(function(e){
    e.preventDefault();
     var $form = $(this);
    if($form.valid()){
      if($('#sumatoria_pu').html()=="$0.00"){
        $('#txt_concepto_partida').scrollTop();
        generate("warning", "Debe ingresar al menos una partida");
      }
      else if($('#c_empresa_factura').val()=="vacio"){
         generate("warning", "Debe seleccionar la empresa que va a facturar");
      }
        else{
       var datos = $('#form_solicitud_factura').serializeArray();
            datos.push({name: 'usuario_registra', value: $('#label_user').html()});
            // agregar los datos de la tabla tabla_partidas
            var data = t.rows().data();
            var largo=data.length-1;
            var partidas_descripcion="";
            var partidas_pu="";
            var partidas_iva="";
            var partidas_total="";
            for(var r=0;r<=largo;r++){
              partidas_descripcion=partidas_descripcion+data[r][0]+"#";
              partidas_pu=partidas_pu+data[r][1]+"#";
              partidas_iva=partidas_iva+data[r][2]+"#";
              partidas_total=partidas_total+data[r][3]+"#";
            }
            
            datos.push({name:"partidas_descripcion", value:partidas_descripcion});
            datos.push({name:"partidas_pu", value:partidas_pu});
            datos.push({name:"partidas_iva", value:partidas_iva});
            datos.push({name:"partidas_total", value:partidas_total});
            datos.push({name:"largo", value:largo});
       $.ajax({
              url:   'agregar_solicitud_factura.php',
              type:  'post',
              data: datos,
              success:  function (response) {
                if(response.includes("solicitud agregada")){
                  generate("success", "La solicitud se ha registrado");
                  window.open("solicitud_factura.php?id=0",'_blank');
                  $('#form_solicitud_factura').trigger('reset');
                  $('#c_evento_cliente').html('');
                   $('#sec_datos_factura').fadeOut();
                   t.clear().draw();
                    $('#sumatoria_pu').html("$0.00");
                    $('#sumatoria_iva').html("$0.00");
                    $('#sumatoria_total').html("$0.00");
                }
                else{
                  console.log(response);
                  generate("error","Ocurrio un error. Consulte la consola para más detalles");
                }
              }
            });
      }
    }
  });



  $('#rep_eventos').click(function(e){
    e.preventDefault();
    $("#div_cortina").animate({top: '0px'}, 1100); 
      limpiar_cliente();
      ver_bancos();
      ver_solicitudes_clientes("false", "clientes");
      $('.titulo_reporte').html("<legend><h2>Reporte de eventos</h2></legend>");
       $('#l_cli').html("Clientes registrados");
       $('#l_razon').html("Razón social del cliente");
       //$('#guardar_cliente').html("<i class='i_espacio fa fa-save' aria-hidden='true'></i>Guardar cliente");
       $('#txt_cuenta_bancaria').val("0");
       $('#txt_clabe').val("0");
       $('#titulo_alta').html("Solicitud de alta de cliente");
       $("#check_solicitud_pendientes:checked").prop('checked', false);
       $('#form_alta_proveedores').hide();
       $('#div_area_descripcion').hide();
       $('#div_tipo_persona').hide();

       /*
       $('#div_nuevo_evento').fadeOut();       
       $('#div_usuarios').fadeOut();
       $('#div_alta_cliente').fadeOut();
       $('#div_odc').fadeOut();
       $('#div_alta_proveedores').fadeOut();
       $('#div_formatos').fadeOut();
       $('#div_solicitudes').fadeOut();      
       $('#div_modificar_evento').fadeOut();
       $('#div_cerrar_evento').fadeOut();
       $('#div_solicitud_factura').fadeOut();
      $('#div_reporte_eventos').fadeIn();
      $('#div_reporte_clientes').fadeOut();
      $('#div_reporte_proveedores').fadeOut();
      */
      limpiar_cortinas();
           $("#div_cortina").animate({top: '0px'}, 1100);
           $('#div_reporte_eventos').fadeIn();
      
    
    $.ajax({
    type : 'POST',
    url  : 'reporte_eventos.php',
      success :  function(response){
        $('#reporte_eventos').html(response); 
         
        $('#reporte_eventos').DataTable({
             "scrollX": true,
             "destroy": true, 
              "sort": false,
             "language" : idioma_espaniol
          });            
      }
    });
  });
          

    $('#txt_cp').focusout(function(){
      var cp=$(this).val();
      var datos={
        "cp":cp,
      }
      $.ajax({
        type : 'POST',
        url  : 'codigos_postales.php',
        dataType: "json",
        data: datos,
          success : function(response){
            if(response.municipio!=null){
             $('#txt_municipio').val(response.municipio);
             $('#txt_estado').val(response.estado);
          }
          }
        });
      

      /*
      if($('#identificador_rfc').html()=='RFC'){
        $('#c_colonia').editableSelect('destroy');
        var codigo=$('#txt_cp').val();
        ver_datos_cps(codigo, "");
      }
      else{
        $('#c_colonia').editableSelect();
      }
      */

    });

    /* swal({
        title: 'Estatus de factura',
        input: 'select',
        inputOptions: {
          'COBRADO': 'COBRADO',
          'PAGADO': 'PAGADO',
          'NOTA DE CREDITO': 'NOTA DE CREDITO',
          'POR COBRAR': 'POR COBRAR'
        },
        inputPlaceholder: 'Selecsiona',
        showCancelButton: true,
       
      }).then(function (result) {
        swal({
          type: 'success',
          html: 'You selected: ' + result
        })
      });
      */

     $("#resultado_solicitudes").delegate(".btn-agregar-factura", "click", function(){
       var html="<div>Ingresa el # de factura: <p><input class='form-control' id='numero' type='number'></div><div>Ingresa el importe de la factura: <p><input class='form-control' id='importe' type='number'></div><div>Selecciona el estatus de la factura: <p><select id='estatus' class='form-control'><option value=''>---Selecciona---</option><option value='PAGADO'>PAGADO</option><option value='COBRADO'>COBRADO</option><option value='NOTA CREDITO'>NOTA CREDITO</option><option value='POR COBRAR'>POR COBRAR</option></select></div>";
        noty({
          text        : html,
          width       : '650px',
          type        : 'warning',
          dismissQueue: false,
          closeWith   : ['button'],
          theme       : 'metroui',
          timeout     : false,
          layout      : 'topCenter',
          callbacks: {
            afterShow: function() { },
          },
          buttons: [
            {addClass: 'btn btn-success', text: 'Aceptar', onClick: function($noty) {
              var numero=$noty.$bar.find('input#numero').val();
              var importe=$noty.$bar.find('input#importe').val();
              var estatus=$noty.$bar.find('select#estatus').val();
              if(numero==""){
                generate("warning", "Debe ingresar un numero");
              }
              else if(importe==""){
                generate("warning", "Debe ingresar un importe");
              }
              else if(estatus==""){
                generate("warning", "Debe seleccionar un estatus");
              }
              else{
                var evento=$('#c_mis_eventos').val();
                registrar_factura_cliente(numero, importe, estatus, evento, $noty);
                here
              }
              }
            },
            {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function($noty) {
              $noty.close();
              }
            }
          ]
        });
     });

     function registrar_factura_cliente(numero, importe, estatus, evento, noty){
        var datos={
          "numero": numero,
          "importe": importe,
          "estatus": estatus,
          "evento": evento,
        };
        $.ajax({
                url:   'agregar_factura_evento.php',
                type:  'post', 
                data:   datos,
                success:  function (response) {
                    if (response.includes("factura agregada")) {
                      var evento=$('#c_mis_eventos').val();
                      ver_solicitudes_por_evento(evento);
                      swal({
                        type: 'success',
                        title: 'Correcto',
                        html: 'La factura ha sido registrada!'
                      });
                      noty.close();
                      
                    }
                    else{
                      generate("error","Ocurrio un error<p>"+response);
                    }  
                }
        });
     }

    $("#resultado_solicitudes").delegate(".btn_numero_factura", "click", function() {
      var arr=$(this).attr('id').split("_");
      var id_solicitud_factura=arr[0];
      swal({
        title: "Agregar factura",
        text: "Ingresa el número de factura",
        input: "text",
        showCancelButton: true,
        animation: "slide-from-bottom",
        inputPlaceholder: "# de factura",
         showCancelButton: true,
         confirmButtonText: 'Enviar',
         showLoaderOnConfirm: true,
         cancelButtonText: "Cancelar",
         confirmButtonText: "Aceptar",
         confirmButtonColor: "#5E9008",
         cancelButtonColor: "#C20F0F",
         preConfirm: function (numero, res) {
           return new Promise(function (resolve, reject) {
             setTimeout(function() {               
               var datos={
                   "numero": numero,
                   "id_solicitud_factura": id_solicitud_factura,
               };
               $.ajax({
                       url:   'agregar_factura.php',
                       type:  'post', 
                       data:   datos,
                       async: false,
                       success:  function (response) {
                           if (numero === response) {
                             reject('Ese número de factura ya esta registrado');
                           } else {
                               resolve();
                               if(response.includes("existe")){
                                setTimeout(function() {
                                  swal({
                                     type: 'warning',
                                     title: 'Advertencia',
                                     html: 'Ese número de factura ya existe!'
                                   })
                                 }, 200)
                               }
                                else if(response.includes("factura agregada")){
                                   setTimeout(function() {
                                    ver_solicitudes_por_evento($('#c_mis_eventos').val());
                                        swal({
                                           type: 'success',
                                           title: 'Listo',
                                           html: 'La factura ha sido agregada!'
                                         })
                                       }, 200)
                                   }
                                   else{
                                       setTimeout(function() {
                                       swal({
                                       type: 'warning',
                                       title: 'Error',
                                       html: 'Ocurrio un error<br>'+response
                                     })
                                       
                                        }, 200)
                                   }
                           }         
                       }
               });
             }, 1000)
           })
         },
         allowOutsideClick: false
       }).then(function (numero) {
           
       })
    });

    

    $("#resultado_solicitudes").delegate(".btn_cheque", "click", function() {
           if($('#tipo_perfil').html().includes("Cuentas por pagar")){
            var id=$(this).val();
            var evento=$('#c_mis_eventos').val();
            var id=this.id;
            swal({
              title: "Modificar cheque",
              text: "Ingresa el número de cheque",
              input: "text",
              showCancelButton: true,
              animation: "slide-from-top",
              inputPlaceholder: "No. Cheque",
              showCancelButton: true,
              confirmButtonText: 'Enviar',
              showLoaderOnConfirm: true,
              cancelButtonText: "Cancelar",
              confirmButtonText: "Aceptar",
              confirmButtonColor: "#5E9008",
              cancelButtonColor: "#C20F0F",
              preConfirm: function (numero, res) {
                return new Promise(function (resolve, reject) {
                  setTimeout(function() {
                    var datos={
                        "numero": numero,
                        "id": id,
                    };
                    $.ajax({
                            url:   'registrar_cheque.php',
                            type:  'post', 
                            data:   datos,
                            async: false,
                            success:  function (response) {
                              
                                if (numero === response) {
                                  reject('El cheque '+numero+' ya fue registrado');
                                } else {
                                    resolve();
                                     if(response.includes("cheque registrado")){
                                       
                                      ver_solicitudes_por_evento(evento);
                                        setTimeout(function() {
                                          ver_solicitudes_por_evento(evento);
                                             swal({
                                                type: 'success',
                                                title: 'Listo',
                                                html: 'Cheque modificado: ' + numero
                                              })
                                            }, 200)
                                        }
                                        else if(response.includes("ya existe")){
                                            setTimeout(function() {
                                            swal({
                                            type: 'warning',
                                            title: 'Error',
                                            html: 'El cheque '+numero+' ya existe.'
                                          })
                                             }, 200)
                                        }
                                        else{
                                            setTimeout(function() {
                                            swal({
                                            type: 'warning',
                                            title: 'Error',
                                            html: 'Ocurrio un error:'+response
                                          })
                                             }, 200)
                                        }
                                }
                                
                              }
                          });
                          

                        }, 2000)
                      })
                    },
                    allowOutsideClick: false
                  }).then(function (numero) {
                      //ver_solicitudes_pendientes();
                  })
                }
              });

    $('#combo_tipo_persona').change(function(){
      var tipo=$(this).val();
      change_tipo_persona(tipo);
    });

    function change_tipo_persona(tipo){
      var titulo=$('#titulo_alta').html();

      if(!titulo.includes("clien")){  // proveedor
        if(tipo=="FISICA"){
          //INE, CSF, EDO CTA, COMPROBANTE
          activar_btn_file($('#span_file_csf'), $('#file_csf'));
          activar_btn_file($('#span_file_ine'), $('#file_ine'));
          activar_btn_file($('#span_file_edo'), $('#file_edo'));
          activar_btn_file($('#span_file_comp'), $('#file_comp'));
          desactivar_btn_file($('#span_file_acta'), $('#file_acta'));
          acta=true;
          
        }
        else if(tipo=="MORAL"){ // MORAL
          //INE, CSF, EDO CTA, COMPROBANTE, ACTA
          activar_btn_file($('#span_file_csf'), $('#file_csf'));
          activar_btn_file($('#span_file_ine'), $('#file_ine'));
          activar_btn_file($('#span_file_edo'), $('#file_edo'));
          activar_btn_file($('#span_file_comp'), $('#file_comp'));
          activar_btn_file($('#span_file_acta'), $('#file_acta'));
        }
        else{
          desactivar_btn_file($('#span_file_csf'), $('#file_csf'));
          desactivar_btn_file($('#span_file_ine'), $('#file_ine'));
          desactivar_btn_file($('#span_file_edo'), $('#file_edo'));
          desactivar_btn_file($('#span_file_comp'), $('#file_comp'));
          desactivar_btn_file($('#span_file_acta'), $('#file_acta'));
          csf=false;
          ine=false;
          edo=false;
          comp=false;
          acta=false;
        }
      }
      else{ //CLIENTES
        if(tipo!="vacio"){ 
          desactivar_btn_file($('#span_file_csf'), $('#file_csf'));
          desactivar_btn_file($('#span_file_ine'), $('#file_ine'));
          desactivar_btn_file($('#span_file_edo'), $('#file_edo'));
          desactivar_btn_file($('#span_file_comp'), $('#file_comp'));
          desactivar_btn_file($('#span_file_acta'), $('#file_acta'));
          activar_btn_file($('#span_file_csf'), $('#file_csf'));
          ine=true;
          edo=true;
          comp=true;
          acta=true;
        }
        else{
          desactivar_btn_file($('#span_file_csf'), $('#file_csf'));
          desactivar_btn_file($('#span_file_ine'), $('#file_ine'));
          desactivar_btn_file($('#span_file_edo'), $('#file_edo'));
          desactivar_btn_file($('#span_file_comp'), $('#file_comp'));
          desactivar_btn_file($('#span_file_acta'), $('#file_acta'));
          csf=false;
          ine=false;
          edo=false;
          comp=false;
          acta=false;
        }
      }
      
    }

    function activar_btn_file(btn, file){
          file.removeAttr('disabled');
          btn.removeAttr('disabled');
          file.css('cursor','pointer');
          btn.addClass('btn-success');
    }
    function desactivar_btn_file(btn, file){
          file.attr('disabled', true);
          btn.attr('disabled', true);
          file.css('cursor','not-allowed');
          btn.removeClass('btn-success');
          btn.addClass('btn-default');
    }

   

    $('#txt_email_usuario').focusout(function(){
      var correo=$(this).val();
      if(!correo.includes("@")){
        generate("warning", "El correo debe contener @");
      }
      else{
        var arr=correo.split("@");
        $('#txt_username').val(arr[0]);
      }

    });

    $('#rep_cat_clientes').click(function(e){
       e.preventDefault();
       $("#div_cortina").animate({top: '0px'}, 1100); 
       limpiar_cliente();
       ver_bancos();
       $('#l_cli').html("Clientes registrados");
       $('#l_razon').html("Razón social del cliente");
       //$('#guardar_cliente').html("<i class='i_espacio fa fa-save' aria-hidden='true'></i>Guardar cliente");
       $('#txt_cuenta_bancaria').val("0");
       $('#txt_clabe').val("0");
       $('.titulo_reporte').html("<legend><h2>Reporte de Clientes</h2></legend>");
       $('#titulo_alta').html("Solicitud de alta de cliente");
       $("#check_solicitud_pendientes:checked").prop('checked', false);
       ver_solicitudes_clientes("false", "clientes");
       $('#form_alta_proveedores').hide();
       $('#div_tipo_persona').hide();
       $('#div_area_descripcion').hide();

/*
       $('#div_nuevo_evento').fadeOut();       
       $('#div_usuarios').fadeOut();
       $('#div_alta_cliente').fadeOut();
       $('#div_odc').fadeOut();
       $('#div_alta_proveedores').fadeOut();
       $('#div_formatos').fadeOut();
       $('#div_solicitudes').fadeOut();
       $('#div_modificar_evento').fadeOut();
       $('#div_cerrar_evento').fadeOut();
       $('#div_solicitud_factura').fadeOut();
       $('#div_reporte_eventos').fadeOut();
       $('#div_reporte_clientes').fadeIn();
       $('#div_reporte_proveedores').fadeOut();
       
       */
       limpiar_cortinas();
           $("#div_cortina").animate({top: '0px'}, 1100);
           $('#div_reporte_clientes').fadeIn();
    
    $.ajax({
    type : 'POST',
    url  : 'reporte_clientes.php',
      success :  function(response){
        $('#reporte_clientes').html(response);  
        
        $('#reporte_clientes').DataTable({
             "scrollX": true,
             "destroy": true, 
              "sort": false,
             "language" : idioma_espaniol
          });            
      }
    });
  });
  
  
    var idioma_espaniol = {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
      }

      $('#rep_cat_proveedores').click(function(e){
        e.preventDefault();
          limpiar_cliente();
          ver_bancos();
           $('#l_cli').html("Clientes registrados");
           $('#l_razon').html("Razón social del cliente");
           //$('#guardar_cliente').html("<i class='i_espacio fa fa-save' aria-hidden='true'></i>Guardar cliente");
           $('#txt_cuenta_bancaria').val("0");
           $('#txt_clabe').val("0");
           $('.titulo_reporte').html("<legend><h2>Reporte de Proveedores</h2></legend>");
           $('#titulo_alta').html("Solicitud de alta de cliente");
           $("#check_solicitud_pendientes:checked").prop('checked', false);
           ver_solicitudes_clientes("false", "clientes");
           $('#form_alta_proveedores').hide();
           $('#div_area_descripcion').hide();
           $('#div_tipo_persona').hide();

           /*
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#div_modificar_evento').fadeOut();
           $('#div_cerrar_evento').fadeOut();
           $('#div_solicitud_factura').fadeOut();
          $('#div_reporte_eventos').fadeOut();
          $('#div_reporte_clientes').fadeOut();
          $('#div_reporte_proveedores').fadeIn();
          */
          limpiar_cortinas();
           $("#div_cortina").animate({top: '0px'}, 1100);
           $('#div_reporte_proveedores').fadeIn();          
    
    $.ajax({
    type : 'POST',
    url  : 'reporte_proveedores.php',
      success :  function(response){
        $('#reporte_proveedores').html(response);  
        $('#reporte_proveedores').DataTable({
                  dom: 'Bfrtip',
                buttons: [
                    //'copy', 'csv', 'excel', 'pdf', 'print'
                    'excel'
                ],
             "scrollX": true,
             "destroy": true, 
              "sort": false,
             "language" : idioma_espaniol
          });            
      }
    });
  });
  
  
    var idioma_espaniol = {
      "sProcessing":     "Procesando...",
      "sLengthMenu":     "Mostrar _MENU_ registros",
      "sZeroRecords":    "No se encontraron resultados",
      "sEmptyTable":     "Ningún dato disponible en esta tabla",
      "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
      "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
      "sInfoPostFix":    "",
      "sSearch":         "Buscar:",
      "sUrl":            "",
      "sInfoThousands":  ",",
      "sLoadingRecords": "Cargando...",
      "oPaginate": {
          "sFirst":    "Primero",
          "sLast":     "Último",
          "sNext":     "Siguiente",
          "sPrevious": "Anterior"
      },
      "oAria": {
          "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
          "sSortDescending": ": Activar para ordenar la columna de manera descendente"
      }
      }
    
    $(".various").fancybox({
    maxWidth  : 800,
    maxHeight : 600,
    fitToView : false,
    width   : '90%',
    height    : '80%',
    autoSize  : false,
    closeClick  : false,
    openEffect  : 'none',
    closeEffect : 'none'
  });

    $("#btn_cancelar_evento").click(function(){
      var nombre_evento=$("#c_eventos_creados option:selected" ).text();
      if(nombre_evento=="Selecciona un evento..."){
        generate("warning", "Debe seleccionar un evento");
      }else{
        noty({
            text        : "¿Desea cancelar el evento "+nombre_evento+"?",
            width       : '400px',
            type        : 'warning',
            dismissQueue: false,
            //closeWith   : ['button'],
            theme       : 'metroui',
            timeout     : false,
            layout      : 'topCenter',
             buttons: [
              {addClass: 'btn btn-success', text: 'Si', onClick: function($noty) {
                var id_evento=$('#c_eventos_creados').val();
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
                        
                      }
                      else if(response.includes("Existen pagos")){
                        generate('warning',"El evento solicitado ya cuenta con solicitudes previas");
                      }
                      else{
                        console.log(response);
                        generate('error',"Ocurrio un error.");
                      }
                    }
                  });
                  $noty.close();
                }
              },
              {addClass: 'btn btn-danger', text: 'No', onClick: function($noty) {
                 $noty.close();
                }
              }
             ]
            });
      }
        
    });
/*
    $("#singleupload_CSF").uploadFile({
    url:"upload.php",
    multiple:true,
    dragDrop:false,
    maxFileCount:5,
    fileName:"myfile",
    uploadStr: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Constancia de situación físcal CSF',
    autoSubmit: true,
  
    dynamicFormData: function() {
      var rfc=$('#txt_nombre_cliente').val();
        var data ={ nombre:rfc, doc:"CSF-"}
        return data;
    },
    
    onSuccess:function(files,data,xhr,pd)
    {
      
      var rfc=$('#txt_nombre_cliente').val();
      ver_archivos(rfc);
      $('.ajax-file-upload-statusbar').hide();
      
      file1=true;
      var tit=$('#titulo_alta').html();
      if(tit.includes("cliente")){
        //$("#enviar_solicitud_cliente").show();
        //$("#enviar_solicitud_cliente").show();
      }
      else{
        $("#files1").hide();
        $("#files2").show();
      }*/
      //var link="http://localhost/TDI/borrar_archivo.php?carpeta="+rfc+"&nombre="+files[0];
//      $("#eventsmessage").html($("#eventsmessage").html()+"<br/>Success for: "+JSON.stringify(data));
      //generate('success', $("#eventsmessage").html()+"<br/>Success for: "+JSON.stringify(data));

      /*<li id='li_csf' class="lis list-group-item" style='background-color: #649919; color: white'><i class="fa fa-check fa-2x" aria-hidden="true"></i> Constancia de situación físcal CSF</li>
      */
//      var link="http://localhost/TDI/borrar_archivo.php?carpeta="+rfc+"&nombre="+files[0];
     // $("#li_csf").html('<i class="fa fa-check fa-2x" aria-hidden="true"></i> <a href="archivos/'+rfc+'/'+files[0]+'" target="_blank">Constancia de situación físcal CSF </a><a href="'+link+'">></a>');
      //$("#li_csf").show();
     // $("#files1").hide();
/*
    },
  }); 
    */
    /*
      $("#singleupload_INE").uploadFile({
      url:"upload.php",
      multiple:true,
      dragDrop:false,
      maxFileCount:30,
      fileName:"myfile",
      uploadStr: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> INE del apoderado legal',
      autoSubmit: true,
       dynamicFormData: function() {
        var rfc=$('#txt_nombre_cliente').val();
          var data ={ nombre:rfc, doc:"INE-"}
          return data;
      },
      onSuccess:function(files,data,xhr,pd)
      {
        file2=true;
        var rfc=$('#txt_nombre_cliente').val();
        ver_archivos(rfc);
        $('.ajax-file-upload-statusbar').hide();
        var tipo=$('#combo_tipo_persona').val();
        
        $("#files2").hide();
        if(tipo=="FISICA"){
          $("#files3").hide();
          //$("#files4").show();
        }
       
        
        
      },
    }); 
  */
/*
    $("#singleupload_ACTA").uploadFile({
    url:"upload.php",
    multiple:true,
    dragDrop:false,
    maxFileCount:30,
    fileName:"myfile",
    uploadStr: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Acta constitutiva',
    autoSubmit: true,
     dynamicFormData: function() {
      var rfc=$('#txt_nombre_cliente').val();
        var data ={ nombre:rfc, doc:"ACTA-"}
        return data;
    },
    onSuccess:function(files,data,xhr,pd)
    {
      file3=true;
      var rfc=$('#txt_nombre_cliente').val();
        ver_archivos(rfc);
        $('.ajax-file-upload-statusbar').hide();
        $("#files3").hide();
        $("#files4").show();
    },
  }); 
    $("#singleupload_EDO_CTA").uploadFile({
    url:"upload.php",
    multiple:true,
    dragDrop:false,
    maxFileCount:30,
    fileName:"myfile",
    uploadStr: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Estado de cuenta',
    autoSubmit: true,
     dynamicFormData: function() {
      var rfc=$('#txt_nombre_cliente').val();
        var data ={ nombre:rfc, doc:"EDO-"}
        return data;
    },
    onSuccess:function(files,data,xhr,pd)
    {
      file4=true;
      var rfc=$('#txt_nombre_cliente').val();
        ver_archivos(rfc);
        $('.ajax-file-upload-statusbar').hide();
        $("#files4").hide();
        $("#files5").show();
    },
  }); 
    $("#singleupload_COMPROBANTE").uploadFile({
    url:"upload.php",
    multiple:true,
    dragDrop:false,
    maxFileCount:30,
    fileName:"myfile",
    uploadStr: '<i class="fa fa-file-pdf-o" aria-hidden="true"></i> Comprobante de domicilio',
    autoSubmit: true,
     dynamicFormData: function() {
      var rfc=$('#txt_nombre_cliente').val();
        var data ={ nombre:rfc, doc:"COMP-"}
        return data;
    },
    onSuccess:function(files,data,xhr,pd)
    {
      file5=true;
      var rfc=$('#txt_nombre_cliente').val();
        ver_archivos(rfc);
        $('.ajax-file-upload-statusbar').hide();
        $("#files5").hide();
        //$("#enviar_solicitud_cliente").show();
    },
  }); 
    */
    
    $('#btn_validar_clientes').click(function(e){
      e.preventDefault();
      
      validar_form_clientes_proveedores();
    });

    function validar_form_clientes_proveedores(){
          var url="alta_proveedores.php";
          var tipo="proveedores";
          var pasa=false;
          var titulo=$('#titulo_alta').html();
          var cliente=$('#txt_nombre_cliente').val();
          cliente=$.trim(cliente);
          var nombre_comercial=$('#txt_nombre_comercial').val();
          nombre_comercial=$.trim(nombre_comercial);
          var metodo=$('#c_metodo_pago').val();
          var rfc=$('#txt_rfc').val();
          var descripcion=$('#area_descripcion').val();
          var tipo_persona=$('#combo_tipo_persona').val();
          var digitos=$('#digitos').val();
          var calle=$('#txt_calle').val();
          var ext=$('#txt_num_ext').val();
          var int=$('#txt_num_int').val();
          var colonia=$('#c_colonia').val();
          var cp=$('#txt_cp').val();
          var tel=$('#txt_telefono').val();
          var estado=$('#txt_estado').val();
          var municipio=$('#txt_municipio').val();
          var nombre_contacto=$('#txt_nombre_contacto').val();
          var correo_contacto=$('#txt_correo_contacto').val();
          var usuario_solicita=$('#label_user').html();
          var uso_cfdi=$('#c_CFDI_CLIENTE').val();
          var cuenta=$('#txt_cuenta_bancaria').val();
          var clabe=$('#txt_clabe').val();
          var banco=$('#c_bancos').val();
          var sucursal=$('#txt_sucursal').val();

          if(titulo.includes("clien")){
            tipo="clientes";
            cuenta = "0";
            clabe  = "000000000000000000";
            banco  = "NA";
            descripcion="NA";
            sucursal="NA";
            metodo='NA';
            url="alta_clientes.php";
            }
            var respuesta=validar_rfc(tipo);
          
          if(cliente == ""){
            generate('warning', "Debe ingresar una razón social");
                pasa=false;
          }
          else if(nombre_comercial == ""){
            generate('warning', "Debe ingresar un nombre comercial");
                pasa=false;
          }
        else if(tipo_persona == "vacio"){
            generate('warning', "Debe seleccionar un tipo de persona");
                pasa=false;
          }
          else if(descripcion == ""){
            generate('warning', "Debe ingresar una descripción");
                pasa=false;
          }
          else if(rfc == ""){
            generate('warning', "Debe ingresar un RFC");
                pasa=false;
          }
          else if( respuesta != "true"){ //validacion de que el RFC no exista ya como cliente/proveedor
            generate('warning', "El RFC ya esta en uso por: "+respuesta);
                pasa=false;
          }
          else if(digitos == ""){
            generate('warning', "Debe ingresar los 4 últimos dígitos de la cuenta");
                pasa=false;
          }
          else if(digitos.length !=4){
            generate('warning', "Debe ingresar sólo 4 dígitos");
                pasa=false;
          }
          else if(tipo_persona == "vacio"){
            generate('warning', "Debe seleccionar un tipo de persona");
                pasa=false;
          }
        
          else if(calle == ""){
            generate('warning', "Debe ingresar el nombre de la calle");
                pasa=false;
          }
          else if(ext == ""){
            generate('warning', "Debe ingresar el número del domicilio");
                pasa=false;
          }
          else if(colonia == "vacio"){
            generate('warning', "Debe seleccionar el nombre de la colonia");
                pasa=false;
          }
          else if(cp == ""){
            generate('warning', "Debe ingresar el código postal");
                pasa=false;
          }
          else if(tel == ""){
            generate('warning', "Debe ingresar un teléfono");
                pasa=false;
          }
          else if(tel.length!=10){
            generate('warning', "El número de teléfono debe ser a 10 dígitos");
                pasa=false;
          }
          else if(estado == ""){
            generate('warning', "Debe ingresar un estado");
                pasa=false;
          }
          else if(municipio == ""){
            generate('warning', "Debe ingresar un municipio");
                pasa=false;
          }
          else if(metodo == "vacio"){
            generate('warning', "Debe selecciona una forma de pago");
                pasa=false;
          }
          else if(nombre_contacto == ""){
            generate('warning', "Debe ingresar un nombre de contacto");
                pasa=false;
          }
          else if(!expRegEmail.exec(correo_contacto)){
            generate('warning', "Debe ingresar un correo válido de contacto");
                pasa=false;
          }
          else if(cuenta == ""){
            generate('warning', "Debe ingresar un No. de cuenta");
                    pasa=false;
          }
          else if(clabe == ""){
            generate('warning', "Debe ingresar un CLABE");
                    pasa=false;
          }
          else if(clabe.length!=18){
            generate('warning', "Deben ser 18 números de CLABE");
                pasa=false;
          }
          else if(banco == "vacio"){
            generate('warning', "Debe seleccionar un banco");
                    pasa=false;
          }
          else if(uso_cfdi == "vacio"){
            generate('warning', "Debe seleccionar un uso de CFDI");
                pasa=false;
          }  
          else if(sucursal == ""){
            generate('warning', "Debe ingresar una sucursal");
                    pasa=false;
          }
          
          else if($("#file_csf").val()==""){
            generate('warning', "Falta documento Constancia Situacion Fiscal");
                    pasa=false;
          } 
          else if($("#file_ine").val()=="" && titulo.includes("proveedor")){
            generate('warning', "Falta documento Identificación");
                    pasa=false;
          }
          else if($("#file_edo").val()=="" && titulo.includes("proveedor")){
            generate('warning', "Falta documento Estado de cuenta");
                    pasa=false;
          }         
          else if($("#file_comp").val()=="" && titulo.includes("proveedor")){
            generate('warning', "Falta documento Comprobande de domicilio");
                    pasa=false;
          } 
          else if($("#file_acta").val()=="" && tipo_persona=="Moral"  && titulo.includes("proveedor")){
            generate('warning', "Falta documento Acta Constitutiva");
                    pasa=false;
          } 
          else {
            pasa=true;
          }

          if(pasa==true){ // si todos los campos son correctos, se manda a documentos
            //$('#fieldset_documentos').fadeIn();
            var datos = {
              "cliente": cliente,
              "nombre_comercial": nombre_comercial,
              "descripcion": descripcion,
              "metodo": metodo,
              "rfc": rfc,
              "digitos": digitos,
              "calle": calle,
              "ext": ext,
              "int": int,
              "colonia": colonia,
              "descripcion": descripcion,
              "tipo_persona":tipo_persona,
              "cp": cp,
              "tel": tel,
              "estado": estado,
              "municipio": municipio,
              "nombre_contacto": nombre_contacto,
              "correo_contacto": correo_contacto,
              "usuario_solicita": usuario_solicita,
              "cuenta": cuenta,
              "clabe": clabe,
              "banco": banco,
              "tipo": tipo,
              "sucursal": sucursal,
              "tipo_persona": tipo_persona,
              "uso_cfdi": uso_cfdi,

            };
            $.ajax({
              url:   url,
              type:  'post',
              data:  datos,
               beforeSend: function(){
                //$('#btn_validar_clientes').html("<img src='img/puntos.gif'>");
               },
              success:  function (response) {
                //console.log(response);
                if(response.includes("registro correcto") || response.includes("ya existe")){
                  //generate("success", "Registro correcto");
                  //generate('success', "La solicitud se ha registrado!!");
                  var nombre=$('#txt_nombre_cliente').val();
                  guardar_archivos_proveedores_csf(nombre.trim());
                  guardar_archivos_proveedores_ine(nombre.trim());
                  guardar_archivos_proveedores_edo(nombre.trim());
                  guardar_archivos_proveedores_comp(nombre.trim());
                  if($("#file_acta").val()!=""){
                    guardar_archivos_proveedores_acta();
                  }
                  
                  $('#enviar_solicitud_cliente').html('<i class="i_espacio fa fa-envelope-o" aria-hidden="true"></i>Enviar Solicitud');
                  envio_mail_solicitud();
                  
                }

                else{
                  generate("error", "Ocurrio un error: "+response);
                  console.log(response);
                }
                
                
              }
            });
            
              
          }
    };

    function guardar_archivos_proveedores_csf(nombre){
      var file_data = $('#file_ine').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      form_data.append('nombre', nombre);
      form_data.append('doc', 'CSF');
      $.ajax({
          url: 'upload_file.php', // point to server-side PHP script 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          success: function(php_script_response){
          }
       });
    }
    function guardar_archivos_proveedores_ine(nombre){
      var file_data = $('#file_csf').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      form_data.append('nombre', nombre);
      form_data.append('doc', 'INE');
      $.ajax({
          url: 'upload_file.php', // point to server-side PHP script 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          success: function(php_script_response){
          }
       });
    }
    function guardar_archivos_proveedores_edo(nombre){
      var file_data = $('#file_edo').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      form_data.append('nombre', nombre);
      form_data.append('doc', 'EDO');
      $.ajax({
          url: 'upload_file.php', // point to server-side PHP script 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          success: function(php_script_response){
          }
       });
    }
    function guardar_archivos_proveedores_comp(nombre){
      var file_data = $('#file_comp').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      form_data.append('nombre', nombre);
      form_data.append('doc', 'COMP');
      $.ajax({
          url: 'upload_file.php', // point to server-side PHP script 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          success: function(php_script_response){
          }
       });
    }

    function guardar_archivos_proveedores_acta(nombre){
      var file_data = $('#file_acta').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      form_data.append('nombre', nombre);
      form_data.append('doc', 'ACTA');
      $.ajax({
          url: 'upload_file.php', // point to server-side PHP script 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          success: function(php_script_response){
          }
       });
    }


function ver_archivos(carpeta){
  //var carpeta=$('#txt_nombre_cliente').val();
  carpeta=$.trim(carpeta);
  
  $("#ul_archivos").html("");
          var datos={
            "carpeta": carpeta,
          }
  $.ajax({
    type : 'POST',
    url  : 'ver_archivos.php',
    data : datos,
    
      success :  function(response){
      
        if(response.includes("#")){
          var arr=response.split("#");
          for(var r=2;r<=arr.length-1;r++){
            /*
            $("#ul_archivos").append('<li class="lis list-group-item" style="background-color: #649919; color: white"><i class="fa fa-check fa-2x" aria-hidden="true"></i><a href="archivos/'+carpeta+'/'+arr[r]+'" target="_blank">'+arr[r]+'</a> <button type="button" id="'+arr[r]+'" class="borrar_file btn btn-xs btn-danger"><i class="i_espacio fa fa-trash" aria-hidden="true"></i> Borrar</button></li>');
            */
            $("#ul_archivos").append('<li class="lis list-group-item" style="background-color: #649919; color: white"><i class="fa fa-check fa-2x" aria-hidden="true"></i><a href="archivos/'+carpeta+'/'+arr[r]+'" target="_blank">'+arr[r]+'</a> </li>');
          }
        }
        else{
          console.log(response);
        }
      }
    });

}


  $("#ul_archivos").delegate(".borrar_file", "click", function() {
  var nombre=$(this).attr("id");
  var carpeta=$('#txt_nombre_cliente').val();
   var myWindow=window.open("borrar_archivo.php?carpeta="+carpeta+"&nombre="+nombre, "myWindow", "width=2,height=1");
  
  setTimeout(myWindow.close(), 500);
  //window.location.href="borrar_archivo.php?carpeta="+carpeta+"&nombre="+nombre;
  generate("success","El archivo ha sido eliminado");
  ver_archivos(carpeta);
  ver_archivos(carpeta);
  ver_archivos(carpeta);
});
   
   //descargar_zip("APPLE COMPANY, S.A. DE C.V");
 function descargar_zip(carpeta){
  //alert(carpeta);
      var datos={
        "carpeta": carpeta,
      }
      $.ajax({
          url: 'archivos/descargar_zip.php',
          type: 'post',
          data: datos,
          success: function(response){
              //console.log(response);
              window.location = "archivos/"+response;
          }
      });
  }

  $('#check_sodexo').click(function(e){
    var bandera_sodexo="";
    if($('#check_sodexo').is(':checked')){
      $('#label_fernanda').html("A nombre de: TARJETA SODEXO");
      bandera_sodexo="con";
    }
    else{
      $('#label_fernanda').html("A nombre de: FERNANDA CARRERA");
      bandera_sodexo="sin";
    }
      var datos={
        "bandera_sodexo": bandera_sodexo,
      }
      ver_proveedores_usuarios(bandera_sodexo);
  });

 



  $('#btn_add_partida').click(function(e){
    e.preventDefault();
    var concepto=$('#txt_concepto_partida').val();
    var pu=$('#txt_precio_unitario').val();
    if(concepto=="" || pu==""){
      generate("warning", "No pueden ir datos vacios");
    }
    else{
      var iva=0;
      var total=0;
      if($('#check_iva').is(':checked')){
        
        iva=0;
        total=pu;
        umatoria_pu=(sumatoria_pu+(pu*1));
        sumatoria_iva=0;
        sumatoria_total=(sumatoria_total+total);
      }
      else{
        iva=pu*.16;
        total=pu*1.16;
        umatoria_pu=(sumatoria_pu+(pu*1));
        sumatoria_iva=(sumatoria_iva+iva);
        sumatoria_total=(sumatoria_total+total);
      }
       

      pu=accounting.formatMoney(pu);
      iva=accounting.formatMoney(iva);
      total=accounting.formatMoney(total);

      var s1=accounting.formatMoney(sumatoria_pu);
      var s2=accounting.formatMoney(sumatoria_iva);
      var s3=accounting.formatMoney(sumatoria_total);
    
        t.row.add( [
            concepto,
            pu,
            iva,
            total
        ] ).draw( true );
        
        $('#txt_concepto_partida').val("");
        $('#txt_precio_unitario').val("");
        validar_totales();
      }

  });

  $('#tabla_partidas tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('selected') ) {
            $(this).removeClass('selected');
        }
        else {
            t.$('tr.selected').removeClass('selected');
            $(this).addClass('selected');
        }
    } );

  $('#btn_quitar').click( function (e) {
    e.preventDefault();
        t.row('.selected').remove().draw( false );
         validar_totales();
    } );

  function validar_totales(){
    var data = t.rows().data();
          //console.log( 'The table has ' + data.length + ' records' );
          //console.log( 'Data', data );
          var largo=data.length-1;
          var sum=0;
          for(var r=0;r<=largo;r++){
            var pu=accounting.unformat(data[r][1]);
            sum=(sum+pu);
          }
           if(!$('#check_iva').is(':checked')){
            $('#sumatoria_pu').html(accounting.formatMoney(sum));
            $('#sumatoria_iva').html(accounting.formatMoney(sum*.16));
            $('#sumatoria_total').html(accounting.formatMoney(sum*1.16));
          }
          else{
            $('#sumatoria_pu').html(accounting.formatMoney(sum));
            $('#sumatoria_iva').html(accounting.formatMoney(0));
            $('#sumatoria_total').html(accounting.formatMoney(sum*1));
          }
  }
  

  
var doc = new jsPDF();
var specialElementHandlers = {
    '#editor': function (element, renderer) {
        return true;
    }
};

$("#resultado_solicitudes").delegate(".check_transfer", "click", function() {
  var id=$(this).val();
  if($(this).is(':checked')){
    ids_odc=ids_odc+id+",";
  }
  else{
    ids_odc=ids_odc.replace(id+",","");
  }
  
  if(ids_odc==""){
    $('#btn_transferir').hide();
    $('#btn_borrar_sdp').hide();
  }
  else{
    $('#btn_transferir').show();
    $('#btn_borrar_sdp').show();
  }
});

llenar_transfer_eventos();

function llenar_transfer_eventos(){
  var usuario=$('#label_user').html();
  var datos={
    "usuario": usuario,
  }
  $.ajax({
      url:   "ver_eventos2.php",
      type:  'post',
      data: datos,
      success:  function (response) {
         $('#c_transfer').html(response);
      }
    });
}

$('#btn_transferir').click(function(){
  noty({
                    text        : $('#prueba').html(),
                    width       : '650px',
                    type        : 'warning',
                    dismissQueue: false,
                    closeWith   : ['button'],
                    theme       : 'metroui',
                    timeout     : false,
                    layout      : 'topCenter',
                     callbacks: {
                      afterShow: function() { },
                    },
                     buttons: [
                      {addClass: 'btn btn-success', text: 'Aceptar', onClick: function($noty) {

                        var valor=$('#c_mis_eventos').val();
                        var valor2=$noty.$bar.find('select#c_transfer option:selected').text();
                        var ID=$noty.$bar.find('select#c_transfer option:selected').val();
                        //console.log(valor+"-"+valor2);
                         //if(valor==valor2){
                         if(valor2==valor){
                            generate("warning",'No es posible transferir al mismo evento');
                         }
                         else{
                            transferir_odc(ids_odc, ID, $noty);
                         }
                          
                           
                        }
                      },
                           {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function($noty) {
                         $noty.close();
                        }
                      }
                     ]
                  });
});

    function transferir_odc(ids, evento, n){
        var parametros = {
                  "ids": ids,
                  "evento": evento,
          };
        $.ajax({
          data: parametros,
          url:   'transferir_odc.php',
          type:  'post',
          success:  function (response) {
            if(response.includes("correcto")){
              generate("success", "La transferencia ha sido realizada!");
              n.close();
              var ev=$('#c_mis_eventos').val();
              ver_solicitudes_por_evento(ev);
            }
            else{
              generate("error", "Error: "+response);
            }
          }
        });
    }

$('#btn_bloquear').click(function(){
  var arr=$('#c_clientes_alta').val().split("&");
  var id_prov=arr[0];
  var tit="proveedor";
  var t=$('#titulo_alta').html();
  
  if(t.includes("cliente")){
    tit="cliente";
  }
  noty({
            text: '¿Realmente deseas eliminar al '+tit+' '+arr[1]+'?',
            type        : 'warning',
            dismissQueue: false,
            theme       : 'metroui',
            layout      : 'topCenter',  //bottomLeft
            buttons: [
              {addClass: 'btn btn-success', text: 'Si, eliminar', onClick: function($noty) {
                    var parametros={
                      "id_prov": id_prov,
                      "tit":tit,
                    }
                     $.ajax({
                        url:   "borrar_cliente.php",
                        type:  'post',
                        data: parametros,
                        success:  function (response) {
                          
                          if(response.includes("eliminado")){
                            limpiar_cliente();
                            $noty.close();
                            generate("success","El "+tit+" ha sido eliminado!!");
                          }
                          else{
                            $noty.close();
                            console.log(response);
                            generate('error', "Ocurrio un error en el proceso. Vea la consola para más detalles");
                          }
                        }
                      });


                  //
                  
                }
              },
              {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function($noty) {
                  $noty.close();
                 
                }
              }
            ]
          });

});

$('#btn_borrar_sdp').click(function(){
  noty({
                    text        : "Ingresa un motivo de borrado<p><input class='form-control' id='motivo' type='text'>",
                    width       : '650px',
                    type        : 'warning',
                    dismissQueue: false,
                    closeWith   : ['button'],
                    theme       : 'metroui',
                    timeout     : false,
                    layout      : 'topCenter',
                     callbacks: {
                      afterShow: function() { },
                    },
                     buttons: [
                      {addClass: 'btn btn-success', text: 'Aceptar', onClick: function($noty) {
                        var motivo=$noty.$bar.find('input#motivo').val();
                        if(motivo==""){
                          generate("warning", "Debe ingresar un motivo");
                        }
                        else{
                          var evento=$('#c_mis_eventos').val();
                          borrar_sdp(motivo, evento, ids_odc, $noty);
                        }
                        }
                      },
                      {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function($noty) {
                         $noty.close();
                        }
                      }
                     ]
                  });
});
    
  function borrar_sdp(motivo, evento, ids, noty){
    var parametros = {
                  "motivo": motivo,
                  "evento": evento,
                  "ids": ids,
          };
        $.ajax({
          data: parametros,
          url:   'cancelar_odc.php',
          type:  'post',
          success:  function (response) {
            if(response.includes("cancelado")){
              generate("success", "La solicitud ha sido cancelada!!");
              var evento=$('#c_mis_eventos').val();
              ver_solicitudes_por_evento(evento);
              noty.close();
            }
            else{
              generate("error", "Error: "+response);
            }
          }
        });
    
  }

   $("div.bhoechie-tab-menu>div.list-group>a").click(function(e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });

   

/*
$("#resultado_solicitudes").delegate(".btn_monto", "mouseenter", function() {
  $('#uno').tooltipster('open');
});
*/

 $('#resultado_solicitudes').delegate('.bubble3','mouseenter', function(e) {
  
  //$(e).tooltipster('show');
        $(e.target).tooltipster({
            contentAsHTML: 'true',
        });
    });

    $('#resultado_solicitudes').delegate('.btn_devolucion','mouseover', function(e) {
      $(this).tooltip({
        position: {
          my: "center bottom-20",
          at: "center top",
          using: function( position, feedback ) {
            $( this ).css( position );
            $( "<div>" )
              .addClass( "arrow" )
              .addClass( feedback.vertical )
              .addClass( feedback.horizontal )
              .appendTo( this );
          }
        }
      });
    });

$('#resultado_solicitudes').delegate('.btn_devolucion','click', function(e) {
  var arr=$(this).attr('id').split("_");
  var id=arr[0];
  var maximo=arr[1];
  var num_tarjeta=$(this).attr('name');
  var tarjeta_dev="";
  var arr_tipo_tarjeta=num_tarjeta.split("-");
  if(arr_tipo_tarjeta[0].includes("TARJETA")){
    num_tarjeta="TARJETA "+arr_tipo_tarjeta[1];
    tarjeta_dev=arr_tipo_tarjeta[1];
  }
  else{
    num_tarjeta="EFECTIVO";
    tarjeta_dev="0";
  }
  
  //<div class='col-md-3'>Fecha de devolución:</div><div class='col-md-9'><input id='fecha_devolucion' type='date' class='form-control fecha'></div>
  //BANCOS=BANCOS.replace('<option value="vacio">Selecciona un banco...</option>', '');
  var inputs="<div class='row'><div class='col-md-3'>Motivo devolución:</div><div class='col-md-9'><textarea class='form-control' id='motivo' cols='3' rows='4' placeholder='Ingresa un motivo'></textarea> </div></div><p><div class='row'><div class='col-md-3'>Monto a devolver:</div> <div class='col-md-9'><input class='form-control' id='txt_monto' type='number' placeholder='Ingresa solo importe numérico '> </div></div><p><div class='row'></div><p><div class='row'><div class='col-md-3'>Destino:</div><div class='col-md-9'><select class='form-control' id='banco'><option value='"+tarjeta_dev+"'>"+num_tarjeta+"</option>";//<option value='-' disabled>--------</option>"+BANCOS+"</select></div></div>";
  noty({
                    text        : inputs,
                    width       : '650px',
                    type        : 'warning',
                    dismissQueue: false,
                    closeWith   : ['button'],
                    theme       : 'metroui',
                    timeout     : false,
                    layout      : 'topCenter',
                     callbacks: {
                      afterShow: function() { },
                    },
                     buttons: [
                      {addClass: 'btn btn-success', text: 'Aceptar', onClick: function($noty) {
                        var motivo=$noty.$bar.find('textarea#motivo').val();
                        var monto=$noty.$bar.find('input#txt_monto').val();
                        var fecha=$noty.$bar.find('input#fecha_devolucion').val();
                        var banco=$noty.$bar.find('select#banco').val();
                        
                        if(motivo=="" || monto=="" || fecha==""){
                          generate("warning", "Todos los datos son requeridos");
                        }
                        else if(parseFloat(monto)>=parseFloat(maximo)){
                          generate("warning", "El monto a devolver debe ser menor al de la solicitud");
                        }
                        else{
                          
                           devolucion_solicitud(id, monto, motivo, fecha, banco, $noty);
                          
                        }
                        }
                      },
                      {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function($noty) {
                         $noty.close();
                        }
                      }
                     ]
                  });
    });


function devolucion_solicitud(id_odc, monto, motivo, fecha, banco,  noty){
    var parametros = {
            "id_odc": id_odc,
            "monto": monto,
            "motivo": motivo,
            "fecha": fecha,      
            "banco": banco,      
          };
        $.ajax({
          data: parametros,
          url:   'devolucion_solicitud.php',
          type:  'post',
          success:  function (response) {
            if(response.includes("devolucion exitosa")){
              generate("success", "La devolucion se ha realizado correctamente!!");
              var evento=$('#c_mis_eventos').val();
              ver_solicitudes_por_evento(evento);
              noty.close();
            }
            else{
              generate("error", "Error: "+response);
            }
          }
        });
    
  }
 /*
 $('#file_csf').change(function(){
    var nombre=$('#txt_nombre_cliente').val();
    if(nombre!=""){
      var file_data = $('#file_csf').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      form_data.append('nombre', nombre);
      form_data.append('doc', 'CSF');
      $.ajax({
          url: 'upload_file.php', // point to server-side PHP script 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          beforeSend: function(){
                $('#span_file_csf label').html("<img src='img/fancybox_loading.gif'>Subiendo...");
               },
          success: function(php_script_response){
            $('#span_file_csf label').html("Constancia de Situacion Fiscal");
              ver_archivos($('#txt_nombre_cliente').val());
              desactivar_btn_file($('#span_file_csf'), $('#file_csf'));
              $('#span_file_csf').removeClass('btn-default');
              $('#span_file_csf').addClass('btn-success');
              csf=true;
          }
       });
    }
});

 $('#file_ine').change(function(){
    var nombre=$('#txt_nombre_cliente').val();
    if(nombre!=""){
      var file_data = $('#file_ine').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      form_data.append('nombre', nombre);
      form_data.append('doc', 'INE');
      $.ajax({
          url: 'upload_file.php', // point to server-side PHP script 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          beforeSend: function(){
                $('#span_file_ine label').html("<img src='img/fancybox_loading.gif'>Subiendo...");
               },
          success: function(php_script_response){
            $('#span_file_ine label').html("Identificación INE");
              ver_archivos($('#txt_nombre_cliente').val());
              desactivar_btn_file($('#span_file_ine'), $('#file_ine'));
              $('#span_file_ine').removeClass('btn-default');
              $('#span_file_ine').addClass('btn-success');
              ine=true;
          }
       });
    }
});
 $('#file_edo').change(function(){
    var nombre=$('#txt_nombre_cliente').val();
    if(nombre!=""){
      var file_data = $('#file_edo').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      form_data.append('nombre', nombre);
      form_data.append('doc', 'EDO');
      $.ajax({
          url: 'upload_file.php', // point to server-side PHP script 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          beforeSend: function(){
                $('#span_file_edo label').html("<img src='img/fancybox_loading.gif'>Subiendo...");
               },
          success: function(php_script_response){
            $('#span_file_edo label').html("Estado de cuenta");
              ver_archivos($('#txt_nombre_cliente').val());
              desactivar_btn_file($('#span_file_edo'), $('#file_edo'));
              $('#span_file_edo').removeClass('btn-default');
              $('#span_file_edo').addClass('btn-success');
              edo=true;
          }
       });
    }
});
 $('#file_comp').change(function(){
    var nombre=$('#txt_nombre_cliente').val();
    if(nombre!=""){
      var file_data = $('#file_comp').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      form_data.append('nombre', nombre);
      form_data.append('doc', 'COMP');
      $.ajax({
          url: 'upload_file.php', // point to server-side PHP script 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          beforeSend: function(){
                $('#span_file_comp label').html("<img src='img/fancybox_loading.gif'>Subiendo...");
               },
          success: function(php_script_response){
            $('#span_file_comp label').html("Comprobante de domicilio");
              ver_archivos($('#txt_nombre_cliente').val());
              desactivar_btn_file($('#span_file_comp'), $('#file_comp'));
              $('#span_file_comp').removeClass('btn-default');
              $('#span_file_comp').addClass('btn-success');
              comp=true;
          }
       });
    }
});
 $('#file_acta').change(function(){
    var nombre=$('#txt_nombre_cliente').val();
    if(nombre!=""){
      var file_data = $('#file_acta').prop('files')[0];   
      var form_data = new FormData();                  
      form_data.append('file', file_data);
      form_data.append('nombre', nombre);
      form_data.append('doc', 'ACTA');
      $.ajax({
          url: 'upload_file.php', // point to server-side PHP script 
          dataType: 'text',  // what to expect back from the PHP script, if anything
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,                         
          type: 'post',
          beforeSend: function(){
                $('#span_file_acta label').html("<img src='img/fancybox_loading.gif'>Subiendo...");
               },
          success: function(php_script_response){
            $('#span_file_acta label').html("Acta constitutiva");

              ver_archivos($('#txt_nombre_cliente').val());
              desactivar_btn_file($('#span_file_acta'), $('#file_acta'));
              $('#span_file_acta').removeClass('btn-default');
              $('#span_file_acta').addClass('btn-success');
              acta=true;
          }
       });
    }
});
  */
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

  /*COMENTARIO DE  CASA*/

  $("#resultado_solicitudes").delegate(".btn_eliminar_factura", "click", function(e) {
    e.preventDefault();
    //var id=$(this).attr('id');
     var id=$(this).attr("id");
    noty({
        text        : "Ingresa un motivo de borrado<p><input class='form-control' id='motivo' type='text'>",
        width       : '650px',
        type        : 'warning',
        dismissQueue: false,
        closeWith   : ['button'],
        theme       : 'metroui',
        timeout     : false,
        layout      : 'topCenter',
         callbacks: {
          afterShow: function() { },
        },
         buttons: [
          {addClass: 'btn btn-success', text: 'Aceptar', onClick: function($noty) {
            var motivo=$noty.$bar.find('input#motivo').val();
            if(motivo==""){
              generate("warning", "Debe ingresar un motivo");
            }
            else{
              
              borrar_sdf(motivo, id, $noty);
            }
            }
          },
          {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function($noty) {
             $noty.close();
            }
          }
         ]
      });
  });

  function borrar_sdf(motivo, id, noty){
    var parametros = {
                  "motivo": motivo,
                  "id": id,                  
          };
        $.ajax({
          data: parametros,
          url:   'cancelar_solicitud_factura.php',
          type:  'post',
          success:  function (response) {
            if(response.includes("cancelada")){
              generate("success", "La solicitud ha sido cancelada!!");
              var evento=$('#c_mis_eventos').val();
              ver_solicitudes_por_evento(evento);
              noty.close();
            }
            else{
              generate("error", "Error: "+response);
            }
          }
        });
    
  }

  $('#menu_tarjetas').click(function(e){
    e.preventDefault();
    limpiar_cortinas();
    $("#div_cortina").animate({top: '0px'}, 1100);
    $('#div_cxc').fadeIn();
    ver_tarjetas();
    $('#tarjetas_resultado').html("");
    
});

  function limpiar_cortinas(){
  $('#div_usuarios').fadeOut();
  $('#div_alta_cliente').fadeOut();
  $('#div_alta_proveedores').fadeOut();
  $('#div_formatos').fadeOut();
  $('#div_solicitudes').fadeOut();
  $('#div_odc').fadeOut();
  $('#div_nuevo_evento').fadeOut();
  $('#div_modificar_evento').fadeOut();
  $('#div_cerrar_evento').fadeOut();
  $('#div_solicitud_factura').fadeOut();
  $('#div_reporte_eventos').fadeOut();
  $('#div_reporte_clientes').fadeOut();
  $('#div_reporte_proveedores').fadeOut();
  $('#div_cxc').fadeOut();
  $('#div_iframe').fadeOut();

}

function ver_tarjetas(){
  $.ajax({
    url:   'ver_bancos_tarjetas.php',
    type:  'post',
    success:  function (response) {
      $('#c_banco_tarjetas').html(response);
    }
  });
}

$('#c_banco_tarjetas').change(function(){

  var banco_tarjeta=$(this).val();
  if(banco_tarjeta!="vacio"){
    var parametros = {
            "banco_tarjeta": banco_tarjeta,
          };
    $.ajax({
      data: parametros,
      url:   'ver_resumen_tarjetas.php',
      type:  'post',
      beforeSend: function(){
        $('#tarjetas_resultado').html("");
        $('#btn_gif_tarjetas_resumen').show();
       },
      success:  function (response) {
        $('#btn_gif_tarjetas_resumen').hide();
        $('#tarjetas_resultado').html(response);
      }
    });
  }
});

$('#btn_desc_zip').click(function(){
  var cliente=$('#txt_nombre_cliente').val();
  if(cliente!=""){
    descargar_zip($.trim(cliente));
  }
});

//llenar combo tarjetas
function llenar_combo_tarjetas(){
  var usuario=$('#c_usuarios').val();
  var datos={
    "usuario": usuario,
  };
  $.ajax({
    url:   'ver_tarjetas_registradas.php',
    type:  'post',
    data:  datos,
    success:  function (response) {
      
      $('#respuesta_tarjetas').html(response);
    }
  });
}


$('#btn_add_tarjeta').click(function(e){
  e.preventDefault();
  swal({
       title: "Agregar tarjeta",
    text: "Ingresa el numero de la tarjeta",
    input: "text",
    showCancelButton: true,
    animation: "slide-from-bottom",
    inputPlaceholder: "No. de tarjeta sodexo",
        showCancelButton: true,
        confirmButtonText: 'Enviar',
        showLoaderOnConfirm: true,
        cancelButtonText: "Cancelar",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#5E9008",
        cancelButtonColor: "#C20F0F",
        preConfirm: function (nombre, res) {
          return new Promise(function (resolve, reject) {
            setTimeout(function() {
              var datos={
                  "nombre": nombre,
              };
              $.ajax({
                      url:   'agregar_tarjeta.php',
                      type:  'post', 
                      data:   datos,
                      async: false,
                      success:  function (response) {
                        
                          if (nombre === response) {
                            reject('La tarjeta '+nombre+' ya esta registrada');
                          } else {
                              resolve();
                               if(response.includes("tarjeta agregada")){
                                  setTimeout(function() {
                                       swal({
                                          type: 'success',
                                          title: 'Listo',
                                          html: 'La tarjeta ha sido agregada'
                                        })
                                      }, 200)
                                  }
                                  else if(response.includes("ya existe")){
                                  setTimeout(function() {
                                       swal({
                                          type: 'warning',
                                          title: 'Error',
                                          html: 'La tarjeta ya esta registrada'
                                        })
                                      }, 200)
                                  }
                                  else{
                                      setTimeout(function() {
                                      swal({
                                      type: 'warning',
                                      title: 'Error',
                                      html: 'La tarjeta no pudo ser registrada.<br> Error: '+response
                                    })
                                      
                                       }, 200)
                                  }
                            
                          }
                          
                      }
              });
              

            }, 1000)
          })
        },
        allowOutsideClick: false
      }).then(function (numero) {
        llenar_combo_tarjetas();
      })
});

var options = {
  url: function(phrase) {
    return "ver_tarjetas_banco.php?nombre="+phrase;
  },
  getValue: function(element) {
    return element.name;
  },
  theme: "plate-dark"
};
  $("#txt_tipo_banco").easyAutocomplete(options);

  var colonias = {
    url: function(phrase) {
      var cp=$("#txt_cp").val();
      return "ver_colonias.php?cp="+cp+"&nombre="+phrase;
    },
    getValue: function(element) {
      return element.name;
    },
    theme: "plate-dark",
    list: {
      maxNumberOfElements: 50,
      match: {
        enabled: true
      }
    },
  };
    $("#c_colonia").easyAutocomplete(colonias);

    var op_eventos = {
      url: function(phrase) {
        var usuario=$("#input_oculto").val();
        return "buscar_evento.php?usuario="+usuario+"&like="+phrase+"&anio=0";
      },
      getValue: function(element) {
        
        return element.name;
      },
      theme: "plate-dark",
      list: {
        maxNumberOfElements: 50,
        match: {
          enabled: true
        },
        onClickEvent: function() {
          var ID = $("#c_eventos_creados").getSelectedItemData().name;
          ver_detalle_eventos(ID);
      },
      },
      
    };
      $("#c_eventos_creados").easyAutocomplete(op_eventos);

      var op_eventos_modificar = {
        url: function(phrase) {
          var usuario=$("#input_oculto").val();
          return "buscar_evento.php?usuario="+usuario+"&like="+phrase+"&anio=0";
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
          
        },
        
      };
      $("#c_eventos_modificar").easyAutocomplete(op_eventos_modificar);

      var op_eventos_solicitudes = {
        url: function(phrase) {
          var usuario=$("#input_oculto").val();
          return "buscar_evento.php?usuario="+usuario+"&like="+phrase+"&anio=0";
        },
        getValue: function(element) {
          
          return element.name;
        },
        theme: "plate-dark",
        list: {
          onClickEvent: function() {
            var evento = $("#c_numero_evento").getSelectedItemData().name;
            ver_suma_sdp(evento);
          },
          maxNumberOfElements: 20,
          match: {
            enabled: true
          },
         
        },
        
      };
      $("#c_numero_evento").easyAutocomplete(op_eventos_solicitudes);

     
      var op_mis_eventos = {
        url: function(phrase) {
          var usuario=$("#input_oculto").val();
          return "buscar_evento.php?usuario="+usuario+"&like="+phrase+"&anio=0";
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
            var evento = $("#c_mis_eventos").getSelectedItemData().name;
            ver_solicitudes_por_evento(evento);
        },
        },
        
      };
      $("#c_mis_eventos").easyAutocomplete(op_mis_eventos);

/* NO BORRRAR, SE USARA EN UN FUTOURO CON EL INPUT DE AUTOCOMPLETE/////////
  var options2 = {
    url: function(phrase) {
      return "ver_nombre_evento.php";
    },
    getValue: function(element) {
      return element.name;
    },
    ajaxSettings: {
      dataType: "json",
      method: "POST",
      data: {
        dataType: "json"
      }
    },
    preparePostData: function(data) {
      var usuario=$('#label_user').html();
      var evento=$("#txt_evento_demo").val()
      var parametro=usuario+"#"+evento;
      data.phrase = parametro ;
      return data;
    },
    requestDelay: 10,
    list: {
      match: {
        enabled: true
      }
    },
    theme: "plate-dark"
  };
$("#txt_evento_demo").easyAutocomplete(options2);
	*/
  

  $('#btn_agregar_tarjeta').click(function(){
    var banco=$('#txt_tipo_banco').val();
    var numero=$('#txt_numero_tarjeta').val();
    var id_usuario=$('#c_usuarios').val();
    if(banco=="" || numero==""){
      generate('warning',"Ingrese los campos necesarios (Banco/# tarjeta");
    }
    else if(id_usuario=="vacio"){
      generate('warning',"Seleccione un usuario");
    }
    else{
      var datos={
        "banco": banco,
        "numero": numero,
        "id_usuario": id_usuario,

      };
      $.ajax({
        url:   'agregar_tarjeta.php',
        type:  'post',
        data: datos,
        success:  function (response) {
          if(response.includes("agregada")){
            generate('success', "La tarjeta ha sido agredada");
            llenar_combo_tarjetas();
          }
          else if(response.includes("ya existe")){
            generate('warning', "La tarjeta ya existe");
          }
          else{
           generate('error', "Ocurrio un error: "+response); 
          }
          
        }
      });
    }
  });

  $('#respuesta_tarjetas').delegate('.borrar_tarjeta', 'click', function(e){
    e.preventDefault();
    var id=$(this).attr('id');
      noty({
            text: '¿Realmente deseas eliminar la tarjeta?',
            type        : 'warning',
            dismissQueue: false,
            theme       : 'metroui',
            layout      : 'topCenter',  //bottomLeft
            buttons: [
              {addClass: 'btn btn-success', text: 'Si, eliminar', onClick: function($noty) {
                  // this = button element
                  // $noty = $noty element
                  //console.log($noty.$bar.find('input#example').val());
                  //ajax borrar user
                    
                    var parametros={
                      "id": id
                    }
                     $.ajax({
                        url:   "borrar_tarjeta.php",
                        type:  'post',
                        data: parametros,
                        success:  function (response) {
                          //console.log(response);
                          if(response.includes("eliminado")){
                            limpiar();
                            llenar_combo_tarjetas();
                            $noty.close();
                            generate("success","La tarjeta ha sido eliminada!!");
                          }
                          else{
                            $noty.close();
                            generate('error', "Ocurrio un error: "+response);
                          }
                        }
                      });


                  //
                  
                }
              },
              {addClass: 'btn btn-danger', text: 'Cancel', onClick: function($noty) {
                  $noty.close();
                 
                }
              }
            ]
          });
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
            noty({
                text        : "Selecciona un usuario de BBVA BANCOMER<p>"+response,
                width       : '650px',
                type        : 'warning',
                dismissQueue: false,
                closeWith   : ['backdrop'],
                theme       : 'metroui',
                timeout     : false,
                layout      : 'topCenter',
                 callbacks: {
                  afterShow: function() { },
                },
                 buttons: [
                  {addClass: 'btn btn-success', text: 'Aceptar', onClick: function($noty) {
                    var usuario=$noty.$bar.find('select').val();
                    var nombre_usuario=$noty.$bar.find('select option:selected').text();
                    if(usuario==""){
                      generate("warning", "Debe seleccionar un usuario");
                    }
                    else{
                      
                      $('#usuario_proveedor').html(nombre_usuario);
                      $('#id_usuario_proveedor').val(usuario);                      
                      $('.user_proveedor').fadeIn();
                      $noty.close();
                    }
                    }
                  },
                  {addClass: 'btn btn-danger', text: 'Cancelar', onClick: function($noty) {
                    $('#c_a_nombre').val('vacio'); 
                     $noty.close();
                    }
                  }
                 ]
              });
        }
      });
  }

$('#usuario_proveedor').click(function(e){
  e.preventDefault();
  ver_usuarios_bancomer();
});

function consultar_bitacora(){
  var usuario=$('#input_oculto').val();
  var datos={
      "usuario":usuario,
  };
  $.ajax({
    url:   'consultar_bitacora.php',
    type:  'post',
    data: datos,
    success:  function (response) {
      $('#resultado_bitacora').html(response);
      $('#resultado_bitacora').fadeIn();
    }
  });
}

function ver_numero_notificaciones(){
  var usuario=$('#input_oculto').val();
  var datos={
      "usuario":usuario,
  };
  $.ajax({
    url:   'ver_numero_notificaciones.php',
    type:  'post',
    data: datos,
    success:  function (response) {
      
      if(response.includes("ninguno")){
        if ( $('#notificaciones').is(':visible') ){
          if(response.includes("ninguno")){
            $('#badge_numero_notificaciones').html('');
          }
          else{
            $('#badge_numero_notificaciones').html(response);
          }
        }
        else{
          $('#badge_numero_notificaciones').hide();
          $('#notificaciones').show();
          $("#notificaciones").addClass("slower slideInDown animated").one('animationend webkitAnimationEnd oAnimationEnd', function() {
            $("#notificaciones").removeClass("slower slideInDown animated");
          });
        }
                
      }
      else{
        $('#notificaciones').show();
        $('#notificaciones').css("right","0px");
        $("#notificaciones").addClass("slower tada animated").one('animationend webkitAnimationEnd oAnimationEnd', function() {
          $("#notificaciones").removeClass("slower tada animated");
        });
        $('#notificaciones').css("right","-350px");
        $("#audio_ding")[0].play(); //dee usarse dentro del click de un boton
        $('#badge_numero_notificaciones').html(response);
      }
    }
  });
}

function updateReloj() {

  if (contador_tiempo == 0) {
    ver_numero_notificaciones();
    contador_tiempo=120;
  } 
  else {
    contador_tiempo -= 1;
  
      setTimeout(updateReloj, 1000);
  }
  //window.onload = updateReloj;
}

$('#resultado_bitacora').delegate('.btn_notificacion', 'click', function(){
  var id=$(this).attr('id');
  var datos={
      "id":id,
  };
  $.ajax({
    url:   'consultar_mensaje_bitacora.php',
    type:  'post',
    data: datos,
    success:  function (response) {
      
      $('#mensaje_notificacion').html(response);
      $("#modal_notificacion").modal({
        fadeDuration: 100
      });
    }
  });
  
});

$('#modal_notificacion').on($.modal.CLOSE, function(event, modal) {
  
  $('#btn_notificaciones').show();
  $('#btn_cerrar_bitacora').hide();
  $('#resultado_bitacora').html("");
  $('#resultado_bitacora').fadeOut();
  ver_numero_notificaciones();
});

$('#tarjetas_resultado').delegate('.btn-ver-movimientos', 'click', function(){
  var tarjeta=$(this).attr('id');
  var datos={
      "tarjeta":tarjeta,
  };
  $.ajax({
    url:   'consultar_movimientos.php',
    type:  'post',
    data: datos,
    success:  function (response) {
      
      $('#resultado_modal_movimientos').html(response);
      $("#modal_ver_movimientos").modal({
        fadeDuration: 100
      });
    }
  });
});

$('#tarjetas_resultado').delegate('.btn-aplicar-cargo', 'click', function(){
  var componente=$(this).attr("id");
  var importe=$('.'+componente).val();
  var res=componente.split("_");
  var id=res[1];
  var datos={
      "importe":importe,
      "id":id,
  };
  
  $.ajax({
    url:   'aplicar_cargo.php',
    type:  'post',
    data: datos,
    success:  function (response) {
      if(response.includes("éxito")){
        generate("success", "El cargo se ha aplicado");
        $('.filas_ocultas').fadeOut();
      }
      else{
        generate("warning", "Error: "+response);
      }
    }
  });
});

$('#tarjetas_resultado').delegate('.operaciones_tarjeta', 'change', function(){
  var arr=$(this).val();
  var res = arr.split("_");
  var consulta=res[0];
  var tarjeta=res[1];
  var datos={
      "tarjeta":tarjeta,
  };
  $('.filas_ocultas').fadeOut();
  if(consulta.includes("cargos")){
    $.ajax({
      url:   'agregar_abono.php',
      type:  'post',
      data: datos,
      success:  function (response) {
          
       $('.'+tarjeta).html(response);
       $('.'+tarjeta).fadeIn();
       $('.operaciones_tarjeta').val("vacio");
      }
    });
  }
  else if(consulta.includes("devoluciones")){
    $.ajax({
      url:   'ver_devoluciones.php',
      type:  'post',
      data: datos,
      success:  function (response) {
       
       $('.'+tarjeta).html(response);
       $('.'+tarjeta).fadeIn();
       $('.operaciones_tarjeta').val("vacio");
      }
    });
  }
  else if(consulta.includes("movimientos")){
    $.ajax({
      url:   'consultar_movimientos.php',
      type:  'post',
      data: datos,
      success:  function (response) {
        //fila vacia abajo del combo
       $('.'+tarjeta).html(response);
       $('.'+tarjeta).fadeIn();
       $('.operaciones_tarjeta').val("vacio");
      }
    });

  }
});

$('#tarjetas_resultado').delegate('.btn-aplicar-devolucion', 'click', function(){
  var componente=$(this).attr("id"); //id button importe_2472 --> importe_2472
  var minimo=$(this).attr("name");
  //var minimo=$('.'+componente).attr('id'); //class importe_2472 input --> 3000
  var valor=$('#btn_'+componente).val();  //valor introducido input 
  //alert("valor minimo:"+minimo);
  //alert("valor ingresado:"+valor);
  if(valor=="" || valor=="0.0" || valor=="0"){
    $('#'+minimo).val('0.0');
    $('#'+minimo).css("border","2px solid red");
    generate("warning", "Ingrese un monto a devolver");
  }
  else if(minimo<valor){
    $('#'+minimo).val('0.0');
    $('#'+minimo).css("border","2px solid red");
    generate("warning", "El monto a devolver no puede ser mayor al solicitado");
  }
  else{
   var res=componente.split("_");
   var id=res[1];
   var tarjeta=res[2];
  var datos={
    "valor":valor,
    "id":id,
    "tarjeta":tarjeta,
};
    $.ajax({
      url:   'aplicar_devolucion.php',
      type:  'post',
      data: datos,
      success:  function (response) {
        if(response.includes("éxito")){
          generate("success", "La devolución se ha generado");
          $('.filas_ocultas').fadeOut();
        }
        else{
          generate("warning", "Error: "+response);
        }
        
      }
      
    });
  }
});

$('#tarjetas_resultado').delegate('.txt_importe', 'focusin', function(){
    $(this).css("border","1px solid #ccc");
});


$(window).scroll(function () {
  
  if ($(this).scrollTop() > 50) {
      $('#spnTop').fadeIn();
  } else {
      $('#spnTop').fadeOut();
  }
});

$('#spnTop').click(function (e) {
  e.preventDefault();
  
  var percentageToScroll = 100;
  var percentage = percentageToScroll/100;
  var height = $(document).scrollTop();
  var scrollAmount = height * (1 - percentage);

   $('html,body').animate({ scrollTop: scrollAmount }, 'slow', function () {
    $('#spnTop').fadeOut('hide');
   });

  });

  $("#menu_prealta").click(function (e) { 
    e.preventDefault();
    limpiar_cortinas();
    $("#div_cortina").animate({top: '0px'}, 1100);
    $("#frame").attr("src", "pre_alta.html");
    $('#div_iframe').fadeIn();
  });

$("#menu_bloqueo_prov").click(function (e) { 
  e.preventDefault();
  limpiar_cortinas();
  $("#div_cortina").animate({top: '0px'}, 1100);
  $('#div_iframe').fadeIn();
  $("#frame").attr("src", "bloqueo_proveedores.html");
});

$("#btn_rep_gastos").click(function (e) { 
  e.preventDefault();
  limpiar_cortinas();
  $("#div_cortina").animate({top: '0px'}, 1100);
  $("#frame").attr("src", "grafica_gastos.html");
  $('#div_iframe').fadeIn();
});

$(".btn_archivos").change(function(){
  if($("#ul_archivos").html()!=""){
    var id=$(this).attr("id");
    var nombre=$('#txt_nombre_cliente').val();
    switch(id){
      case "file_csf":
        guardar_archivos_proveedores_ine(nombre.trim());
      break;
      case "file_ine":
        guardar_archivos_proveedores_csf(nombre.trim());
      break;
      case "file_edo":
        guardar_archivos_proveedores_edo(nombre.trim());
      break;
      case "file_comp":
        guardar_archivos_proveedores_comp(nombre.trim());
      break;
      case "file_acta":
        guardar_archivos_proveedores_acta(nombre.trim());
      break;
    }
    var carpeta=$('#txt_nombre_cliente').val();
    limpiar_cliente();
    ver_archivos('ca');
    generate("success","Archivo subido correctamente");
  }
});
 


  
  


}
