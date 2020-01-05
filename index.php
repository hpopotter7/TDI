<!DOCTYPE html>
<html lang="es">
<head>
  <title>ERP Tierra de ideas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="stylesheet" href="css/jquery.fancybox.css" />
  
  <link rel="stylesheet" href="css/animate.css"/>
  <link rel="stylesheet" href="css/sweetalert2.css"/>  
  <link rel="stylesheet" href="css/bootstrap.toogle.min.css" >
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap.min2.css">
  <link rel="stylesheet" href="css/introjs.css"/>
  <link rel="stylesheet" href="css/estilos_ver_0003.css"/>
  <link rel="stylesheet" href="css/estilos_menu_user.css"/>
  <link rel="stylesheet" href="css/jquery-ui_theme_green.css"/>
  <link rel="stylesheet" href="css/jquery-ui_green.css"/>
  <link rel="stylesheet" href="css/bootstrap-multiselect.css"/>
  <link rel="stylesheet" href="css/tooltipster.bundle.css" />
  <link rel="stylesheet" href="css/data_tables.css">
  <link rel="stylesheet" href="css/uploadfile.css">
  <link rel="stylesheet" href="css/jquery_combo_editable.css">
  <link rel="stylesheet" href="css/easy-autocomplete.css" />
  <link rel="stylesheet" href="css/easy-autocomplete.themes.css""/>
  <link rel="stylesheet" href="css/jquery.modal.css"/>
  <link rel="stylesheet" href="css/menu.css"/>

  <script src="js/jquery-1.11.2.js"></script>
  <script src="js/jquery-ui-v1.11.4.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/jquery.ui.shake.js"></script>    
  <script src="js/bootstrap.min.js"></script>
  <script src="js/core.js"></script>
  <script src="js/sweetalert2.min.js"></script>
  <script src="js/jquery_validator.js"></script>
  <script src="js/bootstrap-toogle.min.js"></script>
  <script src="js/datepicker.js"></script>
  <script src="js/cantidad_letra.js"></script>
  <script src="js/bootstrap-filestyle.min.js"></script>
  <script src="js/animate.js"></script>
  <script src="js/bootstrap-multiselect.js"></script>
  <script src="js/noty/packaged/jquery.noty.packaged.js"></script>
  <script src="js/notification_html.js"></script>
  <script src="js/jquery.fancybox.js"></script>
  <script src="js/jquery.mousewheel.pack.js"></script>
  <script src="js/dataTables.js"></script>
  <script src="js/jquery.formatCurrency.js"></script>
  <script src="js/tooltipster.bundle.js"></script>
  <script src="js/funciones_v100.js"></script>
  <script src="js/jquery.validate.min.js"></script>
  <script src="js/jquery.uploadfile.js"></script>
  <script src='js/DateTables.js'></script>
  <script src="js/accounting.js"></script>
  <script src="js/jquery_combo_editable.js"></script>
  <script src="js/autocomplete.js"></script>

  <script src="js/dataTables.buttons.min.js"></script>
  <script src="js/buttons.flash.min.js"></script>
  <script src="js/jszip.min.js"></script>
  <script src="js/pdfmake.min.js"></script>
  <script src="js/vfs_fonts.js"></script>
  <script src="js/buttons.html5.min.js"></script>
  <script src="js/buttons.print.min.js"></script>
  <script src="js/jspdf.min.js"></script>
  <script src="js/jquery.easy-autocomplete.js"></script>
  <script src="js/audio.min.js"></script>
  <script src="js/jquery.modal.js"></script>
  
  
  <script src="js/metodos_v2_0001.js"></script>
  <script>
    $.fn.dataTable.Api.register( 'column().data().sum()', function () {
    return this.reduce( function (a, b) {
        var x = parseFloat( a ) || 0;
        var y = parseFloat( b ) || 0;
        return x + y;
    } );
} );
    $(document).on("ready",inicio);  
  </script> 
  <style>
.dropdown-submenu {
  position: relative;
}

.dropdown-submenu .dropdown-menu {
  top: 0;
  left: 100%;
  margin-top: -1px;
  #
}
</style>
<!--
  Estilo bubble button  
-->

  <style>
  .ui-tooltip {
    background: black;
    border: 2px solid white;
  }
  .ui-tooltip {
    padding: 10px 20px;
    border-radius: 20px;
    font: bold 14px "Helvetica Neue", Sans-Serif;
    text-transform: uppercase;
    box-shadow: 0 0 7px black;
  }

  </style>

</head>
<body>
  <audio id="audio_error">
   <source src="audio/error.mp3" type="audio/mp3" />
   <source src="audio/error.wav" type="audio/wav" />
</audio>
<audio id="audio_ding">
   <source src="audio/tada.mp3" type="audio/mp3" />
   <source src="audio/tada.wav" type="audio/wav" />
</audio>
  <div id="notificaciones" class="quick-btn cambio">
  <span id='badge_numero_notificaciones' class="label label-danger" style='font-size:95%; vertical-align:top;'></span>
  <i class="fas fa-user fa-2x" style='color:black'></i>
  <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      
                        <strong id='label_user' style='color:black; font-size:1.2em;'></strong>
                        <i class="fas fa-chevron-down fa-2x" style='color:black;padding-right:.3em;'></i> 
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="text-left"></p>
                                        <p id='tipo_perfil' class="text-left">Tipo perfil</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p><a class="various btn btn-info btn-block" data-fancybox-type="iframe" href="ver_tutoriales.html"><i class="fas fa-question-circle"></i> Ayuda</a>
                                            <a href="javascript:window.location.href=window.location.href" class="btn btn-danger btn-block"> <i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
            <!--
  <a id='btn_notificaciones' href="#" ">
        <i class="fa fa-user fa-2x" style='color:black'></i> <label style='text-align: left; color:black; font-size:1.4em; padding-left: 1em; text-decoration: none;'></label> 
  </a>
  -->
  <a id='btn_cerrar_bitacora' href="#" >
        <i class="fa fa-close fa-2x" style='color:black'></i>  
          
  </a>
   
  <section id='resultado_bitacora'>
  
  </section>
      <!-- <div class="row" style='background-color:white'>
        <aside class="dropdown-item dropdown-notification">
            <div class="col-md-12" style='text-align: left;'>
              <span class="btn btn-primary" >Solicitud de modificación a evento</span><br>
              <span style="color:black">
                <i class="fa fa-user" aria-hidden="true"></i> ANGELA OLEA
              </span>
              <br>
              <span style="color:black">
                <i class="fa fa-clock-o" aria-hidden="true"></i> 08/11/19 03:12 PM
              </span>
            </div>
          </aside>
      </div> -->
  </div>



  <div id='div_cortina'></div>
  <input id='input_oculto' name='input_oculto' type="hidden">
  <!--
  <nav id='nav' class="navbar navbar-default">
    <div class="container-fluid">
      
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><img id="nav_logo" src="img/logo.png" alt=""></a>
      </div>
      
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Eventos <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a id='menu_crear_evento' class='item_menu' href="#"><i class="fa fa-file-text" aria-hidden="true"></i> Crear Evento</a></li>
              <li><a id='menu_modificar_evento' class='item_menu' href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar Evento</a></li>
              <li class='solo_admin'><a id='menu_cerrar_evento' class='item_menu' href="#"><i class="fa fa-archive" aria-hidden="true"></i> Cerrar Evento</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Solicitudes<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a id='menu_solicitud_odc' href="#" class='item_menu'><i class="fa fa-product-hunt" aria-hidden="true"></i> Solicitud de pago</a></li>
              <li><a id='menu_solicitud_viaticos' href="#" class='item_menu'><i class="fa fa-vimeo" aria-hidden="true"></i> Solicitud de viáticos</a></li>
              <li><a id='menu_solicitud_reembolso' href="#" class='item_menu'><i class="fa fa-registered" aria-hidden="true"></i> Solicitud de reembolso</a></li>
              <li><a id='menu_ver_formatos' href="#" class='item_menu'><i class="fa fa-list-ul" aria-hidden="true"></i> Ver solicitudes</a></li>
            </ul>
          </li>
          <li id='nav_catalogos' class="dropdown">
            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catálogos<span class="caret"></span></a>
            <ul class="dropdown-menu">
              xx
              comentario
               <li><a id='menu_solicitud_cliente' href="#" class='item_menu'><i class="fa fa-user-circle-o" aria-hidden="true"></i> Alta de cliente</a></li>
               xx
             
            <li class="dropdown-submenu">
              <a class="test" tabindex="-1" href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Alta de cliente <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a tabindex="-1" id='menu_prealta' href="pre_alta.html" target="_blank"><i class="fa fa-font-awesome" aria-hidden="true"></i> Pre-alta </a></li>
                  <li><a tabindex="-1" id='menu_solicitud_cliente' href="#"><i class="fa fa-font-awesome" aria-hidden="true"></i> Nacional </a></li>
                  <li class='disabled'><a tabindex="-1" href="#" id='menu_solicitud_cliente_ex' class='disabled' disabled><i class="fa fa-eur" aria-hidden="true"></i> Extranjero </a></li>
                </ul>
              </li>


              <li><a id='menu_solicitud_prov' href="#" class='item_menu'><i class="fa fa-building" aria-hidden="true"></i> Alta de proveedor</a></li>
              <li class='solo_admin'><a id='usuarios'  href="#" class='item_menu'><i class="fa fa-users" aria-hidden="true"></i> Usuarios</a></li>              
            </ul>
          </li>
          
          <li class="dropdown" >
            <a  id='btn_menu_cxc' href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" disabled="">CxP<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a tabindex="-1" id='menu_tarjetas' href="#" class='item_menu'><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Ver tarjetas</a></li>
            </ul>
          </li>
          <li id='nav_reportes' class="dropdown">
            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Base de datos<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class=""><a id='rep_eventos' href="#" class='item_menu'><i class="fa fa-file-text" aria-hidden="true"></i> Eventos</a></li>
              <li class=""><a id='rep_cat_clientes' href="#" class='item_menu'><i class="fa fa-user-circle-o" aria-hidden="true"></i> Clientes</a></li>
              xx
              comentario
              <li class=""><a id='rep_cat_clientes' href="#" class='item_menu'><i class="fa fa-user-circle-o" aria-hidden="true"></i> Clientes</a></li>
              xx
              <li class=""><a id='rep_cat_proveedores' href="#" class='item_menu'><i class="fa fa-building" aria-hidden="true"></i> Proveedores</a></li>
              <li class="hidden"><a id='rep_usuarios' href="#" class='item_menu disabled' disabled><i class="fa fa-users" aria-hidden="true"></i>  Usuarios</a></li>
            </ul>
          </li>
          <li id='nav_facturacion' class="dropdown">
            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Facturación<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a id='solicitud_facturas' href="#" class='item_menu'><i class="fa fa-gg" aria-hidden="true"></i> Solicitud de facturas</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-user"></span> 
                        <strong id='label_user'></strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="navbar-login">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p class="text-left"></p>
                                        <p id='tipo_perfil' class="text-left small">Tipo perfil</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <p><a class="various btn btn-info btn-block" data-fancybox-type="iframe" href="ver_tutoriales.html">Ayuda</a>
                                            <a href="javascript:window.location.href=window.location.href" class="btn btn-danger btn-block">Cerrar Sesion</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
      </div>
    </div>
  </nav>
  

