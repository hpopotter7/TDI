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
  <link rel="stylesheet" href="css/animate.css"/>
  <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
  <!-- <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap.min6.css">
  <link rel="stylesheet" href="css/estilos_ver_0006.css"/> -->
  <link rel="stylesheet" href="css/sweetalert2.css"/>
  <link rel="stylesheet" href="css/chosen.css"/>
  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">

  <link href="plugins/notification/noty.css" rel="stylesheet">
  <script src="plugins/notification/noty.js" type="text/javascript"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="js/jquery-ui-v1.11.4.js"></script>
  <script src="js/moment.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/sweetalert2.min.js"></script>
  <script src="js/chosen.jquery.js" ></script>
  <script src="js/modificar_evento.js"></script>
    <script>
     $(document).on("ready",inicio);  
    </script>
</head>
<body style='background-color: rgba(255,2552,255,0) !important;background:none !important;'>
	<div id='div_modificar_evento' class="container" style='width:70% !important;'>
		<legend>
			<h2>Solicitud de modificación de evento</h2>
		</legend>
		<div class="card">
			<div class="card-header">Evento     
				<select name="c_eventos_modificar" id="c_eventos_modificar" class="form-control" placeholder='Ingresa un evento'></select>
			</div>
			<div class="card-body">
				<h5 class="card-title">Ingresa la solicitud de tu modificación</h5>
				<!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
				<textarea id="area_modificaciones" class="form-control margen" rows="5" placeholder="Escribe algo..."></textarea>
				<br>
					<button id='btn_enviar' class="btn btn-success">
						<i class="fa fa-envelope" aria-hidden="true"></i> Solicitar cambios
          </button>
          <div class="row" id='response'>
        </div>
				</div>
			</div>
		</div>
	</body>
</htm>