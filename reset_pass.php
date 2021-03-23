<?php
$fondo=random_int(1, 8);
switch($fondo){
    case 1:
        $back="background: linear-gradient(135deg, rgba(59,6,92,1) 0%, rgba(30,107,172,1) 67%, rgba(0,212,255,1) 100%);";
    break;
    case 2:
        $back="background: linear-gradient(135deg, #FC466B 0%, #3F5EFB 100%);";
    break;
    case 3:
        $back="background: linear-gradient(135deg, #515ada 0%, #efd5ff 100%);";
    break;
    case 4:
        $back="background: linear-gradient(135deg, #c67700 0%, #fcff9e 100%);";
    break;
    case 5:
        $back="background: linear-gradient(135deg, #00C9FF 0%, #92FE9D 100%);";
    break;
    case 6:
        $back="background: linear-gradient(135deg, #800080 0%, #ffc0cb 100%);";
    break;
    case 7:
        $back="background: linear-gradient(135deg, #22c1c3 0%, #fdbb2d 100%);";
    break;
    case 8:
        $back="background: linear-gradient(135deg, #1a2a6c 0%, #b21f1f 60%, #fdbb2d 100%);";
    break;
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Password Recovery Boxed | CORK - Multipurpose Bootstrap Dashboard Template </title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/authentication/form-2.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
</head>
<body class="form no-image-content" style="<?php echo $back;?>">
    

    <div class="form-container outer">
        <div class="form-form">
            <div class="form-form-wrap">
                <div class="form-container" style='min-height:70%'>
                    <div class="form-content">

                    <h1 class="" style='color: #fff;text-shadow: #000 1px 1px 0px, #333 2px 2px 0px;color: #fff;'>Hola <?php echo $_COOKIE['nombre'];?></h1>
                    <h6 class="" style='color: #fff;text-shadow: #000 1px 1px 0px, #333 2px 2px 0px;color: #fff;'>Ingresa una nueva contraseña</h6>
                        <form class="text-left" method="post" action="modificar_password.php" role="login">
                            <div class="form">
                            <input id="user" name="user" type="hidden" class="form-control" placeholder="Usuario" value="<?php echo $_COOKIE['nombre'];?>">
                                <div id="email-field" class="field-wrapper input">
                                    <div class="d-flex justify-content-between">
                                    
                                    </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-at-sign"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                                    <input id="pass" name="pass" type="text" class="form-control" value="" placeholder="Nueva contraseña">
                                </div>

                                <div class="d-sm-flex justify-content-between">

                                    <div class="field-wrapper">
                                        <button type="submit" class="btn btn-secondary" value="">Cambiar contraseña</button>
                                    </div>
                                </div>

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