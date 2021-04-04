
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="plugins/notification/noty.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert2.css"/>
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-select/bootstrap-select.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/chosen.css"/>

   
</head>
<body style='background-color: rgba(255,2552,255,0) !important;background:none !important;'>
<?php
$id_usuario="";
$Nombre="";
$email="";
$user=""; 
$digital="";
$tarjetas="";
        if(isset($_GET["id"])){
        $id_usuario=$_GET["id"];
      echo '<input id="id_usuario"type="hidden" value="'.$id_usuario.'">';
        include("conexion.php");
        if (mysqli_connect_errno()) {
            printf("Error de conexion: %s\n", mysqli_connect_error());
            exit();
        }
        $result = $mysqli->query("SET NAMES 'utf8'");
        $sql="SELECT Nombre, email, User, Ejecutivo, Productor, Disenio, Solicitante, Digitalizacion, CXP, cat_clientes, cat_prov, cat_facturacion FROM usuarios where id_usuarios=".$id_usuario;
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $Nombre=$row['Nombre'];
                $email=$row['email'];
                $user=$row['User'];                
                $ejecutivo=$row['Ejecutivo'];
                $productor=$row['Productor'];
                $disenio=$row['Disenio'];
                $solicitante=$row['Solicitante'];
                $digital=$row['Digitalizacion'];
                $cxp=$row['CXP'];
                $cat_clientes=$row['cat_clientes'];
                $cat_prov=$row['cat_prov'];
                $cat_facturacion=$row['cat_facturacion'];
            }
            $result->close();            
        }
        else{
            //echo "<script>alert('Error');</script>";
        }
        // conexion tarjetas
        $sql="select id_tarjeta, No_tarjeta, tipo, estatus from tarjetas where usuario='".$id_usuario."'";
        if ($result = $mysqli->query($sql)) {
            while ($row = $result->fetch_assoc()) {
                $no_tarjeta=$row['No_tarjeta'];
                $tipo=$row['tipo'];
                $estatus=$row['estatus'];
                if($estatus=="A"){
                    $estatus="<span class='badge badge-success'>Activa</span>";
                }
                else{
                    $estatus="<span class='badge badge-danger'>Bloqueada</span>";
                }
                $tarjetas=$tarjetas."<tr><td>".$tipo."</td><td>".$no_tarjeta."</td><td>".$estatus."</td><td><i id='".$row['id_tarjeta']."' class='fas fa-trash btn_borrar_tarjeta' style='color:#ff4848;cursor:pointer'></i></td></tr>";
            }
            $result->close();
        }

        //tipos de banco
        $sql="select DISTINCT(tipo) from tarjetas order by tipo";
        if ($result = $mysqli->query($sql)) {
            $tipos='<option value="">Selecciona...</option>';
            while ($row = $result->fetch_row()) {
                $tipos=$tipos."<option value='".$row[0]."'>".$row[0]."</option>";
            }
            $result->close();
        }
        $mysqli->close();
   }
   else{
      echo '<input id="id_usuario"type="hidden" value="0">';
   }
