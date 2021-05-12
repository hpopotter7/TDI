function inicio(){

  var evento=$('#txt_evento').val();
  

  $('.chosen-select').chosen();

  parent.$('body').delegate('.arriba','click',function(){
    var body = $("html, body");
    body.animate({scrollTop:0}, 500, 'swing');
  });

  parent.$('body').delegate('.abajo','click',function(){
     var body = $("html, body");
    body.animate({scrollTop:$(document).height()}, 800, 'swing');
    
  });

  $(window).scroll(function() {
    var scrollTop = $(window).scrollTop();
    if ( scrollTop > 250 ) { 
      var evento=$('#c_mis_eventos option:selected').text();
      /* parent.$('.evento').html("<label><h3>Evento: "+evento+"</h3></label><button id='btn_arriba' class='arriba btn btn-dark'><i class='fas fa-chevron-up fa-2x' style='color:white'></i></button></button><button id='btn_arriba' class='abajo btn btn-dark'><i class='fas fa-chevron-down fa-2x' style='color:white'></i></button>"); */
      parent.$('#titulo_evento').html("Evento: "+evento);
      parent.$('.evento').css("top","75px");
    }
    else{
      parent.$('.evento').css("top","0px");
    }
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
        },
        "buttons": {
          "colvis": 'Ocultar'
      }
        }

        
    $('#puntos_gif').hide();
    $('#btn_transferir').hide();
    $('#btn_borrar_sdp').hide();

    /* 
llenar_transfer_eventos();

function llenar_transfer_eventos(){
  $.ajax({
      url:   "ver_eventos2.php",
      type:  'post',
      success:  function (response) {
         $('#c_transfer').html(response);
      }p
    });
} */

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
    llenar_combo_eventos_modificar("0");

    function llenar_combo_eventos_modificar(anio){
        var datos={
          "anio":anio,
          "evento":evento,
        };
        $.ajax({
            url:   "buscar_evento.php",
            type:  'post',
            data: datos,
            async:false,
            success:  function (response) {
              
              response="<option value='0'></option>"+response;
            $('#c_mis_eventos').html(response);
            $('#c_mis_eventos').chosen({allow_single_deselect: true,width: '100%',placeholder_text_single: "Selecciona...",no_results_text: "No hay coincidencias para"}); 
            $('#c_mis_eventos').trigger("chosen:updated");
            },
          }); 

          /* if(evento!=""){
            $('#c_mis_eventos').html();
            alert("entrar al evento");
          } */
        }

        $("#c_mis_eventos").chosen().change(function(){
            var valor=$(this).val();
            $('#puntos_gif').show();
            ver_solicitudes_por_evento(valor,"todos");  
            
          });

          function ver_solicitudes_por_evento(evento, filtro){
            $('#resultado_solicitudes').html('');          
            $('#mensaje_demo').html('');
            if(filtro=="todos"){
              $('#c_filtro_solicitudes').val("0");
            }
            var datos={
              "evento": evento,
              "filtro":filtro,
            }
            $.ajax({
                url:   "ver_solicitudes_por_evento.php",
                type:  'post',
                data: datos,
                success:  function (response) {
                  $('#puntos_gif').hide();
                  $('#resultado_solicitudes').show();
                  var arr=response.split("$$$");
                  $('#resultado_solicitudes').html(arr[0]);
                  $('#resultado_solicitudes').fadeIn();
                  $('#espacio').show();
                  $('#div_filtro_solicitudes').show();
                  $('#tabla_resumen_solicitudes').addClass("chico");
                  $('#tabla_resumen_solicitudes').DataTable({
                    "searching": true,
                    "language" : idioma_espaniol,
                    "ordering": true,
                    "paging": false,
                    "destroy": true, 
                    "sort": true,
                    //"scrollX": true,
                    dom: 'Bfrtip',
                    buttons: [
                      'colvis',
                        'excel',// 'colvis'
                        //'excel', 'pdf',
                    ],
                   /*  language: {
                      buttons: {
                          colvis: 'Ocultar'
                      }
                    } */
                    /*
                    "columnDefs": [
                        { "width": "3%", "targets": [-1,-2,-3] }
                    ],
                    */
                    //"lengthMenu": [[15, 25, 50, -1], [15, 25, 50, "All"]],
                   
                 }); 
                }
              });
          }

          $('#resultado_solicitudes table thead tr').clone(true).appendTo( '#resultado_solicitudes table thead' );
            $('#resultado_solicitudes table thead tr:eq(1) th').each( function (i) {
            var title = $(this).text();
            $(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
            $( 'input', this ).on( 'keyup change', function () {
                if ( table.column(i).search() !== this.value ) {
                    table
                        .column(i)
                        .search( this.value )
                        .draw();
                }
            } );
        } );

        $("#btn_sin_factura").on('click',function (e) { 
            location.href="pendientes.php";
        });

        var ids_odc="";

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
                                    ver_solicitudes_por_evento(evento,"todos");
                                      setTimeout(function() {
                                        ver_solicitudes_por_evento(evento,"todos");
                                           swal({
                                              type: 'success',
                                              title: 'Listo',
                                              html: 'Factura modificada: ' + numero
                                            })
                                          }, 200)
                                      }
                                      else if(response.includes("ya existe")){
                                        ver_solicitudes_por_evento(evento,"todos");
                                      setTimeout(function() {
                                        ver_solicitudes_por_evento(evento,"todos");
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

            $("#resultado_solicitudes").delegate(".btn_cheque", "click", function() {
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
                                          
                                         ver_solicitudes_por_evento(evento, "todos");
                                           setTimeout(function() {
                                             ver_solicitudes_por_evento(evento, "todos");
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
                 });

                 $("#resultado_solicitudes").delegate(".check_pagado", "click", function() {
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
                  });

                  $("#resultado_solicitudes").delegate(".check_comp", "click", function() {
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
                            /*generate('success',"La solicitud ha sido actualizada!!");*/
                            /* swal({
                              type: 'success',
                              title: 'Listo',
                              html: 'La solicitud ha sido actualizada!!'
                            }); */
                            
                            parent.swal({
                              type: 'success',
                              title: 'Listo',
                              html: 'La solicitud ha sido actualizada!!'
                            });
                          }
                          else{
                            /*generate('error',"Ocurrio un error. Vea la consola para mas detalles");*/
                            parent.swal({
                              type: 'success',
                              title: 'Listo',
                              html: 'Error: '+response
                            });
                            
                          }
                          
                          //ver_solicitudes_por_evento(evento, "todos");
                        }
                      });
                   }

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
                            /* generate('success',"La solicitud ha sido actualizada!!"); */
                            /* swal({
                              type: 'success',
                              title: 'Listo',
                              html: 'La solicitud ha sido actualizada!!'
                            }); */
                            parent.swal({
                              type: 'success',
                              title: 'Listo',
                              html: 'La solicitud ha sido actualizada!!'
                            });
                          }
                          else{
                            
                            //generate('error',"Ocurrio un error. "+response);
                            parent.swal({
                              type: 'success',
                              title: 'Listo',
                              html: 'Error: '+response
                            });
                          }
                          //ver_solicitudes_por_evento(evento, "todos");
                        }
                      });
                   }

          $("#resultado_solicitudes").delegate(".btn_subir_comprobante", "click", function() {
          var contenido=$(this).html();
          if(contenido.includes("upload")){
            var arr=$(this).attr('id').split("#");
            var id=arr[0];
            var evento=arr[1];
            parent.$('#txt_evento').val(evento);
            parent.$('#txt_solicitud').val(id);
            parent.$("#modal_subir_comprobante").modal();
            //subir_comprobante(evento, id);
          } 
          else{
            contenido="ver";
          }
          
        });

        

                   $("#resultado_solicitudes").delegate(".btn_ver_comprobante", "click", function() {    
                    var arr=$(this).attr('id').split("#");
                    if(arr.length==2){
                      //window.open("comprobantes/"+arr[1],'_blank');
                      if(arr[1].includes(".pdf")){
                        parent.$.fancybox.open({
                          //maxWidth	: 800,
                          //maxHeight	: 600,
                          fitToView	: false,
                          width		: '90%',
                          height		: '90%',
                          autoSize	: false,
                          closeClick	: false,
                          openEffect	: 'fade',
                          closeEffect	: 'fade',
                          'type'      : 'iframe',
                          'href'      : "comprobantes/"+arr[1],
                      });
                      }
                      else if(arr[1].includes(".jpg") || arr[1].includes(".jpeg") || arr[1].includes(".png") || arr[1].includes(".gif")){
                        parent.$.fancybox.open({
                          //maxWidth	: 800,
                          //maxHeight	: 600,
                          fitToView	: false,
                          width		: '90%',
                          height		: '90%',
                          autoSize	: false,
                          closeClick	: false,
                          openEffect	: 'fade',
                          closeEffect	: 'fade',
                          'href'      : "comprobantes/"+arr[1],
                      });
                      }
                      else{
                        window.open("comprobantes/"+arr[1],'_blank');
                      }
                      
                    }
                    else{
                      
                      var a="";
                      for(var r=1;r<=arr.length-1;r++){
                        a=a+"<li style='margin:.2em'><a class='btn btn-secondary' href='comprobantes/"+arr[r]+"' target='_blank'><b>"+arr[r]+"</b></li>";
                      }
                      var html="Este comprobante tiene varios archivos:<ul>"+a+"</ul>";
                      /* var n2 = new Noty({
                        text: html,
                        theme: 'mint',
                        //closeWith: 'click',
                        layout: "center",
                        modal: true,
                        type: "info",
                        
                    });
                    n2.show(); */
                    $('#mensaje_demo').html(html);
              
                          $("#modal_demo").modal({
                            fadeDuration: 100
                          });
                    }
                    for(var r=0;r<=arr.length-1;r++){
                      console.log(arr[r]);
                    }
                });

                $("#resultado_solicitudes").delegate(".btn_eliminar_comprobante", "click", function(){
                  var valor_boton=$(this).attr("id");
                  var arreglo=valor_boton.split("~");
                  var id_odc=arreglo[1];
              
                  var datos={
                    "id_odc":id_odc,
                  };
                    $.ajax({
                      url: 'eliminar_comprobante.php', 
                      data: datos,
                      type: 'post',
                      success: function(response){
                        if(response.includes("MISMO")){
                        var arreglo_archivos=arreglo[0].split("#");
                        var html="<h3 style='padding:4px; color:black; text-align:center;'><div class='alert alert-danger' role='alert'>NOTA: Una vez eliminados los archivos no se podrán recuperar</div></h3>";   
                        var evento="";
                              //listar los acrchivos a borrar 
                          for(var r=1;r<=arreglo_archivos.length-1;r++){
                            var name=arreglo_archivos[r].split("/");
                            var nombre=name[0]+"/"+name[1];
                            evento=name[0]; 
              
                            html=html+"<div class='row' style='background-color: #white; padding:5px;'><button class='btn btn-primary btn_ref' id='comprobantes/"+arreglo_archivos[r]+"'>"+name[1]+" </button><button class='btn_borrar_comp btn btn-danger' id='"+nombre+"'><i class='fa fa-trash'></i></a></button></div>";
                          }
                          $('#mensaje_demo').html(html);
              
                          $("#modal_demo").modal({
                            fadeDuration: 100
                          });
                        }
                        else{
                          //generate("error", "Solo puede borrar el documento el usuario que lo registró: "+response);
                          parent.swal({
                            type: 'error',
                            title: 'Error',
                            html: 'Solo puede borrar el documento el usuario que lo registró: '+response,
                          });
                        }
                      }
                    });              
                });

                $("#mensaje_demo").delegate(".btn_ref", "click", function(){
                  var link=$(this).attr("id");
                    window.open(link,'_blank' // <- This is what makes it open in a new window.
                  );
                });

                $("#mensaje_demo").delegate(".btn_borrar_comp", "click", function(){
                  eliminar_comprobante();
                });

                function eliminar_comprobante(){
                  var nombre_archivo=$(".btn_borrar_comp").attr("id"); 
                  //var arr_eventos=nombre_archivo.split("/");
                  var evento=$("#c_mis_eventos").val();
                  
                    var datos={
                      "nombre_archivo":nombre_archivo,
                    };
                      $.ajax({
                        url: 'delete_comprobante.php', // point to server-side PHP script 
                        data: datos,                         
                        type: 'post',
                        success: function(response){
                          if(response.includes("Error")){
                            generate("warning", "Ocurrio un error"+response);
                          }
                          else{
                            generate("success", "El comprobante ha sido eliminado");
                            $('.close-modal ').click();
                            $('.close-modal ').trigger("click");
                            
                            ver_solicitudes_por_evento(evento,"todos");
                           // noty.close();
                          }
                        }
                      });
                  }

                  $('#c_filtro_solicitudes').change(function(){
                    var valor=$(this).val();
                    var id=$('#c_mis_eventos').val();
                    if(id=="0" || id==""){
                      generate("info", "Debe seleccionar un evento");
                    }
                    else if(valor=="0" || valor==""){
                      ver_solicitudes_por_evento(id,"todos");
                    }
                    else if(valor=="Pagados"){
                      ver_solicitudes_por_evento(id,"pagados");
                    }
                    else if(valor=="Comprobados"){
                      ver_solicitudes_por_evento(id,"comprobados");
                    }
                  });
                  

                  $('#btn_transferir').click(function(e){
                    e.preventDefault();
                    var T=""
                    $.ajax({
                      url:   "ver_eventos2.php",
                      type:  'post',
                      async: false,
                      success:  function (response) {
                         //$('#c_transfer').html(response);
                         T=response;
                      }
                    });
                    var n3=new Noty({
                      text: 'Selecciona el evento a transferir: <select class="form-control" id="c_t">'+T+'</select>',
                      theme: 'mint',
                      layout: "center",
                      closeWith: 	['button'],
                      modal: true,
                      type: "info",
                      buttons: [
                      Noty.button('Aceptar', 'btn btn-success', function () {
                        var valor=$('#c_mis_eventos').val();
                        var ID=$('select#c_t').val();
                        //var valor2=$('#c_transfer option:selected').val();
                        //var ID=$('select#c_transfer option:selected').val();
                        //alert(valor+"-"+valor2);
                          if(valor==ID){
                            generate("warning",'No es posible transferir al mismo evento');
                          }
                          else{
                            transferir_odc(ids_odc, ID, n3);
                          }
                        //n3.close();
                      }, {id: 'button1', 'data-status': 'ok'}),    
                      Noty.button('Cancelar', 'btn btn-danger', function () {
                          n3.close();
                      })
                      ]
                  }); n3.show(); 
                  $('.noty_layout').css('width','550px');

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
            var inputs="<div class='row'><div class='col-md-3'>Motivo devolución:</div><div class='col-md-9'><textarea class='form-control' id='motivo' cols='3' rows='4' placeholder='Ingresa un motivo'></textarea> </div></div><p><div class='row'><div class='col-md-3'>Monto a devolver:</div> <div class='col-md-9'><input class='form-control' id='txt_monto' type='number' placeholder='Ingresa solo importe numérico '> </div></div><p><div class='row'></div><p><div class='row'><div class='col-md-3'>Destino:</div><div class='col-md-9'><select class='form-control' id='banco'><option value='"+tarjeta_dev+"'>"+num_tarjeta+"</option></select></div></div>";//<option value='-' disabled>--------</option>"+BANCOS+"</select></div></div>";
           
            var n3=new Noty({
                text: inputs,
                theme: 'mint',
                layout: "center",
                closeWith: 	['button'],
                modal: true,
                type: "info",
                buttons: [
                Noty.button('Aceptar', 'btn btn-success', function () {
                  var motivo=$('textarea#motivo').val();
                  var monto=$('input#txt_monto').val();
                  var fecha=$('input#fecha_devolucion').val();
                  var banco=$('select#banco').val();
                  
                  if(motivo=="" || monto=="" || fecha==""){
                    generate("warning", "Todos los datos son requeridos");
                  }
                  
                  else if(parseFloat(monto)>=parseFloat(maximo)){
                    generate("warning", "El monto a devolver debe ser menor al de la solicitud");
                  }
                  
                  else{
                    
                      devolucion_solicitud(id, monto, motivo, fecha, banco, $noty);
                    
                  }
                  n3.close();
                }, {id: 'button1', 'data-status': 'ok'}),    
                Noty.button('Cancelar', 'btn btn-danger', function () {
                    n3.close();
                })
                ]
            }); n3.show(); 
            $('.noty_layout').css('width','405px');
            
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
                          ver_solicitudes_por_evento(evento,"todos");
                          noty.close();
                        }
                        else{
                          generate("error", "Error: "+response);
                        }
                      }
                    });
                
              } 

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
                    console.log("transerir odc:"+response);
                    if(response.includes("correcto")){
                      generate("success", "La transferencia ha sido realizada!");
                      n.close();
                      var ev=$('#c_mis_eventos').val();
                      ver_solicitudes_por_evento(ev,"todos");
                    }
                    else{
                      generate("error", "Error: "+response);
                    }
                    ids_odc="";
                  }
                });
            }

            $('#btn_borrar_sdp').click(function(e){
              e.preventDefault();
              var n3=new Noty({
                text: "Ingresa un motivo de borrado<p><input class='form-control' id='motivo' type='text'>",
                theme: 'mint',
                layout: "center",
                closeWith: 	['button'],
                modal: true,
                type: "info",
                buttons: [
                Noty.button('Aceptar', 'btn btn-success', function () {
                  var motivo=$('input#motivo').val();
                    if(motivo==""){
                      generate("warning", "Debe ingresar un motivo");
                    }
                    else{
                      var evento=$('#c_mis_eventos').val();
                      borrar_sdp(motivo, evento, ids_odc, n3);
                    }
                }, {id: 'button1', 'data-status': 'ok'}),    
                Noty.button('Cancelar', 'btn btn-danger', function () {
                    n3.close();
                })
                ]
            }); n3.show(); 
            $('.noty_layout').css('width','405px');
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
                    ver_solicitudes_por_evento(evento,"todos");
                    noty.close();
                  }
                  else{
                    generate("error", "Error: "+response);
                  }
                  ids_odc="";
                }
              });
            }

             $("#zoom").on("change", function() {
              $("#range_valor").html($(this).val()*10+"%");
              var zoom=$(this).val()*10;
              
              $("#resultado_solicitudes").removeClass();
              $("#resultado_solicitudes").addClass("row");
              $("#resultado_solicitudes").addClass("z"+zoom);
              //console.log()
          }); 

            $("#resultado_solicitudes").delegate(".btn-agregar-factura", "click", function(){
              var html="<div>Ingresa el # de factura: <p><input class='form-control' id='numero' type='number'></div><div>Ingresa el importe de la factura: <p><input class='form-control' id='importe' type='number'></div><div>Selecciona el estatus de la factura: <p><select id='estatus' class='form-control'><option value=''>---Selecciona---</option><option value='PAGADO'>PAGADO</option><option value='NOTA CREDITO'>NOTA CREDITO</option><option value='POR COBRAR'>POR COBRAR</option></select></div>";

              var n3=new Noty({
                text: html,
                theme: 'mint',
                layout: "center",
                closeWith: 	['button'],
                modal: true,
                type: "info",
                buttons: [
                Noty.button('Aceptar', 'btn btn-success', function () {
                    var numero=$('input#numero').val();
                     var importe=$('input#importe').val();
                     var estatus=$('select#estatus').val();
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
                       registrar_factura_cliente(numero, importe, estatus, evento, n3);
                       
                     }
                }, {id: 'button1', 'data-status': 'ok'}),    
                Noty.button('Cancelar', 'btn btn-danger', function () {
                    n3.close();
                })
                ]
            }); n3.show(); 
            $('.noty_layout').css('width','405px');
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
                            ver_solicitudes_por_evento(evento, "todos");
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
                               
                                if (numero == "") {
                                  reject('El número de factura no puede ir vacio');
                                }
                                 else if (numero === response) {
                                   reject('Ese número de factura ya esta registrado');
                                 } 
                                 else if(response.includes("existe")){
                                   response=response.replace("existe", " ");
                                  reject('Ese número de factura ya esta registrado en el evento '+response);
                                }
                                 else {
                                     resolve();
                                      if(response.includes("factura agregada")){
                                         setTimeout(function() {
                                          ver_solicitudes_por_evento($('#c_mis_eventos').val(), "todos");
                                              parent.swal({
                                                 type: 'success',
                                                 title: 'Listo',
                                                 html: 'La factura ha sido agregada!'
                                               })
                                             }, 200)
                                         }
                                         else{
                                             setTimeout(function() {
                                             parent.swal({
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

          $("#resultado_solicitudes").delegate(".btn_transferir_factura", "click", function(e) {
            e.preventDefault();
            var T=""
            $.ajax({
              url:   "ver_eventos2.php",
              type:  'post',
              async: false,
              success:  function (response) {
                  //$('#c_transfer').html(response);
                  T=response;
              }
            });
            var ID=$(this).attr("id");
            parent.$('#txt_solicitud').val(ID);
            parent.$('#evento_actual').val($('#c_mis_eventos').val());
            parent.$('#c_eventos_transferir').html(T);
            parent.$('#c_eventos_transferir').trigger('chosen:updated');
            parent.$("#modal_transferir").modal();
            /* const { value: formValues } = Swal.fire({
              title: 'Selecciona un evento a transferir:',
              type: 'question',
              html:
                '<input id="id_solicitud" class="swal2-input" value="'+ID+'">' +
                '<select id="swal-input2" data-placeholder="Choose a country..." class="chosen-select swal2-input">'+T+"</select>",
              focusConfirm: false,
              preConfirm: () => {
                return [
                  document.getElementById('swal-input1').value,
                  document.getElementById('swal-input2').value
                ]
              }
            });
            
            if (formValues) {
              Swal.fire(JSON.stringify(formValues))
            } */
            /* parent.Swal.fire({
              title: 'Seleciona un evento a transferir:',
              input: 'select',
              inputOptions: {
                '1': 'Tier 1',
                '2': 'Tier 2',
                '3': 'Tier 3'
              },
              inputPlaceholder: 'required',
              showCancelButton: true,
              inputValidator: function (value) {
                return new Promise(function (resolve, reject) {
                  if (value !== '') {
                    resolve();
                  } else {
                    resolve('You need to select a Tier');
                  }
                });
              }
            }).then(function (result) {
              if (result.isConfirmed) {
                Swal.fire({
                  icon: 'success',
                  html: 'You selected: ' + result.value
                });
              }
            }); */
            /* var n3=new Noty({
                text: 'Selecciona el evento a transferir: <select class="form-control" id="c_t">'+T+'</select>',
                theme: 'mint',
                layout: "center",
                closeWith: 	['button'],
                modal: true,
                type: "info",
                buttons: [
                Noty.button('Aceptar', 'btn btn-success', function () {
                  var valor=$('#c_mis_eventos').val();
                  var valor2=$('select#c_t').val();
                  if(valor2==valor){
                      generate("warning",'No es posible transferir al mismo evento');
                  }
                  else{
                      transferir_factura(ID, valor2, n3);
                  }
                }, {id: 'button1', 'data-status': 'ok'}),    
                Noty.button('Cancelar', 'btn btn-danger', function () {
                    n3.close();
                })
                ]
            }); n3.show(); 
            $('.noty_layout').css('width','405px'); */
          });

          function transferir_factura(ID, evento, noty){
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
                      if(response.includes("archivo")){
                        generate("success", "La solicitud y archivo(s) han sido transferidos");
                      }
                      else{
                        generate("success", "La solicitud ha sido transferida!!");
                      }
                      var evento=$('#c_mis_eventos').val();
                      ver_solicitudes_por_evento(evento,"todos");
                      noty.close();
                    }
                    else{
                      generate("error", "Ocurrio un error:<p> "+response);
                    }
                  }
                });
          }

          $("#resultado_solicitudes").delegate(".btn_eliminar_factura", "click", function(e) {
            e.preventDefault();
            
            var id=$(this).attr("id");
            var n3=new Noty({
                text: "Ingresa un motivo de borrado<p><input class='form-control' id='motivo' type='text'><i>NOTA: Se eliminará tambien el archivo</i>",
                theme: 'mint',
                layout: "center",
                closeWith: 	['button'],
                modal: true,
                type: "info",
                buttons: [
                Noty.button('Aceptar', 'btn btn-success', function () {
                  var motivo=$('input#motivo').val();
                    if(motivo==""){
                      generate("warning", "Debe ingresar un motivo");
                    }
                    else{
                      
                      borrar_sdf(motivo, id, n3);
                    }
                }, {id: 'button1', 'data-status': 'ok'}),    
                Noty.button('Cancelar', 'btn btn-danger', function () {
                    n3.close();
                })
                ]
            }); n3.show(); 
            $('.noty_layout').css('width','405px');
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
                  ver_solicitudes_por_evento(evento,"todos");
                  noty.close();
                }
                else{
                  generate("error", "Error: "+response);
                }
              }
            });
          }

          $("#resultado_solicitudes").delegate(".btn_borrar_factura", "click", function(e) {
            e.preventDefault();
            var nombre=$(this).attr("id");
            var n3=new Noty({
              text: "¿Desea borrar el documento?",
              theme: 'mint',
              layout: "center",
              closeWith: 	['button'],
              modal: true,
              type: "info",
              buttons: [
              Noty.button('Aceptar', 'btn btn-success', function () {
                  borrar_factura(nombre, n3);
              }, {id: 'button1', 'data-status': 'ok'}),    
              Noty.button('Cancelar', 'btn btn-danger', function () {
                  n3.close();
              })
              ]
          }); n3.show(); 
          $('.noty_layout').css('width','405px');
          });

          function borrar_factura(archivo, noty){
            var datos={
              "archivo":archivo,
            };
            $.ajax({
              url:   'borrar_factura.php',
              type:  'post',
              data: datos,
              success:  function (response) {
                if(response.includes("borrado")){
                  generate('success', 'El documento ha sido eliminado!');
                  var evento = $("#c_mis_eventos").val();
                  ver_solicitudes_por_evento(evento,"todos");
                  noty.close();
                }
                else{
                  generate("Error","Ocurrio un error al eliminar el documento");
                }
              }
            });
          }

          $("#resultado_solicitudes").delegate(".btn_subir_factura", "click", function(e) {
            e.preventDefault();
            var evento=$(this).attr('id');  
            var arr=evento.split("#");
            if(arr[1]=="0"){
              generate("warning","Debe ingresar un numero de factura previo");
            }
            else{
              subir_factura(arr[0],arr[1]);        
            }
        });

        function subir_factura(evento, nombre){
          var n3=new Noty({
            text: '<input type="file" id="btn_factura" class="btn btn-info">',
            theme: 'mint',
            layout: "center",
            closeWith: 	['button'],
            modal: true,
            type: "info",
            buttons: [
            Noty.button('Aceptar', 'btn btn-success', function () {
              if($('input#btn_factura').val() == ''){
                generate('warning', 'Debe seleccionar un archivo');
              }
              else{
                var file_data = $('input#btn_factura').prop('files')[0];   
                var form_data = new FormData();       
                form_data.append('file', file_data);
                form_data.append('evento', evento);
                form_data.append('nombre', nombre);
                $.ajax({
                    url: 'upload_factura.php', // point to server-side PHP script 
                    dataType: 'text',  // what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function(response){
                      if(response.includes("Error")){
                        generate('error',response);
                      }
                      else{
                        var evento = $("#c_mis_eventos").val();
                        ver_solicitudes_por_evento(evento,"todos");
                        generate('success',response);
                      }
                      n3.close();
                    }
                 });
              }
            }, {id: 'button1', 'data-status': 'ok'}),    
            Noty.button('Cancelar', 'btn btn-danger', function () {
                n3.close();
            })
            ]
        }); n3.show(); 
        $('.noty_layout').css('width','405px');
        }
        var estatus_previo="";
        $("#resultado_solicitudes").delegate(".c_estatus_factura", "focus", function() {
          estatus_previo=$(this).val();
        });

        $("#resultado_solicitudes").delegate(".c_estatus_factura", "change", function() {
          var arr=$(this).attr('id').split("_");
          var estatus=$(this).val();
          var usd=arr[0];
          var id=arr[1];
          var fecha_pago="";
          var monto="";
           if(usd=="usd"){
            monto="<div><label>Ingresa el valor del cambio de divisa:</label><input id='valor_divisa' type='number' min='1' class='form-control' value='21'></div>";
            parent.$('#modal_cambio_estatus_factura .ocultar').show();
          } 
          else{
            parent.$('#modal_cambio_estatus_factura .ocultar').hide();
          }
          if(estatus=="PAGADO"){
            parent.$('#id_solicitud_factura').val(id);
            parent.$('#txt_usd').val(usd);
            parent.$('#txt_evento_solicitud').val($('#c_mis_eventos').val());
            parent.$("#modal_cambio_estatus_factura").modal();
            $(this).val(estatus_previo);
            /* var n3=new Noty({
              text: 'Ingresa la fecha de pago: <input type="date" class="form-control" id="txt_fecha_pago">'+monto,
              theme: 'mint',
              layout: "center",
              closeWith: 	['button'],
              modal: true,
              type: "info",
              buttons: [
              Noty.button('Aceptar', 'btn btn-success', function () {
                var fecha_pago=($('input#txt_fecha_pago').val());
                var valor_cambio=($('input#valor_divisa').val());
                  if(fecha_pago==null || fecha_pago==""){
                    generate("warning","La fecha de pago esta vacia");                            
                  }
                  if(usd=="usd"){
                    if(valor_cambio=="" || valor_cambio==null){
                      generate("warning","Ingresa el valor de cambio de divisa");  
                    }
                    else{
                      alert(valor_cambio);
                      actualizar_estatus_factura(id, estatus,fecha_pago, valor_cambio);
                      n3.close();
                    }
                  }
                  else{
                    actualizar_estatus_factura(id, estatus,fecha_pago, "0");
                    n3.close();
                  }
              }, {id: 'button1', 'data-status': 'ok'}),    
              Noty.button('Cancelar', 'btn btn-danger', function () {
                  n3.close();
              })
              ]
          }); n3.show(); 
          $('.noty_layout').css('width','405px'); */
          }
          else{
            actualizar_estatus_factura(id, estatus,fecha_pago,"0");
          }              
        });

        function actualizar_estatus_factura(id,estatus,fecha_pago,divisa){
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
                       parent.swal({
                          type: 'success',
                          title: 'Modificado',
                          html: 'El estatus se ha modificado!'
                        });
                        var evento=$('#c_mis_eventos').val();
                        ver_solicitudes_por_evento(evento,"todos");
                }
                else{
                  generate("error", "Ocurrio un error<br>"+response);
                }
            }
          });

        }

        if(evento!="0"){
          $('#c_mis_eventos').val(evento);
          $('#c_mis_eventos').trigger("chosen:updated");
          ver_solicitudes_por_evento(evento,"todos");
        }

        

      parent.history.pushState({data:true}, 'Titulo', 'home.php');


      $('body').delegate('.boton_descarga', 'click', function(e){
        e.preventDefault();
        var id=$(this).attr('id');
        parent.$.fancybox.open({
            //maxWidth	: 800,
            //maxHeight	: 600,
            fitToView	: true,
            width		: '90%',
            height		: '90%',
            autoSize	: false,
            closeClick	: false,
            openEffect	: 'none',
            closeEffect	: 'none',
            'type'      : 'iframe',
            'href'      : "solicitud_pago.php?id="+id,
        });
   });

  /*  $('body').delegate('.btn_ver_comprobante', 'click', function(e){
    e.preventDefault();
    var id=$(this).attr('id');
    alert(id);
    id=id.replace("#","");
    parent.$.fancybox.open({
        //maxWidth	: 800,
        //maxHeight	: 600,
        fitToView	: true,
        width		: '90%',
        height		: '90%',
        autoSize	: true,
        closeClick	: false,
        openEffect	: 'fade',
        closeEffect	: 'fade',
        'type'      : 'iframe',
        'href'      : "comprobantes/"+id,
    });
}); */

$('body').delegate('.btn_descargar_facturas', 'click', function(e){
  e.preventDefault();
  var id=$(this).attr('id');
  parent.$.fancybox.open({
      //maxWidth	: 800,
      //maxHeight	: 600,
      fitToView	: true,
      width		: '90%',
      height		: '90%',
      autoSize	: false,
      closeClick	: false,
      openEffect	: 'none',
      closeEffect	: 'none',
      'type'      : 'iframe',
      'href'      : "solicitud_factura.php?id="+id,
  });
});



        
}