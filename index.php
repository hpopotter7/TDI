<?php
    session_start();
    if($_SESSION['luser']!=""){
        header('Location: home.php');
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
  <link rel="stylesheet" href="css/bootstrap.min2.css">
  <link rel="stylesheet" href="css/estilos_ver_0003.css"/>
  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">

  <script src="js/jquery-1.11.2.js"></script>
  <script src="js/jquery-ui-v1.11.4.js"></script>

  <script src="js/audio.min.js"></script>
  <script src="https://kit.fontawesome.com/9b26aa506d.js" crossorigin="anonymous"></script>
 
  
  <div id='div_login' class="container" >
    <div class="row" id="pwd-container" style="top:50px">    
      <div class="col-md-4 col-md-offset-4">
        <section class="login-form">
          <form method="post" action="loguin.php" role="login">
            <img src="img/logo.png" class="img-responsive" alt="" />
            <div class="form-group has-feedback">
            
              <span style="position:absolute; left:-10px;top:12px;color: black" class="fas fa-user"></span>
              <input style="color: #464545" type="text" id="user" name='user' class="form-control input-lg" placeholder="Usuario" />
            </div>
            
            <div class="form-group has-feedback">
              <span style="position:absolute; left:-10px;top:12px; color: #464545" class="fas fa-unlock-alt "></span>
              <input style="color: #464545" type="password" id="pass" name='pass' class="form-control input-lg" placeholder="Contraseña" />
            </div>
            <button type="submit" id="btn_in" class=" cambio btn btn-lg btn-primary btn-block"><i class="fas fa-sign-in-alt"></i> Entrar</button>
          </form>
        </section>  
      </div>
    </div>  
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
</html>