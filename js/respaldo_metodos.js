function inicio(){
   $('.buttonText:eq(0)').html('RFC');
   $('.buttonText:eq(1)').html('INE');
   $('.buttonText:eq(2)').html('ACTA');
   $('.buttonText:eq(3)').html('EDO. CTA.');
  ver_usuarios_registrados();
  ver_usuarios_diseño();
  ver_usuarios_produccion();
  ver_usuarios_ejecutivos();
  ver_usuarios_digitales();
  ver_usuarios_solicitantes();
  ver_clientes();
  ver_solicitudes_clientes("true", "cliente");
  ver_numero_evento(); // count # eventos creados

  var expRegEmail=/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;
  var pat_clabe=/^[0-9]{18}$/;

  ver_bancos();


  $('.container').hide();
  $('#div_login').show();

  $("#file_rfc").filestyle('buttonText', 'RFC de la empresa');


	 $('#puntos_gif').hide();
	 $( "#txt_fecha_inicio_evento").datepicker({ dateFormat: 'yy-mm-dd' });
	 $( "#txt_fecha_final_evento").datepicker({ dateFormat: 'yy-mm-dd' });
	 $( "#f_solicitud").datepicker({ dateFormat: 'yy-mm-dd' });
	 $( "#f_pago").datepicker({ dateFormat: 'yy-mm-dd' });
	 $( "#odc_fecha").datepicker({ dateFormat: 'yy-mm-dd' });

	var cliente="";

 /* function ocultar(nombre){
    //$('.container').hide()
    $('.container').addClass('animated zoomOutDown').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $('.container').hide();
        nombre.removeClass('animated zoomOutDown').addClass('animated zoomInUp').show();  
    });    
    
            
  }*/

  function generate(type, text) {

            var n = noty({
                text        : text,
                type        : type,
                dismissQueue: true,
                layout      : 'bottomLeft',
                //closeWith   : ['button'],
                theme       : 'metroui',
                progressBar : true,
                maxVisible  : 5,
                timeout     : [3000],
                /*animation   : {
                    open  : 'animated slideInDown',
                    close : 'animated slideOutUp',
                    easing: 'swing',
                    speed : 100
                }*/
            });
            //console.log('html: ' + n.options.id);
            return n;
        }

       
  $('#load2').hide();
  $('#load_prov').hide();
  $('#nav').hide();
  
  /*
	$('#nav').hide();
	$('#div_nuevo_evento').hide();

	$('#div_odc').hide();*/
  $('#borrar_usuario').hide();


	$('#c_cliente').change(function(){
    if($(this).val()!="vacio"){
      $('#txt_nombre_evento').attr("readonly", false);
    }
    else{
      $('#txt_nombre_evento').val("");
      $('#txt_nombre_evento').attr("readonly", true);
    }		
	});


	$('#entrar').click(function(){
		var user=$('#user').val();
		var pass=$('#pass').val();
		if(user=="" || pass==""){
      generate('warning', "El usuario o contraseña no deben ir vacios");
		}
		else{
		log(user, pass);
		}
	});

  $('#pass').keypress(function(e){
    if(e.which == 13) {
      var user=$('#user').val();
      var pass=$('#pass').val();
      if(user=="" || pass==""){
        generate('warning', "El usuario o contraseña no deben ir vacios");
      }
      else{
      log(user, pass);
      }
    }
  });

	function log(user, pass){
		var parametros = {
                  "user": user,
                  "pass": pass,
          };                  
          $.ajax({
                  data: parametros,
                  url:   'loguin.php',
                  type:  'post',
                  beforeSend: function(  ) {
                  	$('#entrar').html("<img src='img/puntos.gif'>");
        				  },
                  success:  function (response) {
                    
                    $('#entrar').html("Entrar");
                    if(response.includes("No existe") || response.includes("Error de conexion")){
                      $('#pass').val("");
                      generate('warning', "El usuario y/o contraseña no son correctos");
                    }
                    else if(response.includes("Cambio de pass")){
                        swal({
                            title: "Ingresa una nueva contraseña",
                            input: 'password',
                            showCancelButton: true,
                            confirmButtonText: 'Enviar',
                            showLoaderOnConfirm: true,
                            preConfirm: function (password) {
                              return new Promise(function (resolve, reject) {
                                setTimeout(function() {
                                  if (password === '') {
                                    reject('La contraseña no puede ir vacia')
                                  } else {
                                    actualizar_contraseña(user, password);
                                    
                                  }
                                }, 1000)
                              })
                            },
                            allowOutsideClick: false
                          });
                    }
                    else{
                       var arr=response.split("#");
                       $("#div_login").fadeOut("swing", function() {
  						        //$('#div_nuevo_evento').fadeIn();
  					           });
                        $('#load').show();
                        $('#nav').show();
                        $('#entrar').html("Entrar");
                        var nombre_usuario=arr[1];
                        if(nombre_usuario.startsWith(" ")){
                          nombre_usuario=substring(1, nombre_usuario.length);
                        }
                        console.log(nombre_usuario);
                        $('#label_user').html(nombre_usuario+" ");
                        $('#input_oculto').val(arr[2]);
                        var tipo="";

                        switch(arr[2]){
                          case "EJE":
                            tipo="Ejecutivo de cuenta";
                            break;
                          case "JEFE":
                            tipo="Jefe";
                            break;
                          case "ADM":
                            tipo="Administrador";
                          break;
                          case "SOL":
                            tipo="Solicitante";
                          break;
                          case "EJE":
                            tipo="Ejecutivo de cuenta";
                          break;
                          case "CXP":
                            tipo="Cuentas por pagar";
                          break;                   
                          case "DIG":
                            tipo="Digital";
                          break;       
                          case "PRO":
                            tipo="Productor";
                          break;
                          case "DIS":
                            tipo="Diseño";
                          break;
                          default:
                          tipo="---";
                          break;
                        }
                        $('#tipo_perfil').html(tipo);
                        switch(arr[2]){
                          case "ADM":
                            $('.solo_admin').show();
                            $('#guardar_cliente').show();
                            $('#nav_catalogos').show();
                            $('#div_clientes_registrados').show();
                            $('#existentes').show();
                            $('#btn_modificar_evento').show();
                            //$('#btn_crear_evento').hide();
                            break;
                          default:
                          $('.solo_admin').hide();
                            $('#enviar_solicitud_cliente').show();
                            $('#guardar_cliente').hide();
                            $('#div_clientes_registrados').show();
                            $('#existentes').hide();
                            $('#btn_modificar_evento').hide();
                            //$('#btn_crear_evento').hide();
                          break;
                        }
                    }
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
            console.log(response);
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
    console.log("Date changed: ", e.target.value);
});

    $('#odc_cheque_por').focusout(function(){
    	var numero=$(this).val();
    	$('#odc_label_letra').html(NumeroALetras(numero));
    	$('#puntos_gif').hide();
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

    function ver_usuarios_diseño(){//obtener los usuarios registrados

    $.ajax({
          url:   'ver_usuarios_disenio.php',
          type:  'post',
          success:  function (response) {
              $('#c_disenio').html(response);
          }
    });
  }
  function ver_usuarios_produccion(){//obtener los usuarios registrados

    $.ajax({
          url:   'ver_usuarios_produccion.php',
          type:  'post',
          success:  function (response) {
              $('#c_produccion').html(response);
          }
    });
  }

   function ver_usuarios_ejecutivos(){//obtener los usuarios registrados

    $.ajax({
          url:   'ver_usuarios_ejecutivos.php',
          type:  'post',
          success:  function (response) {
              $('#c_ejecutivos').html(response);
          }
    });
  }

  function ver_usuarios_digitales(){//obtener los usuarios registrados

    $.ajax({
          url:   'ver_usuarios_digital.php',
          type:  'post',
          success:  function (response) {
              $('#c_digital').html(response);
          }
    });
  }
  function ver_usuarios_solicitantes(){//obtener los usuarios registrados

    $.ajax({
          url:   'ver_usuarios_solicitantes.php',
          type:  'post',
          success:  function (response) {
              $('#c_solicitantes').html(response);
          }
    });
  }

    function ver_usuarios_registrados(){//obtener los usuarios registrados

    $.ajax({
          url:   'ver_usuarios.php',
          type:  'post',
          success:  function (response) {
             var arr=response.split("#");
              $('.combo_usuarios').html(arr[1]);
          }
    });
  }

  function ver_clientes(){//obtener los usuarios registrados

    $.ajax({
          url:   'ver_clientes.php',
          type:  'post',
          success:  function (response) {
             var arr=response.split("#");
              $('.combo_clientes').html(arr[1]);
          }
    });
  }
  function ver_solicitudes_clientes(ban, tipo){//obtener los usuarios registrados
    console.log(tipo);
    var link="";
    if(tipo.includes("clien")){
      link='ver_solicitud_clientes.php';
    }
    else{
      link='ver_solicitud_proveedores.php'
    }
    var parametros = {
                  "bandera": ban,
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

    $.ajax({
          url:   'ver_numero_evento.php',
          type:  'post',
          success:  function (response) {
              $('#txt_numero_evento').val(response);
          }
    });
  }

  $("#c_usuarios").change(function(){
      if($(this).val()!=""){
        var valor=$(this).val().split("&");
        $('#borrar_usuario').show();
        var parametros={
          "id": valor[0]
        }
        $.ajax({
            url:   'ver_detalle_usuarios.php',
            type:  'post',
            data: parametros,
            success:  function (response) {
             var arr=response.split("#");
             var arr2=arr[1].split("&");
             $('#txt_nombre_usuario').val(arr2[0]);
             $('#txt_username').val(arr2[1]);
             $('#txt_password').val(arr2[2]);
             $('#txt_email_usuario').val(arr2[4]);
             $('#agregar_usuario').html('<i class="i_espacio fa fa-floppy-o" aria-hidden="true"></i>Modificar Usuario');
             switch(arr2[3]){
              case "ADM":
                $('#c_tipo_usuario option:nth(1)').prop("selected","selected");
                break;
              case "DIS":
                $('#c_tipo_usuario option:nth(2)').prop("selected","selected");
                break;
              case "PRO":
                $('#c_tipo_usuario option:nth(3)').prop("selected","selected");
                break;
              case "DIG":
                $('#c_tipo_usuario option:nth(4)').prop("selected","selected");
                break;
              case "SOL":
                $('#c_tipo_usuario option:nth(5)').prop("selected","selected");
                break;
              case "CXP":
                $('#c_tipo_usuario option:nth(6)').prop("selected","selected");
                break;
              case "JEFE":
                $('#c_tipo_usuario option:nth(7)').prop("selected","selected");
                break;

             }
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
            console.log(link);
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

                  generate('warning', "Ese username ya existe. Por favor elija otro username");
                }
                else if(response.includes("usuario modificado")){
                   limpiar();
                  ver_usuarios_registrados();
                  generate('success', "El usuario se ha modificado correctamente.");

                }
                else{
                  //console.log(response);
                  generate('error', "Ocurrio un error en el proceso. Vea la consola para más detalles");
                }
              }
            });

         }
       });

        $('#borrar_usuario').click(function(){
          var id=$('c_usuarios').val();
          var parametros={
            "id": id
          }
           $.ajax({
              url:   "borrar_usuario.php",
              type:  'post',
              data: parametros,
              success:  function (response) {
                if(response.includes("usuario eliminado")){
                  limpiar();
                  ver_usuarios_registrados();
                  generate('success', "El usuario se ha dado de baja correctamente.");
                }
                else{
                  //console.log(response);
                  generate('error', "Ocurrio un error en el proceso. Vea la consola para más detalles");
                }
              }
            });

        });

        function validar_crear_evento(){
            // Campos de texto
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
            if($("#c_disenio").val() == ""){
            generate('warning', "Debe elegir quien diseña el evento");
                return false;
            }
            if($("#c_produccion").val() == ""){
            generate('warning', "Debe elegir quien produce el evento");
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

            return true; // Si todo está correcto
        }

        $('#btn_crear_evento').click(function(event){
          event.preventDefault();
          if(validar_crear_evento()){
            // se manda ajax para insertar el evento
            var datos = $('#form_nuevo_evento').serializeArray();
            datos.push({name: 'usuario_registra', value: $('#label_user').html()});
            $.ajax({
              url:   "crear_evento.php",
              type:  'post',
              data:  datos,
              success:  function (response) {
                if(response.includes("Evento creado correctamente")){
                  $('#form_nuevo_evento')[0].reset();
                  generate('success',response);
                  ver_numero_evento();
                  ver_eventos();
                }
                else{
                  console.log(response);
                 generate('error', "ocurrio un error, consulte la consola para más detalles."); 
                }
              }
            });
          }
        });

        $('#menu_crear_evento').click(function(e){
          e.preventDefault();
          $("#div_cortina").animate({top: '-800px'});
          ver_eventos();
          ver_numero_evento();
          //ocultar($('#div_nuevo_evento'));  
          //$('#yourElement').addClass('animated bounceOutLeft');
        
           $('#div_nuevo_evento').fadeIn();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $("#div_cortina").animate({top: '0px'});  
           //$('#btn_modificar_evento').hide();
        });

        

        $('#menu_solicitud_odc').click(function(e){   
        $("#div_cortina").animate({top: '-800px'});     
          e.preventDefault();
          ver_eventos();
          ver_proveedores();
          $('#titulin').html("Solicitud de pago");
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeIn();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $("#div_cortina").animate({top: '0px'});     
        });
        $('#menu_solicitud_viaticos').click(function(e){
          $("#div_cortina").animate({top: '-800px'});
          e.preventDefault();
          ver_eventos();
          ver_proveedores_usuarios();
          $('#titulin').html("Solicitud de viáticos");
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeIn();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $("#div_cortina").animate({top: '-0px'});
        });
        $('#menu_solicitud_reembolso').click(function(e){
          $("#div_cortina").animate({top: '-800px'});
          e.preventDefault();
          ver_eventos();
          ver_proveedores_usuarios();
          $('#titulin').html("Solicitud de reembolso");
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeIn();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $("#div_cortina").animate({top: '-0px'});
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

        function ver_proveedores_usuarios(){
            $.ajax({
              url:   "ver_proveedores_usuarios.php",
              type:  'post',
              success:  function (response) {
                $('#c_a_nombre').html(response);
              }
            });
        }


         $('#menu_solicitud_prov').click(function(e){
          $("#div_cortina").animate({top: '-800px'});
           e.preventDefault();
           limpiar_cliente();
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeIn();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#titulo_alta').html("Solicitud de alta de proveedor");
           $("#check_solicitud_pendientes:checked").prop('checked', false);
           $('#form_alta_proveedores').show();
           ver_solicitudes_clientes("false", "proveedores");
           $("#div_cortina").animate({top: '-0px'});
        });

          $('#menu_solicitud_cliente').click(function(e){
          $("#div_cortina").animate({top: '-800px'});
          e.preventDefault();
          limpiar_cliente();
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeIn();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $('#titulo_alta').html("Solicitud de alta de cliente");
           $("#check_solicitud_pendientes:checked").prop('checked', false);
           ver_solicitudes_clientes("false", "clientes");
           $('#form_alta_proveedores').hide();
           $("#div_cortina").animate({top: '-0px'});
        });
          $('#menu_ver_formatos').click(function(e){
          e.preventDefault();
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeIn();
           ver_mis_eventos();
           $('#div_solicitudes').fadeOut();
        });

          //catlogos
          $('#usuarios').click(function(e){
            $("#div_cortina").animate({top: '-800px'});
          e.preventDefault();
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeIn();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $("#div_cortina").animate({top: '-0px'});
        });

          $('#clientes').click(function(e){
            $("#div_cortina").animate({top: '-800px'});
          e.preventDefault();
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeIn();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $("#div_cortina").animate({top: '-0px'});
        });

          $('#proveedores').click(function(e){
            $("#div_cortina").animate({top: '-800px'});
          e.preventDefault();
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeIn();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeOut();
           $("#div_cortina").animate({top: '-0px'});
        });

           $('#solicitudes').click(function(e){
            $("#div_cortina").animate({top: '-800px'});
          e.preventDefault();
           $('#div_nuevo_evento').fadeOut();       
           $('#div_usuarios').fadeOut();
           $('#div_alta_cliente').fadeOut();
           $('#div_odc').fadeOut();
           $('#div_alta_proveedores').fadeOut();
           $('#div_formatos').fadeOut();
           $('#div_solicitudes').fadeIn();
           $("#div_cortina").animate({top: '-0px'});
        });


        $('#check_solicitud_pendientes').click(function(e){
          $('input[type=file]').addClass('filestyle');
          var tipo="";
          if($('#titulo_alta').html().includes("cliente")){
            tipo="clientes";
          }
          else{
            tipo="proveedores"
          }
          if($(this).is(':checked')){
            $('#load2').show();
            ver_solicitudes_clientes("true", tipo);  
            $('#load2').hide();  
          }
          else{
            $('#load2').show();
            ver_solicitudes_clientes("false", tipo);    
            $('#load2').hide();
          }          
          
        });

        $('#check_pendientes_proveedores').click(function(e){
          if($(this).is(':checked')){
            $('#load_prov').show();
            ver_solicitudes_proveedores("false");    
            $('#load_prov').hide();
          }
          else{
            $('#load_prov').show();
            ver_solicitudes_proveedores("true");    
            $('#load_prov').hide();
          }
        });


        ////metodo para enviar archivos mediante ajax
      

        $("#enviar_solicitud_cliente").click(function(e){
          e.preventDefault();
          var tipo="";
          var pasa=false;
          var titulo=$('#titulo_alta').html();
          var cliente=$('#txt_nombre_cliente').val();
          var metodo=$('#c_metodo_pago').val();
          var rfc=$('#txt_rfc').val();
          var digitos=$('#digitos').val();
          var calle=$('#txt_calle').val();
          var ext=$('#txt_num_ext').val();
          var int=$('#txt_num_int').val();
          var colonia=$('#txt_colonia').val();
          var cp=$('#txt_cp').val();
          var tel=$('#txt_telefono').val();
          var estado=$('#c_estado').val();
          var municipio=$('#txt_municipio').val();
          var nombre_contacto=$('#txt_nombre_contacto').val();
          var correo_contacto=$('#txt_correo_contacto').val();
          var usuario_solicita=$('#label_user').html();
          var archivo1=$('#rfc').val();
          var archivo2=$('#ine').val();
          var archivo3=$('#acta').val();
          var archivo4=$('#estado').val();
          var cuenta=$('#txt_cuenta_bancaria').val();
          var clabe=$('#txt_clabe').val();
          var banco=$('#c_bancos').val();

          if(titulo.includes("clien")){
            tipo="clientes";
            cuenta == "vacio";
            clabe == "vacio";
            banco == "vacio";
            }
          
          if(cliente == ""){
            generate('warning', "Debe ingresar un cliente");
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
          else if(calle == ""){
            generate('warning', "Debe ingresar el nombre de la calle");
                pasa=false;
          }
          else if(ext == ""){
            generate('warning', "Debe ingresar el número del domicilio");
                pasa=false;
          }
          else if(colonia == ""){
            generate('warning', "Debe ingresar el nombre de la colonia");
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
          else if(archivo1 == "" ){
            generate('warning', "Debe ingresar un archivo del RFC válido");
                pasa=false;
          }
          else if(archivo2 == "" ){
            generate('warning', "Debe ingresar un archivo del INE del apoderado legal");
                pasa=false;
          }
          else if(archivo3 == "" ){
            generate('warning', "Debe ingresar un archivo del Acta Constitutiva");
                pasa=false;
          }
          else if(archivo4 == "" ){
            generate('warning', "Debe ingresar un archivo del estado de cuenta");
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
          else if(banco == ""){
            generate('warning', "Debe seleccionar un banco");
                    pasa=false;
          }
          else {
            pasa=true;
          }

         

          if(pasa==true){ // si todos los campos son correctos, se manda a php
            var datos = {
              "cliente": cliente,
              "metodo": metodo,
              "rfc": rfc,
              "digitos": digitos,
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
              "blanco": banco,
              "tipo": tipo,

            };
            $.ajax({
              url:   "alta_clientes.php",
              type:  'post',
              data:  datos,
               beforeSend: function(){
                $('#enviar_solicitud_cliente').html("<img src='img/puntos.gif'>");
               },
              success:  function (response) {
                //console.log(response);
                if(response.includes("solicitud enviada")){
                  generate('success', "La solicitud se ha registrado!!"); 
                  enviar_alta_cliente(cliente, rfc, nombre_contacto, correo_contacto, usuario_solicita, tipo);
                  $('#enviar_solicitud_cliente').html('<i class="i_espacio fa fa-envelope-o" aria-hidden="true"></i>Enviar Solicitud');
                }
                else{
                  console.log(response);
                  $('#enviar_solicitud_cliente').html('<i class="i_espacio fa fa-envelope-o" aria-hidden="true"></i>Enviar Solicitud');
                 generate('error', "ocurrio un error, consulte la consola para más detalles."); 
                }
                
                
              }
            });
          }
        });

        function enviar_alta_cliente(nombre_cliente, nombre_rfc, nombre_contacto, email_contacto, usuario_solicita, tipo){
          console.log("enviando mail...");
          var rfc = document.getElementById('rfc');
          var file1 = rfc.files[0];
          var ine = document.getElementById('ine');
          var file2 = ine.files[0];
          var acta = document.getElementById('acta');
          var file3 = acta.files[0];
          var estado = document.getElementById('estado');
          var file4 = estado.files[0];
          var data = new FormData();
          data.append('archivo1',file1);
          data.append('archivo2',file2);
          data.append('archivo3',file3);
          data.append('archivo4',file4);
          data.append('nombre_cliente',nombre_cliente);
          data.append('nombre_rfc',nombre_rfc);
          data.append('nombre_contacto',nombre_contacto);
          data.append('email_contacto',email_contacto);
          data.append('usuario_solicita',usuario_solicita);
          data.append('tipo',tipo);
          $.ajax({
              url: 'enviar_mail.php',
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                type: 'POST',
              success:  function (response) {
                console.log("respuesta: "+response);
                if(response.includes("Enviado")){
                  $('#enviar_solicitud_cliente').html("<i class='i_espacio fa fa-envelope-o' aria-hidden='true'></i>Enviar Solicitud");
                  limpiar_cliente();
                  generate('success',"La soliciutid ha sido enviada!!");
                }
                else{
                  generate('warning',"Ocurrio un error al enviar la notificación por correo");
                }
              }
            });
        }

        $('#limpiar_cliente').click(function(){
           
          limpiar_cliente();
        });

        function limpiar_cliente(){
          $('#txt_nombre_cliente').val('');
                  $('#c_metodo_pago :nth-child(1)').prop('selected', true);
                  //$("#c_metodo_pago option[value='vacio']").attr("selected", true);
                  $('#txt_rfc').val('');
                  $('#digitos').val('');
                  $('#txt_calle').val('');
                  $('#txt_num_ext').val('');
                  $('#txt_num_int').val('');
                  $('#txt_colonia').val('');
                  $('#txt_cp').val('');
                  $('#txt_telefono').val('');
                  $("#c_estado").val('vacio');
                  $('#txt_municipio').val('');
                  $('#txt_nombre_contacto').val('');
                  $('#txt_correo_contacto').val('');
                  $("#rfc").filestyle('clear');
                  $("#ine").filestyle('clear');
                  $("#acta").filestyle('clear');
                  $("#estado").filestyle('clear');
                  $('#txt_cuenta_bancaria').val('');
                  $('#txt_clabe').val('');
                  $('#c_bancos').val('');
        }
        
        function ver_eventos(){
          var usuario=$('#label_user').html();
          var datos={
            "usuario": usuario,
          }
          $.ajax({
              url:   "ver_eventos2.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                console.log(response);
                $('#c_numero_evento').html(response);
                $('#c_eventos_creados').html(response);
              }
            });
        }

        function ver_mis_eventos(){
          var usuario=$('#label_user').html();
          var datos={
            "usuario": usuario,
          }
          $.ajax({
              url:   "ver_eventos2.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                //console.log(response);
                //var option='<option value="vacio">Selecciona un evento...</option>';
                $('#c_mis_eventos').html(response);
              }
            });
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
                //console.log(response);
                $('#resultado_solicitudes').html(response);
               
              }
            });
        }

           $("#resultado_solicitudes").delegate(".check_pagado", "click", function() {
            if($('#input_oculto').val()=="CXP"){
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

           $("#resultado_solicitudes").delegate(".btn_factura", "click", function() {
            if($('#input_oculto').val()=="CXP"){
            var id=$(this).val();
            var evento=$('#c_mis_eventos').val();
            var id=this.id;
            swal({
              title: "Modificar factura",
              text: "Ingresa el número de la nueva factura",
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
                                        else{
                                            setTimeout(function() {
                                            swal({
                                            type: 'warning',
                                            title: 'Error',
                                            html: 'La factura '+numero+' no pudo ser registrada.<br> Revise la consola para mas detalles'
                                          })
                                            console.log(response);
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
                    console.log(response);
                    generate('error',"Ocurrio un error. Vea la consola para mas detalles");
                  }
                  ver_solicitudes_por_evento(evento)
                }
              });
           }

            $("#resultado_solicitudes").delegate(".check_comp", "click", function() {
              if($('#input_oculto').val()=="CXP"){
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
                    console.log(response);
                    generate('error',"Ocurrio un error. Vea la consola para mas detalles");
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
                //console.log(response);
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
        $('#c_mis_eventos').change(function(){
          var evento=$('#c_mis_eventos').val();
          var usuario=$('#label_user').html();
          if(evento=="vacio"){
          }
          else{
            ver_mis_solicitudes();
            ver_solicitudes_por_evento(evento);
            //$('#div_mis_solicitudes').fadeIn();
          }
        });


        $('#c_clientes_alta').change(function(){
          var arr=$(this).val().split("&");
          var id=arr[0];
          if(id=="vacio"){
          }
          else{
            ver_datos_clientes(id);
          }
        });

        function ver_datos_clientes(id){
          var datos={
            "id": id,
          }
          $.ajax({
              url:   "ver_datos_clientes.php",
              type:  'post',
              data: datos,
              dataType: "json",
              success:  function (response) {
                $('#txt_nombre_cliente').val(response.nombre);
                //$("#c_metodo_pago option[value='"+response.metodo_pago+"']").attr("selected", true);
                
                if(response.metodo_pago.includes("03")){
                  $('#c_metodo_pago :nth-child(2)').prop('selected', true);
                }
                else if(response.metodo_pago.includes("02")){
                  $('#c_metodo_pago :nth-child(3)').prop('selected', true); 
                }
                else{
                  $('#c_metodo_pago :nth-child(4)').prop('selected', true);
                }
                //$("#c_metodo_pago option[value='"+response.metodo_pago+"']").attr("selected", true);
                //$("#c_metodo_pago select").val();
                //$("#c_metodo_pago").val(response.metodo_pago).change();
                $('#txt_rfc').val(response.rfc);
                $('#digitos').val(response.digitos);
                $('#txt_calle').val(response.calle);
                $('#txt_num_ext').val(response.ext);
                $('#txt_num_int').val(response.int);
                $('#txt_colonia').val(response.colonia);
                $('#txt_cp').val(response.cp);
                $('#txt_telefono').val(response.telefono);
                $('#txt_municipio').val(response.municipio);

                switch(response.estado){
                  case "EXTRANJERO":
                  $('#c_estado :nth-child(2)').prop('selected', true);
                  break;
                  case "AGUASCALIENTES":
                  $('#c_estado :nth-child(4)').prop('selected', true);
                  break;
                  case "BAJA CALIFORNIA":
                  $('#c_estado :nth-child(5)').prop('selected', true);
                  break;
                  case "BAJA CALIFORNIA SUR":
                  $('#c_estado :nth-child(6)').prop('selected', true);
                  break;
                  case "CAMPECHE":
                  $('#c_estado :nth-child(7)').prop('selected', true);
                  break;
                  case "CIUDAD DE MEXICO":
                  $('#c_estado :nth-child(8)').prop('selected', true);
                  break;
                  case "COAHUILA":
                  $('#c_estado :nth-child(9)').prop('selected', true);
                  break;
                  case "COLIMA":
                  $('#c_estado :nth-child(10)').prop('selected', true);
                  break;
                  case "CHIAPAS":
                  $('#c_estado :nth-child(11)').prop('selected', true);
                  break;
                  case "CHIHUAHUA":
                  $('#c_estado :nth-child(12)').prop('selected', true);
                  break;
                  case "DURANGO":
                  $('#c_estado :nth-child(13)').prop('selected', true);
                  break;
                  case "ESTADO DE MEXICO":
                  $('#c_estado :nth-child(14)').prop('selected', true);
                  break;
                  case "GUANAJUATO":
                  $('#c_estado :nth-child(15)').prop('selected', true);
                  break;
                  case "GUERRERO":
                  $('#c_estado :nth-child(16)').prop('selected', true);
                  break;
                  case "HIDALGO":
                  $('#c_estado :nth-child(17)').prop('selected', true);
                  break;
                  case "JALISCO":
                  $('#c_estado :nth-child(18)').prop('selected', true);
                  break;
                  case "MICHOACAN":
                  $('#c_estado :nth-child(19)').prop('selected', true);
                  break;
                  case "MORELOS":
                  $('#c_estado :nth-child(20)').prop('selected', true);
                  break;
                  case "NAYARIT":
                  $('#c_estado :nth-child(21)').prop('selected', true);
                  break;
                  case "NUEVO LEON":
                  $('#c_estado :nth-child(22)').prop('selected', true);
                  break;
                  case "OAXACA":
                  $('#c_estado :nth-child(23)').prop('selected', true);
                  break;
                  case "PUEBLA":
                  $('#c_estado :nth-child(24)').prop('selected', true);
                  break;
                  case "QUERETARO":
                  $('#c_estado :nth-child(25)').prop('selected', true);
                  break;
                  case "QUINTANA ROO":
                  $('#c_estado :nth-child(26)').prop('selected', true);
                  break;
                  case "SAN LUIS POTOSI":
                  $('#c_estado :nth-child(27)').prop('selected', true);
                  break;
                  case "SINALOA":
                  $('#c_estado :nth-child(28)').prop('selected', true);
                  break;
                  case "SONORA":
                  $('#c_estado :nth-child(29)').prop('selected', true);
                  break;
                  case "TABASCO":
                  $('#c_estado :nth-child(30)').prop('selected', true);
                  break;
                  case "TAMAUILIPAS":
                  $('#c_estado :nth-child(31)').prop('selected', true);
                  break;
                  case "TLAXCALA":
                  $('#c_estado :nth-child(32)').prop('selected', true);
                  break;
                  case "VERACRUZ":
                  $('#c_estado :nth-child(33)').prop('selected', true);
                  break;
                  case "YUCATAN":
                  $('#c_estado :nth-child(34)').prop('selected', true);
                  break;
                  case "ZACATECAS":
                  $('#c_estado :nth-child(35)').prop('selected', true);
                  break;

                }
                //$("#c_estado option[value='"+response.estado+"']").attr("selected", true);
                $('#txt_nombre_contacto').val(response.nombre_contacto);
                $('#txt_correo_contacto').val(response.email_contacto);
                $('#txt_cuenta_bancaria').val(response.cuenta);
                $('#txt_clabe').val(response.clabe);
                $('#c_bancos').val(response.banco);
              }
            });
        }

             $("#menu_modificar_evento").fancybox({
                fitToView   : true,
                frameWidth  : '80%',
                frameHeight : 150,
                autoSize    : false,
                width: 950,
                height: 300,
                title: "<h2>Modificar evento</h2>",          
                scrolling: 'no',
                closeClick  : false,
                 helpers:  {
                    title : {
                        type : 'outside',
                        position : 'top'
                    },
                    overlay : {
                        showEarly : false
                    }
                }

              });     
             $("#menu_cerrar_evento").fancybox({
                fitToView   : true,
                frameWidth  : '80%',
                frameHeight : 150,
                autoSize    : false,
                title: "<h2>Cerrar evento</h2>",          
                scrolling:"no",
                closeClick  : false,
                 helpers:  {
                    title : {
                        type : 'outside',
                        position : 'top'
                    },
                    overlay : {
                        showEarly : false
                    }
                }

              });     

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



       
        $('#c_eventos_creados').change(function(){
          var id= $(this).val();
          if(id=="vacio"){
            $('#form_nuevo_evento')[0].reset();  
            ver_numero_evento();   
            $('#btn_crear_evento').show();     
            //$('#btn_modificar_evento').hide();  
          }
          else{
            var datos={
              "id": id
            };
             $.ajax({
                url:   "ver_detalle_evento.php",
                type:  'post',
                data: datos,
                dataType: "json",
                success:  function (response) {
                  //console.log(response);
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
                  $('#c_disenio').val(response.Diseno);
                  $('#c_produccion').val(response.Produccion);
                  $('#c_solicitantes').val(response.Solicita);
                  $('#c_ejecutivos').val(response.Ejecutivo);
                  $('#c_digital').val(response.Digital);
                  $('#txt_facturacion').val(response.Facturacion);
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
                }

              });
         }
        });



        $('#enviar_odc').click(function(){
            var f_sol=$('#f_solicitud').val();
            var f_pago=$('#f_pago').val();
            var odc_cheque_por=$('#odc_cheque_por').val();
            var letra=$('#odc_label_letra').html();
            var a_nombre=$('#c_a_nombre').val();
            var txt_concepto=$('#txt_concepto').val();
            var txt_servicios=$('#txt_servicios').val();
            var txt_otros=$('#txt_otros').val();
            var txt_docto_soporte=$('#txt_docto_soporte').val();
            var odc_fecha=$('#odc_fecha').val();
            var tipo_pago=$(".tipo_pago:checked").val();
            var user=$("#label_user").html();
          if($('#f_solicitud').val()==""){
            generate('warning',"La fecha de solicitud no puede ir vacia");
          }
          else if($('#f_pago').val()==""){
            generate('warning',"La fecha de pago no puede ir vacia");
          }
          else if($('#odc_cheque_por').val()==""){
            generate('warning',"El monto del cheque no puede ir vacio");
          }
          else if($('#c_a_nombre').val()=="vacio"){
            generate('warning',"Debe seleccionar a un proveedor");
          }
          else if($('#txt_concepto').val()==""){
            generate('warning',"El concepto no puede ir vacio");
          }
          else if($('#txt_servicios').val()==""){
            generate('warning',"Los servicios no pueden ir vacios");
          }
          else if($('#txt_docto_soporte').val()==""){
            if(titulo.includes("viáticos")){
              txt_docto_soporte="0";
            }
            else{
              generate('warning',"Debe ingresar un documento de soporte");  
            }
          }
          else if($('#odc_fecha').val()==""){
            if(titulo.includes("viáticos")){
              odc_fecha="1800-01-01";
            }
            else{
              generate('warning',"La fecha de soporte no puede ir vacia");  
            }
            
          }

          else if($(".tipo_pago:checked").val()=="" || $(".tipo_pago:checked").val()==null){
            generate('warning',"Debe seleccionar un tipo de pago");
          }
          else{
            //si todos los campos estan llenos, se porcede con el insert
            var titulo=$("#titulin").html();
            if(titulo.includes("Orden de pago")){
              titulo="ODC";
            }
            else if(titulo.includes("viáticos")){
              titulo="VIATICOS";
            }
            else{
              titulo="REEMBOLSO";
            }
            var evento=$('#c_numero_evento').val();
            var nombre_evento=$('#c_numero_evento option:selected').text();
            var tipo="";
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
                "a_nombre": a_nombre,
                "txt_concepto": txt_concepto,
                "txt_servicios": txt_servicios,
                "txt_otros": txt_otros,
                "txt_docto_soporte": txt_docto_soporte,
                "odc_fecha": odc_fecha,
                "tipo_pago": tipo_pago,
                "user": user,
              };
              $.ajax({
                url:   "insertar_odc.php",
                type:  'post',
                data: datos,
                success:  function (response) {
                  
                  if(response.includes("registro odc correcto")){
                    descargar_formato();
                    generate('success',"La solicitud se ha guardado correctamente");
                    enviar_notificacion_solicitud(nombre_evento, titulo);
                    limpiar_odc();
                    
                  }
                  else{
                    console.log(response);
                    generate('error',"Ocurrio un error al guardar la solicitud");
                  }
                }

          });

        }
        });

        function enviar_notificacion_solicutud(nombre_evento, tipo_solicitud){
          var usuario=$('#label_user').val();
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
                  console.log(response);  
                  generate('warning', "Ocurrio un error al enviar la notificación. Consulte la consola para mas detalles."); 
                }
              }
            });
        }

        $('#limpiar_odc').click(function(){
          limpiar_odc();
        });

        function descargar_formato(){
          window.location="template.php";
        }

        function limpiar_odc(){
            $('#f_solicitud').val("");
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
        }
        //modificar evento
        $('#btn_modificar_evento').click(function(e){
          e.preventDefault();
          if(validar_crear_evento()){
            // se manda ajax para insertar el evento
            var datos = $('#form_nuevo_evento').serializeArray();
            datos.push({name: 'usuario_registra', value: $('#label_user').html()});
            $.ajax({
              url:   "actualizar_evento.php",
              type:  'post',
              data:  datos,
              success:  function (response) {
                if(response.includes("evento modificado")){
                  console.log(response);
                  $('#btn_crear_evento').show();     
                  //$('#btn_modificar_evento').hide();  
                  $('#form_nuevo_evento')[0].reset();
                  //generate('success',response);
                  ver_opcion();

                  //enviar_mail_modificacion();
                  ver_numero_evento();
                  ver_eventos();
                }
                else{
                  console.log(response);
                 generate('error', "ocurrio un error, consulte la consola para más detalles."); 
                }
              }
            });
          }
        });

        function ver_opcion(){
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
                  enviar_mail_modificacion();
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

        function enviar_mail_modificacion(){
          var evento=$('#c_cliente').val();
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
                  console.log(response);  
                  generate('warning', "Ocurrio un error. Consulte la consola para mas detalles."); 
                }
                
              }
            });
        }


        //else if(!expRegEmail.exec(correo_contacto)){

      $('.main_alta_proveedores').css({ 'height': 350 + "px" });

      $('#guardar_proveedor').click(function(){
        alert("no hace nada");
      });

     
      $('#btn_add_banco').click(function(){
        swal({
             title: "Agregar banco",
          text: "Ingresa el nombre de la institución bancaria",
          input: "text",
          showCancelButton: true,
          animation: "slide-from-top",
          inputPlaceholder: "Facrura...",
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
                              console.log(response);
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
                                            console.log(response);
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
          var metodo=$('#c_metodo_pago').val();
          var rfc=$('#txt_rfc').val();
          var digitos=$('#digitos').val();
          var calle=$('#txt_calle').val();
          var ext=$('#txt_num_ext').val();
          var int=$('#txt_num_int').val();
          var colonia=$('#txt_colonia').val();
          var cp=$('#txt_cp').val();
          var tel=$('#txt_telefono').val();
          var estado=$('#c_estado').val();
          var municipio=$('#txt_municipio').val();
          var nombre_contacto=$('#txt_nombre_contacto').val();
          var correo_contacto=$('#txt_correo_contacto').val();
          var usuario_solicita=$('#label_user').html();
          var archivo1=$('#rfc').val();
          var cuenta=$('#txt_cuenta_bancaria').val();
          var clabe=$('#txt_clabe').val();
          var banco=$('#c_bancos').val();

          if(id=="vacio"){
              generate('warning', "Debe seleccionar a un cliente de la lista");
                pasa=false;
          }
          else if(cliente == ""){
            generate('warning', "Debe ingresar un cliente");
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
          else if(calle == ""){
            generate('warning', "Debe ingresar el nombre de la calle");
                pasa=false;
          }
          else if(ext == ""){
            generate('warning', "Debe ingresar el número del domicilio");
                pasa=false;
          }
          else if(colonia == ""){
            generate('warning', "Debe ingresar el nombre de la colonia");
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
              "metodo": metodo,
              "rfc": rfc,
              "digitos": digitos,
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
            };
            $.ajax({
              url:   "update_cliente.php",
              type:  'post',
              data:  datos,
               beforeSend: function(){
                $('#guardar_cliente').html("<img src='img/puntos.gif'>");
               },
              success:  function (response) {
                console.log(response);
                if(response.includes("cliente actualizado")){
                  $('#guardar_cliente').html("<i class='i_espacio fa fa-save' aria-hidden='true'></i>Guardar Cliente");
                  generate('success', "El cliente ha sido guardado"); 
                }
                else{
                  //console.log(response);
                 generate('error', "ocurrio un error, consulte la consola para más detalles."); 
                }
              }
            });
          }
      });

      

      /*$('#tabla_solicitudes').DataTable( {
        paging: false,
        searching: false,
        sorting: false,
        //scrollY:  "375px",
        //scrollCollapse: false,

        /*width: '400px',
        paging: false,
        searching: false,
        scrollY:  "350px",
        scrollCollapse: false,
        sorting: false,
      } );
      */
        /*$('.dataTables_empty').attr('colspan',3);

        $('#btn_pendientes').click(function(){
          llenar_tabla_solicitudes();
          
        });
           

       function llenar_tabla_solicitudes(){
                $.ajax({
                        url:   'tabla_solicitudes.php',
                        type:  'post',    
                        success:  function (response) {
                          $('#resultado_pendientes').html(response);
                        }
                });
          }*/
}
