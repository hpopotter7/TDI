<div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm" style="height: 75px;background: #BBD32A;
background: linear-gradient(45deg,#BBD32A 0%, rgba(68,101,10,1) 100%);">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom" style="margin-left:10px;color:#000"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
            <ul class="navbar-item theme-brand flex-row  text-center">
                <!-- <li class="nav-item theme-logo">
                    <a href="index.html">
                        <img src="assets/img/logo.png" class="navbar-logo" alt="logo" style="width:50px;heigth:50px;">
                    </a>
                </li> -->
                <li class="nav-item theme-logo">
                    <a href="home.php" class="nav-link"><h3><img src="img/logo.png" alt=""> Tierra de Ideas</h3></a>
                </li>
                <!-- <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb" style='font-size: 1.2em; padding-top: 30px; margin-left: 25px; color: black; background-color: rgba(0,0,0,.0) !important'>
                        <li id='ol_menu' class="breadcrumb-item"></li>
                        <li id='ol_submenu' class="breadcrumb-item active" aria-current="page"><span></span></li>
                    </ol>
                </nav> -->
            </ul>
            <ul class="navbar-item flex-row ml-md-auto">
                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="color:white;font-size:1.2em;">
                        <i class="fa fa-user-circle" aria-hidden="true" style="color;white; font-size:1.7em;"> 
                        <span class="span_notificacion" style="background-color:red; border-radius:10em;; width:12px;height:12px;display: none;position: absolute;left: 36px;"></span> </i>                        
                    </a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <label style='text-align: center; border-bottom: 2px dotted #4a4545; width: 100%; background: blueviolet; color: white; vertical-align: bottom;'><?php echo $_COOKIE['user']?></label>
                        <div class="">
                            <div class="dropdown-item">
                                <a disabled='disabled' id="btn_mi_perfil" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user disabled"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> Mi perfil</a>
                            </div>
                            <div class="dropdown-item">
                                <a id='btn_buzon' href="#"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-inbox"><polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline><path d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path></svg><span class="span_notificacion" style="background-color:red; border-radius:10em;; width:10px;height:10px;display: inline;position: absolute;left: 53px;"></span> Notificaciones</a>
                            </div>
                            <div class="dropdown-item">
                                <a class="" href="logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg> Cerrar Sesión</a>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </header>
    </div>