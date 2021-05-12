function inicio(){
// Get the template HTML and remove it from the doument
var previewNode = document.querySelector("#template");
previewNode.id = "";
var previewTemplate = previewNode.parentNode.innerHTML;
previewNode.parentNode.removeChild(previewNode);

var anio="";
var mes="";

$('#c_anio').change(function(){
    anio=$('#c_anio').val();
});

$('#c_mes').change(function(){
    mes=$('#c_mes').val();
});

var myDropzone = new Dropzone(document.body, {
    url: "upload_nomina.php?anio="+anio+"&mes="+mes,
    paramName: "file",
    acceptedFiles: 'application/pdf',
    maxFilesize: 3,
    maxFiles: 100,
    thumbnailWidth: 160,
    thumbnailHeight: 160,
    thumbnailMethod: 'contain',
    previewTemplate: previewTemplate,
    autoQueue: true,
    previewsContainer: "#previews",
    parallelUploads: 5,
    clickable: ".fileinput-button",
    
});

myDropzone.on("addedfile", function(file) {
    $('.dropzone-here').show();
    if ($('#c_anio').val()=="") {
        Swal.fire(
            'Opps',
            'Seleccione previamente un año',
            'warning'
          )
        myDropzone.removeFile(file);
    }
    else if ($('#c_mes').val()=="") {
            Swal.fire(
                'Opps',
                'Seleccione previamente un mes',
                'warning'
              )
            myDropzone.removeFile(file);
        }
    else{
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
    }
});

// Update the total progress bar
myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
});

//myDropzone.on("sending", function(file) {
    // Show the total progress bar when upload starts
    myDropzone.on('sending', function(file, xhr, formData){     

        formData.append('anio',$('#c_anio').val());
        formData.append('mes',$('#c_mes').val());

    document.querySelector("#total-progress").style.opacity = "1";
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
});

// Hide the total progress bar when nothing's uploading anymore
myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0";
    Swal.fire({
        //title: 'Are you sure?',
        text: "Los archivos se han cargado correctamente",
        type: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        //cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar'
      }).then((result) => {
          console.log(result);
        if (result.value) {
            $('.delete').click();
            //actualizar la tabla de los comprobante de ese mes
        }
      })
    //$('.delete').click();
});

// Setup the buttons for all transfers
// The "add files" button doesn't need to be setup because the config
// `clickable` has already been specified.
document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
};

$('#previews').sortable({
    items:'.file-row',
    cursor: 'move',
    opacity: 0.4,
    containment: "parent",
    distance: 20,
    tolerance: 'pointer',
    update: function(e, ui){
        //actions when sorting
    }
});

ver_carpetas("2021","04");

function ver_carpetas(anio, mes){
    var datos={
            "mes":mes,
            "anio":anio,
        };
        alert(anio);
        alert(mes);
    $.ajax({
        url:   "ver_carpetas_nomina.php",
        type:  'post',
        data: datos,
        success:  function (response) {
          $('#body_nomina').html(response);              
        }
      });
}

}