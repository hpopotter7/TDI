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
  <title>ERP Tierra de ideas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta http-equiv='cache-control' content='no-cache'>
  <meta http-equiv='expires' content='0'>
  <meta http-equiv='pragma' content='no-cache'>
  <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="stylesheet" href="css/jquery.fancybox.css" />
  
  <link rel="stylesheet" href="css/animate.css"/>
  <link rel="stylesheet" href="css/bootstrap.min3.css">
  <link rel="stylesheet" href="css/estilos_ver_0006.css"/>
  <link rel="stylesheet" href="css/sweetalert2.css"/> 
  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">

  <script src="js/jquery-1.11.2.js"></script>
  <script src="js/jquery-ui-v1.11.4.js"></script>
  <script src="js/noty/packaged/jquery.noty.packaged.js"></script>
  <script src="js/audio.min.js"></script>
  <script src="js/sweetalert2.min.js"></script>
  <script src="https://kit.fontawesome.com/9b26aa506d.js" crossorigin="anonymous"></script>
  
  <style>
    .fixed-btn{
  position: fixed;
  /*bottom: 10%;*/
  top:7%;
  left:47%;
  background: #649919;
  width: 80px;
  height: 80px;
  line-height: 45px;
  text-align: center;
  border-radius: 63px;
  box-shadow: 4px 4px 4px #0a78aa;
  cursor: pointer;
}

.fixed-btn p{
  text-transform: uppercase;
  font-family: arial;
  font-weight: 900;
  color: #fff;
  padding-top:20px;
}
.fixed-btn p:hover{
  color:#fff;
}

.fixed-btn:active{
  box-shadow: 0  0;
}
  </style>
  
  <body>
 
  <div id='div_login' class="container" >
    <div class="row" id="pwd-container" style="top:50px">    
      <div class="col-md-4 col-md-offset-4">
      <?php
      if($bandera==0 || $bandera==2 || $bandera==3 || $bandera==4){
        echo '
        <section class="login-form">
          <form id="form_login" method="post" action="loguin.php" role="login">
            <img src="img/logo.png" class="img-responsive" alt="" />
            <div class="form-group has-feedback">
              <span style="position:absolute; left:-10px;top:12px;color: black" class="fas fa-user"></span>
              <input style="color: #464545" type="text" id="user" name="user" class="form-control input-lg" placeholder="Usuario" required/>
            </div>
            <div class="form-group has-feedback">
              <span style="position:absolute; left:-10px;top:12px; color: black" class="fas fa-unlock-alt "></span>
              <input style="color: #464545" type="password" id="pass" name="pass" class="form-control input-lg" placeholder="Contraseña" required/>
            </div>
            <button type="submit" id="btn_in" class=" cambio btn btn-lg btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Entrar</button>
          </form>
        </section>';
      }
      
      if($bandera==1 ){
        echo '
        <section class="login-form">
          <form method="post" action="modificar_password.php" role="login">
            <h5><label class="alert alert-warning">Ingresa una nueva contraseña</label></h5>
            <div class="form-group has-feedback">
              <span style="position:absolute; left:-10px;top:12px;color: black" class="fas fa-user"></span>
              <input style="color: #464545" type="text" id="user" name="user" class=" disabled form-control input-lg" placeholder="Usuario" value="'.$_COOKIE['nombre'].'" disabled/>

            </div>   
            <div class="form-group has-feedback">
              <span style="position:absolute; left:-10px;top:12px; color: black" class="fas fa-unlock-alt "></span>
              <input style="color: #464545" type="password" id="pass" name="pass" class="form-control input-lg" placeholder="Contraseña" />
            </div>
            <button type="submit" id="btn_in" class=" cambio btn btn-lg btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Aceptar</button>
            <a href="logout.php" <button type="button" class="cambio btn btn-lg btn-danger btn-block"><i class="fas fa-backspace"></i> Regresar</button></a>
          </form>
        </section>
        ';
      }
        ?>
      </div>
    </div>  
  </div>
</body>
<?php 
if($bandera==3){
      echo "<script>swal({
        type: 'warning',
        text:  'Los datos ingresados son incorrectos',
      });</script>";
      
    }
    ?>
    <?php 
if($bandera==4){
      echo "<script>swal({
        title: 'Contraseña actualizada',
        type: 'success',
        text:  'Inicia sesión de nuevo',
      });</script>";
      
    }
    ?>
<div class="fixed-btn">
    <p><a href="https://administraciontierradeideas.mx/soporte/login" target="_blank"><i class="fas fa-headset fa-3x" aria-hidden="true"></i></a></p>
  </div>
  
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
<script>

</script>
</html>