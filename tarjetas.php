
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">   
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <!-- <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="css/sweetalert2.css"/>
    <link rel="stylesheet" type="text/css" href="assets/css/forms/switches.css">
    <link href="plugins/animate/animate.css" rel="stylesheet" type="text/css" />
    <!-- BEGIN PAGE LEVEL STYLES -->
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-select/bootstrap-select.min.css">
    <link href="https://use.fontawesome.com/releases/v5.0.1/css/all.css" rel="stylesheet">
    <!--  <link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css"> -->
    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css"> -->

    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
    <style>
        i{
            margin-left:5px;
        }
    </style>
    <link href="plugins/notification/noty.css" rel="stylesheet">
    <script src="js/sweetalert2.min.js"></script>

    
    <!-- END PAGE LEVEL STYLES --> 
</head>
<body>
<div id="content" class="main-content" style="margin-top:10px;width: 80% !important; margin: 20px auto !important;background-color: rgba(0,0,0,.0) !important;">
    <div class="row">
      <div class="col-md-12"><h2>Tarjetas</h2></div>     
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">Selecciona un banco: </label>
    <select class="selectpicker" id='c_banco_tarjetas' title="Selecciona...">
    <?php
      include("conexion.php");
      if ($mysqli->connect_error) {
          die('Error de conexión: ' . $mysqli->connect_error);
          exit();
      }
      $result = $mysqli->query("SET NAMES 'utf8'");
        $sql="select DISTINCT(Tipo) from tarjetas order by Tipo asc";
      $res="";
      if ($result = $mysqli->query($sql)) {
        while ($row = $result->fetch_row()) {
          $res=$res."<option value='".$row[0]."'>".$row[0]."</option>";
      }
          $result->close();
      }
      else{
        $return =mysqli_error($mysqli);
      }
      echo $res;
      $mysqli->close();
      ?>
  </select>
