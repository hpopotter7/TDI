<?php
   $bandera=0;
   if(isset($_COOKIE['user']) && ($_COOKIE['user'])==""){
    $bandera=0;
  }
    if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Cambio de pass"){
      $bandera=1;
      header('Location:reset_pass.php');
    }
    else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Caducada"){
      $bandera=2;
      echo '<script>alert("La sesíon ha caducado, inicie sesión de nuevo")</script>';
    }
    else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="No existe"){
      $bandera=3;
      setcookie ("user", "", time() - 3600);
    }
    else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Modificada"){
      $bandera=4;
    }    

    $fondo=random_int(1,4);
    $fondi="transparent";
    switch($fondo){
        case 1:
            $back="background: linear-gradient(135deg, rgba(19,6,92,.81) 0%, rgba(30,107,172,1) 67%, rgba(0,212,255,1) 100%);"; //si
            $fondi="rgba(255,255,255,.75)";
        break;
        case 2:
            $back="background: linear-gradient(135deg, #515ada 0%, #efd5ff 100%);";  //ok
        break;
        case 3:
            $back="background: linear-gradient(135deg, #00C9FF 0%, #92FE9D 100%);"; // ok
        break;
        case 4:
            $back="background: linear-gradient(135deg, #22c1c3 0%, #fdbb2d 100%);";  //si
        break;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>ERP| Tierra de Ideas </title>
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <script src="https://kit.fontawesome.com/9b26aa506d.js" crossorigin="anonymous"></script>
    <style>
        img{
            width:115px;
            padding: 10px;
        }
    </style>
   <!--  <style>
         body{
            overflow-x: hidden;
            overflow-y: hidden;
            /* background-image: url(img/logo2.png);
            background-position: center center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: contain;
            background-color: rgba(255,255,255,.1);
            opacity: 0.1; */
        } 

        body::after {
        content: "";
        background-image: url(img/logo2.png);
        opacity: 1;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        position: absolute;
        overflow-x: hidden;
overflow-y: hidden;
        background-position: center center;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-size: contain;
        z-index: -1;   
        }
    </style> -->
</head>
<body class="form" style="<?php echo $back;?>">
<div class="titulo" style='position: fixed; padding:20px'><img style='background:<?php echo $fondi;?>' src="img/logo.png" ></div>
    <div class="form-container outer">
        <div class="form-form">            
            <div class="form-form-wrap">                
                <div class="form-container" style='min-height:70%'>                
                    <div class="form-content">
                    <a href="https://administraciontierradeideas.mx/soporte/login" target="_blank" class="btn" style='border-radius:13em;width:80%;border: 0px #2da337 solid; background-color: #2da337;color:#fff;padding:1.5em;margin-bottom:10px;width:100px'>
                    <i class="fas fa-headset fa-2x" aria-hidden="true"></i>
                                        <span class="brand-name" style='color:#fff'> <!-- <i class="fas fa-headset" aria-hidden="true"></i> --></span>
                                    </a>
                    <h1 class="" style='color: #fff;text-shadow: #000 1px 1px 0px, #333 2px 2px 0px;color: #fff;'>Tierra de ideas</h1> 
                        <h4 class="" style='color: #fff;text-shadow: #000 1px 1px 0px, #333 2px 2px 0px;color: #fff;'>Inicia sesión</h4> 
                        <?php if($bandera==3){setcookie ("user", "", time() - 3600); $bandera=0;?>
                        <div class="social">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Los datos ingresados son incorrectos.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>         
                        <?php }?>
                        <?php if($bandera==4){setcookie ("user", "", time() - 3600); $bandera=0;?>
                        <div class="social">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Tu contraseña ha sido actualizada, inicia sesión nuevamente.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>         
                        <?php }?>
                        <form class="text-left" id="form_login" method="post" action="loguin.php" role="login">
                            <div class="form">
                                <div id="username-field" class="field-wrapper input">
                                    <label for="username"></label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    <input id="user" name="user" type="text" class="form-control" placeholder="Usuario">
                                </div>
                                <div id="password-field" class="field-wrapper input mb-2">
                                    <div class="d-flex justify-content-between">
                                        <label for="password"></label>
                                    </div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-lock"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                                    <input id="pass" name="pass" type="password" class="form-control" placeholder="Contraseña">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" id="toggle-password" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </div>
                                <div class="d-sm-flex justify-content-between">
                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-secondary" value="">Entrar</button>
                                    </div>
                                </div>                                
                                <!-- <hr>
                                <div class="social">
                                    <a href="https://administraciontierradeideas.mx/soporte/login" target="_blank" class="btn social-fb" style='width:80%;border: 0px #2da337 solid; background-color: #1467c2;color:#fff'>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-external-link"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                                        <span class="brand-name" style='color:#fff'> <i class="fas fa-headset" aria-hidden="true"></i>  Soporte</span>
                                    </a>
                                    <a href="javascript:void(0);" class="btn social-github">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-github"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"></path></svg>
                                        <span class="brand-name">Github</span>
                                    </a> 
                                </div> -->
                                

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