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

    function validateEmail(email) {
      const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
      return re.test(email);
    }
    
    //ver_clientes();
   /*  function ver_clientes(){//obtener los usuarios registrados
        $.ajax({
              url:   'ver_clientes.php',
              type:  'post',
              success:  function (response) {
                  $('#c_clientes_factura').html(response);
              }
        });
      } */
    
      $('#c_clientes_factura').change(function(){
        //var id=$(this).val();
        var id=$('#c_clientes_factura option:selected').text();
        var datos={
            'clien': id,
          }
           $.ajax({
                url:   "ver_eventos_por_cliente.php",
                type:  'post',
                data: datos,
                success:  function (response) {
                  if(response.includes("datos faltantes")){
                    generate("warning", "Al cliente le faltan datos fiscales");
                  }
                  else{
                    response=response.replace("datos faltantes", "");
                    $('#c_evento_cliente').html(response);  
                  }
                }
              });
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
      });

      //$('#dynamic-syntax-1').inputmask("9-a{1,3}9{1,3}"); 
      //$("#txt_precio_unitario").inputmask({mask:"$9{7}.9{2}"});
      /* $("#txt_precio_unitario").inputmask(
        {
            mask:"$[9{1,3}],[9{1,3}],[9{1,3}].[9{1,2}]",
            greedy:!1,onBeforePaste:function(m,a){return(m=m.toLowerCase()).replace("mailto:","")},
            definitions:{"*":
                {
                    validator:"[0-9A-Za-z!#$%&'*+/=?^_`{|}~-]",
                    cardinality:1,
                    casing:"lower"
                }
            }
        }
    ) */

    var idioma_espaniol = {
        "sProcessing":     "Procesando...",
        "sLengthMenu":     "Mostrar _MENU_ registros",
        "sZeroRecords":    "",
        "sEmptyTable":     "Ningún dato disponible en esta tabla",
        "sInfo":           "",
        "sInfoEmpty":      "",
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


      $('#btn_add_partida').click(function(e){
        e.preventDefault();
        var concepto=$('#txt_concepto_partida').val();
        var pu=$('#txt_precio_unitario').val();
        
        if(concepto=="" || pu==""){            
          generate("info", "No pueden ir datos vacios");
        }
        else{
          var iva=0;
          var total=0;
          //if($('#check_iva').is(':checked')){
            if($('#c_moneda').val()!="MXN"){
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
            
            //$('#txt_concepto_partida').val("");
            $('#txt_precio_unitario').val("");
            $('#c_moneda').attr('disabled', 'disabled');
            $('#c_moneda').selectpicker('refresh');
            validar_totales();
          }
    
      });

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
              if($('#c_moneda').val()=="MXN"){
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

      $('#tabla_partidas tbody').on( 'click', 'tr', function () {
        if ( $(this).hasClass('table-success') ) {
            $(this).removeClass('table-success');
        }
        else {
            t.$('tr.table-success').removeClass('table-success');
            $(this).addClass('table-success');
            
        }
    } );

      $('#btn_quitar').click( function (e) {
            e.preventDefault();
            t.row('.table-success').remove().draw( false );
             validar_totales();
             
        } );

       /*  $('.dark').tooltip({
            template: '<div class="tooltip" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>',
            title: ""
        }); */

        $('[data-toggle="tooltip"]').tooltip();

        $('#btn_limpiar').click(function(e){
            location.reload();
        });

         $('#btn_solicitar_factura').click(function(e){
            var cliente=$('#c_clientes_factura').val();
            var evento=$('#c_evento_cliente').val();
            var dias_credito=$('#txt_dias_credito').val();
            var num_pedido=$('#txt_num_pedido').val();
            var num_entrada=$('#txt_num_entrada').val();
            var orden_compra=$('#txt_orden_compra').val();
            var gr=$('#txt_gr').val();
            var empresa=$('#c_empresa_factura').val();
            var moneda=$('#c_moneda').val();
            
            //partidas
            var correo1=$('#txt_correo_1').val();
            var correo2=$('#txt_correo_2').val();
            var correo3=$('#txt_correo_3').val();
            var correo4=$('#txt_correo_4').val();
            var correo5=$('#txt_correo_5').val();
            var comentarios=$('#area_observaciones').val();
            var bandera=true;
            if(cliente==""){
              generate('info', "Selecciona un cliente");
              bandera=false;
            }
            else if(evento==""){
              generate('info', "Selecciona un evento");
              bandera=false;
            }
            else if(dias_credito==""){
              generate('info', "Ingresa los días de crédito");
              bandera=false;
            }
            else if($('#sumatoria_pu').html()=="$0.00"){
              $('#txt_concepto_partida').scrollTop();
              generate("info", "Debe ingresar al menos una partida");
              bandera=false;
            }
            else if(correo1==""){
              generate('info', "Ingresa al menos un correo electronico");
              bandera=false;
            }
            else if(!validateEmail(correo1)){
              generate('info', "El correo electronico no es válido");
              bandera=false;
            }
            if(bandera){
              var datos = $('#form_solicitud_factura').serializeArray();              
              // agregar los datos de la tabla tabla_partidas
              var data = t.rows().data();
              var largo=data.length-1;
              var partidas_descripcion="";
              var partidas_pu="";
              var partidas_iva="";
              var partidas_total="";
              for(var r=0;r<=largo;r++){
                partidas_descripcion=partidas_descripcion+data[r][0]+"§";
                partidas_pu=partidas_pu+data[r][1]+"§";
                partidas_iva=partidas_iva+data[r][2]+"§";
                partidas_total=partidas_total+data[r][3]+"§";
              }
              //datos.push({name:"cliente", value:cliente});
              datos.push({name:"evento", value:evento});
              datos.push({name:"dias_credito", value:dias_credito});
              datos.push({name:"num_pedido", value:num_pedido});
              datos.push({name:"num_entrada", value:num_entrada});
              datos.push({name:"gr", value:gr});
              datos.push({name:"orden_compra", value:orden_compra});
              datos.push({name:"empresa", value:empresa});
              datos.push({name:"moneda", value:moneda});

              datos.push({name:"partidas_descripcion", value:partidas_descripcion});
              datos.push({name:"partidas_pu", value:partidas_pu});
              datos.push({name:"partidas_iva", value:partidas_iva});
              datos.push({name:"partidas_total", value:partidas_total});
              datos.push({name:"largo", value:largo});

              datos.push({name:"correo1", value:correo1});
              datos.push({name:"correo2", value:correo2});
              datos.push({name:"correo3", value:correo3});
              datos.push({name:"correo4", value:correo4});
              datos.push({name:"correo5", value:correo5});
              datos.push({name:"comentarios", value:comentarios});
              $.ajax({
                url:   'crear_solicitud_factura.php',
                type:  'post',
                data: datos,
                success:  function (response) {
                  console.log(response);
                  if(response.includes("solicitud agregada")){
                    generate("success", "La solicitud se ha registrado");
                    window.open("solicitud_factura.php?id=0",'_blank');
                    location.reload();
                  }
                  else{
                    console.log(response);
                    generate("error","Ocurrio un error: "+response);
                  }
                }
              });
            }
        }); 

       $('#c_clientes_factura').change(function(){
         var id_cliente=$(this).val();
         var datos={"id_cliente": id_cliente};
         
         $.ajax({
          url:   'ver_dias_credito.php',
          type:  'post',
          data: datos,
          success:  function (response) {
            $('#txt_dias_credito').val(response);
          }
        });
       });

        
        
}