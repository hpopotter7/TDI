function inicio(){
    var id_usuario=$('#id_usuario').val();
    ver_usuarios_registrados("");

    function generate(tipo, texto){
        //mint, sunset, metroui, relax, nest, semantic, light, boostrap-v3
        var tema="mint";
        if(tipo=="success"){
            tema="nest";

        }
        if(tipo=="warning"){
            tema="metroui";

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

    function ver_usuarios_registrados(id_usuario){//obtener los usuarios registrados
        if(id_usuario!=""){
            $("#c_jefe_directo").chosen("destroy");
        }
        var datos={"id_usuario":id_usuario};
        $.ajax({
              url:   'ver_usuarios.php',
              type:  'post',
              data: datos,
              async: false,
              success:  function (response) { 
                  //alert("as");
                  $('#c_jefe_directo').html(response);                  
                  $('#c_jefe_directo option[value="vacio"]').remove();
                  $("#c_jefe_directo").chosen({disable_search_threshold: 10});
              }
        });
      }

      
      if(id_usuario=="0"){
        $('.card').hide();
      }
      else{
        $('.card').show();
       ver_usuarios_registrados(id_usuario);  
       $('#c_jefe_directo').trigger('chosen:updated');
      }

    $('#btn_agregar').on('click',function(){
        var tipo=$('#c_tarjetas').val();
        var no_tarjeta=$('#txt_tarjeta').val();
        if(tipo=="" || no_tarjeta==""){
            $('#alert').fadeIn().html('<div class="alert alert-danger alert-dismissible fade show" role="alert"> Debes ingresar todos los datos<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'); 
            remove_alert();
        }
        else{
            var datos={
                "banco": tipo,
                "numero":no_tarjeta,
                "id_usuario":id_usuario
            };
            $.ajax({
                url:   'agregar_tarjeta.php',
                type:  'post',
                data: datos,
                success:  function (response) {
                    if(response.includes("tarjeta agregada")){
                        $('.modal').modal('toggle');
                        generate("success", "Se ha agregado una tarjeta");
                        window.setTimeout(function() {
                            location.reload();
                        }, 4000); 
                    }
                    else{
                        generate('info', response);
                    }
                }
          });
        }
    });

    function remove_alert(){
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove();
        });
        }, 3500); 
    }

    $('.btn_borrar_tarjeta').on('click', function(){
        var id=$(this).attr('id');
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
                  generate("success","La tarjeta ha sido eliminada!!");
                  window.setTimeout(function() {
                    location.reload();
                }, 4000); 
                }
                else{
                  generate('info', "Ocurrio un error: "+response);
                }
              }
            });
    });

    $('#btn_limpiar').on('click', function(){
        $('#txt_nombre_usuario').val('');
        $('#txt_email_usuario').val('');
        $('#txt_username').val('');
        $('#c_jefe_directo').val('');
        $('#c_jefe_directo').trigger('chosen:updated');
        location.href = 'formulario_registro_usuario.php';
        window.parent.$("#frame").attr("src", "formulario_registro_usuario.php"); 
    });
      
    $('.new-control-input').on('click',function(){
        //obtener todos los privilegios
        var eje="";
        var pro="";
        var dis="";
        var sol="";
        var dig="";
        var cxp="";
        var cli="";
        var prov="";
        var fac="";
        if ($('#check_eje').is(':checked')) {
            eje="X";
        }
        if ($('#check_pro').is(':checked')) {
            pro="X";
        }
        if ($('#check_dis').is(':checked')) {
            dis="X";
        }
        if ($('#check_sol').is(':checked')) {
            sol="X";
        }
        if ($('#check_dig').is(':checked')) {
            dig="X";
        }
        if ($('#check_cxp').is(':checked')) {
            cxp="X";
        }
        if ($('#check_cli').is(':checked')) {
            cli="X";
        }
        if ($('#check_prov').is(':checked')) {
            prov="X";
        }
        if ($('#check_fac').is(':checked')) {
            fac="X";
        }
        var datos={
            "eje":eje,
            "pro":pro,
            "dis":dis,
            "sol":sol,
            "dig":dig,
            "cxp":cxp,
            "cli":cli,
            "prov":prov,
            "fac":fac,
            "id_usuario":id_usuario,
        }
        $.ajax({
            url:   'update_privilegios.php',
            type:  'post',
            data: datos,
            success:  function (response) {
                if(response.includes("actualizado")){
                    generate("success", "Usuario actualizado"); 
                }
                else{
                    generate('info', response);
                }
            }
      });
    });

    $('#btn_guardar').on('click',function(){
        var nombre=$('#txt_nombre_usuario').val();
        var correo=$('#txt_email_usuario').val();
        var user=$('#txt_username').val();
        var jefes=$('#c_jefe_directo').val(); 
        if(nombre=="" || correo=="" || user=="" || jefes==null){
            generate('info',"Debes completar todos los campos");
        }         
        else{    
            var datos={
                "nombre":nombre,
                "user":user,
                "correo":correo,
                "jefes": jefes,
                "id_usuario": id_usuario,
            };
            $.ajax({
                url:   'guardar_usuario.php',
                type:  'post',
                data: datos,
                success:  function (response) {
                    if(response.includes("formulario_registro_usuario")){
                        generate("success","El usuario ha sido guardado");
                        window.setTimeout(function() {
                            location.href = response;
                        }, 3000);
                    }
                    else{
                        generate('info', response);
                    }
                }
        });
        }
    });


}