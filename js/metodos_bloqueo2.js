function inicio(){

    ver_proveedores();

    function ver_proveedores(){
        $.ajax({
            url:   "ver_proveedores_bloqueados.php",
            type:  'post',
            success:  function (response) {
            $('#c_proveedores').html(response);
            
            }
        });
        $.ajax({
            url:   "ver_clientes_todos.php",
            type:  'post',
            success:  function (response) {
            $('#c_clientes').html(response);
            
            }
        });
    }
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

            $('.radios').click(function(){
                var prov=$('#c_proveedores').val();
                var estatus=$(this).val();
                actualizar_estatus(prov, estatus, "proveedores");
            });
            $('.radios_cl').click(function(){
                var prov=$('#c_clientes').val();
                var estatus=$(this).val();
                actualizar_estatus(prov, estatus, "clientes");
            });

        function actualizar_estatus(prov, estatus, tabla){
            var datos={
                "prov": prov,
                "estatus":estatus,
                "tabla":tabla,
            };
            if(prov!="vacio"){
                $.ajax({
                    url:   "update_estatus_proveedor.php",
                    type:  'post',
                    data: datos,
                    success:  function (response) {
                    ver_proveedores();
                    if(response.includes('exito')){
                        $('.radios').prop('checked', false);
                        $('.radios_cl').prop('checked', false);
                        generate("success","Proveedor actualizado!");
                    }
                    else{
                        $('.radios').prop('checked', false);
                        $('.radios_cl').prop('checked', false);
                        generate("warning","Ocurrio un error: "+response);
                    }
                    }
                });
                
            }
        }

    $('.combo').change(function(){
        var tipo="clientes";
        var prov="";
        if($(this).attr('id')=="c_proveedores"){
            tipo="proveedores";
            prov=$('#c_proveedores').val();
            if(prov!="vacio"){
                ver_estatus(prov, tipo);  
            }
        }
        else{
            prov=$('#c_clientes').val();
            if(prov!="vacio"){
                ver_estatus(prov, tipo);  
            }
        }
    });

    function ver_estatus(prov, tipo){
        var datos={
            "prov": prov,
            "tipo": tipo,
        };
         $.ajax({
            url:   "estatus_proveedor.php",
            type:  'post',
            data: datos,
            success:  function (response) {                
            if(tipo=="clientes"){
                if(response.includes('activo')){
                    $('#radio_activo_cl').prop('checked', true);
                    $('#radio_bloq_cl').prop('checked', false);
                }
                else{
                    $('#radio_activo_cl').prop('checked', false);
                    $('#radio_bloq_cl').prop('checked', true);
                }
            }
            else{
                if(response.includes('activo')){
                    $('#radio_activo').prop('checked', true);
                    $('#radio_bloq').prop('checked', false);
                }
                else{
                    $('#radio_activo').prop('checked', false);
                    $('#radio_bloq').prop('checked', true);   
                }
            }
            }
        }); 
    }
    
}