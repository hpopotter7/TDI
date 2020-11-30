function validar_perfiles(response){
	bienvenido(response.usuario); 
	$(".contenedor").fadeOut();
	$(".contenedor").remove();
	$('#menu_cerrar_evento').remove();
	
	
	if(response.usuario=="ALAN SANDOVAL" || response.usuario=="SANDRA PEÑA"){
		$('#btn_cancelar_evento').show();
		$('#btn_modificar_evento').show();
		$('#guardar_cliente').show();
		$('#check_pendientes2').show();
		$('#menu_prealta').show();
		$('#toggleDemo ul').append("<li><a id='menu_cerrar_evento' href='#'><i class='fas fa-clipboard-check' aria-hidden='true'></i> Cerrar evento</a></li>");
		//agregar al combo clientes de eventos los centros de costos
		//agregar_centros_costos();
	}
	
	else if(response.usuario=="MIGUEL POBLACION"){
		$('#guardar_cliente').show();
		$('#menu_bloqueo_prov').hide();
		$('#menu_bloqueo_prov').remove();
		$('#menu_prealta').hide();
		$('#menu_prealta').remove();
	}
	else{
		$('#menu_prealta').parent().remove();
		$('#menu_prealta').hide();
		$('#menu_bloqueo_prov').parent().remove();
		$('#menu_bloqueo_prov').hide();
		$('#guardar_cliente').remove();
		$('#guardar_cliente').hide();
		$('#btn_modificar_evento').remove();
		$('#btn_modificar_evento').hide();
		$('#btn_cancelar_evento').remove();
		$('#btn_cancelar_evento').hide();
		$('#div_clientes_registrados').show();
		$('#menu_calendario').remove();
		
	}
	
	if(response.cat_cli==""){
		$('#menu_solicitud_cliente').hide();
		$('#menu_solicitud_cliente').remove();
		$('#menu_solicitud_cliente').parent().remove();
		
	}
	else{
		$('#menu_solicitud_cliente').show();
	}
	if(response.cat_prov==""){
		$('#menu_solicitud_prov').hide();
		$('#menu_solicitud_prov').remove();
		$('#menu_solicitud_prov').parent().remove();
	}
	else{
		$('#menu_solicitud_prov').show();
	}
	
	if(response.cat_usu==""){
		$('#usuarios').parent().remove();
		//$('#usuarios').hide();
	}
	else{
		$('#usuarios').show();
	}
	
	//CXP
	
	if(response.cxc==""){
		$('#btn_menu_cxc').hide();
		$('#btn_menu_cxc').remove();
	}
	else{
		$('#btn_menu_cxc').show();
	}
	//Ejecutivo de cuenta

	if(response.eje=="X" || response.eje=="Ejecutivo de cuenta"){
		
	}
	
	
	if(response.eje=="Ejecutivo de cuenta" || response.dire=="Directivo" || response.sol=="Solicitante"){
		$('#menu_modificar_evento').show();
		$('#menu_crear_evento').show();
	}
	else{
		$('#menu_modificar_evento').hide();
		$('#menu_modificar_evento').remove();
		$('#menu_crear_evento').hide();
		$('#menu_crear_evento').remove();
	}

	//Catalogo facturacion
	
	if(response.cat_fact==""){
		$('#solicitud_facturas').hide();
		$('#btn_menu_facturacion').remove();
		$('#solicitud_facturas').parent().remove();
	}
	else{
		$('#solicitud_facturas').show();
		
	}

	//reporte de facturacion
	//$('#btn_rep_gastos').remove();
	if(!response.eje.includes("Ejecutivo de cuenta")){
		if(response.usuario!="ALAN SANDOVAL" || response.usuario!="SANDRA PEÑA" 
		|| response.usuario!="FERNANDA CARRERA" || response.usuario!="ANDRES EMANUELLI"){
		$('#btn_rep_gastos').hide();
		$('#btn_rep_gastos').remove();
		}
	}

	if(response.usuario=="ALAN SANDOVAL" || response.usuario=="SANDRA PEÑA" || response.usuario=="FERNANDA CARRERA"){

	}
	else{
		$('#btn_menu_fac_pendiente').remove();
	}
	



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




}