<div id='spin' style='display:none' ><i  class="fa fa-spinner fa-pulse fa-2x fa-fw"></i> Buscando</div>
</div> 
<div class="row col-md-12" id='tarjetas_resultado'> </div>
<!-- <div id='div_cxc' class="container">
     <div class="row main">
       <legend><h2>Tarjetas</h2></legend>
        <div class="row">
          <div class="form-groups col-md-12">
            <label for="name" class="cols-sm-2 control-label">Selecciona un banco</label>
            <div class="cols-sm-10">
              <div class="input-group">
                <span class="input-group-addon"><i class="fas fa-credit-card-alt" aria-hidden="true"></i></span>
                <select name="c_banco_tarjetas" id="c_banco_tarjetas" class='form-control'>
                </select>
              </div>
            </div>
          </div>
          <div id='btn_gif_tarjetas_resumen' class="form-group col-md-2 abajo " style="display:none">
            <button class='btn btn-primary'><img src="img/fancybox_loading.gif" > Buscando información</button>
          </div>
        </div>

     </div>
     <div class="row col-md-12" id='tarjetas_resultado'>
     </div>
  </div> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="bootstrap/js/popper.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script> -->
    <!-- <script src="plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/app.js"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script> -->
    <!-- <script src="assets/js/custom.js"></script> -->
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="js/sweetalert2.min.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>
    <script src="js/dataTables.buttons.min.js"></script>
    <script src="js/buttons.flash.min.js"></script>
    <script src="js/jszip.min.js"></script>
    <script src="js/pdfmake.min.js"></script>
    <script src="js/vfs_fonts.js"></script>
    <script src="js/buttons.html5.min.js"></script>
    <script src="js/buttons.print.min.js"></script>
    <script src="js/jspdf.min.js"></script>
    <script src="plugins/notification/noty.js" type="text/javascript"></script>
    <script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
    <script>
      function generate(tipo, texto){
        //mint, sunset, metroui, relax, nest, semantic, light, boostrap-v3
        var tema="mint";
        if(tipo=="success"){
            tema="nest";

        }
        if(tipo=="warning"){
            tema="metroui";

        }
     var n= new Noty({
              text: texto,
              type: tipo,
              theme: tema,
              layout: "top",
              timeout: 4000,
              animation: {
                  open : 'animated fadeInRight',
                  close: 'animated fadeOutRight'
              }
          }).show();
      return n;
    }
    
      $('#c_banco_tarjetas').change(function(){
        var banco_tarjeta=$(this).val();
        if(banco_tarjeta!="vacio"){
          var parametros = {
                  "banco_tarjeta": banco_tarjeta,
                };
          $.ajax({
            data: parametros,
            url:   'ver_resumen_tarjetas.php',
            type:  'post',
            beforeSend: function(){
              $('#spin').show("");
              $('#tarjetas_resultado').fadeOut();
            },
            success:  function (response) {
              $('#spin').hide("");
              $('#tarjetas_resultado').html(response).fadeIn();
              $('.operaciones_tarjeta').selectpicker();
              $('[data-toggle="tooltip"]').tooltip();
            }
          });
        }
        });

        $('#tarjetas_resultado').delegate('.operaciones_tarjeta', 'change', function(){
          var arr=$(this).val();
          var res = arr.split("_");
          var consulta=res[0];
          var tarjeta=res[1];
          var datos={
              "tarjeta":tarjeta,
          };
          $('.filas_ocultas').fadeOut();
          if(consulta.includes("cargos")){
            $.ajax({
              url:   'agregar_abono.php',
              type:  'post',
              data: datos,
              success:  function (response) {
                  
              $('.'+tarjeta).html(response);
              $('.'+tarjeta).fadeIn();
              $('.operaciones_tarjeta').val("vacio");
              }
            });
          }
          else if(consulta.includes("devoluciones")){
            $.ajax({
              url:   'ver_devoluciones.php',
              type:  'post',
              data: datos,
              success:  function (response) {
              
              $('.'+tarjeta).html(response);
              $('.'+tarjeta).fadeIn();
              $('.operaciones_tarjeta').val("vacio");
              }
            });
          }
          else if(consulta.includes("movimientos")){
            $.ajax({
              url:   'consultar_movimientos.php',
              type:  'post',
              data: datos,
              success:  function (response) {
                //fila vacia abajo del combo
              $('.'+tarjeta).html(response);
              $('.'+tarjeta).fadeIn();
              $('.operaciones_tarjeta').val("vacio");
              }
            });
          }
        });

        //aplicar cargo
        $('#tarjetas_resultado').delegate('.btn-aplicar-cargo', 'click', function(){
        var componente=$(this).attr("id");
        var importe=$('.'+componente).val();
        var res=componente.split("_");
        var id=res[1];
        var datos={
            "importe":importe,
            "id":id,
        };
        
        $.ajax({
          url:   'aplicar_cargo.php',
          type:  'post',
          data: datos,
          success:  function (response) {
            if(response.includes("éxito")){
              generate("success", "El cargo se ha aplicado");
              $('.filas_ocultas').fadeOut();
            }
            else{
              generate("warning", "Error: "+response);
            }
          }
        });
      });

      //aplicar devolucion
      $('#tarjetas_resultado').delegate('.btn-aplicar-devolucion', 'click', function(){
  var componente=$(this).attr("id"); //id button importe_2472 --> importe_2472
  var minimo=$(this).attr("name");
  //var minimo=$('.'+componente).attr('id'); //class importe_2472 input --> 3000
  var valor=$('#btn_'+componente).val();  //valor introducido input 
  //alert("valor minimo:"+minimo);
  //alert("valor ingresado:"+valor);
  if(valor=="" || valor=="0.0" || valor=="0"){
    $('#'+minimo).val('0.0');
    $('#'+minimo).css("border","2px solid red");
    generate("warning", "Ingrese un monto a devolver");
  }
  else if(minimo<valor){
    $('#'+minimo).val('0.0');
    $('#'+minimo).css("border","2px solid red");
    generate("warning", "El monto a devolver no puede ser mayor al solicitado");
  }
  else{
   var res=componente.split("_");
   var id=res[1];
   var tarjeta=res[2];
  var datos={
    "valor":valor,
    "id":id,
    "tarjeta":tarjeta,
};
    $.ajax({
      url:   'aplicar_devolucion.php',
      type:  'post',
      data: datos,
      success:  function (response) {
        if(response.includes("éxito")){
          generate("success", "La devolución se ha generado");
          $('.filas_ocultas').fadeOut();
        }
        else{
          generate("warning", "Error: "+response);
        }
        
      }
      
    });
  }
});
    </script>
</body>
</html>