<div class="primary-nav nav">
<button class='nav-toggle' style='background:#BBD32A;'>
<img id="nav_logo" src="img/logo.png" alt="" class='hamburger open-panel '>
</button>
<nav role="navigation" class="menu nav">  
  <div class="overflow-container" id='lista_menu'>
    <ul class="menu-dropdown ">
      
    <li class="menu-hasdropdown ">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Eventos</a><span class="icon"><i class="fas fa-crown fa-2x"></i></span>
        <label title="toggle menu" for="eventos">
          <span class="downarrow"><i class="fa fa-caret-down fa-2x"></i></span>
        </label>
        <input type="checkbox" class="sub-menu-checkbox" id="eventos" />
        <ul class="sub-menu-dropdown">
          <li><a id='menu_crear_evento' href="#">Crear evento</a></li>
          <li><a id='menu_modificar_evento' href="#">Modificar evento</a></li>
          
        </ul>
      </li>
      <li class="menu-hasdropdown">
        <a href="#">Solicitudes</a><span class="icon"><i class="fas fa-file-invoice-dollar fa-2x"></i></span>
        <label title="toggle menu" for="sol">
          <span class="downarrow"><i class="fa fa-caret-down fa-2x"></i></span>
        </label>
        <input type="checkbox" class="sub-menu-checkbox" id="sol" />
        <ul class="sub-menu-dropdown">
          <li><a id='menu_solicitud_odc 'href="#">Pago</a></li>
          <li><a id='menu_solicitud_viaticos' href="#">Viáticos</a></li>
          <li><a id='menu_solicitud_reembolso' href="#">Reembolso</a></li>
          <li><a id='menu_ver_formatos' href="#">Ver detalle</a></li>
        </ul>
      </li>
      <li class="menu-hasdropdown">
        <a href="#">Catálogos</a><span class="icon"><i class="fas fa-address-book fa-2x"></i></span>
        <label title="toggle menu" for="catalogos">
          <span class="downarrow"><i class="fa fa-caret-down fa-2x"></i></span>
        </label>
        <input type="checkbox" class="sub-menu-checkbox" id="catalogos" />
        <ul class="sub-menu-dropdown">
          <li><a id='menu_solicitud_cliente' href="#">Clientes</a></li>
          <li><a id='menu_solicitud_prov' href="#">Proveedores</a></li>
          <li><a id='usuarios' href="#">Usuarios</a></li>
        </ul>
      </li>
      <li class="menu-hasdropdown">
        <a href="#">CXP</a><span class="icon"><i class="fas fa-funnel-dollar fa-2x"></i></span>
        <label title="toggle menu" for="cxp">
          <span class="downarrow"><i class="fas fa-caret-down fa-2x"></i></span>
        </label>
        <input type="checkbox" class="sub-menu-checkbox" id="cxp" />
        <ul class="sub-menu-dropdown">
          <li><a id='menu_tarjetas' href="#">Tarjetas</a></li>
        </ul>
      </li>
      <li class="menu-hasdropdown">
        <a href="#">Base de datos</a><span class="icon"><i class="fas fa-list-alt fa-2x"></i></span>
        <label title="toggle menu" for="bd">
          <span class="downarrow"><i class="fas fa-caret-down fa-2x"></i></span>
        </label>
        <input type="checkbox" class="sub-menu-checkbox" id="bd" />
        <ul class="sub-menu-dropdown">
          <li><a id='rep_eventos' href="#">Eventos</a></li>
          <li><a id='rep_cat_clientes' href="#">Clientes</a></li>
          <li><a id='rep_cat_proveedores' href="#">Proveedores</a></li>
        </ul>
      </li>
      <li class="menu-hasdropdown">
        <a href="#">Facturación</a><span class="icon"><i class="fas fa-hand-holding-usd fa-2x"></i></span>
        <label title="toggle menu" for="factura">
          <span class="downarrow"><i class="fa fa-caret-down fa-2x"></i></span>
        </label>
        <input type="checkbox" class="sub-menu-checkbox" id="factura" />
        <ul class="sub-menu-dropdown">
          <li><a id='solicitud_facturas' href="#">Solicitud</a></li>
          <li><a href="">Ver detalle</a></li>
        </ul>
      </li>
      <li class="menu-hasdropdown">
        <a href="#">Reportes</a><span class="icon"><i class="fas fa-chart-bar fa-2x"></i></span>
        <label title="toggle menu" for="reporte">
          <span class="downarrow"><i class="fa fa-caret-down fa-2x"></i></span>
        </label>
        <input type="checkbox" class="sub-menu-checkbox" id="reporte" />
        <ul class="sub-menu-dropdown">
          <li><a href="">Eventos</a></li>
          <li><a href="">Facturarción</a></li>
          <li><a href="">Gastos</a></li>
          <li><a href="">Módulo ventas</a></li>
        </ul>
      </li>


      <li class="menu-hasdropdown">
        <a href="#">Eventos</a><span class="icon"><i class="fas fa-chart-bar fa-2x"></i></span>
        <label title="toggle menu" for="reporte">
          <span class="downarrow"><i class="fa fa-caret-down fa-2x"></i></span>
        </label>
        <input type="checkbox" class="sub-menu-checkbox" id="reporte" />
        <ul class="sub-menu-dropdown">
        <li><a id='menu_crear_evento' class='item_menu' href="#"><i class="fas fa-file-text" aria-hidden="true"></i> Crear Evento</a></li>
        <li><a id='menu_modificar_evento' class='item_menu' href="#"><i class="fas fa-pencil-square-o" aria-hidden="true"></i> Modificar Evento</a></li>
          
        </ul>
      </li>
      <li class="menu-hasdropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Eventos <span class="caret"></span></a>
            <ul class="sub-menu-dropdown">
              <li><a id='menu_crear_evento' class='item_menu' href="#"><i class="fa fa-file-text" aria-hidden="true"></i> Crear Evento</a></li>
              <li><a id='menu_modificar_evento' class='item_menu' href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Modificar Evento</a></li>
              <li class='solo_admin'><a id='menu_cerrar_evento' class='item_menu' href="#"><i class="fa fa-archive" aria-hidden="true"></i> Cerrar Evento</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Solicitudes<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a id='menu_solicitud_odc' href="#" class='item_menu'><i class="fa fa-product-hunt" aria-hidden="true"></i> Solicitud de pago</a></li>
              <li><a id='menu_solicitud_viaticos' href="#" class='item_menu'><i class="fa fa-vimeo" aria-hidden="true"></i> Solicitud de viáticos</a></li>
              <li><a id='menu_solicitud_reembolso' href="#" class='item_menu'><i class="fa fa-registered" aria-hidden="true"></i> Solicitud de reembolso</a></li>
              <li><a id='menu_ver_formatos' href="#" class='item_menu'><i class="fa fa-list-ul" aria-hidden="true"></i> Ver solicitudes</a></li>
            </ul>
          </li>
          <li id='nav_catalogos' class="dropdown">
            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Catálogos<span class="caret"></span></a>
            <ul class="dropdown-menu">             
            <li class="dropdown-submenu">
              <a class="test" tabindex="-1" href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Alta de cliente <span class="caret"></span></a>
                <ul class="dropdown-menu">
                <li><a tabindex="-1" id='menu_prealta' href="pre_alta.html" target="_blank"><i class="fa fa-font-awesome" aria-hidden="true"></i> Pre-alta </a></li>
                  <li><a tabindex="-1" id='menu_solicitud_cliente' href="#"><i class="fa fa-font-awesome" aria-hidden="true"></i> Nacional </a></li>
                  <li class='disabled'><a tabindex="-1" href="#" id='menu_solicitud_cliente_ex' class='disabled' disabled><i class="fa fa-eur" aria-hidden="true"></i> Extranjero </a></li>
                </ul>
              </li>
              <li><a id='menu_solicitud_prov' href="#" class='item_menu'><i class="fa fa-building" aria-hidden="true"></i> Alta de proveedor</a></li>
              <li class='solo_admin'><a id='usuarios'  href="#" class='item_menu'><i class="fa fa-users" aria-hidden="true"></i> Usuarios</a></li>              
            </ul>
          </li>
          <li class="dropdown" >
            <a  id='btn_menu_cxc' href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" disabled="">CxP<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a tabindex="-1" id='menu_tarjetas' href="#" class='item_menu'><i class="fa fa-credit-card-alt" aria-hidden="true"></i> Ver tarjetas</a></li>
            </ul>
          </li>
          <li id='nav_reportes' class="dropdown">
            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Base de datos<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li class=""><a id='rep_eventos' href="#" class='item_menu'><i class="fa fa-file-text" aria-hidden="true"></i> Eventos</a></li>
              <li class=""><a id='rep_cat_clientes' href="#" class='item_menu'><i class="fa fa-user-circle-o" aria-hidden="true"></i> Clientes</a></li>
              xx
              comentario
              <li class=""><a id='rep_cat_clientes' href="#" class='item_menu'><i class="fa fa-user-circle-o" aria-hidden="true"></i> Clientes</a></li>
              xx
              <li class=""><a id='rep_cat_proveedores' href="#" class='item_menu'><i class="fa fa-building" aria-hidden="true"></i> Proveedores</a></li>
              <li class="hidden"><a id='rep_usuarios' href="#" class='item_menu disabled' disabled><i class="fa fa-users" aria-hidden="true"></i>  Usuarios</a></li>
            </ul>
          </li>
          <li id='nav_facturacion' class="dropdown">
            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Facturación<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a id='solicitud_facturas' href="#" class='item_menu'><i class="fa fa-gg" aria-hidden="true"></i> Solicitud de facturas</a></li>
            </ul>
          </li>
          <li id='nav_reportes' class="dropdown">
            <a href="#" class="dropdown-toggle " data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Reportes<span class="caret"></span></a>
            <ul class="dropdown-menu sub-menu-dropdown">
              <li><a id='solicitud_facturas' href="#" class='item_menu'><i class="fa fa-gg" aria-hidden="true"></i> Reporte de eventos</a></li>
              <li><a id='solicitud_facturas' href="#" class='item_menu'><i class="fa fa-gg" aria-hidden="true"></i> Reporte de facturación</a></li>
              <li><a id='solicitud_facturas' href="#" class='item_menu'><i class="fa fa-gg" aria-hidden="true"></i> Reporte de gastos</a></li>
              <li><a id='solicitud_facturas' href="#" class='item_menu'><i class="fa fa-gg" aria-hidden="true"></i> Módulo de ventas</a></li>
            </ul>
          </li>
         
    </ul>
  </div>
