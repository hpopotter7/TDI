<?php
   $bandera=0;
    if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Cambio de pass"){
      $bandera=1;
    }
    else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Caducada"){
      $bandera=2;
      echo '<script>alert("La sesíon ha caducado, inicie sesión de nuevo")</script>';
    }
    else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="No existe"){
      $bandera=3;
    }
    else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Modificada"){
      
      $bandera=4;
    }    
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Tierra de ideas </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <!-- END GLOBAL MANDATORY STYLES -->
    <style>
        body{
        background: rgb(51,70,3);
        background: linear-gradient(135deg, rgba(59,6,92,1) 0%, rgba(30,107,172,1) 67%, rgba(0,212,255,1) 100%);/*hydrogen*/
/*        background: linear-gradient(135deg, #FC466B 0%, #3F5EFB 100%); /*club*/
        /*background: linear-gradient(135deg, #515ada 0%, #efd5ff 100%); /*lily*/
        /*background: linear-gradient(135deg, #c67700 0%, #fcff9e 100%);  /*catcut*/
        /*background: linear-gradient(135deg, #00C9FF 0%, #92FE9D 100%); /*oasis/*
        /*background: linear-gradient(135deg, #800080 0%, #ffc0cb 100%); /*pink flavor*/
        /*background: linear-gradient(135deg, #1a2a6c 0%, #b21f1f 60%, #fdbb2d 100%); /*king yna*/
        /*background: linear-gradient(135deg, #22c1c3 0%, #fdbb2d 100%); /*sumer*/
        }
    </style>
</head>
<body class="form ">
    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container">
                    <div class="form-content">
                        <h1 class="">Tierra de ideas</h1>
                        <p class="">Inicio de sesión</p>
                        <!-- <form class="text-lesft"> -->
                        <form id="form_login" class="text-left" method="post" action="loguin.php" role="login">
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="password">USUARIO</label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="user" name="user" type="text" class="form-control" placeholder="Username">
                                </div>

                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password">CONTRASEÑA</label>
                                        <!-- <a href="auth_pass_recovery_boxed.html" class="forgot-pass-link">Forgot Password?</a> -->
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="pass" name="pass" type="password" class="form-control" placeholder="Contraseña">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-secondary" value=""><i class="fas fa-headset"></i> Entrar</button>
                                    </div>
                                </div>
                                <hr>
                                <div class="social">
                                    <a style='background-color:#8dbf42 !important;' href="https://administraciontierradeideas.mx/soporte/login" class="btn btn-success" target="_blank">                                   
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg></i> Soporte</a>
                                   <!-- <a href="javascript:void(0);" class="btn social-github">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                                        <span class="brand-name">Github</span>
                                    </a> -->
                                </div>

                                <!-- <p class="signup-link">Not registered ? <a href="auth_register_boxed.html">Create an account</a></p> -->

                            </div>
                        </form>
                    </div>     
                                  
                </div>
            </div>
        </div>
    </div>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="assets/js/authentication/form-2.js"></script>
</body>
</html>