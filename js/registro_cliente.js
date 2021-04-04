function inicio(){

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

  //$("#file_constancia").fileinput({'showUpload':true, 'previewFileType':'any'});

  //var myDropzone = new Dropzone($("#file").dropzone({ url: "subir_archivos.php" });

  //var myDropzone = new Dropzone("#file", { url: "subir_archivos.php"});
  var id_cliente=$('#id_cliente').val();
  
  Dropzone.autoDiscover = false;
  $("#file_csf").dropzone({
      url: "subir_archivos.php?id_cliente="+id_cliente+"&tipo=CSF",
      addRemoveLinks: true,
      success: function (file, response) {
         //var imgName = response;
          //file.previewElement.classList.add("dz-success");
          this.removeAllFiles(true);
          window.setTimeout(function() {
            location.reload();
        }, 1200); 
      },
      error: function (file, response) {
        alert(response);
          file.previewElement.classList.add("dz-error");
      }
  });
/* 
  $("#file_ine").dropzone({
    url: "subir_archivos.php?id_cliente="+id_cliente+"&tipo=INE",
    addRemoveLinks: true,
    success: function (file, response) {
        var imgName = response;
        file.previewElement.classList.add("dz-success");
        //alert("Successfully uploaded :" + imgName);
        this.removeAllFiles(true);
        window.setTimeout(function() {
          location.reload();
      }, 1300); 
    },
    error: function (file, response) {
      alert(response);
        file.previewElement.classList.add("dz-error");
    }
});

$("#file_edo").dropzone({
  url: "subir_archivos.php?id_cliente="+id_cliente+"&tipo=EDO",
  addRemoveLinks: true,
  success: function (file, response) {
      var imgName = response;
      file.previewElement.classList.add("dz-success");
      //alert("Successfully uploaded :" + imgName);
      this.removeAllFiles(true);
      window.setTimeout(function() {
        location.reload();
    }, 1300); 
  },
  error: function (file, response) {
    alert(response);
      file.previewElement.classList.add("dz-error");
  }
});

$("#file_comp").dropzone({
  url: "subir_archivos.php?id_cliente="+id_cliente+"&tipo=COMP",
  addRemoveLinks: true,
  success: function (file, response) {
      var imgName = response;
      file.previewElement.classList.add("dz-success");
      //alert("Successfully uploaded :" + imgName);
      this.removeAllFiles(true);
      window.setTimeout(function() {
        location.reload();
    }, 1300); 
  },
  error: function (file, response) {
    alert(response);
      file.previewElement.classList.add("dz-error");
  }
});

$("#file_acta").dropzone({
  url: "subir_archivos.php?id_cliente="+id_cliente+"&tipo=ACTA",
  addRemoveLinks: true,
  success: function (file, response) {
      var imgName = response;
      file.previewElement.classList.add("dz-success");
      //alert("Successfully uploaded :" + imgName);
      this.removeAllFiles(true);
      window.setTimeout(function() {
        location.reload();
    }, 1300); 
  },
  error: function (file, response) {
    alert(response);
      file.previewElement.classList.add("dz-error");
  }
}); */
    
    

    if($('#id_cliente').val()!="0"){
        ver_datos_clientes($('#id_cliente').val());
    }   

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
                console.log(response);
              $('#txt_nombre_cliente').val(response.nombre);
              $('#txt_nombre_comercial').val(response.nombre_comercial);
              $('#c_metodo_pago').val(response.metodo_pago);
              $('#txt_rfc').val(response.rfc);
              $('#dias_credito').val(response.dias_credito);
              $('#txt_calle').val(response.calle);
              $('#txt_num_ext').val(response.num_ext);
              $('#txt_num_int').val(response.num_int);
              $('#txt_cp').val(response.cp);
              llenar_colonias(response.cp, response.colonia);
              $('#txt_telefono').val(response.telefono);
              $('#txt_extension').val(response.extension);
              $('#txt_celular').val(response.celular);
              $('#txt_municipio').val(response.municipio);
              $('#area_descripcion').val(response.descripcion);
              $('#txt_sucursal').val(response.sucursal);
              $('#combo_tipo_persona').val(response.tipo_persona);
              //change_tipo_persona(response.tipo_persona);
              $('#txt_estado').val(response.estado);
              $('#txt_nombre_contacto').val(response.nombre_contacto);
              $('#txt_correo_contacto').val(response.email_contacto);
              $('#c_CFDI_CLIENTE').val(response.cfdi);
               
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                  alert("Status2: " + textStatus); 
                  alert("Error2: " + errorThrown);
                  
              }  
          });
      }
/* 
     function change_tipo_persona(tipo){        
            if(tipo!="vacio"){ 
            desactivar_btn_file($('#span_file_csf'), $('#file_csf'));
            activar_btn_file($('#span_file_csf'), $('#file_csf'));
          }
          else{
            desactivar_btn_file($('#span_file_csf'), $('#file_csf'));
            csf=false;
          }
        
      } */