</nav>
</div>
-->


<!--NUEV NAV-->
<div class="row affix-row">
    <div class="col-sm-3 col-md-2 affix-sidebar">
		<div class="sidebar-nav">
  <div class="navbar navbar-default cambio" role="navigation">
    <div class="navbar-collapse collapse sidebar-navbar-collapse">
        <ul class="nav navbar-nav" >
            <li id='nav_verde' style='background-color: #BBD32A; min-height: 70px;width: 99%;'>
                <img id="nav_logo" src="img/logo.png"/>
                <span style="margin: 5px 20px;vertical-align: bottom;"><i class="fas fa-bars fa-2x"></i></span>
            </li>
        </ul class="nav navbar-nav">
      <ul class="nav navbar-nav cambio_rapido" id="sidenav01">
        <hr>
        <li>
          <a href="#" data-toggle="collapse" data-target="#toggleDemo" data-parent="#sidenav01" class="collapsed">
            <i class="fas fa-star "></i> Eventos <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo" style="height: 0px;">
            <ul class="nav nav-list">
              <li><a id='menu_crear_evento' href="#">Crear Evento</a></li>
              <li><a id='menu_modificar_evento' href="#">Modificar evento</a></li>
            </ul>
          </div>
        </li>
        <li>
          <a href="#" data-toggle="collapse" data-target="#toggleDemo2" data-parent="#sidenav01" class="collapsed">
          <span class="fas fa-file-invoice-dollar"></span> Solicitudes <span class="caret pull-right"></span>
          </a>
          <div class="collapse" id="toggleDemo2" style="height: 0px;">
            <ul class="nav nav-list">
              <li><a id='menu_solicitud_odc' href="#">Pago</a></li>
              <li><a id='menu_solicitud_viaticos' href="#">Viáticos</a></li>
              <li><a id='menu_solicitud_reembolso' href="#">Reembolso</a></li>
              <li><a id='menu_ver_formatos' href="#">Ver detalles</a></li>
            </ul>
          </div>
        </li>
        <li>
            <a href="#" data-toggle="collapse" data-target="#toggleDemo3" data-parent="#sidenav01" class="collapsed">
            <span class="fas fa-swatchbook"></span> Catálogos <span class="caret pull-right"></span>
            </a>
            <div class="collapse" id="toggleDemo3" style="height: 0px;">
              <ul class="nav nav-list">
                <li><a id='menu_prealta' href="pre_alta.html" target="_blank">Pre Alta Cliente</a></li>
                <li><a id='menu_solicitud_cliente' href="#">Clientes</a></li>
                <li><a id='menu_solicitud_prov' href="#">Proveedor</a></li>
                <li><a id='usuarios' href="#">Usuarios</a></li>
              </ul>
            </div>
          </li>
          <li>
            <a id='btn_menu_cxc' href="#" data-toggle="collapse" data-target="#toggleDemo4" data-parent="#sidenav01" class="collapsed">
            <span class="fas fa-funnel-dollar"></span> CxP <span class="caret pull-right"></span>
            </a>
            <div class="collapse" id="toggleDemo4" style="height: 0px;">
              <ul class="nav nav-list">
                <li><a id='menu_tarjetas' href="#">Tarjetas</a></li>
              </ul>
            </div>
          </li>
          
          <li>
            <a href="#" data-toggle="collapse" data-target="#toggleDemo5" data-parent="#sidenav01" class="collapsed">
            <span class="fas fa-list-alt"></span> Base de datos <span class="caret pull-right"></span>
            </a>
            <div class="collapse" id="toggleDemo5" style="height: 0px;">
              <ul class="nav nav-list">
                <li><a id='rep_eventos' href="#">Eventos</a></li>
                <li><a id='rep_cat_clientes' href="#">Clientes</a></li>
                <li><a id='rep_cat_proveedores' href="#">Proveedores</a></li>
              </ul>
            </div>
          </li>
          <li>
            <a id='btn_menu_facturacion' href="#" data-toggle="collapse" data-target="#toggleDemo6" data-parent="#sidenav01" class="collapsed">
            <span class="fas fa-hand-holding-usd"></span> Facturación <span class="caret pull-right"></span>
            </a>
            <div class="collapse" id="toggleDemo6" style="height: 0px;">
              <ul class="nav nav-list">
                <li><a id='solicitud_facturas' href="#">Nueva solicitud</a></li>
              </ul>
            </div>
          </li>
          <li>
            <a href="#" data-toggle="collapse" data-target="#toggleDemo7" data-parent="#sidenav01" class="collapsed">
            <span class="fas fa-chart-bar"></span> Reportes <span class="caret pull-right"></span>
            </a>
            <div class="collapse" id="toggleDemo7" style="height: 0px;">
              <ul class="nav nav-list">
                <li><a href="#">Eventos</a></li>
                <li><a href="#">Gastos</a></li>
                <li><a href="#">Facturacion</a></li>
                <li><a href="#">Modulo de ventas</a></li>
              </ul>
            </div>
          </li>
          <!--
          <li><a href="#"><span class="fas fa-bell"></span> Bitácora <span class=" badge badge-warning pull-right">42</span></a></li>
          -->
      </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
	</div>
</div>
<!--FIN NUEVO NAV-->
  
  <div id='div_login' class="container" >
    <div class="row" id="pwd-container" style="top:50px">    
      <div class="col-md-4 col-md-offset-4">
        <section class="login-form">
          <form method="post" action="#" role="login">
            <img src="img/logo.png" class="img-responsive" alt="" />
            <div class="form-group has-feedback">
              <span style="position:absolute; left:-10px;top:12px;color: #464545" class="fa fa-user "></span>
              <input style="color: #464545" type="text" id="user" class="form-control input-lg" placeholder="Usuario" />
            </div>
            
            <div class="form-group has-feedback">
              <span style="position:absolute; left:-10px;top:12px; color: #464545" class="fas fa-unlock-alt "></span>
              <input style="color: #464545" type="password" id="pass" class="form-control input-lg" placeholder="Contraseña" />
            </div>
            <button type="button" id="entrar" class=" cambio btn btn-lg btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Entrar</button>
          </form>
        </section>  
      </div>
    </div>  
  </div>
  <!-- DIV MODULO CXC-->
  <div id='div_cxc' class="container">
     <div class="row main">
       <legend><h2>Tarjetas</h2></legend>
        <div class="row">
          <div class="form-group col-md-4">
            <label for="name" class="cols-sm-2 control-label">Selecciona un banco</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fas fa-credit-card-alt" aria-hidden="true"></i></span>
                <select name="c_banco_tarjetas" id="c_banco_tarjetas" class='form-control'>
                </select>
              </div>
            </div>
          </div>
          <div id='btn_gif_tarjetas_resumen' class="form-group col-md-2 abajo " style="display:none">
            <button class='btn btn-primary'><img src="img/fancybox_loading.gif" > Buscando información</button>
          </div>
        </div>

     </div>
     <div class="row col-md-12" id='tarjetas_resultado'>
     </div>
  </div>

  <!--div formatos descargas-->
 <div id='div_formatos' class="container">
    <div class="row main">
      <div class="main-login main-center-descargas"> 
      <legend><h2>Solicitudes</h2></legend>
       <div class="row">
            <div class="form-group col-md-9">
              <label for="name" class="cols-sm-2 control-label">Eventos</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                  <select name="c_mis_eventos" id="c_mis_eventos" class='form-control' placeholder='Ingresa un evento'>
                  </select>
                  <-->
                  <input type="text" name="c_mis_eventos" id="c_mis_eventos" class="form-control" placeholder='Ingresa un evento' pattern="" title="">
                </div>
              </div>
            </div>
            <div class="form-group col-md-2">                              
                  <button type="button" id='btn_transferir' class="abajo btn btn-info boton_descarga"><i class="fas fa-exchange" aria-hidden="true"></i> Transferir</button>
            </div>
            <div class="form-group col-md-1">                              
                  <button type="button" id='btn_borrar_sdp' class="abajo btn btn-danger boton_descarga"><i class="fas fa-trash" aria-hidden="true"></i> Borrar</button>
            </div>
            <div id="div_mis_solicitudes" class="form-group col-md-6">
              <label for="name" class="cols-sm-2 control-label">Solicitudes</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                  <select name="c_mis_solicitudes" id="c_mis_solicitudes" class='form-control combo_usuarios' >
                  </select>
                </div>
              </div>
            </div>
        </div>
        <div class="row" id='resultado_solicitudes' style="position: relative;
    overflow: auto;
    width: 107%;">
        </div>
        <div class="row" id='espacio'>
          <span></span>
        </div>
      </div>
    </div>
 </div>