?>
<div id='div_usuarios' class="container" style='width:90% !important'>
    <div class="row">
      <div class="col-md-12"> 
      <legend><h2>Crear Usuarios</h2></legend>
      <form id='form_usuarios' method="post">
       <div class="row">
            <div class="form-group col-md-4">
              <label for="name" class="control-label">Nombre usuario</label>
                  <input id='txt_nombre_usuario' <?php if($Nombre!=""){echo "readonly";} ?> name='txt_nombre_usuario' type="text" class="form-control" placeholder="Nombre de usuario" required="" value="<?php echo $Nombre?>"/>
            </div>
            <div class="form-group col-md-4">
              <label for="name" class="cols-sm-2 control-label">Correo usuario</label>
                  <input id='txt_email_usuario' name='txt_email_usuario' type="text" class="form-control" placeholder="e-mail de usuario" required="" value="<?php echo strtolower($email)?>"/>
            </div>
            <div class="form-group col-md-4">
              <label for="name" class="cols-sm-2 control-label">Username</label>
                  <input id='txt_username' name='txt_username' type="text" class="form-control" placeholder="Username" required="" value="<?php echo strtoupper($user)?>"/>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-8">
              <label for="name" class="cols-sm-2 control-label">Jefe Directo</label>
                  <select data-placeholder="Seleccione al jefe directo" id="c_jefe_directo" class='form-control' multiple='multiple'>
                  </select>
            </div>
            <div class="form-group col-md-2">
              <button id='btn_guardar' type="button" class="btn btn-primary" style="margin-top: 30px;"><i class="fa fa-save" aria-hidden="true"></i> Guardar</button>             
            </div>
            <div class="form-group col-md-2">
              <button id='btn_limpiar' type="button" class="btn btn-info" style="margin-top: 30px;"><i class="fas fa-eraser" aria-hidden="true"></i> Limpiar</button>             
            </div>      
        </div>
        <br>
        <div class="card component-card_8 shadow p-3 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="progress-order">
                    <div class="progress-order-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <h6>Tarjetas</h6>
                            </div>
                            <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus-circle" aria-hidden="true"></i> Añadir</button>
                            </div>
                        </div>
                    </div>
                    <div class="progress-order-body">
                        <div class="row mt-4">
                            <div class="col-md-12">
                            <table class="table table-striped table-inverse table-hover">
                                <thead>
                                <tr>
                                    <th>Banco</th>
                                    <th># Tarjeta</th>
                                    <th>Estatus</th>
                                    <th>Acción</th>
                                </tr>
                                </thead>
                                <tbody id='respuesta_tarjetas'>
                                    <?php echo $tarjetas?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        
        <div class="card component-card_8 shadow p-3 mb-5 bg-white rounded">
            <div class="card-body">
                <div class="progress-order">
                    <div class="progress-order-header">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <h6>Privilegios</h6>
                                <p class="card-subtitle mb-2 text-muted">Tipo de usuario</p>
                            </div>
                            <div class="col-md-6 pl-0 col-sm-6 col-12 text-right">                           
                            </div>
                        </div>
                    </div>
                    <div class="progress-order-body">
                        <div class="row mt-4">
                        <div class="col-md-3">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-secondary">
                                    <input type="checkbox" class="new-control-input" id='check_eje' 
                                    <?php 
                                    if($ejecutivo=="X"){
                                        echo "checked";}?>>
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Ejecutivo de cuenta</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-secondary">
                                    <input type="checkbox" class="new-control-input" id='check_pro' <?php 
                                    if($productor=="X"){
                                        echo "checked";}?>>
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Productor</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-secondary">
                                    <input type="checkbox" class="new-control-input" id='check_dis' <?php 
                                    if($disenio=="X"){
                                        echo "checked";}?>>
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Diseño</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-secondary">
                                    <input type="checkbox" class="new-control-input" id='check_sol' <?php 
                                    if($solicitante=="X"){
                                        echo "checked";}?>>
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Solicitante</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-secondary">
                                    <input type="checkbox" class="new-control-input" id='check_dig' <?php 
                                    if($digital=="X"){
                                        echo "checked";}?>>
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Digital</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-secondary">
                                    <input type="checkbox" class="new-control-input" id='check_cxp' <?php 
                                    if($cxp=="X"){
                                        echo "checked";}?>>
                                    <span class="new-control-indicator"></span><span class="new-chk-content">CXP</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <p class="card-subtitle mb-2 text-muted">Catálogos</p>
                    <div class="progress-order-body">
                        <div class="row mt-4">
                        <div class="col-md-2">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-secondary">
                                    <input type="checkbox" class="new-control-input" id='check_cli' <?php 
                                    if($cat_clientes=="X"){
                                        echo "checked";}?>>
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Clientes</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-secondary">
                                    <input type="checkbox" class="new-control-input" id='check_prov' <?php 
                                    if($cat_prov=="X"){
                                        echo "checked";}?>>
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Proveedores</span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="n-chk">
                                    <label class="new-control new-checkbox new-checkbox-text checkbox-secondary">
                                    <input type="checkbox" class="new-control-input" id='check_fac' <?php 
                                    if($cat_facturacion=="X"){
                                        echo "checked";}?>>
                                    <span class="new-control-indicator"></span><span class="new-chk-content">Facturación</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
      </form>
      </div>
    </div>
 </div>

 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Agregar tarjeta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </button>
            </div>          
            <div class="modal-body">              
                <div class="form-group row mb-4">
                <label for="name" class="col-xl-4 col-sm-3 col-sm-2 col-form-label">Tipo de tarjeta</label>
                    <select id="c_tarjetas" class='selectpicker' required="">
                        <?php   
                            echo $tipos;
                        ?>
                    </select>
                </div>
                <div class="form-group row mb-4">
                <label for="hEmail" class="col-xl-2 col-sm-3 col-sm-2 col-form-label">Tarjeta</label>
                <div class="col-xl-8 col-lg-7 col-sm-8">
                    <input id='txt_tarjeta' name='txt_tarjeta' type="text" class="form-control" placeholder="Numero de tarjeta" required=""/>
                </div>
                </div>
                <div id="alert" style='display:none'>
                </div>
            <div class="modal-footer">                
                <button id='btn_agregar' class="btn btn-primary"> <i class="fas fa-save"></i> Agregar</button>
            </div>
        </div>
    </div>
    </div>
</div>
 
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<!--<script src="assets/js/libs/jquery-3.1.1.min.js"></script>-->
  <script src="bootstrap/js/popper.min.js"></script>
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script src="plugins/notification/noty.js" type="text/javascript"></script>
  <script src="js/sweetalert2.min.js"></script>
  <script src="js/chosen.jquery.js" ></script>
  <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
  <script src="js/usuarios.js?v=<?php echo(rand()); ?>"></script>
    <script>
     $(document).on("ready",inicio);  
    </script>

</body>

  </html>