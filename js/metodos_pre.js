function inicio(){

    $.ajax({
        url:   "ver_usuarios.php",
        type:  'post',
        success:  function (response) {
        $('#c_usuario_solicita').html(response);
        
        }
    });   

    function generate(type, text) {    
                var n = noty({
                    text        : text,
                    type        : type,
                    dismissQueue: true,
                    layout      : 'topCenter',  //bottomLeft
                    progressBar : true,
                    maxVisible  : 10,
                    timeout     : [3000],
                    
                });
                return n;
            }


    $('#btn_registrar').click(function(){
        var razon=$('#txt_razon_social').val();
        var usuario=$('#c_usuario_solicita').val();
        if(razon==""){
            generate('warning', 'Debe de ingresar nombre');
        }
        else if(usuario=="vacio"){
            generate('warning', 'Debe de seleccionar a un usuario');
        }
        else{
            var datos={
                "razon": razon,
                "usuario": usuario
            };
             $.ajax({
                url:   "pre_alta.php",
                type:  'post',
                data: datos,
                success:  function (response) {
                console.log(response);
                if(response.includes('cliente agregado')){
                    generate('success', 'El cliente ha sido agregado');
                    $('#txt_razon_social').val('');
                }
                else{
                    generate('error', 'Ocurrio un error'+response);
                }
                
                }
            });           
        }
    });
    
}