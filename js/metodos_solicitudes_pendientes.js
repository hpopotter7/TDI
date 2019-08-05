function inicio(){
    ver_solicitudes_pendientes();
  function generate(type, text) {

            var n = noty({
                text        : text,
                type        : type,
                dismissQueue: true,
                layout      : 'top',
                //closeWith   : ['button'],
                theme       : 'metroui',
                progressBar : true,
                maxVisible  : 5,
                timeout     : [2500],
                animation   : {
                    open  : 'animated slideInDown',
                    close : 'animated slideOutUp',
                    easing: 'swing',
                    speed : 100
                }
            });
            //console.log('html: ' + n.options.id);
            return n;
        }

        $('.dataTables_empty').attr('colspan',3);

        
	   function ver_solicitudes_pendientes(){
    	   $.ajax({
                    url:   'tabla_solicitudes.php',
                    type:  'post',    
                    success:  function (response) {
                      //console.log(response);
                      $('#resultado').html(response);
                    }
            });
        }

        $("#resultado").delegate(".btn", "click", function() {
            var id=this.id;
           swal({
             title: "Agregar pago",
          text: "Ingresa el número de la factura",
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
                                        setTimeout(function() {
                                             swal({
                                                type: 'success',
                                                title: 'Listo',
                                                html: 'Factura agregada: ' + numero
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
                ver_solicitudes_pendientes();
            })
        });


      

 
}