<!-- div crear usuarios-->
 <div id='div_usuarios' class="container">
    <div class="row main">
      <div class="main-login main-center-usuarios"> 
      <legend><h2>Crear Usuarios</h2></legend>
      <form id='form_usuarios' method="post">
       <div class="row">
            <div class="form-group col-md-4">
              <label for="name" class="cols-sm-2 control-label">Usuarios registrados</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  <select name="c_usuarios" id="c_usuarios" class='form-control combo_usuarios' >
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="name" class="cols-sm-2 control-label">Nombre usuario</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  <input id='txt_nombre_usuario' name='txt_nombre_usuario' type="text" class="form-control" placeholder="Nombre de usuario" required="" />
                </div>
              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="name" class="cols-sm-2 control-label">Correo usuario</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                  <input id='txt_email_usuario' name='txt_email_usuario' type="text" class="form-control" placeholder="e-mail de usuario" required="" />
                </div>
              </div>
            </div>
        </div>
        <div class="row">
          <div class="form-group col-md-2">
              <label for="name" class="cols-sm-2 control-label">Username</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  <input id='txt_username' name='txt_username' type="text" class="form-control" placeholder="Username" required="" readonly="" />
                </div>
              </div>
            </div>
            <div class="form-group col-md-2">
              <label for="" class="cols-sm-2 control-label">Contraseña</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <input type="button"  id='btn_reestablecer_pass' class='btn_verde btn btn-lg btn-primary btn-block' value='Reestablecer'/>
                </div>
              </div>
            </div>
            
            <div class="form-group col-md-3">
              <label for="name" class="cols-sm-2 control-label">Banco</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                  <input type="text"  id='txt_tipo_banco' class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group col-md-3">
              <label for="name" class="cols-sm-2 control-label"># tarjeta</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                  <input type="text"  id='txt_numero_tarjeta' class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group col-md-2">
              <button id='btn_agregar_tarjeta' type="button" class="btn btn-success abajo"><i class="fa fa-plus-circle" aria-hidden="true"></i> Añadir</button>
            </div>
            <!--
            <div class="form-group col-md-3">
              <label for="name" class="cols-sm-2 control-label">Tarjeta Sodexo  <a id="btn_add_tarjeta" href="#"><i class='nota fa fa-plus-circle' style="margin-left: 5em;" >Añadir tarjeta</i></a></label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                  
                  
                  
                  <select name='c_tarjeta_sodexo' class="form-control" id='c_tarjeta_sodexo'>
                  </select>
                </div>
              </div>
            </div>
          -->
            
        </div>
        <div class="row">
          <table class="table table-striped table-inverse table-hover">
            <thead>
              <tr>
                <th>Banco</th>
                <th># Tarjeta</th>
                <th>Acción</th>
              </tr>
            </thead>
            <tbody id='respuesta_tarjetas'>
              
            </tbody>
          </table>
        </div>
        <hr>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="name" class="cols-sm-2 control-label">Tipo de usuario</label>
              <div class="cols-sm-10">                    
                    <div class="checkbox checkbox-primary">
                      <label>
                        <input type="checkbox" id='check_sol' name="Xsolicitante" class="fa fa-o fa-2x" value="X">
                        <span class="label_check ">Solicitante</span>
                      </label>
                    
                      <label>
                        <input type="checkbox" id='check_eje' name="Xejecutivo" class="fa fa-o fa-2x" value="X">
                        <span class="label_check ">Ejecutivo de cuenta</span>
                      </label>
                   
                      <label>
                        <input type="checkbox" id='check_dig' name="Xdigital" class="fa fa-o fa-2x" value="X">
                        <span class="label_check ">Digital</span>
                      </label>
                      <label>
                        <input type="checkbox" id='check_cxp' name="Xcxp" class="fa fa-o fa-2x" value="X">
                        <span class="label_check ">CXP</span>
                      </label>
                    
                      <label>
                        <input type="checkbox" id='check_pro' name="Xproductor" class="fa fa-o fa-2x" value="X">
                        <span class="label_check ">Productor</span>
                      </label>
                    
                      <label>
                        <input type="checkbox" id='check_dis' name="Xdiseño" class="tipo_pago fa fa-o fa-2x" value="X">
                        <span class="label_check ">Diseño</span>
                      </label>
                      <label>
                        <input type="checkbox" id='check_dir' name="Xdirectivo" class="tipo_pago fa fa-o fa-2x" value="X">
                        <span class="label_check ">Directivo</span>
                      </label>
                    </div>
              </div>
            </div>
          </div> 
          <hr>
          <div class="row">
             <div class="form-group col-md-12">
              <label for="name" class="cols-sm-2 control-label">Catálogos</label>
              <div class="cols-sm-10">                    
                    <div class="checkbox checkbox-primary">
                      <label>
                        <input type="checkbox" id='check_sol_cat' name="XClientes" class="fa fa-o fa-2x" value="X">
                        <span class="label_check ">Clientes</span>
                      </label>                    
                      <label>
                        <input type="checkbox" id='check_eje_cat' name="XProveedores" class="fa fa-uare-o fa-2x" value="X">
                        <span class="label_check ">Proveedores</span>
                      </label>
                      <label>
                        <input type="checkbox" id='check_dig_cat' name="XUsuarios" class="fa fa-o fa-2x" value="X">
                        <span class="label_check ">Usuarios</span>
                      </label>
                      <label>
                        <input type="checkbox" id='check_fac_cat' name="XFacturacion" class="fa fa-o fa-2x" value="X">
                        <span class="label_check ">Facturación</span>
                      </label>
                    </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-3">
              <div class="cols-sm-10">
                <div class="input-group">
                  <button type="button" id="agregar_usuario" class="abajo btn_verde btn btn-lg btn-primary btn-block pull-right"><i class="i_espacio fa fa-plus" aria-hidden="true"></i>Agregar Usuario</button>
                </div>
              </div>
            </div>
             <div class="form-group col-md-1">
              <div class="cols-sm-10">
                <div class="input-group">
                  <button type="button" id="limpiar" class="abajo btn btn-lg btn-info btn-block pull-right"><i class="i_espacio fa fa-eraser" aria-hidden="true"></i>Limpiar</button>
                </div>
              </div>
            </div>
            <div class="form-group col-md-2 pull-right">
              <div class="cols-sm-10">
                <div class="input-group">
                  <button type="button" id="borrar_usuario" class="abajo btn btn-lg btn-danger btn-block pull-right"><i class="i_espacio fa fa-trash" aria-hidden="true"></i>Eliminar</button>
                </div>
              </div>
            </div>
           
          </div>
      </form>
      </div>
    </div>
 </div>
 <!--DIV FORMULARIO ALTA DE CLIENTES-->