/*
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
  } */

  $('#btn_limpiar').on('click',function(){
    //location.href('registro_cliente.php');
    location.href = 'registro_cliente.php';
  });

  $('#btn_documentos').on('click',function(){
    pre_guardar();
  });

  function pre_guardar(){
    var url="alta_clientes.php";
    var pasa=false;
    var cliente=$('#txt_nombre_cliente').val();
    cliente=$.trim(cliente);
    var nombre_comercial=$('#txt_nombre_comercial').val();
    nombre_comercial=$.trim(nombre_comercial);
    var rfc=$('#txt_rfc').val();
    var tipo_persona=$('#combo_tipo_persona').val();
    var dias_credito=$('#dias_credito').val();
    var calle=$('#txt_calle').val();
    var ext=$('#txt_num_ext').val();
    var int=$('#txt_num_int').val();
    var colonia=$('#c_colonia').val();
    var cp=$('#txt_cp').val();
    var tel=$('#txt_telefono').val();
    var extension=$('#txt_extension').val();
    var celular=$('#txt_celular').val();
    var estado=$('#txt_estado').val();
    var municipio=$('#txt_municipio').val();
    var nombre_contacto=$('#txt_nombre_contacto').val();
    var correo_contacto=$('#txt_correo_contacto').val();
    var uso_cfdi=$('#c_CFDI_CLIENTE').val();
    var respuesta="true";
    if(id_cliente=="0"){
      respuesta=validar_rfc("clientes"); 
    }   
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
    else if(rfc == ""){
      generate('warning', "Debe ingresar un RFC");
          pasa=false;
    }
     else if( respuesta != "true"){ //validacion de que el RFC no exista ya como cliente/proveedor
      generate('warning', "El RFC ya esta en uso por: "+respuesta);
          pasa=false;
    }
    else if(dias_credito == ""){
      generate('warning', "Debe ingresar los días de crédito");
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
    else if(nombre_contacto == ""){
      generate('warning', "Debe ingresar un nombre de contacto");
          pasa=false;
    }
    else if(uso_cfdi == "vacio"){
      generate('warning', "Debe seleccionar un uso de CFDI");
          pasa=false;
    }    
    else {
        pasa=true;
    }
    

    if(pasa){ // si todos los campos son correctos, se manda a documentos
      //$('#fieldset_documentos').fadeIn();
      var datos = {
        "cliente": cliente,
        "nombre_comercial": nombre_comercial,
        "rfc": rfc,
        "dias_credito": dias_credito,
        "calle": calle,
        "ext": ext,
        "int": int,
        "colonia": colonia,
        "tipo_persona":tipo_persona,
        "cp": cp,
        "tel": tel,
        "extension":extension,
        "celular": celular,
        "estado": estado,
        "municipio": municipio,
        "nombre_contacto": nombre_contacto,
        "correo_contacto": correo_contacto,
        "uso_cfdi": uso_cfdi,
        "id_cliente":id_cliente
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
          if(response.includes("registro correcto")){
            var arr=response.split('#');
            location.href="registro_cliente.php?id="+arr[1];
          }
          else if(response.includes("Cliente guardado")){
            generate("success","Cliente guardado");
            window.setTimeout(function() {
              location.reload();
          }, 1200); 
          }
          else{
            generate("error", "Ocurrio un error: "+response);
            console.log(response);
          }
          
          
        }
      }); 
    }
    else{
      
    }
};

function validar_rfc(){
  var rfc=$('#txt_rfc').val();
  var resp="";
  var datos={
    'rfc': rfc,
    'tipo': 'clientes',
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
  
  $('#enviar_solicitud_cliente').on('click',function(){
      var proveedor=$('#txt_nombre_cliente').val();
       var datos={
          "proveedor": proveedor,
          "usuario": "a",
          "asunto": "Solicitud de cliente",
          "texto": "vacio",
          "evento": "evento",
        };        
       $.ajax({
              url:   "mail/envio_mail.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                if(response.includes("Enviado")){
                  generate("success", "El cliente ha sido solicitado");
                }
                else{
                  generate("error", response);
                }
              }
            });        
  });

  $('#guardar_cliente').on('click',function(){
    pre_guardar();
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
           llenar_colonias(cp,"");
        }
        }
      });
  });

  function llenar_colonias(cp, col){
  var datos={
    "cp":cp,
    "col":col
  }
  $.ajax({
    type : 'GET',
    url  : 'ver_colonias.php',
    data: datos,
      success : function(response){
         $('#c_colonia').html(response);
          $('#c_colonia').chosen({allow_single_deselect: true,width: '100%'}); 
          $('#c_colonia').trigger("chosen:updated");
      }
    });
  }

  $('#c_colonia').on('change', function(evt, params) {
    if($(this).val()=="0"){
      var n2 = new Noty({
        text: 'Ingresa la colonia:<input id="colonia" type="text" class="form-control">',
        theme: 'mint',
        closeWith: 'button',
        layout: "center",
        modal: true,
        type: "info",
        buttons: [
        Noty.button('Aceptar', 'btn btn-success', function () {
            var col=$('input#colonia').val();
            $('#c_colonia').chosen("destroy");
            $('#c_colonia').append('<option value="'+col.toUpperCase()+'">'+col.toUpperCase()+'</option>');
            $('#c_colonia').chosen({allow_single_deselect: true,width: '100%'});
            $('#c_colonia').trigger("chosen:updated");
            $('#c_colonia').val(col);
            n2.close();
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