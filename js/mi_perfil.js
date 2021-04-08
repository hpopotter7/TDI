function inicio(){

    ver_permisos();
    ver_vacaciones();
    dias_restantes();

    $('#tab_vacaciones').on('click', function(){
        ver_vacaciones();
    });

    $('#tab_permisos').on('click', function(){
        ver_permisos();
    });

        var hoy = new Date();
        var dia= hoy.getDate();
        var mes=hoy.getMonth()+1;
        var anio=hoy.getFullYear();
        if(mes<10){
            mes="0"+mes;
        }
        var hoyString=dia+"/"+mes+"/"+anio;
        var fi = $('#strong_fecha_ingreso').html().trim();
        var dif=restaFechas(fi,hoyString);
        var dif=dif-1;
        var dif=dif/365;
        var anios = parseFloat(dif);
        anios=anios.toFixed(0);
        var dc;
        $('#antigüedad').html(anios+" años");
        switch(anios){
            case "1":
                dc=6;
                break;
            case "2":
                dc=8;
                break;
            case "3":
                dc=10;
                break;
            case "4":
                dc=12;
                break;
            case "5": case "6": case "7": case "8": case "9":
                dc=14;
                break;
            case "10": case "11": case "12": case "13": case "14":
                dc=16;
                break;
            case "15": case "16": case "17": case "18": case"19":
                dc=18;
                break;
            case "20": case "21": case "22": case "23": case "24":
                dc=20;
                break;
            default:
                dc=22;
                break;
        }
        $('#dias_correspondientes').html(dc);
        

    $(".fecha").datepicker({
        dateFormat: 'dd/mm/yy',
        firstDay: 0,
        minDate:0,
    });

    $('#fecha_inicio').change(function() {
        var fi=$(this).val();
        var arr=fi.split("/");
        
        
        $("#fecha_fin").datepicker({
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            minDate: 0,
        });
    });

    $(".fecha_permiso").datepicker({
        dateFormat: 'dd/mm/yy',
        firstDay: 0,
        minDate: 0,
    });

    $("#fecha_regreso").datepicker({
        dateFormat: 'dd/mm/yy',
        firstDay: 0,
        minDate: 0,
    });
    
    $('#btn_solicitar').on('click', function(){
        $('#txt_id_vacaciones').val("0");
        $('#fecha_inicio').val("");
        $('#fecha_fin').val("");
        $('#txt_dias').val("");
        $('#fecha_regreso').val("");
        $('#modal_vacaciones').modal();
    });

    $('body').delegate('.btn_editar', 'click', function(){
        var id=$(this).attr('id');
        $('#txt_id_vacaciones').val(id);        
        obtener_solicitud(id);
        $('#modal_vacaciones').modal();
    });

    function ver_permisos(){
        $.ajax({
            url:   "ver_tabla_permisos.php",
            type:  'post',
            success:  function (response) {
                $('#body_permisos').html(response);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("error");
                console.log(xhr.responseText);
            }
          });
    }

    function ver_vacaciones(){
        $.ajax({
            url:   "ver_tabla_vacaciones.php",
            type:  'post',
            success:  function (response) {
                $('#body_vacaciones').html(response);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("error");
                console.log(xhr.responseText);
            }
          });
          dias_restantes();
    }

    function dias_restantes(){
        $.ajax({
            url:   "ver_dias_disfrutados.php",
            type:  'post',
            success:  function (response) {
                var resta=$('#dias_correspondientes').html()-response.trim();

                $('#dias_restantes').html(resta);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("error");
                console.log(xhr.responseText);
            }
          });
    }

    function obtener_solicitud(id){
        var datos={"id":id};
        $.ajax({
            url:   "ver_sol_vacaciones.php",
            type:  'post',
            data: datos,
            dataType: "json",
            success:  function (response) {
                console.log(response);
                $('#fecha_inicio').val(response.fecha_inicio);
                $('#fecha_fin').val(response.fecha_fin);
                $('#txt_dias').val(response.dias);
                $('#fecha_regreso').val(response.fecha_regreso);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("error");
                console.log(xhr.responseText);
            }
          });
    }

    $('.fecha_permiso').change(function (ev) {
        var f_inicio = $('#fecha_inicio_permiso').val();
        var f_final = $('#fecha_fin_permiso').val();
        var dif=restaFechas(f_inicio,f_final);
        if(dif<=0){
            $("#error_permiso").html("La fecha de inicio debe ser anterior a la fecha final");
            $('#txt_dias_permiso').val("");
        }
        else{
            $("#error_permiso").html("");
            $('#txt_dias_permiso').val(dif);
            var dia_siguiente=sumaFecha(1,f_final);
            var sep = dia_siguiente.indexOf('/') != -1 ? '/' : '-';
            var aFecha = dia_siguiente.split(sep);
            var fecha=new Date();
            fecha.setDate(aFecha[0]);
            fecha.setMonth(aFecha[1]-1);
            fecha.setYear(aFecha[2]); 
            var dia=fecha.getDay();
            if(dia==0){
                dia_siguiente=sumaFecha(1,dia_siguiente);
            }
            if(dia==6){
                dia_siguiente=sumaFecha(2,dia_siguiente);
            }
            //$("#fecha_regreso").datepicker("setDate", dia_siguiente);
        }
    });

        $('.fechas_vacaciones').change(function (ev) {
        var f_inicio = $('#fecha_inicio').val();
        var f_final = $('#fecha_fin').val();
        var dif=restaFechas(f_inicio,f_final);
        var dias = $('#dias_restantes').html();
        if(dif<=0){
            $("#modal_error").html("La fecha de inicio debe ser anterior a la fecha final");
            $('#txt_dias').val("");
            $('#fecha_fin').val('');
            $('#fecha_regreso').val('');
        }
        else if(dif>dias){
            $("#modal_error").html("Solo se tiene disponible "+dias+" días");
            $('#txt_dias').val("");
            $('#fecha_fin').val('');
            $('#fecha_regreso').val('');
        }
        else{
            $("#modal_error").html("");
            $('#txt_dias').val(dif);
            var dia_siguiente=sumaFecha(1,f_final);
            var sep = dia_siguiente.indexOf('/') != -1 ? '/' : '-';
            var aFecha = dia_siguiente.split(sep);
            var fecha=new Date();
            fecha.setDate(aFecha[0]);
            fecha.setMonth(aFecha[1]-1);
            fecha.setYear(aFecha[2]); 
            var dia=fecha.getDay();
            if(dia==0){
                dia_siguiente=sumaFecha(1,dia_siguiente);
            }
            if(dia==6){
                dia_siguiente=sumaFecha(2,dia_siguiente);
            }
            $("#fecha_regreso").datepicker("setDate", dia_siguiente);
        }
    });


   function sumaFecha (d, fecha){
     var Fecha = new Date();
     var sFecha = fecha || (Fecha.getDate() + "/" + (Fecha.getMonth() +1) + "/" + Fecha.getFullYear());
     var sep = sFecha.indexOf('/') != -1 ? '/' : '-';
     var aFecha = sFecha.split(sep);
     var fecha = aFecha[2]+'/'+aFecha[1]+'/'+aFecha[0];
     fecha= new Date(fecha);
     fecha.setDate(fecha.getDate()+parseInt(d));
     var anno=fecha.getFullYear();
     var mes= fecha.getMonth()+1;
     var dia= fecha.getDate();
     mes = (mes < 10) ? ("0" + mes) : mes;
     dia = (dia < 10) ? ("0" + dia) : dia;
     var fechaFinal = dia+sep+mes+sep+anno;
     return (fechaFinal);
     }

    function restaFechas(f1,f2){
        var aFecha1 = f1.split('/');
        var aFecha2 = f2.split('/');
        var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]);
        var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]);
        var dif = fFecha2 - fFecha1;
        var dias = Math.floor(dif / (1000 * 60 * 60 * 24));
        return dias+1;
    }

    $('#btn_aceptar').click(function(){
        var id_vacaciones = $('#txt_id_vacaciones').val();
        var f_inicio = $('#fecha_inicio').val();
        var f_final = $('#fecha_fin').val();
        var dias= $('#txt_dias').val();
        var fecha_regreso= $('#fecha_regreso').val();
        if(f_inicio=="" || f_inicio==null){
            Swal.fire('Error!', 'Debe seleccionar una fecha de inicio', 'warning');
        }
        else if(f_final=="" || f_final==null){
            Swal.fire('Error!', 'Debe seleccionar una fecha fin', 'warning');
        }
        else if(dias=="" || dias=="NaN" || fecha_regreso=="" || fecha_regreso==null){

        }
        else{        
            var arr = f_inicio.split("/");
            f_inicio=arr[2]+"-"+arr[1]+"-"+arr[0];
            arr = f_final.split("/");
            f_final=arr[2]+"-"+arr[1]+"-"+arr[0];
            arr = fecha_regreso.split("/");
            fecha_regreso=arr[2]+"-"+arr[1]+"-"+arr[0];
            var datos={
                "f_inicio":f_inicio,
                "f_final":f_final,
                "dias":dias,
                "fecha_regreso":fecha_regreso,
                "id_vacaciones":id_vacaciones
            };
            $.ajax({
                url:   "agregar_vacaciones.php",
                type:  'post',
                data: datos,
                success:  function (response) {
                    if(response.includes("guardada")){
                        $('.modal').click();
                        Swal.fire({
                            type: 'success',                  
                            html: 'La solicitud ha sido guardada',
                        });
                        ver_vacaciones();
                    }
                    else if(response.includes("modificada")){
                        $('.modal').click();
                        Swal.fire({
                            type: 'success',                  
                            html: 'La solicitud ha sido modificada',
                        });
                        ver_vacaciones();
                    }
                    else{
                        Swal.fire({
                            type: 'error',                  
                            html: 'Error: '+response,
                        });
                    }
                },
                });
        }
    });
    
    $('body').delegate('.btn_borrar', 'click', function(){
        var id_vacaciones=$(this).attr('id');
        datos={"id_vacaciones":id_vacaciones};
        Swal.fire({
            type: 'warning',
            title: '¿Deseas eliminar la solicitud de vacaciones?',
            showCancelButton: true,
            confirmButtonText: `Aceptar`,
            cancelButtonText: `Cancelar`,
            confirmButtonColor: "#5E9008",
              cancelButtonColor: "#fff",
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            console.log(result);
            if (result.value) {
                $.ajax({
                    url:   "eliminar_sol_vacaciones.php",
                    type:  'post',
                    data: datos,
                    success:  function (response) {
                        if(response.includes("eliminada")){
                            Swal.fire('Eliminada!', 'La solicitud ha sido eliminada', 'success');
                            ver_vacaciones();
                        }
                        else{
                            Swal.fire('Opps!', response, 'warning');
                        }
                        
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert("error");
                        console.log(xhr.responseText);
                    }
                  });
              
            } 
          })
    });


    // permisos
    $('#btn_solicitar_permiso').click(function(){
        var id_permiso = $('#txt_id_permiso').val();
        var f_inicio = $('#fecha_inicio_permiso').val();
        var f_final = $('#fecha_fin_permiso').val();
        var dias= $('#txt_dias_permiso').val();
        var tipo=$('#c_tipo_permiso').val();
        
        if(tipo=="" || tipo==null){
            Swal.fire({
                type: 'warning',                  
                html: 'Debe seleccionar un tipo de permiso',
              });
        }
        if(f_inicio=="" || f_inicio==null){
            Swal.fire({
                type: 'warning',                  
                html: 'Debe seleccionar una fecha de inicio',
              });
        }
        else if(f_final=="" || f_final==null){
            Swal.fire({
                type: 'warning',                  
                html: 'Debe seleccionar una fecha final',
              });
        }
        else{
            var arr = f_inicio.split("/");
            f_inicio=arr[2]+"-"+arr[1]+"-"+arr[0];
            arr = f_final.split("/");
            f_final=arr[2]+"-"+arr[1]+"-"+arr[0];
        var datos={
            "f_inicio":f_inicio,
            "f_final":f_final,
            "tipo":tipo,
            "dias":dias,
            "id_permiso":id_permiso,
          };
          $.ajax({
              url:   "agregar_permiso.php",
              type:  'post',
              data: datos,
              success:  function (response) {
                if(response.includes("guardado")){
                    Swal.fire({
                        type: 'success',                  
                        html: 'La solicitud ha sido guardada',
                      });
                      ver_permisos();
                      $('#c_tipo_permiso').val('');
                      $('#fecha_inicio_permiso').val('');
                      $('#fecha_fin_permiso').val('');
                      $('#txt_dias_permiso').val('');
                }
                else if(response.includes("modificado")){
                        Swal.fire({
                            type: 'success',                  
                            html: 'La solicitud ha sido modificada',
                          });
                          ver_permisos();
                          $('#c_tipo_permiso').val('');
                          $('#fecha_inicio_permiso').val('');
                          $('#fecha_fin_permiso').val('');
                          $('#txt_dias_permiso').val('');
                }
                else{
                    Swal.fire({
                        type: 'error',                  
                        html: 'Error: '+response,
                      });
                }
              },
            });
        }
    });

    $('body').delegate('.btn_borrar_permiso', 'click', function(){
        var id_permiso=$(this).attr('id');
        datos={"id_permiso":id_permiso};
        Swal.fire({
            type: 'warning',
            title: '¿Deseas eliminar la solicitud de ausencia?',
            showCancelButton: true,
            confirmButtonText: `Aceptar`,
            cancelButtonText: `Cancelar`,
            confirmButtonColor: "#5E9008",
              cancelButtonColor: "#fff",
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            console.log(result);
            if (result.value) {
                $.ajax({
                    url:   "eliminar_permiso.php",
                    type:  'post',
                    data: datos,
                    success:  function (response) {
                        if(response.includes("eliminado")){
                            Swal.fire('Eliminada!', 'El permiso ha sido eliminado', 'success');
                            ver_permisos();
                        }
                        else{
                            Swal.fire('Opps!', response, 'warning');
                        }
                        
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert("error");
                        console.log(xhr.responseText);
                    }
                  });
            } 
          })
    });

    $('body').delegate('.btn_editar_permiso', 'click', function(){
        var id=$(this).attr('id');
        $('#txt_id_permiso').val(id);
        obtener_permiso(id);
    });

    function obtener_permiso(id){
        var datos={"id":id};
        $.ajax({
            url:   "ver_permiso.php",
            type:  'post',
            data: datos,
            dataType: "json",
            success:  function (response) {
                console.log(response);
                $('#c_tipo_permiso').val(response.tipo);
                $('#fecha_inicio_permiso').val(response.fecha_inicio);
                $('#fecha_fin_permiso').val(response.fecha_fin);
                $('#txt_dias_permiso').val(response.dias);
                
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert("error");
                console.log(xhr.responseText);
            }
          });
    }

    $('#btn_limpiar').on('click', function(){
        $('#txt_id_permiso').val("0");
        $('#fecha_inicio_permiso').val('');
        $('#fecha_fin_permiso').val('');
        $('#txt_dias_permiso').val('');
        $('#c_tipo_permiso').val('');
    });
}