<div id='div_alta_cliente' class="container">
      <div class="row main">
         <div class="main-center main_alta_clientes">
            <legend>
               <h2 id='titulo_alta'>Solicitud de alta de cliente</h2>
            </legend>
            <section id='seccion_datos' class='cambios'>
            <div id='div_clientes_registrados' class="row">
               <div class="form-group col-md-6 ">
                  <label id='l_cli' for="name" class="cols-sm-2 control-label">Clientes registrados</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <select  id="c_clientes_alta" name='c_clientes_alta' class='form-control' >
                        </select>
                     </div>
                  </div>
               </div>
               <div id='check_pendientes' class="form-group col-md-4 abajo">
                  <div class="checkbox">
                     <label>
                     <input id='check_solicitud_pendientes' type="checkbox" class="fa" value="solicitudes">
                     <span class="label_check" >Solicitudes pendientes</span>

                     </label>
                  </div>
               </div>
               <div id='check_pendientes2' class="form-group col-md-1 abajo">
                     <label>
                      <button type="button" id='btn_bloquear' class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Eliminar</button>

                     </label>
               </div>

            </div>
            <div class="row">
               <div class="form-group col-md-6 ">
                  <label id='l_razon' for="name" class="cols-sm-2 control-label">Razon Social del cliente</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input id='txt_nombre_cliente' name='txt_nombre_cliente' type="text" class="form-control" placeholder="Razon Social" required />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-3 ">
                  <label for="name" class="cols-sm-2 control-label">RFC</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                        <input id='txt_rfc' name='txt_rfc' type="text" class="form-control" placeholder="RFC" />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-3 ">
                  <label for="name" class="cols-sm-2 control-label">4 Ultimos dígitos de la cuenta</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                        <input id='digitos' name='digitos' type="text" class="form-control" placeholder=" 4 dígitos de cuenta" />
                     </div>
                  </div>
               </div>
               
            </div>
            <div class="row">
               <div class="form-group col-md-10 ">
                  <label for="name" class="cols-sm-10 control-label">Nombre comercial</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input id='txt_nombre_comercial' name='txt_nombre_comercial' type="text" class="form-control" placeholder="Nombre comercial" />
                     </div>
                  </div>
               </div>
               <div id='div_tipo_persona' class="form-group col-md-2 ">
                  <label for="name" class="cols-sm-2 control-label">Tipo persona</label>
                  <div class="cols-sm-1">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-question" aria-hidden="true"></i></span>
                        <select name="combo_tipo_persona" id="combo_tipo_persona" class="form-control">
                           <option value="vacio">Elige..</option>
                           <option value="FISICA">Física</option>
                           <option value="MORAL">Moral</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div id='div_area_descripcion' class="row">
               <div class="form-group col-md-12 ">
                  <label for="name" class="cols-sm-2 control-label">Descripción</label>
                  <div class="cols-sm-10">
                     <textarea class='form-control' name="area_descripcion" id="area_descripcion" rows="4"></textarea>
                  </div>
               </div>
               
            </div>
            <div class="row">
               <div class="form-group col-md-2 ">
                  <label for="name" class="cols-sm-2 control-label">C.P.</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bell" aria-hidden="true"></i></span>
                        <input id='txt_cp' name='txt_cp' type="text" class="form-control" placeholder="C.P." />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-3 ">
                  <label for="name" class="cols-sm-2 control-label">Estado</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <input id='txt_estado' name='txt_estado' type="text" class="form-control" placeholder="Estado" />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-3 ">
                  <label for="name" class="cols-sm-2 control-label">Municipio/Alcaldía</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <input id='txt_municipio' name='txt_municipio' type="text" class="form-control" placeholder="Municipio/Alcaldía"  />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-4 ">
                  <label for="name" class="cols-sm-2 control-label">Colonia</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <!--<select id="c_colonia" name='c_colonia' class='form-control'>-->
                        <input type='text' id="c_colonia" name='c_colonia' class='form-control' placeholder='Colonia'/>
                        
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-4 ">
                  <label for="name" class="cols-sm-2 control-label">Calle</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <input id='txt_calle' name='txt_calle' type="text" class="form-control" placeholder="Calle" />
                     </div>
                  </div>
               </div>
              <div class="form-group col-md-2 ">
                 <label for="name" class="cols-sm-2 control-label"># Ext</label>
                 <div class="cols-sm-10">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                       <input id='txt_num_ext' name='txt_num_ext' type="text" class="form-control" placeholder="# Ext" />
                    </div>
                 </div>
              </div>
              <div class="form-group col-md-2">
                 <label for="name" class="cols-sm-2 control-label"># Int</label>
                 <div class="cols-sm-10">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                       <input id='txt_num_int' name='txt_num_int' type="text" class="form-control" placeholder="# Int" />
                    </div>
                 </div>
              </div>
              <div class="form-group col-md-4">
                 <label for="name" class="cols-sm-2 control-label">Telefono (con clave lada)</label>
                 <div class="cols-sm-10">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                       <input id='txt_telefono' name='txt_telefono' type="text" class="form-control" placeholder="10 digitos" />
                    </div>
                 </div>
              </div>
            </div>
            <div class="row">
               <div class="form-group col-md-4 ">
                  <label for="name" class="cols-sm-2 control-label">Nombre de contacto</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input id='txt_nombre_contacto' name='txt_nombre_contacto' type="text" class="form-control" placeholder="Nombre de contacto" />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-4 ">
                  <label for="name" class="cols-sm-2 control-label">Correo de contacto</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                        <input id='txt_correo_contacto' name='txt_correo_contacto' type="text" class="form-control" placeholder="Correo de contacto" />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-4">
                  <label for="name" class="cols-sm-2 control-label">Uso de CFDI </label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                        <select name="" id="c_CFDI_CLIENTE" class='form-control' >
                           <option value="vacio">Selecciona...</option>
                           <option value='G01'>Adquisición de mercancias</option>
                           <option value='G02'>Devoluciones, descuentos o bonificaciones</option>
                           <option value='G03'>Gastos en general</option>
                           <option value='I03'>Equipo de transporte</option>
                           <option value='I04'>Equipo de computo y accesorios</option>
                           <option value='I08'>Otra maquinaria y equipo</option>
                           <option value='D04'>Donativos.</option>
                           <option value='P01'>Por definir</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div id="form_alta_proveedores">
                  <div class="row">
                     <div class="form-group col-md-3 ">
                        <label for="name" class="cols-sm-2 control-label">Cuenta bancaria</label>
                        <div class="cols-sm-10">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                              <input id='txt_cuenta_bancaria' name='txt_cuenta_bancaria' type="text" class="form-control" placeholder="Numero de cuenta" />
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-3 ">
                        <label for="name" class="cols-sm-2 control-label">Clabe interbancaria</label>
                        <div class="cols-sm-10">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                              <input id='txt_clabe' name='txt_clabe' type="text" class="form-control" placeholder="Numero de Clabe" />
                           </div>
                        </div>
                     </div>
                     <div class="form-group col-md-3 ">
                        <label for="name" class="cols-sm-2 control-label">Forma de Pago</label>
                        <div class="cols-sm-10">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                              <select  id="c_metodo_pago" name='c_metodo_pago' class='form-control' >
                                 <option value="vacio">Selecciona...</option>
                                 <option value="01 EFECTIVO">EFECTIVO</option>
                                 <option value="02 CHEQUE NOMINATIVO">CHEQUE NOMINATIVO</option>
                                 <option value="03 TRANSFERENCIA ELECTRONICA DE FONDOS">TRANSFERENCIA ELECTRONICA DE FONDOS</option>
                                 <option value="04 TARJETA DE CRÉDITO">TARJETA DE CRÉDITO</option>
                                 <option value="05 MONEDERO ELECTÓNICO">MONEDERO ELECTÓNICO</option>
                                 <option value="06 DINERO ELECTRÓNICO">DINERO ELECTRÓNICO</option>
                                 <option value="OTROS">OTROS</option>
                              </select>
                           </div>
                        </div>
                        
                     </div>
                     <div class="form-group col-md-3">
                        <label for="name" class="cols-sm-2 control-label">Banco <a id="btn_add_banco" href="#"><i class='nota'>Añadir banco</i></a></label>
                        <div class="cols-sm-10">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                              <select  id="c_bancos" name='c_metodo_pago' class='form-control' >
                              </select>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label for="name" class="cols-sm-2 control-label">Sucursal </label>
                        <div class="cols-sm-10">
                           <div class="input-group">
                              <span class="input-group-addon"><i class="fa fa-university" aria-hidden="true"></i></span>
                              <input id='txt_sucursal' name='txt_sucursal' type="text" class="form-control" placeholder="Sucursal" />
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            </section>
            <!-- <div class="row">
            
              <div class="file-field">
                <div class="btn btn-primary">
                  <span><h4><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> Constancia situacion Fiscal</h4></span>
                  <input type="file">
                </div>
                
              </div>

              <div class="file-field">
                <div class="btn btn-primary">
                  <span><h4><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> Identificacion</h4></span>
                  <input type="file">
                </div>
                
              </div>

              <div class="file-field">
                <div class="btn btn-primary">
                  <span><h4><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> Estado de cuenta</h4></span>
                  <input type="file">
                </div>
                
              </div>

              <div class="file-field">
                <div class="btn btn-primary">
                  <span><h4><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> Comprobante de domicilio</h4></span>
                  <input type="file">
                </div>
                
              </div>

              <div class="file-field">
                <div class="btn btn-primary">
                  <span><h4><i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i> Acta constitutiva</h4></span>
                  <input type="file">
                </div>
                
              </div>
            
            </div> -->
            <fieldset class="scheduler-border" id='fieldset_documentos' >
               <legend class="scheduler-border">
                  <h3><label class="control-label input-label" id='titulo_documentos'>Documentos</label></h3>
               </legend>
               <div class="col-md-6" style="border-right: 1px dashed black; min-height: 75px">
                <h3 id='test'>Requeridos</h3>
                <div class='row'>
                  
                  <button id='span_file_csf' class="btn btn-default form-control" disabled>
                    <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                      <label>Constancia de Situacion Fiscal</label><input id='file_csf' name='file_csf' type="file" style='cursor: not-allowed' disabled >
                  </button>
                 
                </div>
                <div class="clearfix"></div>
                <div class='row'>
                  <button id='span_file_ine' class="btn btn-default form-control" disabled>
                    <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                      <label>Identificación INE</label><input id='file_ine' type="file" style='cursor: not-allowed' disabled >
                  </button>
                </div>
                 
                 <div class="clearfix"></div>
                <div class='row'>
                  <button id='span_file_edo' class="btn btn-default form-control" disabled>
                    <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                      <label>Estado de cuenta</label><input id='file_edo' type="file" style='cursor: not-allowed' disabled >
                  </button>
                </div>
                 <div class="clearfix"></div>
                <div class='row'>
                  <button id='span_file_comp' class="btn btn-default form-control" disabled>
                    <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                      <label>Comprobante de domicilio</label><input id='file_comp' type="file" style='cursor: not-allowed' disabled >
                  </button>
                </div>
                <div class="clearfix"></div>
                <div class='row'>
                  <button id='span_file_acta' class="btn btn-default form-control" disabled>
                    <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                      <label>Acta Constitutiva</label> <input id='file_acta'type="file" style='cursor: not-allowed' disabled >
                  </button>
                </div>
               
               </div>
               <div class="col-md-6" >
                    <div class="form-group col-md-12">
                       <h3>Guardados</h3>
                       <ul id='ul_archivos' class="list-group list-group-flush">
                                                  
                       </ul>
                  </div>
               </div>
            </fieldset>
            <div class="row">
              <!--
               <div class="form-group col-md-2" id='div_siguiente'>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <button type="button" id="btn_validar_clientes" class="abajo btn btn-lg btn-primary btn-block pull-right"><i class="i_espacio fa fa-arrow-right" aria-hidden="true"></i>Documentos</button>
                     </div>
                  </div>
               </div>
             -->
               <div class="form-group col-md-2">
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <button type="button" id="enviar_solicitud_cliente" class="abajo btn_verde btn btn-lg btn-primary btn-block pull-right"><i class="i_espacio fa fa-envelope-o" aria-hidden="true"></i>Enviar Solicitud</button>
                     </div>
                  </div>
               </div>
               
               <div class="form-group col-md-2 pull-right">
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <button type="button" id="limpiar_cliente" class="abajo btn btn-lg btn-info btn-block pull-right"><i class="i_espacio fa fa-eraser" aria-hidden="true"></i>Limpiar</button>
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-1 pull-right">
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <button type="button" id="btn_desc_zip" class="abajo btn btn-lg btn-info btn-block pull-right"><i class="i_espacio fa fa-download" aria-hidden="true"></i></button>
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-3 pull-right">
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <button type="button" id="guardar_cliente" class="abajo btn_verde btn btn-lg btn-primary btn-block pull-right"><i class="i_espacio fa fa-save" aria-hidden="true"></i>Guardar Cliente</button>
                     </div>
                  </div>
               </div>
            </div>
          
         </div>
      </div>
   </div>  
  <!--CREAR EVENTO!!-->
  <div id='div_nuevo_evento' class="container">
    <div class="row main">
      <div class="main-login main-center"> 
        
        <div class="row">
          <legend><h2>Crear Evento</h2></legend>
         
        </div>       
        <div class="clearfix"></div>
                
        <form id='form_nuevo_evento' action="">
          <div class="row">
            <div class="form-group col-md-3">
             <label for="name" class="cols-sm-2 control-label"># Evento</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                  <input id='txt_numero_evento' name='txt_numero_evento' type="text" class="form-control" readonly="" />
                </div>
              </div>
            </div>
            <div id='existentes' class="form-group col-md-9">
              <label for="email" class="cols-sm-2 control-label">Evento existente</label>
              <div class="cols-sm-10">
                <div id="step1" class="input-group" data-step="1" data-intro='Al escribir se buscaran los primeros 15 eventos que coincidan '  data-disable-interaction="1">
                  <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                  <!--
                  <select name="c_eventos_creados" id="c_eventos_creados" class='form-control' placeholder='Ingresa un evento' >
                  </select>-->
                  <input type="text" name="c_eventos_creados" id="c_eventos_creados" class="form-control" placeholder='Ingresa un evento' pattern="" title="">
                </div>
              </div>
            </div>
