<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png">
  <link rel="stylesheet" href="css/jquery-ui.css">
  <link rel="stylesheet" href="css/bootstrap.min6.css">
  <link rel="stylesheet" href="css/chosen.css"/>
  <link rel="stylesheet" href="css/data_tables.css">
  <link rel="stylesheet" href="css/basic.css">
  <link rel="stylesheet" href="css/dropzone.css">
  <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
  <link href="plugins/notification/noty.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/sweetalert2.css"/>
  
  <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
   <script src="bootstrap/js/popper.min.js"></script>
   <script src="bootstrap/js/bootstrap.min.js"></script>
   <script src="js/chosen.jquery.js"></script>
   <!--demo-->
   <script src="js/dropzone.js"></script>
   <script src="plugins/notification/noty.js" type="text/javascript"></script>
   <script src="js/sweetalert2.min.js"></script>
   <!--demo-->
   <script src="js/registro_cliente.js"></script>
   <script>
      $(document).ready(inicio);
   </script>
    
    <!-- END PAGE LEVEL STYLES -->
    
</head>
<body style='background-color: rgba(255,2552,255,0) !important;background:none !important;'>
<?php
 $id_cliente="";
 if(isset($_GET["id"])){
   $id_cliente=$_GET["id"];
   
      echo '<input id="id_cliente"type="hidden" value="'.$id_cliente.'">';
   }
   else{
      echo '<input id="id_cliente"type="hidden" value="0">';
   }
