function inicio(){

    $.ajax({
        url:   "ver_eventos2.php",
        type:  'post',
        async:false,
        beforeSend: function() {
            $('#mensaje').show();
        },
        success:  function (response) {
            console.log(response);
        $('#c_eventos').html(response);
        $('#c_eventos').multipleSelect();
        },
        complete: function() {
            $('#mensaje').hide();
            
        },
    }); 
    $.ajax({
        url:   "ver_clientes.php",
        type:  'post',
        async:false,
        beforeSend: function() {
            $('#mensaje').show();
        },
        success:  function (response) {
            console.log(response);
        $('#c_clientes').html(response);
        $("#c_clientes option[value='vacio']").remove();
        $('#c_clientes').multipleSelect();
        },
        complete: function() {
            $('#mensaje').hide();
        },
    });   

    $.ajax({
        url:   "ver_usuarios_ejecutivos.php",
        type:  'post',
        async:false,
        beforeSend: function() {
            $('#mensaje').show();
        },
        success:  function (response) {
            console.log(response);
        $('#c_ejecutivos').html(response);
        $('#c_ejecutivos').multipleSelect();
        },
        complete: function() {
            $('#mensaje').hide();
        },
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


    $('#btn_buscar').click(function(){
        var evento=$('#txt_razon_social').val();
        var cliente=$('#c_usuario_solicita').val();
        var ejecutivo=$('#c_usuario_solicita').val();
            var datos={
                "evento": evento,
                "cliente": cliente
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
        
    });
    
}