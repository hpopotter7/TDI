<div class="sidebar-wrapper sidebar-theme">
            <nav id="sidebar" style="padding-left:12px">
                <ul class="list-unstyled menu-categories" id="accordionExample">
                  <li class="menu">
                        <a href="https://administraciontierradeideas.mx/soporte/login?user=<?php echo $_COOKIE['email']?>&pass=<?php echo $_COOKIE['pass']?>" target='_blank' class="dropdown-toggle">
                            <div class="">
                                <i class="fas fa-headset" aria-hidden="true"></i>
                                <span>Soporte</span>
                            </div>
                            <div>
                            <i class="fas fa-external-link-alt" aria-hidden="true"></i>
                            </div>
                        </a>
                    </li>
                    <li class="menu">
                        <a href="#dashboard" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                                <i class="fa fa-star" aria-hidden="true"></i>
                                <span>Eventos</span>
                            </div>
                            <div>
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="dashboard" data-parent="#accordionExample">
                            <li><a id='menu_crear_evento' href="#"> Crear Evento </a></li>
                            <li><a id='menu_modificar_evento' href="#"> Modificar </a></li>
                            <li><a id='menu_cerrar_evento' href="#"> Cerrar </a></li>
                            <li><a id='menu_ver_pendientes' href="#">Pendientes</a></li>
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#app" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <i class="fas fa-file-invoice-dollar"></i>
                                <span>Solicitudes</span>
                            </div>
                            <div>
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="app" data-parent="#accordionExample">
                            <li><a id='menu_solicitud_odc' href="#"> Pago </a></li>
                            <li><a id='menu_solicitud_viaticos' href="#"> Viáticos  </a></li>
                            <li><a id='menu_solicitud_reembolso' href="#"> Reembolso </a></li>                            
                            <li><a id='menu_vobo' href="#"> VoBo </a></li>
                            <li><a id='menu_ver_formatos' href="#">Ver Solicitudes</a></li>                            
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#catalogos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <i class="fas fa-swatchbook"></i>
                                <span>Catálogos</span>
                            </div>
                            <div>
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="catalogos" data-parent="#accordionExample">
                            <!--<li><a id='menu_prealta' href="#"> Pre-Alta Cliente </a></li>  Meterlo en catalogos clientes-->
                            <!-- <li><a id='menu_bloqueo_prov' href="#"> Bloqueo </a></li> -->
                            <li><a id='menu_solicitud_cliente' href="#">  Clientes </a></li>
                            <li><a id='menu_solicitud_prov' href="#"> Proveedores </a></li>                            
                            <li><a id='menu_usuarios' href="#"> Usuarios </a></li>                            
                        </ul>
                    </li>
                    <li id="menu_cxp" class="menu">
                        <a href="#cxp" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <i class="fas fa-funnel-dollar"></i>
                                <span>CxP</span>
                            </div>
                            <div>
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="cxp" data-parent="#accordionExample">
                            <li><a id='menu_tarjetas' href="#"> Tarjetas </a></li>
                            <li><a id='menu_calendario' href="#"> Calendario </a></li>                            
                        </ul>
                    </li>
                    <!-- <li class="menu">
                        <a href="#base" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <i class="fas fa-list-alt"></i>
                                <span>Base de datos</span>
                            </div>
                            <div>
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="base" data-parent="#accordionExample">
                            <li><a id='rep_cat_clientes' href="#"> Clientes </a></li>
                            <li><a id='rep_cat_proveedores' href="#"> Proveedores </a></li>                            
                        </ul>
                    </li> -->
                    <li id='menu_facturacion' class="menu">
                        <a href="#facturacion" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <i class="fas fa-money-check-alt"></i>
                                <span>Facturación</span>
                            </div>
                            <div>
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="facturacion" data-parent="#accordionExample">
                            <li><a id='menu_solicitud_facturas' href="#"> Nueva solicitud </a></li>                    
                        </ul>
                    </li>
                    <li id="menu_cxc" class="menu">
                        <a href="#cxc" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <i class="fas fa-hand-holding-usd"></i>
                                <span>CxC</span>
                            </div>
                            <div>
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="cxc" data-parent="#accordionExample">
                            <li><a id='menu_facturacion_pendiente' href="#"> Facturación x cobrar </a></li>
                            <li><a id='menu_facturacion_calendario' href="#"> Calendario </a></li>
                            <li><a id='reporte_facturacion' href="#"> Reportes </a></li>                    
                        </ul>
                    </li>
                    <li class="menu">
                        <a href="#reportes" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <div class="">
                            <i class="fas fa-table"></i>
                                <span>Reportes</span>
                            </div>
                            <div>
                            <i class="fa fa-chevron-down" aria-hidden="true"></i>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled" id="reportes" data-parent="#accordionExample">
                            <li><a id='menu_rep_eventos' href="#"> Eventos </a></li>
                            <!-- <li><a id='btn_rep_historicos' href="#"> Historicos </a></li>
                            <li><a id='btn_rep_pitch' href="#"> Pitch </a></li>                    
                            <li><a id='btn_rep_cancelados' href="#"> Cancelados </a></li> -->
                            <li><a id='menu_buscar_odc' href="#"> Gastos </a></li>
                            <li><a id='btn_rep_gastos' href="#"> Facturación </a></li> 
                            <li><a id='btn_rep_renta' href="#"> Rentabilidad </a></li>                  
                        </ul>
                    </li>
                </ul>
                <!-- <div class="shadow-bottom"></div> -->
            </nav>
        </div>