<!-- input para usar como autocomplete
            <div id='existentes' class="form-group col-md-6">
              <label for="email" class="cols-sm-2 control-label">Demo</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                  <input type="text"  id='txt_evento_demo' class="form-control">
                </div>
              </div>
            </div>
-->
            <!-- PRUEBA DE CAMBIO DE COMBO POR INPUT-->
            <!-- <div class="form-group col-md-5">
              <label for="email" class="cols-sm-2 control-label">Evento existente:</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                  <input type="text" name="txt_evento_auto" id="txt_evento_auto" class="form-control" placeholder='Ingresa un evento' pattern="" title="">
                </div>
              </div>
            </div> -->


            <!--FIN DE PRUEBA-->
            
          </div> 
          <div class="row">
            <div class="form-group col-md-6">
              <label for="name" class="cols-sm-2 control-label">Cliente</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-circle" aria-hidden="true"></i></span>
                  <select name="c_cliente" id="c_cliente" class='form-control combo_clientes' >
                    
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="email" class="cols-sm-2 control-label">Nombre del evento</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                  <span class="bubble" title="Solo el nombre del evento (SIN Cliente)">
                  <input id='txt_nombre_evento' name='txt_nombre_evento' type="text" class="form-control" placeholder="Nombre del evento"/>
                </div>
              </div>
            </div>
          </div>   
          <div class="row">
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Fecha de inicio del evento</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar fa" aria-hidden="true"></i></span>
                  <input id='txt_fecha_inicio_evento' name='txt_fecha_inicio_evento' type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Fecha de término del evento</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar fa" aria-hidden="true"></i></span>
                  <input id='txt_fecha_final_evento' name='txt_fecha_final_evento' type="text" class="form-control" readonly>
                </div>
              </div>
            </div>
          </div> 
          <div class="row">
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Destino</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-globe fa" aria-hidden="true"></i></span>
                  <input id='txt_destino' name='txt_destino' type="text" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Sede</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-map-marker fa" aria-hidden="true"></i></span>
                  <input id='txt_sede' name='txt_sede' type="text" class="form-control">
                </div>
              </div>
            </div>
          </div>     
          <div class="row">
            <div class="form-group col-md-6">
              <label for="password" class="cols-sm-2 control-label">Ejecutivo de cuenta</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                  <select name="c_ejecutivos" id="c_ejecutivos" class='form-control' multiple="multiple">
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="password" class="cols-sm-2 control-label">Producción</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                  <select name="c_produccion" id="c_produccion" class='form-control' multiple="multiple" >
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Diseño</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <select name="c_disenio" id="c_disenio" class='form-control' multiple="multiple" >
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="confirm" class="cols-sm-2 control-label">Solicitante</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                  <select name="c_solicitantes" id="c_solicitantes" class='form-control' multiple="multiple">
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            
            <div class="form-group col-md-6">
              <label for="confirm" class="cols-sm-2 control-label">Digital</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa-lg" aria-hidden="true"></i></span>
                  <select name="c_digital" id="c_digital" class='form-control' multiple="multiple">
                  </select>
                </div>
              </div>
            </div>
           
            <div class="form-group col-md-4">
              <label for="confirm" class="cols-sm-2 control-label">Facturación <i class='nota'>  *Incluyendo IVA</i></label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                  <span class="bubble" title="El monto de facturación debe ser numérico">
                  <input name='txt_facturacion' id='txt_facturacion' placeholder="123.45" type="textbox" class='form-control moneda'  value=''/>
                  </span>
                </div>
              </div>
            </div>  
            <div class="form-group col-md-2">
              <label for="confirm" class="cols-sm-2 control-label"></label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <input id='check_estatus_facturacion' name='check_estatus_facturacion' type="checkbox" data-toggle="toggle" data-height="50" data-onstyle="success" data-on="Total" data-off="Aprox" data-offstyle="warning">
                </div>
                
              </div>
            </div> 
          </div>
          <div class="row">
            <div class="form-group col-md-12">
              <label for="username" class="cols-sm-2 control-label">Comentarios</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-commenting-o" aria-hidden="true"></i></span>
                  <textarea name="area_comentarios" id="area_comentarios" class="form-control" rows="4"></textarea>
                </div>
              </div>
            </div>            
          </div>
          <div class="row col-md-12">
            <button type="button" id="btn_crear_evento" class="btn_verde btn btn-lg btn-primary "><i class="fa fa-plus" aria-hidden="true"></i> Crear evento</button>
            <button type="button" id="btn_modificar_evento" class="btn_verde btn btn-lg btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i> Modificar evento</button>
            <button type="button" id="limpiar_evento" class="btn btn-lg btn-info pull-right"><i class="i_espacio fa fa-eraser" aria-hidden="true"></i>Limpiar</button>
            <button type="button" id="btn_cancelar_evento" class="btn btn-lg btn-danger pull-right" style="margin-right: .5em"><i class="fa fa-trash" aria-hidden="true"></i> Cancelar evento</button>
            
          </div>
          <div class='row'>
            <div class="col-md-12">_</div>
          </div>
        </form>      
      </div>
    </div>
  </div>
  <div id='div_odc' class="container">
    <div class="row main">
      <div class="main-login main-center-odc">        
        <legend><h2 id='titulin'>Solicitud de Cheque</h2></legend>
        <form action="">
          <div class="row">
            <div class="form-group col-md-8 ">
              <label for="name" class="cols-sm-2 control-label">Evento</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                  <!--
                  <select name="" id="c_numero_evento" class='form-control' >
                  </select>
                  -->
                  <input type="text" name="c_numero_evento" id="c_numero_evento" class="form-control" placeholder='Ingresa un evento' pattern="" title="">
                </div>
              </div>
            </div>
            <div class="form-group col-md-2 col-md-offset-1 abajo">
              <div class="checkbox">
                <label>
                  <input id='check_tipo_sol' name='check_tipo_sol' type="checkbox" data-toggle="toggle" data-height="50" data-onstyle="success" data-on="Normal" data-off="Urgente" data-offstyle="warning">
                </label>
              </div>
            </div>
             <div class="form-group col-md-1 abajo">
              <div class="checkbox">
                <label>
                  
                </label>
              </div>
            </div>
          </div>           
          <div class="row">
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Fecha de solicitud</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar fa" aria-hidden="true"></i></span>
                  <input type="text" id="f_solicitud" class="form-control" readonly="" disabled="">
                </div>
              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Fecha de pago</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar fa" aria-hidden="true"></i></span>
                  <input type="text" id="f_pago" class="form-control" readonly="">
                </div>
              </div>
            </div>
             <div class="form-group col-md-4 ">
              <label for="name" class="cols-sm-2 control-label">Importe</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
                  <span class="bubble" title="Ingresa solo importe numérico">
                  <input id='odc_cheque_por' placeholder="00.00" type="textbox" class='form-control moneda'/>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-12">
            <div class="cols-sm-10">
                <div class="input-group pull-right">
                  <img id="puntos_gif" src="img/puntos.gif" alt=""><label for="username" id='odc_label_letra' class="cols-sm-2 control-label text-right pull-right"></label>
                </div>
              </div>
             </div>
          </div>
          <div class="row">
             <div id='div_tipo_reembolso' class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Tipo</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-question" aria-hidden="true"></i></span>
                  <select name="" id="c_tipo_reembolso" class='form-control' >
                    <option value="MA. FERNANDA CARRERA HDZ">Cheque</option>
                    <option value="TARJETA SODEXO">Tarjeta SODEXO</option>
                    <option value="TARJETA DILIGO">Tarjeta DILIGO</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-8" id='div_mensaje'>
              <label for="username" class="cols-sm-2 control-label" style="color:rgba(255,255,255.01)">_</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon" style="color:black;border:none;background-color:#945CA6"><i class="fa fa-warning" style="color:white" aria-hidden="true"></i></span>
                  <input type="text" id="txt_nota" class="form-control disabled" readonly="" value="El cheque saldrá a nombre de Ma. Fernanda Carrera" style="color:white;border:none;background-color:#945CA6">
                </div>
              </div>
            </div>
            
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label id='label_a_nombre' for="username" class="cols-sm-2 control-label">A nombre</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-id-card-o" aria-hidden="true"></i></span>
                  <select name="" id="c_a_nombre" class='form-control' >
                  </select>
                </div>
              </div>
              <div class="row user_proveedor" style="display: none;padding: 0.2em 1em;color: white;background-color: rgb(148, 92, 166);border-radius: .3em;"><i><a href="#" id="usuario_proveedor" style='text-decoration: none'></a></i>
                <input type="hidden" id='id_usuario_proveedor' value='0'>
              </div>
            </div>
            
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Concepto</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-question" aria-hidden="true"></i></span>
                  <input type="text" id="txt_concepto" class="form-control">
                </div>
              </div>

            </div>
          </div>
          <div class="row">
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Servicio</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th-large fa" aria-hidden="true"></i></span>
                  <input type="text" id="txt_servicios" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group col-md-6">
              <label for="username" class="cols-sm-2 control-label">Otros</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th fa" aria-hidden="true"></i></span>
                  <input type="text" id="txt_otros" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
             <div class="form-group col-md-2">
              <div class="radio">
                <label>
                  <input type="radio" name="check_tipo_pago" class="tipo_pago fa fa-o fa-2x" value="Anticipo">
                  <span class="label_check ">Anticipo</span>
                </label>
              </div>
            </div>
            <div class="form-group col-md-3">
              <div class="radio">
                <label>
                  <input type="radio" name="check_tipo_pago" class="tipo_pago fa fa-o fa-2x" value="Pago Total">
                  <span class="label_check ">Pago Total</span>
                </label>
              </div>
            </div>
            <div class="form-group col-md-3">
              <div class="radio">
                <label>
                  <input type="radio" name="check_tipo_pago" class="tipo_pago fa fa-o fa-2x" value="Pago Final">
                  <span class="label_check ">Pago Final</span>
                </label>
              </div>
            </div>
            <div class="form-group col-md-4" id='div_forma_pago'>
              <label for="username" class="cols-sm-2 control-label">Forma de pago</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-credit-card" aria-hidden="true"></i></span>
                  <select name="" id="c_forma_de_pago" class='form-control' >
                         <option value="03 TRANSFERENCIA ELECTRONICA DE FONDOS">03 TRANSFERENCIA ELECTRONICA DE FONDOS</option>
                         <option value="01 EFECTIVO">01 EFECTIVO</option>
                         <option value="02 CHEQUE NOMINATIVO"> 02CHEQUE NOMINATIVO</option>
                         <option value="99 POR DEFINIR">99 POR DEFINIR</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
             <div class="form-group col-md-3">
              <label for="username" class="cols-sm-2 control-label">Uso de CFDI</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                  <select name="" id="c_CFDI" class='form-control' >
                    <option value="vacio">Selecciona...</option>
                    <option value='G01'>Adquisición de mercancias</option>
                    <option value='G02'>Devoluciones, descuentos o bonificaciones</option>
                    <option value='G03'>Gastos en general</option>
                    <option value='I03'>Equipo de transporte</option>
                    <option value='I04'>Equipo de computo y accesorios</option>
                    <option value='I08'>Otra maquinaria y equipo</option>
                    <option value='D04'>Donativos.</option>
                    <option value='P01'>Por definir</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-3">
              <label for="username" class="cols-sm-2 control-label">Metodo de Pago</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-money" aria-hidden="true"></i></span>
                  <select class='form-control' id ='combo_metodo_pago' name="combo_metodo_pago">
                    <option value="vacio">Selecciona...</option>
                    <option value='PPD'>Pago en parcialidades o diferido</option>
                    <option value='PUE'>Pago en una sola exhibición</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group col-md-2">
              <label for="username" class="cols-sm-2 control-label">#Factura</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar fa" aria-hidden="true"></i></span>
                  <input type="text" id="txt_docto_soporte" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group col-md-3">
              <label for="username" class="cols-sm-2 control-label">Fecha</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
                  <input type="text" id="odc_fecha" class="form-control">
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            
            
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Vo.Bo. Compras/RH</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  <input type="text" id="txt_vobo_compras" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Directivo/Coordinador</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  <input type="text" id="txt_coordinador" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group col-md-4">
              <label for="username" class="cols-sm-2 control-label">Project Manager</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                  <input type="text" id="txt_project" class="form-control">
                </div>
              </div>
            </div>
          
          </div>          
          <div class="row">             
            <div class="margen row col-md-offset-2 col-md-4">
              <button type="button" id="enviar_odc" class="btn_verde btn btn-lg btn-primary pull-right"><i class="fa fa-envelope-o " aria-hidden="true"></i> Enviar solicitud</button>
            </div>
             <div class="margen row col-md-2">
              <button type="button" id="limpiar_odc" class="btn btn-lg btn-info pull-right"><i class="i_espacio fa fa-eraser" aria-hidden="true"></i>Limpiar</button>
            </div>
          </div>
          <div class="row"> 
            <label for="">_</label>
          </div>
        </form> 
            
      </div>
    </div>
  </div>
  <div id='div_modificar_evento' class="container">
    <div class="row main">
      <div class="main-login main-center-descargas"> 
      <legend><h2>Solicitud de modificación de evento</h2></legend>      
         <div class="row col-md-9">
          <label class="cols-sm-2 control-label">Evento</label>
          <!--
            <select name="c_eventos_modificar" id="c_eventos_modificar" class="form-control" placeholder='Ingresa un evento'>
            </select>
          -->
          <input type="text" name="c_eventos_modificar" id="c_eventos_modificar" class="form-control" placeholder='Ingresa un evento' pattern="" title="">
         </div>
         <div class="row col-md-11">
          <textarea id="area_modificaciones" class="form-control margen" rows="5" placeholder="Ingrese la solicitud de la modificación"></textarea>
        </div>
        <div class="row col-md-1 col-md-offset-10">
           <button type="button" id="enviar_cambios_evento" class="btn_verde btn btn-lg btn-primary margen pull-right"><i class="fa fa-envelope" aria-hidden="true"></i> Solicitar cambios</button>
      </div>
      </div>
    </div>
 </div>
 <!-- DIV CERRRAR EVENTO -->
 <div id='div_cerrar_evento' class="container">
    <div class="row main">
      <div class="main-login main-center-descargas"> 
      <legend><h2>Cerrar evento</h2></legend>      
         <div class="row col-md-6">
          <label class="cols-sm-2 control-label">Evento</label>
            <select name="c_eventos_cerrar" id="c_eventos_cerrar" class="form-control" required="required">
            </select>
         </div>
         
        <div class="row col-md-1 col-md-offset-10">
           <button type="button" id="btn_cerrar_evento" class="btn_verde btn btn-lg btn-primary margen pull-right"><i class="fa fa-check" aria-hidden="true"></i> Cerrar evento</button>
      </div>
      </div>
    </div>
 </div>
 <!--div solicitud de factura-->
 <div id='div_solicitud_factura' class="container">
  <div class="row main">
  <form id='form_solicitud_factura' action="agregar_solicitud_factura.php" method="POST">
    <div class="row">
      <div class="main-login main-center-descargas"> 
      <legend><h2>Solicitud de factura</h2></legend>      
         <div class="col-md-6">
          <label class="cols-sm-2 control-label">Cliente</label>
          <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
            <select name="c_clientes_factura" id="c_clientes_factura" class="form-control combo_clientes" required="required">
            </select>
          </div>
         </div>
         <div class="col-md-6">
          <label class="cols-sm-2 control-label">Evento</label>
          <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
            <select name="c_evento_cliente" id="c_evento_cliente" class="form-control" required="required">
            </select>
          </div>
         </div>
      </div>
    </div>
    <section id='sec_datos_factura'>
    <div class="row">
      <div class="col-md-4" id='datos_cliente' style="margin-top: 15px;">
      </div>
      <div class="col-md-8" style="margin-top: 15px;">
        <div class="row">
        <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">Días de crédito</label>
          <div class="cols-sm-12">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-calendar-check-o " aria-hidden="true"></i></span>
              <input type="number" id="txt_dias_credito" name="txt_dias_credito" class="form-control" required>
            </div>
          </div>
        </div>
         <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">Núm de pedido<i class='nota'>  (Solo si aplica)</i></label>
          <div class="cols-sm-12">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-hashtag " aria-hidden="true"></i></span>
              <input type="text" id="txt_num_pedido" name="txt_num_pedido" class="form-control" >
            </div>
          </div>
        </div>
         <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">Núm de entrada<i class='nota'>  (Solo si aplica)</i></label>
          <div class="cols-sm-12">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-hashtag " aria-hidden="true"></i></span>
              <input type="text" id="txt_num_entrada" name="txt_num_entrada" class="form-control" >
            </div>
          </div>
        </div>
        </div>
        <div class="row" style="margin-top: 30px;">
          <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">Orden de compra<i class='nota'>  (Solo si aplica)</i></label>
          <div class="cols-sm-12">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-hashtag " aria-hidden="true"></i></span>
              <input type="text" id="txt_orden_compra" name="txt_orden_compra" class="form-control" >
            </div>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">GR<i class='nota'>  (Solo si aplica)</i></label>
          <div class="cols-sm-12">
            <div class="input-group">
              <span class="input-group-addon"><i class="fa fa-hashtag " aria-hidden="true"></i></span>
              <input type="text" id="txt_gr" name="txt_gr" class="form-control" >
            </div>
          </div>
        </div>
        
          <div class="form-group col-md-4">
          <label for="" class="cols-sm-2 control-label">Empresa que factura</label>
            <div class="cols-sm-12">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-building" aria-hidden="true"></i></span>
                <select name="c_empresa_factura" id="c_empresa_factura" class="form-control" required="required">
                <option value="vacio">Selecciona...</option>
                <option value="TDI">TIERRA DE IDEAS</option>
                <option value="SHIATSUS">SHIATSUS</option>
                <option value="COMITIVA">COMITIVA</option>
              </select>
              </div>
            </div>
          </div>
        
        </div>
        

      </div>
  </div>

  <div class="row">
    <fieldset style="border:1px solid black">
    <legend> <h2> Partidas</h2></legend>
    <div class="form-group col-md-6 ">
      <label for="name" class="cols-sm-2 control-label">Concepto de servicio</label>
        <div class="cols-sm-10">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-handshake-o" aria-hidden="true"></i></span>
          <input id='txt_concepto_partida' name='txt_concepto_partida' type="text" class="form-control" placeholder="Concepto" />
        </div>
      </div>
    </div>
    <div class="form-group col-md-2 ">
      <label for="name" class="cols-sm-2 control-label">Precio Unitario</label>
        <div class="cols-sm-10">
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-usd" aria-hidden="true"></i></span>
          <span id='alert_partida' class="bubble" title="Ingresa solo importe numérico">
          <input id='txt_precio_unitario' name='txt_precio_unitario' type="number" class="form-control" placeholder="Precio" />
        </span>
        </div>
      </div>
    </div>
    <div id='check_ivas' class="form-group col-md-2 abajo">
        <div class="checkbox">
           <label>
           <input id='check_iva' type="checkbox" class="fa fa-square-o fa-2x" value="sin_iva">
           <span class="label_check" >Sin IVA</span>
           </label>
        </div>
     </div>
    <div class="form-group col-md-1">
      <label class="cols-sm-2 control-label"></label>
        <div class="cols-sm-10">
        <div class="input-group">
            <button  id='btn_add_partida' class='btn btn-lg btn-primary'><i class="fa fa-plus" aria-hidden="true"></i></button>
          
        </div>
      </div>
    </div>
    <div class="form-group col-md-1 ">
      <label class="cols-sm-2 control-label"></label>
        <div class="cols-sm-10">
        <div id='demonios' class="input-group">
          <button  id='btn_quitar' class='btn btn-lg btn-danger'><i class="fa fa-trash" aria-hidden="true"></i> </button>
        </div>
      </div>
    </div>
    
