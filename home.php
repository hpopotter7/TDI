<?php

  if(!isset($_COOKIE['user'])) {
    header('Location:inicio.php');
  }
  else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="No existe"){
    header('Location:inicio.php');
  }
  else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Caducada"){
    header('Location:inicio.php');
  }
  else if(isset($_COOKIE['user']) && ($_COOKIE['user'])=="Cambio de pass"){
   header('Location:inicio.php');
  }
  else{
    $secondsInactive = time() - $_COOKIE['start'];
    
  }
  $evento="0";
  if(isset($_GET['sol'])) {
    $evento=$_GET['sol'];
  }
  
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>ERP| Tierra de Ideas </title>
    <!--<link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>-->
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert2.css"/>
    <link href="plugins/notification/noty.css" rel="stylesheet">
    <link rel="stylesheet" href="css/animate.css"/>
    
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <!--<script src="assets/js/libs/jquery-3.1.1.min.js"></script>-->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="js/jquery-ui-v1.11.4.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="https://kit.fontawesome.com/9b26aa506d.js" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>
    <script src="js/sweetalert2.min.js"></script>
    <script src="plugins/notification/noty.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="assets/js/custom.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="plugins/apex/apexcharts.min.js"></script>
    <script src="assets/js/dashboard/dash_1.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

    <!--<script src="js/funciones_v110.js"></script>-->
    <script src="js/metodos_nuevo2.js"></script>
    <script>
        $(document).on("ready",inicio); 
    </script>  
    <style>
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
        opacity: 0.1;
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
    </style>
</head>
<body >
    <input id='txt_evento' type="hidden" value=<?php echo $evento;?>>
<audio id="audio_ding">
   <source src="audio/tada.mp3" type="audio/mp3" />
   <source src="audio/tada.wav" type="audio/wav" />
</audio>
div
    <!--<img src="img/logo2.png" alt="" style='width:80%;heigth:80%;position:fixed;top:-100px;left:300px;opacity:.075;z-index:-20'>-->
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <?php
    include_once("header.php");
    ?>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <?php 
          require_once("menu.php");
        ?>
        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content principal_content">
            
                <section style='height: 840px !important'>
                    
                    <iframe src='pendientes.php' style='width:100%; height: 100%;' class="resp-iframe" id="frame" src="" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen>
                    </iframe>
                </section>
                <div class="row layout-top-spacing">
                <section style='background-color:red'>
                    <div class="" style=" position: fixed;
                    left: 0;
                    bottom: 0;
                    width: 100%;
                    background: linear-gradient(180deg,#BBD32A 20%, rgba(68,101,10,1) 100%);
                    background-color: #BBD32A;
                    color: #434142;
                    text-align: center;
                    z-index: 400px;">© Tierra de ideas (2018)
                    </div>
                </section>

                </div>

            
           <!--  <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2020 <a target="_blank" href="https://designreset.com">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div> -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->
    
    <div class="modal fade" id="modal_pie" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_pie_titulo"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>          
            <div class="modal-body">              
            <canvas id='pie' height="350" width='400' title="Utilidad"></canvas>
            
        </div>
    </div>
    </div>
</div>
</body>
</html>