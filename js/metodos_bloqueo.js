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
                var datos={
                    "prov": prov,
                    "estatus":estatus,
                };
                if(prov!="vacio"){
                    $.ajax({
                        url:   "update_estatus_proveedor.php",
                        type:  'post',
                        data: datos,
                        success:  function (response) {
                            console.log(response);
                            ver_proveedores();
                        if(response.includes('exito')){
                            $('#radio_activo').prop('checked', false);
                            $('#radio_bloq').prop('checked', false);
                            generate("success","Proveedor actualizado!");
                        }
                        else{
                            $('#radio_activo').prop('checked', false);
                            $('#radio_bloq').prop('checked', false);
                            generate("warning","Ocurrio un error");
                        }
                        }
                    });
                    
                }
            });

    $('#c_proveedores').change(function(){
        var prov=$('#c_proveedores').val();
        if(prov!="vacio"){
            var datos={
                "prov": prov,
            };
             $.ajax({
                url:   "estatus_proveedor.php",
                type:  'post',
                data: datos,
                success:  function (response) {
                if(response.includes('activo')){
                    $('#radio_activo').prop('checked', true);
                    $('#radio_bloq').prop('checked', false);
                }
                else{
                    $('#radio_activo').prop('checked', false);
                    $('#radio_bloq').prop('checked', true);
                }
                }
            });           
        }
    });
    
}