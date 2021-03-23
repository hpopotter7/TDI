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
  var id_proveedor=$('#id_proveedor').val();
  
  Dropzone.autoDiscover = false;
  $("#file_csf").dropzone({
      url: "subir_archivos.php?id_proveedor="+id_proveedor+"&tipo=CSF",
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

  $("#file_ine").dropzone({
    url: "subir_archivos.php?id_proveedor="+id_proveedor+"&tipo=INE",
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
  url: "subir_archivos.php?id_proveedor="+id_proveedor+"&tipo=EDO",
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
  url: "subir_archivos.php?id_proveedor="+id_proveedor+"&tipo=COMP",
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
  url: "subir_archivos.php?id_proveedor="+id_proveedor+"&tipo=ACTA",
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
    
$("#c_estados_cobertura").chosen();


    if($('#id_proveedor').val()!="0"){
        ver_datos_proveedores($('#id_proveedor').val());
    }   

    function ver_datos_proveedores(id){
        var datos={
          "id": id,
        }
        $.ajax({
            url:   "ver_datos_proveedores.php",
            type:  'post',
            data: datos,
            dataType: "json",
            success:  function (response) {
              $('#txt_nombre_proveedor').val(response.nombre);
              $('#txt_nombre_comercial').val(response.nombre_comercial);
              $('#c_metodo_pago').val(response.metodo_pago);
              $('#txt_rfc').val(response.rfc);
              $('#txt_calle').val(response.calle);
              $('#txt_num_ext').val(response.num_ext);
              $('#txt_num_int').val(response.num_int);
              $('#txt_cp').val(response.cp);
              var arr=response.cobertura.split(",");
              $('#c_estados_cobertura').val(arr);
              $('#c_estados_cobertura').trigger("chosen:updated");              
              llenar_colonias(response.cp, response.colonia);
              $('#txt_telefono').val(response.telefono);
              $('#txt_extension').val(response.extension);
              $('#txt_celular').val(response.celular);
              $('#txt_municipio').val(response.municipio);
              $('#area_descripcion').val(response.descripcion);
              $('#txt_sucursal').val(response.sucursal);
              $('#combo_tipo_persona').val(response.tipo_persona);
              if(response.tipo_persona=="FISICA"){
                  $('#file_acta').hide();
                $('#label_acta').removeClass("label-primary").addClass("label-default");
              }
              else{
                $('#file_acta').show();
                $('#label_acta').removeClass("label-default").addClass("label-primary");
              }
              $('#txt_estado').val(response.estado);
              $('#txt_nombre_contacto').val(response.nombre_contacto);
              $('#txt_correo_contacto').val(response.email_contacto);
              $('#c_CFDI_CLIENTE').val(response.cfdi); 
              
              $('#txt_cuenta_bancaria').val(response.cuenta); 
              $('#txt_clabe').val(response.clabe); 
              $('#c_metodo_pago').val(response.metodo_pago); 
              $('#c_bancos').val(response.banco); 
              $('#txt_sucursal').val(response.sucursal); 
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                
                  alert("Status: " + textStatus); 
                  alert("Error: " + errorThrown);
                  console.log(errorThrown);
                  console.log(XMLHttpRequest);
                  
              }  
          });
      }

  $('#btn_limpiar').on('click',function(){
    //location.href('registro_cliente.php');
    location.href = 'registro_proveedor.php';
  });

  $('#btn_documentos').on('click',function(){
    pre_guardar();
  });

  function pre_guardar(){
    var url="alta_proveedor.php";
    var pasa=false;
    var proveedor=$('#txt_nombre_proveedor').val();
    proveedor=$.trim(proveedor);
    var nombre_comercial=$('#txt_nombre_comercial').val();
    nombre_comercial=$.trim(nombre_comercial);
    var rfc=$('#txt_rfc').val();
    var tipo_persona=$('#combo_tipo_persona').val();
    var descripcion=$('#area_descripcion').val();
    var cobertura=$('#c_estados_cobertura').val();
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

    var cuenta=$('#txt_cuenta_bancaria').val();
    var clabe=$('#txt_clabe').val();
    var forma_pago=$('#c_metodo_pago').val();
    var banco=$('#c_bancos').val();
    var sucursal=$('#txt_sucursal').val();

    var respuesta="true";
    if(id_proveedor=="0"){
      respuesta=validar_rfc("proveedor"); 
    }   
    if(proveedor == ""){
      generate('warning', "Debe ingresar una razón social");
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
    else if(nombre_comercial == ""){
      generate('warning', "Debe ingresar un nombre comercial");
          pasa=false;
    }
    else if(tipo_persona == "vacio"){
    generate('warning', "Debe seleccionar un tipo de persona");
        pasa=false;
   }
    else if(descripcion == ""){
    generate('warning', "Debe ingresar una descripcion");
        pasa=false;
   }
    else if(cobertura == "" || cobertura == null){
    generate('warning', "Debe ingresar un estado de servicio");
        pasa=false;
   }   
    else if(cp == ""){
    generate('warning', "Debe ingresar el código postal");
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
    else if(colonia == "vacio" || colonia==null){
    generate('warning', "Debe seleccionar el nombre de la colonia");
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
    else if(tel == ""){
      generate('warning', "Debe ingresar un teléfono");
          pasa=false;
    }
    else if(tel.length!=10){
      generate('warning', "El número de teléfono debe ser a 10 dígitos");
          pasa=false;
    }    
    else if(nombre_contacto == ""){
      generate('warning', "Debe ingresar un nombre de contacto");
          pasa=false;
    }
    else if(correo_contacto == ""){
    generate('warning', "Debe ingresar un correo de contacto");
        pasa=false;
   }
    else if(uso_cfdi == "vacio"){
      generate('warning', "Debe seleccionar un uso de CFDI");
          pasa=false;
    }   
    else if(cuenta == ""){
    generate('warning', "Debe ingresar un número de cuenta");
        pasa=false;
   }    
    else if(clabe == ""){
    generate('warning', "Debe ingresar una CLABE");
        pasa=false;
   }
    else if(forma_pago == "vacio"){
    generate('warning', "Debe seleccionar una forma de pago");
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
    else {
        pasa=true;
    }
    

    if(pasa){ // si todos los campos son correctos, se manda a documentos
      //$('#fieldset_documentos').fadeIn();
      var datos = {
        "proveedor": proveedor,
        "nombre_comercial": nombre_comercial,
        "rfc": rfc,
        "tipo_persona":tipo_persona,
    "descripcion":descripcion,
    "cobertura":cobertura,
        "cp": cp,
        "estado": estado,
        "municipio": municipio,
        "colonia": colonia,
        "calle": calle,
        "ext": ext,
        "int": int,
        "tel": tel,
        "extension":extension,
        "celular": celular,        
        "nombre_contacto": nombre_contacto,
        "correo_contacto": correo_contacto,
        "uso_cfdi": uso_cfdi,
    "cuenta": cuenta,
    "clabe":clabe,
    "forma_pago":forma_pago,
    "banco": banco,
    "sucursal": sucursal,
        "id_proveedor":id_proveedor
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
            location.href="registro_proveedor.php?id="+arr[1];
          }
          else if(response.includes("Proveedor guardado")){
            generate("success","Proveedor guardado");
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
    'tipo': 'proveedores',
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
  
  $('#enviar_solicitud_proveedor').on('click',function(){

    //validacion para documentos respecto al tipo de proveedor
    var documentos=$('#txt_documentos').val();
    var tipo_persona=$('#combo_tipo_persona').html();
    var bandera=false;
    var bandera_acta=false;
    var bandera_comp=false;
    var bandera_csf=false;
    var bandera_edo=false;
    var bandera_ine=false;
    var arreglo=documentos.split(",");
    for(var r=0;r<=arreglo.length-1;r++){
        var arr_nombre=arreglo[r].split(".");
        var nombre=arr_nombre[0];
        if(nombre=="INE"){
            bandera_ine=true;
        }
        if(nombre=="COMP"){
            bandera_comp=true;
        }
        if(nombre=="CSF"){
            bandera_csf=true;
        }
        if(nombre=="EDO"){
            bandera_edo=true;
        }
        if(nombre=="ACTA"){
            bandera_acta=true;
        }
    }
    if(tipo_persona=="MORAL"){
        if(bandera_acta && bandera_comp && bandera_csf && bandera_edo && bandera_ine){
            bandera=true;
        }
    }
    else{
        if(bandera_comp && bandera_csf && bandera_edo && bandera_ine){
            bandera=true;
        }
    }
    
    
    if(bandera){
       
     var proveedor=$('#txt_nombre_proveedor').val();
       var datos={
          "proveedor": proveedor,
          "usuario": "a",
          "asunto": "Solicitud de proveedor",
          "texto": "vacio",
          "evento": "evento",
        };        
       $.ajax({
              url:   "mail/envio_mail.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                if(response.includes("Enviado")){
                  generate("success", "El proveedor ha sido solicitado");
                }
                else{
                  generate("error", response);
                }
              }
            }); 
    }
    else{
        generate('info',"falta algún documento por subir");
    }
             
  });

  $('#guardar_proveedor').on('click',function(){
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