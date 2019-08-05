jQuery(document).ready(function() {
    validateFormValidarRFC();
    uppercaseinputDashboardRFC();
    mostarRespuestaValidarRFC(false);
    validarOtroRFC();
});

var mostarRespuestaValidarRFC = function(bMostrar) {
    if(bMostrar === true) {
        $('#divFormValidarRFC').hide();
        $('#divResultValidarRFC').show();
    } else {
        $('#divResultValidarRFC').hide();
        $('#divFormValidarRFC').show();
    }
};

var submitRFC = function() {
    var rfc = $('#inputDashboardRFC').val();

    $('#divResultValidarRFC').hide();

    html = '<div class="loading-message">' +
                '<h4>Consultando lista RFC</h4>' +
                '<div class="block-spinner-bar"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>' +
            '</div>';

    jQuery.blockUI({
        message: html,
        css: {
            border: '0',
            padding: '0',
            backgroundColor: 'none'
        },
    });

    jQuery.ajax({
        type: "POST",
        url: 'dashboard/validarRFC/',
        data: $('#formValidarRFC').serialize(),
        success: successRFC,
        error: errorRFC
    });
};

var errorRFC = function() {
    $('#msjErrorFormValidarRFC').html('Favor de intentar mas tarde');
    $(".alert-danger").show();
    jQuery.unblockUI();
};

var successRFC = function(result) {
    jQuery.unblockUI();

    if (result.ERROR) {
        $('#msjErrorFormValidarRFC').html(result.ERROR['msj']);
        $(".alert-danger").show();
    } else {
        $("#inputDashboardRFC").val('');

        var fecha = result.SUCCESS['fechaListaSAT'];
        var resultado = result.SUCCESS['resultado'];
        var rfc = result.SUCCESS['rfc'];
        var valido = result.SUCCESS['valido'];

        $('#rfcValidado').html(rfc);
        $('#fechaListaVal').html(fecha);
        $('.validacion-resultado').hide();

        if (valido) {
            $('.validacion-resultado.valido').show();
        } else {
            $('.validacion-resultado.no-valido').show();
        }

        mostarRespuestaValidarRFC(true);
    }
};

var validateFormValidarRFC = function() {
    var formValidarRFC = $("#formValidarRFC"),
        mensajeError = $(".alert-danger", formValidarRFC);

    formValidarRFC.validate({
        errorElement: "span",
        errorClass: "help-block help-block-error",
        focusInvalid: !1,
        ignore: "",
        rules: {
            rfc: {
                required: true,
                minlength: 12,
                maxlength: 13
            }
        },
        messages: {
            rfc: {
                minlength: "",
                maxlength: "",
                required: ""
            }
        },
        invalidHandler: function() {
            $('#msjErrorFormValidarRFC').html('El RFC no tiene un formato válido.');
            mensajeError.show();
            App.scrollTo(mensajeError, -200);
        },
        errorPlacement: function(formValidarRFC, mensajeError) {
            var mensajeExito = $(mensajeError).parent(".input-group");
            mensajeExito ? mensajeExito.after(formValidarRFC) : mensajeError.after(formValidarRFC)
        },
        highlight: function(inputError) {
            $(inputError).closest(".form-group").addClass("has-error");
        },
        unhighlight: function(inputError) {
            $(inputError).closest(".form-group").removeClass("has-error");
        },
        submitHandler: function(form) {
            submitRFC();
            mensajeError.hide();
        }
    })
};

var validarOtroRFC = function() {
    $('#otraValidacionRFC').click(function() {
        mostarRespuestaValidarRFC(false);
    });
};

var uppercaseinputDashboardRFC = function() {
    $("#inputDashboardRFC").keyup(function(e){
        if ((e.keyCode < 37 || e.keyCode > 40) && e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 32){
            $(this).val($(this).val().toUpperCase());
        }
    }).keypress(function(e){
        var keyCode = (!e.keyCode && e.which) ? e.which : e.keyCode;
        if (keyCode == 32) {
            return false;
        } if (keyCode == 13) {
            $('#formValidarRFC').submit();
        }
    });
};