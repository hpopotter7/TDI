function validar_perfiles(response){
	bienvenido(response.usuario); 
	if(response.usuario=="ALAN SANDOVAL" || response.usuario=="SANDRA PEÑA"){
		$('#btn_cancelar_evento').show();
		$('#btn_modificar_evento').show();
		$('#guardar_cliente').show();
		$('#check_pendientes2').show();
		$('#menu_prealta').show();
		
		//agregar al combo clientes de eventos los centros de costos
		//agregar_centros_costos();
		
	}
	else{
		$('#menu_prealta').hide();
		$('#guardar_cliente').hide();
		$('#btn_modificar_evento').hide();
		$('#btn_cancelar_evento').hide();
		$('#div_clientes_registrados').show();
		$('.combo_clientes option[value="248&GASTO"]', ).remove();
	}
	
	if(response.cat_cli==""){
		$('#menu_solicitud_cliente').hide();
	}
	else{
		$('#menu_solicitud_cliente').show();
	}
	if(response.cat_prov==""){
		$('#menu_solicitud_prov').hide();
	}
	else{
		$('#menu_solicitud_prov').show();
	}
	if(response.cat_usu==""){
		$('#usuarios').hide();
	}
	else{
		$('#usuarios').show();
	}
	
	//CXP
	
	if(response.cxc==""){
		$('#menu_cerrar_evento').hide();
		$('#btn_menu_cxc').hide();
	}
	else{
		$('#menu_cerrar_evento').show();
		$('#btn_menu_cxc').show();
	}
	//Ejecutivo de cuenta
	
	if(response.eje=="Ejecutivo de cuenta" || response.dire=="Directivo"){
		$('#menu_modificar_evento').show();
		$('#menu_crear_evento').show();
	}
	else{
		$('#menu_modificar_evento').hide();
		$('#menu_crear_evento').hide();
	}

	//Catalogo facturacion
	
	if(response.cat_fact==""){
		$('#solicitud_facturas').hide();
		$('#solicitud_facturas').hide();
	}
	else{
		$('#solicitud_facturas').show();
		$('#solicitud_facturas').show();
	}
/*
	if(response.dire==""){
		$('#menu_modificar_evento').hide();
		$('#menu_crear_evento').hide();
	}
	else{
		$('#menu_modificar_evento').show();
		$('#menu_crear_evento').show();
	}
	*/
}
/*
function agregar_centros_costos(){
	$.ajax({
          url: 'agregar_centros_costo.php',
          type: 'post',
          success: function(response){
          	alert(response);
          	$('#c_cliente').append(response);
          	 //console.log(response);
          }
      });
}*/

function bienvenido(usuario){
	var texto="Bienvenid@ "+usuario;
	var n = noty({
                text        : texto,
                type        : 'success',
                dismissQueue: true,
                layout      : 'topCenter',  //bottomLeft
                animation: {
			         open: 'animated fadeInDownBig',
		            close: 'animated flipOutX',
		            easing:'swing',
		            speed:500
			    },
                //closeWith   : ['button'],
                theme       : 'relax',
                progressBar : false,
                maxVisible  : 5,
                timeout     : [3200],
                
            });
}