<!--
    <div class="form-group col-md-8 ">
      <label for="name" class="cols-sm-2 control-label">Concepto de servicio</label>
      <div class="cols-sm-10">
          <textarea class='form-control' name="area_concepto_servicio" id="area_concepto_servicio" rows="6" required></textarea>
      </div>
    </div>
    <div class="form-group col-md-4 ">
        <table class="table table-bordered table-hover">
         
          <tbody>
            <tr>
              <td style="text-align: right;"><label for="">Sub-total</label></td>
              <td><span class="bubble" title="Ingresa solo importe numérico"><input id='txt_subtotal' name='txt_subtotal' type="textbox" class='form-control moneda' placeholder='$00.0' required></span></td>
            </tr>
            <tr>
              <td style="text-align: right;"><label for="">IVA</label></td>
              <td><span class="bubble" title="Ingresa solo importe numérico"><input id='txt_iva' name='txt_iva' type="textbox" class='form-control moneda' placeholder='$00.0' required></span></td>
            </tr>
            <tr>
              <td style="text-align: right;"><label for="">Total</label></td>
              <td><span class="bubble" title="Ingresa solo importe numérico"><input id='txt_total' name='txt_total' type="textbox" class='form-control moneda' placeholder='$00.0' required></span></td>
            </tr>
          </tbody>
        </table>
     </div>
   -->
   </fieldset>
  </div>
  <div class="row">
    <table id='tabla_partidas' class="display cell-border dataTable" style= "width:100%">
        <thead>
            <tr>
                <th>Concepto</th>
                <th>Precio Unitario</th>
                <th>IVA</th>
                <th>TOTAL</th>
            </tr>
        </thead>
         <tfoot>
            <tr style="background-color: #E8E6E6">
                <th style="text-align: right;"> Σ Totales</th>
                <th id='sumatoria_pu'>$0.00</th>
                <th id='sumatoria_iva'>$0.00</th>
                <th id='sumatoria_total'>$0.00</th>
            </tr>
        </tfoot>
      </table>
  </div>
  <hr>
  <div class="clearfix" ></div>
  <div class="row">
    <div class="form-group col-md-4 ">
       <label for="name" class="cols-sm-2 control-label">Correo para envio de factura</label>
        <div class="cols-md-10">
        <div class="input-group abajo">
          <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
          <input id='txt_correo_1' name='txt_correo_1' type="email" class="form-control" placeholder="Correo 1" required />
          <input id='txt_correo_2' name='txt_correo_2' type="email" class="form-control" placeholder="Correo 2"  />
          <input id='txt_correo_3' name='txt_correo_3' type="email" class="form-control" placeholder="Correo 3"  />
          <input id='txt_correo_4' name='txt_correo_4' type="email" class="form-control" placeholder="Correo 4"  />
          <input id='txt_correo_5' name='txt_correo_5' type="email" class="form-control" placeholder="Correo 5"  />
        </div>
      </div>
     </div>
     <div class="form-group col-md-6 ">
      <label for="name" class="cols-sm-2 control-label">Observaciones</label>
        <div class="cols-sm-10">
        <div class="input-grsoup">
          <textarea name="area_observaciones" id="area_observaciones" class="form-control" rows="12" style=' font-size: .9em' placeholder="Observaciones"></textarea>
        </div>
      </div>
    </div>
     <div class="col-md-2" style='margin-top: 13em'>
           <button type="submit" id="btn_solicitar_factura" class="btn_verde btn btn-lg btn-primary margen pull-right"><i class="fa fa-gg" aria-hidden="true"></i> Solicitar factura</button>
      </div>
  </div>
  <div class="row">_</div>
  </section>
  </form>
  </div>
 </div>
 <!--div reporte eventos-->
 
  <div id='div_reporte_eventos' class="container">
    <div class="row main">
      <div class="row" class='titulo_reporte'><legend><h2>Reporte de Eventos</h2></legend></div>
      <table id='reporte_eventos' class="display nowrap dataTable" style="width:100%">
        
      </table>
    </div>
  </div>
  <div id='div_reporte_clientes' class="container">
    <div class="row main">
      <div class="row" class='titulo_reporte'><legend><h2>Reporte de Clientes</h2></legend></div>
      <table id='reporte_clientes' class="display nowrap dataTable" style="width:100%">
        
      </table>
    </div>
  </div>
  <div id='div_reporte_proveedores' class="container">
    <div class="row main">
      <div class="row" class='titulo_reporte'><legend><h2>Reporte de Proveedores</h2></legend></div>
      <table id='reporte_proveedores' class="display nowrap dataTable" style="width:100%">
        
      </table>
    </div>
  </div>
  <div id='div_reporte_usuarios' class="container">
    <div class="row main">
      <div class="row" class='titulo_reporte'><legend><h2>Reporte de Usuarios</h2></legend></div>
      <table id='reporte_usuarios' class="display nowrap dataTable" style= "width:100%">
        
      </table>
    </div>
  </div>
  <div class="clearfix" style="margin-top:1em"></div>
 <!--fin div reporte eventos-->
 
 <div id='d-none' class="d-none hidden">
    <div class="cols-sm-10"><div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span><select  id="c_user_solicita" name="c_user_solicita" class="form-control" ></select></div></div><hr><div class="cols-sm-10"><div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span><select  id="c_finanzas" name="c_finanzas" class="form-control" ><option value="vacio">Finanzas...</option><option value="FERNANDA CARRERA">FERNANDA CARRERA</option><option value="RITA VELEZ">RITA VELEZ </option></select></div></div><hr><div class="cols-sm-10"><div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span><select  id="c_autorizo" name="c_autorizo" class="form-control" ><?php 
      include("conexion.php");
      if (mysqli_connect_errno()) {
          printf("Error de conexion: %s\n", mysqli_connect_error());
          exit();
      }
      $result = $mysqli->query("SET NAMES 'utf8'");
      $sql="SELECT Nombre FROM usuarios where Directivo='X' order by Nombre";
      if ($result = $mysqli->query($sql)) {
          $res='<option value="vacio">Directivo...</option>';
          while ($row = $result->fetch_row()) {
              $res=$res."<option value='".$row[0]."'>".$row[0]."</option>";
          }
          $result->close();
      }
      echo $res;
     ?></select></div></div>
  </div>

  <!-- DIV OCULTO EVENTOS TRANSFERIR 
    <div id='d-none2' class="d-none ">
    <div class="cols-sm-10">
      <div class="input-group"><span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span><select  id="c_user_solicita" name="c_user_solicita" class="form-control" ></select></div>
      </div>
    </div>
  DIV EVENTOS TRANSFERIR-->
  <div id='prueba' class="form-group col-md-6 ">
    <label>Transferir a:</label>
    <select name="c_transfer" id="c_transfer" class='form-control'></select>
    <!--<input type="text" id='txt_prueba' class='form-control' placeholder="Ingresa un evento">-->
  </div>
  <!-- Footer -->
  

 <!-- Modal HTML embedded directly into document -->
<div id="modal_notificacion" class="modal">
  <div contenteditable="true" id='mensaje_notificacion'>
  
  </div>
  
</div>

<a id="spnTop" href="#" class="btn btn-primary btn-lg pull-right back-to-top" role="button" title="Click to return on the top page" data-toggle="tooltip" data-placement="left"><span class="glyphicon glyphicon-chevron-up"></span></a>


<!-- Link to open the modal -->

  
  
<footer class="page-footer font-small blue pt-4" style="z-index: 400px">   
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3" style=" position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background-color: #d0dff6;
    color: #434142;
    text-align: center;
    z-index: 400px;">© Tierra de ideas (2018) ~ <a href="mailto:alaneduardosandoval@yahoo.com">Alan Sandoval</a>
    </div>
    <!-- Copyright -->
  </footer>
 
</body>
</html>