?>

      <div class="container">
      <h2>Solicitud de alta de cliente</h2>
            <div class="row">
               <div class="form-group col-md-6 ">
                  <label id='l_razon' for="name" class="cols-sm-2 control-label">Razon Social del cliente</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input id='txt_nombre_cliente' name='txt_nombre_cliente' type="text" class="form-control" placeholder="Razon Social" required />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-3 ">
                  <label for="name" class="cols-sm-2 control-label">RFC</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                        <input id='txt_rfc' name='txt_rfc' type="text" class="form-control" placeholder="RFC" />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-3 ">
                  <label for="name" class="cols-sm-2 control-label">Dias de crédito</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                        <input id='dias_credito' name='dias_credito' type="text" class="form-control" placeholder="Días de crédito" />
                     </div>
                  </div>
               </div>
               
            </div>
            <div class="row">
               <div class="form-group col-md-10 ">
                  <label for="name" class="cols-sm-10 control-label">Nombre comercial</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input id='txt_nombre_comercial' name='txt_nombre_comercial' type="text" class="form-control" placeholder="Nombre comercial" />
                     </div>
                  </div>
               </div>
               <div id='div_tipo_persona' class="form-group col-md-2 ">
                  <label for="name" class="cols-sm-2 control-label">Tipo persona</label>
                  <div class="cols-sm-1">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-question" aria-hidden="true"></i></span>
                        <select name="combo_tipo_persona" id="combo_tipo_persona" class="form-control">
                           <option value="vacio">Elige..</option>
                           <option value="FISICA">Física</option>
                           <option value="MORAL">Moral</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-2 ">
                  <label for="name" class="cols-sm-2 control-label">C.P.</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-bell" aria-hidden="true"></i></span>
                        <input id='txt_cp' name='txt_cp' type="text" class="form-control" placeholder="C.P." />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-3 ">
                  <label for="name" class="cols-sm-2 control-label">Estado</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <input id='txt_estado' name='txt_estado' type="text" class="form-control" placeholder="Estado" />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-3 ">
                  <label for="name" class="cols-sm-2 control-label">Municipio/Alcaldía</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <input id='txt_municipio' name='txt_municipio' type="text" class="form-control" placeholder="Municipio/Alcaldía"  />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-4 ">
                  <label for="name" class="cols-sm-2 control-label">Colonia</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <!-- <input type='text' id="c_colonia" name='c_colonia' class='form-control' placeholder='Colonia'/> -->
                        <select name="c_colonia" id="c_colonia" class='form-control'></select>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="form-group col-md-6 ">
                  <label for="name" class="cols-sm-2 control-label">Calle</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                        <input id='txt_calle' name='txt_calle' type="text" class="form-control" placeholder="Calle" />
                     </div>
                  </div>
               </div>
              <div class="form-group col-md-3">
                 <label for="name" class="cols-sm-2 control-label"># Ext</label>
                 <div class="cols-sm-10">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                       <input id='txt_num_ext' name='txt_num_ext' type="text" class="form-control" placeholder="# Ext" />
                    </div>
                 </div>
              </div>
              <div class="form-group col-md-3">
                 <label for="name" class="cols-sm-2 control-label"># Int</label>
                 <div class="cols-sm-10">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-hashtag" aria-hidden="true"></i></span>
                       <input id='txt_num_int' name='txt_num_int' type="text" class="form-control" placeholder="# Int" />
                    </div>
                 </div>
              </div>
              
            </div>
            <div class="row">
            <div class="form-group col-md-4">
                 <label for="name" class="cols-sm-2 control-label">Telefono</label>
                 <div class="cols-sm-10">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                       <input id='txt_telefono' name='txt_telefono' type="text" class="form-control" placeholder="10 digitos" />
                       
                    </div>
                 </div>
              </div>
              <div class="form-group col-md-4">
                 <label for="name" class="cols-sm-2 control-label">Extensión</label>
                 <div class="cols-sm-10">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                       <input id='txt_extension' name='txt_extension' type="text" class="form-control" placeholder="Dejar vacio si no tiene extensión" />
                       
                    </div>
                 </div>
              </div>
              <div class="form-group col-md-4">
                 <label for="name" class="cols-sm-2 control-label">Celular</label>
                 <div class="cols-sm-10">
                    <div class="input-group">
                       <span class="input-group-addon"><i class="fa fa-mobile" aria-hidden="true"></i></span>
                       <input id='txt_celular' name='txt_celular' type="text" class="form-control" placeholder="10 digitos" />
                    </div>
                 </div>
              </div>
            </div>
            <div class="row">
               <div class="form-group col-md-4 ">
                  <label for="name" class="cols-sm-2 control-label">Nombre de contacto</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user" aria-hidden="true"></i></span>
                        <input id='txt_nombre_contacto' name='txt_nombre_contacto' type="text" class="form-control" placeholder="Nombre de contacto" />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-4 ">
                  <label for="name" class="cols-sm-2 control-label">Correo de contacto</label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                        <input id='txt_correo_contacto' name='txt_correo_contacto' type="text" class="form-control" placeholder="Correo de contacto" />
                     </div>
                  </div>
               </div>
               <div class="form-group col-md-4">
                  <label for="name" class="cols-sm-2 control-label">Uso de CFDI </label>
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-qrcode" aria-hidden="true"></i></span>
                        <select name="" id="c_CFDI_CLIENTE" class='form-control' >
                           <option value="vacio">Selecciona...</option>
                           <option value='G01'>Adquisición de mercancias</option>
                           <option value='G02'>Devoluciones, descuentos o bonificaciones</option>
                           <option value='G03'>Gastos en general</option>
                           <option value='I03'>Equipo de transporte</option>
                           <option value='I04'>Equipo de computo y accesorios</option>
                           <option value='I08'>Otra maquinaria y equipo</option>
                           <option value='D04'>Donativos.</option>
                           <option value='P01'>Por definir</option>
                        </select>
                     </div>
                  </div>
               </div>
            </div>
            </section>
            <button id='btn_documentos' class='btn btn-warning btn-lg'>Documentos</button>
            <?php
               if($id_cliente==null || $id_cliente==""){
                  echo "<fieldset style='display:none'> ";
               }
               else{
                  echo "<fieldset> ";
               }
            ?>
                                            
               <div class="col-md-6" style="border-right: 1px dashed black; min-height: 75px">
                <h3 id='test'>Requeridos</h3>
                <!-- <div class='row'>
                  <button id='span_file_csf' class="btn btn-default form-control" disabled>
                    <i class="fa fa-file-pdf-o fa-2x" aria-hidden="true"></i>
                      <label>Constancia de Situacion Fiscal</label><input id='file_csf' class='btn_archivos' name='file_csf' type="file" style='cursor: not-allowed' disabled >
                  </button>
                  <div class="progress pro_csf"><div class="progress-bar progress-bar-warning progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"><span class="sr-only">Subiendo archivo...</span></div></div>
                </div> -->
                <div class="col-md-12">
                 <!-- <form action="subir_archivos.php" class="dropzone">Constancia</form> -->
                  <div id="file_csf" class="dropzone" style='min-height:20px;padding:0px'>
                   <div class="dz-default dz-message"><h3><label for="" class='label label-primary'>Constancia de Situación Fiscal</label></h3></div>
                  </div>
                </div>
                <!-- <div class="col-md-12">
                  <div id="file_ine" class="dropzone" style='min-height:20px;padding:0px'>
                   <div class="dz-default dz-message"><h3><label for="" class='label label-primary'>Identificación INE</label></h3></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div id="file_edo" class="dropzone" style='min-height:20px;padding:0px'>
                   <div class="dz-default dz-message"><h3><label for="" class='label label-primary'>Estado de cuenta</label></h3></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div id="file_comp" class="dropzone" style='min-height:20px;padding:0px'>
                   <div class="dz-default dz-message"><h3><label for="" class='label label-primary'>Comprobante de domicilio</label></h3></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div id="file_acta" class="dropzone" style='min-height:20px;padding:0px'>
                   <div class="dz-default dz-message"><h3><label for="" class='label label-primary'>Acta constitutiva</label></h3></div>
                  </div>
                </div> -->
                
               
               </div>
               <div class="col-md-6" >
                    <div class="form-group col-md-12">
                       <h3>Guardados</h3>
                       <ul id='ul_archivos' class="list-group list-group-flush">
                            <?php
                              $directorio = 'clientes/'.$id_cliente;
                              $bandera_files=false;
                              $myfiles = scandir($directorio);
                              foreach($myfiles as $file){
                                 if(!is_dir($directorio."/".$file)){
                                   echo "<li><a class='btn btn-success' target='_blank' href='".$directorio."/".$file."'>".$file."</a></li>";
                                   $bandera_files=true;
                                 }
                               }
                            ?>                      
                       </ul>
                  </div>
               </div>
            </fieldset>
            <br>
            <div class="row">
               <div class="form-group col-md-2">
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <?php
                           if($bandera_files){
                              include("conexion.php");
                                   if (mysqli_connect_errno()) {
                                       printf("Error de conexion: %s\n", mysqli_connect_error());
                                       exit();
                                   }
                                    $sql = "SELECT Numero_Cliente FROM clientes where id_cliente='".$id_cliente."'";
                                   $result = $mysqli->query("SET NAMES 'utf8'");
                                   if ($result = $mysqli->query($sql)) {
                                        while ($row = $result->fetch_row()) {
                                           $num_cliente=$row[0];
                                       }
                                       $result->close();
                                   }
                              if($num_cliente=="0"){
                                 echo '<button type="button" id="enviar_solicitud_cliente" class="abajo btn_verde btn btn-lg btn-primary btn-block pull-right"><i class="fas fa-paper-plane" aria-hidden="true"></i> Enviar Solicitud</button>';
                              }                       
                           }
                        ?>                        
                     </div>
                  </div>
               </div>
               
               <div class="form-group col-md-2 pull-right">
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <button type="button" id="btn_limpiar" class="abajo btn btn-lg btn-info btn-block pull-right"><i class="fa fa-eraser" aria-hidden="true"></i>Limpiar</button>
                     </div>
                  </div>
               </div>
               <!-- <div class="form-group col-md-1 pull-right">
                  <div class="cols-sm-10">
                     <div class="input-group">
                        <button type="button" id="btn_desc_zip" class="abajo btn btn-lg btn-info btn-block pull-right"><i class="i_espacio fa fa-download" aria-hidden="true"></i></button>
                     </div>
                  </div>
               </div> -->
               <div class="form-group col-md-3 pull-right">
                  <div class="cols-sm-10">
                     <div class="input-group">
                     <?php if($id_cliente!=""){
                        echo '<button type="button" id="guardar_cliente" class="abajo btn_verde btn btn-lg btn-success btn-block pull-right"><i class="i_espacio fa fa-save" aria-hidden="true"></i> Guardar Cliente</button>';
                     }?>
                     </div>
                  </div>
               </div>
            </div>
          
         </div>
      </div>
</body>
</html>